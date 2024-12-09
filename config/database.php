<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "lawancovid";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Tampilkan pesan error jika terjadi kegagalan koneksi
    echo "Koneksi gagal: " . $e->getMessage();
}