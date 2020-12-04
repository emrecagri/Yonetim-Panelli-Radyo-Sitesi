<?php include 'ziyaretciipkayit.php'; ?>
<html>
<head>
    <title>İletişim</title>
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
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0;">
</head>
<body bgcolor="black">
<center>
  <font color="white" face="arial"><h2>İletişim Formu</h2></font>

<form action="iletisimkayit.php" method="POST">
<font color="white" face="arial">Adınız</font><br>
<input class="css-input" type="text" placeholder="Boş kalabilir..."   name="adsoyad"  >
<br><br>
<font color="white" face="arial">Mail Adresiniz</font><br>
<input class="css-input" type="email"  placeholder="Boş kalabilir..." name="mail"  >

<br><br>
<font color="white" face="arial">Sözünüz</font><br>
<textarea style="margin: 0px; width: 214px; height: 225px;" class="css-input" placeholder="Sitemize kazandıracağınız o muhteşem söz nedir?" name="mesaj" required ></textarea>


<br><br>
<font color="white" face="arial">Yazarı</font><br>
<input class="css-input" type="text"  placeholder="Bu harika sözün yazarı kim?" name="konu" required >
<br><br>

<button type="submit" class="myButton">Gönder</button>
<br><br>
<input type="button" value="Göndermeyi iptal et" onclick="window.close()">
</form>
</center>
</body>
</html>