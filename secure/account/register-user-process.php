<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../login.php");
    exit;
}
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Status</title>
    <link rel="icon" href="../img/files/favicon.png" type="image/png">
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

        .navbar {
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
                    <h4 class="modal-title w-100">Berhasil!</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">Berikut informasi booking Anda :</p>
                    <?php
                    include '../koneksi.php';

                    // Menggunakan random_bytes() untuk mendapatkan karakter acak
                    $bytes = random_bytes(10);

                    // Konversi bytes ke dalam format heksadesimal
                    $randomHex = bin2hex($bytes);

                    // Gunakan uniqid sebagai prefix
                    $idn = uniqid($randomHex);

                    $user_id = $idn;
                    $username = $_SESSION['username'];

                    // Query untuk mengambil created_at dari tabel credentials
                    $query = "SELECT created_at FROM credentials WHERE username = '$username'";
                    $result = mysqli_query($koneksi, $query);

                    // Periksa apakah query berhasil dieksekusi
                    if ($result) {
                        // Ambil hasil query
                        $row = mysqli_fetch_assoc($result);
                        $created_at = $row['created_at'];

                        error_reporting(0);
                        $username = $_SESSION['username'];
                        $email = $_POST['email'];
                        $nama_lengkap = $_POST['nama_lengkap'];
                        $no_ktp = $_POST['no_ktp'];
                        $no_hp = $_POST['no_hp'];
                        $jenis_kelamin = $_POST['jenis_kelamin'];
                        $tanggal_daftar = $created_at; // Gunakan nilai created_at dari sesi sebagai tanggal daftar
                        $alamat_lengkap = $_POST['alamat_lengkap'];
                        $kecamatan = $_POST['kecamatan'];
                        $kabupaten_kota = $_POST['kabupaten_kota'];
                        $provinsi = $_POST['provinsi'];
                        $kode_pos = $_POST['kode_pos'];
                        $status_akun = 'Aktif'; // Set status akun menjadi Aktif secara otomatis saat registrasi

                        echo "<p class='text-center'>Username : $username</p>";
                        echo "<p class='text-center'>$email</p>";
                        echo "<hr>";

                        echo "- Nama Pelanggan : $nama_lengkap <br><br>";
                        echo "- No. KTP : $no_ktp <br><br>";
                        echo "- No. HP : $no_hp <br><br>";
                        echo "- Jenis Kelamin Pasien : $jenis_kelamin <br><br>";
                        echo "- Alamat : $alamat_lengkap <br><br>";
                        echo "- Kecamatan : $kecamatan <br><br>";
                        echo "- Kabupaten/Kota : $kabupaten_kota <br><br>";
                        echo "- Provinsi : $provinsi <br><br>";
                        echo "- Kode Pos : $kode_pos <br><br>";

                        $sqlstr = "INSERT INTO pengguna (user_id, username, email, nama_lengkap, no_ktp, no_hp, jenis_kelamin, tanggal_daftar, alamat_lengkap, kecamatan, kabupaten_kota, provinsi, kode_pos, status_akun) VALUES ('$user_id', '$username', '$email', '$nama_lengkap', '$no_ktp', '$no_hp', '$jenis_kelamin', '$tanggal_daftar', '$alamat_lengkap', '$kecamatan', '$kabupaten_kota', '$provinsi', '$kode_pos', '$status_akun')";
                        $hasil = mysqli_query($koneksi, $sqlstr);

                        //send to kontak API that used Express JS

                        $apiUrl = "http://localhost:5000/api/contacts";

                        $data = array(
                            "username" => $username,
                            "email" => $email,
                            "nama_lengkap" => $nama_lengkap,
                            "no_ktp" => $no_ktp,
                            "no_hp" => $no_hp,
                            "jenis_kelamin" => $jenis_kelamin,
                            "tanggal_daftar" => $_SESSION['created_at'],
                            "alamat_lengkap" => $alamat_lengkap,
                            "kecamatan" => $kecamatan,
                            "kabupaten_kota" => $kabupaten_kota,
                            "provinsi" => $provinsi,
                            "kode_pos" => $kode_pos,
                            "status_akun" => $status_akun
                        );

                        $jsonData = json_encode($data);

                        // Pastikan data JSON valid
                        if (json_last_error() !== JSON_ERROR_NONE) {
                            die('Invalid JSON data: ' . json_last_error_msg());
                        }

                        // URL API
                        $apiUrl = "http://localhost:5000/api/contacts";

                        // Inisialisasi cURL
                        $ch = curl_init();

                        // Setel opsi cURL
                        curl_setopt(
                            $ch,
                            CURLOPT_URL,
                            $apiUrl
                        );
                        curl_setopt(
                            $ch,
                            CURLOPT_POST,
                            1
                        );
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        // Eksekusi request dan tangkap responsenya
                        $response = curl_exec($ch);

                        if (curl_errno($ch)) {
                            echo 'Error:' . curl_error($ch);
                        }

                        // Tutup cURL
                        curl_close($ch);

                        if (!$hasil) {
                            echo "Error: " . mysqli_error($koneksi);
                        }
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-orange btn-block me-auto" data-dismiss="modal" onclick="window.location.href='../index.php'">Lanjut Belanja</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>