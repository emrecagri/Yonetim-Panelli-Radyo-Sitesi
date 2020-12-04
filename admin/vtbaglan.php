<?php 
$baglanti=mysqli_connect('localhost','root','','soz');
if(!$baglanti) {
echo "Veritabanına bağlanılamadı ".mysqli_connect_error();

}

//tr karakter sorunu çözümü
mysqli_set_charset($baglanti,"uft8");
mysqli_query($baglanti,"SET NAMES 'utf8'  ");
mysqli_query($baglanti,"SET CHARACTER SET utf8");
mysqli_query($baglanti,"SET COLLATION_CONNECTION = 'utf8_general_ci' ");
//tr karakter sorunu çözümü

?>