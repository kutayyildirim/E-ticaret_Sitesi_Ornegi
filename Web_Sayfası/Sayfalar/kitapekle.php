<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Ekleme ve Çıkarma Formu</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: lightblue;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            padding: 10px;
            border: none;
            background-color: dodgerblue;
            color: white;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<form action="" method="post">
    <label for="urunAdi">Ürün Adı:</label>
    <input type="text" id="urunAdi" name="urunAdi" required>

    <label for="yazar">Yazar:</label>
    <input type="text" id="yazar" name="yazar" >

    <label for="yayinevi">Yayınevi:</label>
    <input type="text" id="yayinevi" name="yayinevi" >

    <label for="fiyat">Fiyat:</label>
    <input type="number" id="fiyat" name="fiyat" min="0" step="0.01" >

    <label for="aciklama">Açıklama:</label>
    <input type="text" id="aciklama" name="aciklama">

    <label for="stokMiktari">Stok Miktarı:</label>
    <input type="number" id="stokMiktari" name="stokMiktari" min="0" >

    <label for="kategoriID">Kategori ID:</label>
    <input type="number" id="kategoriID" name="kategoriID" min="0" >

    <label for="islem">İşlem:</label>
    <select id="islem" name="islem">
        <option value="ekle">Ekle</option>
        <option value="cikar">Çıkar</option>
    </select>

    <input type="submit" value="Gönder">
</form>

</body>
</html>



<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $urunAdi = $_POST['urunAdi'];
    $yazar = $_POST['yazar'];
    $yayinevi = $_POST['yayinevi'];
    $fiyat = $_POST['fiyat'];
    $aciklama = $_POST['aciklama'];
    $stokMiktari = $_POST['stokMiktari'];
    $kategoriID = $_POST['kategoriID'];
    $islem = $_POST['islem'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "kitapistan";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Veritabanı bağlantısında hata: " . $conn->connect_error);
    }

    if ($islem == "ekle") {
        $sql = "INSERT INTO urunler (urunAdi, yazar, yayinevi, fiyat, aciklama, stokMiktari, kategoriID) 
                VALUES ('$urunAdi', '$yazar', '$yayinevi', '$fiyat', '$aciklama', '$stokMiktari', '$kategoriID')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Ürün başarıyla eklendi.');</script>";
        } else {
            echo "Hata: " . $conn->error;
        }
    } elseif ($islem == "cikar") {
        $sql = "DELETE FROM urunler WHERE urunAdi='$urunAdi'";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Ürün başarıyla çıkarıldı.');</script>";
        } else {
            echo "Hata: " . $conn->error;
        }
    }
    $conn->close();
}
?>