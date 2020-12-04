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

  <h1 class="h3 mb-2 text-gray-800">Ziyaretçiler</h1>
  <!--<p class="mb-4">açıklama satırı.</p>-->
  
  <!-- DataTales Giriş -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Tüm Ziyaretçiler</h6>
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
    
        <!--Tablo filtreleme butonları bölümü çıkış-->
        <!--Tabloyu excel-pdf-csv olarak dışa aktarma butonlarının olduğu alan giriş-->
        <span class="dropdown no-arrow">
            <a href="tumziyaretcilerisil.php">Hepsini Sil</a>
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
           - IP Adresiniz: <?php echo $_SERVER['REMOTE_ADDR']; ?>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr> 
                <th>No</th>
                <th>Geldiği Adres</th>
                <th>IP Adresi</th>
                <th>Nereye Geldi</th>
                <th>Tarih</th>
                <th>PC Adı</th>
                <th>Tarayıcı Adı</th>
                <th>Tarayıcı Dili</th>
                <th>Proxy Varsa Gerçek IP'si</th>
                <th>işlemler</th>

              </tr>
            </thead>
            <!--While döngüsü ile veritabanında ki verilerin tabloya çekilme işlemi giriş-->
            <tbody>
             <?php 
             $say=0;
             $ziyaretcisor=$db->prepare("SELECT * FROM ziyaretciler");
             $ziyaretcisor->execute();
             while ($ziyaretcicek=$ziyaretcisor->fetch(PDO::FETCH_ASSOC)) { $say++?>

               <tr>
                <td><?php echo $say; ?></td>
                <td><?php echo $ziyaretcicek['dis_adres']; ?></td>
                <td><?php echo $ziyaretcicek['ziyaretci_ip']; ?></td>
                <td><?php echo $ziyaretcicek['ic_adres']; ?></td>
                <td><?php echo $ziyaretcicek['giris_tarihi']; ?></td>
                <td><?php echo $ziyaretcicek['pcadi']; ?></td>
                <td><?php echo $ziyaretcicek['tarayici']; ?></td>
                <td><?php echo $ziyaretcicek['tarayicidili']; ?></td>
                <td><?php echo $ziyaretcicek['gercekip']; ?></td>
                <td> 
                  <?php 

                  if (yetkikontrol()=="yetkili") {?>
                    <div class="d-flex justify-content-center">
                    


                   <form class="mx-1" action="https://www.infosniper.net/index.php" >
                      <input type="hidden" name="ip_address" value="<?php echo $ziyaretcicek['ziyaretci_ip'] ?>">
                      <button type="submit" class="btn btn-success btn-sm btn-icon-split">
                        <span class="icon text-white-60">
                          <i class="fas fa-angle-right"></i>
                        </span>
                      </button>
                    </form>


                    <form class="mx-1" action="https://whatismyipaddress.com/ip/<?php echo $ziyaretcicek['ziyaretci_ip'] ?>" >
                      <button type="submit" class="btn btn-success btn-sm btn-icon-split">
                        <span class="icon text-white-60">
                          <i class="fas fa-angle-double-right"></i>
                        </span>
                      </button>
                    </form>



                    <form class="mx-1" action="islemler/islem.php" method="POST">
                      <input type="hidden" name="id" value="<?php echo $ziyaretcicek['id'] ?>">
                      <button type="submit" name="ziyaretcisilme" class="btn btn-danger btn-sm btn-icon-split">
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
      messageBottom: "ECBMEDYA İş Takip Sistemi Tarafından Oluşturulmuştur.",
    },
    {
      extend: 'excelHtml5', 
      className: 'excel-buton',
      messageBottom: 'ECBMEDYA İş Takip Sistemi Tarafından Oluşturulmuştur.',
    },
    {
     extend: 'pdfHtml5',
     className: 'pdf-buton',
     messageBottom: 'ECBMEDYA İş Takip Sistemi Tarafından Oluşturulmuştur.',
   },
   {
    extend: 'csvHtml5',
    className: 'csv-buton',
    messageBottom: 'ECBMEDYA İş Takip Sistemi Tarafından Oluşturulmuştur.',
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
  $('#acil').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(5).search("Acil").draw();
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
  $('#acelesiyok').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(5).search("Acelesi Yok").draw();
  }); 
  $('#bitti').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(6).search("Sipariş Tamamlandı").draw();
  }); 
  $('#devam').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(6).search("Sipariş Üzerinde Çalışılıyor").draw();
  }); 
  $('#yeni').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(6).search("Sipariş Onaylandı").draw();
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