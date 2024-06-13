<?php
session_start();

if (!isset($_SESSION["adminloggedin"]) || $_SESSION["adminloggedin"] !== true) {
    header("location: ../login.php");
    exit;
}
?>

<!doctype html>
<html>
    <head>
	    <meta charset="UTF-8">
	    <title>Data Pelanggan | Admin Makmur Barokah</title>
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
                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 inputform">Data Pelanggan Makmur Barokah</h3>
                <?php
                $apiUrl = "http://localhost:5000/api/contacts";

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, $apiUrl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                $response = curl_exec($ch);

                if (curl_errno($ch)) {
                    echo 'Error:' . curl_error($ch);
                } else {
                    $contacts = json_decode($response, true);
                ?>
                    <table class="table table-bordered bg-light box-shadow--16dp">
                        <thead>
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Status Akun</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($contacts as $contact) {
                                echo '<tr>';
                                echo '<td>' . $contact['nama_lengkap'] . '</td>';
                                echo '<td>' . $contact['username'] . '</td>';
                                echo '<td>' . $contact['email'] . '</td>';
                                echo '<td>' . $contact['status_akun'] . '</td>';
                                echo '<td><button type="button" class="btn btn-orange detail-btn" data-bs-toggle="modal" data-bs-target="#detailModal" data-contact=\'' . json_encode($contact) . '\'>Detail</button></td>';
                                echo '</tr>';
                            } ?>
                        </tbody>
                    </table>
                <?php
                }
                curl_close($ch);
                ?>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Detail Kontak</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
                    </div>
                    <div class="modal-body">
                        <!-- Detail kontak akan ditampilkan di sini -->
                        <div id="contactDetail">
                            <p><strong>User ID:</strong> <span id="detailUserId"></span></p>
                            <p><strong>Username:</strong> <span id="detailUsername"></span></p>
                            <p><strong>Email:</strong> <span id="detailEmail"></span></p>
                            <p><strong>Nama Lengkap:</strong> <span id="detailNamaLengkap"></span></p>
                            <p><strong>No HP:</strong> <span id="detailNoHp"></span></p>
                            <p><strong>Jenis Kelamin:</strong> <span id="detailJenisKelamin"></span></p>
                            <p><strong>Tanggal Daftar:</strong> <span id="detailTanggalDaftar"></span></p>
                            <p><strong>Alamat Lengkap:</strong> <span id="detailAlamatLengkap"></span></p>
                            <p><strong>Kecamatan:</strong> <span id="detailKecamatan"></span></p>
                            <p><strong>Kabupaten/Kota:</strong> <span id="detailKabupatenKota"></span></p>
                            <p><strong>Provinsi:</strong> <span id="detailProvinsi"></span></p>
                            <p><strong>Kode Pos:</strong> <span id="detailKodePos"></span></p>
                            <p><strong>Status Akun:</strong> <span id="detailStatusAkun"></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Script untuk menangani tombol detail dan menampilkan data di modal -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var detailButtons = document.querySelectorAll('.detail-btn');
                detailButtons.forEach(function(button) {
                    button.addEventListener('click', function() {
                        var contact = JSON.parse(this.getAttribute('data-contact'));
                        document.getElementById('detailUserId').textContent = contact.user_id;
                        document.getElementById('detailUsername').textContent = contact.username;
                        document.getElementById('detailEmail').textContent = contact.email;
                        document.getElementById('detailNamaLengkap').textContent = contact.nama_lengkap;
                        document.getElementById('detailNoHp').textContent = contact.no_hp;
                        document.getElementById('detailJenisKelamin').textContent = contact.jenis_kelamin;
                        document.getElementById('detailTanggalDaftar').textContent = contact.tanggal_daftar;
                        document.getElementById('detailAlamatLengkap').textContent = contact.alamat_lengkap;
                        document.getElementById('detailKecamatan').textContent = contact.kecamatan;
                        document.getElementById('detailKabupatenKota').textContent = contact.kabupaten_kota;
                        document.getElementById('detailProvinsi').textContent = contact.provinsi;
                        document.getElementById('detailKodePos').textContent = contact.kode_pos;
                        document.getElementById('detailStatusAkun').textContent = contact.status_akun;
                    });
                });
            });
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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