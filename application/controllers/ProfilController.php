<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfilController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
    }

    public function profil($id_user)
    {
        $cookie_customer = get_cookie('id_user');
        $data['title'] = 'Profil';
        $data['halaman'] = 'Profil/profil';
        $data['profil'] = $this->UserModel->getCustomerById($id_user)->row();
        $this->load->view('layout/layout', $data);
    }

    public function riwayat($id_user)
    {
        $data['title'] = 'Riwayat Transaksi';
        $data['halaman'] = 'Profil/riwayat';
        $data['user'] = $this->UserModel->getCustomerById($id_user)->row();
        $data['transaksi'] = $this->UserModel->getTransaksi($id_user);
        $this->load->view('layout/layout', $data);
    }

    public function ubahprofil($id_user)
    {
        $cookie_customer = get_cookie('id_user');
        $data['title'] = 'Ubah Profil';
        $data['halaman'] = 'Profil/ubahprofil';
        $data['profil'] = $this->UserModel->getCustomerById($id_user)->row();
        $this->load->view('layout/layout', $data);
    }

    public function actUbahProfil()
    {
        parse_str(file_get_contents('php://input'), $data);
        $this->UserModel->ubahCustomer($data);

        $response = array(
            'Success' => true,
            'Info' => 'Data berhasil diperbarui'
        );

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();
        exit;
    }

    public function gantipassword($id_user)
    {
        $cookie_customer = get_cookie('id_user');
        $data['title'] = 'Ganti Password';
        $data['halaman'] = 'Profil/gantipassword';
        $data['profil'] = $this->UserModel->getCustomerById($id_user)->row();
        $this->load->view('layout/layout', $data);
    }

    public function actGantiPassword()
    {

        parse_str(file_get_contents('php://input'), $data);
        $this->UserModel->ubahPassword($data);

        $response = array(
            'Success' => true,
            'Info' => 'Password berhasil diperbarui'
        );

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();
        exit;
    }

    public function detailTransaksi($id_order)
    {
        $data['title'] = 'Detail Transaksi';
        $data['halaman'] = 'Profil/detail_riwayat';
        $data['detail'] = $this->UserModel->getTransaksiById($id_order);
        $this->load->view('layout/layout', $data);
    }
}
