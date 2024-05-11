<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PembelianModel extends CI_Model
{
    public $tabelOrder = "pembelian";

    public $tabelPembayaran = "pembayaran";

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Memuat library database
    }

    public function ubahStatusKursi($nomor_tiket, $kode_status)
    {
        $nomor_tiket_array = json_decode($nomor_tiket, true);

        if ($nomor_tiket_array === null) {
            // JSON tidak valid, lakukan penanganan kesalahan
            return false;
        }

        foreach ($nomor_tiket_array as $nomor) {
            // Mengubah status kursi sesuai dengan nilai status yang diberikan
            $this->PembelianModel->updateKursiByStatus($nomor, $kode_status);
        }
    }

    function updateKursiByStatus($nomor, $kode_status)
    {
        if ($kode_status == 200) {
            $new_status = "0"; // Kursi dipesan
        } else if ($kode_status == 201) {
            $new_status="0";
        } else if ($kode_status == 202) {
            $new_status = "1"; // Kursi diterima
        }

        // Memperbarui status kursi berdasarkan nomor tiket
        $this->db->set('status', $new_status);
        $this->db->where('nomor_kursi', $nomor);
        $this->db->update('kursi');
    }


    // public function updateKursi($nomor)
    // {
    //     // Memeriksa apakah array nomor tiket tidak kosong
    //     if (!empty($nomor)) {
    //         // Mengatur nilai status '0' untuk mengubah status kursi
    //         $val = array(
    //             'status' => '0'
    //         );

    //         // Melakukan update data ke database
    //         $this->db->where_in('nomor_kursi', $nomor)
    //             ->update('kursi', $val);

    //         // Mengembalikan jumlah baris yang terpengaruh oleh operasi update
    //         return $this->db->affected_rows();
    //     } else {
    //         // Jika array nomor tiket kosong, kembalikan 0 sebagai tanda tidak ada perubahan
    //         return 0;
    //     }
    // }

    // public function updateKursi2($nomor)
    // {
    //     // Memeriksa apakah array nomor tiket tidak kosong
    //     if (!empty($nomor)) {
    //         // Mengatur nilai status '0' untuk mengubah status kursi
    //         $val = array(
    //             'status' => '1'
    //         );

    //         // Melakukan update data ke database
    //         $this->db->where_in('nomor_kursi', $nomor)
    //             ->update('kursi', $val);

    //         // Mengembalikan jumlah baris yang terpengaruh oleh operasi update
    //         return $this->db->affected_rows();
    //     } else {
    //         // Jika array nomor tiket kosong, kembalikan 0 sebagai tanda tidak ada perubahan
    //         return 0;
    //     }
    // }

    function simpanOrder($id_user, $id_pertunjukan, $jmlTiket, $id_order, $nomorTiketJSON)
    {
        $val = array(
            'id_user' => $id_user,
            'id_pertunjukan' => $id_pertunjukan,
            'jml_tiket' => $jmlTiket,
            'tgl_pembelian' =>  date('Y-m-d'),
            'jam_pembelian' => date('H:i:s'),
            'id_order' => $id_order,
            'nomor_tiket' => $nomorTiketJSON,
            'status' => '0'
        );
        $this->db->insert($this->tabelOrder, $val);
    }

    function simpanPembayaran($data)
    {
        if ($data['id_order'] != '') {
            $value = array(
                'id_order' => $data['id_order'],
                'total_bayar' => $data['total_bayar'],
                'jenis_pembayaran' => $data['jenis_pembayaran'],
                'bank' => $data['bank'],
                'no_va' => $data['no_va'],
                'kode_status' => $data['kode_status'],
                'url_slip' => $data['url_slip'],
                'waktu_transaksi' => $data['waktu_transaksi']
            );
        }

        $this->db->insert($this->tabelPembayaran, $value);
    }

    function getPembelianById($id_order)
    {
        return $this->db->where('id_order', $id_order)
            ->get($this->tabelOrder)
            ->row();
    }

    function ubahStatusPembayaran($data)
    {

        $id_order = $data['id_order'];



        $value = array(

            'kode_status' => $data['kode_status'],

            'waktu_pembayaran' => $data['waktu_pembayaran']

        );



        $this->db->where('id_order', $id_order)->update($this->tabelPembayaran, $value);



        if ($data['kode_status'] == '200') {
            // Tindakan untuk kode status 200
            $this->db->query("UPDATE pembelian SET status = 1 WHERE id_order IN ('{$id_order}')");
        } elseif ($data['kode_status'] == '201') {
            // Tindakan untuk kode status 201
            $this->db->query("UPDATE pembelian SET status = 0 WHERE id_order IN ('{$id_order}')");
        } elseif ($data['kode_status'] == '202') {
            // Tindakan untuk kode status 202
            $this->db->query("UPDATE pembelian SET status = 2 WHERE id_order IN ('{$id_order}')");
        }
    }

    function getDataPembelian($id_order)
    {
        $this->db->select('pembelian.nomor_tiket, pembayaran.kode_status')
            ->from($this->tabelOrder)
            ->join('pembayaran', 'pembayaran.id_order = pembelian.id_order')
            ->where('pembelian.id_order', $id_order);

        $query = $this->db->get();
        $row = $query->row();

        return $row; // Mengembalikan hasil query
    }

    function getInvoiceTagihan($id_order)
    {
        $this->db->select('pembelian.*, pertunjukan.judul, pembayaran.kode_status, pembayaran.url_slip, pembayaran.no_va, user.nama_lengkap, user.email')
            ->from($this->tabelOrder)
            ->where("$this->tabelOrder.id_order", $id_order) // Menambahkan alias tabel pada klausa WHERE
            ->join('pertunjukan', 'pertunjukan.id_pertunjukan = pembelian.id_pertunjukan')
            ->join('pembayaran', 'pembayaran.id_order = pembelian.id_order')
            ->join('user', 'user.id_user = pembelian.id_user');

        $query = $this->db->get();
        $row = $query->row();

        return $row; // Mengembalikan hasil query
    }
}
