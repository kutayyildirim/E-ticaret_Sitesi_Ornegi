
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!isset($_SESSION['kullaniciAdi'])){
        header("Location: kitapsf.php?info1=oturum_ac");
        exit(); 
    }

    $kullaniciAdi = $_SESSION['kullaniciAdi'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "kitapistan";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $sql = $conn->prepare("SELECT kullaniciID FROM kullanicilar WHERE kullaniciAdi=?");
    $sql->bind_param("s", $kullaniciAdi);
    $sql->execute();
    $result = $sql->get_result();
    $row = $result->fetch_assoc();
    $kullaniciID = $row["kullaniciID"];

    $yorum = test_input($_POST["yorum"]);
    $puan = $_POST["puan"];

    $currentDate = date("Y-m-d H:i:s");
    $urunID = $_GET['urunID']; 

    $stmt = $conn->prepare("INSERT INTO degerlendirme (kullaniciID, urunID, puan, yorumMetni, degerlendirmeTarihi) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiss", $kullaniciID, $urunID, $puan, $yorum, $currentDate);

    if ($stmt->execute()) {
        header("Location: kitapsf.php?info2=degerlendirme_eklendi&urunID=" . $urunID);
        exit();
    } else {
        echo "Hata: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<form method="post" action="" style="background-color:wheat; width: 50%; text-align: center; margin: auto;">
    <fieldset>
        <legend>Değerlendirme</legend>
        Yorumunuz: <br>
        <textarea name="yorum" cols="30" rows="10" placeholder="Yorumunuzu giriniz." style="width: 75%; position: relative;" required></textarea><br>
        Puanınız: <br>
        <input type="number" name="puan" min="0" max="5" required><br><br>

        <input type="submit">

    </fieldset> 
</form>

</body>
</html>