<?php
session_start();

if (!isset($_SESSION["sepet"])) {
    $_SESSION["sepet"] = array();
}

if (isset($_GET["urunID"])) {
    $urunID = $_GET["urunID"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "kitapistan";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM urunler WHERE urunID = ?");
    $stmt->bind_param("i", $urunID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Ürünü sepete ekle, array_push() fonksiyonu, bir dizinin sonuna bir veya daha fazla eleman eklemek için kullanılır. 
        array_push($_SESSION["sepet"], $row);
        echo "Ürün sepete eklendi.";
    } else {
        echo "Ürün bulunamadı.";
    }
    $stmt->close();
    $conn->close();
} else {
    echo "Ürün ID'si belirtilmedi.";
}
?>
