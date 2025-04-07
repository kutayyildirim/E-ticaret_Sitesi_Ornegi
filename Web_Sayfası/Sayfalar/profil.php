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
    
    $conn=new mysqli($servername,$username,$password,$dbname);
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

    $stmt=$conn->prepare("update kullanicilar set ad=(?), soyad=(?), telefonNumarasi=(?), adres=(?), eposta=(?) where kullaniciAdi=(?)");
    
    $ad =$soyad =$telefon =$adres =$eposta ='';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ad= test_input($_POST["ad"]);
        $soyad = test_input($_POST["soyad"]);
        $telefon = test_input($_POST["telefon"]);
        $adres = test_input($_POST["adres"]);
        $eposta = test_input($_POST["eposta"]);
    }

    $stmt->bind_param("ssssss",$ad,$soyad,$telefon,$adres,$eposta,$kullaniciAdi);

    if($stmt->execute()) {
        header("Location: profilsf.php?infoProfil=Kayit_guncellendi");
        exit();
    } else {
        header("Location: profilsf.php?infoProfil=kayit_guncellenemedi");
        exit();
    }
    
    $stmt->close();
    $conn->close();
    ?>    
</body>
</html>