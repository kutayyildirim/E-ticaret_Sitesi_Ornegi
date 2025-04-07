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
if(isset($_GET['urunID'])) {
  $urunID = $_GET['urunID'];
  $sql = "SELECT * FROM urunler WHERE urunID = $urunID";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      $kitap = $result->fetch_assoc();
      
  } else {
      echo "Kitap bulunamadı";
  }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kitap sayfa</title>
    <link rel="stylesheet" href="kitapsf.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
     crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<header>
        <div class="container">

     <a href="#"><img src="indir.jpeg" alt="" class="img-1"></a>
    <a href=""><strong><p style="text-align: center; font-size: 27px; position: relative; bottom: 12px; filter: drop-shadow(10px 7px 5px); color: black;">Kitapistan</p></strong></a>
    
    <form style="display: inline-block; padding-left: 25px;"  action="aranilan.php" method="get" class="search">
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
  

  <section style="width: 100%; height: 100%;">
    <div class="container-2">
        
        <div class="ust-sol">
            <img src="1984.jpg" alt="" width="70%" height="375px" style="position: absolute; bottom: 2px; left: 50px;">
        </div>
        <div class="ust-sag">
          <h1 style="text-align: center;"><?php echo $kitap['urunAdi']; ?></h1>
          <br>
          <p><strong>ISBN:</strong> #1234567</p>
          <p><strong>Yayınevi :</strong> <?php echo $kitap['yayinevi']; ?></p>
          <p><strong>Yazar:</strong><?php echo $kitap['yazar']; ?></p>
          <p><strong>Sayfa Sayısı:</strong>	240</p>
          <p><strong>Basım Yılı:</strong> 2012</p>
          <p><strong>Çevirmen:</strong> Işıkay ÇETİN</p>
          <p><strong>Puan:</strong> 8</p>
          <p><strong>Cilt Tipi:</strong>	Karton Kapak</p>
         

          <button style="background-color: red; border-radius: 5px; width: 150px; height: 50px;"><?php echo $kitap['fiyat']; ?> TL</button>&nbsp;&nbsp;
          <button style="background-color: wheat; border-radius: 5px; width: 50px; height: 50px; margin-left: 20px;" onclick="miktarAzalt();">-</button>
          <button style="background-color: wheat; border-radius: 5px; width: 50px; height: 50px;"><span id="miktar">1</span></button>
          <button style="background-color: wheat; border-radius: 5px; width: 50px; height: 50px;" onclick="miktarArtir();">+</button>
          <button onclick="addToCart(<?php echo htmlspecialchars($kitap['urunID']); ?>);" style="background-color: red; border-radius: 5px; width: 150px; height: 50px; margin-left: 20px;"> Sepete Ekle</button>
          <button id="favori" onclick="favori();">Favorilerime Ekle<i class="fa-regular fa-heart"></i></button>
       
        </div>
        <div class="orta">
            <p><?php echo $kitap['aciklama']; ?></p>
        </div>

        <div class="yorum_puan">
               <div class="yorumlar"><br>
               <button onclick="sayfayaGit()" style="background-color: red; border-radius: 5px; width: 150px; height: 50px; margin-left: 20px;">Yorum yap</button>

                    <h1>Yorumlar</h1>
                    
                    <br><br>
                       <h4>Yıldıray P*</h4>
                         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, quidem!</p><br><hr size="2"><br>
                       <h4>Işıkay Ç*</h4>
                       <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, quidem!</p><br><hr size="2"><br>
                       <h4>Kutay Y**</h4>
                       <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, quidem!</p><br><hr size="2"><br>
                       <h4>Melih  G**</h4>
                       <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, quidem!</p><br><hr size="2"><br>


                       <h4>Yıldıray P*</h4>
                       <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, quidem!</p><br><hr size="2"><br>
                     <h4>Işıkay Ç*</h4>
                     <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, quidem!</p><br><hr size="2"><br>
                     <h4>Kutay Y**</h4>
                     <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, quidem!</p><br><hr size="2"><br>
                     <h4>Melih  G**</h4>
                     <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, quidem!</p><br><hr size="2"><br>
               </div>
                   
          <div class="puanlar"><br>
            <br><br><br><br>
              <h1>Puanlar</h1><br><br><br>
               <div class="kutudolu"></div> <div class="kutudolu"></div> <div class="kutubos"></div> <div class="kutubos"></div> <div class="kutubos"></div>
               <br><br><br><br>
               <div class="kutudolu"></div> <div class="kutudolu"></div> <div class="kutudolu"></div> <div class="kutubos"></div> <div class="kutubos"></div>
               <br><br><br><br><br>
               <div class="kutudolu"></div> <div class="kutubos"></div> <div class="kutubos"></div> <div class="kutubos"></div> <div class="kutubos"></div>
               <br><br><br><br>
               <div class="kutudolu"></div> <div class="kutudolu"></div> <div class="kutudolu"></div> <div class="kutudolu"></div> <div class="kutudolu"></div>
              <br><br><br><br><br>
               <div class="kutudolu"></div> <div class="kutudolu"></div> <div class="kutubos"></div> <div class="kutubos"></div> <div class="kutubos"></div>
               <br><br><br><br>
               <div class="kutudolu"></div> <div class="kutudolu"></div> <div class="kutudolu"></div> <div class="kutubos"></div> <div class="kutubos"></div>
               <br><br><br><br><br>
               <div class="kutudolu"></div> <div class="kutudolu"></div> <div class="kutudolu"></div> <div class="kutudolu"></div> <div class="kutubos"></div>
               <br><br><br><br><br>
               <div class="kutudolu"></div> <div class="kutudolu"></div> <div class="kutudolu"></div> <div class="kutubos"></div> <div class="kutubos"></div>
              </div>

        </div>
     

    </div>
</section>



<br><br><br><br><br>
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
          <br><br><br><br>
          <h1 style="margin-right: 40%; font-size: 25px; ">+905333701456</h1>
   </div>

  <div class="alt">
      <h2 style="float:left; margin-left: 60px;">Ödeme Yöntemleri</h2>
      <h2 style="display: inline-block; margin-left: 1000px; position: relative; top: -5px; right: 225px;" class="footerh">Güvenli ve Kolay Alışveriş</h2>
      <ul>
        <li><img class="img-2 ikon-img" src="axess.jpg" alt="" style="border-radius: 25px;"></li>
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
  // Miktarı artırmak ve azaltmak için JavaScript fonksiyonları
  function miktarArtir() {
    var miktarElementi = document.getElementById('miktar');
    var mevcutMiktar = parseInt(miktarElementi.innerHTML);
    miktarElementi.innerHTML = mevcutMiktar + 1;
  }

  function miktarAzalt() {
    var miktarElementi = document.getElementById('miktar');
    var mevcutMiktar = parseInt(miktarElementi.innerHTML);
    if (mevcutMiktar > 1) {
      miktarElementi.innerHTML = mevcutMiktar - 1;
    }
 }
    const urlParams = new URLSearchParams(window.location.search);

    // yorum eklemek için
    const info2 = urlParams.get('info2');
    if (info2 === 'degerlendirme_eklendi') {
          alert("Değerlendirmeniz Eklendi!");
      }
    
      
    const info1 = urlParams.get('info1');
    if (info1 === 'oturum_ac') {
          alert("Değerlendirme yapabilmeniz için oturum açmalısınız.");
  }

  function sayfayaGit() {
    const urunID = urlParams.get('urunID');

    window.location.href = "degerlendirme.php?urunID="+urunID;
}
</script>

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