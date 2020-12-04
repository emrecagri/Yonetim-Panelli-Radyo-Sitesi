<?php 
include 'header.php';
if (yetkikontrol()!="yetkili") {
  header("location:index.php?durum=izinsiz");
  exit;
}
?>
<link rel="stylesheet" media="all" type="text/css" href="vendor/upload/css/fileinput.min.css">
<link rel="stylesheet" type="text/css" media="all" href="vendor/upload/themes/explorer-fas/theme.min.css">
<script src="vendor/upload/js/fileinput.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/fas/theme.min.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/explorer-fas/theme.minn.js" type="text/javascript" charset="utf-8"></script>
<!-- Begin Page Content -->
<div class="container">
  <form action="islemler/islem.php" method="POST" enctype="multipart/form-data"  data-parsley-validate>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Söz</label>
        <input type="text" class="form-control" required name="soz" placeholder="Muhteşem Bir Söz Yaz">
      </div>
      <div class="form-group col-md-6">
        <label>Yazarı</label>
        <input type="text" class="form-control" required name="soz_yazari" placeholder="Peki Bu Harika Sözü Kim Yazdı?">
      </div>
      
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Sisteme Kim Ekliyor?</label>
        <input type="Text" class="form-control" required name="kim_ekledi" placeholder="Bu Sözü Sisteme Kim Ekliyor?">
      </div>
      
    </div>
    <div class="form-row">
      
      
    </div>

    <div class="form-row">

      <div class="form-group col-md-6">
        <label>Söz Ekleme Tarihi?</label>
        <input type="date" class="form-control" required name="soz_kayit_tarihi" placeholder="Yakında Otomatik Olacak">
      </div>
      
     
    </div>
    <div class="form-row mb-3">
  <div class="col-md-6">
    <div class="file-loading">
      <input class="form-control" id="yazar_resim_yolu"  name="yazar_resim_yolu" type="file">
    </div>
  </div>
</div>
<div class="form-row">
  
</div>
<button type="submit" name="sozekle" class="btn btn-primary">Kaydet</button>
</form>
</div>
<!-- End of Main Content -->
<?php include 'footer.php' ?>
<script src="ckeditor/ckeditor.js"></script>
<script>
  CKEDITOR.replace( 'editor' );
</script>
<!--İşlem sonucu açılan bildirim popupunu otomatik kapatma giriş-->
<script type="text/javascript">
  $('#islemsonucu').modal('show');
  setTimeout(function() {
    $('#islemsonucu').modal('hide');
  }, 3000);
</script>
<!--İşlem sonucu açılan bildirim popupunu otomatik kapatma çıkış-->
<script>
  $(document).ready(function () {
    $("#yazar_resim_yolu").fileinput({
      'theme': 'explorer-fas',
      'showUpload': false,
      'showCaption': true,
      showDownload: true,
       allowedFileExtensions: ["jpg", "png", "jpeg"],
    });
  });
</script>