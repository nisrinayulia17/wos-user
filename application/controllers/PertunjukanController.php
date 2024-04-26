<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PertunjukanController extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Pertunjukan';
        $data['halaman'] = 'Pertunjukan/pertunjukan';
        $this->load->view('layout/layout', $data);
    }
}
