<?php
include 'koneksi.php';

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
        <title>Transaksi Diterima | Makmur Barokah</title>
        <link rel="icon" href="https://i.ibb.co.com/fDmwFRr/favicon.png" type="image/png">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <style>
            .modal-confirm {
                color: #636363;
                width: 425px;
                font-size: 14px;
            }

            .modal-confirm .modal-content {
                padding: 20px;
                border-radius: 5px;
                border: none;
            }

            .modal-confirm .modal-header {
                border-bottom: none;
                position: relative;
            }

            .modal-confirm h4 {
                text-align: center;
                font-size: 26px;
                margin: 30px 0 -15px;
            }

            .modal-confirm .form-control,
            .modal-confirm .btn {
                min-height: 40px;
                border-radius: 3px;
            }

            .modal-confirm .close {
                position: absolute;
                top: -5px;
                right: -5px;
            }

            .modal-confirm .modal-footer {
                border: none;
                text-align: center;
                border-radius: 5px;
                font-size: 13px;
            }

            .modal-confirm .icon-box {
                color: #fff;
                position: absolute;
                margin: 0 auto;
                left: 0;
                right: 0;
                top: -70px;
                width: 95px;
                height: 95px;
                border-radius: 50%;
                z-index: 9;
                background: #82ce34;
                padding: 15px;
                text-align: center;
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
            }

            .modal-confirm .icon-box i {
                font-size: 58px;
                position: relative;
                top: 3px;
            }

            .modal-confirm.modal-dialog {
                margin-top: 80px;
            }

            .modal-confirm .btn {
                color: #fff;
                border-radius: 4px;
                background: #82ce34;
                text-decoration: none;
                transition: all 0.4s;
                line-height: normal;
                border: none;
            }

            .modal-confirm .btn:hover,
            .modal-confirm .btn:focus {
                background: #6fb32b;
                outline: none;
            }

            .trigger-btn {
                display: inline-block;
                margin: 100px auto;
            }

            .navbar{
                padding-left: 15px;
                padding-right: 15px;
            }
        </style>
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#myModal').modal('show');
            });
        </script>
    </head>
    <body>
        <div id="myModal" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="icon-box">
                            <i class="material-icons">&#xE876;</i>
                        </div>
                        <h4 class="modal-title w-100">Terima Kasih!</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">Pembayaran Anda telah kami terima</p>
                        <br>
                        <p class="text-center">Anda akan diarahkan otomatis dalam.. <span id="penghitung">3 detik</span></p>
                    </div>
                </div>
            </div>
        </div>

        <?php
            include 'koneksi.php';
            if(isset($_GET['trx_id']) && isset($_GET['payment_method']) && isset($_GET['payment_channel'])) {
                $trx_id = $_GET['trx_id'];
                $metode_pembayaran = $_GET['payment_method'];
                $channel_pembayaran = $_GET['payment_channel'];
                
                // Pastikan session orderNumber telah diatur
                if (!isset($_SESSION['orderNumber'])) {
                    die("Order number is not set in the session.");
                }
            
                $orderNumber = $_SESSION['orderNumber'];
            
                // Query untuk update data menggunakan prepared statement
                $query = "UPDATE transaksi SET trx_id = ?, metode_pembayaran = ?, channel_pembayaran = ? WHERE transaction_id = ?";
            
                $stmt = $koneksi->prepare($query);
                if ($stmt === false) {
                    die("Prepare failed: " . $koneksi->error);
                }
            
                // Mengikat parameter ke dalam query
                $stmt->bind_param("sssi", $trx_id, $metode_pembayaran, $channel_pembayaran, $orderNumber);
            
                // Mengeksekusi statement dan menangani error jika terjadi
                if ($stmt->execute()) {
                    echo "";
                } else {
                    echo "Error: " . $stmt->error;
                }
            
                // Menutup statement dan koneksi
                $stmt->close();
                $koneksi->close();
            } else {
                echo "Required parameters are missing.";
            }
        ?>

        <script>
            function startCountdown() {
                var countdownElement = document.getElementById('penghitung');
                var timeLeft = 3; // waktu dalam detik
    
                var countdownTimer = setInterval(function() {
                    if (timeLeft <= 0) {
                        clearInterval(countdownTimer);
                        window.location.href = "http://localhost/makmur-barokah/secure"; // ganti dengan URL tujuan
                    } else {
                        countdownElement.innerHTML = timeLeft + " detik";
                    }
                    timeLeft -= 1;
                }, 1000);
            }
    
            window.onload = startCountdown;
        </script>
    </body>
</html>