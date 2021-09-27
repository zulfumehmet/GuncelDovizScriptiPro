<?php
include ("../db.php");


$genelayar = $db->prepare("SELECT * FROM ayarlar WHERE id = 1");
$genelayar->bindParam(1, $sira, PDO::PARAM_INT);
$genelayar->execute();
$genela = $genelayar->fetch(PDO::FETCH_ASSOC);

if($_GET['api'] == $genela['api']) {
   //api olumlu calisacak kod basi //
   $url = 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd'; 
   // path to your JSON file
   $veri = file_get_contents($url); // put the contents of the file into a variable
   $data = json_decode($veri, 1); // decode the JSON feed
   
   print_r($data);
   
   //toplam deger
   $btcd = $data[0]["market_cap"];
   $ethd = $data[1]["market_cap"];
   $xrpd = $data[5]["market_cap"];
   $usdd = $data[3]["market_cap"];
   $bchd = $data[18]["market_cap"];
   $bsvd = $data[57]["market_cap"];
   $ltcd = $data[17]["market_cap"];
   $bnbd = $data[4]["market_cap"];
   $eosd = $data[43]["market_cap"];
   $xtzd = $data[30]["market_cap"];
 
   //Satis
   $btcsat = $data[0]["current_price"];
   $eths = $data[1]["current_price"];
   $xrps = $data[5]["current_price"];
   $usds = $data[3]["current_price"];
   $bchs =  $data[18]["current_price"];
   $bsvs = $data[57]["current_price"];
   $ltcs = $data[17]["current_price"];
   $bnbs = $data[4]["current_price"];
   $eoss = $data[43]["current_price"];
   $xtzs = $data[30]["current_price"];
   
   //degisim
   $btcde = $data[0]["market_cap_change_percentage_24h"];
   $ethde = $data[1]["market_cap_change_percentage_24h"];
   $xrpde = $data[5]["market_cap_change_percentage_24h"];
   $usdde = $data[3]["market_cap_change_percentage_24h"];
   $bchde = $data[18]["market_cap_change_percentage_24h"];
   $bsvde = $data[57]["market_cap_change_percentage_24h"];
   $ltcde = $data[17]["market_cap_change_percentage_24h"];
   $bnbde = $data[4]["market_cap_change_percentage_24h"];
   $eosde = $data[43]["market_cap_change_percentage_24h"];
   $xtzde = $data[30]["market_cap_change_percentage_24h"];
   //yuzde
   $btcy = $data[0]["market_cap_change_percentage_24h"];
   $ethy = $data[1]["market_cap_change_percentage_24h"];
   $xrpy = $data[5]["market_cap_change_percentage_24h"];
   $usdy = $data[3]["market_cap_change_percentage_24h"];
   $bchy = $data[18]["market_cap_change_percentage_24h"];
   $bsvy = $data[57]["market_cap_change_percentage_24h"];
   $ltcy = $data[17]["market_cap_change_percentage_24h"];
   $bnby = $data[4]["market_cap_change_percentage_24h"];
   $eosy = $data[43]["market_cap_change_percentage_24h"];
   $xtzy = $data[30]["market_cap_change_percentage_24h"];
   
   //Kayitlarrr
   $query = $db->prepare("INSERT INTO kripto SET kategori = ?, satis = ?, degisim = ?, deger = ?, yuzde = ?");
   $insert1 = $query->execute(array(1, $btcsat, degisim($btcde), deger($btcd), number_format($btcy,2,".","")));
   $insert2 = $query->execute(array(2, $eths, degisim($ethde), deger($ethd), number_format($ethy,2,".","")));
   $insert3 = $query->execute(array(3, $xrps, degisim($xrpde), deger($xrpd), number_format($xrpy,2,".","")));
   $insert4 = $query->execute(array(4, $usds, degisim($usdde), deger($usdd), number_format($usdy,2,".","")));
   $insert5 = $query->execute(array(5, $bchs, degisim($bchde), deger($bchd), number_format($bchy,2,".","")));
   $insert6 = $query->execute(array(6, $bsvs, degisim($bsvde), deger($bsvd), number_format($bsvy,2,".","")));
   $insert7 = $query->execute(array(7, $ltcs, degisim($ltcde), deger($ltcd), number_format($ltcy,2,".","")));
   $insert8 = $query->execute(array(8, $bnbs, degisim($bnbde), deger($bnbd), number_format($bnby,2,".","")));
   $insert9 = $query->execute(array(9, $eoss, degisim($eosde), deger($eosd), number_format($eosy,2,".","")));
   $insert10 = $query->execute(array(10, $xtzs, degisim($xtzde), deger($xtzd), number_format($xtzy,2,".","")));
   
   
   if ( $insert1 && $insert2 && $insert3 && $insert4 && $insert5 && $insert6 && $insert7 && $insert8 && $insert9 && $insert10){
       $last_id = $db->lastInsertId();
      print "Kripto Para Güncellendi";
   }
   else
   { echo "hata oluştu";
       echo "\nPDO::errorInfo():\n";
       print_r($db->errorInfo());
   
   } 
   //api dogru calisacak kod sonu //
}else{
    echo "Api kodunuz hatalıdır, lütfen api kodunuzu kontrol ediniz....";
}


?>


