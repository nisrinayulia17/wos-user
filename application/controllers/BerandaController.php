<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BerandaController extends CI_Controller
{

	public function index()
	{
		$data['title'] = 'Beranda';
		$data['halaman'] = 'Beranda/index';
		$this->load->view('layout/layout', $data);
	}

	public function galeri(){
		$data['title'] = 'Galeri';
		$data['halaman'] = 'Beranda/galeri';
		$this->load->view('layout/layout', $data);	
	}

	public function faq(){
		$data['title'] = 'FAQ';
		$data['halaman'] = 'Beranda/faq';
		$this->load->view('layout/layout', $data);	
	}
}
