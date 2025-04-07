<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kitapistan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kullaniciAdi = $_POST["kullaniciAdi"];
    $sifre = $_POST["sifre"];

    $stmt = $conn->prepare("SELECT * FROM kullanicilar WHERE kullaniciAdi = ? AND sifre = ?");
    $stmt->bind_param("ss", $kullaniciAdi, $sifre);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['kullaniciAdi'] = $kullaniciAdi;
        header("Location: kullanici.php");
        exit();
    } else {
        echo "<script>alert('Kullanıcı adı veya şifre yanlış.'); window.location.href='loginsayfa.html';</script>";
        exit();
    }
}

$conn->close();
?>
