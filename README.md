# Yönetim Panelli Radyo Sitesi Yazılımı

<b>Kullanılan teknolojiler:</b> PHP, MySQL VERİTABANI, HTML, CSS, JAVASCRIPT

<b>Özellikler:</b> Ziyaretçi tarafından mesaj ve öneri alıntı gönderme, Yönetici tarafından yönetim paneli ile alıntı oluşturma, düzenleme ve silme, Mesaj görüntüleme ve silme, Ziyaretçi geçmişi görüntüleme ve silme

---

Arayüzünde otomatik değişen arkaplan resimleri ve alıntıları gösterebilen yönetim panelli radyo sitesi.

Yönetim panelinden form ile veritabanına kayıt ettiğimiz alıntıları rastgele olarak anasayfada belli bir süre aralıklarla gösterecektir.
Ziyaretçiler alıntı ekleme talebinde bulunduğu zaman ve mesaj gönderdikleri zaman yönetim panelinde görünecektir.

# Siteyi çalıştırmak için
aşağıdaki işlemleri yapın yoksa site düzgün çalışmayacaktır. 

uzak sunucunuzdaki yada localhosttaki veritabanınızda yeni bir veritabanı oluşturun ardından oluşturduğunuz veritabanını açıp içe aktar bölümünden .sql uzantılı dosyayı yükleyin. Localhost için XAMPP programını tavsiye ediyorum.

admin/vtbaglan.php dosyasındaki, 
admin/veritabaniniyedekle/index.php dosyasını ve 
admin/islemler klasöründeki baglan.php dosyasındaki veritabanı bilgileri kendi veritabanı bildileriniz ile değiştirin.

Eğer localhost'ta çalıştıracaksanız ayar genelde şu şekilde olur:
Sunucu: localhost
Kullanıcı adı: root
Şifre: (Boş bırakın)
Veritabanı adı: (Oluşturduğunuz veritabanınızın adı)

---

# Yönetim paneli için
siteadi.com/admin adresinden giriş yapın

Kullanıcı adı: mail@mail.mail
Şifre: fg46dg4rt4

---

# Yararlandığım Kaynaklar

İş Takip Scripti: aksoyhlc.net
