<?php
require_once "../koneksi.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
        $username_err = "Username masih kosong";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username hanya berupa huruf, angka, dan atau underscore";
    } else{
        $sql = "SELECT id FROM admincredentials WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = trim($_POST["username"]);

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Username telah digunakan. Gunakan username lain";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Ada sesuatu yang salah, coba lagi nanti";
            }

            mysqli_stmt_close($stmt);
        }
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Password masih kosong";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password minimal 6 karakter";
    } else{
        $password = trim($_POST["password"]);
    }

    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Masukkan password sekali lagi";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password tidak cocok";
        }
    }
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        $sql = "INSERT INTO admincredentials (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if(mysqli_stmt_execute($stmt)){
                header("location: ../adminpanel/login.php");
            } else{
                echo "Ada sesuatu yang salah, coba lagi nanti";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
        <title>Registrasi Akun | Makmur Barokah</title>
		<link rel="icon" href="img/files/favicon.png" type="image/png">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<link rel="stylesheet" href="../css/themify-icons.css">
    	<link rel="stylesheet" href="../css/flaticon.css">
    	<link rel="stylesheet" href="../vendors/fontawesome/css/all.min.css">
    	<link rel="stylesheet" href="../vendors/owl-carousel/owl.carousel.min.css">
    	<link rel="stylesheet" href="../vendors/animate-css/animate.css">
    	<link rel="stylesheet" href="../css/style.css">
    	<link rel="stylesheet" href="../css/responsive.css">
        <style type="text/css">
            *{
                margin: 0;
            }

            /* -------------------------------- */
            /* Catkay MultiPlatform Release 12  */
            /* -------------------------------- */

            /* 
                Device = Desktops
                Screen = 1281px to higher resolution desktops
            */

            @media (min-width: 1281px) {
                .form{
                    width: 30%;
                }
            }

            /* 
                Device = Laptops, Desktops
                Screen = Between 1025px to 1280px
            */

            @media (min-width: 1025px) and (max-width: 1280px) {
                .form{
                    width: 30%;
                }
            }

            /* 
                Device = Tablets, Ipads (portrait)
                Screen = B/w 768px to 1024px
            */

            @media (min-width: 768px) and (max-width: 1024px) {
                .form{
                    width: 80%;
                }
            }

            /* 
                Device = Tablets, Ipads (landscape)
                Screen = B/w 768px to 1024px
            */

            @media (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
                .form{
                    width: 80%;
                }
            }

            /* 
                Device = Low Resolution Tablets, Mobiles (Landscape)
                Screen = B/w 481px to 767px
            */

            @media (min-width: 481px) and (max-width: 767px) {
                .form{
                    width: 80%;
                }
            }

            /* 
                Device = Most of the Smartphones Mobiles (Portrait)
                Screen = B/w 320px to 479px
            */

            @media (min-width: 320px) and (max-width: 480px) {
                .form{
                    width: 80%;
                }
            }

            /*
            ==========================================================
            */

            @media (min-width: 320px) and (max-width: 480px) {
                .form{
                    width: 80%;
                }
            }

            .header{
                width: 100%;
                height: 80px;
                background-color: #fff;
                box-shadow: -6px 26px 43px -8px rgba(0,0,0,0.75);
                -webkit-box-shadow: -6px 26px 43px -8px rgba(0,0,0,0.75);
                -moz-box-shadow: -6px 26px 43px -8px rgba(0,0,0,0.75);
            }

            h1{
                font-size: 30px;
                color: #000;
                font-family: "Poppins", sans-serif;
            }

            h2{
                font-size: 17px;
                color: #000;
                font-family: "Poppins", sans-serif;
            }

            .inputform{
                font-family: "Poppins", sans-serif;
            }
            
            .form{
                margin-top:100px;
                padding: 10px;
                box-shadow: 0px 9px 44px -9px rgba(0,0,0,0.75);
                -webkit-box-shadow: 0px 9px 44px -9px rgba(0,0,0,0.75);
                -moz-box-shadow: 0px 9px 44px -9px rgba(0,0,0,0.75);
            }

            .fontku{
                font-family: "Poppins", sans-serif;
            }

            form table{
                border-spacing: 0;
            }

            form tr{
                background: #fff;
                padding: 5px;
            }

            form tr:hover{
                background: #e1e1e1;
            }

            form td{
                padding: 5px;
            }

            form label{
                font-weight: 900;
                cursor: text;
            }

            form .textfield{
                padding: 5px;
                border: 1px solid #ccc;
            }

            form .textfield:hover{
                border: 1px solid #000;
            }

            form .textfield:focus{
                border: 1px solid #f00;
            }

            form .button{
                background: #b0d0ff;
                border: 1px solid #ccc;
                cursor: pointer;
            }

            form .button:hover{
                background: #1e90ff;
            }

            .custom {
                height: calc(80vh - 60px);
            }

            .center1 {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 30%;
            }

            .center2 {
                display: block;
                margin-left: auto;
                margin-right: auto;
            }
	    </style>
    </head>
    <script>
        // PIN yang benar
        const correctPin = "12345";

        // Fungsi untuk meminta PIN dari pengguna
        function requestPin() {
            let userPin = prompt("Masukkan PIN Keamanan:");

            // Cek apakah PIN yang dimasukkan benar
            if (userPin === correctPin) {
                alert("Selamat Datang");
                // Akses halaman diberikan, tidak melakukan apa-apa
                document.getElementById('bodyaa').style.display = 'block';
            } else {
                alert("PIN Salah. Anda dilarang mengakses.");
                // Akses halaman ditolak, mengarahkan kembali ke halaman lain atau menutup tab
                window.location.href = "../adminpanel"; // Ganti dengan URL yang sesuai
            }
        }

        // Meminta PIN saat halaman dimuat
        window.onload = requestPin;
    </script>
    <body id="bodyaa">
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow rounded mb-5">
			<div class="container">
				<a class="navbar-brand logo_h" href="#"><img src="../img/files/logo.png" style="width:15%" alt=""></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
				</div>
			</div>
		</nav>

        <div class="custom container-fluid d-flex align-items-center justify-content-center">
            <div class="row bg-light form mb-5">
                <div class="col mt-3 col-xs-12 col-md-12 col-lg-12">
                    <img class="center1" src="../img/files/logo.png" alt=""><br>
                    <h1 style="text-align:center">Registrasi Akun</h1><br>
                    <h2 style="text-align:center; font-size:10pt;">Isikan username dan password dengan benar</h2><br>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label class="fontku">Username</label>
                            <input type="text" name="username" class="form-control orange-border <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
                        </div>    
                        <div class="form-group">
                            <label class="fontku">Password</label>
                            <input type="password" name="password" class="form-control orange-border <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label class="fontku">Konfirmasi Password</label>
                            <input type="password" name="confirm_password" class="form-control orange-border <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-orange" value="Daftar">
                            <input type="reset" class="btn btn-danger ml-2" value="Reset">
                        </div>
                        <p>Sudah punya akun? <a href="login.php">Masuk disini</a></p>
                    </form>
                </div>
                <div class="center2">Catkay OAuth 2.0 | Ver 5.1</div>
            </div>
            <br><br>
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