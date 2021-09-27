<?php
include("baglanti.php");
session_start();
if(!isset($_SESSION["login"])){
	echo "Bu sayfayı görüntüleme yetkiniz yoktur.";
	header("Location:giris.php");
}
else
{
    $gelen_id = $_GET["guncelle"];
    $gncl = $db->prepare("SELECT * FROM yonetici WHERE id=$gelen_id");
    $gncl->execute(array('6'));
    $guncelle=$gncl->fetch(PDO::FETCH_ASSOC);

  if(isset($_POST["button"])){
    if($_POST['ayary'] == 1){$ayary = 1; } else {$ayary = 0;}
    if($_POST['boty'] == 1){$boty = 1; } else {$boty = 0;}
    if($_POST['habery'] == 1){$habery = 1; } else {$habery = 0;}
    if($_POST['mesaj'] == 1){$mesaj = 1; } else {$mesaj = 0;}

      if($_POST['user'] == $guncelle['kullaniciadi']){
                    $kgncl = $db->prepare("UPDATE yonetici SET
                    sifre = ?,
                    adsoyad = ?,
                    ayarlaryetki = ?,
                    botyetki = ?,
                    haberyetki = ?,
                    mesaj = ?
                    WHERE id = ?");
                    $update = $kgncl->execute(array(
                     $_POST['sifre'], $_POST['adsoyad'],$ayary, $boty, $habery, $mesaj, $gelen_id
                    ));
                    if ( $update ){
                         $sonuc = '<div class="alert alert-primary" role="alert">Güncelleme başarılı!</div>';
                    }
       }else {
        $kullanici_kontrol = $_POST['user'];
        $userkontrol = $db->query("SELECT * FROM yonetici WHERE kullaniciadi= '{$kullanici_kontrol}'")->fetch(PDO::FETCH_ASSOC);
            if ( $userkontrol ){
                $sonuc = '<div class="alert alert-danger">Farklı Bir Kullanıcı Adı Deneyiniz Aynı İsminde Farklı Bir Kullanıcı Mevcut</div>';
            } else {
                $kgncl = $db->prepare("UPDATE yonetici SET
                    kullaniciadi= ?,
                    sifre = ?,
                    adsoyad = ?,
                    ayarlaryetki = ?,
                    botyetki = ?,
                    haberyetki = ?,
                    mesaj = ?
                    WHERE id = ?");
                    $update = $kgncl->execute(array(
                        $_POST['user'], $_POST['sifre'], $_POST['adsoyad'],$ayary, $boty, $habery, $mesaj, $gelen_id
                    ));
                    if ( $update ){
                         $sonuc = '<div class="alert alert-primary" role="alert">Güncelleme başarılı!</div>';
                    }
            }
        }
}
include("ust.php");
if($ayarlaryetki == 1){}else{header("Location:index.php");}

      if(empty($sonuc)){

      }else{
          echo '<div class="container"><div class="row"><div class="col-lg-12 text-center">'.$sonuc.'</div></div></div>';
          echo '<div class="container"><div class="row"><div class="col-lg-12 text-center"><a href="guncelle.php?guncelle='.$gelen_id.'"<button type="button" class="btn btn-primary btn-sm">Kullanıcıya Dön</button></a></div></div></div>';
          die ();
        }
?>
<div class="card">
<h5 class="card-header info-color white-text text-center py-3">
        <strong><?php echo $guncelle['kullaniciadi'];?> Kullanıcı Güncelleme Sayfası</strong>
    </h5>
    <div class="container">
    <div class="row">
    <form class="text-center" style="color: #757575;" method="POST" action="guncelle.php?guncelle=<?php echo $gelen_id; ?>">
      <div class="modal-body">
      <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
  </div>
  <input type="text" value="<?php echo $guncelle['adsoyad'];?>"name="adsoyad" class="form-control" placeholder="Adı Soyad" aria-label="Ad Soyad" aria-describedby="basic-addon1">
</div>
      <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" value="<?php echo $guncelle['kullaniciadi'];?>" name="user" class="form-control" placeholder="Kullanıcı Adı" aria-label="Kullanıcı Adı" aria-describedby="basic-addon1">
</div>

<div class="input-group mb-3">
<div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon2"><i class="fas fa-key"></i></span>
  </div>
  <input type="password" value="<?php echo $guncelle['sifre'];?>" name="sifre" class="form-control" placeholder="Şifre" aria-label="Şifre" aria-describedby="basic-addon2">
</div>
<div class="list-group">
    Kullanıcı Yetkisi
</div>
<div class="form-check form-check-inline">
  <input name="ayary" class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1" <?php if($guncelle['ayarlaryetki'] == 1){echo "checked"; } else {} ?> >
  <label class="form-check-label" for="inlineCheckbox1">Ayarlar</label>
</div>

<div class="form-check form-check-inline">
  <input name="boty" class="form-check-input" type="checkbox" id="inlineCheckbox2" value="1" <?php if($guncelle['botyetki'] == 1){echo "checked"; } else {} ?>>
  <label class="form-check-label" for="inlineCheckbox2">Bot Yönetimi</label>
</div>

<div class="form-check form-check-inline">
  <input name="habery" class="form-check-input" type="checkbox" id="inlineCheckbox3" value="1" <?php if($guncelle['haberyetki'] == 1){echo "checked"; } else {} ?>>
  <label class="form-check-label" for="inlineCheckbox3">Haber Yönetimi</label>
</div>

<div class="form-check form-check-inline">
  <input name="mesaj" class="form-check-input" type="checkbox" id="inlineCheckbox4" value="1" <?php if($guncelle['mesaj'] == 1){echo "checked"; } else {} ?>>
  <label class="form-check-label" for="inlineCheckbox4">Mesaj Yönetimi</label>
</div>
      </div>
      <div class="modal-footer">
        <button name="button" type="submit" class="btn btn-primary">Güncelle</button>
        </form>




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
