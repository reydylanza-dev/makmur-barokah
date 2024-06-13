<?php
// Memanggil file koneksi.php
require_once "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $productName = $_POST['name'];
    $productPrice = $_POST['price'];

    // Mendapatkan data gambar dari formulir
    $image = $_FILES['image_upload']['tmp_name'];

    var_dump($_FILES['image_upload']);

    // Data gambar yang akan dikirim
    $payload = array(
        'image' => base64_encode(file_get_contents($image)),
    );

    // Token autentikasi dari Imgur
    $clientId = 'bfc70c740bd6ff3'; // Ganti dengan kunci API Anda

    // Mengatur header untuk permintaan ke API Imgur
    $headers = array(
        'Authorization: Client-ID ' . $clientId,
    );

    // Membuat permintaan ke API Imgur
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.imgur.com/3/image',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => $payload,
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    var_dump($response);

    curl_close($curl);

    if ($err) {
        echo "Curl Error: $err";
    }else {
        // Mengambil link gambar dari respons
        $responseData = json_decode($response, true);
        $imageUrl = $responseData['data']['link'];

        // Anda dapat menyimpan URL gambar ini dalam database atau melakukan apa pun yang Anda inginkan dengannya
        echo "Gambar berhasil diunggah: $imageUrl";
    }
    
    /* // Proses upload gambar
    $targetDirectory = "uploads/"; // direktori penyimpanan gambar
    $targetFile = $targetDirectory . basename($_FILES["image_upload"]["name"]); // nama file gambar yang akan disimpan
    
    // Pindahkan file yang diupload ke direktori target
    if (move_uploaded_file($_FILES["image_upload"]["tmp_name"], $targetFile)) {
        echo "Gambar ". basename( $_FILES["image_upload"]["name"]). " berhasil diunggah.";
    } else {
        echo "Maaf, ada masalah saat mengunggah gambar.";
    } */
    
    // Simpan data ke database

    // Menggunakan random_bytes() untuk mendapatkan karakter acak
    $bytes = random_bytes(10);

    // Konversi bytes ke dalam format heksadesimal
    $randomHex = bin2hex($bytes);

    // Gunakan uniqid sebagai prefix
    $idn = uniqid($randomHex);

    $sql = "INSERT INTO products (id, name, price, image_url) VALUES ('$idn', '$productName', '$productPrice', '$imageUrl')";
    
    if (mysqli_query($koneksi, $sql)) {
        echo "Produk berhasil ditambahkan ke database.";
        // Redirect ke index.php setelah selesai
        header("Location: index.php");
        exit(); // Pastikan tidak ada output lain sebelum header
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>
