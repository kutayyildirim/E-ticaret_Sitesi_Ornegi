<?php
session_start();

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "kitapistan";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}


if (!isset($_SESSION['sepet'])) {
    $_SESSION['sepet'] = array();
}

//- - - - - - Odeme- - - - - - - 
// Sepetteki ürünlerin fiyatlarını ve miktarlarını çekme
$toplam_sepet_fiyati = 0;
foreach ($_SESSION['sepet'] as $urun_detay) {
    $urun_id = $urun_detay['urunID'];
    $urun_miktari = $urun_detay['miktar'] ?? 1; // Varsayılan olarak miktarı 1 olarak ata

    $sql = "SELECT fiyat FROM urunler WHERE urunID = $urun_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $urun_fiyati = floatval($row['fiyat']); // Ürün fiyatını al
        $toplam_sepet_fiyati += $urun_fiyati * $urun_miktari; // Toplam fiyatı güncelle
    } 
}

// Sabit kargo ücreti ve toplam tutarı hesapla
$kargo_ucreti = $toplam_sepet_fiyati * 5 / 100; // Sabit kargo ücreti
$toplam_tutar = $toplam_sepet_fiyati + $kargo_ucreti; // Toplam tutarı hesapla

//- - - - - - Odeme- - - - - - - 

$conn->close();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="sepetim.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
     integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
     crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>
    <header>
        <div class="container">

     <a href="#"><img src="indir.jpeg" alt="" class="img-1"></a>
    <a href=""><strong><p style="text-align: center; font-size: 27px; position: relative; bottom: 12px; filter: drop-shadow(10px 7px 5px); color: black;">Kitapistan</p></strong></a>
    
         
        <form style="display: inline-block; padding-left: 12px;"  action="aranilan.php" method="get" class="search">
          <input type="text" placeholder="Arama yap" name = "q">
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
        <li><a style="position: relative; top: 17px; " href="uyeol.html">&nbsp;&nbsp;&nbsp;&nbsp;Üye Ol</a></li>
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
<aside class="asidesol"></aside>

          <div class="sptyazısı"><h1 style="font-size: 25px; font-weight: bolder;">Sepetim</h1></div>

      <section>
            
      <?php 


if (!isset($_SESSION["sepet"]) || count($_SESSION["sepet"]) === 0) {
    echo "<div class='divler' style='color:black; font-weight:bolder; font-size: 35px; text-align:center'>Sepetiniz boş!</div>";
} else {
    // Sepet içeriğini göster
    foreach ($_SESSION["sepet"] as $row) {
       echo "<div class='divler'>";
       echo "<img class='img-3' src='1984.jpg' alt=''>";
       echo "<ul>";
       echo "<li>" . $row["urunAdi"] . "</li>";
       echo "<li>" . $row["yazar"] . "</li>";
       echo "</ul>";

        echo "<button onclick='miktarAzalt('miktar');'>-</button>";
        echo "<button style='background-color: wheat; border-radius: 5px; width: 50px; height: 50px;'><span id='miktar'>1</span></button>";
        echo "<button onclick='miktarArtir('miktar');'>+</button>&nbsp;&nbsp;";
        
        echo "<button style='background-color: orange; border-radius: 5px; width: 140px; height: 50px; font-weight: bolder;'> Fiyat: ".$row["fiyat"]. "<button/>";
        echo "<button class='btn' onclick='removeFromCart(" . $row["urunID"] . ")'>Sil &nbsp; <i style='font-size: larger; color: black;' class='fa-solid fa-trash'></i></button>";
        echo "</div>";
    }
}
?>

    
<br><br>

         <div class="satınal">
         <?php if (!isset($_SESSION['sepet']) || count($_SESSION['sepet']) === 0): ?>
        <p>Sepetiniz boş!</p> 
    <?php else: ?>

        <p>Sepet Toplamı: <?php echo number_format($toplam_sepet_fiyati, 2); ?> TL</p>
        <p>Kargo Ücreti: <?php echo number_format($kargo_ucreti, 2); ?> TL</p>
        <p>Toplam Tutar: <?php echo number_format($toplam_tutar, 2); ?> TL</p>
    <?php endif; ?>
         </div><br>

         <button class="satınal-btn" onclick="go();">Satın Al</button>


      </section>    
 
<aside class="asidesag"></aside>

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
           <li><a href="loginsayfa.html">Üye Girişi</a></li>
       </ul>
  </div>
  
  <div class="sag">
         <p>&nbsp;&nbsp;&nbsp;Bizi Takip Edin</p>
         <a href="#"><img class="img-2 ikon-img" src="facebook.png" alt=""></a>
         <a href="#"><img class="img-2 ikon-img" id="twit-ikon" src="twitter.png" alt=""></a>
         <a href="#"><img class="img-2 ikon-img" src="instagram.jpg" alt=""></a>
         <a href="#"><img class="img-2 ikon-img" src="whatsap.jpg" alt=""></a>
         <br><br>
         <h1 style="margin-right: 40%; font-size: 30px; ">+905333701456</h1>
  </div>

 <div class="alt">
     <h2 style="float:left; margin-left: 60px;">Ödeme Yöntemleri</h2>
     <h2 style="display: inline-block; margin-left: 820px;">Güvenli ve Kolay Alışveriş</h2>
     <ul>
       <li><img class="img-2 ikon-img" src="axess.jpg" alt=""></li>
       <li><img class="img-2 ikon-img" src="paraf.jpg" alt=""></li>
     
       <li><img class="img-2 ikon-img" src="world.jpg" alt=""></li>
     </ul>

     <ul>
       <li><img class="img-2 ikon-img" src="mastercard.jpg" alt=""></li>
       <li><img class="img-2 ikon-img" src="papara.jpg" alt=""></li>
       <li><img class="img-2 ikon-img" src="visa.jpg" alt=""></li>
     </ul>

 </div>

</footer>

    <script>
         function miktarArtir(id) {
        var miktarElementi = document.getElementById(id);
        var mevcutMiktar = parseInt(miktarElementi.innerHTML);
        miktarElementi.innerHTML = mevcutMiktar + 1;
    }

    function miktarAzalt(id) {
        var miktarElementi = document.getElementById(id);
        var mevcutMiktar = parseInt(miktarElementi.innerHTML);
        if (mevcutMiktar > 1) {
            miktarElementi.innerHTML = mevcutMiktar - 1;
        }
    }
    </script>


  <script>
    function go(){
       window.location.href = 'odeme.php';
    }
  </script>
    
<script>
    function removeFromCart(urunID) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert("Ürün sepetten kaldırıldı.");
                location.reload(); 
            }
        };
        xhttp.open("GET", "removeFromCart.php?urunID=" + urunID, true);
        xhttp.send();
    }
</script>

</body>
</html>