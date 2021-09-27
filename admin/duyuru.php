<?php
include("baglanti.php");
session_start();
if(!isset($_SESSION["login"])){
	echo "Bu sayfayı görüntüleme yetkiniz yoktur.";
	header("Location:giris.php");
}
else
{
  if(isset($_POST["button"])){
    $query = $db->prepare("UPDATE duyuru SET
    icerik = :icerik,
    aktif = :aktif
  
WHERE ID = :id");
$update = $query->execute(array(
"icerik" => $_POST['icerik'],
"aktif" => $_POST['aktif'],
"id" => 1

));
if ( $update ){
$sonuc = '<div class="alert alert-success">Veriler Güncellendi</div>';
}
}else
{
}

include("ust.php");
if($ayarlaryetki == 1){}else{header("Location:index.php");}

$sql = $db->prepare("SELECT * FROM duyuru WHERE id=1");
			$sql->execute(array(
				'6'
			));
      $genelayar=$sql->fetch(PDO::FETCH_ASSOC);
      if(empty($sonuc)){

      }else{
          echo '<div class="container"><div class="row"><div class="col-lg-12 text-center">'.$sonuc.'</div></div></div>';
      }
?>
<div class="card">
<h5 class="card-header info-color white-text text-center py-3">
        <strong>Genel Duyuru Yayınlama</strong>
    </h5>
    <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
    <form class="text-center" style="color: #757575;" method="POST" action="#">
    <div class="form-group row">
    <label for="input" class="col-sm-2 col-form-label">Duyuru İçeriği</label>
    <div class="col-sm-10">
        <style>
            .ck-editor__editable {
                min-height: 500px;
            }
            </style>
    <textarea class="form-control" name="icerik" id="icerik" rows="8"><?php echo $genelayar["icerik"];?></textarea>
               </div>
  </div>
  <script>
           
           CKEDITOR.replace( 'icerik',  {
                   enterMode: CKEDITOR.ENTER_BR,
                   entities: false,
                   basicEntities: false,
                   height: 500,
                  basicEntities: false,
                                filebrowserBrowseUrl: '/boynici/resimler/liste.php',
                                filebrowserWindowWidth: '900',
                                filebrowserWindowHeight: '700'
                   });
       </script>
  
  <div class="form-group row">
    <label for="input" class="col-sm-2 col-form-label">Yayın Durumu</label>
    <div class="col-sm-10">
    <select name="aktif" class="form-control">
      
        <option value="1" <?php if($genelayar["aktif"] == 1){echo "selected";}else{} ?>>Aktif</option>
        <option value="0" <?php if($genelayar["aktif"] == 0){echo "selected";}else{} ?>>Pasif</option>
      </select>
               </div>
  </div>


  <div class="form-group row">
    <div class="col-sm-10">
            <button class="btn btn-outline-info btn-rounded my-4 waves-effect z-depth-0" name="button" id="button" type="submit">Duyuruyu Güncelle</button>
        
    </div>
  </div>
</form>
    </div>
  </div>
</div>
   </body>
</html>




<?php
}
?>
