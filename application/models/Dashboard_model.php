<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard_model extends CI_Model
{

    public function count_by_kategori($kategori)
    {
        return $this->db->where('kategori', $kategori)
            ->from('penerimamanfaat')
            ->count_all_results();
    }

    public function get_barang_masuk()
    {
        return $this->db->select('nama_barang, SUM(jumlah) as total')
            ->group_by('nama_barang')
            ->get('penerimaan_barang')
            ->result_array();
    }

    public function count_donatur()
    {
        return $this->db->from('donatur')->count_all_results();
    }
}
