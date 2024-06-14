<?php
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: shop/index.php");
    exit;
}
 
require_once "koneksi.php";

$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Password masih kosong";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password minimal 6 karakter";
    } else{
        $new_password = trim($_POST["new_password"]);
    }

    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Masukkan password sekali lagi";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password tidak cocok";
        }
    }

    if(empty($new_password_err) && empty($confirm_password_err)){
        $sql = "UPDATE credentials SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];

            if(mysqli_stmt_execute($stmt)){
                session_destroy();
                header("location: login.php");
                exit();
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
        <title>Reset Password | Makmur Barokah</title>
		<link rel="icon" href="img/files/favicon.png" type="image/png">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<link rel="stylesheet" href="css/themify-icons.css">
    	<link rel="stylesheet" href="css/flaticon.css">
    	<link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
    	<link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
    	<link rel="stylesheet" href="vendors/animate-css/animate.css">
    	<link rel="stylesheet" href="css/style.css">
    	<link rel="stylesheet" href="css/responsive.css">
    </head>
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
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow rounded">
			<div class="container">
				<a class="navbar-brand logo_h" href="#"><img src="img/files/logo.png" alt="" style="width:15%"></a>
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
                    <img class="center1" src="img/files/logo.png" alt=""><br>
                    <h1 style="text-align:center">Reset Password</h1><br>
                    <h2 style="text-align:center; font-size:10pt;">Pastikan kombinasi password benar</h2><br>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label class="fontku">Password Baru</label>
                            <input type="password" name="new_password" class="form-control orange-border <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                            <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label class="fontku">Konfirmasi Password Baru</label>
                            <input type="password" name="confirm_password" class="form-control orange-border <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-orange" value="Submit">
                            <a class="btn btn-link ml-2" href="login.php">Cancel</a>
                        </div>
                    </form>
                </div>
                <div class="center2">Catkay OAuth 2.0 | Ver 5.1</div>
            </div>
            <br><br>
        </div>
        <script src="js/jquery-2.2.4.min.js"></script>
		<script src="js/popper.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/stellar.js"></script>
		<script src="vendors/owl-carousel/owl.carousel.min.js"></script>
		<script src="js/jquery.ajaxchimp.min.js"></script>
		<script src="js/waypoints.min.js"></script>
		<script src="js/mail-script.js"></script>
		<script src="js/contact.js"></script>
		<script src="js/jquery.form.js"></script>
		<script src="js/jquery.validate.min.js"></script>
		<script src="js/mail-script.js"></script>
		<script src="js/theme.js"></script>
    </body>
</html>