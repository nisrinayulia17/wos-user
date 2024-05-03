<style>
    /* CSS untuk layout kursi */
    .kursi-layout {
        margin: 0 auto;
        padding: 10px;
    }

    .kursi-layout h2 {
        text-align: center;
        margin-bottom: 30px;
    }

    .seat-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .seat-row label {
        margin: 0 3px;
    }

    .seat {
        display: none;
        /* Sembunyikan input checkbox */
    }

    /* Gaya untuk tiket yang tersedia */
    .available {
        /* Tambahkan gaya sesuai keinginan Anda */
        background-color: #4CAF50;
        /* Hijau untuk tiket tersedia */
    }

    /* Gaya untuk tiket yang dipilih */
    .selected {
        /* Tambahkan gaya sesuai keinginan Anda */
        background-color: #FFC107;
        /* Kuning untuk tiket yang dipilih */
    }

    /* Gaya untuk tiket yang tidak tersedia */
    .unavailable {
        /* Tambahkan gaya sesuai keinginan Anda */
        background-color: #F44336;
        /* Merah untuk tiket tidak tersedia */
        pointer-events: none;
        /* Kursi tidak bisa diklik */
        cursor: not-allowed;
        /* Kursor berubah menjadi tanda silang */
    }

    /* Gaya untuk label kursi */
    label {
        padding: 5px 10px;
        border: 1px solid #ccc;
        /* background-color: #f2f2f2; */
        /* cursor: pointer; */
    }

    label:hover {
        background-color: #e0e0e0;
    }

    .cover-konfirmasi {
        width: 300px;
        height: 300px;
        margin-left: 18px;
    }
</style>


<div class="container p-3">
    <h2 class="text-center text-danger" style="font-weight: bold;">Pilih Tempat Duduk</h2>
    <hr class="bg-danger border-3 border-top border-danger" />
    <div class="row">
        <div class="col-10">
            <div class="kursi-layout px-4">
                <h2>Panggung</h2>
                <div class="seat-row">
                    <?php foreach ($columns1 as $kursi) : ?>
                        <input type="checkbox" id="kursi<?php echo $kursi['id_kursi']; ?>" name="selected_seats[]" value="<?php echo $kursi['nomor_kursi']; ?>" class="seat <?php echo ($kursi['status'] == 1) ? 'available' : 'unavailable'; ?>" <?php echo ($kursi['status'] == 1) ? '' : 'disabled'; ?>>
                        <label for="kursi<?php echo $kursi['id_kursi']; ?>" class="<?php echo ($kursi['status'] == 0) ? 'unavailable' : ''; ?>">
                            <?php echo $kursi['nomor_kursi']; ?>
                        </label>
                    <?php endforeach; ?>
                    <!-- Tambahkan kursi lainnya di sini -->
                </div>
                <div class="seat-row">
                    <?php foreach ($columns2 as $kursi) : ?>
                        <input type="checkbox" id="kursi<?php echo $kursi['id_kursi']; ?>" name="selected_seats[]" value="<?php echo $kursi['nomor_kursi']; ?>" class="seat <?php echo ($kursi['status'] == 1) ? 'available' : 'unavailable'; ?>" <?php echo ($kursi['status'] == 1) ? '' : 'disabled'; ?>>
                        <label for="kursi<?php echo $kursi['id_kursi']; ?>" class="<?php echo ($kursi['status'] == 0) ? 'unavailable' : ''; ?>">
                            <?php echo $kursi['nomor_kursi']; ?>
                        </label>
                    <?php endforeach; ?>
                    <!-- Tambahkan kursi lainnya di sini -->
                </div>
                <!-- Tambahkan baris kursi lainnya di sini -->
            </div>
        </div>
        <div class="col-2">
            <div class="card bg-white border-1 shadow-sm p-2">
                <div class="text-center mb-2">Rincian Tiket</div>
                <div class="mb-2">
                    <div style="font-weight: bold;">Tiket :</div>
                    <ul id="selectedSeatsList">
                        <!-- Kursi yang dipilih akan ditambahkan di sini menggunakan JavaScript -->
                    </ul>
                </div>
                <div class="mb-2">
                    <div style="font-weight: bold;">Jumlah : </div>
                    <div id="selectedTicketCount"></div>
                </div>
                <div class="btn btn-main" onclick="konfirmasiTiket()"> Konfirmasi</div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalKonfirmasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-2">
            <h4 class="text-center mb-4 mt-2" style="font-weight: bold;">Konfirmasi Pesanan</h4>
            <div class="row">
                <div class="col-lg-5">
                    <img src="<?php echo base_url('assets/img/bimabungkus.jpg'); ?>" class="cover-konfirmasi">
                </div>
                <div class="col-lg-7">
                    <h3 id="nama-pertunjukan" style="font-weight: bold;">Bima Bungkus</h3>
                    <div id="tanggal" class="mb-2">Senin, 20 Juli 2024</div>
                    <div id="waktu">Pukul 20.30 WIB</div>
                    <hr class="bg-dark border-3 border-top border-dark" />
                    <div class="mt-0" style="font-weight: bold;">Harga Tiket Satuan</div>
                    <div id="satuanTiket"><?= $tiket->harga ?></div>
                    <div class="mt-2" style="font-weight: bold;">Jumlah Tiket</div>
                    <div id="selectedTicketCount2"></div>
                    <div class="mt-2" style="font-weight: bold;">Nomor Kursi</div>
                    <ul id="selectedSeatsList2"></ul>
                    <div class="mt-2" style="font-weight: bold;">Total Bayar</div>
                    <div id="totalBayar"></div>
                    <div class="d-flex justify-content-center gap-4 mt-3 mb-3">
                        <div class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Batalkan Pesanan</div>
                        <div class="btn btn-main" id="bayarSekarang">Bayar Sekarang</div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-Z3ajUGrfxuj_xU5H"></script>

<script>
    function konfirmasiTiket() {
        // Hitung jumlah tiket yang dipilih
        var selectedCount = $('input[type="checkbox"]:checked').length;

        // Jika tidak ada tiket yang dipilih, tampilkan pesan peringatan
        if (selectedCount === 0) {
            alert('Harap pilih tempat duduk terlebih dahulu.');
        } else {
            // Lanjutkan ke proses konfirmasi
            modalKonfirmasi();
        }
    }

    function modalKonfirmasi() {
        $('#modalKonfirmasi').modal('show');
    }
    // Mendengarkan perubahan pada checkbox
    $('input[type="checkbox"]').change(function() {
        // Ambil nomor kursi dari label yang terkait dengan checkbox
        var seatNumber = $(this).next('label').text();

        // Jika checkbox dipilih, tambahkan nomor kursi ke dalam rincian tiket
        if ($(this).is(':checked')) {
            $('#selectedSeatsList').append('<li>' + seatNumber + '</li>');
            $('#selectedSeatsList2').append('<li>' + seatNumber + '</li>');
        } else {
            // Jika checkbox dibatalkan, hapus nomor kursi dari rincian tiket
            $('#selectedSeatsList li').each(function() {
                if ($(this).text() === seatNumber) {
                    $(this).remove();
                }
            });
        }
    });


    $('input[type="checkbox"]').change(function() {
        // Hitung jumlah tiket yang dipilih
        var selectedCount = $('input[type="checkbox"]:checked').length;

        // Tampilkan jumlah tiket yang dipilih
        $('#selectedTicketCount').text(selectedCount);
        $('#selectedTicketCount2').text(selectedCount);
    });

    $('input[type="checkbox"]').change(function() {
        // Hitung jumlah tiket yang dipilih
        var selectedCount = $('input[type="checkbox"]:checked').length;

        // Konversi ke bilangan bulat
        selectedCount = parseInt(selectedCount);

        // Tampilkan jumlah tiket yang dipilih
        $('#selectedTicketCount').text(selectedCount);
        $('#selectedTicketCount2').text(selectedCount);
    });


    $('input[type="checkbox"]').change(function() {
        var $checkbox = $(this);
        var $label = $checkbox.next('label');

        if ($checkbox.is(':checked')) {
            // Jika checkbox dipilih, tambahkan kelas "selected"
            $label.addClass('selected');
        } else {
            // Jika checkbox dibatalkan, hapus kelas "selected"
            $label.removeClass('selected');
        }
    });

    // Fungsi untuk menghitung total harga berdasarkan jumlah kursi yang dipilih
    function hitungTotalHarga() {
        // Ambil jumlah kursi yang dipilih
        var selectedCount = $('input[type="checkbox"]:checked').length;

        // Harga per kursi dari PHP
        var hargaSatuan = <?= $tiket->harga ?>;

        // Hitung total harga
        var totalBayar = selectedCount * hargaSatuan;

        // Tampilkan total harga
        $('#totalBayar').text("Rp" + totalBayar);
    }

    // Panggil fungsi hitungTotalHarga() saat terjadi perubahan pada checkbox
    $('input[type="checkbox"]').change(function() {
        // Hitung total harga
        hitungTotalHarga();
    });

    $('#bayarSekarang').on('click', function() {
        var id_user = Cookies.get('id_user');
        var satuanTiket = parseInt($('#satuanTiket').text());
        var selectedTicketCount2 = parseInt($('#selectedTicketCount2').text());
        var totalBayar = parseInt($('#totalBayar').text().replace('Rp', '').trim()); // Hilangkan 'Rp' dan spasi, lalu konversi ke integer
        var nomorTiket = [];
        $('#selectedSeatsList2 li').each(function() {
            nomorTiket.push($(this).text().trim());
        });
        $.ajax({
            type: "get",
            url: "<?php echo base_url() ?>api/getPenggunaBayar/" + id_user,
            dataType: "JSON",
            success: function(data) {
                if (data != null) {

                    $.ajax({
                        type: 'POST',
                        url: '<?= site_url() ?>api/bayarTagihan',
                        cache: false,
                        data: {
                            "nama_customer": data.nama_lengkap,
                            "email": data.email,
                            satuanTiket: satuanTiket,
                            selectedTicketCount2: selectedTicketCount2,
                            totalBayar: totalBayar,
                            nomorTiket: nomorTiket
                        },

                        success: function(data) {
                            //location = data;
                            // console.log('token = ' + data);


                            snap.pay(data, {

                                onSuccess: function(result) {
                                    updateKursi(nomorTiket);
                                    console.log(result.status_message);
                                    console.log(result);


                                },
                                onPending: function(result) {
                                    updateKursi(nomorTiket);
                                    console.log(result.status_message);


                                },
                                onError: function(result) {
                                    changeResult('error', result);
                                    console.log(result.status_message);

                                }
                            });
                        }
                    });
                }
            }
        })

    });

    function updateKursi(nomorTiket) {
        var id_user = Cookies.get('id_user');
        var nomorTiket = [];
        $('#selectedSeatsList2 li').each(function() {
            nomorTiket.push($(this).text().trim());
        });

        console.log("Data masukan sebelum dikirim:", nomorTiket);
        $.ajax({
            url: '<?php echo base_url() ?>api/updateKursi',
            type: 'POST',
            dataType: 'JSON',
            data: {
                nomorTiket: nomorTiket
            },
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error("Gagal memperbarui status kursi:", error);
            }
        });
    }
</script>