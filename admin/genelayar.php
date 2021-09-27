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
    $query = $db->prepare("UPDATE ayarlar SET
    sitebaslik = :sitebaslik,
    siteadres = :siteadres,
    descv = :descv,
    mail = :mail,
    facebook = :facebook,
    twitter = :twitter,
    youtube = :youtube,
    aciklama = :aciklama,
    telefon = :telefon,
    yorum = :yorum,
    author = :author,
    googlemaps = :googlemaps,
    keyword = :keyword
  
WHERE ID = :id");
$update = $query->execute(array(
"sitebaslik" => $_POST['sitebaslik'],
"siteadres" => $_POST['siteadres'],
"descv" => $_POST['descv'],
"mail" => $_POST['mail'],
"facebook" => $_POST['facebook'],
"twitter" => $_POST['twitter'],
"youtube" => $_POST['youtube'],
"aciklama" => $_POST['aciklama'],
"telefon" => $_POST['telefon'],
"yorum" => $_POST['yorum'],
"author" => $_POST['author'],
"keyword" => $_POST['keyword'],
"googlemaps" => $_POST['googlemaps'],
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

$sql = $db->prepare("SELECT * FROM ayarlar WHERE id=1");
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
        <strong>Genel Ayarlar</strong>
    </h5>
    <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
    <form class="text-center" style="color: #757575;" method="POST" action="genelayar.php">
  <div class="form-group row">
    <label for="input" class="col-sm-5 col-form-label">Site Başlığı</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" name="sitebaslik" id="sitebaslik" value="<?php echo $genelayar["sitebaslik"]; ?>" placeholder="Site Adı">
    </div>
  </div>
  <div class="form-group row">
    <label for="input" class="col-sm-5 col-form-label">Site Başlığı</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" name="siteadres" id="siteadres" value="<?php echo $genelayar["siteadres"]; ?>" placeholder="Site Adresi">
    </div>
  </div>

  <div class="form-group row">
    <label for="input" class="col-sm-5 col-form-label">Description</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" name="descv" id="descv" value="<?php echo $genelayar["descv"]; ?>" placeholder="Desc">
    </div>
  </div>

  <div class="form-group row">
    <label for="input" class="col-sm-5 col-form-label">Keywords</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" name="keyword" id="keyword" value="<?php echo $genelayar["keyword"]; ?>" placeholder="Keywrords">
    </div>
  </div>

  <div class="form-group row">
    <label for="input" class="col-sm-5 col-form-label">Author</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" name="author" id="author" value="<?php echo $genelayar["author"]; ?>" placeholder="Author">
    </div>
  </div>

  <div class="form-group row">
    <label for="input" class="col-sm-5 col-form-label">Mail Adresi</label>
    <div class="col-sm-7">
      <input type="eposta" class="form-control" name="mail" id="mail" value="<?php echo $genelayar["mail"]; ?>" placeholder="Mail Adresiniz">
    </div>
  </div>
  <div class="form-group row">
    <label for="input" class="col-sm-5 col-form-label">Facebook Adresi</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" name="facebook" id="facebook" value="<?php echo $genelayar["facebook"]; ?>" placeholder="Facebook Adresiniz">
    </div>
  </div>
  <div class="form-group row">
    <label for="input" class="col-sm-5 col-form-label">Twitter Adresi</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" name="twitter" id="twitter" value="<?php echo $genelayar["twitter"]; ?>" placeholder="Twitter Adresiniz">
    </div>
  </div>
  <div class="form-group row">
    <label for="input" class="col-sm-5 col-form-label">Youtube Adresi</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" name="youtube" id="youtube" value="<?php echo $genelayar["youtube"]; ?>" placeholder="Youtube Adresiniz">
    </div>
  </div>
  <div class="form-group row">
    <label for="input" class="col-sm-5 col-form-label">Açıklama</label>
    <div class="col-sm-7">
    <textarea class="form-control" name="aciklama" id="aciklama" rows="8"><?php echo $genelayar["aciklama"];?></textarea>
               </div>
  </div>
  <div class="form-group row">
    <label for="input" class="col-sm-5 col-form-label">Telefon Numarası</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" name="telefon" id="telefon" value="<?php echo $genelayar["telefon"]; ?>" placeholder="Telefon Numaranız">
    </div>
  </div>
  <div class="form-group row">
    <label for="input" class="col-sm-5 col-form-label">Disqus Yorum Kodu</label>
    <div class="col-sm-7">
    <textarea class="form-control" name="yorum" id="yorum" rows="8"><?php echo $genelayar["yorum"];?></textarea>
               </div>
  </div>
  
  <div class="form-group row">
    <label for="input" class="col-sm-5 col-form-label">Google Maps (100% x 400px)</label>
    <div class="col-sm-7">
    <textarea class="form-control" name="googlemaps" id="googlemaps" rows="8"><?php echo $genelayar["googlemaps"];?></textarea>
               </div>
  </div>


  <div class="form-group row">
    <div class="col-sm-10">
            <button class="btn btn-outline-info btn-rounded my-4 waves-effect z-depth-0" name="button" id="button" type="submit">Verileri Güncelle</button>
        
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
