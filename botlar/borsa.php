<html lang="TR">
      <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      
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
   //api olumlu calisacak kod basi //


   $veri=file_get_contents("https://uzmanpara.milliyet.com.tr/canli-borsa/");
   preg_match_all('@id="imkb_kapanis_span_1" >(.*?)</span>@si',$veri,$bit);
   preg_match_all('@id="imkb_yuzde_degisim_span_1" >(.*?)</span>@si',$veri,$bitd);
   preg_match_all('@span class="price-arrow-(.*?)"  id="imkb_kapanis_span_1" >@si',$veri,$degisim);
   
   $borsa100v = $bit[1][0];
   $borsayuzde = $bitd[1][0];
   $borsadegisim = $degisim[1][0];
   $nokta = str_replace('.','',$borsa100v);
  
   $query = $db->prepare("INSERT INTO borsa SET
   satis = ?,
   yuzde=?,
   degisim = ?,
   kategori = ?
   ");
   $insert = $query->execute(array(
        $nokta, $borsayuzde, $borsadegisim, '1'
   ));
   if ( $insert ){
       $last_id = $db->lastInsertId();
       print "BİST100 verisi güncellendi";
   } else {
       echo "hata";
   }
   //api dogru calisacak kod sonu //
   
   
}else{
    echo "Api kodunuz hatalıdır, lütfen api kodunuzu kontrol ediniz....";
}

?>
</body>
</html>