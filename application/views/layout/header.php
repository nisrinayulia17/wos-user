<style>
    .custom-dropdown-button {
        background-color: transparent;
        border: none;
        color: #000;
        /* Sesuaikan warna teks dengan yang diinginkan */
    }

    .custom-dropdown-button:active,
    .custom-dropdown-button:focus {
        outline: none;
        box-shadow: none;
    }

    small.d-block.mb-1 a {
        color: white;
        /* Set the color to white */
        text-decoration: none;
        /* Remove underline if you don't want it */
    }

    /* Style for visited links */
    small.d-block.mb-1 a:visited {
        color: white;
        /* Set the color to white for visited links */
    }

    .btn-main {
        background-color: #5243FF;
        color: #ffffff;
    }

    .btn-main:hover {
        background-color: #dcdcdc;
    }

    .nav-link:hover,
    .nav-link.active-home,
    .nav-link.active-pertunjukan,
    .nav-link.active-galeri,
    .nav-link.active-faq {
        color: #341AFF;
    }

    .nav-link {
        font-size: 17px;
    }

    .text-masuk {
        font-size: 17px;
    }

    .text-daftar {
        font-size: 17px;
        color: #ffffff;
    }

    .menu-ponsel{
        text-decoration: none;
        color: inherit;
    }
</style>


<nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="<?php echo base_url('assets/img/logo/logo2.png'); ?>" height="80" width="auto">
        </a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="toggler-icon top-bar"> </span>
            <span class="toggler-icon mid-bar"> <i class="fas fa-bars"></i></span>
            <span class="toggler-icon bottom-bar"> </i></span>
        </button>
        <div class="collapse navbar-collapse ms-lg-3" id="navbarSupportedContent">
            <div class="w-100 mt-3 mt-lg-0 d-flex flex-column-reverse justify-content-center flex-lg-row gap-2 justify-content-lg-between">
                <ul class="navbar-nav mt-lg-1 me-lg-auto mb-2 mb-lg-0 d-flex gap-2 p-0">
                    <li>
                        <hr class="d-lg-none border border-1 my-0 py-0 border-secondary">
                    </li>
                    <li class="nav-item text-center">
                        <a class="nav-link <?= ($title == "Beranda") ? 'active-home' : ''; ?>" aria-current="page" href="<?= base_url('beranda') ?>">Beranda</a>
                    </li>
                    <li>
                        <hr class="d-lg-none border border-1 my-0 py-0 border-secondary">
                    </li>
                    <li class="nav-item text-center text-lg-star">
                        <a class="nav-link <?= ($title == "Pertunjukan") ? 'active-pertunjukan' : ''; ?>" href="<?= base_url('pertunjukan') ?>">Pertunjukan</a>
                    </li>
                    <li>
                        <hr class="d-lg-none border border-1 my-0 py-0 border-secondary">
                    </li>
                    <li class="nav-item text-center text-lg-star">
                        <a class="nav-link <?= ($title == "Galeri") ? 'active-galeri' : ''; ?>" href="<?= base_url('galeri') ?>">Galeri</a>
                    </li>
                    <li>
                        <hr class="d-lg-none border border-1 my-0 py-0 border-secondary">
                    </li>
                    <li class="nav-item text-center text-lg-star">
                        <a class="nav-link <?= ($title == "FAQ") ? 'active-faq' : ''; ?>" href="<?= base_url('faq') ?>">FAQ</a>
                    </li>
                </ul>
                <div id="menu-login">
                    <div class="d-flex flex-column flex-lg-row gap-1 mt-1">
                        <a class="btn btn-outline-white d-none d-lg-block text-masuk" onclick="modalLogin()">
                            <span class="mx-2">Masuk</span>
                        </a>
                        <a class="btn btn-outline-white d-lg-none" data-bs-toggle="modal" data-bs-target="#modalLogin">Masuk</a>
                        <a class="btn btn-main rounded-3 fw-semibold d-none d-lg-block text-daftar" onclick="modalDaftar()">
                            <span class="mx-2">Daftar</span>
                        </a>
                    </div>
                </div>
                <!-- Bagian Menu Pengguna (dengan atribut style="display: none;" agar awalnya disembunyikan) -->
                <div id="menu-pengguna">
                    <div class="text-center">
                        <div class="dropdown d-none d-lg-block">
                            <button class="btn custom-dropdown-button dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Halo, <span id="nama_customer"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" onclick="profil()">Profil</a></li>
                                <li><a class="dropdown-item" onclick="riwayat()">Riwayat Transaksi</a></li>
                                <hr class="bg-secondary border-2 border-top border-secondary mx-2" />
                                <li><a class="dropdown-item" onclick="logout()">Keluar</a></li>
                            </ul>
                        </div>
                        <div class="accordion d-lg-none" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <div class="justify-content-center">Hai, Nama!</div>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <a href="<?= base_url('profil') ?>" class="menu-ponsel">Profil</a>
                                        <hr class="d-lg-none border border-1 my-0 py-0 border-secondary mt-2 mb-2">
                                        <a href="<?= base_url('riwayat') ?>" class="menu-ponsel">Riwayat</a>
                                        <hr class="d-lg-none border border-1 my-0 py-0 border-secondary mt-2 mb-2">
                                        <a>Keluar</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- <div class="d-flex flex-column flex-lg-row gap-1" id="menu-login">
                    <a class="btn btn-outline-white d-none d-lg-block" onclick="modalLogin()">
                        <span class="mx-2">Masuk</span>
                    </a>
                    <a class="btn btn-outline-white d-lg-none" data-bs-toggle="modal" data-bs-target="#modalLogin">Masuk</a>
                    <a class="btn btn-primary rounded-3 fw-semibold d-none d-lg-block" onclick="modalDaftar()"><span class="mx-2">Daftar</span></a>
                </div>
                <div id="menu-pengguna">
                    <div class="dropdown">
                        <button class="btn custom-dropdown-button dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Halo, <span id="nama_customer"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Profil</a></li>
                            <li><a class="dropdown-item" href="#">Keluar</a></li>
                        </ul>
                    </div>
                </div> -->
            </div>

        </div>
    </div>
</nav>

<!-- modal login -->
<div class="modal fade" id="modalLogin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="row justify-content-center">
                <div class="col-lg-6 bg-info text-white d-none d-lg-block" style="background-image: url('<?= base_url('assets/img/cover_modal.jpg') ?>'); background-size: 100% 100%; background-repeat: no-repeat">
                </div>
                <div class="col-lg-6 col-10 py-2">
                    <div class="row py-3 justify-content-center">
                        <div class="col-lg-10">
                            <div class="text-end">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <h2 class="mb-0 fw-semibold">Masuk Akun Anda</h2>
                            <small class="mb-3">
                                Belum Punya Akun?
                                <a href="#" onclick="modalDaftar()">ayo daftar</a>
                            </small>
                            <form action="" id="frm-login">
                                <div class="form-floating mt-3 mb-2">
                                    <input type="email" class="form-control" id="email_login" placeholder="Email" />
                                    <label for="email_login">Email</label>
                                </div>
                                <div class="form-floating mt-3 mb-3">
                                    <input type="password" class="form-control" id="password_login" placeholder="Kata Sandi" />
                                    <label for="password_login">Kata Sandi</label>
                                </div>
                                <div class="mt-4 mb-3">
                                    <button class="btn btn-main w-100" type="button" id="login-button">Masuk</button>
                                </div>
                            </form>
                            <small>Dengan Mendaftar, Anda dinyatakan telah setuju dengan syarat & kebijakan
                                yang berlaku </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal daftar -->
<div class="modal fade" id="modalDaftar" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="row justify-content-center">
                <div class="col-lg-6 bg-info text-white d-none d-lg-block" style="background-image: url('<?= base_url('assets/img/cover_modal.jpg') ?>'); background-size: 100% 100%; background-repeat: no-repeat">
                </div>
                <div class="col-lg-6 col-10 py-2">
                    <div class="row py-3 justify-content-center">
                        <div class="col-lg-10">
                            <div class="text-end">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <h2 class="mb-0 fw-semibold">Buat Akun Baru</h2>
                            <small class="mb-3"></small>
                            Sudah Punya Akun?
                            <a href="#" onclick="modalLogin()">ayo masuk</a>
                            </small>
                            <form action="" id="frm-daftar">
                                <div class="form-floating mt-3 mb-2">
                                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" />
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                </div>
                                <div class="form-floating mb-2">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" />
                                    <label for="email">Email</label>
                                </div>
                                <div class="form-floating mb-2">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Kata Sandi" />
                                    <label for="password">Kata Sandi Baru</label>
                                </div>
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password_ulang" name="password_ulang" placeholder="Ulangi Kata Sandi" />
                                    <label for="password_ulang">Ulangi Kata Sandi</label>
                                </div>
                                <div class="mt-4 mb-3">
                                    <button class="btn btn-main w-100" type="button" id="btn-daftar">Daftar</button>
                                </div>
                            </form>
                            <small>Dengan Mendaftar, Anda dinyatakan telah setuju dengan syarat & kebijakan
                                yang berlaku </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function modalLogin() {
        $('#modalLogin').modal('show');
    }

    function modalDaftar() {
        $('#modalLogin').modal('hide');
        $('#modalDaftar').modal('show');
    }

    function profil() {
        // Redirect ke halaman profil
        window.location.href = "<?php echo site_url('profil'); ?>";
    }

    function riwayat() {
        // Redirect ke halaman profil
        window.location.href = "<?php echo site_url('riwayat'); ?>";
    }
</script>