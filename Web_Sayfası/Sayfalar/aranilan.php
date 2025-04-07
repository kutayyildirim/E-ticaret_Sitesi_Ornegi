<?php
session_start();
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "kitapistan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query1 = isset($_GET['q']) ? $_GET['q'] : '';

$sql1 = "SELECT * FROM urunler WHERE urunAdi LIKE ? OR yazar LIKE ?";
$stmt = $conn->prepare($sql1);
$searchQuery = "%$query1%";
$stmt->bind_param("ss", $searchQuery, $searchQuery);
$stmt->execute();
$result1 = $stmt->get_result();


$urunler = [];
while ($row = $result1->fetch_assoc()) {
    $urunler[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arama Sonuçları</title>
    <link rel="stylesheet" href="aramamotor.css">
</head>
<body>
<header>
        <div class="container">

     <a href="#"><img src="indir.jpeg" alt="" class="img-1"></a>
    <a href=""><strong><p style="text-align: center; font-size: 27px; position: relative; bottom: 12px; filter: drop-shadow(10px 7px 5px); color: black;">Kitapistan</p></strong></a>
    
    <form style="display: inline-block; padding-left: 25px;"  action="aranilan.php" method="get" class="search">
    <input type="text" placeholder="Arama yap" name = "q">
      <!--q ile alıyoruz. -->
    <button type="submit">Ara</button>

    <?php if (isset($_SESSION['kullaniciAdi'])): ?>
    
      <ul class="giris-uye">
        <style>
          .dropdown {

margin-left: 1317px;
margin-top: 15px;
}

.dropdown-content {
display: none;
position: absolute;
background-color: #f1f1f1;
min-width: 160px;
box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
z-index: 1;
}

.dropdown-content a {
color: black;
padding: 12px 16px;
text-decoration: none;
display: block;
}

.dropdown-content a:hover {
background-color: #ddd;
}

.dropdown:hover .dropdown-content {
display: block;
}

.dropdown:hover .dropbtn {
background-color: green;
border-radius: 10px;
}

#a:hover {
background-color: bisque;
}

#buton:hover {
color: white;
}

        </style>
                    <li>
                        <div class="dropdown" style="margin: 0px; position: relative; top: -5px; ">
                            <button id="buton" class="dropbtn"
                                style=" background-color: black; height: 50px; font-size: small;"><i
                                    class="fa-solid fa-user"></i>&nbsp;

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

        <?php else: ?>
          <ul class="giris-uye">
        <li><a href="loginsayfa.html" target="_blank"><strong style="font-size: 22px; position: relative; top: 11px; left: -15px; ">Giriş Yap</strong></a></li>
        <li><a style="position: relative; top: 17px; " href="üyeol.html">&nbsp;&nbsp;&nbsp;&nbsp;Üye Ol</a></li>
      </ul>

        <?php endif; ?>

      <ul class="sepet">
        <li>
            <a href="#"><img src="sepet.png" alt="" class="img-2"></a>
            <a href="sepetim.php"><strong style="text-align: center; font-size: 18px; position: relative; bottom: 7px;">Sepetim</strong></a>
           
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
        <img src="ramizbaba.webp" alt="">
     
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
  

    <section>
     <article class="article">

            <h1>Arama Sonuçları</h1>
            
                
            <?php if (empty($urunler)): ?>
                <p>Aramanızla eşleşen sonuç bulunamadı.</p>
            <?php else: ?>
                
                    <?php foreach ($urunler as $row): ?>
                        <div class="kitaplar">
                            <a href="kitapsf.html">
                            <img class="kitapresim" src="1984.jpg" alt="">
                            <h2><?php echo ($row['urunAdi']); ?></h2>
                            <h2>Yazar:<?php echo ($row['yazar']); ?></h2>
                            <h2>Y Evi: <?php echo ($row['yayinevi']); ?></h2>
                            <h2>Fiyat: <?php echo ($row['fiyat']); ?> TL</h2>
                        </a>
                            <button class="sepet-ekle-button" type="button" onclick="addToCart(<?php echo htmlspecialchars($row['urunID']); ?>);">Sepete Ekle</button>
                            
                        </div>
                    <?php endforeach; ?>
                
            <?php endif; ?>


        </article>

        <div class="numaralandırma">
            <a href="#">&laquo;</a>
            <a href="#" class="active">1</a>
            <a href="#" >2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#">&raquo;</a>

          </div>
    </section>
    
    <footer>
        <div class="sol">
              <ul>
                 <li><a href="#">Kurumsal</a></li>
                 <li><a href="#">Hakkımızda</a></li>
                 <li><a href="#">Biz Kimiz</a></li>
                 <li><a href="#">Sözleşme</a></li>
             </ul>
 
              <ul>
                 <li><a href="#">İletişim</a></li>
                 <li><a href="#">Yardım</a></li>
                 <li><a href="#">Destek Hattı</a></li>
             </ul>
 
             <ul>
                 <li><a href="uyeol.html">Üye Ol</a></li>
                 <li><a href="#">Sık Sorulanlar</a></li>
                 <li><a href="loginsayfa.html">Üye Grişi</a></li>
             </ul>
        </div>
        
        <div class="sag">
               <p>&nbsp;&nbsp;&nbsp;Bizi Takip Edin</p>
               <a href="#"><img class="img-2 ikon-img"  src="facebook.png" alt=""></a>
               <a href="#"><img class="img-2" id="twit-ikon" src="twitter.png" alt=""></a>
               <a href="#"><img class="img-2 ikon-img" src="instagram.jpeg" alt=""></a>
               <a href="#"><img class="img-2 ikon-img" src="whatsap.jpeg" alt=""></a>
               <br><br>
               <h1 style="margin-right: 40%; font-size: 25px; ">+905333701456</h1>
        </div>
     
       <div class="alt">
           <h2 style="float:left; margin-left: 60px;">Ödeme Yöntemleri</h2>
           <h2 style="display: inline-block; margin-left: 1010px; position: relative; top: -45px;" >Güvenli ve Kolay Alışveriş</h2>
           <ul style="position: relative; top: -50px;">
             <li><img class="img-2 ikon-img" src="axess.png" alt="" style="border-radius: 25px;"></li>
             <li><img class="img-2 ikon-img" src="paraf.png" alt=""></li>
             <li><img class="img-2 ikon-img" src="world.png" alt=""></li>
           </ul>
                   
           <ul style="position: relative; top: -50px; left: -30px;">
             <li><img class="img-2 ikon-img" src="mastercard.png" alt=""></li>
             <li><img class="img-2 ikon-img" src="papara.jpeg" alt=""></li>
             <li><img class="img-2 ikon-img" src="visa.png" alt=""></li>
           </ul>
 
       </div>
 
 </footer>
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
</body>
</html>
