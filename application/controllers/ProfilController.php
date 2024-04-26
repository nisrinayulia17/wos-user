<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfilController extends CI_Controller
{

    public function profil()
    {
        $data['title'] = 'Profil';
        $data['halaman'] = 'Profil/profil';
        $this->load->view('layout/layout', $data);
    }

    public function riwayat()
    {
        $data['title'] = 'Riwayat Transaksi';
        $data['halaman'] = 'Profil/riwayat';
        $this->load->view('layout/layout', $data);
    }

    public function ubahprofil()
    {
        $data['title'] = 'Ubah Profil';
        $data['halaman'] = 'Profil/ubahprofil';
        $this->load->view('layout/layout', $data);
    }

    public function gantipassword()
    {
        $data['title'] = 'Ganti Password';
        $data['halaman'] = 'Profil/gantipassword';
        $this->load->view('layout/layout', $data);
    }
}
