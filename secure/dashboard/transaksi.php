<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}
?>

<!doctype html>
<html>
    <head>
	    <meta charset="UTF-8">
	    <title>Transaksi <?php echo htmlspecialchars($_SESSION["username"]); ?> | Makmur Barokah</title>
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
                    <a class="navbar-brand logo_h" href="../shop"><img src="../img/files/logo.png" style="width:15%" alt=""></a>
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
                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 inputform">Transaksi <?php echo htmlspecialchars($_SESSION["username"]); ?></h3>
                <?php
                    if (!isset($_SESSION["username"])) {
                        die("Error: User not logged in."); // Hentikan jika tidak ada username dalam session
                    }

                    $user_trans = $_SESSION["username"];
                    require_once "../koneksi.php";

                    // Menggunakan prepared statement untuk mengamankan query
                    $stmt = $koneksi->prepare("SELECT * FROM transaksi WHERE username = ?");
                    $stmt->bind_param("s", $user_trans);
                    $stmt->execute();
                    $result = $stmt->get_result();

                ?>
                <table class="table table-bordered bg-light box-shadow--16dp">
			        <thead>
				        <tr>
					        <th>Waktu Transaksi</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
					        <th>Total</th>
                            <th>Status Transaksi</th>
                            <th>Cetak Kwitansi</th>
				        </tr>
			        </thead>
			        <tbody>
                        <?php
                            $transactions = [];
                            while ($row = $result->fetch_assoc()) {
                                $row['formatted_date'] = date("d-m-Y H:i:s", strtotime($row["tanggal_transaksi"]));
                                $transactions[] = $row;
                            }

                            // Urutkan berdasarkan formatted_date dari terbaru ke terlama
                            usort($transactions, function ($a, $b) {
                                return strtotime($b['tanggal_transaksi']) - strtotime($a['tanggal_transaksi']);
                            });

                            // Tampilkan hasil yang telah diurutkan
                            foreach ($transactions as $row) {
                                echo "<tr>
                                    <td>".$row['formatted_date']."</td>
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
                                echo "</td>";
                                if ($row['status'] == "1"){ 
                                    echo '<td><a href="kwitansi.php?id=' . $row["transaction_id"] . '" class="hvnb"><button style="cursor:pointer;" type="button" class="btn btn-orange">Cetak Kwitansi <i class="fa fa-print" aria-hidden="true"></i></button></a></td>';
                                } else {
                                    echo '<td><a href="kwitansi.php?id=' . $row["transaction_id"] . '" class="hvnb"><button style="cursor:not-allowed;" type="button" class="btn btn-orange" disabled>Cetak Kwitansi <i class="fa fa-print" aria-hidden="true"></i></button></a></td>';
                                }
                                echo "</tr>";
                            }
                        ?>
			        </tbody>
		        </table>
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
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const deleteButtons = document.querySelectorAll('.delete-button');
                deleteButtons.forEach(button => {
                    button.addEventListener('click', function(event) {
                        const confirmDelete = confirm('Anda yakin ingin menghapus transaksi? \nPastikan bahwa transaksi tersebut tidak penting.');
                        if (confirmDelete) {
                            const pin = prompt('Masukkan PIN Keamanan:');
                            if (pin !== null) {
                                // Jika pengguna memasukkan PIN dan menekan OK
                                if (pin !== '12345') {
                                    event.preventDefault();
                                    alert('PIN salah. Transaksi tidak dihapus.');
                                }
                            } else {
                                // Jika pengguna membatalkan prompt PIN
                                event.preventDefault();
                            }
                        } else {
                            // Jika pengguna membatalkan konfirmasi penghapusan
                            event.preventDefault();
                        }
                    });
                });
            });
        </script>
    </body>
</html>