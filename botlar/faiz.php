<?php 
include ("../db.php");


$genelayar = $db->prepare("SELECT * FROM ayarlar WHERE id = 1");
$genelayar->bindParam(1, $sira, PDO::PARAM_INT);
$genelayar->execute();
$genela = $genelayar->fetch(PDO::FETCH_ASSOC);

if($_GET['api'] == $genela['api']) {
   //api olumlu calisacak kod basi //
   function curl_connect($url){ 
    $agent = $_SERVER["HTTP_USER_AGENT"]; 
    $curl = curl_init(); 
    curl_setopt($curl, CURLOPT_URL, $url); 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($curl, CURLOPT_USERAGENT, $agent); 
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
    $content = curl_exec($curl); 
    curl_close($curl); 
    $content = preg_replace("/\s+/", " ", $content); 
    $content = preg_replace("/\r|\n/", " ", $content);
    $content = preg_replace("/\t+/", "", $content); 
    $content = preg_replace("/<script\b[^>]*>(.*?)<\/script>/is", "", $content); 
    $content = trim($content); 
    return $content; 
}
function curl_search($first, $last, $content){ 
    @preg_match_all('/' . preg_quote($first, '/').'(.*?)'. preg_quote($last, '/').'/i', $content, $m);
    return @$m[1];
}

   $site = curl_connect("https://www.doviz.com/tahvil");
   preg_match_all('#<span class="value" data-socket-key="TAHVIL" data-socket-type="B" data-socket-attr="s" data-socket-animate="true">(.*?)</span>#si',$site,$deger);
   preg_match_all('#data-socket-key="TAHVIL" data-socket-type="B" data-socket-attr="c"> %(.*?) </div>#si',$site,$kontrolet);
 

$faizdeger = $deger[1][0];
$faizdegisim = $kontrolet[1][0];
// echo $site;
print_r($kontrolet);

$query = $db->prepare("INSERT INTO faiz SET
satis = ?,
kategori = ?,
yuzde = ?");
$insert = $query->execute(array(
   noktacevir($faizdeger), "1", $faizdegisim
));
if ( $insert ){
    $last_id = $db->lastInsertId();
    print "Faiz oranı güncellendi...";
}
 
 
   //api dogru calisacak kod sonu //
}else{
    echo "Api kodunuz hatalıdır, lütfen api kodunuzu kontrol ediniz....";
}



