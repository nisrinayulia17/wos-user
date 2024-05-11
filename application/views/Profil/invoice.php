<style>
    #invoice {
        padding: 30px;
    }



    .invoice {

        position: relative;

        background-color: #FFF;

        min-height: 600px;

        padding: 30px;

        box-shadow: 0 7px 8px rgba(0, 0, 0, .05);

    }



    .invoice header {

        padding: 10px 0;

        margin-bottom: 20px;

        border-bottom: 1px solid rgba(0, 0, 0, 0.1);

    }



    .invoice .title-info {
        font-size: 15px;
    }



    .invoice .contacts {
        margin-bottom: 20px
    }



    .invoice .invoice-to .to {

        margin-top: 0;

        margin-bottom: 0;

        font-weight: 400;

        font-size: 22px;

    }



    .invoice .invoice-details .invoice-id {

        margin-top: 0;

        color: #026cb6;

        font-weight: 400;

    }



    .invoice a {
        color: #026cb6;
    }



    .invoice a:hover {
        color: #005693;
    }



    .invoice main .notices {

        padding-left: 10px;

        border-left: 5px solid #026cb6;

    }



    .invoice main .notices .notice {

        font-size: 14px;

    }



    .invoice table {

        width: 100%;

        border-collapse: collapse;

        border-spacing: 0;

    }



    .invoice table td,
    .invoice table th {

        padding: 15px;

        background: #d9eaf4;

        border-bottom: 2px solid #026cb6;

    }



    .invoice table th {

        white-space: nowrap;

        font-weight: 400;

        font-size: 16px;

        color: #026cb6;

    }



    .invoice table td h3 {

        margin: 0;

        font-weight: 400;

        color: #026cb6;

        font-size: 1.2em
    }



    .invoice table .item {

        background: #fff;

        font-size: 16px;

        padding: 10px 15px;

    }



    .invoice table .total {

        background: #026cb6;

        color: #fff !important;

        font-size: 1.2em;

    }



    .invoice table tbody tr:last-child td {

        border: none;

        border-bottom: 1px solid #aaa;

    }



    .invoice table tfoot tr td:first-child {
        border: none
    }



    .invoice table tfoot td {

        background: 0 0;

        border-bottom: none;

        white-space: nowrap;

        text-align: right;

        padding: 10px 15px;

        font-size: 1.1em;

        border-top: 1px solid #aaa
    }



    .invoice table tfoot tr:first-child td {
        border-top: none
    }



    .invoice table tfoot tr:last-child td {

        color: #026cb6;

        font-size: 1.25em;

        border-top: 1px solid #026cb6;

        font-weight: 400;

    }
</style>



<div id="invoice" style="margin-top: 60px;">

    <div class="invoice overflow-auto">

        <div id="sec-invoice" style="min-width: 600px">

            <header>

                <div class="row">

                    <div class="col">

                        <a target="_blank" href="<?= base_url() ?>">

                            <img src="<?= base_url('assets/img/logo/logo2.png') ?>" width="90px" data-holder-rendered="true" />

                        </a>

                    </div>

                </div>

            </header>

            <main>

                <div class="row contacts">

                    <div class="col invoice-to">

                        <div class="title-info">Ditagihkan Kepada:</div>

                        <h3 class="to">Nisrina Yulia</h3></h3>

                        <div class="email">nisyuliaa@gmail.com</div>

                    </div>

                    <div class="col invoice-details text-right">

                        <h3 class="invoice-id">#12345678912</h3>

                        <div class="date">Tanggal Diterbitkan: </div>

                    </div>

                </div>

                <table border="0" cellspacing="0" cellpadding="0">

                    <thead>

                        <tr>

                            <th class="text-center">DESKRIPSI DESAIN</th>

                            <th class="text-center" style="width: 18%;">PAKET</th>

                            <th class="text-center" style="width: 20%;">HARGA</th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td class="text-left item" style="font-size: 14px;">

                                <!-- <h3>

                                    <a target="_blank" href="<?= base_url('detail/') . $id_rumah ?>"><?= $nama_rumah ?></a>

                                </h3> -->

                            </td>

                            <td class="text-center item">aaaa</td>

                            <td class="text-right item">aaaaaa</td>

                        </tr>

                    </tbody>

                    <tfoot>

                        <tr>

                            <td></td>

                            <td>SUB TOTAL</td>

                            <td>aaaaa</td>

                        </tr>

                        <tr>

                            <td></td>

                            <td>DISKON PROMO aaaa</td>

                            <td>aaaaa</td>

                        </tr>

                        <tr>

                            <td></td>

                            <td>PPN 11%</td>

                            <td>aaaaa</td>

                        </tr>

                        <tr>

                            <td style="border-top: none;"></td>

                            <td>GRAND TOTAL</td>

                            <td class="total">aaaaa</td>

                        </tr>

                    </tfoot>

                </table>

                <!--<div class="transfer" style="position: absolute;top: 58%;">

                  	<div class="title-info">Lakukan pembayaran ke akun bank:</div>

                    <img src="<?= base_url('assets/img/mandiri.png') ?>" width="100px" style="padding: 5px 0;" />

                    <p>Nomor rekening: <span class="bold">137-00-1138387-0</span> a.n. <span class="bold">PT Baracipta Esa Engineering</span></p>

              	</div>-->

                <div class="notices">

                    <div class="title-info">Catatan:</div>

                    <div class="notice">Pembelian akan dibatalkan secara otomatis jika melebihi tanggal kadaluarsa</div>

                </div>

            </main>

        </div>

        <hr>

        <div class="toolbar hidden-print">

            <div class="text-right">

                <button class="btn btn-custom" id="btn-download"><i class="fa fa-file-pdf-o"></i> Download</button></a>

            </div>

        </div>

    </div>

</div>