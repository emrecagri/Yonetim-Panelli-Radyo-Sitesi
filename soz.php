<?php
include ("admin/vtbaglan.php");



$sql="SELECT * FROM sozler ORDER BY RAND() LIMIT 1";
$sorgu=mysqli_query($baglanti,$sql);
$sonuc=mysqli_fetch_assoc($sorgu);

    echo $sonuc["soz"];
    echo "<br>";
    echo '-' . $sonuc["soz_yazari"];  


  ?>