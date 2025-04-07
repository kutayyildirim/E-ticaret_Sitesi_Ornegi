<?php
    session_start();
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="profil.css">
   
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
        <li><a style="position: relative; top: 17px; " href="üyeol.html">&nbsp;&nbsp;&nbsp;&nbsp;Üye Ol</a></li>
      </ul>

        <?php endif; ?>

      <ul class="sepet">
        <li>
            <a href="#"><img src="sepet.png" alt="" class="img-2"></a>
            <a href="sepetim.php  "><strong style="text-align: center; font-size: 18px; position: relative; bottom: 7px;">Sepetim</strong></a>
           
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
      <section>
        <article>
              <h1 class="h1"> Üye Bilgileri</h1>
              <article class="articlesol"> 
                <form id="uyeForm1" class="soltaraf" action="profil.php" method="post" onsubmit="return redirectToPage()">
                  <label for="Ad">Adınız:</label>
                  <input type="text" name="ad" placeholder="Adınız" required>
              
                  <label for="Soyad">Soyadınız:</label>
                  <input type="text" name="soyad" placeholder="Soyadınız" required>
              
                  <label for="Telefon">Telefon:</label>
                  <input type="number" name="telefon" placeholder="Telefon" required>
              
                  <label for="Adres">Adres:</label>
                  <textarea name="adres" cols="20" rows="6" required></textarea>
              
                  <label for="E-posta">E-posta:</label>
                  <input type="email" name="eposta" placeholder="E-posta" required>

                  <button type="submit">Güncelle</button>
            
                </form>

              <script>
                
                const urlParams1 = new URLSearchParams(window.location.search);
                const info1 = urlParams1.get('infoProfil');

                if (info1 === 'Kayit_guncellendi') {
                  alert("Kayıt güncellendi!");
                } 
                else if (info1 === 'kayit_guncellenemedi') {
                  alert("Kayıt güncellenemedi.");
                }
              </script>
            </article>

            <article class="articlesag">
              <form action="sifreGuncellem.php" method="post" id="uyeForm2" class="sagTaraf" onsubmit="return validatePassword()">
                
                <label style="margin-top: 10px;" for="Şifre">Eski Şifreniz:</label>
                <input type="password" id="eskiSifre" name="eskiSifre" placeholder="Şifre" required>

                <label for="Şifre">Yeni Şifreniz:</label>
                <input type="password" id="yeniSifre1" name="yeniSifre1"  placeholder="Şifre" required>
            
                <label for="Şifre">Yeni Şifreniz Tekrar Giriniz:</label>
                <input type="password"  id="yeniSifre2" name="yeniSifre2"  placeholder="Şifre" required>
            
                <button type="submit">Şifre Değiştir</button>
              </form>
              </article>

              <script>
                function validatePassword() {
                    var eskiSifre = document.getElementById("eskiSifre").value;
                    var yeniSifre1 = document.getElementById("yeniSifre1").value;
                    var yeniSifre2 = document.getElementById('yeniSifre2').value;
            
                    if (yeniSifre1 !== yeniSifre2) {
                        alert("Yeni şifreler uyuşmuyor");
                        return false; 
                    }
            
                    if (eskiSifre === yeniSifre1) {
                        alert("Eski şifre ile yeni şifre aynı olamaz.");
                        return false;
                    }
                    return true;
                }
            
                const urlParams = new URLSearchParams(window.location.search);
                const error = urlParams.get('error');
                const info = urlParams.get('infoSifre');
            
                if (error === 'sifre_uyusmuyor') {
                    alert("Eski şifre doğru değil");
                }
            
                if (info === 'sifre_guncellendi') {
                    alert("Şifre güncellendi!");
                } else if (info === 'sifre_guncellenemedi') {
                    alert("Şifre güncellenemedi.");
                }
            </script>
              
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
                 <li><a href="loginsayfa.html">Üye Girişi</a></li>
             </ul>
        </div>
        
        <div class="sag">
               <p>&nbsp;&nbsp;&nbsp;Bizi Takip Edin</p>
               <a href="#"><img class="img-2 ikon-img" src="facebook.png" alt=""></a>
               <a href="#"><img class="img-2 ikon-img" id="twit-ikon" src="twitter.png" alt=""></a>
               <a href="#"><img class="img-2 ikon-img" src="insagram.jpeg" alt=""></a>
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

</body>
</html>