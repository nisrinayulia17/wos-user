<style>
    .cover-riwayat {
        width: 200px;
        height: 200px;
    }

    @media (max-width: 992px) {
        .cover-riwayat {
            width: 150px;
            height: 150px;
        }
    }

    .batal-bayar-content {
        color: #D20000;
        font-size: 12px;
        font-weight: 500;
        margin-bottom: 3px;
        padding: 1px;
    }

    .tunggu-bayar-content {
        background-color: #FFFBEE;
        color: #FFB800;
        font-size: 12px;
        font-weight: 500;
        margin-bottom: 3px;
        padding: 1px;
        background-color: #EEFFEE;
    }

    .lunas-content {
        color: #009500;
        font-size: 12px;
        font-weight: 500;
        margin-bottom: 3px;
        padding: 1px;
        background-color: #EEFFEE;
    }
</style>


<div class="bg-white">
    <div class="container p-3">
        <h4 class="text-danger" style="font-weight: bold; margin-left: 10px">Riwayat Transaksi</h4>
        <hr class="bg-danger border-3 border-top border-danger" />
        <?php foreach ($transaksi as $trns) { ?>
            <div class="card border-1 shadow-sm p-3 mb-4">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($trns->gambar); ?>" class="cover-riwayat">
                    </div>
                    <div class="col-lg-9 col-6">
                        <h4 style="font-weight: bold;"><?= $trns->judul ?></h4>
                        <h6 style="margin-bottom: 20px;"><?= date('d M Y', strtotime($trns->tanggal)) ?></h6>
                        <div class="d-flex flex-column">
                            <h6 id="id_order">#<?= $trns->id_order ?></h6>
                            <h6><?= $trns->jml_tiket ?> Tiket</h6>
                            <h6 style="margin-bottom: 20px;"><?= $trns->nomor_tiket ?></h6>
                            <h4 style="font-weight: bold;">Rp<?= number_format($trns->total_bayar, 0, ',', '.') ?></h4>
                        </div>
                    </div>
                </div>
                <div class="position-absolute top-0 end-0 mt-2 d-none d-lg-block" style="margin-right: 20px;">
                    <?php
                    if ($trns->kode_status == "201") {
                        echo '<div class="badge bg-secondary">Belum Bayar</div>';
                    } else if ($trns->kode_status == "202") {
                        echo '<div class="badge bg-danger">Kadaluwarsa</div>';
                    } else if ($trns->kode_status == "200") {
                        echo '<div class="badge bg-success">Pembayaran Berhasil</div>';
                    } else {
                        echo '<div class="badge bg-danger">Gagal Bayar</div>';
                    }
                    ?>
                </div>
                <div class="position-absolute bottom-0 end-0 mb-2 d-none d-lg-block" style="margin-right: 20px;">
                    <div class="btn btn-main" onclick="detailRiwayat('<?php echo $trns->id_order ?>')">Lihat Detail</div>
                </div>
                <div class="mb-3 mt-3 ms-auto d-lg-none">
                    <?php
                    if ($trns->kode_status == "201") {
                        echo '<div class="badge bg-secondary">Belum Bayar</div>';
                    } else if ($trns->kode_status == "202") {
                        echo '<div class="badge bg-danger">Kadaluwarsa</div>';
                    } else if ($trns->kode_status == "200") {
                        echo '<div class="badge bg-success">Pembayaran Berhasil</div>';
                    } else {
                        echo '<div class="badge bg-danger">Gagal Bayar</div>';
                    }
                    ?>
                </div>
                <div class="btn btn-main d-lg-none" onclick="detailRiwayat('<?php echo $trns->id_order ?>')"> Lihat Detail</div>
            </div>
        <?php } ?>
        <?php if (empty($transaksi)) { ?>
            <div class="card card-body mx-3 mb-2 d-none d-lg-block" id="myCardBody" style="background-color: #FFFBEE ;">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-circle-exclamation fa-2x" style="color: orange;"></i>
                    <div class=" ms-3">Yah! Anda belum melakukan transaksi apapun. </br> <a href="<?= base_url('pertunjukan') ?>">Klik disini</a> untuk membeli tiket pertunjukan sekarang.
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>

<script>
    // function detailTiket(id_order) {
    //     $.ajax({
    //         url: 'api/getPembelianById/' + id_order,
    //         method: 'get',
    //         success: function(response) {
    //             // Parsing respons JSON
    //             var detailTiket = JSON.parse(response);

    //             // Mengisi konten modal dengan detail transaksi
    //             $('#order_id').text("#" + detailTiket.id_order);
    //             $('#judul').text(detailTiket.judul);
    //             $('#tanggal').text(detailTiket.tanggal);
    //             $('#jml_tiket').text(detailTiket.jml_tiket);
    //             $('#nomor_tiket').text(detailTiket.nomor_tiket);
    //             // Jika gambar disertakan dalam respons JSON
    //             if (detailTiket.gambar) {
    //                 $('#gambar').attr('src', 'data:image/jpeg;base64,' + detailTiket.gambar);
    //             }

    //             // Menampilkan modal
    //             $('#modalDetailTiket').modal('show');
    //         },
    //         error: function(xhr, status, error) {
    //             // Menangani kesalahan jika terjadi
    //             console.error(error);
    //         }
    //     });
    // }

    function detailRiwayat(id_order) {
        // var id_order = $('#id_order').text().replace("#", ""); // Menghilangkan karakter '#' dari teks yang diperoleh
        location.href = "<?= base_url('detail_transaksi/') ?>" + id_order
    }
</script>