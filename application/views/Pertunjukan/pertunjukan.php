<style>
    .cover-tayangan {
        width: 450px;
        height: 600px;
        margin-left: 20px;
    }

    @media (max-width: 992px) {
        .cover-tayangan {
            width: 300px;
            height: 400px;
        }
    }

    .judul-tayangan {
        margin-top: 10px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .btn-beli {
        background-color: #5243FF;
        color: #ffffff;
        margin-top: 12px;

    }

    .btn-beli:hover {
        background-color: #2c25b3;
        /* Mengubah warna latar belakang saat hover */
        color: #fff;
        /* Mengubah warna teks saat hover */
    }

    #sinopsis {
        text-align: justify;
    }

    ul {
        list-style-type: disc;

        /* Mengubah jenis bullets menjadi lingkaran */
    }
</style>

<div class="bg-white p-3">
    <div class="container">
        <h2 class="text-center text-danger" style="font-weight: bold;">Tayangan Hari Ini</h2>
        <hr class="bg-danger border-3 border-top border-danger" />
        <div class="row">
            <div class="col-lg-6">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($pertunjukan->gambar); ?>" class="cover-tayangan">
            </div>
            <div class="col-lg-6">
                <h2 class="judul-tayangan d-none d-lg-block"><?= $pertunjukan->judul ?></h2>
                <h2 class="d-lg-none judul-tayangan text-center"><?= $pertunjukan->judul ?></h2>
                <h6><?= date('d M Y', strtotime($pertunjukan->tanggal)) ?></h6>
                <h6>Pukul <?= date('H:i', strtotime($pertunjukan->waktu)) ?></h6>
                <div class="btn btn-beli rounded-3 d-none d-lg-block" onclick="cekLogin()">Beli Tiket</div>
                <div class="btn btn-beli rounded-3 d-lg-none w-100" onclick="cekLogin()">Beli Tiket</div>
                <h3 class="mt-4" style="font-weight: bold;">Sinopsis</h3>
                <div id="sinopsis">
                    <?php echo $pertunjukan->sinopsis ?>
                </div>
                <h3 class="mt-4" style="font-weight: bold;">Pemain</h3>
                <ul>
                    <?php foreach ($pemain as $p) : ?>
                        <li><?= $p->nama ?></li>
                    <?php endforeach; ?>
                </ul>

            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var content = document.getElementById("sinopsis");

        var contentText = content.textContent;
        var shortenedText = contentText.slice(0, 300);
        var fullText = contentText.slice(300);

        content.innerHTML = shortenedText + '<span id="showMore">... <a href="#" id="showMoreLink">Lihat Selengkapnya</a></span>';

        var showMoreLink = document.getElementById("showMoreLink");

        showMoreLink.addEventListener("click", function(event) {
            event.preventDefault();
            content.innerHTML = contentText + '<span id="hideMore"> <a href="#" id="hideMoreLink">Sembunyikan</a></span>';
            var hideMoreLink = document.getElementById("hideMoreLink");
            hideMoreLink.addEventListener("click", function(event) {
                event.preventDefault();
                content.innerHTML = shortenedText + '<span id="showMore">... <a href="#" id="showMoreLink">Lihat Selengkapnya</a></span>';
                showMoreLink = document.getElementById("showMoreLink");
                showMoreLink.addEventListener("click", function(event) {
                    event.preventDefault();
                    content.innerHTML = contentText + '<span id="hideMore"> <a href="#" id="hideMoreLink">Sembunyikan</a></span>';
                    hideMoreLink = document.getElementById("hideMoreLink");
                    hideMoreLink.addEventListener("click", function(event) {
                        event.preventDefault();
                        content.innerHTML = shortenedText + '<span id="showMore">... <a href="#" id="showMoreLink">Lihat Selengkapnya</a></span>';
                    });
                });
            });
        });
    });

    function pilihKursi() {
        location.href = "<?= base_url('pilih_kursi/') ?>"
    }

    function cekLogin() {
        // Mendapatkan id_user dari cookie
        var id_user = Cookies.get('id_user');

        // Cek apakah id_user telah ada atau tidak
        if (id_user) {
            // Jika id_user ada, pengguna sudah login
            pilihKursi(); // Lanjutkan ke halaman pilih kursi
        } else {
            // Jika id_user tidak ada, pengguna belum login
            alert("Anda harus login terlebih dahulu untuk membeli tiket.");
            // Atau arahkan ke halaman login dengan:
            // window.location.href = "halaman_login.html";
        }
    }
</script>