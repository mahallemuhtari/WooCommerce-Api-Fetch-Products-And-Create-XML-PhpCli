
## Woocommerce Api Üzerinden Ürün Verileri Alma ve Xml Oluşturma Projesi

Bu proje, belirli bir WooCommerce sitesinden ürün verilerini çekerek bu verileri bir XML dosyasına yazan bir betik içermektedir. Betik, verileri çekmek için WooCommerce API'sini kullanmaktadır ve çekilen verileri düzenli bir XML formatında kaydederek sunmaktadır. Komut Satırı Üzerinden Sorunsuz Bir Şekilde Çalışmaktadır. Bu Betik Sayesinde Xml Verinizi İstediğiniz Gibi Düzenleyebilir ve İsteklerinizi Yazabilirsiniz

### Sorun:
-	Woocommerce Altyapılı Bir Web Sitesinden Opencart'a Ürünleri Çekmek İçin Çalıştığım Süreçte 
	-	Kullandığım Export Modüllerinde Türkçe Dil Hatası Yaşadım
	-	Varyasyonları İstenilen Şekilde Vermedi
	-	Çoğu Ücretli Yazılımlar Olduğu İçin İşimi Uzatran Bir Ödeme ve İade Süreci Yaşadım.
	-	Xml Exportunu İstediğim Gibi Yapılandıramadığım İçin Opencart'a Entegre Sürecinde Sorun Yaşadım
	
### Amaç:

-   Yukarıda yaşadığım sorunları çözümlemek
-   Belirli bir WooCommerce sitesinden ürün verilerini çekmek.
-   Çekilen verileri düzenli bir XML dosyasına yazarak saklamak.

### Özellikler:

1.  **API İle Veri Çekme:**
    
    -   Belirli bir WooCommerce sitesinin REST API'sini kullanarak ürün verilerini çeker.
    -   Her sayfada belirli bir ürün sayısına göre veri alır.
    -   Belirlenen toplam ürün sayısına ulaşana kadar işlemi tekrarlar.
2.  **XML Oluşturma:**
    
    -   Çekilen her ürün için XML düğümleri oluşturur ve gerekli verileri bu düğümlere ekler.
    -   Ürünlerin kategorilerini, resimlerini, fiyatlarını, stok bilgilerini ve diğer detaylarını XML içinde saklar.
    -   Varyasyonları olan ürünler için de ayrı XML düğümleri oluşturur ve bu varyasyonların özelliklerini ve stok bilgilerini içerir.
3.  **Kullanıcı Bilgileri:**
    
    -   Proje, WooCommerce sitesine erişim sağlamak için kullanıcı adı ve parola bilgilerini kullanır.
    -   Bu bilgileri, WooCommerce REST API bölümünden alınacaktır.
4.  **Parametrelerle Esneklik:**
    
    -   Proje, kullanıcı tarafından belirlenen parametrelere göre çalışır.
    -   Kullanıcı, çekilecek toplam ürün sayısını, her sayfada kaç ürün alınacağını, WooCommerce sitesinin bağlantı linkini, kullanıcı adı ve parolasını belirleyebilir ayrıca istediği verileri aynı şekilde ekleyebilir.

### Kullanım:
#### Bu Bilgileri Kendinize Göre Doldurunuz 

    $total_products = 10;   // Toplam Kaç Tane Ürün Çekilecek
    $site_link = 'https://siteadi.com';  // Site Linki
    $username = 'ck_dsafsdfsdfsdfsdfsdfdafsdfsdfsdfsdfsdfdafsdfsdfsd'; // Api Key  
    $password = 'cs_5safsdfsdfsdfsdfsdfdafsdfsdfsdfsdfsdfdafsdfsdfsd';  // Api Secret

#### Komut Satırını Açınız

> php exporter.php 

Yazınız ve Bitişini Bekleyiniz

Bu proje, WooCommerce sitesinden ürün verilerini çekmek ve düzenli bir şekilde XML dosyasına kaydetmek isteyen geliştiriciler için faydalı olabilir. Hem veri alımı hem de depolama işlemlerini otomatikleştirir ve verilerin kolayca erişilebilir olmasını sağlar. Saygılarımı Sunar İyi Çalışmalar Dilerim 
