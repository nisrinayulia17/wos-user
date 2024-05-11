<style>
    .img-detail-riwayat {
        width: 400px;
        height: 400px;
        margin-top: 25px;
        margin-left: 20px;
    }

    .img-detail-riwayat-mob {
        width: 200px;
        height: 200px;
        margin-top: 20px;

    }

    table {
        border-collapse: collapse;
        width: 300px;
        margin-left: 40px;
        margin-top: 15px;
        /* Sesuaikan lebar tabel sesuai kebutuhan */
    }

    th,
    td {
        padding: 5px;
        text-align: left;
    }
</style>

<div class="bg-light py-3">
    <div class="bg-white container p-3 d-none d-lg-block" id="RiwayatContent">
        <div class="text-center">
            <h3 class="mt-3" style="font-weight: bold; margin-left: 10px">Detail Transaksi</h3>
            <hr class="bg-secondary border-3 border-top border-secondary" />
        </div>
        <div class="container px-3">
            <div class="row">
                <div class="col-6">
                    <img src="<?= base_url('assets/img/bimabungkus.jpg') ?>" class="img-detail-riwayat">
                </div>
                <div class="col-6 mt-4">
                    <h3 style="font-weight: bold;"><?= $detail->judul ?></h3>
                    <h5 class="mt-3"><?= date('d M Y', strtotime($detail->tanggal)) ?></h5>
                    <h5 class="mb-4 mt-3"> Pukul <?= date('H:i', strtotime($detail->waktu)) ?></h5>
                    <h5><?php
                        if ($detail->kode_status == "201") {
                            echo '<div class="badge bg-secondary">Belum Bayar</div>';
                        } else if ($detail->kode_status == "202") {
                            echo '<div class="badge bg-danger">Kadaluwarsa</div>';
                        } else if ($detail->kode_status == "200") {
                            echo '<div class="badge bg-success">Pembayaran Berhasil</div>';
                        } else {
                            echo '<div class="badge bg-danger">Gagal Bayar</div>';
                        }
                        ?></h5>
                    <table>
                        <tr>
                            <th width="40%">Id Order </th>
                            <td width="5%">:</td>
                            <td style="font-weight: bold;">#<?= $detail->id_order ?></td>
                        </tr>
                        <tr>
                            <th width="40%">Jumlah Tiket </th>
                            <td width="5%">:</td>
                            <td><?= $detail->jml_tiket ?> Tiket</td>
                        </tr>
                        <tr>
                            <th width="40%">Nomor Kursi </th>
                            <td width="5%">:</td>
                            <td><?= $detail->nomor_tiket ?></td>
                        </tr>
                        <tr>
                            <th width="40%">Total Harga </th>
                            <td width="5%">:</td>
                            <td>Rp<?= number_format($detail->total_bayar, 0, ',', '.') ?></td>

                        </tr>
                        <tr>
                            <th width="40%">Tgl Pembelian </th>
                            <td width="5%">:</td>
                            <td><?= date('d M Y', strtotime($detail->tgl_pembelian)) ?></td>
                        </tr>
                        <tr>
                            <th width="40%">No. VA </th>
                            <td width="5%">:</td>
                            <td><?= isset($detail->no_va) ? $detail->no_va : '-' ?></td>
                        </tr>
                        <tr>
                            <th width="40%">Metode Pembayaran </th>
                            <td width="5%">:</td>
                            <td><?= $detail->jenis_pembayaran ?></td>
                        </tr>
                    </table>
                    <div class="text-end">
                        <button type="button" class="btn btn-primary mt-3" onclick="unduhPDF()">Unduh Transaksi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white container p-3 d-lg-none">
        <div class="text-center">
            <h3 class="mt-3" style="font-weight: bold; margin-left: 10px">Detail Transaksi</h3>
            <hr class="bg-secondary border-3 border-top border-secondary" />
        </div>
        <div class="container">
            <div class="text-center">
                <img src="<?= base_url('assets/img/bimabungkus.jpg') ?>" class="img-detail-riwayat-mob">
                <h5 class="mt-3"><?php
                                    if ($detail->kode_status == "201") {
                                        echo '<div class="badge bg-secondary">Belum Bayar</div>';
                                    } else if ($detail->kode_status == "202") {
                                        echo '<div class="badge bg-danger">Kadaluwarsa</div>';
                                    } else if ($detail->kode_status == "200") {
                                        echo '<div class="badge bg-success">Pembayaran Berhasil</div>';
                                    } else {
                                        echo '<div class="badge bg-danger">Gagal Bayar</div>';
                                    }
                                    ?></h5>
                <table>
                    <tr>
                        <th width="40%">Id Order </th>
                        <td width="5%">:</td>
                        <td style="font-weight: bold;">#<?= $detail->id_order ?></td>
                    </tr>
                    <tr>
                        <th width="40%">Jumlah Tiket </th>
                        <td width="5%">:</td>
                        <td><?= $detail->jml_tiket ?> Tiket</td>
                    </tr>
                    <tr>
                        <th width="40%">Nomor Kursi </th>
                        <td width="5%">:</td>
                        <td><?= $detail->nomor_tiket ?></td>
                    </tr>
                    <tr>
                        <th width="40%">Total Harga </th>
                        <td width="5%">:</td>
                        <td>Rp<?= number_format($detail->total_bayar, 0, ',', '.') ?></td>

                    </tr>
                    <tr>
                        <th width="40%">Tgl Pembelian </th>
                        <td width="5%">:</td>
                        <td><?= date('d M Y', strtotime($detail->tgl_pembelian)) ?></td>
                    </tr>
                    <tr>
                        <th width="40%">No. VA </th>
                        <td width="5%">:</td>
                        <td><?= isset($detail->no_va) ? $detail->no_va : '-' ?></td>
                    </tr>
                    <tr>
                        <th width="40%">Metode Pembayaran </th>
                        <td width="5%">:</td>
                        <td><?= $detail->jenis_pembayaran ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    function unduhPDF() {
        var element = document.getElementById('RiwayatContent');

        // Konfigurasi untuk html2pdf
        var opt = {
            margin: 0.5, // Jarak margin dalam inci
            filename: 'bukti_pembelian.pdf', // Nama file PDF yang diunduh
            image: {
                type: 'jpeg',
                quality: 0.98
            }, // Jenis dan kualitas gambar
            html2canvas: {
                scale: 2
            }, // Skala gambar
            jsPDF: {
                unit: 'in',
                format: 'letter',
                orientation: 'landscape' // Perubahan: "landscape" bukan "lanscape"
            } // Jenis kertas dan orientasi
        };

        // Membuat PDF dari elemen
        html2pdf().set(opt).from(element).save();
    }
</script>