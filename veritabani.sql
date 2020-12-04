-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 03 Ara 2020, 15:32:48
-- Sunucu sürümü: 10.4.14-MariaDB
-- PHP Sürümü: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `soz`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE `ayarlar` (
  `id` int(11) NOT NULL,
  `site_baslik` varchar(300) NOT NULL,
  `site_aciklama` varchar(300) NOT NULL,
  `site_sahibi` varchar(100) NOT NULL,
  `mail_onayi` int(11) NOT NULL,
  `duyuru_onayi` int(11) NOT NULL,
  `site_logo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `site_baslik`, `site_aciklama`, `site_sahibi`, `mail_onayi`, `duyuru_onayi`, `site_logo`) VALUES
(1, 'Radyo Sitesi', 'Radyo Sitesi', 'Admin', 0, 0, 'img/6538159logo.png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `kul_id` int(5) NOT NULL,
  `kul_isim` varchar(200) NOT NULL,
  `kul_mail` varchar(250) NOT NULL,
  `kul_sifre` varchar(250) NOT NULL,
  `kul_telefon` int(11) NOT NULL,
  `kul_unvan` varchar(250) NOT NULL,
  `kul_yetki` int(11) NOT NULL,
  `kul_logo` varchar(250) DEFAULT NULL,
  `ip_adresi` varchar(300) NOT NULL,
  `session_mail` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`kul_id`, `kul_isim`, `kul_mail`, `kul_sifre`, `kul_telefon`, `kul_unvan`, `kul_yetki`, `kul_logo`, `ip_adresi`, `session_mail`) VALUES
(1, 'Admin', 'mail@mail.mail', '00ad44855604d43db79ae43ac600d2cd', 0, 'Y&ouml;netici', 1, 'img/2619540431favicon.png', '192.168.1.2', 'e1261fb81f16e6ade817e7f1d217e601'),
(2, 'Personel', 'personel@mail.mail', '00ad44855604d43db79ae43ac600d2cd', 0, 'Personel', 1, NULL, '127.0.0.1', '5e35947d2d9faad93b80e2e676868056');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesajlar`
--

CREATE TABLE `mesajlar` (
  `id` int(11) NOT NULL,
  `adsoyad` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `konu` varchar(50) NOT NULL,
  `mesaj` mediumtext NOT NULL,
  `gonderimtarihi` varchar(30) NOT NULL,
  `ipadresi` varchar(20) NOT NULL,
  `bilgileri` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sozler`
--

CREATE TABLE `sozler` (
  `soz_id` int(11) NOT NULL,
  `soz` text NOT NULL,
  `soz_yazari` varchar(250) NOT NULL,
  `soz_kayit_tarihi` datetime NOT NULL DEFAULT current_timestamp(),
  `kim_ekledi` varchar(50) NOT NULL,
  `yazar_resim_yolu` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sozler`
--

INSERT INTO `sozler` (`soz_id`, `soz`, `soz_yazari`, `soz_kayit_tarihi`, `kim_ekledi`, `yazar_resim_yolu`) VALUES
(36, '/admin yolu ile admin paneline erişebilirsiniz.', 'Söz Yazarı Burada Gözükecek', '2020-04-26 00:00:00', 'Admin', ''),
(39, 'Admin panelinden yazdığınız sözler burada gözükür.', 'Söz Yazarı Burada Gözükecek', '2020-04-26 00:00:00', 'Admin', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ziyaretciler`
--

CREATE TABLE `ziyaretciler` (
  `id` int(11) NOT NULL,
  `dis_adres` varchar(45) NOT NULL,
  `ziyaretci_ip` varchar(18) NOT NULL,
  `ic_adres` varchar(100) NOT NULL,
  `giris_tarihi` date NOT NULL,
  `pcadi` varchar(200) DEFAULT NULL,
  `tarayici` varchar(200) DEFAULT NULL,
  `tarayicidili` varchar(200) DEFAULT NULL,
  `gercekip` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`kul_id`),
  ADD UNIQUE KEY `kul_mail` (`kul_mail`);

--
-- Tablo için indeksler `mesajlar`
--
ALTER TABLE `mesajlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sozler`
--
ALTER TABLE `sozler`
  ADD PRIMARY KEY (`soz_id`);

--
-- Tablo için indeksler `ziyaretciler`
--
ALTER TABLE `ziyaretciler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `kul_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `mesajlar`
--
ALTER TABLE `mesajlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `sozler`
--
ALTER TABLE `sozler`
  MODIFY `soz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- Tablo için AUTO_INCREMENT değeri `ziyaretciler`
--
ALTER TABLE `ziyaretciler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1190;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
