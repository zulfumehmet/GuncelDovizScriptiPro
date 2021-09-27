<html lang="TR">
      <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Güncel Döviz Scirpiti</title>
      </head>

      <body>
<?php
include ("../db.php");

$genelayar = $db->prepare("SELECT * FROM ayarlar WHERE id = 1");
$genelayar->bindParam(1, $sira, PDO::PARAM_INT);
$genelayar->execute();
$genela = $genelayar->fetch(PDO::FETCH_ASSOC);

if($_GET['api'] == $genela['api']) {
   

$veri=file_get_contents("https://www.doviz.com/ekonomik-takvim");
preg_match_all('@<table class="sticky">(.*?)</table>@si',$veri,$bit);
preg_match_all('@<span class="date-label">(.*?)</span>@si',$veri,$tarih);


$gelenveri = $bit[0][0];
$degisecek = "sticky";
$yeniveri = "table table-striped";
$tablo =  str_replace($degisecek, $yeniveri, $gelenveri);
$ekranabas = $tarih[0][0] . $tablo;

$query = $db->prepare("UPDATE takvim SET
takvim = :takvim
WHERE id = 1");
$update = $query->execute(array(
     "takvim" => $ekranabas
));
if ( $update ){
     print "Ekonomik Takvim Güncellendi";
}
}else{
    echo "Api kodunuz hatalıdır, lütfen api kodunuzu kontrol ediniz....";
}
?>
</body>
</html>