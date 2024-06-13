<?php
session_start();

if(!isset($_SESSION["adminloggedin"]) || $_SESSION["adminloggedin"] !== true){
    header("location: ../login.php");
    exit;
}

include 'koneksi.php';
if(isset($_GET['id'])){
    $pid = $_GET['id'];

    $aaa = "SELECT * FROM transaksi WHERE transaction_id = '$pid'";
    $result = mysqli_query($koneksi, $aaa);
    

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $username_checks = $row['username'];
        $transaksi_id_header = $row['transaction_id'];
        $nama_produk_checks = $row['nama_produk'];
        $jumlah_checks = $row['jumlah'];
        $harga_barang_checks = $row['harga_barang'];
        $biaya_ongkir_checks = $row['biaya_ongkir'];
        $total_harga_checks = $row['total_harga'];
        $tanggal_transaksi_checks_raw = $row['tanggal_transaksi'];
        $tanggal_transaksi_checks = date('d-m-Y H:i:s', strtotime($tanggal_transaksi_checks_raw));
        $status_checks = $row['status'];
        $trx_id_checks = $row['trx_id'];
        $metode_pembayaran_checks = $row['metode_pembayaran'];
        $channel_pembayaran_checks = $row['channel_pembayaran'];

        $_SESSION['transdetail_sesi'] = $row['transaction_id'];
    }
}

$bbb = "SELECT * FROM pengguna WHERE username = '$username_checks'";
$result = mysqli_query($koneksi, $bbb);


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $nama_checks = $row['nama_lengkap'];
    $hp_checks   = $row['no_hp'];
    $alamat_checks = $row['alamat_lengkap'];
    $kecamatan_checks = $row['kecamatan'];
    $kabupatenkota_checks = $row['kabupaten_kota'];
    $provinsi_checks = $row['provinsi'];
    $pos_checks = $row['kode_pos'];
}

mysqli_close($koneksi);

?>

<!doctype html>
<html>
    <head>
	    <meta charset="UTF-8">
	    <title>Transaksi | Admin Makmur Barokah</title>
		<link rel="icon" href="../img/files/favicon.png" type="image/png">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/themify-icons.css">
    	<link rel="stylesheet" href="../css/flaticon.css">
    	<link rel="stylesheet" href="../vendors/fontawesome/css/all.min.css">
    	<link rel="stylesheet" href="../vendors/owl-carousel/owl.carousel.min.css">
    	<link rel="stylesheet" href="../vendors/animate-css/animate.css">
    	<link rel="stylesheet" href="../css/style.css">
    	<link rel="stylesheet" href="../css/responsive.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
		<style type="text/css">
            table.table-bordered{
                border: 1px solid #000000;
            }

            .box-shadow--2dp {
                box-shadow: 0 2px 2px 0 rgba(0, 0, 0, .14), 0 3px 1px -2px rgba(0, 0, 0, .2), 0 1px 5px 0 rgba(0, 0, 0, .12)
            }

            .box-shadow--3dp {
                box-shadow: 0 3px 4px 0 rgba(0, 0, 0, .14), 0 3px 3px -2px rgba(0, 0, 0, .2), 0 1px 8px 0 rgba(0, 0, 0, .12)
            }

            .box-shadow--4dp {
                box-shadow: 0 4px 5px 0 rgba(0, 0, 0, .14), 0 1px 10px 0 rgba(0, 0, 0, .12), 0 2px 4px -1px rgba(0, 0, 0, .2)
            }

            .box-shadow--6dp {
                box-shadow: 0 6px 10px 0 rgba(0, 0, 0, .14), 0 1px 18px 0 rgba(0, 0, 0, .12), 0 3px 5px -1px rgba(0, 0, 0, .2)
            }

            .box-shadow--8dp {
                box-shadow: 0 8px 10px 1px rgba(0, 0, 0, .14), 0 3px 14px 2px rgba(0, 0, 0, .12), 0 5px 5px -3px rgba(0, 0, 0, .2)
            }

            .box-shadow--16dp {
                box-shadow: 0 16px 24px 2px rgba(0, 0, 0, .14), 0 6px 30px 5px rgba(0, 0, 0, .12), 0 8px 10px -5px rgba(0, 0, 0, .2)
            }

            .inputform{
			    font-family: "Poppins", sans-serif;
                color: #000;
		    }
        </style>
    </head>
    <body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light shadow mb-5 rounded">
                <div class="container">
                    <a class="navbar-brand logo_h" href="index.php"><img src="../img/files/logo.png" style="width:15%" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Akun</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="../reset-password.php">Reset Password <i class="fa fa-edit"></i></a></li>
                                <li class="nav-item"><a class="nav-link" href="../logout.php">Log Out <i class="fa fa-sign-out"></i></a></li>
                            </ul>
                        </li>
                        </ul>
                    </div>
                </div>
            </nav>
        <div class="container">
            <div class="row h-100 justify-content-center align-items-center">
                <h3 class="mb-2 pb-2 pb-md-0 mb-md-4 inputform">Detail Transaksi : ID Trx. <?php echo "$transaksi_id_header"; ?></h3>
                <div class="container my-1">
                    <div class="card card-body shadow-sm mb-4">
                        <div class="row d-flex justify-content-center mb-4">
                            <div class="col-sm-12 col-lg-8">
                                <div class="row">
                                    <div class="col-sm-12 col-lg-6">
                                        <label class="">Nama Pembeli/Penerima :</label>
                                        <input type="text" class="form-control mb-2" value="<?php echo $nama_checks ?>" readonly>
                                        <label class="">Username Akun Pembeli :</label>
                                        <input type="text" class="form-control mb-2" value="<?php echo $username_checks ?>" readonly>
                                        <label class="">Nomor Handphone :</label>
                                        <input type="number" class="form-control mb-2" value="<?php echo $hp_checks; ?>" readonly>
                                        <label class="">Alamat Lengkap :</label>
                                        <input type="text" class="form-control mb-2" value="<?php echo $alamat_checks; ?>" readonly>
                                        <label class="">Kecamatan :</label>
                                        <input type="text" class="form-control mb-2" value="<?php echo $kecamatan_checks; ?>" readonly>
                                        <label class="">Kabupaten/Kota :</label>
                                        <input type="text" class="form-control mb-2" value="<?php echo $kabupatenkota_checks; ?>" readonly>
                                        <label class="">Provinsi :</label>
                                        <input type="text" class="form-control mb-2" value="<?php echo $provinsi_checks; ?>" readonly>
                                        <label class="">Kode Pos :</label>
                                        <input type="number" class="form-control mb-2" value="<?php echo $pos_checks; ?>" readonly>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <label class="">Nama Produk :</label>
                                        <input type="text" name="products[]" class="form-control mb-2" value="<?php echo $nama_produk_checks; ?>" readonly>
                                        <label class="">Jumlah Pembelian :</label>
                                        <input type="number" name="quantities[]" class="form-control mb-2" value="<?php echo $jumlah_checks; ?>" readonly>
                                        <label class="">Harga Pembelian (belum termasuk ongkir) :</label>
                                        <input type="text" name="" class="form-control mb-2" value="Rp.<?php echo number_format($harga_barang_checks, 0, ',', '.'); ?>" readonly>
                                        <label class="">Total Pembelian :</label>
                                        <input type="text" name="" class="form-control mb-2" value="Rp.<?php echo number_format($total_harga_checks, 0, ',', '.'); ?>" readonly>
                                        <label class="">Waktu Transaksi :</label>
                                        <input type="text" name="" class="form-control mb-2" value="<?php echo $tanggal_transaksi_checks; ?>" readonly>
                                        <label class="">Metode Pembayaran :</label>
                                        <?php if ($status_checks !== null): ?>
                                            <input type="text" name="" class="form-control mb-2" value="<?php echo $metode_pembayaran_checks; ?>" readonly>
                                        <?php else: ?>
                                            <input type="text" name="" class="form-control mb-2" value="Data Tidak Tersedia" readonly>
                                        <?php endif; ?>
                                        <label class="">Channel Pembayaran :</label>
                                        <input type="text" name="" class="form-control mb-2" value="<?php echo $channel_pembayaran_checks; ?>" readonly>
                                        <label class="">Status Pembayaran :</label>
                                        <?php if ($status_checks == "0"): ?>
                                            <button style="cursor:text;" type="button" class="form-control mb-2 btn btn-danger">Menunggu Pembayaran</button>
                                        <?php elseif ($status_checks == "1"): ?>
                                            <button style="cursor:text;" type="button" class="form-control mb-2 btn btn-success">Lunas</button>
                                        <?php elseif ($status_checks == "2"): ?>
                                            <button style="cursor:text;" type="button" class="form-control mb-2 btn btn-warning">Expired/Cancel</button>
                                        <?php else: ?>
                                            <button style="cursor:text;" type="button" class="form-control mb-2 btn btn-secondary">Status Tidak Diketahui</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <center>
                            <div class="row d-flex justify-content-center">
                                <div class="col-sm-12 col-lg-4">
                                    <?php if ($status_checks == "0"): ?>
                                        <a href="change_payment_status.php?trx_id=<?php echo htmlspecialchars($trx_id_checks); ?>" class="hvnb">
                                            <button class="btn bg-website btn-success text-white btn-block">Perbarui Status Pembayaran</button>
                                        </a>
                                    <?php else: ?>
                                        <button style="cursor:not-allowed;" class="btn bg-website btn-secondary text-white btn-block" disabled>Perbarui Status Pembayaran</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <br>
                        </center>
                        <center>
                        <div class="row d-flex justify-content-center">
                            <div class="col-sm-12 col-lg-4">
                                <a href="transaksi.php" class="hvnb">
                                    <button class="btn btn-outline-primary btn-block">
                                        Kembali Ke Menu
                                    </button>
                                </a>
                            </div>
                        </div>
                        </center>
                    </div>
                </div>

                <!-- <table class="table table-bordered bg-light box-shadow--16dp">
			        <thead>
				        <tr>
					        <th>Waktu Transaksi</th>
					        <th>Username</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
					        <th>Total</th>
                            <th>Status</th>
                            <th>Cek Detail/Ubah Status</th>
				        </tr>
			        </thead>
			        <tbody>
                    <?php while ($row=mysqli_fetch_array($query)) {
		                /* $transact_date = $row["tanggal_transaksi"];
                        $newTransactDate = date("d-m-Y H:i:s", strtotime($transact_date));
                        echo "<tr>
                                <td>".$newTransactDate."</td>
                                <td> <a href='profile-detail.php?id=" . $row["username"] . "' class='hvnb'>".$row['username']."</td>
                                <td>".$row['nama_produk']."</td>
                                <td>".$row['jumlah']."</td>
                                <td>Rp.".number_format($row['total_harga'], 0, ',', '.')."</td>
                                <td>";
                                    if ($row['status'] == "0"){ 
                                        echo '<button style="cursor:text;" type="button" class="btn btn-danger">Menunggu Pembayaran</button>';
                                    } else if ($row['status'] == "1"){ 
                                        echo '<button style="cursor:text;" type="button" class="btn btn-success">Lunas</button>';
                                    } else if ($row['status'] == "2"){ 
                                        echo '<button style="cursor:text;" type="button" class="btn btn-warning">Expired/Cancel</button>';
                                    } else {
                                        echo '<button style="cursor:text;" type="button" class="btn btn-secondary">Status Tidak Diketahui</button>';
                                    }                           
                                echo "</td>
                                <td><a href='transaction-detail.php?id=" . $row["transaction_id"] . "' class='hvnb'><button style=\"cursor:hand;\" type=\"button\" class=\"btn btn-orange\">Cek Detail/Ubah Status</button></td>
                            </tr>"; */
                    }
                    ?>
			        </tbody>
		        </table> -->
            </div>
        </div>
		<script src="../js/jquery-2.2.4.min.js"></script>
		<script src="../js/popper.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/stellar.js"></script>
		<script src="../vendors/owl-carousel/owl.carousel.min.js"></script>
		<script src="../js/jquery.ajaxchimp.min.js"></script>
		<script src="../js/waypoints.min.js"></script>
		<script src="../js/mail-script.js"></script>
		<script src="../js/contact.js"></script>
		<script src="../js/jquery.form.js"></script>
		<script src="../js/jquery.validate.min.js"></script>
		<script src="../js/mail-script.js"></script>
		<script src="../js/theme.js"></script>
    </body>
</html>