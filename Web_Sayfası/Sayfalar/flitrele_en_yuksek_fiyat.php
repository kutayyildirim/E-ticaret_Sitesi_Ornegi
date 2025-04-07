<?php
session_start();

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa</title>
    <link rel="shortcut icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2702/2702154.png"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="slider1.css">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    
</head>
</html>
</head>
<body>
<header>
        <div class="container">

            <a href="#"><img src="indir.jpeg" alt="" class="img-1"></a>
            <a href=""><strong>
                    <p style="text-align: center; position: relative; bottom: 12px; color: rgba(0, 0, 0, 0.992);">
                        Kitapistan</p>
                </strong></a>

            <form style="display: inline-block; padding-left: 25px;" action="" method="get" class="search">
                <input type="text" placeholder="Arama yap">
                <button type="submit">Ara</button>

                <ul class="giris-uye">
                    <li>
                        <div class="dropdown" style="margin: 0px; position: relative; top: -5px; ">
                            <button id="buton" class="dropbtn"
                                style=" background-color: black; height: 50px; font-size: small;"><i
                                    class="fa-solid fa-user"></i>&nbsp;
                                    <?php


$kullaniciAdi = isset($_SESSION['kullaniciAdi']) ? $_SESSION['kullaniciAdi'] : '';

?>
                                <strong style="font-size: larger;"><?php echo $_SESSION['kullaniciAdi']; ?>
                            </strong> &nbsp;&nbsp;<i class="fa-solid fa-caret-down"></i><br>

                               
                            </button>
                            <div class="dropdown-content" style="background-color: white;">
                                <a id="a" href="#">Siparişlerim</a>
                                <a id="a" href="profilsf.php">Kullanıcı Bilgileri</a>
                                <a id="a" href="#">Beğendiklerim</a>
                                <a id="a" href="#">Listelerim</a>
                                <hr size="5">
                                <a id="a" href="logout.php" style="color: red;">Çıkış Yap&nbsp;&nbsp;<i
                                        class="fa-solid fa-right-from-bracket"></i></a>

                    </div>
                        </div>
                    </li>
                </ul>

                <ul class="sepet">
                    <li id="link">
                        <a href="sepetim.php" ><img src="sepet.png" alt="" class="img-2"></a>
                        <a href="sepetim.php"><strong
                                style="text-align: center; font-size: 18px; position: relative; bottom: 7px;">Sepetim</strong></a>

                    </li>
                </ul>
            </form>
        </div>
        <div class="nav-container">
            <nav class="navbar-menu">
                <ul>
                    <li><a href="kullanici.php">Anasayfa</a></li>
                    <li><a href="#">Hakkımızda</a></li>
                    <li><a href="#">İletişim</a></li>
                    <li><a href="#">Çok Satanlar</a></li>
                </ul>
            </nav>

        </div>
    </header>
</body>
<aside>
        <h1 style="font-size: larger;">Kategoriler</h1>
        <ul>
         <li><a href="#">Yazılım ve Bilişim</a></li>
          <li><a href="#">Korku-Gerilim</a></li>
          <li><a href="#">Macera</a></li>
          <li><a href="#">Dini</a></li>
          <li><a href="#">YKS</a></li>
          <li><a href="#">Polisiye</a></li>
          <li><a href="#">Edebi</a></li>
          <li><a href="#">Bilim Kurgu</a></li>
          <li><a href="#">Kişisel Gelişim</a></li>
          <li><a href="#">Çocuk</a></li>
          <li><a href="#">Tarihi</a></li>
          <li><a href="#">Psikolojik</a></li>
          <li><a href="#">Masal</a></li>
          <li><a href="#">şiir</a></li>
          <li><a href="#">Roman</a></li>
          <li><a href="#">felsefe</a></li>
          <li><a href="#">KPSS</a></li>
          <li><a href="#">Bilim ve Doğa</a></li>
          <li><a href="#">Fantastik</a></li>
          <li><a href="#">Gezi ve Rehber Kitapları</a></li>
          <li><a href="#">Sağlık Kitapları</a></li>
          <li><a href="#">Siyaset Kitapları</a></li>
</ul>  
        <hr size="6">
        <h1 style="text-align: center; font-size: larger; line-height: 20px;">Günün Sözü</h1>
        <p style="line-height: normal;">&nbsp;"Portakalı soymadan içinden &nbsp;ne çıkıcak bilemezsin yeğen"</p>
        <img src="ramiz.jpeg" alt="">
     
        <p style="font-size: smaller; line-height: 22px; text-align: center;">Türkiye Sinema tarihinin eşsiz oyuncu ve yönetmenlerinden biri olan Tuncel Kurtiz 
            1 Şubat 1936 tarihinde İzmit’te dünyaya gelmiştir.Üniverste yıllarında kısa bir süre Hukuk öğrenimi gören usta oyuncu 
            daha sonra diğer branşlarda (filoloji, felsefe, psikoloji ve sanat tarihi) öğrenim görmüştür.1981 yılında Antalya Altın Portakal Festivalinde En iyi senaryo Ödülük aleme aldığı Gül Hasan isimli filmin senaryosuyla kazanmıştır. Kurtiz eserleri şu şekilde dir;

        </p>
        <ul style="line-height: 21px;">
            <li> Ezel</li>
            <li>Muhteşem Yüzyıl</li>
            <li> Sürü</li>
            <li> Yaşamın Kıyısında</li>
            <li>Asi</li>
        </ul>

    </aside>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kitapistan";

$connection = new mysqli($servername, $username, $password, $dbname);

if ($connection->connect_error) {
    die("Bağlantı hatası: " . $connection->connect_error);
}

$query = "SELECT urunler.urunID, urunler.urunAdi, urunler.yazar, urunler.yayinevi, urunler.fiyat
          FROM urunler 
          LEFT JOIN degerlendirme ON urunler.urunID = degerlendirme.urunID 
          GROUP BY urunler.urunID 
          ORDER BY fiyat DESC";

$result = $connection->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="kitaplar">
            <img class="kitapresim" src="1984.jpg" alt="">
            <h2>Kitap Adı: ' . $row["urunAdi"] . '</h2>
            <h2>Yazar: ' . $row["yazar"] . '</h2>
            <h2>Yayınevi: ' . $row["yayinevi"] . '</h2>
            <h2>Fiyat: ' . $row["fiyat"] . '</h2>
            <button class="sepet-ekle-button" type="button" onclick="addToCart(' . htmlspecialchars($row['urunID']) . ')">Sepete Ekle</button>
        </div>';
    }
} else {
    echo "Hiçbir sonuç bulunamadı.";
}


$connection->close();

?>
 <script>
        function addToCart(urunID) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    alert("Ürün sepete eklendi");
                }
            };
            xhttp.open("GET", "addToCart.php?urunID=" + urunID, true);
            xhttp.send();
        }

        document.getElementById("link").addEventListener("click", function() {
            window.location.href = 'sepetim.php';
        });
    </script>