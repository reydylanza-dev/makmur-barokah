<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}

header("Content-Type: application/json");

include 'koneksi.php';
$username = $_SESSION['username'];
$sql = "SELECT kabupaten_kota FROM pengguna WHERE username = '$username'";
$hasil = $koneksi->query($sql);

if ($hasil->num_rows > 0) {
    // Ambil baris pertama dari hasil query
    $row = $hasil->fetch_assoc();
    
    // Simpan kota pengguna
    $tujuan_kota = $row["kabupaten_kota"];

}

include 'antar_kota.php';

$from = "Surabaya";
$to = $tujuan_kota;

if (!isset($cityDistances[$from]) || !isset($cityDistances[$from][$to])) {
    echo json_encode(["error" => "Jarak antara kota tidak ditemukan"]);
    http_response_code(404);
    exit;
}

$distance = $cityDistances[$from][$to];
$initialCost = 5000;
$costPerKm = 500;
$cost = $initialCost + ($distance * $costPerKm);

$response = [
    "from" => $from,
    "to" => $to,
    "distance" => $distance,
    "cost" => $cost
];

echo json_encode($response);

$_SESSION['biaya_pengiriman'] = $cost;


?>


