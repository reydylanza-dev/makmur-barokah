<?php
session_start();

if (isset($_POST['orderNumber'])) {
    $_SESSION['orderNumber'] = $_POST['orderNumber'];
    echo "Nilai orderNumber telah disimpan dalam session.";
} else {
    echo "Gagal menyimpan nilai orderNumber dalam session.";
}
?>
