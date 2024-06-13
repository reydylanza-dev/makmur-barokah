<?php

include 'koneksi.php';

session_start();

if(!isset($_SESSION["adminloggedin"]) || $_SESSION["adminloggedin"] !== true){
    header("location: ../login.php");
    exit;
}

include 'koneksi.php';
if(isset($_GET['trx_id'])){
    $trxid = $_GET['trx_id'];
}

$va           = '0000002130040002'; // Sesuaikan dengan nomor VA yang benar
$apiKey       = 'SANDBOXCD5972C4-AC87-4F1B-8BF0-FE8262FD6907'; // Sesuaikan dengan API key yang benar
$url          = 'https://sandbox.ipaymu.com/api/v2/transaction'; // Sesuaikan dengan URL yang benar
$method       = 'POST';
$body['transactionId']    = $trxid;
$body['account']          = $va;

$jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
$requestBody  = strtolower(hash('sha256', $jsonBody));
$stringToSign = strtoupper($method) . ':' . $va . ':' . $requestBody . ':' . $apiKey;
$signature    = hash_hmac('sha256', $stringToSign, $apiKey);
$timestamp    = date('YmdHis');

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

$response = json_decode($ret, true);

if (isset($response['Data']['StatusDesc']) && $response['Data']['StatusDesc'] == 'Berhasil') {
    $update_query = "UPDATE transaksi SET status = 1 WHERE trx_id = $trxid";

        // Eksekusi query
        if(mysqli_query($link, $update_query)){
            // Status in the transaction table updated successfully.
            // Redirect to transaction-detail.php
            $sid = htmlspecialchars($_SESSION['transdetail_sesi'], ENT_QUOTES, 'UTF-8');
            header("Location: transaction-detail.php?id=$sid");
            exit; // Pastikan untuk keluar dari skrip setelah melakukan pengalihan halaman
        } else{
            echo "Error updating status in the transaction table: " . mysqli_error($link);
        }
} else {
    $sid = htmlspecialchars($_SESSION['transdetail_sesi'], ENT_QUOTES, 'UTF-8');
    header("Location: transaction-detail.php?id=$sid");
}


?>