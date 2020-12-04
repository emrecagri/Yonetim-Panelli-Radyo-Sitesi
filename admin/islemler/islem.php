<?php
/*
Aksoyhlc İş-Proje Takip Scripti

Copyright (C) 2019 Ökkeş Aksoy

Bu program özgür yazılımdır: Özgür Yazılım Vakfı tarafından yayımlanan GNU Genel Kamu Lisansı’nın sürüm 3 ya da (isteğinize bağlı olarak) daha sonraki sürümlerinin hükümleri altında yeniden dağıtabilir ve/veya değiştirebilirsiniz.

Bu program, yararlı olması umuduyla dağıtılmış olup, programın BİR TEMİNATI YOKTUR; TİCARETİNİN YAPILABİLİRLİĞİNE VE ÖZEL BİR AMAÇ İÇİN UYGUNLUĞUNA dair bir teminat da vermez. Ayrıntılar için GNU Genel Kamu Lisansı’na göz atınız.

Bu programla birlikte GNU Genel Kamu Lisansı’nın bir kopyasını elde etmiş olmanız gerekir. Eğer elinize ulaşmadıysa <http://www.gnu.org/licenses/> adresine bakınız.

 */

ob_start();
session_start();
include 'baglan.php';
include '../fonksiyonlar.php';

//Site ayarlarını veritabanından çekme işlemi
$ayarsor=$db->prepare("SELECT * FROM ayarlar");
$ayarsor->execute();
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);

/********************************************************************************/

/*Oturum Açma İşlemi Giriş*/
if (isset($_POST['oturumac'])) {
	$kul_mail=guvenlik($_POST['kul_mail']);
	$kul_sifre=md5($_POST['kul_sifre']);
	$kullanicisor=$db->prepare("SELECT * FROM kullanicilar WHERE kul_mail=:mail and kul_sifre=:sifre");
	$kullanicisor->execute(array(
		'mail'=> $kul_mail,
		'sifre'=> $kul_sifre
	));
	$sonuc=$kullanicisor->rowCount();
	if ($sonuc==1) {
		$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
		$_SESSION['kul_mail']=sifreleme($kul_mail); //Session güvenliği için sessionumuzu üç aşamalı oalrak şifreliyoruz
		$_SESSION['kul_id']=$kullanicicek['kul_id'];

		$ipkaydet=$db->prepare("UPDATE kullanicilar SET
			ip_adresi=:ip_adresi, 
			session_mail=:session_mail WHERE 
			kul_mail=:kul_mail
			");

		$kaydet=$ipkaydet->execute(array(
			'ip_adresi' => $_SERVER['REMOTE_ADDR'], //Güvenlik için işlemine karşı kullanıcının ip adresini veritabanına kayıt ediyoruz
			'session_mail' => sifreleme($kul_mail),
			'kul_mail' => $kul_mail
		));
		header("location:../index.php");
		exit;
	} else {
		header("location:../login.php?durum=hata");
	}
	exit;
}
/*Oturum Açma İşlemi Giriş*/


/*******************************************************************************/

if (isset($_POST['genelayarkaydet'])) {

 			$boyut = $_FILES['site_logo']['size'];//Dosya boyutumuzu alıp değişkene aktardık.
            if($boyut > 3145728)//Burada dosyamız 3 mb büyükse girmesini söyledik
            {
            //İsteyen arkadaslar burayı istediği gibi değiştirebilir size kalmış bir şey
                echo 'Dosya 3MB den büyük olamaz.';// 3 mb büyükse ekrana yazdıracağımız alan
              } else {

               if ($boyut < 20) {
                $genelayarkaydet=$db->prepare("UPDATE ayarlar SET
                 site_baslik=:baslik,
                 site_aciklama=:aciklama,
                 site_sahibi=:sahip,
                 mail_onayi=:mail_onayi,
                 duyuru_onayi=:duyuru_onayi where id=1
                 ");

                $ekleme=$genelayarkaydet->execute(array(
                 'baslik' => guvenlik($_POST['site_baslik']),
                 'aciklama' => guvenlik($_POST['site_aciklama']),
                 'sahip' => guvenlik($_POST['site_sahibi']),
                 'mail_onayi' => guvenlik($_POST['mail_onayi']),
                 'duyuru_onayi' => guvenlik($_POST['duyuru_onayi'])
               ));
      //www.aksoyhlc.net tarafından hazırlanmıştır
              } else {

                $yuklemeklasoru = '../img';
                @$gecici_isim = $_FILES['site_logo']["tmp_name"];
                @$dosya_ismi = $_FILES['site_logo']["name"];
            		$benzersizsayi1=rand(100,10000); //Güvenlik için yüklenen dosyanın başına rastgele karakterler koyuyoruz
            		$benzersizsayi2=rand(100,10000); //Güvenlik için yüklenen dosyanın başına rastgele karakterler koyuyoruz
            		$isim=$benzersizsayi1.$benzersizsayi2.$dosya_ismi;
            		$resim_yolu=substr($yuklemeklasoru, 3)."/".tum_bosluk_sil($isim);
            		@move_uploaded_file($gecici_isim, "$yuklemeklasoru/$isim");

            		$genelayarkaydet=$db->prepare("UPDATE ayarlar SET
            			site_baslik=:baslik,
            			site_aciklama=:aciklama,
            			site_sahibi=:sahip,
            			mail_onayi=:onay,
            			duyuru_onayi=:duyuru_onayi,
            			site_logo=:site_logo where id=1
            			");

            		$ekleme=$genelayarkaydet->execute(array(
            			'baslik' => guvenlik($_POST['site_baslik']),
            			'aciklama' => guvenlik($_POST['site_aciklama']),
            			'sahip' => guvenlik($_POST['site_sahibi']),
            			'onay' => guvenlik($_POST['mail_onayi']),
            			'duyuru_onayi' => guvenlik($_POST['duyuru_onayi']),
            			'site_logo' => $resim_yolu
            		));
            	}
            }

            if ($ekleme) {
            	header("location:../ayarlar.php?durum=ok");
            } else {
            	header("location:../ayarlar.php?durum=no");
            	exit;
            }            
          }


        /********************************************************************************/
      //www.aksoyhlc.net tarafından hazırlanmıştır

        if (isset($_POST['sozekle'])) {
         $sozekle=$db->prepare("INSERT INTO sozler SET
          soz=:soz,
          soz_yazari=:soz_yazari,
          kim_ekledi=:kim_ekledi,
          soz_kayit_tarihi=:soz_kayit_tarihi,
          yazar_resim_yolu=:yazar_resim_yolu
          ");

         $ekleme=$sozekle->execute(array(
          'soz' => guvenlik($_POST['soz']),
          'soz_yazari' => guvenlik($_POST['soz_yazari']),
          'kim_ekledi' => guvenlik($_POST['kim_ekledi']),
          'soz_kayit_tarihi' => guvenlik($_POST['soz_kayit_tarihi']),
          'yazar_resim_yolu' => guvenlik($_POST['yazar_resim_yolu']),
        ));

         $yuklemeklasoru = '../dosyalar';
         @$gecici_isim = $_FILES['yazar_resim_yolu']["tmp_name"];
         @$dosya_ismi = $_FILES['yazar_resim_yolu']["name"];
         $benzersizsayi1=rand(100,10000);
         $isim=$benzersizsayi1.guvenlik($_POST['sip_baslik']).$dosya_ismi;
         $yazar_resim_yolu=substr($yuklemeklasoru, 3)."/".tum_bosluk_sil($isim);
         @move_uploaded_file($gecici_isim, "$yuklemeklasoru/$isim");

         $son_eklenen_id=$db->lastInsertId();

         $dosyayukleme=$db->prepare("UPDATE sozler SET
          dosya_yolu=:yazar_resim_yolu WHERE soz_id=:soz_id ");

         $yukleme=$dosyayukleme->execute(array(
          'yazar_resim_yolu' => $yazar_resim_yolu,
          'soz_id' => $son_eklenen_id
        ));


         if ($ekleme) {
          header("location:../sozler.php?durum=ok");
          exit;
        } else {
          header("location:../sozler.php?durum=no");
          exit;
        }
        exit;
      }


      /********************************************************************************/


      if (isset($_POST['sozguncelle'])) {
       $sozguncelle=$db->prepare("UPDATE sozler SET
        soz=:soz,
        soz_yazari=:soz_yazari,
        kim_ekledi=:kim_ekledi,
        soz_kayit_tarihi=:soz_kayit_tarihi,
        yazar_resim_yolu=:yazar_resim_yolu
        WHERE soz_id={$_POST['soz_id']}");

       $guncelle=$sozguncelle->execute(array(
        'soz' => guvenlik($_POST['soz']),
        'soz_yazari' => guvenlik($_POST['soz_yazari']),
        'kim_ekledi' => guvenlik($_POST['kim_ekledi']),
        'soz_kayit_tarihi' => guvenlik($_POST['soz_kayit_tarihi']),
        'yazar_resim_yolu' => guvenlik($_POST['yazar_resim_yolu'])
      ));


       if ($_FILES['yazar_resim_yolu']['size'] > 0) {

        $yuklemeklasoru = '../dosyalar';
        @$gecici_isim = $_FILES['yazar_resim_yolu']["tmp_name"];
        @$dosya_ismi = $_FILES['yazar_resim_yolu']["name"];
        $benzersizsayi1=rand(10,1000);
        $isim1=guvenlik($_POST['proje_baslik']).$benzersizsayi1.$dosya_ismi;
        $isim=tum_bosluk_sil($isim1);
        $yazar_resim_yolu=substr($yuklemeklasoru, 3)."/".$isim;
        @move_uploaded_file($gecici_isim, "$yuklemeklasoru/$isim");   


        if ($_POST['dosya_sil']=="sil") {
          $dosya_yolu="";
        } else {
          $dosya_yolu=$yazar_resim_yolu;
        };

        $dosyayukleme=$db->prepare("UPDATE soz SET
          dosya_yolu=:yazar_resim_yolu WHERE soz_id=:soz_id ");

        $yukleme=$dosyayukleme->execute(array(
          'yazar_resim_yolu' => $dosya_yolu,
          'soz_id' => $_POST['soz_id']
        ));

      }
      //www.aksoyhlc.net tarafından hazırlanmıştır
      if ($guncelle) {
        header("location:../sozler.php?durum=ok");
        exit;
      } else {
        echo "\nPDOStatement::errorInfo():\n";
        $arr = $guncelle->errorInfo();
        print_r($arr);
        exit;
      }
      exit;
    }






    /********************************************************************************/


    if (isset($_POST['sifreguncelle'])) {

     $eskisifre=guvenlik($_POST['eskisifre']);
     $yenisifre_bir=guvenlik($_POST['yenisifre_bir']); 
     $yenisifre_iki=guvenlik($_POST['yenisifre_iki']);

     $kul_sifre=md5($eskisifre);

     $kullanicisor=$db->prepare("SELECT * FROM kullanicilar WHERE kul_sifre=:sifre AND kul_id=:id");
     $kullanicisor->execute(array(
      'id' => guvenlik($_POST['kul_id']),
      'sifre' => $kul_sifre
    ));

//dönen satır sayısını belirtir
     $say=$kullanicisor->rowCount();

     if ($say==0) {
      header("Location:../profil.php?durum=eskisifrehata");
    } else {
//eski şifre doğruysa başla
      if ($yenisifre_bir==$yenisifre_iki) {
       if (strlen($yenisifre_bir)>=6) {
//md5 fonksiyonu şifreyi md5 şifreli hale getirir.
        $sifre=md5($yenisifre_bir);
        $kullanici_yetki=0;
        $kullanicikaydet=$db->prepare("UPDATE kullanicilar SET
         kul_sifre=:kul_sifre
         WHERE kul_id=:kul_id");

        $insert=$kullanicikaydet->execute(array(
         'kul_sifre' => $sifre,
         'kul_id'=>guvenlik($_POST['kul_id'])
       ));

        if ($insert) {
         header("Location:../profil.php?durum=sifredegisti");
//Header("Location:../production/genel-ayarlar?durum=ok");
       } else {
         header("Location:../profil.php?durum=no");
       }

// Bitiş
     } else {
      header("Location:../profil.php?durum=eksiksifre");
    }

  } else {
   header("Location:../profil.php?durum=sifreleruyusmuyor");
   exit;
 }
}
exit;
if ($update) {
  header("Location:../profil.php?durum=ok");

} else {
  header("Location:../profil.php?durum=no");
}
}


/********************************************************************************/


if (isset($_POST['profilguncelle'])) {

 if (isset($_SESSION['kul_mail'])) {

			$boyut = $_FILES['kul_logo']['size'];//Dosya boyutumuzu alıp değişkene aktardık.
            if($boyut > 3145728)//Burada dosyamız 3 mb büyükse girmesini söyledik
            {
            //İsteyen arkadaslar burayı istediği gibi değiştirebilir size kalmış bir şey
                echo 'Dosya 3MB den büyük olamaz.';// 3 mb büyükse ekrana yazdıracağımız alan
              } else {
               $yuklemeklasoru = '../img';
               @$gecici_isim = $_FILES['kul_logo']["tmp_name"];
               @$dosya_ismi = $_FILES['kul_logo']["name"];
               $benzersizsayi1=rand(10000,99999);
               $benzersizsayi2=rand(10000,99999);
               $isim=$benzersizsayi1.$benzersizsayi2.$dosya_ismi;
               $resim_yolu=substr($yuklemeklasoru, 3)."/".tum_bosluk_sil($isim);
               @move_uploaded_file($gecici_isim, "$yuklemeklasoru/$isim");            	
             }

             $uzunluk=strlen($resim_yolu);
             if ($uzunluk<18) {
               $profilguncelle=$db->prepare("UPDATE kullanicilar SET
                kul_isim=:isim,
                kul_mail=:mail,
                kul_telefon=:telefon,
                kul_unvan=:unvan WHERE session_mail=:session_mail");
               $ekleme=$profilguncelle->execute(array(
                'isim' => guvenlik($_POST['kul_isim']),
                'mail' => guvenlik($_POST['kul_mail']),
                'telefon' => guvenlik($_POST['kul_telefon']),
                'unvan' => guvenlik($_POST['kul_unvan']),
                'session_mail' => $_SESSION['kul_mail']
              ));
      //www.aksoyhlc.net tarafından hazırlanmıştır
               if ($ekleme) {
                header("Location:../kullanicilar.php?durum=ok");
              } else {

                header("Location:../kullanicilar.php?durum=no");
              }
              exit;
            } else {
            	$profilguncelle=$db->prepare("UPDATE kullanicilar SET
            		kul_isim=:isim,
            		kul_mail=:mail,
            		kul_telefon=:telefon,
            		kul_unvan=:unvan,
            		kul_logo=:logo WHERE session_mail=:session_mail");
            	$ekleme=$profilguncelle->execute(array(
            		'isim' => guvenlik($_POST['kul_isim']),
            		'mail' => guvenlik($_POST['kul_mail']),
            		'telefon' => guvenlik($_POST['kul_telefon']),
            		'unvan' => guvenlik($_POST['kul_unvan']),
            		'logo' => $resim_yolu,
            		'session_mail' => $_SESSION['kul_mail']
            	));

            	if ($ekleme) {
            		header("Location:../profil.php?durum=ok");
            	} else {
            		header("Location:../profil.php?durum=noff");
            	}
            	exit;
            }

          }
          header("Location:../profil.php");
          exit;

        }


        /********************************************************************************/



        if (isset($_POST['sozsilme'])) {
         $sil=$db->prepare("DELETE from sozler where soz_id=:id");
         $kontrol=$sil->execute(array(
          'id' => guvenlik($_POST['soz_id'])
        ));

         if ($kontrol) {
//echo "kayıt başarılı";
          header("location:../sozler.php?durum=ok");
          exit;
        } else {
//echo "kayıt başarısız";
          header("location:../sozler.php?durum=no");
          exit;

        }
      }
      //www.aksoyhlc.net tarafından hazırlanmıştır

      /********************************************************************************/



        if (isset($_POST['mesajsilme'])) {
         $sil=$db->prepare("DELETE from mesajlar where id=:id");
         $kontrol=$sil->execute(array(
          'id' => guvenlik($_POST['id'])
        ));

         if ($kontrol) {
//echo "kayıt başarılı";
          header("location:../mesajlar.php?durum=ok");
          exit;
        } else {
//echo "kayıt başarısız";
          header("location:../mesajlar.php?durum=no");
          exit;

        }
      }
      //www.aksoyhlc.net tarafından hazırlanmıştır

      /********************************************************************************/




              if (isset($_POST['ziyaretcisilme'])) {
         $sil=$db->prepare("DELETE from ziyaretciler where id=:id");
         $kontrol=$sil->execute(array(
          'id' => guvenlik($_POST['id'])
        ));

         if ($kontrol) {
//echo "kayıt başarılı";
          header("location:../ziyaretciler.php?durum=ok");
          exit;
        } else {
//echo "kayıt başarısız";
          header("location:../ziyaretciler.php?durum=no");
          exit;

        }
      }
      //www.aksoyhlc.net tarafından hazırlanmıştır

      /********************************************************************************/



    if (yetkikontrol()!="yetkili") {
    	header("location:../index.php");
    	exit;
    }
    ?>
