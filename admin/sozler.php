<?php 
include'header.php' 
?>

<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<style type="text/css" media="screen">
  @media only screen and (max-width: 700px) {
    .mobilgizle {
      display: none;
    }
    .mobilgizleexport {
      display: none;
    }
    .mobilgoster {
      display: block;
    }
  }
  @media only screen and (min-width: 700px) {
    .mobilgizleexport {
      display: flex;
    }
    .mobilgizle {
      display: block;
    }
    .mobilgoster {
      display: none;
    }
  }
</style>

<div class="container-fluid">

  <h1 class="h3 mb-2 text-gray-800">Sözler</h1>
  <!--<p class="mb-4">Burada alandan Sözlerinize ait bilgileri görüntüleyebilir ve dışa aktarabilirsiniz.</p>-->
  
  <!-- DataTales Giriş -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Tüm Sözler</h6>
    </div>
    <div class="card-body" style="width: 100%">
      <!--Tablo filtreleme butonları mobilde gizlendiğinde gözükecek buton-->
      <button type="button"class="btn btn-sm btn-info btn-icon-split mobilgoster">
        <span class="icon text-white-65">
          <i class="fas fa-edit"></i>
        </span>
        <span class="text">Seçenekler</span>
      </button>
      <div class="mobilgizle gizlemeyiac" style="margin-bottom: 10px;">
        <!--Tablo filtreleme butonları bölümü giriş-->
        <button type="button" id="hepsi" style="margin-bottom: 5px;" class="btn btn-sm btn-info btn-icon-split">
          <span class="icon text-white-65">
            <i class="fas fa-edit"></i>
          </span>
          <span class="text">Hepsi</span>
        </button>
        
        <button type="button" id="normal" style="margin-bottom: 5px;" class="btn btn-sm btn-primary btn-icon-split">
          <span class="icon text-white-65">
            <i class="fas fa-clock"></i>
          </span>
          <span class="text">Normal</span>
        </button>

        <button type="button" id="onemsizler" style="margin-bottom: 5px;" class="btn btn-sm btn-warning btn-icon-split">
          <span class="icon text-white-65">
            <i class="fas fa-circle-notch"></i>
          </span>
          <span class="text">Önemsizler</span>
        </button>
        <!--Tablo filtreleme butonları bölümü çıkış-->
        <!--Tabloyu excel-pdf-csv olarak dışa aktarma butonlarının olduğu alan giriş-->
        <span class="dropdown no-arrow">
         <button data-toggle="dropdown" aria-expanded="false" type="button" id="aktarmagizleme" style="margin-left: 4px; margin-bottom: 5px;" class="btn btn-sm btn-primary btn-icon-split dropdown-toggle">
          <span class="icon text-white-65">
            <i class="fas fa-file-export"></i>
          </span>
          <span class="text">Dışa Aktar</span>
        </button> 
        <div class="dropdown-menu" aria-labelledby="aktarmagizleme">
          <a class="dropdown-item" href="#">
            <button type="button" onclick="fnAction('copy');" title="asdsad" attr="Tabloyu Kopyala" class="btn btn-sm btn-icon-split btn-dark">
              <span class="icon text-white-65">
                <i class="fas fa-copy"></i>
              </span>
              <span class="text">Kopyala</span>
            </button>
          </a>
          <a class="dropdown-item" title="">  
            <button type="button" onclick="fnAction('excel');" attr="Excel Formatında Dışa Aktar" class="btn btn-sm btn-icon-split btn-success">
              <span class="icon text-white-65">
                <i class="fas fa-file-excel"></i>
              </span>
              <span class="text">Excel</span>
            </button>
          </a>
          <a class="dropdown-item" href="#">
            <button type="button" onclick="fnAction('pdf');" attr="PDF Formatında Dışa Aktar" class="btn btn-sm btn-icon-split btn-danger">
              <span class="icon text-white-65">
                <i class="fas fa-file-pdf"></i>
              </span>
              <span class="text">PDF</span>
            </button>
          </a>
          <a class="dropdown-item" href="#">
            <button type="button" onclick="fnAction('csv');" attr="CSV Formatında Dışa Aktar" class="btn btn-sm btn-icon-split btn-primary">
              <span class="icon text-white-65">
                <i class="fas fa-file-csv"></i>
              </span>
              <span class="text">CSV</span>
              </button
              ></a>
            </div>
          </span>
          <!--Tabloyu excel-pdf-csv olarak dışa aktarma butonlarının olduğu alan çıkış-->
        </div>
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr> 
                <th>No</th>
                <th>Söz</th>
                <th>Yazarı</th>
                <th>Sözü Sisteme Yükleyen</th>
                <th>Ekleme Tarihi</th>
                <th>İşlemler</th>

              </tr>
            </thead>
            <!--While döngüsü ile veritabanında ki verilerin tabloya çekilme işlemi giriş-->
            <tbody>
             <?php 
             $say=0;
             $sozsorgula=$db->prepare("SELECT * FROM sozler");
             $sozsorgula->execute();
             while ($sozcek=$sozsorgula->fetch(PDO::FETCH_ASSOC)) { $say++?>

               <tr>
                <td><?php echo $say; ?></td>
                <td><?php echo $sozcek['soz']; ?></td>
                <td><?php echo $sozcek['soz_yazari']; ?></td>
                <td><?php echo $sozcek['soz_kayit_tarihi']; ?></td>
                <td><?php echo $sozcek['kim_ekledi']; ?></td>
                <td> 
                  <?php 
                  if (yetkikontrol()=="yetkili") {?>
                    <div class="d-flex justify-content-center">
                     <form action="sozduzenle.php" method="POST">
                      <input type="hidden" name="soz_id" value="<?php echo $sozcek['soz_id'] ?>">
                      <button type="submit" name="duzenleme" class="btn btn-success btn-sm btn-icon-split">
                        <span class="icon text-white-60">
                          <i class="fas fa-edit"></i>
                        </span>
                      </button>
                    </form>
                    <form class="mx-1" action="islemler/islem.php" method="POST">
                      <input type="hidden" name="soz_id" value="<?php echo $sozcek['soz_id'] ?>">
                      <button type="submit" name="sozsilme" class="btn btn-danger btn-sm btn-icon-split">
                        <span class="icon text-white-60">
                          <i class="fas fa-trash"></i>
                        </span>
                      </button>
                    </form>  
                  <?php } ?>
                
                </div>
              </td>              
            </tr>
          <?php } ?>
        </tbody>
        <!--While döngüsü ile veritabanında ki verilerin tabloya çekilme işlemi çıkış-->
      </table>
    </div>
  </div>
</div>
<!--Datatables çıkış-->
</div>


<?php include'footer.php' ?>

<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/demo/datatables-demo.js"></script> 
<script src="vendor/datatables/dataTables.buttons.min.js"></script>
<script src="vendor/datatables/buttons.flash.min.js"></script>
<script src="vendor/datatables/jszip.min.js"></script>
<script src="vendor/datatables/pdfmake.min.js"></script>
<script src="vendor/datatables/vfs_fonts.js"></script>
<script src="vendor/datatables/buttons.html5.min.js"></script>
<script src="vendor/datatables/buttons.print.min.js"></script>
<script type="text/javascript">
  $("#aktarmagizleme").click(function(){
    $(".dt-buttons").toggle();
  });
</script>
<script type="text/javascript">
  $(".mobilgoster").click(function(){
    $(".gizlemeyiac").toggle();
  });
</script>
<script>
  var dataTables = $('#dataTable').DataTable({
    "ordering": true,  //Tabloda sıralama özelliği gözüksün mü? true veya false
    "searching": true,  //Tabloda arama yapma alanı gözüksün mü? true veya false
    "lengthChange": true, //Tabloda öğre gösterilme gözüksün mü? true veya false
    "info": true,
    dom: "<'row mobilgizleexport gizlemeyiac'<'col-md-6'l><'col-md-6'f><'col-md-4 d-none d-print-block'B>>rtip",
    buttons: [
    {
      extend: 'copyHtml5', 
      className: 'kopyalama-buton',
      messageBottom: "ECBMEDYA Tarafından Oluşturulmuştur.",
    },
    {
      extend: 'excelHtml5', 
      className: 'excel-buton',
      messageBottom: 'ECBMEDYA Tarafından Oluşturulmuştur.',
    },
    {
     extend: 'pdfHtml5',
     className: 'pdf-buton',
     messageBottom: 'ECBMEDYA Tarafından Oluşturulmuştur.',
   },
   {
    extend: 'csvHtml5',
    className: 'csv-buton',
    messageBottom: 'ECBMEDYA Tarafından Oluşturulmuştur.',
  }
  ]
});
  //Sonradan yapılan butona tıklandığında asıl dışa aktarma butonunun çalışması
  function fnAction(action) {
    switch (action) {
      case "excel":
      $('.excel-buton').trigger('click');
      break;
      case "pdf":
      $('.pdf-buton').trigger('click');
      break;
      case "copy":
      $('.kopyalama-buton').trigger('click');
      break;
      case "csv":
      $('.csv-buton').trigger('click');
      break;
    }
  }
  //Tablo filtreleme işlemleri
  $('#hepsi').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(5).search("").draw();
  }); 
  $('#normal').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(5).search("Normal").draw();
  }); 
  $('#onemsizler').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(5).search("Acelesi Yok").draw();
  }); 
</script>

<?php if (@$_GET['durum']=="no")  {?>  
  <script>
    Swal.fire({
      type: 'error',
      title: 'İşlem Başarısız',
      text: 'Lütfen Tekrar Deneyin',
      showConfirmButton: true,
      confirmButtonText: 'Kapat'
    })
  </script>
<?php } ?>

<?php if (@$_GET['durum']=="ok")  {?>  
  <script>
    Swal.fire({
      type: 'success',
      title: 'İşlem Başarılı',
      text: 'İşleminiz Başarıyla Gerçekleştirildi',
      showConfirmButton: false,
      timer: 2000
    })
  </script>
  <?php } ?>