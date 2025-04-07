<?php
session_start();

try {
    $db = new PDO("mysql:host=localhost;dbname=kitapistan;charset=utf8", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
    exit;
}

$kategoriler = $db->query("SELECT * FROM kategoriler")->fetchAll(PDO::FETCH_OBJ);

// Kategori ID'sini al
$kategori_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($kategori_id === false || $kategori_id === null) {
    // Kategori ID'si belirtilmemişse veya geçersizse, varsayılan olarak ilk kategoriye git
    $kategori_id = $kategoriler[0]->kategoriID;
}

// Seçilen kategori bilgisini veritabanından al
$stmt = $db->prepare("SELECT * FROM kategoriler WHERE kategoriID = :kategoriID");
$stmt->bindParam(':kategoriID', $kategori_id, PDO::PARAM_INT);
$stmt->execute();
$kategori = $stmt->fetch(PDO::FETCH_OBJ);

// Seçilen kategoriye ait kitapları getirme sorgusu
$stmt = $db->prepare("SELECT * FROM urunler WHERE kategoriID = :kategoriID");
$stmt->bindParam(':kategoriID', $kategori_id, PDO::PARAM_INT);
$stmt->execute();
$kitaplar = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Kitapları 4'lü gruplara ayır
$gruplar = array_chunk($kitaplar, 4);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($kategori->kategoriAdi); ?></title>
    <link rel="shortcut icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/2702/2702154.png"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="slider1.css">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header>
        <div class="container">
            <a href="#"><img src="indir.jpeg" alt="" class="img-1" style="position: relative; top: 15px;"></a>
            <a href=""><strong><p style="text-align: center; position: relative; bottom: 12px; font-size: 30px; color: rgba(0, 0, 0, 0.992); filter: drop-shadow(10px 7px 5px);">Kitapistan</p></strong></a>
            <form style="display: inline-block; padding-left: 17px;" action="" method="get" class="search">
                <input type="text" placeholder="Arama yap">
                <?php if (isset($_SESSION['kullaniciAdi'])): ?>
    
    <ul class="giris-uye">
      <style>
        .dropdown {
margin-left: 1317px;
margin-top: 20px;
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
                        <a href="sepetim.php"><img src="sepet.png" alt="" class="img-2" style="position: relative; top: 25px;"></a>
                        <a href="sepetim.php"><strong style="text-align: center; font-size: 18px; position: relative; bottom: 0px;">Sepetim</strong></a>
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
        <h2>Kategoriler</h2>
        <ul>
        <?php foreach($kategoriler as $kategori_item) { ?>
            <li><a href="kategoriler.php?id=<?php echo htmlspecialchars($kategori_item->kategoriID); ?>"><?php echo htmlspecialchars($kategori_item->kategoriAdi); ?></a></li>
        <?php } ?>
        </ul>
    </aside>

    <section>
        <h1 style="text-align: center;"><?php echo htmlspecialchars($kategori->kategoriAdi); ?></h1>
        <?php foreach ($gruplar as $grup): ?>
            <article class="article">
                <?php foreach ($grup as $kitap): ?>
                    <div class="kitaplar">
                        <a href="kitapsf.html">
                            <img class="kitapresim" src="1984.jpg" alt="">
                            <h2><?php echo htmlspecialchars($kitap['urunAdi']); ?></h2>
                            <h2><?php echo htmlspecialchars($kitap['yazar']); ?></h2>
                            <h2><?php echo htmlspecialchars($kitap['yayinevi']); ?></h2>
                            <h2>Fiyat : <?php echo htmlspecialchars($kitap['fiyat']); ?> TL</h2>
                        </a>
                        <form method="POST" action="">
                            <!-- Ürün ID'sini gizli bir input ile gönder -->
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($kitap['urunID']); ?>">
                            <button class="sepet-ekle-button" type="submit" onclick="addToCart(<?php echo htmlspecialchars($kitap['urunID']); ?>)">Sepete Ekle</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </article>
        <?php endforeach; ?>
    </section>
    </section>
    <div class="numaralandırma" style="position: relative; left:30%" >
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
               <a href="#"><img class="img-2 ikon-img" src="facebook.png" alt=""></a>
               <a href="#"><img class="img-2 ikon-img" id="twit-ikon" src="twitter.png" alt=""></a>
               <a href="#"><img class="img-2 ikon-img" src="instagram.jpg" alt=""></a>
               <a href="#"><img class="img-2 ikon-img" src="whatsap.jpg" alt=""></a>
               <br><br>
               <h1 style="margin-right: 40%; font-size: 25px; ">+905333701456</h1>
        </div>
     
       <div class="alt">
           <h2 style="float:left; margin-left: 60px;">Ödeme Yöntemleri</h2>
           <h2 style="display: inline-block; margin-left: 810px; position: relative; top: -5px;" >Güvenli ve Kolay Alışveriş</h2>
           <ul style="position: relative; top: -5px; left: -10px;">
             <li><img class="img-2 ikon-img" src="axess.jpg" alt="" style="border-radius: 25px;"></li>
             <li><img class="img-2 ikon-img" src="paraf.jpg" alt=""></li>
             <li><img class="img-2 ikon-img" src="world.jpg" alt=""></li>
           </ul>
                   
           <ul style="position: relative; top: -5px; left: -10px;">
             <li><img class="img-2 ikon-img" src="mastercard.jpg" alt=""></li>
             <li><img class="img-2 ikon-img" src="papara.jpg" alt=""></li>
             <li><img class="img-2 ikon-img" src="visa.jpg" alt=""></li>
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