<?php
session_start();

if(!isset($_SESSION["adminloggedin"]) || $_SESSION["adminloggedin"] !== true){
    header("location: ../login.php");
    exit;
}

include 'koneksi.php';

if(isset($_GET['id'])){
    $pid = $_GET['id'];

    $aaa = "DELETE from transaksi where transaction_id='$pid'";
    $result = mysqli_query($koneksi, $aaa);

    header("location:transaksi.php");
    
}
?>