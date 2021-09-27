<?php
include("baglanti.php");
session_start();
if(!isset($_SESSION["login"])){
	echo "Bu sayfayı görüntüleme yetkiniz yoktur.";
	header("Location:giris.php");
}
else
{
  if(isset($_GET["sil"])){
    $sil = $db->prepare("DELETE FROM yonetici WHERE id = :id");
    $delete = $sil->execute(array(
       'id' => $_GET['sil']
    ));
    $sonuc = '<div class="alert alert-danger">Kullanıcı Silindi</div>';

  }
  if(isset($_POST["button"])){
      $kullanici_kontrol = $_POST['user'];
    $userkontrol = $db->query("SELECT * FROM yonetici WHERE kullaniciadi= '{$kullanici_kontrol}'")->fetch(PDO::FETCH_ASSOC);
if ( $userkontrol ){
    $sonuc = '<div class="alert alert-danger">Farklı Bir Kullanıcı Adı Deneyiniz Aynı İsminde Farklı Bir Kullanıcı Mevcut</div>';
}else{
    if($_POST['ayary'] == 1){$ayary = 1; } else {$ayary = 0;}
    if($_POST['boty'] == 1){$boty = 1; } else {$boty = 0;}
    if($_POST['habery'] == 1){$habery = 1; } else {$habery = 0;}
    if($_POST['mesaj'] == 1){$mesaj = 1; } else {$mesaj = 0;}

    $query = $db->prepare("INSERT INTO yonetici SET
    kullaniciadi = ?,
    sifre = ?,
    adsoyad = ?,
    ayarlaryetki = ?,
    botyetki = ?,
    haberyetki = ?,
    mesaj = ?");
    $insert = $query->execute(array(
        $_POST['user'], $_POST['sifre'], $_POST['adsoyad'],$ayary, $boty, $habery, $mesaj
    ));
    if ( $insert ){
        $last_id = $db->lastInsertId();
        $sonuc = '<div class="alert alert-success">Yeni Kullanıcı Eklendi</div>';
    }
  }
}
include("ust.php");
if($ayarlaryetki == 1){}else{header("Location:index.php");}

      if(empty($sonuc)){

      }else{
          echo '<div class="container"><div class="row"><div class="col-lg-12 text-center">'.$sonuc.'</div></div></div>';
      }
?>
<div class="card">
<h5 class="card-header info-color white-text text-center py-3">
        <strong>Kullanıcı Ayarları</strong>
    </h5>
    <div class="container">
    <div class="row"><button type="button" class="btn btn-primary " data-toggle="modal" data-target="#kayit_ekle">+ Kullanıcı Ekle</button> </div>
    <!-- kayit ekle -->
<div class="modal fade" id="kayit_ekle" tabindex="-1" role="dialog" aria-labelledby="kayit_ekleLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="kayit_ekleLabel">Yeni Kullanıcı Ekle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="text-center" style="color: #757575;" method="POST" action="kullanici_ayarlari.php">
      <div class="modal-body">
      <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
  </div>
  <input type="text" name="adsoyad" class="form-control" placeholder="Adı Soyad" aria-label="Ad Soyad" aria-describedby="basic-addon1">
</div>
      <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" name="user" class="form-control" placeholder="Kullanıcı Adı" aria-label="Kullanıcı Adı" aria-describedby="basic-addon1">
</div>

<div class="input-group mb-3">
<div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon2"><i class="fas fa-key"></i></span>
  </div>
  <input type="password" name="sifre" class="form-control" placeholder="Şifre" aria-label="Şifre" aria-describedby="basic-addon2">
</div>
<div class="list-group">
    Kullanıcı Yetkisi
</div>
<div class="form-check form-check-inline">
  <input name="ayary" class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1">
  <label class="form-check-label" for="inlineCheckbox1">Ayarlar</label>
</div>

<div class="form-check form-check-inline">
  <input name="boty" class="form-check-input" type="checkbox" id="inlineCheckbox2" value="1">
  <label class="form-check-label" for="inlineCheckbox2">Bot Yönetimi</label>
</div>

<div class="form-check form-check-inline">
  <input name="habery" class="form-check-input" type="checkbox" id="inlineCheckbox3" value="1">
  <label class="form-check-label" for="inlineCheckbox3">Haber Yönetimi</label>
</div>

<div class="form-check form-check-inline">
  <input name="mesaj" class="form-check-input" type="checkbox" id="inlineCheckbox4" value="1">
  <label class="form-check-label" for="inlineCheckbox4">Mesaj Yönetimi </label>
</div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
        <button name="button" type="submit" class="btn btn-primary">Kayıt Oluştur</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- kayitekle son -->
    <div class="row">

    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Kullanıcı Adı</th>
      <th scope="col">Ayarlar Yetkisi</th>
      <th scope="col">Bot Yetkisi</th>
      <th scope="col">Haber Yönetim Yetkisi</th>
      <th scope="col">Mesaj Yönetim Yetkisi</th>
      <th scope="col">Kullanıcıyı Düzenle</th>
    </tr>
  </thead>
	<tbody>
    <?php $user = $db->query("SELECT * FROM yonetici", PDO::FETCH_ASSOC);
            if ( $user->rowCount() ){
                foreach( $user as $kullanicilar ){ ?>
		<tr>
		    <th class="w-25"><?php echo $kullanicilar['kullaniciadi']; ?> </th>
		    <td class="centerText"><?php switch ($kullanicilar['ayarlaryetki']){case 0: echo"Yok"; break; case 1: echo "Var"; break;} ?></td>
		    <td class="centerText"><?php switch ($kullanicilar['botyetki']){case 0: echo"Yok"; break; case 1: echo "Var"; break;} ?></td>
		    <td class="centerText"><?php switch ($kullanicilar['haberyetki']){case 0: echo"Yok"; break; case 1: echo "Var"; break;} ?></td>
		    <td class="centerText"><?php switch ($kullanicilar['mesaj']){case 0: echo"Yok"; break; case 1: echo "Var"; break;} ?></td>
            <td class="centerText"><a href="kullanici_ayarlari.php?sil=<?php echo $kullanicilar['id']; ?>"><button type="button" class="btn btn-danger btn-sm">Sil</button></a> - <a href="guncelle.php?guncelle=<?php echo $kullanicilar['id']; ?>"><button type="button" class="btn btn-info btn-sm">Güncelle</button></a></td>
         </tr>
<?php  }
} ?>
    </tbody>
    
	</table>
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
