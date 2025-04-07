<?php
if(isset($_POST['gonder'], $_POST['kategoriAdi'], $_POST['islem'])) {
    $kategoriAdi = $_POST['kategoriAdi'];
    $islem = $_POST['islem'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "kitapistan";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Veritabanı bağlantısında hata: " . $conn->connect_error);
    }

    if($islem == "ekle") {
        $sql = "INSERT INTO kategoriler(kategoriAdi) VALUES ('$kategoriAdi')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Yeni kategori başarıyla eklendi.');</script>";
        } else {
            echo "Hata: " . $conn->error;
        }
    } elseif($islem == "cikar") {
        $sql = "DELETE FROM kategoriler WHERE kategoriAdi='$kategoriAdi'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Kategori başarıyla çıkarıldı.');</script>";
        } else {
            echo "Hata: " . $conn->error;
        }
    }

    $conn->close();
}
?>
