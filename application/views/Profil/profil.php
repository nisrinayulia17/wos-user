<style>
    .btn-main {
        background-color: #5243FF;
        color: #ffffff;
    }

    .btn-main:hover {
        background-color: #dcdcdc;
    }
</style>



<div class="bg-light py-3">
    <div class="bg-white container p-3">
        <h5 class="text-danger" style="font-weight: bold; margin-left: 10px">Profil Akun</h5>
        <hr class="bg-danger border-3 border-top border-danger" />

        <form>
            <fieldset disabled>
                <div class="mb-3 mx-3">
                    <label for="disabledTextInput" class="form-label">Nama</label>
                    <input type="text" id="nama" class="form-control" placeholder="<?php echo $profil->nama_lengkap; ?>">
                </div>
                <div class="mb-3 mx-3">
                    <label for="disabledTextInput" class="form-label">Username</label>
                    <input type="text" id="nama" class="form-control" placeholder="<?php echo $profil->username; ?>">
                </div>
                <div class="mb-3 mx-3">
                    <label for="disabledTextInput" class="form-label">Email</label>
                    <input type="text" id="email" class="form-control" placeholder="<?php echo $profil->email; ?>">
                </div>
                <div class="mb-3 mx-3">
                    <label for="disabledTextInput" class="form-label">Alamat</label>
                    <input type="text" id="alamat" class="form-control" placeholder="<?php echo $profil->alamat; ?>">
                </div>
            </fieldset>
        </form>
        <div class="text-end mx-3">
            <button class="btn btn-main" onclick="gantiPassword()">Ganti Password</button>
            <button class="btn btn-main" onclick="editProfil()">Edit Profil</button>
        </div>
    </div>
</div>

<script>
    function gantiPassword() {
        let id_user = Cookies.get('id_user');
        location.href = "<?= base_url('gantipassword/') ?>" + id_user
    }

    function editProfil() {
        let id_user = Cookies.get('id_user');
        location.href = "<?= base_url('ubahprofil/') ?>" + id_user
    }
</script>