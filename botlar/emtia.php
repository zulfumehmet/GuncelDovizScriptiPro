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

$veri=file_get_contents("https://uzmanpara.milliyet.com.tr/degerli-metaller/");
preg_match_all('@<td class="center">(.*?)</td>@si',$veri,$bit);
preg_match_all('@<td class="degisim (.*?)">%@si',$veri,$degisim);
preg_match_all('#">%(.*?)</td>#si',$veri,$yuzde);
//degerler
$gumusal = noktasil($bit[1][0]);
$gumussat = noktasil($bit[1][1]);
$platinal = noktasil($bit[1][2]);
$platinsat= noktasil($bit[1][3]);
$pladyomal= noktasil($bit[1][4]);
$pladyomsat= noktasil($bit[1][5]);
$brentpal = noktasil($bit[1][6]);
$brentpsat = noktasil($bit[1][7]);
//degisim
$gumusdeger = $degisim[1][0];
$platindeger = $degisim[1][1];
$paladyumdeger = $degisim[1][2];
$petroldeger = $degisim[1][3];
//yuzde
$gumusyuzde = $yuzde[1][1];
$platinyuzde = $yuzde[1][2];
$paladyumyuzde = $yuzde[1][3];
$petrolyuzde = $yuzde[1][4];
//db kayit
$query = $db->prepare("INSERT INTO emtia SET kategori = ?, alis = ?, satis =?, degisim=?, yuzde=?");
$insert = $query->execute(array(1, noktacevir($gumusal), noktacevir($gumussat), $gumusdeger, $gumusyuzde));
$insert2 = $query->execute(array(2, noktacevir($platinal), noktacevir($platinsat), $platindeger, $platinyuzde));
$insert3 = $query->execute(array(3, noktacevir($pladyomal), noktacevir($pladyomsat), $paladyumdeger, $paladyumyuzde));
$insert4 = $query->execute(array(4, noktacevir($brentpal), noktacevir($brentpsat), $petroldeger, $petrolyuzde));

if ( $insert && $insert2 && $insert3 && $insert4){
 $last_id = $db->lastInsertId();
print "Emtiya Güncellendi";
 }
else
{ echo "hata oluştu";
}
   //api dogru calisacak kod sonu //
}else{
    echo "Api kodunuz hatalıdır, lütfen api kodunuzu kontrol ediniz....";
}

?>
</body>
</html>