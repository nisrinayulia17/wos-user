<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PembelianModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Memuat library database
    }

    public function updateKursi($nomor)
    {
        // Memeriksa apakah array nomor tiket tidak kosong
        if (!empty($nomor)) {
            // Mengatur nilai status '0' untuk mengubah status kursi
            $val = array(
                'status' => '0'
            );

            // Melakukan update data ke database
            $this->db->where_in('nomor_kursi', $nomor)
                ->update('kursi', $val);

            // Mengembalikan jumlah baris yang terpengaruh oleh operasi update
            return $this->db->affected_rows();
        } else {
            // Jika array nomor tiket kosong, kembalikan 0 sebagai tanda tidak ada perubahan
            return 0;
        }
    }
}
