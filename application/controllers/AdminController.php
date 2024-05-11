<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminController extends CI_Controller
{
    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->load->model('UserModel');
    // }

    public function admin()
    {
        $this->load->view('Admin/layout/header');
        $this->load->view('Admin/layout/sidebar');
        $this->load->view('Admin/dashboard');
        $this->load->view('Admin/layout/footer');
    }
}
