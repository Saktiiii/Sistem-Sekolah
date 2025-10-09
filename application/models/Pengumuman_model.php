<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman_model extends CI_Model {
    protected $table = 'pengumuman';

    public function __construct(){ parent::__construct(); }

    /**
     * get_all($type = null, $kelas_id = null)
     * - $type: string filter (e.g. 'Ekskul', 'Umum', or 'All' / null)
     * - $kelas_id: optional
     */
    public function get_all($type = null, $kelas_id = null)
    {
        // gunakan COALESCE agar resilient terhadap name variations
        $select = "id,
            COALESCE(judul, title, nama, '') AS judul,
            COALESCE(tipe, type, kategori, '') AS tipe,
            COALESCE(content, isi, description, '') AS content,
            COALESCE(created_at, tanggal, date_created, '') AS created_at,
            COALESCE(image, file, '') AS image,
            COALESCE(kelas_id, NULL) AS kelas_id
        ";
        $this->db->select($select, FALSE);
        $this->db->from($this->table);

        if ($type && strtolower($type) !== 'all') {
            $this->db->where("(COALESCE(tipe, type, kategori) = ".$this->db->escape($type).")");
        }
        if ($kelas_id) {
            $this->db->where('COALESCE(kelas_id, NULL) =', $kelas_id);
        }

        $this->db->order_by('created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function delete($id)
    {
        // optionally, you can fetch row first to unlink file
        $row = $this->db->get_where($this->table, ['id' => $id])->row();
        if ($row && isset($row->image) && !empty($row->image) && file_exists(FCPATH . $row->image)) {
            @unlink(FCPATH . $row->image);
        }
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
}
