<?php

include 'koneksi.php';

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}

// Variabel-variabel dari skrip Anda
$va           = '0000002130040002';
$apiKey       = 'SANDBOXCD5972C4-AC87-4F1B-8BF0-FE8262FD6907';
$url          = 'https://sandbox.ipaymu.com/api/v2/payment';
$method       = 'POST';
$body['product']    = $_POST['products'];
$body['qty']        = $_POST['quantities'];
$body['price']      = $_POST['prices'];
$body['returnUrl']  = $_POST['returnUrl'];
$body['cancelUrl']  = $_POST['cancelUrl'];
$body['notifyUrl']  = $_POST['notifyUrl'];
$body['referenceId'] = $_POST['referenceId'];
$body['imageUrl'] = $_POST['imageUrle'];
$body['buyerName'] = $_POST['buyerName'];
$body['buyerEmail'] = $_POST['buyerEmail'];
$body['buyerPhone'] = $_POST['buyerPhone'];

$jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
$requestBody  = strtolower(hash('sha256', $jsonBody));
$stringToSign = strtoupper($method) . ':' . $va . ':' . $requestBody . ':' . $apiKey;
$signature    = hash_hmac('sha256', $stringToSign, $apiKey);
$timestamp    = Date('YmdHis');

$ch = curl_init($url);

$headers = array(
    'Accept: application/json',
    'Content-Type: application/json',
    'va: ' . $va,
    'signature: ' . $signature,
    'timestamp: ' . $timestamp
);

curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

$ret = curl_exec($ch);
$err = curl_error($ch);
curl_close($ch);

// Eksekusi cURL request

if ($err) {
    echo "<pre>";
    print_r($err);
    echo "</pre>";
} else {
    $ret = json_decode($ret);
    date_default_timezone_set('Asia/Jakarta'); // Ganti sesuai dengan timezone yang diperlukan
    if ($ret->Status == 200) {
        // Simpan data transaksi ke dalam tabel transaksi
        $id = $_SESSION['orderNumber'];
        $nama_produk = $_SESSION['produkname']; // Sesuaikan dengan kolom tabel
        $jumlah = $_SESSION['kuantiti']; // Sesuaikan dengan kolom tabel
        $harga_barang = $_SESSION['harga_produk']; // Sesuaikan dengan kolom tabel
        $biaya_ongkir = $_SESSION['biaya_pengiriman']; // Sesuaikan dengan kebutuhan Anda
        $total_harga = $_SESSION['total_biaya']; // Sesuaikan dengan kebutuhan Anda
        $tanggal_transaksi = date('Y-m-d H:i:s'); // Menggunakan waktu saat ini
        $status = 0; // Sesuaikan dengan kebutuhan Anda
        $username = $_SESSION['username']; // Sesuaikan dengan kebutuhan Anda
        
        $query = "INSERT INTO transaksi (transaction_id, nama_produk, jumlah, harga_barang, biaya_ongkir, total_harga, tanggal_transaksi, status, username) VALUES ('$id', '$nama_produk', '$jumlah', '$harga_barang', '$biaya_ongkir', '$total_harga', '$tanggal_transaksi', '$status', '$username')";

        if ($koneksi->query($query) === FALSE) {
            echo "Error: " . mysqli_error($koneksi);
        }
        
        $sessionId  = $ret->Data->SessionID;
        $url        =  $ret->Data->Url;
        header('Location:' . $url);
    } else {
        echo "<pre>";
        print_r($ret);
        echo "</pre>";
    }
}

echo "Error: " . $koneksi->error;


?>
