<?php

defined('BASEPATH') or exit('No direct script access allowed');

header("Access-Control-Allow-Origin: *");

class MidtransController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-Ac8gbNkt9z1NXlKjLQqwANXu', 'production' => false);
        $this->load->library('midtrans');
        $this->midtrans->config($params);
        $this->load->helper('url');
    }


    public function bayarTagihanMidtrans()
    {
        $harga_satuan = $this->input->post('satuanTiket');
        $jml_tiket = $this->input->post('selectedTicketCount2');
        $total_harga = $this->input->post('totalBayar');
        $nama_customer = $this->input->post('nama_customer');
        $email = $this->input->post('email');


        // Required
        $transaction_details = array(
            'order_id' => rand(),
            'gross_amount' => $total_harga // no decimal allowed for creditcard
        );

        // Optional
        $item1_details = array(
            'id' => 'a1',
            'price' => $harga_satuan,
            'quantity' => $jml_tiket,
            'name' => "Apple"
        );

        // Optional
        // $item2_details = array(
        //   'id' => 'a2',
        //   'price' => 10000,
        //   'quantity' => 1,
        //   'name' => "Orange"
        // );

        // Optional
        $item_details = array($item1_details);

        // Optional
        // $billing_address = array(
        //     'first_name'    => "andri",
        //     'last_name'     => "Litani",
        //     'address'       => "Mangga 20",
        //     'city'          => "Jakarta",
        //     'postal_code'   => "16602",
        //     'phone'         => "081122334455",
        //     'country_code'  => 'IDN'
        // );

        // // Optional
        // $shipping_address = array(
        //     'first_name'    => "Obet",
        //     'last_name'     => "Supriadi",
        //     'address'       => "Manggis 90",
        //     'city'          => "Jakarta",
        //     'postal_code'   => "16601",
        //     'phone'         => "08113366345",
        //     'country_code'  => 'IDN'
        // );

        // Optional
        $customer_details = array(
            'first_name'    => $nama_customer,
            'email'         => $email,
        );

        // Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O", $time),
            'unit' => 'minute',
            'duration'  => 5
        );

        $transaction_data = array(
            'transaction_details' => $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

        error_log(json_encode($transaction_data));
        $snapToken = $this->midtrans->getSnapToken($transaction_data);
        error_log($snapToken);
        echo $snapToken;
    }
}
