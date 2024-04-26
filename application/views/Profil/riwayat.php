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
</style>


<div class="bg-white">
    <div class="container p-3">
        <h4 class="text-danger" style="font-weight: bold; margin-left: 10px">Riwayat Transaksi</h4>
        <hr class="bg-danger border-3 border-top border-danger" />
        <div class="card border-1 shadow-sm p-3">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <img src="<?php echo base_url('assets/img/bimabungkus.jpg'); ?>" class="cover-riwayat">
                </div>
                <div class="col-lg-9 col-6">
                    <h4 style="font-weight: bold;">Bima Bungkus</h4>
                    <h6 style="margin-bottom: 20px;">Rabu, 20 April 2024</h6>
                    <div class="d-flex flex-column">
                        <h6>#123456789</h6>
                        <h6 style="margin-bottom: 20px;">2 Tiket</h6>
                        <h4 style="font-weight: bold;">Rp. 200.000</h4>
                    </div>
                </div>
            </div>
            <div class="position-absolute top-0 end-0 mt-2 d-none d-lg-block" style="margin-right: 20px;">
                <div class="card border-0 bg-success p-1">
                    <medium style="color: #ffffff;">Lunas</medium>
                </div>
            </div>
            <div class="position-absolute bottom-0 end-0 mb-2 d-none d-lg-block" style="margin-right: 20px;">
                <div class="btn btn-main">Lihat Detail</div>
            </div>
            <div class="mb-3 mt-3 ms-auto d-lg-none">
                <div class="card border-0 bg-success p-1 text-end" style="width: fit-content;">
                    <medium style="color: #ffffff;">Lunas</medium>
                </div>
            </div>
            <div class="btn btn-main d-lg-none"> Lihat Detail</div>
        </div>
    </div>
</div>