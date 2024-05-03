<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PertunjukanModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Memuat library database
    }

    public function getDistinctColumns()
    {
        $query = $this->db->query("SELECT DISTINCT column_num FROM kursi");
        return $query->result_array();
    }

    public function getKursiByColumn1()
    {
        $query = $this->db->query("SELECT * FROM kursi WHERE column_num = 1 ORDER BY id_kursi ASC");
        return $query->result_array();
    }

    public function getKursiByColumn2()
    {
        $query = $this->db->query("SELECT * FROM kursi WHERE column_num = 2 ORDER BY id_kursi ASC");
        return $query->result_array();
    }

    public function getDataPertunjukan()
    {
        $query = $this->db->query("SELECT * FROM pertunjukan WHERE aktif = 1");
        return $query->row();
    }

    function getPertunjukanById($id_pertunjukan)
    {
        // Anda perlu mengubah 'nama_tabel_pertunjukan' dengan nama tabel yang benar
        return $this->db->where('id_pertunjukan', $id_pertunjukan)
            ->where('aktif', '1') // Hanya ambil pertunjukan yang statusnya aktif
            ->get('pertunjukan');
    }

    public function getPemain()
    {
        $query = $this->db->query("SELECT p.*
        FROM pemain p
        INNER JOIN pertunjukan pt ON p.pertunjukan = pt.id_pertunjukan
        WHERE pt.aktif = '1'");
        return $query->result();
    }

    public function getHargaTiket(){
        $query = $this->db->query("SELECT * FROM tiket");
        return $query->row();
    }
}
