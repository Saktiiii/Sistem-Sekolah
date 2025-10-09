<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_model extends CI_Model {
    
    public function get_jadwal_by_guru($guru_id, $hari = null)
    {
        $this->db->select('j.*, k.nama_kelas, mp.nama_mapel as mata_pelajaran, mp.kode_mapel');
        $this->db->from('jadwal j');
        $this->db->join('kelas k', 'j.kelas_id = k.id');
        $this->db->join('mata_pelajaran mp', 'j.mata_pelajaran_id = mp.id');
        $this->db->where('j.guru_id', $guru_id);
        
        if ($hari) {
            $this->db->where('j.hari', $hari);
        }
        
        $this->db->order_by('j.hari', 'ASC');
        $this->db->order_by('j.jam_mulai', 'ASC');
        
        return $this->db->get()->result();
    }
}