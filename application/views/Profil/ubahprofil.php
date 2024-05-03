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
        <h5 class="text-danger" style="font-weight: bold; margin-left: 10px">Edit Profil</h5>
        <hr class="bg-danger border-3 border-top border-danger" />

        <form id="ubahUser">
            <div class="mb-3 mx-3">
                <input type="text" class="form-control" name="id_user" value="<?= $profil->id_user ?>" hidden />
            </div>
            <div class="mb-3 mx-3">
                <label for="nama_lengkap">Nama</label>
                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="<?= $profil->nama_lengkap ?>">
            </div>
            <div class="mb-3 mx-3">
                <label for="nama_lengkap">Username</label>
                <input type="text" class="form-control" name="username" id="username" value="<?= $profil->username ?>">
            </div>
            <div class="mb-3 mx-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $profil->email ?>">
            </div>
            <div class="mb-3 mx-3">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $profil->alamat ?>">
            </div>
            <div class="text-end mx-3">
                <button class="btn btn-main" type="button" id="btn-ubah-profil" value="Simpan Perubahan" onclick="editProfil()">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function gantiPassword() {
        let id_user = Cookies.get('id_user');
        window.location.href = "<?php echo site_url('gantipassword/') ?>"; + id_user
    }

    function editProfil() {
        $('#btn-ubah-profil').val("Simpan...");

        var nama = $('#nama_lengkap').val();
        var email = $('#email').val();
        var username = $('#password').val();

        if (nama === '' || email === '' || username === '') {
            Swal.fire({
                title: 'Error',
                text: 'Data tidak boleh ada yang kosong',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return; // Menghentikan eksekusi jika ada field yang kosong
        }

        $.ajax({
            url: '<?php echo base_url() ?>editProfil',
            type: 'POST',
            data: $('#ubahUser :input').serialize(),
            dataType: 'JSON',
            success: function(data) {
                Swal.fire({
                    title: 'Success',
                    text: 'Data berhasil diubah',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    let id_user = Cookies.get('id_user');
                    location.href = "<?= base_url('profil/') ?>" + id_user
                });
            },
            error: function(jqXHR, textStatus, thrownError) {
                Swal.fire({
                    title: 'Error',
                    text: 'Gagal Mengubah Profil',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    location.reload();
                });
            }

        });
    }
</script>