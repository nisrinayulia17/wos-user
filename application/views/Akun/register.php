<style>
    .img-register {
        width: 450px;
        height: 430px;
    }
</style>

<div class="p-5">
    <div class="card bg-white shadow-sm p-2 px-3">
        <div class="row">
            <div class="col-lg-5 mt-1">
                <img src="<?php echo base_url('assets/img/cover_modal.jpg'); ?>" class="img-register">
            </div>
            <div class="col-lg-7">
                <h2 class="mb-0 fw-semibold">Buat Akun Baru</h2>
                <small class="mb-3"></small>
                Sudah Punya Akun?
                <a href="#" onclick="modalLogin()">ayo masuk</a>
                </small>
                <form action="<?= site_url('akuncontroller/process_register') ?>" id="frm-daftar">
                    <div class="form-floating mt-3 mb-2">
                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" />
                        <label for="nama_lengkap">Nama Lengkap</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" />
                        <label for="username">Username</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" />
                        <label for="email">Email</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Kata Sandi" />
                        <label for="password">Kata Sandi Baru</label>
                    </div>
                    <div class="mt-4 mb-3">
                        <button class="btn btn-main w-100" type="submit" id="btn-daftar">Daftar</button>

                    </div>
                </form>
                <small>Dengan Mendaftar, Anda dinyatakan telah setuju dengan syarat & kebijakan
                    yang berlaku </small>
            </div>

        </div>
    </div>
</div>