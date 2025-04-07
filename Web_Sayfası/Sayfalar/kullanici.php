<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kitapistan";

// Veritabanı bağlantısı
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı başarısız: " . $conn->connect_error);
}

// Kitapları veritabanından çek
$sql = "SELECT urunID, urunAdi, yazar, yayinevi, fiyat FROM urunler";
$result = $conn->query($sql);

$kitaplar = [];

if ($result->num_rows > 0) {
    // Verileri diziye aktar
    while($row = $result->fetch_assoc()) {
        $kitaplar[] = $row;
    }
} else {
    echo "Veri bulunamadı";
}

// Kitapları 3 gruba ayır (her bir grup 4 kayıt içerecek)
// array_chunk() fonksiyonu, PHP'de bir diziyi belirli bir boyutta parçalara ayırmak için kullanılır
$gruplar = array_chunk($kitaplar, 4);

$sql_kategoriler = "SELECT * FROM kategoriler";
$result_kategoriler = $conn->query($sql_kategoriler);

$kategoriler = [];

if ($result_kategoriler->num_rows > 0) {
    while ($row = $result_kategoriler->fetch_object()) {
        $kategoriler[] = $row;
    }
} else {
    echo "0 sonuç";
}


// Veritabanı bağlantısını kapat
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="kullanici.css">
</head>

<body>
    <header>
        <div class="container">

            <a href="#"><img src="indir.jpeg" alt="" class="img-1"></a>
            <a href=""><strong>
                    <p style="text-align: center; position: relative; bottom: 12px; color: rgba(0, 0, 0, 0.992);">
                        Kitapistan</p>
                </strong></a>

                <form style="display: inline-block; padding-left: 25px;"  action="aranilan.php" method="get" class="search">
    <input type="text" placeholder="Arama yap" name = "q">
    <button type="submit">Ara</button>

                <ul class="giris-uye">
                    <li>
                        <div class="dropdown" style="margin: 0px; position: relative; top: -5px; ">
                            <button id="buton" class="dropbtn"
                                style=" background-color: black; height: 50px; font-size: small;"><i
                                    class="fa-solid fa-user"></i>&nbsp;
                                    <?php
session_start();

// Oturumda kullanıcı adı tanımlı mı kontrol et
$kullaniciAdi = isset($_SESSION['kullaniciAdi']) ? $_SESSION['kullaniciAdi'] : header("Location: loginsayfa.html");

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

    <aside>
        <h1>Kategoriler</h1>
        <ul>   
        <?php foreach($kategoriler as $kategori) { ?>
            <li><a href="kategoriler.php?id=<?php echo $kategori->kategoriID; ?>"><?php echo $kategori->kategoriAdi; ?></a></li>
        <?php } ?>
</ul>

        <hr size="6">
        <h3 style="text-align: center;">Günün Sözü</h3>
        <p style="line-height: normal;">"Portakalı soymadan içinden ne çıkıcak bilemezsin yeğen"</p>
        <img src="ramiz.jpeg" alt="">


        <p style="font-size: smaller; line-height: 22px; text-align: center;">Türkiye Sinema tarihinin eşsiz oyuncu ve
            yönetmenlerinden biri olan Tuncel Kurtiz
            1 Şubat 1936 tarihinde İzmit’te dünyaya gelmiştir.Üniverste yıllarında kısa bir süre Hukuk öğrenimi gören
            usta oyuncu
            daha sonra diğer branşlarda (filoloji, felsefe, psikoloji ve sanat tarihi) öğrenim görmüştür.1981 yılında
            Antalya Altın Portakal Festivalinde En iyi senaryo Ödülük aleme aldığı Gül Hasan isimli filmin senaryosuyla
            kazanmıştır. Kurtiz eserleri şu şekilde dir;

        </p>

        <ul style="line-height: 27px;">
            <li> Ezel</li>
            <li>Muhteşem Yüzyıl</li>
            <li> Sürü</li>
            <li> Yaşamın Kıyısında</li>
            <li>Asi</li>
        </ul>


    </aside>
    <section>
        <article class="article">
            <h1 style="text-align: center; font-size: 32px;">Çok Satanlar</h1>

            <div class="main" id="main1">
                <div class="slider">
                    <img src="images/sliderimg.jpg" alt="" width="100%">
                    <div class="buton">
                        <i class="fa-solid fa-arrow-left fa-2x" onclick="next()"></i>
                        <i class="fa-solid fa-arrow-right fa-2x" onclick="back()"></i>
                    </div>
                </div>
            </div>

        </article>
        <article>
            <h1><strong style="position: relative; top: 80px; left: 150px; font-size:32px;">Kitaplar</strong></h1>
            <div class="dropdown">
                <button class="dropbtn">Filtrele</button>
                <div class="dropdown-content">
                <a href="filtrele_en_dusuk_fiyat.php">En Düşük Fiyat</a>
                    <a href="filtrele_en_yuksek_puan.php">Puanlama</a>
                    <a href="flitrele_en_yuksek_fiyat.php">En Yüksek Fiyat</a>
                </div>

            </div>

        </article>
        
        </article>
        <?php foreach ($gruplar as $grup): ?>
    <article class="article">
        <!-- Her bir grup için article içeriği -->
        <?php foreach ($grup as $kitap): ?>
            <div class="kitaplar">
            <a href="kitapsf.php?urunID=<?php echo $kitap['urunID'];?>">                    
            <img class="kitapresim" src="1984.jpg" alt="">
                    <h2><?php echo $kitap['urunAdi']; ?></h2>
                    <h2><?php echo $kitap['yazar']; ?></h2>
                    <h2><?php echo $kitap['yayinevi']; ?></h2>
                    <h2>Fiyat : <?php echo $kitap['fiyat']; ?> TL</h2>
                </a>
                <button class="sepet-ekle-button" type="button" onclick="addToCart(<?php echo htmlspecialchars($kitap['urunID']); ?>)">Sepete Ekle</button>

            </div>
        <?php endforeach; ?>
    </article>
<?php endforeach; ?>

        <div class="numaralandırma">
            <a href="#">&laquo;</a>
            <a href="#" class="active">1</a>
            <a href="#">2</a>
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


    <script src="script.js"></script>
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
