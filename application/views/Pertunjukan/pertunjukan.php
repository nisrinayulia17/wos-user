<style>
    .cover-tayangan {
        width: 450px;
        height: 600px;
        margin-left: 20px;
    }

    @media (max-width: 992px) {
        .cover-tayangan {
            width: 300px;
            height : 400px;
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
                <img src="<?php echo base_url('assets/img/bimabungkus.jpg'); ?>" class="cover-tayangan">
            </div>
            <div class="col-lg-6">
                <h2 class="judul-tayangan d-none d-lg-block">Bima Bungkus</h2>
                <h2 class="d-lg-none judul-tayangan text-center">Bima Bungkus</h2>
                <h6>Senin, 20 April 2024</h6>
                <h6>Pukul 20.30 WIB</h6>
                <div class="btn btn-beli rounded-3 d-none d-lg-block">Beli Tiket</div>
                <div class="btn btn-beli rounded-3 d-lg-none w-100">Beli Tiket</div>
                <h3 class="mt-4" style="font-weight: bold;">Sinopsis</h3>
                <div id="sinopsis">
                    Kisah bima bungkus adalah kisah pewayangan yang menceritakan tentang keluarnya sang Bima dari bungkus berkat bantuan Gajah Sena yang diutus para dewa. Gajah Sena yang bersatu dengan Bima dalam bungkus kemudian mampu mengeluarkan si Bima dari bungkus tersebut, Sehingga bima alias si Pandawa itu dikenal sebagai Bimasena.
                    Anak Pandu dan Kunti terlahir dalam bungkus yang kemudian dibuang ke hutan Krendawahana, Akibat tidak ada senjata yang mampu membuka bungkus tersebut. Destarata dengan akalnya menyuruh anggota Kurawa tuk memusnahkan melalui cara berpura-pura membantu membuka bungkus itu, namun tidak berhasil.
                    Gajahsena yang berwujud seperti gajah adalah utusan dari batara guru yang khawatir keadaan tersebut mampu menggoyahkan kestabilan kahyangan. Bungkus tersebut telah bertahun tahun tak bisa dibuka, dengan kekuatan Gajahsena, yang masuk jiwanya ke dalam bungkus dan bergabung bersama Bima, Akhirnya bungkus itu bisa terbuka.
                </div>
                <h3 class="mt-4" style="font-weight: bold;">Pemain</h3>
                <ul>
                    <li>Item pertama</li>
                    <li>Item kedua</li>
                    <li>Item ketiga</li>
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
</script>