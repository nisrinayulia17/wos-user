<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Memuat library database
    }
    public $tabel = 'user';
    public $pk_customer = 'id_user';

    public function getCustomerByEmail($email)
    {
        return $this->db->where('email', $email)
            ->get($this->tabel);
    }

    function getCustomerById($id)
    {
        return $this->db->where('id_user', $id)
            ->get($this->tabel);
    }
    function daftarAkun($data)
    {
        $val = array(
            'nama_lengkap' => $data['nama_lengkap'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password']
        );

        return $this->db->insert($this->tabel, $val);
    }

    function ubahCustomer($data)
    {
        if ($data['nama_lengkap'] == null || $data['nama_lengkap'] == "") {
            $val = array(
                'alamat' => $data['alamat'],

            );
        } else {
            $val = array(
                'nama_lengkap' => $data['nama_lengkap'],
                'username' => $data['username'],
                'email' => $data['email'],
                'alamat' => $data['alamat'],
            );
        }

        $this->db->where($this->pk_customer, $data['id_user'])
            ->update($this->tabel, $val);
    }

    function ubahPassword($data)
    {
        if ($data['password'] == null || $data['password'] == "") {
            // Jika password kosong, tidak melakukan perubahan password
            return;
        }


        // Menggunakan array untuk menyimpan nilai yang akan diupdate
        $val = array(
            'password' => $data['password']
        );

        // Melakukan update data ke database
        $this->db->where($this->pk_customer, $data['id_user'])
            ->update($this->tabel, $val);
    }

    function getPenggunaBayar($id_user)

    {

        return $this->db->select('nama_lengkap,email')

            ->where('id_user', $id_user)

            ->get($this->tabel);
    }
}
