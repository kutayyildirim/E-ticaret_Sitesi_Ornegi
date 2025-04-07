<?php 
session_start();

if(isset($_SESSION['kullaniciAdi'])) {
    header("Location: admin.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "kitapistan";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    $kullaniciAdi = $_POST['kullaniciAdi'];
    $sifre = $_POST['sifre'];

    $stmt = $conn->prepare("SELECT * FROM yoneticiler WHERE kullaniciAdi = ? AND sifre = ?");
    $stmt->bind_param("ss", $kullaniciAdi, $sifre);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1) {
        $_SESSION['kullaniciAdi'] = $kullaniciAdi;
        header("Location: admin.php");
        exit();
    } else {
        echo "<script>alert('Yönetici adı veya şifre yanlış.'); window.location.href='admingiris.html';</script>";
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>