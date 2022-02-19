<?php 
include ("../db.php");

$genelayar = $db->prepare("SELECT * FROM ayarlar WHERE id = 1");
$genelayar->bindParam(1, $sira, PDO::PARAM_INT);
$genelayar->execute();
$genela = $genelayar->fetch(PDO::FETCH_ASSOC);
   
   if($_GET['api'] == $genela['api']) {
      //api olumlu calisacak kod basi //
   
   
  $data = json_decode(file_get_contents('https://api.genelpara.com/embed/doviz.json'), true);
   
   // print_r($data);
   
   function yuzde($yuzde1, $yuzde2){
       $fark = $yuzde2 - $yuzde1;
      return(number_format(($fark / $yuzde1)*100, 2, ',', '.'));
   }
   
   function degisim1($data1){
    $gelenveri = str_replace(",",".",$data1);
       if($gelenveri > 0){
      $yazdir = "up";
   } elseif($gelenveri < 0){
      $yazdir = "down";
   }else {
      $yazdir = "flat" . $gelenveri;
     
   }
   return $yazdir;
   }
  
   
   $al1 = strip_tags($data['USD']["satis"]);
   $dolar_s= str_replace("Dolar kaç tl", "", $al1);

   
   $query = $db->prepare("INSERT INTO doviz SET kategori = ?,alis = ?, satis =?, degisim=?, yuzde=?");
	$insert01 = $query->execute(array(1, $data['USD']["alis"], $dolar_s, degisim1($data['USD']["degisim"]), str_replace(",",".",$data['USD']["degisim"])));
	$insert02 = $query->execute(array(2, $data['EUR']["alis"], $data['EUR']["satis"], degisim1($data['EUR']["degisim"]), str_replace(",",".",$data['EUR']["degisim"])));
	$insert03 = $query->execute(array(3, $data['GBP']["alis"], $data['GBP']["satis"], degisim1($data['GBP']["degisim"]), str_replace(",",".",$data['GBP']["degisim"])));
	$insert04 = $query->execute(array(4, $data['CAD']["alis"], $data['CAD']["satis"], degisim1($data['CAD']["degisim"]), str_replace(",",".",$data['CAD']["degisim"])));
	$insert05 = $query->execute(array(5, $data['CHF']["alis"], $data['CHF']["satis"], degisim1($data['CHF']["degisim"]), str_replace(",",".",$data['CHF']["degisim"])));
	$insert06 = $query->execute(array(6, $data['SAR']["alis"], $data['SAR']["satis"], degisim1($data['SAR']["degisim"]), str_replace(",",".",$data['SAR']["degisim"])));
	$insert07 = $query->execute(array(7, $data['JPY']["alis"], $data['JPY']["satis"], degisim1($data['SAR']["degisim"]), str_replace(",",".",$data['JPY']['degisim'])));
	$insert08 = $query->execute(array(8, $data['AUD']["alis"], $data['AUD']["satis"], degisim1($data['AUD']["degisim"]), str_replace(",",".",$data['AUD']["degisim"])));
	$insert09 = $query->execute(array(9, $data['NOK']["alis"], $data['NOK']["satis"], degisim1($data['NOK']["degisim"]), str_replace(",",".",$data['NOK']["degisim"])));
	$insert10 = $query->execute(array(10, $data['DKK']["alis"], $data['DKK']["satis"], degisim1($data['DKK']["degisim"]), str_replace(",",".",$data['DKK']["degisim"])));
	$insert11 = $query->execute(array(11, $data['SEK']["alis"], $data['SEK']["satis"], degisim1($data['SEK']["degisim"]), str_replace(",",".",$data['SEK']["degisim"])));
	$insert12 = $query->execute(array(12, $data['KWD']["alis"], $data['KWD']["satis"], degisim1($data['KWD']["degisim"]), str_replace(",",".",$data['KWD']["degisim"])));
	$insert13= $query->execute(array(13, $data['RUB']["alis"], $data['RUB']["satis"], degisim1($data['RUB']["degisim"]), str_replace(",",".",$data['RUB']["degisim"])));
   if ( $insert01 && $insert02 && $insert03 && $insert04 && $insert05 && $insert06 && $insert07 && $insert08 && $insert09 && $insert10 && $insert11 && $insert12 && $insert13)
   {
      $last_id = $db->lastInsertId();
       print "Döviz verileri güncellendi!";
       
    
   } else{ echo "hata";} 
   
  
 $adata = json_decode(file_get_contents('https://api.genelpara.com/embed/altin.json'), true);   


 $altin_1 = strip_tags($adata['GA']["satis"]);
 $altin_s= str_replace("Altın fiyatları", "", $altin_1);

$altin_2 = strip_tags($adata['C']["satis"]);
$ceyrek_s= str_replace("Çeyrek altın fiyatı", "", $altin_2);

$altin = $db->prepare("INSERT INTO altin SET kategori = ?,alis = ?, satis =?, degisim=?, yuzde=?");
	$ainsert1 = $altin->execute(array(1, $adata['XAU/USD']["alis"], $adata['XAU/USD']["satis"], degisim1($adata['XAU/USD']["degisim"]), str_replace(",",".",$adata['XAU/USD']["degisim"])));
	$ainsert2 = $altin->execute(array(2, $adata['GA']["alis"], $altin_s, degisim1($adata['GA']["degisim"]), str_replace(",",".",$adata['GA']["degisim"])));
	$ainsert3 = $altin->execute(array(3, $adata['C']["alis"], $ceyrek_s, degisim1($adata['C']["degisim"]), str_replace(",",".",$adata['C']["degisim"])));
	$ainsert4 = $altin->execute(array(4, $adata['Y']["alis"], $adata['Y']["satis"], degisim1($adata['Y']["degisim"]), str_replace(",",".",$adata['Y']["degisim"])));
	$ainsert5 = $altin->execute(array(5, $adata['T']["alis"], $adata['T']["satis"], degisim1($adata['T']["degisim"]), str_replace(",",".",$adata['T']["degisim"])));
	$ainsert6 = $altin->execute(array(6, $adata['CMR']["alis"], $adata['CMR']["satis"], degisim1($adata['CMR']["degisim"]), str_replace(",",".",$adata['CMR']["degisim"])));
	$ainsert7 = $altin->execute(array(7, $adata['ATA']["alis"], $adata['ATA']["satis"], degisim1($adata['ATA']["degisim"]), str_replace(",",".",$adata['ATA']["degisim"])));
	$ainsert8 = $altin->execute(array(8, $adata['GR']["alis"], $adata['GR']["satis"], degisim1($adata['GR']["degisim"]), str_replace(",",".",$adata['GR']["degisim"])));
	$ainsert9 = $altin->execute(array(9, $adata[22]["alis"], $adata[22]["satis"], degisim1($adata[22]["degisim"]), str_replace(",",".",$adata[22]["degisim"])));


if ( $ainsert1 && $ainsert2 && $ainsert3 && $ainsert4 && $ainsert5 && $ainsert6 && $ainsert7 && $ainsert8 && $ainsert9  ){
    $alast_id = $db->lastInsertId();
    print "Altın verileri güncellendi!";
}

   

}else{
    echo "Api kodunuz hatalıdır, lütfen api kodunuzu kontrol ediniz....";
}
