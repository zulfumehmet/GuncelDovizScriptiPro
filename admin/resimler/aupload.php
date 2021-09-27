<?php
include("../../db.php");
session_start();
if(!isset($_SESSION["login"])){
	echo "Bu sayfayı görüntüleme yetkiniz yoktur.";
	header("Location:../giris.php");
}
else
{
$gelen_kod = $_POST["adi"]; // pos ile gelen id degisken atayalim

?>
<!DOCTYPE html>
<html>
    <head>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Resimler </title>
        <link rel="stylesheet" href="assets/css/styles.css" />
        <script src="assets/js/script.js"></script>
		<script src="assets/js/albumPreviews.js"></script>
        <script src="http://cdn.tutorialzine.com/misc/adPacks/v1.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
	    <script type="text/javascript" src="jquery/jquery.js"></script>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="w3.css">

	    </head>
	    <body>
<div class="w3-container">
    <h1>Yükleme İşleminiz bitti ise Devam butonuna tıklayınız.</h1>
<a href="ac.php?id=<?php echo $gelen_kod; ?>"><p class="button">Resleri Gör</p></a>
  <p>Yüklenen resimler:</p>
  <ul class="w3-ul w3-card-4">

<?php
if( isset( $_POST[ 'submit' ] ) !== false )
{


 include('inc/class.upload.php'); //kutuphaneyi dahil edelim

$files = array();
foreach ($_FILES['image'] as $k => $l) {
  foreach ($l as $i => $v) {
    if (!array_key_exists($i, $files))
      $files[$i] = array();
    $files[$i][$k] = $v;
  }
}

// create an array here to hold file names
$uploaded = array();

foreach ($files as $file) {
  $handle = new Upload($file);
  if ($handle->uploaded) {
    // Resimleri olusturalim
    $this_upload = array();
      
    $handle->file_name_body_add = '_thumbnial'; // kucuk resimleri yeniden adlandiralim
    $handle->file_auto_rename   = true;
    $handle->image_resize       = true;
    $handle->image_x            = 150;
    $handle->image_ratio_y      = 113;
    $handle->Process($uploadyolu.$_POST["adi"].'/thumbnail'); // kucuk resimleri nereye kaydedecegimizi bildirek gelen post ile id alalım id adinda klasor olusturalim
    
    if ($handle->processed) {
      
      // Buyuk resim adi  
      $this_upload['small'] = $handle->file_dst_name;
    } else {
      echo 'error : ' . $handle->error;
    }
    
    $handle->jpeg_quality       = 70;
	$handle->file_max_size      = '10240000';
    $handle->file_auto_rename   = true;
    $handle->image_resize       = true;
    $handle->image_x            = true;
    $handle->image_ratio_y      = true;
    $handle->Process($uploadyolu.$_POST["adi"].'/');
    
    if ($handle->processed) {
    
      // Kucuk Resim adi  
      $this_upload['large'] = $handle->file_dst_name;
        
        //Limitlendirme
        $limit = $db->query("SELECT * FROM resimtoplu where ilanid='$gelen_kod'");
        $limit = $limit->rowCount(); 
        if ($limit<100) // burasi ile 100 fotograftan fazla resim yuklemesine izin vermeyelim limitide resim ilan id si ile yapiyoruz. Cunku resim ilan id aynı olanlari sinirlayabiliriz. resim id si her fotograf icin bir tanedir.
        {
            $buyuk = $this_upload["large"];
            $kucuk = $this_upload["small"];
            
        // Burasi da her bir resim icin calisin.
        $sorgu = $db->prepare("INSERT INTO resimtoplu (ilanid, resim_adi, kucuk) VALUES(?, ?, ?)");
        $sorgu->bindParam(1, $gelen_kod, PDO::PARAM_STR);
        $sorgu->bindParam(2, $buyuk, PDO::PARAM_STR);
        $sorgu->bindParam(3, $kucuk, PDO::PARAM_STR);

        $sorgu->execute();
        
         echo ' <li class="w3-bar"><span  class="w3-bar-item w3-button w3-white w3-xlarge w3-right">Yüklendi</span><img src="tick_blue.png" class="w3-bar-item w3-circle w3-hide-small" style="width:85px"><div class="w3-bar-item"><span class="w3-large">Resim:'.$buyuk.' </span><br><span>Thumbnail: '.$kucuk.'</span> </div></li>'; // 10 adet fotoğraf varsa kaydetsin
        } else {
        echo '<li class="w3-bar"><span  class="w3-bar-item w3-button w3-white w3-xlarge w3-right">Yüklenmedi!!!</span><img src="no.png" class="w3-bar-item w3-circle w3-hide-small" style="width:85px"><div class="w3-bar-item"><span class="w3-large">Bir Sorun Oluştu </span><br><span>En Fazla 10 adet fotoğraf yükleyebilirsiniz.</span> </div></li>';// 10 dan fazla ise kaydır durdursun.
        }
        
        // buraya kadarki bolumde de db kayit islemler
        
      $handle->clean();
    } else {
      echo 'error : ' . $handle->error;
    }
    $uploaded[] = $this_upload;
  }
}
}
?>
  </ul>
</div>
</html>
<?php } ?>
