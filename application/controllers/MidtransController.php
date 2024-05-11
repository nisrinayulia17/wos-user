<?php

defined('BASEPATH') or exit('No direct script access allowed');

header("Access-Control-Allow-Origin: *");

use PHPMailer\PHPMailer\PHPMailer;

class MidtransController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-Ac8gbNkt9z1NXlKjLQqwANXu', 'production' => false);
        $this->load->library(array('midtrans', 'veritrans'));
        $this->midtrans->config($params);
        $this->veritrans->config($params);
        $this->load->helper('url');

        $this->load->model('PembelianModel');

        require APPPATH . 'libraries/PHPMailer/src/Exception.php';

        require APPPATH . 'libraries/PHPMailer/src/PHPMailer.php';

        require APPPATH . 'libraries/PHPMailer/src/SMTP.php';
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
            'name' => "Tiket Wayang Orang"
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
            'duration'  => 3
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

    public function simpanPembayaranMidtrans()
    {
        parse_str(file_get_contents('php://input'), $data);
        $id_user = $this->input->post('id_user');
        $id_pertunjukan = $this->input->post('id_pertunjukan');
        $jmlTiket = $this->input->post('jmlTiket');
        $id_order = $this->input->post('no_invoice');
        $nomorTiket = $this->input->post('nomorTiket');
        $nomorTiketJSON = json_encode($nomorTiket);

        $this->PembelianModel->simpanOrder($id_user, $id_pertunjukan, $jmlTiket, $id_order, $nomorTiketJSON);

        $result = json_decode($data['result_data']);

        if ($result->payment_type == "bank_transfer") {
            if ($result->va_numbers) {
                foreach ($result->va_numbers as $rows) {
                    $bank = $rows->bank;
                    $no_va = $rows->va_number;
                }

                $url_slip = $result->pdf_url;
            } else {
                $bank = 'permata';
                $no_va = $result->permata_va_number;
                $url_slip = $result->pdf_url;
            }
        } else if ($result->payment_type == "echannel") {
            $bank = 'mandiri';
            $no_va = $result->bill_key;
            $url_slip = $result->pdf_url;
        } else if ($result->payment_type == "gopay" || $result->payment_type == "qris") {
            $bank = $no_va = $url_slip = '';
        }

        $data_bayar = array(
            'id_order' => $result->order_id,
            'total_bayar' => $result->gross_amount,
            'jenis_pembayaran' => $result->payment_type,
            'bank' => $bank,
            'no_va' => $no_va,
            'kode_status' => $result->status_code,
            'url_slip' => $url_slip,
            'waktu_transaksi' => $result->transaction_time

        );

        $this->PembelianModel->simpanPembayaran($data_bayar);

        $response = array('Success' => true);


        $this->output

            ->set_status_header(201)

            ->set_content_type('application/json')

            ->set_output(json_encode($response, JSON_PRETTY_PRINT))

            ->_display();

        exit;
    }


    public function getPembelianById($id_order)
    {
        $detail_transaksi = $this->PembelianModel->getPembelianById($id_order);


        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($detail_transaksi));
    }

    public function notifikasiPembayaran()
    {
        // $json_result = (file_get_contents('php://input'));
        // $result = json_decode($json_result);
        // $id_order = $result['order_id'];

        parse_str(file_get_contents('php://input'), $data);
        $id_order = $data["orderId"];

        $cekStatus = $this->veritrans->status($id_order);
        $status_transaksi = $cekStatus->transaction_status;

        $invoice = $this->PembelianModel->getInvoiceTagihan($id_order);
        $tiket = $this->PembelianModel->getDataPembelian($id_order);

        if ($status_transaksi == 'pending' || $status_transaksi == 'challenge') {
            // Ubah status pembayaran
            $data_bayar = array(
                'id_order' => $id_order,
                'kode_status' => '201',
                'waktu_pembayaran' => ''
            );
            $this->PembelianModel->ubahStatusPembayaran($data_bayar);
            $this->PembelianModel->ubahStatusKursi($tiket->nomor_tiket, $tiket->kode_status);
            $this->kirimInvoice($invoice->id_order, $invoice->nama_lengkap, $invoice->email, $invoice->judul, $invoice->nomor_tiket, $invoice->jml_tiket, $invoice->kode_status, $invoice->url_slip, $invoice->no_va);
        } else if ($status_transaksi == 'settlement' || $status_transaksi == 'capture') {
            $data_bayar = array(
                'id_order' => $id_order,
                'kode_status' => '200',
                'waktu_pembayaran' => $cekStatus->settlement_time
            );
            $this->PembelianModel->ubahStatusPembayaran($data_bayar);
            $this->PembelianModel->ubahStatusKursi($tiket->nomor_tiket, $tiket->kode_status);
            $this->kirimInvoice($invoice->id_order, $invoice->nama_lengkap, $invoice->email, $invoice->judul, $invoice->nomor_tiket, $invoice->jml_tiket, $invoice->kode_status, $invoice->url_slip, $invoice->no_va);
        } else if ($status_transaksi == 'expire' || $status_transaksi == 'deny') {

            $data_bayar = array(
                'id_order' => $id_order,
                'kode_status' => '202',
                'waktu_pembayaran' => ''
            );

            $this->PembelianModel->ubahStatusPembayaran($data_bayar);
            $this->PembelianModel->ubahStatusKursi($tiket->nomor_tiket, $tiket->kode_status);
            $this->kirimInvoice($invoice->id_order, $invoice->nama_lengkap, $invoice->email, $invoice->judul, $invoice->nomor_tiket, $invoice->jml_tiket, $invoice->kode_status, $invoice->url_slip, $invoice->no_va);
        }


        // $response = array('Success' => true);

        // $this->output

        //     ->set_status_header(201)

        //     ->set_content_type('application/json')

        //     ->set_output(json_encode($response, JSON_PRETTY_PRINT))

        //     ->_display();

        // exit;
    }

    public function getStatusPembayaran()
    {
        // $json_result = (file_get_contents('php://input'));
        // $result = json_decode($json_result);
        // $id_order = $result['order_id'];

        parse_str(file_get_contents('php://input'), $data);
        $id_order = $data["orderId"];

        $cekStatus = $this->veritrans->status($id_order);
        $status_transaksi = $cekStatus->transaction_status;

        $invoice = $this->PembelianModel->getInvoiceTagihan($id_order);
        $tiket = $this->PembelianModel->getDataPembelian($id_order);

        if ($status_transaksi == 'pending' || $status_transaksi == 'challenge') {
            // Ubah status pembayaran
            // $this->PembelianModel->ubahStatusKursi($tiket->nomor_tiket, $tiket->kode_status);
            $this->kirimInvoice($invoice->id_order, $invoice->nama_lengkap, $invoice->email, $invoice->judul, $invoice->nomor_tiket, $invoice->jml_tiket, $invoice->kode_status, $invoice->url_slip, $invoice->no_va);
        } else if ($status_transaksi == 'settlement' || $status_transaksi == 'capture') {

            $this->PembelianModel->ubahStatusKursi($tiket->nomor_tiket, $tiket->kode_status);
            $this->kirimInvoice($invoice->id_order, $invoice->nama_lengkap, $invoice->email, $invoice->judul, $invoice->nomor_tiket, $invoice->jml_tiket, $invoice->kode_status, $invoice->url_slip, $invoice->no_va);
        } else if ($status_transaksi == 'expire' || $status_transaksi == 'deny') {

            $this->PembelianModel->ubahStatusKursi($tiket->nomor_tiket, $tiket->kode_status);
            $this->kirimInvoice($invoice->id_order, $invoice->nama_lengkap, $invoice->email, $invoice->judul, $invoice->nomor_tiket, $invoice->jml_tiket, $invoice->kode_status, $invoice->url_slip, $invoice->no_va);
        }
    }

    public function setStatus()
    {
        parse_str(file_get_contents('php://input'), $data);
        $id_order = $data['id_order'];
        $aksi = $data['aksi'];

        switch ($aksi) {
            case 'status':
                $this->veritrans->status($id_order);
                break;
            case 'approve':
                $this->veritrans->approve($id_order);
                break;
            case 'expire':
                $this->veritrans->expire($id_order);
                break;
            case 'cancel':
                $this->veritrans->cancel($id_order);
                break;
        }
    }

    public function updateStatusKursi($nomor_tiket)
    {
        $nomorTiketArray = json_decode($nomor_tiket, true);

        // Memeriksa apakah nomor tiket tidak kosong
        if (!empty($nomorTiketArray)) {
            // Panggil model untuk melakukan pembaruan status kursi untuk setiap nomor tiket
            foreach ($nomorTiketArray as $nomor) {
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

    // public function updateKursi($nomor_tiket, $status)
    // {

    //     $nomor_tiket_array = json_decode($nomor_tiket, true);

    //     if ($nomor_tiket_array === null) {
    //         // JSON tidak valid, lakukan penanganan kesalahan
    //         return false;
    //     }

    //     foreach ($nomor_tiket_array as $nomor) {
    //         // Memeriksa apakah status yang diberikan adalah 0
    //         if ($status == 0) {
    //             // Mengubah status kursi menjadi "booked"
    //             $this->PembelianModel->updateKursi($nomor);
    //         } else if ($status == 1) {
    //             // Mengubah status kursi sesuai dengan nilai status yang diberikan
    //             $this->PembelianModel->updateKursi($nomor);
    //         }
    //     }
    // }

    function kirimInvoice($id_order, $nama_lengkap, $email, $judul, $nomor_tiket, $jml_tiket, $kode_status, $url_slip, $no_va)
    {
        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'wayangsriwedari@gmail.com';
        $mail->Password = 'oihqfsjqudwcjkxy';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('wayangsriwedari@gmail.com', 'Pembayaran Tiket Wayang Orang Sriwedari');
        $mail->addAddress($email);
        $mail->Subject = 'Invoice #' . $id_order . ' Tiket Pertunjukan' . $judul;
        $mail->isHTML(true);
        if ($kode_status == '201') {
            $text_email = 'Terima kasih telah melakukan pembelian tiket <strong>Pertunjukan ' . $judul . '</strong>.<br>Selanjutnya, silakan segera lakukan pembayaran dengan nomor Virtual Account <strong>' . $no_va . '</strong>. Dengan petunjuk pembayaran sebagai berikut:<br>' . $url_slip . '<br>';
        } else if ($kode_status == '200') {
            $text_email = 'Terima kasih telah melakukan pembayaran untuk order Anda dengan nomor <strong>#' . $id_order . '</strong>.<br>Anda telah membeli tiket pertunjukan <strong>' . $judul . '</strong> dengan nomor tempat duduk <strong>' . $nomor_tiket . '</strong>.<br>Selamat menyaksikan pertunjukan Wayang Orang Sriwedari.<br>';
        } else if ($kode_status == '202') {
            $text_email = 'Anda telah melewati batas pembayaran untuk order Anda dengan nomor <strong>#' . $id_order . '</strong>.<br>Pembelian tiket <strong>Pertunjukan ' . $judul . '</strong> Anda akan dibatalkan.';
        }
        $mailContent = '<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
          <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
          <!DOCTYPE html>
          <html>
          <head>
              <title></title>
              <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
              <meta name="viewport" content="width=device-width, initial-scale=1">
              <meta http-equiv="X-UA-Compatible" content="IE=edge" />

              <style type="text/css">

                  @media screen {

                      @font-face {

                          font-family: "Quicksand";

                          font-style: normal;

                          font-weight: 400;

                      }



                      @font-face {

                          font-family: "Quicksand";

                          font-style: normal;

                          font-weight: 700;

                      }



                      @font-face {

                          font-family: "Quicksand";

                          font-style: italic;

                          font-weight: 400;

                      }



                      @font-face {

                          font-family: "Quicksand";

                          font-style: italic;

                          font-weight: 700;

                      }

                  }



                  body, table, td, a {

                      -webkit-text-size-adjust: 100%;

                      -ms-text-size-adjust: 100%;

                  }



                  table { border-collapse: collapse !important; }



                  table, td {

                      mso-table-lspace: 0pt;

                      mso-table-rspace: 0pt;

                  }



                  img {

                      border: 0;

                      height: auto;

                      line-height: 100%;

                      outline: none;

                      text-decoration: none;

                      -ms-interpolation-mode: bicubic;

                  }



                  body {

                      height: 100% !important;

                      margin: 0 !important;

                      padding: 0 !important;

                      width: 100% !important;

                  }



                  /* iOS BLUE LINKS */

                  a[x-apple-data-detectors] {

                      color: inherit !important;

                      text-decoration: none !important;

                      font-size: inherit !important;

                      font-family: inherit !important;

                      font-weight: inherit !important;

                      line-height: inherit !important;

                  }



                  /* MOBILE STYLES */

                  @media screen and (max-width:600px) {

                      h1 {

                          font-size: 32px !important;

                          line-height: 32px !important;

                      }

                  }



                  /* ANDROID CENTER FIX */

                  div[style*="margin: 16px 0;"] { margin: 0 !important; }



                  .pre-header {

                      padding: 22px 0 0;

                      background: #026CB6;

                          background-size: auto;

                      background-size: 100% 200%;

                  }



                  .header {

                      padding: 30px 30px 0 30px;

                      background: #fff;

                  }



                  .img-email {

                      display: block;

                      border: 0px;

                      width: 35%;

                  }



                  .content {

                      padding: 30px;

                      background: #fff;

                      color: #666666;

                      font-family: "Quicksand";

                      font-size: 16px;

                      font-weight: 400;

                      line-height: 25px;

                  }



                  .footer {

                      background: #f9f4ae;

                      font-size: 14px;

                      text-align: center;

                      padding: 15px;

                  }

              </style>

          </head>



          <body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">

              <table border="0" cellpadding="0" cellspacing="0" width="100%">

                  <tr>

                      <td align="center" class="pre-header">

                          

                          <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                              <tr>


                              </tr>

                          </table>

                      </td>

                  </tr>

                  <tr>

                      <td align="center">

                          <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                              <tr>

                                  <td class="content">

                                      <p style="margin: 0;">

                                          Halo <span style="color: #026CB6 !important;font-weight: 600;">' . $nama_lengkap . '</span>,<br><br>

                                          ' . $text_email . '

                                      </p>

                                  </td>

                              </tr>

                              <tr>

                                  <td class="content">

                                      <p style="margin: 0;">

                                          Salam,

                                          <br><br>Admin Wayang Orang Sriwedari

                                      </p>

                                  </td>

                              </tr>

                          </table>

                      </td>

                  </tr>

                  <tr>

                      <td align="center" style="padding: 10px 0;">

                          <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                              <tr>

                                  <td class="content footer">

                                      <p style="margin: 0;">Hubungi kami jika Anda menemui masalah atau membutuhkan bantuan.</p>

                                  </td>

                              </tr>

                          </table>

                      </td>

                  </tr>

              </table>

          </body>

          </html>';


        $mail->Body = $mailContent;
        $terkirim = $mail->send();

        if (!$terkirim) echo "Terjadi kesalahan saat pengiriman email: " . $mail->ErrorInfo;

        return $terkirim;
    }
}
