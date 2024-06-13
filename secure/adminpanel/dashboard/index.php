<?php
session_start();

if(!isset($_SESSION["adminloggedin"]) || $_SESSION["adminloggedin"] !== true){
    header("location: ../login.php");
    exit;
}
?>

<!doctype html>
<html>
    <head>
	    <meta charset="UTF-8">
	    <title>Home | Admin Makmur Barokah</title>
		<link rel="icon" href="../img/files/favicon.png" type="image/png">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/themify-icons.css">
    	<link rel="stylesheet" href="../css/flaticon.css">
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    	<link rel="stylesheet" href="../vendors/owl-carousel/owl.carousel.min.css">
    	<link rel="stylesheet" href="../vendors/animate-css/animate.css">
    	<link rel="stylesheet" href="../css/style.css">
    	<link rel="stylesheet" href="../css/responsive.css">
        <link rel="stylesheet" href="../css/ionicons.min.css">
		<link rel="stylesheet" href="../css/style1.css">
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
                text-align: center;
		    }

            .bold-font{
			    font-family: "Poppins", sans-serif;
                font-weight: bold;
		    }

            .glyphicon-lg {
               font-size: 3em
           }

           .blockquote-box {
               border-right: 5px solid #E6E6E6;
               margin-bottom: 25px
           }

           .blockquote-box .square {
               width: 100px;
               min-height: 50px;
               margin-right: 22px;
               text-align: center !important;
               background-color: #E6E6E6;
               padding: 20px 0
           }

           .blockquote-box.blockquote-primary {
               border-color: #357EBD
           }

           .blockquote-box.blockquote-primary .square {
               background-color: #428BCA;
               color: #FFF
           }

           .blockquote-box.blockquote-success {
               border-color: #4CAE4C
           }

           .blockquote-box.blockquote-success .square {
               background-color: #5CB85C;
               color: #FFF
           }

           .blockquote-box.blockquote-info {
               border-color: #46B8DA
           }

           .blockquote-box.blockquote-info .square {
               background-color: #5BC0DE;
               color: #FFF
           }

           .blockquote-box.blockquote-warning {
               border-color: #EEA236
           }

           .blockquote-box.blockquote-warning .square {
               background-color: #F0AD4E;
               color: #FFF
           }

           .blockquote-box.blockquote-danger {
               border-color: #D43F3A
           }

           .blockquote-box.blockquote-danger .square {
               background-color: #D9534F;
               color: #FFF
           }
        </style>
    </head>
    <body>
	    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow mb-5 rounded">
            <div class="container">
                <a class="navbar-brand logo_h" href="#"><img src="../img/files/logo.png" style="width:15%" alt=""></a>
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
            <div class="container bootstrap snippets bootdey">
                <div class="row">
                    <div class="col-md-6">
                        <h2>Hai, <?php echo htmlspecialchars($_SESSION["adminusername"]); ?></h2>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <a href="addproduct.php">
                            <div class="blockquote-box blockquote-primary clearfix">
                                <div class="square pull-left">
                                    <i class="fa fa-plus glyphicon-lg"></i>
                                </div>
                                <h4>
                                    Tambahkan produk</h4>
                                <p>
                                    Tambahkan produk ke etalase utama website toko Makmur Barokah</a>
                                </p>
                            </div>
                        </a>
                        <a href="https://wa.me/+6282130040002">
                            <div class="blockquote-box blockquote-success clearfix">
                                <div class="square pull-left">
                                    <i class="fa fa-phone glyphicon-lg"></i>
                                </div>
                                <h4>
                                    Hubungi Admin</h4>
                                <p>
                                    Hubungi tim SDM jikalau mengalami kendala dengan aplikasi ini.
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="transaksi.php">
                            <div class="blockquote-box blockquote-info clearfix">
                                <div class="square pull-left">
                                    <i class="fa fa-book glyphicon-lg"></i>
                                </div>
                                <h4>
                                    Data Transaksi</h4>
                                <p>
                                    Cek semua transaksi dan ubah status transaksi pelanggan.
                                </p>
                            </div>
                        </a>
                        <a href="data-pelanggan.php">
                            <div class="blockquote-box blockquote-warning clearfix">
                                <div class="square pull-left">
                                    <i class="fa fa-address-book glyphicon-lg"></i>
                                </div>
                                <h4>
                                    Data Pelanggan</h4>
                                <p>
                                    Cek semua transaksi dan ubah status transaksi pelanggan.
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
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