<?php
include("baglanti.php");
session_start();
if(!isset($_SESSION["login"])){
	echo "Bu sayfayı görüntüleme yetkiniz yoktur.";
	header("Location:giris.php");
}
else
{
include("ust.php");
if($botyetki == 1){}else{header("Location:index.php");}

if(isset($_GET["sil"])){
  $query = $db->prepare("DELETE FROM bot WHERE id = :id");
$delete = $query->execute(array(
   'id' => $_GET['sil']
));
header("Location:bot.php");
  }

if(isset($_POST["button"])){
  $query = $db->prepare("INSERT INTO bot SET
  dizin = ?,
  dosya = ?,
  aciklama = ?");
  $insert = $query->execute(array(
      $_POST['dizinadi'], $_POST['dosyaadi'], $_POST['aciklama']
  ));
  if ( $insert ){
      $last_id = $db->lastInsertId();
      $sonuc = '<div class="alert alert-success">Boot Dosyası Eklendi</div>';
  }
  }

if(empty($sonuc)){

}else{
    echo '<div class="container"><div class="row"><div class="col-lg-12 text-center">'.$sonuc.'</div></div></div>';
}
?>
	  <!-- Page Content -->
  <div class="container">
  
    <div class="row">
      <div class="col-lg-12 text-center">
          <div class="alert alert-primary" role="alert">Bot dosyasını cronjob ile otomatik olarak belirli aralıklarında çalıştırabilirsiniz...</div>
          <div class="container">
  <div class="row">
    <div class="col">
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#kayit_ekle">+ Listeye Boot Ekle</button> 
    </div>
    <div class="col"><?php
    $genelayar = $db->prepare("SELECT * FROM ayarlar WHERE id = 1");
    $genelayar->bindParam(1, $sira, PDO::PARAM_INT);
    $genelayar->execute();
    $genela = $genelayar->fetch(PDO::FETCH_ASSOC); ?>
    Api:<input type="text" value="<?php echo $genela['api']; ?>" id="myInput">
     <button onclick="myFunction()">API Kopyala</button>
<script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Api kodu kopyalandı: " + copyText.value);
}
</script>

    </div>
    <div class="col">
    <a href="api.php?api"><button type="button" class="btn btn-danger btn-sm">Yeni api üret</button></a><br>(Cron kullanılıyorsa yeni API girilmelidir.)
    </div>
    <div class="col">
    <a href="veri.php"><button type="button" class="btn btn-info btn-sm">Kayıtlı Veriler</button></a>
    </div>
  </div>
</div>
</br>
          
    <!-- kayit ekle -->
<div class="modal fade" id="kayit_ekle" tabindex="-1" role="dialog" aria-labelledby="kayit_ekleLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="kayit_ekleLabel">Yeni Boot Ekle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="text-center" style="color: #757575;" method="POST" action="bot.php">
      <div class="modal-body">
      <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"><i class="far fa-folder"></i></span>
  </div>
  <input type="text" name="dizinadi" class="form-control" placeholder="Bulunduğu Dizin" aria-label="Bulunduğu Dizin" aria-describedby="basic-addon1">
</div>
      <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"><i class="far fa-file-code"></i></span>
  </div>
  <input type="text" name="dosyaadi" class="form-control" placeholder="Dosya Adı" aria-label="Dosya Adı" aria-describedby="basic-addon1">
</div>

<div class="input-group mb-3">
<div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon2"><i class="far fa-sticky-note"></i></span>
  </div>
  <input type="text" name="aciklama" class="form-control" placeholder="Açıklama" aria-label="Açıklama" aria-describedby="basic-addon2">
</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
        <button name="button" type="submit" class="btn btn-primary">Listeye Ekle</button>
        </form>
      </div>
    </div>
  </div>
</div>
    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Dosya Adı</th>
      <th scope="col">Açıklama</th>
      <th scope="col">Yönet</th>
    </tr>
  </thead>
	<tbody>
    <?php $bot = $db->query("SELECT * FROM bot", PDO::FETCH_ASSOC);
            if ( $bot->rowCount() ){
                foreach( $bot as $botlar ){ ?>
		<tr>
		    <th class="w-25"><?php echo $botlar['dosya']; ?> </th>
		    <td class="centerText"><?php echo $botlar['aciklama']; ?></td>
		    <td class="centerText"><a href="../<?php echo $botlar['dizin']; ?>/<?php echo $botlar['dosya']; ?>?api=<?php echo $genela['api']; ?>" target="boot_calistirma"><button type="button" class="btn btn-info btn-sm">Çalıştır</button></a> - <a href="bot.php?sil=<?php echo $botlar['id']; ?>"><button type="button" class="btn btn-danger btn-sm">Listeden Çıkart</button></a></td>
		</tr>
<?php  }
} ?>
    </tbody>
 </table>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 text-center">
  <iframe name="boot_calistirma" src="botiframe.php" style="border:none;" width="500" height="200" allowfullscreen></iframe>
   </div>
   </div>
  </div>

  
  
  
   </body>
</html>




<?php
}
?>
