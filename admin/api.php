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
if(isset($_GET["api"])){
    $harf = 'ABCDEFGHIJKLMNOPRSTUVYZ';
    $harf_sayisi = mb_strlen($harf);
    for ($i = 0; $i < 10; $i++){
        $secilen_harf_konumu = mt_rand(0,$harf_sayisi - 1);
        $kod .= mb_substr($harf, $secilen_harf_konumu, 1).rand(0,9);
    }
    $uretilen_kod = mb_substr($kod, 0, 20); //J6Z1B2
    $query = $db->prepare("UPDATE ayarlar SET
    api = :api
WHERE ID = :id");
$update = $query->execute(array(
"api" => $uretilen_kod,
"id" => 1

));
if ( $update ){
$sonuc = '<div class="alert alert-primary" role="alert">Yeni api üretildi : '. $uretilen_kod . ' cron kullanıyorsanız botların çalışması için lütfen crondaki api kodlarını değiştiriniz...</div>';
}else
{
}
  }
?>
	  <!-- Page Content -->
  <div class="container">
  
    <div class="row">
      <div class="col-lg-12 text-center">
         <?php echo $sonuc; ?>
         <a href="bot.php"><button type="button" class="btn btn-primary btn-sm">Bot Sayfasına Dön</button></a>
    
          </div>
   </div>
  </div>

  
  
  
   </body>
</html>




<?php
}
?>
