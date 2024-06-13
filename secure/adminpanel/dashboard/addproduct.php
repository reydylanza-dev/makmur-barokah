<?php
session_start();

if(!isset($_SESSION["adminloggedin"]) || $_SESSION["adminloggedin"] !== true){
    header("location: ../login.php");
    exit;
}
?>

<html>
	<head>
		<meta charset="UTF-8">
        <title>Tambah Produk | Admin Makmur Barokah</title>
		<link rel="icon" href="../img/files/favicon.png" type="image/png">
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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    </head>
	<style type="text/css">
		*{
    		margin: 0;
		}

		.header{
    		width: 100%;
    		height: 80px;
    		background-color: #fff;
			box-shadow: -6px 26px 43px -8px rgba(0,0,0,0.75);
			-webkit-box-shadow: -6px 26px 43px -8px rgba(0,0,0,0.75);
			-moz-box-shadow: -6px 26px 43px -8px rgba(0,0,0,0.75);
		}

		.header h1{
			display: inline-block;
   		 	padding-top: 15px;
    		padding-bottom: 0px;
			padding-left: 15px;
    		text-align: left;
    		font-size: 30px;
    		color: #e1e1e1;
    		font-family: "Poppins", sans-serif;
		}

		.inputform{
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
            cursor: pointer;
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

		.card-registration .select-input.form-control[readonly]:not([disabled]) {
		font-size: 1rem;
		line-height: 2.15;
		padding-left: .75em;
		padding-right: .75em;
		}
		.card-registration .select-arrow {
		top: 13px;
		}

	</style>
    <body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light shadow rounded">
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
		
		<section class="">
			<div class="container py-5 h-100">
			  <div class="row justify-content-center align-items-center h-50">
				<div class="col-12 col-lg-9 col-xl-7">
				  <div class="card shadow-2-strong card-registration" style="margin-bottom: 100px; border-radius: 15px; background: #fff; box-shadow: -6px 26px 43px -8px rgba(68, 68, 68, 0.75); -webkit-box-shadow: -6px 26px 43px -8px rgba(68, 68, 68, 0.75); -moz-box-shadow: -6px 26px 43px -8px rgba(68, 68, 68, 0.75);">
					<div class="card-body p-4 p-md-5">
					  <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 inputform">Tambah Produk ke Etalase</h3>
					  
					<form class="p-4 needs-validation" novalidate action="addproductprocess.php" method="post" enctype="multipart/form-data">
						<div class="form-group row">
							<label for="validationCustom01" class="control-label col-sm-5 inputform">Nama Produk*</label>
							<div class="col-sm-7">
								<input type="text" name="name" class="form-control" id="validationCustom01" placeholder="" required>
								<div class="invalid-feedback inputform">
									  Masukkan nama produknya!
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="validationCustom02" class="control-label col-sm-5 inputform">Harga*</label>
							<div class="col-sm-7">
								<input type="text" name="price" class="form-control" id="validationCustom02" placeholder="" required>
								<div class="invalid-feedback inputform">
									Masukkan harganya!
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="validationCustom03" class="control-label col-sm-5 inputform">Upload Gambar*</label>
							<div class="col-sm-7">
								<input type="file" name="image_upload" class="form-control" id="validationCustom03 image_upload" required>
								<div class="invalid-feedback inputform">
									Masukkan foto produk!
								</div>
							</div>
						</div>
						<br>
						<label class="control-label col-sm-5 inputform">* Wajib Diisi</label>
						<div class="form-group row">
							<div class="offset-sm-5 col-sm-10 pull-right">
								<button class="btn btn-primary inputform" type="submit">Kirim</button>&nbsp;&nbsp;&nbsp;
								<button class="btn btn-danger inputform" type="reset">Reset</button>
							</div>
						</div>
					</form>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		  </section>
		<div class="container inputform">
            <div class="row justify-content-center align-items-center">
				
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
	<script type="text/javascript"> 
        function displayForm(c){ 
            if(c.value == "Ya"){ 
				document.getElementById("inputan").disabled = false;
            } 
            else if(c.value =="Tidak"){ 
				document.getElementById("inputan").disabled = true;
            } 
            else{ 
            } 
         }         
    </script> 
	<script>
		(function() {
		  'use strict';
		  window.addEventListener('load', function() {
			var forms = document.getElementsByClassName('needs-validation');
			var validation = Array.prototype.filter.call(forms, function(form) {
			  form.addEventListener('submit', function(event) {
				if (form.checkValidity() === false) {
				  event.preventDefault();
				  event.stopPropagation();
				}
				form.classList.add('was-validated');
			  }, false);
			});
		  }, false);
		})();
	</script>
</html>