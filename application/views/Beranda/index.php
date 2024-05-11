<style>
    /* Gambar beranda pada layar desktop (lebar lebih besar dari 992px) */
    .gambar-beranda {
        width: 550px;
        /* Ukuran lebar gambar untuk desktop */
        height: auto;
        padding: 12px;
    }

    /* Gambar beranda pada layar yang lebih kecil dari desktop (maksimum lebar 992px) */
    @media (max-width: 992px) {
        .gambar-beranda {
            width: 100%;
            /* Mengisi lebar kontainer */
            max-width: 350px;
            /* Tetapkan lebar maksimum untuk gambar */
            height: auto;
            padding: 12px;
        }
    }


    .text-beranda {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 12px;
        color: #341AFF;
        font-weight: bold;
        margin-top: 10px;

    }

    .keterangan-wayang {
        text-align: justify;
        margin-right: 10px;
    }

    .btn-tonton {
        background-color: #5243FF;
        color: #ffffff;
        margin-top: 12px;
        margin-bottom: 10px;

    }

    .btn-tonton:hover {
        background-color: #2c25b3;
        /* Mengubah warna latar belakang saat hover */
        color: #fff;
        /* Mengubah warna teks saat hover */
    }

    .gambar-banner {
        height: 200px;
        width: auto;
    }
</style>

<div class="bg-light py-3">
    <div class="bg-white container">
        <div class="row">
            <div class="col-lg-6">
                <img src="<?php echo base_url('assets/img/wayang_beranda.jpg'); ?>" class="gambar-beranda">
            </div>
            <div class="col-lg-6">
                <h3 class="text-beranda">Wayang Orang Sriwedari</h3>
                <div class="keterangan-wayang">Wayang Orang merupakan kesenian yang berasal dari mangkunegaran, yang diciptakan oleh Pangeran Adipati Arya I pada tahun (1757 – 1795). Seperti Wayang Orang Sriwedari (WOS) yang sudah melegenda sejak dulu. Kesenian WOS menyajikan cerita pewayangan dengan seni tari, musik pedalangan dan drama.</br> </br> Pertunjukan Wayang Orang Sriwedari dapat disaksikan setiap hari dengan cerita yang berbeda-beda. Biaya Tiket Masuk Rp20.000</div>
                <div class="btn btn-tonton rounded-3 d-flex allign-items-center justify-content-center" onclick="bukaPertunjukan()">Tonton Sekarang</div>
            </div>
        </div>
    </div>
    <div class="bg-white mt-4 p-3">
        <div class="owl-carousel owl-theme">
            <img src="<?php echo base_url('assets/img/banner1.png'); ?>" class="gambar-banner">
            <img src="<?php echo base_url('assets/img/banner2.png'); ?>" class="gambar-banner">
            <img src="<?php echo base_url('assets/img/banner3.png'); ?>" class="gambar-banner">
        </div>

    </div>
</div>

<script>
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        autoplay: true, // Aktifkan autoplay
        autoplayTimeout: 5000,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 2
            }
        }
    })

    function bukaPertunjukan() {
        window.location.href = "<?php echo site_url('pertunjukan') ?>";
    }
</script>