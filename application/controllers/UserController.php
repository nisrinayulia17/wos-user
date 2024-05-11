<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
    }

    public function daftarAkun()
    {
        parse_str(file_get_contents('php://input'), $data);
        $email = $data['email'];
        $nama_lengkap = $data['nama_lengkap'];

        $cek_user = $this->UserModel->getCustomerByEmail($email)->num_rows();

        if ($cek_user == 0) {
            $execDaftar = $this->UserModel->daftarAkun($data);

            if ($execDaftar) {
                $response = array(
                    'status' => 1,
                    'info' => 'Berhasil melakukan pendaftaran akum'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'info' => 'Gagal melakukan pendaftaran akun'
                );
            }
        } else {
            $response = array(
                'status' => 0,
                'info' => 'Akun sudah terdaftar'
            );
        }

        $this->output

            ->set_status_header(201)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();
        exit;
    }

    public function loginAkun($email, $pass)
    {
        $user = $this->UserModel->getCustomerByEmail($email)->row();

        if ($user->password == $pass) {
            set_cookie('id_user', $user->id_user, time() + 86400);

            $response = array(
                'status' => 1,

                'info' => 'Selamat datang' . $user->nama_lengkap . '!'
            );
        } else {
            $response = array(
                'status' => 0,
                'info' => 'Email atau password salah'
            );
        }

        $this->output
            ->set_status_header(201)
            ->set_content_type('application/json')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT))
            ->_display();
        exit;
    }

    public function getCustomerById($id)
    {

        $response = $this->UserModel->getCustomerById($id)->row();

        $this->output

            ->set_status_header(201)

            ->set_content_type('application/json')

            ->set_output(json_encode($response, JSON_PRETTY_PRINT))

            ->_display();

        exit;
    }

    public function logout()
    {

        unset($_SESSION['access_token']);

        delete_cookie('id_user');

        delete_cookie('g_state');

        redirect(base_url());
    }

    public function getPenggunaBayar($id_user)
    {
        $response = $this->UserModel->getPenggunaBayar($id_user)->row();



        $this->output

            ->set_status_header(201)

            ->set_content_type('application/json')

            ->set_output(json_encode($response, JSON_PRETTY_PRINT))

            ->_display();

        exit;
    }

    public function getPenggunaBayar2($id_user)
    {
        $response = $this->UserModel->getPenggunaBayar($id_user)->row();



        $this->output

            ->set_status_header(201)

            ->set_content_type('application/json')

            ->set_output(json_encode($response, JSON_PRETTY_PRINT))

            ->_display();

        exit;
    }
}
