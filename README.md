# E-ticaret Web Sitesi Örneği
Bu projede frontend ve backend kısmı birlikte ele alınarak bir web sitesi örneği oluşturduk. Oluşturduğumuz web sitesinin dinamik ve veritabanıyla birlikte çalışmasına önem gösterdik. Veritabanı ve çeşitli kişiselleştirmelerden dolayı direkt indirip kurulması sorun çıkarabilmektedir bu nedenle ekran görüntülerinin incelenmesi tavsiye edilir.

## 🔍 Sistem Özellikleri

### 🔐 Kullanıcı Yönetimi
- Kullanıcılar kayıt olur, giriş yapar.
- Şifreler güvenli şekilde saklanır.
- Kişisel bilgiler kullanıcı profilinde yer alır.

### 📖 Ürün Listeleme & Detay Sayfası
- Kitaplar kategoriye, yazara ve fiyata göre filtrelenebilir.
- Ürün detay sayfasında açıklama, stok bilgisi ve kullanıcı değerlendirmeleri görüntülenir.

### 🛒 Sepet & Sipariş Yönetimi
- Kullanıcılar ürünleri sepete ekleyebilir.
- Sipariş verildiğinde sistem `siparisler` ve `siparisdetaylari` tablosuna kayıt yapar.

### 💳 Ödeme Sistemi
- Kullanıcılar sipariş sonunda ödeme yapar.
- Ödeme detayları `odemeler` tablosunda kayıt altına alınır.

### 🌟 Değerlendirme Sistemi
- Kullanıcılar kitaplara puan verip yorum yapabilir.
- Ortalama puanlar hesaplanarak kitap sayfalarında gösterilebilir.

# 📚Veritabanı Yapısı

Kitapİstan, çevrim içi kitap satışı yapılabilen bir e-ticaret platformudur. Bu belgede projenin **veritabanı yapısı**, **tabloların açıklamaları** ve sistemin **nasıl çalıştığına dair detaylar** yer almaktadır.

---

## 🧩 Veritabanı Tabloları

Veritabanı aşağıdaki 7 ana tablodan oluşmaktadır:

---

### 1. `kullanicilar`

Sisteme kayıt olan kullanıcıların kişisel ve iletişim bilgilerini barındırır.

| Alan Adı           | Açıklama                        |
|--------------------|---------------------------------|
| kullaniciID        | Otomatik artan birincil anahtar |
| kullaniciAdi       | Kullanıcı adı                   |
| eposta             | E-posta adresi                  |
| sifre              | Şifre (şifrelenmiş)             |
| ad, soyad          | Ad ve soyad                     |
| adres              | Kullanıcının adresi             |
| telefonNumarasi    | İletişim numarası               |
| kayitTarihi        | Kayıt tarihi                    |

---

### 2. `urunler`

Sistemde listelenen kitaplara ait bilgileri içerir.

| Alan Adı           | Açıklama                                |
|--------------------|------------------------------------------|
| urunID             | Ürüne özel birincil anahtar              |
| urunAdi            | Kitap adı                                |
| yazar              | Yazar adı                                |
| yayinevi           | Yayınevi                                 |
| fiyat              | Kitabın satış fiyatı                     |
| aciklama           | Kitap tanıtım metni                      |
| stokMiktari        | Stoktaki mevcut adet                     |
| kategoriID         | Kitabın ait olduğu kategori (foreign key)|
| resim              | Kitap kapağı (resim yolu)                |

---

### 3. `kategoriler`

Kitapların ait olduğu türleri ve kategorileri belirtir.

| Alan Adı     | Açıklama             |
|--------------|----------------------|
| kategoriID   | Kategori ID’si       |
| kategoriAdi  | Kategori adı (örn: Roman, Eğitim) |

---

### 4. `degerlendirme`

Kullanıcıların kitaplara verdikleri puan ve yorumları içerir.

| Alan Adı           | Açıklama                                  |
|--------------------|--------------------------------------------|
| degerlendirmeID    | Birincil anahtar                          |
| kullaniciID        | Yorumu yapan kullanıcı                    |
| urunID             | Yorumu yapılan kitap                      |
| yorumMetni         | Kullanıcının yazdığı yorum                |
| puan               | 1-5 arası puan değeri                     |
| degerlendirmeTarihi| Yorumun yapıldığı tarih                   |

---

### 5. `siparisler`

Kullanıcıların verdiği siparişlerin temel bilgilerini tutar.

| Alan Adı      | Açıklama                          |
|---------------|-----------------------------------|
| siparisID     | Sipariş ID’si                     |
| kullaniciID   | Siparişi veren kullanıcı          |
| siparisTarihi | Siparişin verildiği tarih         |
| toplamTutar   | Toplam sipariş tutarı             |

---

### 6. `siparisdetaylari`

Her siparişteki ürünlerin detaylarını içerir.

| Alan Adı      | Açıklama                             |
|---------------|--------------------------------------|
| siparisDetayID| Detay satırı için birincil anahtar   |
| siparisID     | Siparişe referans                    |
| urunID        | Siparişte yer alan ürün              |
| miktar        | Ürün adedi                           |
| birimFiyat    | Sipariş anındaki ürün fiyatı         |

---

### 7. `odemeler`

Ödeme işlemlerine dair verileri içerir.

| Alan Adı      | Açıklama                          |
|---------------|-----------------------------------|
| odemelerID    | Ödeme ID’si                       |
| kullaniciID   | Ödeme yapan kullanıcı             |
| siparisID     | Ödeme yapılan sipariş             |
| odemeTutari   | Tutar                             |
| odemeTarihi   | Ödeme tarihi                      |
| odemeYontemi  | Kredi kartı, banka kartı vb.      |
| kartBilgileri | Maskelenmiş kart bilgisi          |
