# Basit Kasa Defteri

<p align="center">
  <strong>Firma bazlı kasa ve hesap hareketleri takibi</strong><br>
  Gelir/gider kayıtlarını, firma bakiyelerini ve işlem geçmişini yönetmek için PHP tabanlı web uygulaması.
</p>

<p align="center">
  <img alt="PHP" src="https://img.shields.io/badge/PHP-dynamic%20web-777BB4?logo=php&logoColor=white">
  <img alt="Database" src="https://img.shields.io/badge/Database-MySQL-4479A1?logo=mysql&logoColor=white">
  <img alt="UI" src="https://img.shields.io/badge/UI-Bootstrap-7952B3?logo=bootstrap&logoColor=white">
</p>

---

## Genel Bakış

**Basit Kasa Defteri**, firmalara bağlı para hareketlerini ve bakiyeleri tek bir arayüzden takip etmeye yönelik bir PHP uygulamasıdır. Kaynak kodda firma kayıtları, kasa hareketleri, tarih/saat bilgileri ve hareket düzenleme/silme akışları görülmektedir.

## Özellikler

- 💰 Kasa giriş ve çıkış hareketlerini kaydetme
- 🏢 Firma kayıtlarını ve firma bazlı bakiyeleri görüntüleme
- 📝 İşlem açıklaması, tutar, tarih ve saat bilgilerini saklama
- ✏️ Kayıtları düzenleme ve silme
- 📅 Hareketleri tarihe göre listeleme
- 📱 Bootstrap tabanlı, mobil ekranlara uyum sağlamayı hedefleyen arayüz
- 🗃️ MySQL veritabanına PDO üzerinden erişim

## Teknolojiler

- PHP
- MySQL
- PDO
- HTML / CSS / JavaScript
- Bootstrap

## Proje Dosyaları

| Dosya | Görevi |
|---|---|
| `index.php` | Ana kasa arayüzü ve hareket işlemleri |
| `baglanti.php` | Veritabanı bağlantısı ve ortak yardımcı kodlar |
| `head.php` | Ortak üst bölüm ve arayüz bileşenleri |
| `headalt.php` | Ortak alt bölüm |
| `firm.php` | Firma detayları ve firma odaklı işlemler |
| `hesap.php` | Hesap/hareket işlemlerinde kullanılan sayfa |
| `siparis.php` | Sipariş ile ilgili yardımcı ekran |
| `uyeislem.php` | Kullanıcı işlemleri |

## Kurulum Özeti

1. PHP ve MySQL destekli bir web sunucusu hazırlayın.
2. Depoyu web sunucusuna yerleştirin.
3. Veritabanı şemasını ve gerekli tabloları kendi ortamınızda oluşturun veya mevcut yedeği içe aktarın.
4. `baglanti.php` dosyasını, kimlik bilgilerini doğrudan kaynak kodda tutmayacak şekilde yapılandırın.
5. Uygulamayı önce yerel/test ortamında açın; firma, hareket ekleme, düzenleme ve silme akışlarını örnek verilerle doğrulayın.
6. Gerçek finansal kayıtları kullanmadan önce yedekleme ve erişim kontrollerini test edin.

> Depoda veritabanı şeması/kurulum betiği bulunmuyorsa, yalnızca kaynak dosyalarla temiz bir kurulumun tamamlanamayabileceğini unutmayın.

## Güvenlik ve Veri Bütünlüğü

**Yayına almadan önce kritik kontrol:** `baglanti.php` içinde veritabanı erişim bilgileri kaynak koda gömülü görünüyor. Bu bilgiler gerçek veya daha önce kullanılmışsa veritabanı parolasını değiştirin. Depo geçmişindeki eski commit'ler de bu bilgileri içerebilir.

Ayrıca:
- Veritabanını yönetici/root hesabıyla uygulamaya bağlamayın; yalnızca gereken yetkilere sahip ayrı bir kullanıcı oluşturun.
- Hata mesajlarında bağlantı bilgilerini ve sunucu ayrıntılarını ziyaretçilere göstermeyin.
- Finansal hareket ekleme/düzenleme/silme işlemlerinde oturum doğrulaması, CSRF koruması ve yetki kontrolü uygulayın.
- Tutar ve tarih alanlarını sunucu tarafında doğrulayın.
- Firma bakiyesi ile hareket kaydını aynı veritabanı transaction'ı içinde güncelleyin; böylece işlem yarıda kalırsa tutarsız bakiye oluşma riski azalır.
- Mümkünse veritabanı erişimlerinde parametreli sorguları ve çıktı gösteriminde bağlama uygun kaçışlamayı kullanın.
- Düzenli ve geri yüklemesi test edilmiş veritabanı yedekleri alın.

## Durum

Bu README, mevcut kaynak kodun genel yapısını belgelemek amacıyla hazırlanmıştır. Üretim kullanımı öncesinde güvenlik, muhasebe tutarlılığı, kullanıcı yetkilendirmesi ve yedekleme süreçleri ayrıca gözden geçirilmelidir.
