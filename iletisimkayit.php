<?php include 'ziyaretciipkayit.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Teşekkürler</title>
       <style type="text/css">
         .css-input { border-style:solid; padding:7px; border-width:1px; background-color:#000000; color:#ffffff; border-color:#ffffff; font-size:18px; box-shadow: -1px 3px 5px 0px rgba(0,0,0,.0); font-weight:normal; font-style:none; font-family:sans-serif;  } 
         .css-input:focus { outline:none; }

         .myButton {
    box-shadow:inset 0px 34px 0px -15px #000000;
    background:linear-gradient(to bottom, #000000 5%, #000000 100%);
    background-color:#000000;
    border:1px solid #ffffff;
    display:inline-block;
    cursor:pointer;
    color:#ffffff;
    font-family:Arial;
    font-size:15px;
    font-weight:bold;
    padding:9px 23px;
    text-decoration:none;
    text-shadow:0px -1px 0px #000000;
}
.myButton:hover {
    background:linear-gradient(to bottom, #000000 5%, #000000 100%);
    background-color:#000000;
}
.myButton:active {
    position:relative;
    top:1px;
}
 
    </style>
</head>
<body bgcolor="black">
<center>
    <font face="arial" color="white">
        <h3>
             <?php 

include 'admin/islemler/baglan.php'; //vtbaglan.php sayfasındaki tüm kodları bu sayfaya çağırdık

if($_POST)
    $adsoyad = $_POST["adsoyad"];
    $mail = $_POST["mail"];
    $konu = $_POST["konu"];
    $mesaj = $_POST["mesaj"];
    date_default_timezone_set('Europe/Istanbul');
    $gonderimtarihi = date('d.m.Y H:i');
    $ipadresi = $_SERVER["REMOTE_ADDR"];


    $uzakhost='<br><b>Bilgisayar Adı-Uzak Host:</b> '. gethostbyaddr($_SERVER['REMOTE_ADDR']);
    $tarayici='<br><b>İnternet Tarayıcısı:</b> '. @$_SERVER['HTTP_USER_AGENT'];
    $geldigiadres='<br><b>Geldiği Adres:</b> '. @$_SERVER['HTTP_REFERER'];
    $tarayicidili='<br><b>Tarayıcı Dili:</b> '. @$_SERVER['HTTP_ACCEPT_LANGUAGE'];
    $gercekip='<br><b>Gerçek IP (Proxy ile gelmişse):</b> '. @$_SERVER['HTTP_X_FORWARDED_FOR'];

    $bilgileri=$uzakhost.$tarayici.$geldigiadres.$tarayicidili.$gercekip;

    
    if($ekle=mysqli_query($baglanti,"INSERT INTO mesajlar(adsoyad,mail,konu,mesaj,gonderimtarihi,ipadresi,bilgileri) VALUES('$adsoyad','$mail','$konu','$mesaj','$gonderimtarihi','$ipadresi','$bilgileri')"))
    
    {
        echo 'Başarıyla gönderildi.<br>Teşekkür ederim.';
        
    }else{
            echo 'Gönderilemedi.<br>Bir hata oldu. Lütfen sonra tekrar deneyin.';
    }
            

 ?>


        </h3>
        <br>
<button class="myButton"><a href="index.php">Siteye Dön</a></button>
    </font>
</center>
</body>
</html>