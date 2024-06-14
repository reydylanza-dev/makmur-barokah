<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}

include '../koneksi.php';
if(isset($_GET['id'])){
    $pid = $_GET['id'];

    $aaa = "SELECT * FROM transaksi WHERE transaction_id = '$pid'";
    $result = mysqli_query($koneksi, $aaa);
    

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $username_invoice = $row['username'];
        $transaksi_id_invoice = $row['transaction_id'];
        $nama_produk_invoice = $row['nama_produk'];
        $jumlah_invoice = $row['jumlah'];
        $harga_barang_invoice = $row['harga_barang'];
        $biaya_ongkir_invoice = $row['biaya_ongkir'];
        $total_harga_invoice = $row['total_harga'];
        $tanggal_transaksi_invoice_raw = $row['tanggal_transaksi'];
        $tanggal_transaksi_invoice = date('d-m-Y', strtotime($tanggal_transaksi_invoice_raw));
        $status_invoice = $row['status'];
        $trx_id_invoice = $row['trx_id'];
        $metode_pembayaran_invoice = $row['metode_pembayaran'];
        $channel_pembayaran_invoice = $row['channel_pembayaran'];
    }
}

$bbb = "SELECT * FROM pengguna WHERE username = '$username_invoice'";
$result = mysqli_query($koneksi, $bbb);


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $nama_invoice = $row['nama_lengkap'];
    $hp_invoice   = $row['no_hp'];
    $alamat_invoice = $row['alamat_lengkap'];
    $kecamatan_invoice = $row['kecamatan'];
    $kabupatenkota_invoice = $row['kabupaten_kota'];
    $provinsi_invoice = $row['provinsi'];
    $pos_invoice = $row['kode_pos'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Invoice #<?php echo htmlspecialchars($transaksi_id_invoice); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <style type="text/css">
        body {
            margin-top: 20px;
            color: #484b51;
        }

        .text-secondary-d1 {
            color: #728299 !important;
        }

        .page-header {
            margin: 0 0 1rem;
            padding-bottom: 1rem;
            padding-top: .5rem;
            border-bottom: 1px dotted #e2e2e2;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -ms-flex-align: center;
            align-items: center;
        }

        .page-title {
            padding: 0;
            margin: 0;
            font-size: 1.75rem;
            font-weight: 300;
        }

        .brc-default-l1 {
            border-color: #dce9f0 !important;
        }

        .ml-n1,
        .mx-n1 {
            margin-left: -.25rem !important;
        }

        .mr-n1,
        .mx-n1 {
            margin-right: -.25rem !important;
        }

        .mb-4,
        .my-4 {
            margin-bottom: 1.5rem !important;
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, .1);
        }

        .text-grey-m2 {
            color: #888a8d !important;
        }

        .text-success-m2 {
            color: #86bd68 !important;
        }

        .font-bolder,
        .text-600 {
            font-weight: 600 !important;
        }

        .text-110 {
            font-size: 110% !important;
        }

        .text-blue {
            color: #478fcc !important;
        }

        .pb-25,
        .py-25 {
            padding-bottom: .75rem !important;
        }

        .pt-25,
        .py-25 {
            padding-top: .75rem !important;
        }

        .bgc-default-tp1 {
            background-color: rgba(121, 169, 197, .92) !important;
        }

        .bgc-default-l4,
        .bgc-h-default-l4:hover {
            background-color: #f3f8fa !important;
        }

        .page-header .page-tools {
            -ms-flex-item-align: end;
            align-self: flex-end;
        }

        .btn-light {
            color: #757984;
            background-color: #f5f6f9;
            border-color: #dddfe4;
        }

        .w-2 {
            width: 1rem;
        }

        .text-120 {
            font-size: 120% !important;
        }

        .text-primary-m1 {
            color: #4087d4 !important;
        }

        .text-danger-m1 {
            color: #dd4949 !important;
        }

        .text-blue-m2 {
            color: #68a3d5 !important;
        }

        .text-orange-m2 {
            color: #e87918 !important;
        }

        .text-150 {
            font-size: 150% !important;
        }

        .text-60 {
            font-size: 60% !important;
        }

        .text-grey-m1 {
            color: #7b7d81 !important;
        }

        .align-bottom {
            vertical-align: bottom !important;
        }
    </style>
</head>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <div class="page-content container">
        <div class="page-header text-blue-d2">
            <h1 class="page-title text-secondary-d1">
                Invoice
                <small class="page-info">
                    <i class="fa fa-angle-double-right text-80"></i>
                    ID: #<?php echo htmlspecialchars($transaksi_id_invoice); ?>
                </small>
            </h1>
            <div class="page-tools">
                <div class="action-buttons">
                    <a class="btn bg-white btn-light mx-1px text-95" href="#" id="print-btn" data-title="Print">
                        <i class="mr-1 fa fa-print text-orange-m2 text-120 w-2"></i>
                        Print
                    </a>
                </div>
            </div>
        </div>
        <div class="container px-0">
            <div class="row mt-4">
                <div class="col-12 col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center text-150">
                                <img class="center1" src="../img/files/logo.png" style="width:15%" alt=""><br>
                                <span class="text-default-d3">Toko Makmur Barokah</span>
                            </div>
                        </div>
                    </div>

                    <hr class="row brc-default-l1 mx-n1 mb-4" />
                    <div class="row">
                        <div class="col-sm-6">
                            <div>
                                <span class="text-sm text-grey-m2 align-middle">To:</span>
                                <span class="text-600 text-110 text-blue align-middle"><?php echo htmlspecialchars($nama_invoice); ?></span>
                            </div>
                            <div class="text-grey-m2">
                                <div class="my-1">
                                <?php echo htmlspecialchars($alamat_invoice); ?>, <?php echo htmlspecialchars($kecamatan_invoice); ?>
                                </div>
                                <div class="my-1">
                                <?php echo htmlspecialchars($kabupatenkota_invoice); ?>, <?php echo htmlspecialchars($provinsi_invoice); ?>
                                </div>
                                <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b
                                        class="text-600"><?php echo htmlspecialchars($hp_invoice); ?></b></div>
                            </div>
                        </div>

                        <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                            <hr class="d-sm-none" />
                            <div class="text-grey-m2">
                                <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                    Invoice
                                </div>
                                <div class="my-2"><i class="fa fa-circle text-orange-m2 text-xs mr-1"></i> <span
                                        class="text-600 text-90">ID:</span> #<?php echo htmlspecialchars($transaksi_id_invoice); ?></div>
                                <div class="my-2"><i class="fa fa-circle text-orange-m2 text-xs mr-1"></i> <span
                                        class="text-600 text-90">Issue Date:</span> <?php echo htmlspecialchars($tanggal_transaksi_invoice); ?></div>
                                <div class="my-2"><i class="fa fa-circle text-orange-m2 text-xs mr-1"></i> <span
                                        class="text-600 text-90">Status:</span> <span
                                        class="badge badge-success badge-pill px-25">Terbayar</span></div>
                            </div>
                        </div>

                    </div>
                    <div class="mt-4">
                        <div class="row text-600 text-white bgc-default-tp1 py-25">
                            <div class="d-none d-sm-block col-1">#</div>
                            <div class="col-9 col-sm-5">Nama Produk</div>
                            <div class="d-none d-sm-block col-4 col-sm-2">Jumlah</div>
                            <div class="d-none d-sm-block col-sm-2">Harga per Unit</div>
                            <div class="col-2">Total Harga</div>
                        </div>
                        <div class="text-95 text-secondary-d3">
                            <div class="row mb-2 mb-sm-0 py-25">
                                <div class="d-none d-sm-block col-1">1</div>
                                <div class="col-9 col-sm-5"><?php echo htmlspecialchars($nama_produk_invoice); ?></div>
                                <div class="d-none d-sm-block col-2">1</div>
                                <div class="d-none d-sm-block col-2 text-95">Rp. <?php echo number_format($harga_barang_invoice, 0, ',', '.'); ?></div>
                                <div class="col-2 text-secondary-d2">Rp. <?php echo number_format($harga_barang_invoice, 0, ',', '.'); ?></div>
                            </div>
                        </div>
                        <div class="row border-b-2 brc-default-l2"></div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">

                            </div>
                            <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                                <div class="row my-2">
                                    <div class="col-7 text-right">
                                        SubTotal
                                    </div>
                                    <div class="col-5">
                                        <span class="text-120 text-secondary-d1">Rp. <?php echo number_format($harga_barang_invoice, 0, ',', '.'); ?></span>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-7 text-right">
                                        PPN (0%)
                                    </div>
                                    <div class="col-5">
                                        <span class="text-110 text-secondary-d1">Rp. 0</span>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-7 text-right">
                                        Ongkos Kirim
                                    </div>
                                    <div class="col-5">
                                        <span class="text-110 text-secondary-d1">Rp. <?php echo number_format($biaya_ongkir_invoice, 0, ',', '.'); ?></span>
                                    </div>
                                </div>
                                <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                    <div class="col-7 text-right">
                                        Total Bayar
                                    </div>
                                    <div class="col-5">
                                        <span class="text-150 text-success-d3 opacity-2">Rp. <?php echo number_format($total_harga_invoice, 0, ',', '.'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="mb-4">
                            <span class="text-secondary-d1 text-105">Kami sangat menghargai kepercayaan Anda dalam berbelanja di toko kami.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('print-btn').addEventListener('click', function () {
            window.print();
        });

        document.getElementById('pdf-btn').addEventListener('click', function () {
            import('https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js').then(jsPDF => {
                const { jsPDF: JSPDF } = jsPDF;
                const doc = new JSPDF();

                // Ambil konten yang ingin di-export ke PDF
                const content = document.body.innerHTML;

                // Tambahkan konten ke dokumen PDF
                doc.text(content, 10, 10);

                // Unduh dokumen sebagai PDF
                doc.save('document.pdf');
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">

    </script>
</body>

</html>