<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}

$_SESSION['kuantiti'] = 1;


?>

<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="UTF-8">
	    <title>Checkout | Makmur Barokah</title>
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
							<a class="nav-link" href="berita.php">
								<i class="fa fa-newspaper-o fa-1-5x text-white"></i>
							</a>
						</li>
                        <li class="nav-item submenu dropdown ml-3">
                            <a href="#" class="nav-link dropdown-toggle text-white" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Akun</a>
                            <ul class="dropdown-menu">
								<li class="nav-item"><a class="nav-link" href="../dashboard">Transaksi <i class="fa fa-shopping-bag" aria-hidden="true"></i></i></a></li>
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
				<a href="./">Halaman Utama</a> > Checkout
			</div>
		</div>

		<div class="container my-5">
			<div class="card card-body shadow-sm mb-4">
				<div class="row">
					<div class="col-sm-12 col-lg-4">
						<h6 class="text-website" id="orderNumber"></h6>
						<h5>Alamat Pengiriman</h5>
						<?php
							include 'koneksi.php';
							$username = $_SESSION['username'];
							$sql = "SELECT email FROM pengguna WHERE username = '$username'";
    						$result = $koneksi->query($sql);

							if ($result->num_rows > 0) {
								// Ambil baris pertama dari hasil query
								$row = $result->fetch_assoc();
								
								// Simpan email pengguna
								$email = $row["email"];

								$_SESSION['emailnya'] = $email;
								
								// Tampilkan informasi dalam HTML
								echo '<p>' . $email . '<br>';
							}

							mysqli_close($koneksi);
						?>
						<?php
							include 'koneksi.php';
							$username = $_SESSION['username'];
							$sql = "SELECT nama_lengkap FROM pengguna WHERE username = '$username'";
    						$result = $koneksi->query($sql);

							if ($result->num_rows > 0) {
								// Ambil baris pertama dari hasil query
								$row = $result->fetch_assoc();
								
								// Simpan email pengguna
								$nama = $row["nama_lengkap"];

								$_SESSION['namanyanya'] = $nama;
								
								// Tampilkan informasi dalam HTML
								echo $nama . '<br>';
							}

							mysqli_close($koneksi);
						?>
						<?php
							include 'koneksi.php';
							$username = $_SESSION['username'];
							$sql = "SELECT no_hp FROM pengguna WHERE username = '$username'";
    						$result = $koneksi->query($sql);

							if ($result->num_rows > 0) {
								// Ambil baris pertama dari hasil query
								$row = $result->fetch_assoc();
								
								// Simpan email pengguna
								$hp = $row["no_hp"];

								$_SESSION['nomornya'] = $hp;
								
								// Tampilkan informasi dalam HTML
								echo $hp . '<br>';
							}

							mysqli_close($koneksi);
						?>
					</div>
					<div class="col-sm-12 col-lg-4">
						<?php
							include 'koneksi.php';
							$username = $_SESSION['username'];
							$sql = "SELECT alamat_lengkap, kecamatan, kabupaten_kota, provinsi, kode_pos FROM pengguna WHERE username = '$username'";
							$result = $koneksi->query($sql);

							if ($result->num_rows > 0) {
								// Ambil baris pertama dari hasil query
								$row = $result->fetch_assoc();
								
								// Tampilkan informasi dalam HTML
								echo '<h6>' . date("j F Y") . '</h6>';
								echo '<p>' . $row["alamat_lengkap"] . ', ' . $row["kecamatan"] . ', ' . $row["kabupaten_kota"] . ', ' . $row["provinsi"] . ' ' . $row["kode_pos"] . '. Indonesia</p>';
							}

							mysqli_close($koneksi);
						?>
					</div>
				</div>
			</div>
			<div class="list-group shadow-sm">
				<div class="list-group-item bg-light text-website b">
					<div class="row">
						<div class="col-sm-12 col-lg-4">
							Produk
						</div>
						<div class="col-sm-12 col-lg-3">
						</div>
						<div class="col-sm-12 col-lg-2">
							Total Pesanan
						</div>
					</div>
				</div>
				<div class="list-group-item">
					<div class="row my-4">
						<div class="col-sm-12 col-lg-4 mb-3">
							<div class="hvnb">
								<div class="media">
								<?php
									include 'koneksi.php';
									if(isset($_GET['id'])){
										$pid = $_GET['id'];

										$query = "SELECT image_url FROM products WHERE id = '$pid'";
										$result = mysqli_query($koneksi, $query);
										

										if ($result->num_rows > 0) {
											$row = $result->fetch_assoc();

											$gambar = $row['image_url'];

											$_SESSION['gambar_produk'] = $gambar;
											
											echo "<img src=\"$gambar\" width=\"60\" class=\"mr-3\">";
										}

										mysqli_close($koneksi);
									}
								?>
									<div class="media-body text-dark">
										<?php
											include 'koneksi.php';
											if(isset($_GET['id'])){
												$pid = $_GET['id'];

												$query = "SELECT name FROM products WHERE id = '$pid'";
												$result = mysqli_query($koneksi, $query);
												

												if ($result->num_rows > 0) {
													$row = $result->fetch_assoc();

													$nama_produk = $row['name'];

													$_SESSION['produkname'] = $nama_produk;
													
													echo "$nama_produk";
												}

												mysqli_close($koneksi);
											}
										?>
									</div>
								</div>
						</div>
						</div>
						<div class="col-sm-12 col-lg-3 mb-3">
						</div>
						<div class="col-sm-12 col-lg-2 mb-3">
							<?php
									include 'koneksi.php';
									if(isset($_GET['id'])){
										$pid = $_GET['id'];

										$query = "SELECT price FROM products WHERE id = '$pid'";
										$result = mysqli_query($koneksi, $query);
										

										if ($result->num_rows > 0) {
											$row = $result->fetch_assoc();

											$harga = $row['price'];

											$_SESSION['harga_produk'] = number_format($harga, 0, '', '');
											
											echo "<h4 class=\"text-website\">Rp." . number_format($harga, 0, ',', '.') . "</h4>";
										}

										mysqli_close($koneksi);
									}
								?>
						</div>
					</div>

					<div class="row my-4">
					<div class="col-sm-12 col-lg-3 mb-3">
						Kurir <select id="kurir" class="form-control">
							<option value="jne">Makmur Courier (1 hari)</option>
						</select>
					</div>
						<div class="col-sm-12 col-lg-4 mb-3 mt-4">
							<h5 class="text-website" id="biaya_pengiriman"></h5>
						</div>
					</div>
				</div>
				<div class="list-group-item">
					<a href="pembayaran.php">
						<button class="btn bg-website text-white float-right">Lanjutkan</button>
					</a>

					<?php
						// Harga barang
						$harga = $harga;
						
						// Biaya pengiriman
						$biaya_pengirimanf = $_SESSION['biaya_pengiriman'];

						// Melakukan penjumlahan
						$total_pembayaran = $harga + $biaya_pengirimanf;

						$_SESSION['total_biaya'] = number_format($total_pembayaran, 0, '', '');

						// Menampilkan hasil
						echo "<div class='float-right h5 mr-3 mt-2 b text-website'>Total : Rp." . number_format($total_pembayaran, 0, ',', '.') . "</div>";
					?>
				</div>
			</div>
		</div>

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
		
		<script>
			document.addEventListener('DOMContentLoaded', async function() {
				const response = await fetch('backend_pengiriman.php', {
					method: 'POST', // Sesuaikan dengan metode yang digunakan oleh backend_pengiriman.php
					// Body request bisa dikosongkan jika tidak ada data yang perlu dikirim
				});

				const result = await response.json();
				if (response.ok) {
					document.getElementById('biaya_pengiriman').textContent = `Biaya Ongkir Rp. ${result.cost}`;
				} else {
					document.getElementById('biaya_pengiriman').textContent = `Error: ${result.error}`;
				}
			});
		</script>
		<script>
			window.onload = function() {
			// Memanggil fungsi generateOrderNumber() saat halaman dimuat
			generateOrderNumber();
			};

			function generateOrderNumber() {
			// Menghasilkan nomor pesanan acak antara 10000000000 dan 99999999999
			var orderNumber = Math.floor(Math.random() * (99999999999 - 10000000000) + 10000000000);
			
			// Kirim nilai orderNumber ke server menggunakan AJAX
			var xhr = new XMLHttpRequest();
			xhr.open("POST", "set_session.php", true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.onreadystatechange = function() {
				if (xhr.readyState === 4 && xhr.status === 200) {
					console.log("Nilai orderNumber telah disimpan dalam session.");
				}
			};
			xhr.send("orderNumber=" + orderNumber);

			// Mengambil elemen dengan ID "orderNumber" dan menetapkan nomor pesanan yang dihasilkan sebagai teksnya
			document.getElementById("orderNumber").innerHTML = "No. Pesanan : " + orderNumber;
			}
		</script>
	</body>
</html>
