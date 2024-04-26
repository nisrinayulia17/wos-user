<div class="modal fade" id="modalLogin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="row justify-content-center">
                <div class="col-lg-6 bg-info text-white d-none d-lg-block" style="background-image: url('<?= base_url('assets/demo/img/popup.png') ?>'); background-size: 100% 100%; background-repeat: no-repeat">
                    <h4 class="ms-5 mt-5">Wujudkan Rumah Impian Anda</h4>
                    <h4 class="ms-5 mb-3">Bersama RumahTinggal.id</h4>
                    <div class="container ms-5">
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-center mb-2"><span class="me-2">&#10003;</span> 500+ Desain
                                Berkualitas</li>
                            <li class="d-flex align-items-center mb-2"><span class="me-2">&#10003;</span> Harga Desain
                                Terjangkau</li>
                            <li class="d-flex align-items-center mb-2"><span class="me-2">&#10003;</span> Akses Mudah
                                dan Cepat</li>
                            <li class="d-flex align-items-center mb-2"><span class="me-2">&#10003;</span> One Stop
                                Solution</li>
                        </ul>
                    </div>
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
                                <div class="text-end">
                                    <a href="#" id="lupaKataSandiLink" onclick="showForgotPassword()">Lupa Kata Sandi?</a>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-primary w-100" type="button" id="login-button">Masuk</button>
                                </div>
                                <div class="text-center my-2 d-flex align-items-center">
                                    <hr class="flex-grow-1 border border-dark border-1" />
                                    <span class="px-3">atau</span>
                                    <hr class="flex-grow-1 border border-dark border-1" />
                                </div>
                                <div class="mt-2 mb-4">
                                    <button class="btn btn-outline-white border-dark w-100" type="button" id="button-addon2">
                                        <img src=<?php echo base_url('assets/demo/img/google.png'); ?> alt="Google Logo" width="30px" class="me-2" />
                                        <strong>Masuk Dengan Google</strong>
                                    </button>
                                </div>

                            </form>
                            <small>Dengan Mendaftar, Anda dinyatakan telah setuju dengan syarat & ketentuan
                                RumahTinggal.id </small>
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
</script>