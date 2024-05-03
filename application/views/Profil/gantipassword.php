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

        <form id="ubahPassword">
            <div class="mb-3 mx-3">
                <input type="text" class="form-control" id="id_user" name="id_user" value="<?= $profil->id_user ?>" hidden />
            </div>
            <div class="mb-3 mx-3">
                <label for="pass_baru">Password Baru</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3 mx-3">
                <label for="pass_ulang">Ulangi Password Baru</label>
                <input type="password" class="form-control" id="pass_ulang" name="pass_ulang">
            </div>
            <div class="text-end mx-3">
                <button class="btn btn-main" type="button" id="btn-ubah-pass" value="Simpan Perubahan" onclick="editPassword()">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function editPassword() {
        $('#btn-ubah-pass').val("Simpan...");

        var password = $('#password').val();
        var pass_ulang = $('#pass_ulang').val();

        if (password === '' || pass_ulang === '') {
            Swal.fire({
                title: 'Error',
                text: 'Harap isi semua field',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return; // Menghentikan eksekusi jika ada field yang kosong
        }

        // Memeriksa apakah password dan konfirmasi password sama
        if (password !== pass_ulang) {
            Swal.fire({
                title: 'Error',
                text: 'Password yang Anda masukkan tidak cocok',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return; // Menghentikan eksekusi jika password tidak cocok
        }

        $.ajax({
            url: '<?php echo base_url() ?>editPassword',
            type: 'POST',
            data: $('#ubahPassword').serialize(),
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