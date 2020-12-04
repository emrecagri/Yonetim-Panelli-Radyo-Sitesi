<?php include 'ziyaretciipkayit.php'; ?>
<html lang="tr">

<head>

  <title>Radyo Sitesi</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0, shrink-to-fit=no">
  <meta name="author" content="Eugenio Segala">
  <meta name="description" content="An extremely easy and clear SlideShow Background dev in Vanilla JS.">
  <meta name="keywords" content="javascript,background-image,slides,slider,slideshow,gallery,js">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

  <!--google fontsdan font çektim-->
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital@1&display=swap" rel="stylesheet">
  <!--google fontsdan font çektim-->
  <style>
    body {

      /*border: 2.1vh solid black;*/

      color: white;
      height: 100%;
      width: 100%;
    }

    .ct {
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;

    }

.sozkutusu {
  font-size:35px;
  font-family: 'Cormorant Garamond', serif;
  
}

.koyuefekt {
  background-color: rgba(0,0,0,.30);
}
  </style>



<!-- scrollbar tasarımı-->
<style type="text/css">
::-webkit-scrollbar {
  width: 1px;
  height: 1px;
}
::-webkit-scrollbar-button {
  width: 0px;
  height: 0px;
}
::-webkit-scrollbar-thumb {
  background: #000000;
  border: 0px none #ffffff;
  border-radius: 50px;
}
::-webkit-scrollbar-thumb:hover {
  background: #000000;
}
::-webkit-scrollbar-thumb:active {
  background: #000000;
}
::-webkit-scrollbar-track {
  background: #000000;
  border: 0px none #ffffff;
  border-radius: 50px;
}
::-webkit-scrollbar-track:hover {
  background: #000000;
}
::-webkit-scrollbar-track:active {
  background: #333333;
}
::-webkit-scrollbar-corner {
  background: transparent;
}
</style>
<!-- scrollbar tasarımı-->


<!-- sayfa yenilemeden veritabanından veri çekme -->
<script src="http://code.jquery.com/jquery-1.9.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {

        $("#soz").load("soz.php");

});

setInterval(function() {$("#soz").load('soz.php');}, 10000);
</script>
<!-- sayfa yenilemeden veritabanından veri çekme -->


</head>

<body>

 <div class="koyuefekt">

  <div class="container ct">

    <div class="row">



      <div class="sozkutusu">
      	<!-- sayfa yenilemeden veritabanından veri çekme -->
      	<div id="soz"></div>
      	<!-- sayfa yenilemeden veritabanından veri çekme -->
      </div>




    </div>



  </div>


<!-- arkaplan rastgele olsun diye resim sayısınca benzersiz sayı üretip diziye atıoruz -->
<?php
 
   $sayilar=range(1,10);
   shuffle($sayilar);
   for ($i=0; $i<10; $i++) {      
      $sonuc[$i]=$sayilar[$i];    
   }    
   sort($sonuc);    
   

 
?><!-- arkaplan rastgele olsun diye resim sayısınca benzersiz sayı üretip diziye atıoruz 
altta da diziden çekip foto numaralarını rastgele vermiş oluyoruz-->


<!-- her foto eklemede klasörde yeni bir sayı ver ve üstteki döngüdeki sayıyı eklediğin foto sayısı kadar arttır. aşağıya slide bölümüne de yeni bir dizin olarak ekle. onun altındaki delay süresine de eklediğin foto kadar süre ekle. -->
  <script src="js/easy_background.js"></script>

  <script>
    easy_background("body",

      {
        slide: [
         "img/<?php echo $sayilar[0]; ?>.jpg",
         "img/<?php echo $sayilar[1]; ?>.jpg",
         "img/<?php echo $sayilar[2]; ?>.jpg",
         "img/<?php echo $sayilar[3]; ?>.jpg",
         "img/<?php echo $sayilar[4]; ?>.jpg",
         "img/<?php echo $sayilar[5]; ?>.jpg",
         "img/<?php echo $sayilar[6]; ?>.jpg",
         "img/<?php echo $sayilar[7]; ?>.jpg",
         "img/<?php echo $sayilar[8]; ?>.jpg",
         "img/<?php echo $sayilar[9]; ?>.jpg"
         ],

        delay: [
         10000,
         10000,
         10000,
         10000,
         10000,
         10000,
         10000,
         10000,
         10000,
         10000
         ]
      }


    );
  </script>




</div>








<!-- sol alta küçük yazı -->
<div style="

background-color: rgba(0, 0, 0, 0.3);
    -webkit-backdrop-filter: blur(10px);
    backdrop-filter: blur(10px);


font-size: 15px; 
color: #cccccc;
line-break: anywhere;
word-break: normal;
overflow: hidden;
white-space: nowrap;
text-overflow: ellipsis;
 font-family: Interstate,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Garuda,Verdana,Tahoma,sans-serif;
 font-weight: 100;
 ">

  &nbsp;
  <!-- müzik başlangıcı -->
  <iframe src="a.mp3" loop id="x" allow="autoplay" style="display:none">
</iframe> 
<audio id="y">

  <source src="music.mp3"  type="audio/mpeg">

</audio>

<button onclick="play()">▶ Müziği oynat</button>

<button onclick="pause()">Durdur</button>  
  
<script>
 function play() {
       y.play();
    }

    function pause() {

      x.setAttribute("src", "");
       y.pause();
    }  
</script>
 <!-- müzik bitişi -->
 |
  <a href="iletisimformu.php" title="" target="_blank" style="color: #cccccc; text-decoration: none;">Mesaj Gönder</a>
  |
  <a href="sozgondermeformu.php" title="" target="_blank" style="color: #cccccc; text-decoration: none;">Söz Ekle</a>

  <a href="http://github.com/emrecagri" title="" style="color: #cccccc; text-decoration: none; float: right;">V1 github.com/emrecagri&nbsp;&nbsp;</a>
  

</div>
<!-- sol alta küçük yazı -->


</body>

</html>
