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

if (!isset($_SESSION['kullaniciAdi'])) {
    die("Kullanıcı girişi yapılmamış.");
}

$kullaniciID = $_SESSION['kullaniciAdi'];
$siparisTarihi = date('Y-m-d');
$toplamTutar = 0;

if (!isset($_SESSION['sepet']) || empty($_SESSION['sepet'])) {
    die("Siparişiniz Tamamlanmıştır");
}

$siparisDetaylari = [];
foreach ($_SESSION['sepet'] as $urun_detay) {
    $urunID = $urun_detay['urunID'];
    $miktar = $urun_detay['miktar'] ?? 1;

    $sql = "SELECT fiyat, stokMiktari FROM urunler WHERE urunID = $urunID";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $birimFiyat = floatval($row['fiyat']);
        $stokMiktari = intval($row['stokMiktari']);

        if ($stokMiktari < $miktar) {
            die("Stokta yeterli ürün yok: " . $urunID);
        }

        $urunFiyati = $birimFiyat * $miktar;
        $toplamTutar += $urunFiyati;

        $siparisDetaylari[] = [
            'urunID' => $urunID,
            'miktar' => $miktar,
            'birimFiyat' => $birimFiyat
        ];
    } else {
        die("Ürün bulunamadı: " . $urunID);
    }
}

$sql = "INSERT INTO siparisler (kullaniciID, siparisTarihi, toplamTutar) VALUES ('$kullaniciID', '$siparisTarihi', $toplamTutar)";
if ($conn->query($sql) === TRUE) {
    $siparisID = $conn->insert_id;

    foreach ($siparisDetaylari as $detay) {
        $urunID = $detay['urunID'];
        $miktar = $detay['miktar'];
        $birimFiyat = $detay['birimFiyat'];

        $sql = "INSERT INTO siparisdetaylari (siparisID, urunID, miktar, birimFiyat) VALUES ($siparisID, $urunID, $miktar, $birimFiyat)";
        if ($conn->query($sql) === TRUE) {
            $sql = "UPDATE urunler SET stokMiktari = stokMiktari - $miktar WHERE urunID = $urunID";
            $conn->query($sql);
        } else {
            die("Sipariş detayı eklenirken hata: " . $conn->error);
        }
    }

    unset($_SESSION['sepet']);
} else {
    die("Sipariş oluşturulurken hata: " . $conn->error);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ödeme Sayfası</title>
    <link rel="stylesheet" href="odeme.css">
</head>
<body>
    <header>
        <div class="container">
            <a href="#"><img src="indir.jpeg" alt="" class="img-1"></a>
            <a href=""><strong><p style="text-align: center; position: relative; bottom: 12px; color: rgba(0, 0, 0, 0.992); filter: drop-shadow(10px 7px 5px);">Kitapistan</p></strong></a>
            
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
      <li><a style="position: relative; top: 17px; " href="üyeol.html">&nbsp;&nbsp;&nbsp;&nbsp;Üye Ol</a></li>
    </ul>

      <?php endif; ?>


            
            <ul class="sepet">
                <li>
                    <a href="#"><img src="sepet.png" alt="" class="img-2"></a>
                    <a href="sepetim.php"><strong style="text-align: center; font-size: 18px; position: relative; bottom: 7px;">Sepetim</strong></a>
                </li>
            </ul>
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
    <section>
        <form id="paymentForm" action="odeme.php" method="post">
            <article class="articlesol">
                <h1>Ödeme Bilgileri</h1>
                <div class="formsol">
                    <label for="Ad">Adınız:</label>
                    <input type="text" id="Ad" name="Ad" placeholder="Adınız" required>
                
                    <label for="Soyad">Soyadınız:</label>
                    <input type="text" id="Soyad" name="Soyad" placeholder="Soyadınız" required>
                
                    <label for="Şehir">Şehir:</label>
                    <input type="text" id="Şehir" name="Şehir" placeholder="Şehir" required>
                
                    <label for="İlçe">İlçe:</label>
                    <input type="text" id="İlçe" name="İlçe" placeholder="İlçe" required>
                
                    <label for="Mahalle">Mahalle:</label>
                    <input type="text" id="Mahalle" name="Mahalle" placeholder="Mahalle" required>
                
                    <label for="Telefon">Telefon:</label>
                    <input type="text" id="Telefon" name="Telefon" placeholder="Telefon" required>
                
                    <label for="Adres">Adres:</label>
                    <textarea name="Adres" id="Adres" cols="30" rows="5" required></textarea>
                
                    <label for="E-posta">E-posta:</label>
                    <input type="email" id="E-posta" name="E-posta" placeholder="E-posta" required>
                </div>
            </article>

            <article class="articlesag">
                <h1>Kart Bilgileri</h1>
                <div class="formsag">
                    <label for="kartAd">Kart Üzerindeki Ad Soyad</label>
                    <input type="text" id="kartAd" name="kartAd" placeholder="Ad Soyad" required>

                    <label for="kartNo">Kart no:</label>
                    <input type="number" id="kartNo" name="kartNo" placeholder="Kart no" required>

                    <label for="kartTarih">Son kullanma Tarihi:</label>
                    <input type="text" id="kartTarih" name="kartTarih" placeholder="ay/yıl" required>

                    <label for="cvv">CVV:</label>
                    <input type="number" id="cvv" name="cvv" placeholder="CVV" required>

                    <input type="checkbox" id="kvkkCheckbox" required>
                    <label for="kvkkCheckbox" style="display: inline;"><span style="font-size: 22px; font-weight: bolder; color: lightblue;">KVKK</span> Aydınlatma Metnini Okudum, Kabul Ediyorum</label>

                    <button id="siparisVer" type="submit" onclick="siparisver();">Sipariş Ver</button>
                </div>
            </article>
        </form>
  
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
            <a href="#"><img class="img-2 ikon-img" src="whatsapp.jpg" alt=""></a>
            <br>
            <h1 style="margin-right: 40%; font-size: 25px;">+905333701456</h1>
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
</body>
</html>
<script>
  document.getElementById("paymentForm").addEventListener("submit", function(event) {
    var ad = document.getElementById("Ad").value;
    var soyad = document.getElementById("Soyad").value;
    var sehir = document.getElementById("Şehir").value;
    var ilce = document.getElementById("İlçe").value;
    var mahalle = document.getElementById("Mahalle").value;
    var telefon = document.getElementById("Telefon").value;
    var adres = document.getElementById("Adres").value;
    var email = document.getElementById("E-posta").value;

    var kartAd = document.getElementById("kartAd").value;
    var kartNo = document.getElementById("kartNo").value;
    var kartTarih = document.getElementById("kartTarih").value;
    var cvv = document.getElementById("cvv").value;

    if (!ad || !soyad || !sehir || !ilce || !mahalle || !telefon || !adres || !email || !kartAd || !kartNo || !kartTarih || !cvv) {
        alert("Lütfen tüm alanları doldurun.");
        event.preventDefault(); 
        return false;
    }

    if (kartNo.length !== 8 || isNaN(kartNo)) {
        alert("Geçersiz kart numarası.");
        event.preventDefault();
        return false;
    }
    return true;

    function siparisver(){
      alert("Sipariş Tamamlanmıştır");
    }
});

</script>