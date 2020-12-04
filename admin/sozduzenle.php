<?php 
include 'header.php' ;
if (yetkikontrol()!="yetkili") {
	header("location:index.php?durum=izinsiz");
	exit;
}
if (isset($_POST['soz_id'])) {
	$kayitsor=$db->prepare("SELECT * FROM sozler where soz_id=:id");
	$kayitsor->execute(array(
		'id' => guvenlik($_POST['soz_id'])
	));
	$kayitcek=$kayitsor->fetch(PDO::FETCH_ASSOC);
} else {
	header("location:sozler");
} 

?>
<!--<script src="ckeditor/ckeditor.js"></script>-->
<link rel="stylesheet" media="all" type="text/css" href="vendor/upload/css/fileinput.min.css">
<link rel="stylesheet" type="text/css" media="all" href="vendor/upload/themes/explorer-fas/theme.min.css">
<script src="vendor/upload/js/fileinput.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/fas/theme.min.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/explorer-fas/theme.minn.js" type="text/javascript" charset="utf-8"></script>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h5 class="m-0 font-weight-bold text-primary">Söz Düzenleme İşlemi   
						<small>
							<?php 
							if (isset($_GET['islem'])) { 
								if (guvenlik($_GET['islem'])=="ok") {?> 
									<b style="color: green; font-size: 16px;">İşlem Başarılı</b>
								<?php } elseif (guvenlik($_GET['islem'])=="no") { ?> 
									<b style="color: red; font-size: 16px;">İşlem Başarısız</b>
								<?php } } ?>

							</small>
						</h5>
					</div>
					<div class="card-body">
						<form action="islemler/islem.php" method="POST"  enctype="multipart/form-data"  data-parsley-validate>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>Söz</label>
									<input type="text" class="form-control" name="soz" value="<?php echo $kayitcek['soz'] ?>">
								</div>
								<div class="form-group col-md-6">
									<label>Yazarı</label>
									<input type="text" class="form-control" name="soz_yazari" value="<?php echo $kayitcek['soz_yazari'] ?>">
								</div>	
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>Kim Ekledi?</label>
									<input type="text" class="form-control" name="kim_ekledi" value="<?php echo $kayitcek['kim_ekledi'] ?>">
								</div>
								<div class="form-group col-md-6">
									
									<label>Söz Kayıt Tarihi</label>
									<input disabled type="text" class="form-control" name="soz_kayit_tarihi" value="<?php echo $kayitcek['soz_kayit_tarihi'] ?>">
								</div>
							</div>
							</div>
							
							<div class="form-row">	
								
								



	



							</div>			
							<div class="form-row">
								<div class="col-md-6">
									<div class="file-loading">
										<input type="file" class="form-control" id="sozresim" name="soz_resim" >
									</div>
									<div class="custom-control custom-checkbox small mt-2">
										<input type="checkbox" class="custom-control-input" value="sil" id="dosya_sil" name="dosya_sil">
										<label class="custom-control-label" for="dosya_sil">Resimi Sil</label>
									</div>
								</div>

							</div>			
							
							<input type="hidden" class="form-control" name="soz_id" value="<?php echo $kayitcek['soz_id'] ?>">
							<button type="submit" name="sozguncelle" class="btn btn-success">Kaydet</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include 'footer.php' ?>
	<script src="ckeditor/ckeditor.js"></script>
	<script>
		CKEDITOR.replace( 'editor' );
	</script>
	<?php 
	if (strlen($kayitcek['yazar_resim_yolu'])>10) {?>
		<script>
			$(document).ready(function () {
				var url1='<?php echo $kayitcek['yazar_resim_yolu'] ?>';
				$("#sozresim").fileinput({
					'theme': 'explorer-fas',
					'showUpload': false,
					'showCaption': true,
					'showDownload': true,
			//	'initialPreviewAsData': true,
			allowedFileExtensions: ["jpg", "png", "jpeg"],
			initialPreview: [
			'<img src="<?php echo $kayitcek['yazar_resim_yolu'] ?>" style="height:90px" class="file-preview-image" alt="Dosya" title="Dosya">'
			],
			initialPreviewConfig: [
			{downloadUrl: url1,
				showRemove: false,
			},
			],
		});

			});
		</script>
	<?php } else { ?>
		<script>
			$(document).ready(function () {
				var url1='<?php echo $kayitcek['yazar_resim_yolu'] ?>';
				$("#sozresim").fileinput({
					'theme': 'explorer-fas',
					'showUpload': false,
					'showCaption': true,
					'showDownload': true,
			//	'initialPreviewAsData': true,
			allowedFileExtensions: ["jpg", "png", "jpeg", "mp4", "zip", "rar"],
		});

			});
		</script>
	<?php } ?>
