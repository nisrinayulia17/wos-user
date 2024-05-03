<?php

defined('BASEPATH') or exit('No direct script access allowed');

header("Access-Control-Allow-Origin: *");

class PembelianController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('PembelianModel');
    }

    public function updateKursi()
    {
        // Ambil nomor tiket dari permintaan POST
        $nomorTiket = $this->input->post('nomorTiket');

        // Memeriksa apakah nomor tiket tidak kosong
        if (!empty($nomorTiket)) {
            // Panggil model untuk melakukan pembaruan status kursi untuk setiap nomor tiket
            foreach ($nomorTiket as $nomor) {
                $this->PembelianModel->updateKursi($nomor);
            }

            // Menyiapkan respons
            $response = array(
                'Success' => true,
                'Info' => 'Data berhasil diperbarui'
            );
        } else {
            // Penanganan jika nomor tiket kosong
            $response = array(
                'Success' => false,
                'Info' => 'Nomor tiket tidak tersedia'
            );
        }

        // Mengirimkan respons dalam format JSON
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();
        exit;
    }
}
