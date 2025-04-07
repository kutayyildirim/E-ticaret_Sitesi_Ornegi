-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 11 Haz 2024, 18:24:59
-- Sunucu sürümü: 8.2.0
-- PHP Sürümü: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `kitapistan`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `degerlendirme`
--

DROP TABLE IF EXISTS `degerlendirme`;
CREATE TABLE IF NOT EXISTS `degerlendirme` (
  `degerlendirmeID` int NOT NULL AUTO_INCREMENT,
  `kullaniciID` int DEFAULT NULL,
  `urunID` int DEFAULT NULL,
  `yorumMetni` text,
  `puan` int DEFAULT NULL,
  `degerlendirmeTarihi` date DEFAULT NULL,
  PRIMARY KEY (`degerlendirmeID`),
  KEY `kullaniciID` (`kullaniciID`),
  KEY `urunID` (`urunID`)
) ENGINE=MyISAM AUTO_INCREMENT=195 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `degerlendirme`
--

INSERT INTO `degerlendirme` (`degerlendirmeID`, `kullaniciID`, `urunID`, `yorumMetni`, `puan`, `degerlendirmeTarihi`) VALUES
(1, 1, 2, 'Harika bir eğitim kitabı olmuş yeni başlayanlar için ideal', 4, '2024-02-24'),
(2, 2, 4, 'Çok güzel bir macera kitabıydı. Bütün macera kitabı severlerin okuması gereken bir kitap', 5, '2024-04-24'),
(3, 3, 3, '700 sayfa Gerçekten yaşadığım 2 haftalık bir macera. Stephen King daha önce okumadım, ancak elbette duydum. Korku türü yazdığını biliyor, açıkçası bu kategoriye karşı çok da ilgim olmadığı için kitaplarını es geçiyordum. Sonra bir gün karşıma Peri Masalı çıktı. King\'e ait bir fantastik olduğunu görünce tamamen çılgına döndüm.', 4, '2024-03-11'),
(4, 4, 8, 'Kitap çok kısa olmuş hikayesi akıcı değildi ama fiyatına göre iyi bir kitap', 3, '2024-04-08'),
(194, 1, 5, 'Çok yi\r\nydğdc', 4, '2024-06-07'),
(192, 1, 1, 'Çok iyi', 1, '2024-06-06');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

DROP TABLE IF EXISTS `kategoriler`;
CREATE TABLE IF NOT EXISTS `kategoriler` (
  `kategoriID` int NOT NULL AUTO_INCREMENT,
  `kategoriAdi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`kategoriID`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `kategoriler`
--

INSERT INTO `kategoriler` (`kategoriID`, `kategoriAdi`) VALUES
(1, 'Yazılım ve Bilişim'),
(2, 'Korku-Gerilim'),
(3, 'Macera'),
(4, 'Dini'),
(5, 'YKS'),
(6, 'Polisiye'),
(7, 'Edebi'),
(8, 'Bilim-Kurgu'),
(9, 'Kişisel-Gelişim'),
(10, 'Çocuk'),
(11, 'Tarihi'),
(12, 'Psikolojik');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

DROP TABLE IF EXISTS `kullanicilar`;
CREATE TABLE IF NOT EXISTS `kullanicilar` (
  `kullaniciID` int NOT NULL AUTO_INCREMENT,
  `kullaniciAdi` varchar(50) DEFAULT NULL,
  `eposta` varchar(100) DEFAULT NULL,
  `sifre` varchar(100) DEFAULT NULL,
  `ad` varchar(50) DEFAULT NULL,
  `soyad` varchar(50) DEFAULT NULL,
  `adres` varchar(255) DEFAULT NULL,
  `telefonNumarasi` varchar(20) DEFAULT NULL,
  `kayitTarihi` date DEFAULT NULL,
  PRIMARY KEY (`kullaniciID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`kullaniciID`, `kullaniciAdi`, `eposta`, `sifre`, `ad`, `soyad`, `adres`, `telefonNumarasi`, `kayitTarihi`) VALUES
(1, 'Işıkay', 'a@dfv.com', '123', 'Mehmet', 'ÇENET', 'dthd', '7337', '2024-05-23'),
(2, 'Yıldıray', '1220505016@ogr.klu.edu.tr', '1234', 'Yıldıray', 'PARLAK', 'Gaziantep , Şehitkamil', '05647964558', '2024-05-20'),
(10, 'Ruhi', 'ruhi1234@gmail.com', 'ruhi1234', 'Ruhi', 'ÇENET', 'Bilmiyorum', '05147893665', '2024-06-07'),
(3, 'Melih', '1220505007@ogr.klu.edu.tr', '12345', 'Melih', 'GÖNAN', 'Trabzon , Merkez', '05069634873', '2024-05-24'),
(4, 'Kutay', '1220505070@ogr.klu.edu.tr', '123456', 'Kutay', 'YILDIRIM', 'Çanakkale, Esenler', '05674563215', '2024-05-29'),
(8, 'Abuzer', 'abuzer@gmail.com', '1234567', 'Abuzer', 'Kömürcü', 'Malatya', '2515', '2024-06-06'),
(11, 'a', 'a@dfv.com', '123', 'a', 'a', 'a', '55', '2024-06-07');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `odemeler`
--

DROP TABLE IF EXISTS `odemeler`;
CREATE TABLE IF NOT EXISTS `odemeler` (
  `odemelerID` int NOT NULL AUTO_INCREMENT,
  `kullaniciID` int DEFAULT NULL,
  `siparisID` int DEFAULT NULL,
  `odemeTutari` decimal(10,2) DEFAULT NULL,
  `odemeTarihi` date DEFAULT NULL,
  `odemeYontemi` varchar(50) DEFAULT NULL,
  `kartBilgileri` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`odemelerID`),
  KEY `kullaniciID` (`kullaniciID`),
  KEY `siparisID` (`siparisID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `odemeler`
--

INSERT INTO `odemeler` (`odemelerID`, `kullaniciID`, `siparisID`, `odemeTutari`, `odemeTarihi`, `odemeYontemi`, `kartBilgileri`) VALUES
(1, 1, 1, 332.40, '2024-01-24', 'Kredi Kartı', '0000-1111-2222-3333'),
(2, 2, 2, 748.10, '2024-04-11', 'Banka Kartı', '1111-2222-3333-4444'),
(3, 3, 3, 657.60, '2024-02-23', 'Banka Kartı', '4444-5555-6666-0000'),
(4, 4, 4, 207.01, '2024-03-30', 'Kredi Kartı', '3232-4040-5532-1145'),
(5, 0, 30, 202.40, '2024-06-07', 'Kredi Kartı', '{\"kartAd\":null,\"kartNo\":null,\"kartTarih\":null,\"cvv\":null}'),
(6, 0, 31, 202.40, '2024-06-07', 'Kredi Kartı', '{\"kartAd\":null,\"kartNo\":null,\"kartTarih\":null,\"cvv\":null}'),
(7, 0, 32, 202.40, '2024-06-07', 'Kredi Kartı', '{\"kartAd\":null,\"kartNo\":null,\"kartTarih\":null,\"cvv\":null}');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparisdetaylari`
--

DROP TABLE IF EXISTS `siparisdetaylari`;
CREATE TABLE IF NOT EXISTS `siparisdetaylari` (
  `siparisDetayID` int NOT NULL AUTO_INCREMENT,
  `siparisID` int DEFAULT NULL,
  `urunID` int DEFAULT NULL,
  `miktar` int DEFAULT NULL,
  `birimFiyat` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`siparisDetayID`),
  KEY `siparisID` (`siparisID`),
  KEY `urunID` (`urunID`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `siparisdetaylari`
--

INSERT INTO `siparisdetaylari` (`siparisDetayID`, `siparisID`, `urunID`, `miktar`, `birimFiyat`) VALUES
(1, 1, 1, 1, 130.00),
(2, 1, 2, 1, 202.40),
(3, 2, 4, 1, 201.35),
(4, 2, 7, 1, 124.90),
(5, 2, 11, 1, 421.85),
(6, 3, 3, 1, 425.25),
(7, 3, 5, 1, 115.50),
(8, 3, 9, 1, 116.85),
(9, 4, 6, 1, 113.60),
(10, 4, 8, 1, 22.10),
(11, 4, 10, 1, 71.31),
(12, 5, 3, 1, 425.25),
(13, 5, 2, 1, 202.40),
(14, 6, 1, 1, 130.00),
(45, 35, 2, 1, 202.40),
(44, 34, 2, 1, 202.40),
(43, 33, 2, 1, 202.40),
(42, 32, 2, 1, 202.40),
(41, 31, 2, 1, 202.40),
(40, 30, 2, 1, 202.40),
(26, 17, 2, 1, 202.40),
(27, 18, 2, 1, 202.40),
(28, 19, 2, 1, 202.40),
(29, 20, 2, 1, 202.40),
(30, 21, 4, 1, 201.35),
(31, 21, 3, 1, 425.25),
(32, 22, 2, 1, 202.40),
(33, 23, 2, 1, 202.40),
(34, 24, 3, 1, 425.25),
(35, 25, 7, 1, 124.90),
(36, 26, 8, 1, 22.10),
(37, 27, 10, 1, 71.31),
(38, 28, 6, 1, 113.60),
(39, 29, 9, 1, 116.85);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparisler`
--

DROP TABLE IF EXISTS `siparisler`;
CREATE TABLE IF NOT EXISTS `siparisler` (
  `siparisID` int NOT NULL AUTO_INCREMENT,
  `kullaniciID` int DEFAULT NULL,
  `siparisTarihi` date DEFAULT NULL,
  `toplamTutar` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`siparisID`),
  KEY `kullaniciID` (`kullaniciID`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `siparisler`
--

INSERT INTO `siparisler` (`siparisID`, `kullaniciID`, `siparisTarihi`, `toplamTutar`) VALUES
(1, 1, '2024-01-24', 332.40),
(2, 2, '2024-04-11', 748.10),
(3, 3, '2024-02-23', 657.60),
(4, 4, '2024-03-30', 207.01),
(35, 0, '2024-06-11', 202.40),
(34, 0, '2024-06-07', 202.40),
(33, 0, '2024-06-07', 202.40),
(32, 0, '2024-06-07', 202.40),
(31, 0, '2024-06-07', 202.40),
(30, 0, '2024-06-07', 202.40);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

DROP TABLE IF EXISTS `urunler`;
CREATE TABLE IF NOT EXISTS `urunler` (
  `urunID` int NOT NULL AUTO_INCREMENT,
  `urunAdi` varchar(100) DEFAULT NULL,
  `yazar` varchar(100) DEFAULT NULL,
  `yayinevi` varchar(100) DEFAULT NULL,
  `fiyat` decimal(10,2) DEFAULT NULL,
  `aciklama` text,
  `stokMiktari` int DEFAULT NULL,
  `kategoriID` int DEFAULT NULL,
  `resim` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`urunID`),
  KEY `kategoriID` (`kategoriID`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`urunID`, `urunAdi`, `yazar`, `yayinevi`, `fiyat`, `aciklama`, `stokMiktari`, `kategoriID`, `resim`) VALUES
(1, 'Sen Derviş Olamazsın', 'Mecit Ömür Öztürk', 'Timas İnanç', 130.00, 'İnsanın en yakınındaki ilahi sanat eseri, kendi hayatıdır. İnsan, kendi yaşadıklarında hayret edecek yönleri bulabiliyorsa, hayat öyküsünün mükemmelliği üzerine salim fikirler yürütebiliyorsa, kendiyle ilgili yeni keşifler yapabiliyorsa yaratılıştaki yerini doldurmuş ve makamına liyakat göstermiş olur. Nitekim insan, kendi ruh gemisinin kaptanıdır. İnsana en çok yakışan, şartlar ne olursa olsun iyiliği, güzelliği, cömertliği ve mertliği ayakta tutmaktır. Bu hasletleri gözetmeden yaşanan bir ömür âdeta hiç yaşanmamış hükmündedir. Mütemadiyen gelişen ve değişen dünya, insanın anlam arayışına nasıl bir katkı sunmakta? Yangın yeri olan yüreklerimize hangi tedavi su serpmekte?', 92, 4, NULL),
(2, 'SQL Eğitimi Kitabı', 'Murat Yücedağ', 'Dikeyeksen', 202.40, 'Günümüzde oldukça popüler olan, veri madenciliği, veri analizi gibi iş alanlarının temeli veritabanı sorgularını öğrenmekten geçer. Yazılım sektörüne adım atan her geliştirici çalışma alanı ne olursa olsun “mobil, masaüstü, yapay zeka, web, gömülü sistemler, oyun geliştirme vs.” mutlaka az ya da çok bir veritabanı bilgisine ihtiyaç duyacaktır. Bu kitap ile amacımız sizlere SQL üzerinde yüzlerce örnek sorguyu uygulamalı olarak yazıp veritabanında bilgimizi ve pratiğimizi arttırmaktır. Sizlerden ricam bu kitaba çalışmaya başladığınız zaman içerisinde örnekleri mutlaka tek tek uygulayıp kitabın son sayfasına kadar hazırlanan tüm sorguları yazmanızdır.', 64, 1, NULL),
(3, 'Peri Masalı', 'Stephen King', 'Altın kitapevi', 425.25, '\r\nDünya tehlikede… Hem bizimki hem de diğeri… Charlie Reade on yedi yaşında, beyzbol ve Amerikan futbolunda başarılı, sıradan bir lise öğrencisidir. Bir gün Radar adında bir köpek ve onun sahibi Bay Bowditch’le tanışır. Bay Bowditch bir tepede, tekinsiz görünen büyük bir evde tek başına yaşamaktadır. Evinin arkasında zaman zaman tuhaf seslerin duyulduğu bir kulübe, kulübenin içindeyse bir kuyu vardır. Ve masal bu ya, bu kuyu bambaşka bir dünyaya açılır. Gökyüzünde iki ayın ve bizim dünyamızdaki gökbilimcilerin hiç görmediği yıldızların parladığı, korkunç cezalara maruz kalmış prens ve prenseslerin sürgün edildiği, sakinleri￾nin hastalıkla lanetlendiği bir dünyaya... Dâhi yazar Stephen King, iyi ile kötünün savaştığı paralel bir dünyanın kapılarını aralıyor ve hayal gücünün en derin kuyusuna iniyor. Peri Masalı, King’in diğer eserleri kadar şaşırtıcı ve ikonik. Kahraman rolüne soyunan sıradan bir genç adamın olağanüstü macerasını konu alan gerilimli ve tatmin edici bir roman.', 86, 2, NULL),
(4, 'Da vinci Şifresi', 'Dan Brown ', 'Altın Kitapevi', 201.35, 'Da Vinci Şifresi satışa çıktığı ilk haftanın sonunda büyük bir başarı kazandı. New York Times\'ın \'en çok satanlar\' listesine \"1 Numara\"dan girdi. Aynı zamanda Wall Street Journal, Publishers Weekly ve San Francisco Chronicle\'ın \'en çok satanlar\' listesinde ilk sıradaki yerini uzun süre korudu. Colombia Pictures kitabın film haklarını satın aldı. Harvard Üniversitesi Simge-Bilim Profesörü Robert Langdon, Paris\'te iş gezisindeyken, gece yarısı, Louvre\'un yaşlı müdürünün ölü bulunduğu haberini alır. Langdon ve yetenekli Fransız kriptoloji uzmanı Sophie Neveu, cesedin etrafındaki izleri takip ederek bu garip esrar perdesini araladıkça, ipuçlarının onları Da Vinci\'nin tablosuna götürdüğünü keşfederler. Büyük usta bu sırrı herkesin görebileceği bir yere, ünlü eseri Mona Lisa tablosunun içine gizlemiştir. Langdon bu garip bağlantıyı açığa çıkarınca tehlike artar. Cinayete kurban giden müze müdürü de, Sir Isaac Newton, Botticelli, Victor Hugo, Da Vinci ve aralarında diğer ünlülerin de bulunduğu gizli bir kuruluş olan Sion Manastırı Derneği\'nin bir üyesidir. Langdon, aydınlatmaya çalıştıkları bu tehlikeli sırrın yüz yıllardır tarihin derinliklerinde gizlendiğinden şüphelenir. Böylece Paris ve Londra sokaklarında amansız bir kovalamaca başlar. Langdon ve Neveu, kendilerini, atacakları her adımı önceden bilen esrarengiz olduğu kadar da çok zeki olan bir adamla karşı karşıya bulurlar. Eğer bu karmaşık bilmeceyi çözemezlerse Priory\'nin büyük yankılar uyandıracak bu çok eski gerçeği ebediyen kaybolacaktır.', 99, 3, NULL),
(5, 'Ayt Matematik Soru Bankası', 'Mehmet Kıvrak', 'Üç Dört Beş', 115.50, 'Üniversiteye hazırlanan öğrenciler için test kitabı', 75, 5, NULL),
(6, '10 Kişiydiler', 'Agatha Christie', 'Altın Kitaplar', 113.60, 'Heyecan ve gizem dolu bir polisiye romana hazır mısınız? 60\'tan fazla polisiye roman yazan Agatha Christie, en sevilen romanlarından biri olan On Kişiydiler\'le sizi etkisi altına alacak. Issız bir adada birbirini tanımayan 10 kişinin kaderinin belirleneceği sıra dışı bir macera sizi bekliyor. Gelin, kitabın içeriğinden kısaca bahsedelim.\r\n\"On Kişiydiler\" adlı kitabı neden okumalısınız? Agatha Christie, birçok romanında olduğu gibi ipuçlarını takip ederek okuyucuyla birlikte katilin kim olduğunu bulmaya çalışıyor. Kitap, Una Nancy Owen adında zengin bir kişi tarafından asker adasına davet edilen 10 kişinin hikâyesiyle başlıyor. Malikâneye varan davetlileri bir sürpriz bekliyor çünkü davet sahibi Bay ve Bayan Owen ortalarda yok! Durumdan şüphelenmeye başlayan misafirler duydukları bir ses kaydıyla dehşete kapılıyorlar. Ses kaydındaki kişi adada bulunan herkesin birilerinin ölümüne neden olduğunu söyleyerek herkesin suçlarını tek tek sayıyor. Fakat davetliler başta bu suçlamaları kabul edemiyor ve bu esrarengiz durumun içinden kurtulmak için yollar aramaya başlıyor.', 79, 6, NULL),
(7, 'Kürk Mantolu Madonna', 'Sabahattin Ali', 'Epsilon', 124.90, 'Sabahattin Ali\'nin ölümsüz eseri Kürk Mantolu Madonna önce 1940-41 yıllarında gazete tefrikası olarak, daha sonra 1943 yılında kitap halinde yayımlanmıştı. Eserin tefrikaları ve ilk basımı karşılaştırılarak hazırlanan bu yeni basım, dönemin yaşantısına dair notlar ve metindeki eski sözcüklere dair açıklamalar içeriyor. Yeni, özgün, eserin ruhuna nüfuz eden bir okuma deneyimi sunuyor.', 89, 7, NULL),
(8, 'Zaman Makinesi ', 'H.G Wells', 'İşbankası Kültür Yayınları', 22.10, 'Victoria dönemi Londra’sında yaşayan bir bilim insanı zamanda yolculuk yapmak üzere icat ettiği makineyle geleceğin İngiltere’sini ziyaret eder. Sekiz Yüz İki Bin Yedi Yüz Bir yılında yaşadığı macerayı bir dost meclisinde anlatır. Geleceğin dünyası ayrıcalıklı insanların; güzel, narin ve tembel Eloi’ların rahat ve kaygısız bir yaşam sürdükleri bir yerdir. Ancak Zaman Gezgini bu macera sırasında çok geçmeden yeraltı dünyasına ait hortlaksı Morlock’ları da keşfetmiştir. Wells, Victoria dönemi İngiltere’sinde varsıllarla yoksullar arasında giderek büyüyen uçuruma yönelik keskin eleştirisinde, tarihin ve gelişmenin anlamını sorgular. Toplumsal adaletsizliğin sürüp gitmesi halinde yol açabileceği felaketlere dair uyarıda bulunur. 1895’te yayımlanan Zaman Makinesi, bilimkurgu edebiyatının köşe taşlarından biri olarak, kuşaklar boyu yazarları etkiledi. 21. yüzyılda yaklaşan çevre felaketlerine ve gezegenimizin yazgısına ilişkin kaygılara dair bir öngörü barındıran eskatolojik boyutuyla güncelliğini bugün de koruyor.', 149, 8, NULL),
(9, 'Düşün ve Zengin Ol', 'Napoleon Hill', 'Altın Kitapevi', 116.85, 'Bütün engellerin üstesinden gelebileceğimiz, her emelimize ulaşabileceğimiz, sürekli akan bir nehirden taşar gibi başarıya ulaşabileceğimiz bir yol gösteriyor. Bu kitap, gücüyle bizi sarsacak hayatımızı değiştirecektir. Eğer \"Çekim Yasasını uyguluyorum ama benim için çalışmıyor\" ya da \"bazen çalışıyor, bazen çalışmıyor\" diyorsanız; bu güçlü yasayı her defasında lehinize çalıştırmanın kanıtlanmış formülü bu kitapta bulacaksınız! Napoleon Hill, Düşün ve Zengin Olu 1937de Henry Ford, Thomas Edison gibi birçok tanınmış ismin de bulunduğu çok başarılı 500 insan üzerinde yaptığı 25 yıllık bir araştırmanın sonucunda yazmıştır. Dünyanın en çok satan kitaplarından olan Düşün ve Zengin Olu şu anda elinizde tutuyor olmanız bir tesadüf mü? Bu kitapta yer alan 13 adımlık formül ile başarıya giden yolda sırrı kullanmakta ustalaşacaksınız.', 69, 9, NULL),
(10, 'Cumhuriyetin İlk Sabahı', 'Prof. Dr. İlber Ortaylı ', 'Kronik Kitapevi', 71.31, 'Dünyaya gözlerimi bir savaşın ortasında açtım. Savaşın ortasının tam olarak neresi olduğunu bilmiyordum ama annem hep “Savaşın ortasında doğurdum ben seni,” derdi. \r\nTarih 23 Nisan 1920. Büyük Millet Meclisi binasının önünde adım atacak yer yok. Kalabalığın gerisinde bir tezgâh göze çarpıyor. Önünde bir çocuk, kimbilir belki bir seyyar satıcı. Annesi var mı, babası sağ mı? Vatan yorgun, halk yoksul, umutlar yitip gitmişken bir çocuk nasıl yaşar hayatı?', 124, 10, NULL),
(11, 'Nutuk', 'Mustafa Kemal Atatürk', 'Yapıkredi Yayınları', 421.85, 'Atatürk\'ün yakın tarihimiz açısından büyük önem taşıyan ünlü eseri Nutuk, yıllar sonra Arap harflerinden bir kez daha çevrildi. Uzun soluklu bu çeviri süreci, eserin 1934 baskısında var olan ve günümüze ulaşan çeşitli hataları da ortaya çıkardı.\r\n\r\n15-20 Ekim 1927 tarihleri arasında Cumhuriyet Halk Fırkası kongresinde bizzat Mustafa Kemal Paşa tarafından okunan büyük Nutuk, iki yıllık bir çalışma sonunda 1927 baskısından Latin harflerine aktarılarak Yapı Kredi Yayınları tarafından yayımlandı.\r\n\r\nNutuk\'un Arap harfli ilk baskısının metni 627, belgeleri ise 303 sayfaydı. 1934 yılındaki ilk Latin harfli yayını belgeler dâhil üç cilt yapılmış, Milli Eğitim Bakanlığı daha sonraki baskılarda eseri çoğunlukla üç cilt halinde yayımlamıştı. Yapı Kredi Yayınları Delta Dizisi\'nden çıkan baskının tamamı tek cilt olarak 1197 sayfada toplandı ve orijinaldeki 10 renkli harita da eklendi.\r\nYapı Kredi Yayınları tarafından yayımlanan Nutuk\'un çevirisi 1927 tarihli orijinal baskıdan yapıldı. Bu nedenle, eserin 1934\'teki ilk Latin harfli baskısında yer alan hatalı okumalar ve bu baskıya dayanarak daha sonraki baskılarda yapılan hatalar Yapı Kredi Yayınları\'nın bu yayınıyla düzeltilmiş oldu. Yapı Kredi Yayınları, bundan sonra araştırmacılar, bilim adamları ve her zaman Nutuk okuyacaklar için, ilerde \"Yapı Kredi Yayınları baskısı\" diye anılacak bir yayın yapmış oluyor', 200, 11, NULL),
(12, 'İnsan Olmak', 'Engin Geçtan', 'Metis Yayınevi', 112.20, 'İlk kez yayımlandığı 1983\'ten günümüze defalarca baskı yapmış ve okurla kurduğu yapıcı ilişkiyi kanıtlamış olan bu kitabında Engin Geçtan insan olmanın ikilemini şöyle anlatır: \"Çağdaş toplumlar kendine özgü bir olguyu da birlikte getirmiştir. İnsan eskisinden çok daha fazla sayıda insanla, çok daha kısa süreli, daha yüzeysel ilişkiler kurma eğilimindedir. Bu, soğuk bir günde karşılaşan bir grup kirpinin öyküsüne benzer. Kirpiler ısınabilmek için birbirlerine sokulurlar, ama dikenleri birbirine batar. Birbirlerinden ayrıldıklarındaysa soğuktan rahatsız olurlar. İleri geri hareket ederek sonunda dikenlerini batırmadan birbirlerini ısıtabilecekleri en uygun uzaklığı bulurlar.\"', 50, 12, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yoneticiler`
--

DROP TABLE IF EXISTS `yoneticiler`;
CREATE TABLE IF NOT EXISTS `yoneticiler` (
  `yoneticiID` int NOT NULL AUTO_INCREMENT,
  `kullaniciAdi` varchar(50) DEFAULT NULL,
  `sifre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`yoneticiID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `yoneticiler`
--

INSERT INTO `yoneticiler` (`yoneticiID`, `kullaniciAdi`, `sifre`) VALUES
(1, 'ışıkay123', 'ışıkay123'),
(2, 'yıldıray123', 'yıldıray123'),
(3, 'melih123', 'melih123');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
