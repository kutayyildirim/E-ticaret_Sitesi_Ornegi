<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "kitapistan"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Bağlantı hatası: " . $conn->connect_error);
}

$eposta = htmlspecialchars($_POST['eposta']);
$sifre = htmlspecialchars($_POST['sifre']);
$ad = htmlspecialchars($_POST['Ad']);
$soyad = htmlspecialchars($_POST['soyad']);
$adres = htmlspecialchars($_POST['adres']);
$telefon = htmlspecialchars($_POST['telefon']);
$kayitTarihi = date("Y-m-d"); 

$sql = $conn->prepare("INSERT INTO kullanicilar (kullaniciAdi, eposta, sifre, ad, soyad, adres, telefonNumarasi, kayitTarihi) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$sql->bind_param("ssssssss", $ad, $eposta, $sifre, $ad, $soyad, $adres, $telefon, $kayitTarihi);

if ($sql->execute()) {
 
  echo '<script>alert("Yeni kayıt başarıyla eklendi"); window.location.href = "uyeol.html";</script>';
}else{
    echo '<script>alert("Yeni kayıt olmadı"); </script>';
}

$conn->close();