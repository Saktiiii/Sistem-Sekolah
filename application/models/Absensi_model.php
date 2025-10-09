<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi_model extends CI_Model {
    protected $table = null;
    protected $table_fields = [];

    public function __construct()
    {
        parent::__construct();
        $this->detect_table_and_fields();
    }

    /**
     * Deteksi tabel absensi yang ada di database dan simpan nama + fields
     * Tidak membuat/merubah tabel apapun.
     */
    protected function detect_table_and_fields()
    {
        $candidates = [
            'absensi_siswa',
            'absensi',
            'kehadiran',
            'presensi',
            'attendance' // cadangan
        ];

        foreach ($candidates as $t) {
            if ($this->db->table_exists($t)) {
                $this->table = $t;
                $this->table_fields = $this->db->list_fields($t);
                return;
            }
        }

        // kalau tidak ditemukan, tetap null (fungsi lain harus handle case ini)
        $this->table = null;
        $this->table_fields = [];
    }

    /**
     * Kembalikan nama tabel yang dipakai (atau null jika tidak ada)
     */
    public function get_table_name()
    {
        return $this->table;
    }

    /**
     * Kembalikan array fields tabel absensi (atau empty jika tidak ada)
     */
    public function get_table_fields()
    {
        return $this->table_fields;
    }

    /**
     * Ambil list absensi. Jika ada kolom siswa_id, tambahkan join ke tabel siswa (jika ada).
     * @param int|null $kelas_id optional filter kelas
     * @param string|null $tanggal optional filter tanggal (YYYY-MM-DD)
     */
    public function get_attendance($kelas_id = null, $tanggal = null)
    {
        if (!$this->table) return [];

        $this->db->from($this->table . ' as a');

        // jika ada kolom siswa_id, join ke siswa untuk nama
        if (in_array('siswa_id', $this->table_fields) && $this->db->table_exists('siswa')) {
            $this->db->select('a.*, s.nama as nama_siswa, s.nis as nis');
            $this->db->join('siswa s', 's.id = a.siswa_id', 'left');
        } else {
            $this->db->select('a.*');
        }

        if ($kelas_id && in_array('kelas_id', $this->table_fields)) {
            $this->db->where('a.kelas_id', (int)$kelas_id);
        }
        if ($tanggal) {
            if (in_array('tanggal', $this->table_fields)) {
                $this->db->where('a.tanggal', $tanggal);
            } elseif (in_array('created_at', $this->table_fields)) {
                // fallback: filter by date part of created_at
                $this->db->where('DATE(a.created_at)', $tanggal);
            }
        }

        $this->db->order_by('a.tanggal', 'DESC');
        return $this->db->get()->result();
    }

    /**
     * Ambil record absensi berdasarkan siswa_id (atau nis) dan tanggal
     */
    public function get_by_student_and_date($siswa_id_or_nis, $tanggal)
    {
        if (!$this->table) return null;

        $this->db->from($this->table . ' as a');

        if (in_array('siswa_id', $this->table_fields)) {
            $this->db->where('a.siswa_id', $siswa_id_or_nis);
        } elseif (in_array('nis', $this->table_fields)) {
            $this->db->where('a.nis', $siswa_id_or_nis);
        } elseif (in_array('nis_siswa', $this->table_fields)) {
            $this->db->where('a.nis_siswa', $siswa_id_or_nis);
        } else {
            // tidak ada kolom siswa identifier => tidak bisa cari per-siswa
            return null;
        }

        if (in_array('tanggal', $this->table_fields)) {
            $this->db->where('a.tanggal', $tanggal);
        } elseif (in_array('created_at', $this->table_fields)) {
            $this->db->where('DATE(a.created_at)', $tanggal);
        }

        return $this->db->get()->row();
    }

    /**
     * Insert data absensi (hanya kolom yang ada di tabel akan digunakan)
     * @param array $data
     */
    public function insert($data)
    {
        if (!$this->table) return false;

        $payload = $this->filter_allowed_fields($data);
        $payload['created_at'] = isset($payload['created_at']) ? $payload['created_at'] : date('Y-m-d H:i:s');
        $payload['updated_at'] = isset($payload['updated_at']) ? $payload['updated_at'] : date('Y-m-d H:i:s');

        $this->db->insert($this->table, $payload);
        return $this->db->insert_id();
    }

    /**
     * Update record absensi by id
     */
    public function update($id, $data)
    {
        if (!$this->table) return false;

        $payload = $this->filter_allowed_fields($data);
        $payload['updated_at'] = date('Y-m-d H:i:s');

        $this->db->where('id', (int)$id);
        return $this->db->update($this->table, $payload);
    }

    /**
     * Hanya ambil field yang tersedia dalam tabel
     */
    protected function filter_allowed_fields($data)
    {
        $out = [];
        foreach ($data as $k => $v) {
            if (in_array($k, $this->table_fields)) {
                $out[$k] = $v;
            }
        }
        return $out;
    }

}
