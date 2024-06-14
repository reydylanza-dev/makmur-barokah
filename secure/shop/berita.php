<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
	    <meta charset="UTF-8">
	    <title>Berita | Makmur Barokah</title>
		<link rel="icon" href="../img/files/favicon.png" type="image/png">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/themify-icons.css">
    	<link rel="stylesheet" href="../css/flaticon.css">
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    	<link rel="stylesheet" href="../vendors/owl-carousel/owl.carousel.min.css">
    	<link rel="stylesheet" href="../vendors/animate-css/animate.css">
    	<link rel="stylesheet" href="../css/style2.css">
    	<link rel="stylesheet" href="../css/responsive.css">
        <link rel="stylesheet" href="../css/ionicons.min.css">
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
    <body class="bg-light">
        <nav class="navbar navbar-expand-lg navbar-light bg-website">
            <div class="container">
                <a class="navbar-brand logo_h" href="#"><img src="../img/files/logo-wht.png" style="width:15%" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa fa-newspaper-o fa-1-5x text-white"></i>
                            </a>
                        </li>
                        <li class="nav-item submenu dropdown ml-3">
                            <a href="#" class="nav-link dropdown-toggle text-white" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Akun</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="../dashboard">Transaksi <i class="fa fa-shopping-bag" aria-hidden="true"></i></a></li>
                                <li class="nav-item"><a class="nav-link" href="../reset-password.php">Reset Password <i class="fa fa-edit"></i></a></li>
                                <li class="nav-item"><a class="nav-link" href="../logout.php">Log Out <i class="fa fa-sign-out"></i></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="nav-scroller bg-white shadow-sm">
            <div class="container-fluid pt-2 pb-2">
                <a href="./">Halaman Utama</a> > Berita
            </div>
        </div>

        <?php
            // URL API dengan parameter query
            $url = 'https://berita-indo-api-next.vercel.app/api/cnbc-news/syariah';

            // Inisiasi cURL
            $ch = curl_init();

            // Set opsi cURL
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Eksekusi cURL dan ambil respons
            $response = curl_exec($ch);

            // Tutup cURL
            curl_close($ch);

            // Parse respons JSON
            $data = json_decode($response, true);

            // Cek apakah parsing berhasil
            if ($data && isset($data['data'])) {
                // Ambil semua berita
                $newsItems = $data['data'];
                echo "<div class='container mt-4'>";
                echo "<div class='row'>";
                foreach ($newsItems as $news) {
                    // Ambil detail berita
                    $title = $news['title'];
                    $link = $news['link'];
                    $contentSnippet = $news['contentSnippet'];
                    $isoDate = $news['isoDate'];
                    $imageSmall = $news['image']['small'];
                    $date = date('F j, Y', strtotime($isoDate));
                    
                    // Tampilkan berita dalam card Bootstrap
                    echo "<div class='col-md-6 col-lg-4 mb-4'>";
                    echo "<div class='card'>";
                    echo "<img src='{$imageSmall}' class='card-img-top' alt='News image'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'><a href='{$link}' class='text-decoration-none text-orange'>{$title}</a></h5>";
                    echo "<p class='card-text'>{$contentSnippet}</p>";
                    echo "<p class='card-text'><small class='text-muted'>Published on: {$date}</small></p>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                echo "</div>";
                echo "</div>";
            } else {
                echo "<div class='container mt-4'>";
                echo "<div class='alert alert-danger' role='alert'>";
                echo "Unable to retrieve news data.";
                echo "</div>";
                echo "</div>";
            }
        ?>

        <div class="bg-website mt-5 p-2">
            <div class="container pt-4">
                <div class="row text-white">
                    <div class="col-sm-12 col-lg-3">
                        <h5>Informasi</h5>
                        <ul class="list-unstyled">
                            <li><a href="#"><i class="fa fa-angle-right"></i> Kontak</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Syarat dan Ketentuan</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Kebijakan Pengguna</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Lokasi Kami</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-12 col-lg-3">
                        <h5>Belanja</h5>
                        <ul class="list-unstyled">
                            <li><a href="#"><i class="fa fa-angle-right"></i> Semua Produk</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Produk Baru</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Produk Spesial</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Semua Kategori</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Customer Care</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-12 col-lg-3">
                        <h5>Tentang Kami</h5>
                        <ul class="list-unstyled">
                            <li><a href="#"><i class="fa fa-map-marker"></i> Jl. Jetis Kulon Gg. VII No.9, RT.008/RW.04, Wonokromo, Kec. Wonokromo, Surabaya, Jawa Timur 60243</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> makmur@catkay.co.id</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-12 col-lg-3">
                        <h5>Media Sosial</h5>
                        <ul class="list-unstyled">
                            <li><a href="#"><i class="fa fa-facebook"></i> Facebook</a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i> Twitter</a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i> Instagram</a></li>
                            <li><a href="#"><i class="fa fa-whatsapp"></i> Whatsapp</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <script src="../js/scripts.js"></script>
    </body>
</html>
