<?php
// koneksi ke mysqli
$servername = "192.168.0.100";
$username = "makmurba_makmur_barokah";
$password = "akSrzXV2AM6KL38eXpVp";
$db = "makmurba_makmur_barokah";
$database = "makmurba_makmur_barokah";
// Create connection
$koneksi = mysqli_connect($servername, $username, $password,$db);
$link = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$koneksi) {
die("Connection failed: " . mysqli_connect_error());
}
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>