<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PertunjukanController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PertunjukanModel');
    }

    public function index()
    {
        $data['title'] = 'Pertunjukan';
        $data['halaman'] = 'Pertunjukan/pertunjukan';
        $data['pertunjukan'] = $this->PertunjukanModel->getDataPertunjukan();
        $data['pemain'] = $this->PertunjukanModel->getPemain();
        $this->load->view('layout/layout', $data);
    }

    public function pilih_kursi()
    {

        $data['title'] = 'Pilih Kursi';
        $data['halaman'] = 'Pertunjukan/pilih_kursi';
        $data['columns1'] = $this->PertunjukanModel->getKursiByColumn1();
        $data['columns2'] = $this->PertunjukanModel->getKursiByColumn2();
        $data['tiket'] = $this->PertunjukanModel->getHargaTiket();

        $this->load->view('layout/layout', $data);
    }
}
