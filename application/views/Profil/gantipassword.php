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
        <h5 class="text-danger" style="font-weight: bold; margin-left: 10px">Ubah Password</h5>
        <hr class="bg-danger border-3 border-top border-danger" />

        <form>
            <div class="mb-3 mx-3">
                <label for="exampleInputEmail1" class="form-label">Password Baru</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 mx-3">
                <label for="exampleInputEmail1" class="form-label">Ulangi Password Baru</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="text-end mx-3">
                <button class="btn btn-main" onclick="editProfil()">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function gantiPassword() {
        // Redirect ke halaman profil
        window.location.href = "<?php echo site_url('gantipassword'); ?>";
    }

    function editProfil() {
        // Redirect ke halaman profil
        window.location.href = '<?= base_url('ubahprofil') ?>';
    }
</script>