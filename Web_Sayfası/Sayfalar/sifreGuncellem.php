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

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "kitapistan";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn->connect_error){
        die("bağlantı hatası: ".$conn->connect_error);
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $kullaniciAdi=$_SESSION['kullaniciAdi'];

    $stmt = $conn->prepare("UPDATE kullanicilar SET sifre = ? WHERE kullaniciAdi = ? ");
  
    $sql = $conn->prepare("SELECT sifre FROM kullanicilar WHERE kullaniciAdi = ?");
    $sql->bind_param("s", $kullaniciAdi);
    $sql->execute();
    $result = $sql->get_result();
    $row = $result->fetch_assoc();
    $eskiSifreDB = $row["sifre"];
    

    $yeniSifre = $eskiSifre = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $eskiSifre = test_input($_POST["eskiSifre"]);
        $yeniSifre = test_input($_POST["yeniSifre1"]);
    }

    if($eskiSifreDB != $eskiSifre){
        header("Location: profil.php?error=sifre_uyusmuyor");
        exit();
    }
    
    $stmt->bind_param("ss", $yeniSifre,$kullaniciAdi);

    if($stmt->execute()) {
        header("Location: profilsf.php?infoSifre=sifre_guncellendi");
        exit();
    } 
    else {
        header("Location: profilsf.php?infoSifre=sifre_guncellenemedi");
        exit();
    }
    
    $stmt->close();
    $conn->close();
?>
</body>
</html>