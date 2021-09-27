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
  if(isset($_POST["button"])){
    $query = $db->prepare("UPDATE yonetici SET
    sifre = :yeni_sifre
    WHERE id = :kullanici_id");
    $update = $query->execute(array(
         "yeni_sifre" => $_POST['sifre'],
         "kullanici_id" => $gelenkullanici['id']
    ));
    if ( $update ){
         print '<div class="alert alert-danger">Şifreniz Değiştirildi</div>';
    }
   
}else{
    

}

?>
<div class="card">
<h5 class="card-header info-color white-text text-center py-3">
        <strong>Merhaba <?php echo $gelenkullanici["adsoyad"]; ?></strong>
    </h5>
    <div class="container">
    <div class="row"><button type="button" class="btn btn-primary " data-toggle="modal" data-target="#kayit_ekle">Şifre Değiştir</button> </div>
    <!-- kayit ekle -->
<div class="modal fade" id="kayit_ekle" tabindex="-1" role="dialog" aria-labelledby="kayit_ekleLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="kayit_ekleLabel">Yeni Şifrenizi Giriniz...</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="text-center" style="color: #757575;" method="POST" action="profil.php">
      <div class="modal-body">
      

<div class="input-group mb-3">
<div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon2"><i class="fas fa-key"></i></span>
  </div>
  <input type="password" name="sifre" class="form-control" placeholder="Yeni Şifre Giriniz" aria-label="Yeni Şifre Giriniz" aria-describedby="basic-addon2">
</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
        <button name="button" type="submit" class="btn btn-primary">Güncelle</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- kayitekle son -->
    <div class="row">

    </div>
  </div>
    </div>
  </div>
</div>
   </body>
</html>




<?php
}
?>
