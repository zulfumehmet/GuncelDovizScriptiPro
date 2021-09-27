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
    $site=file_get_contents("https://www.yapikulubu.com/insaat-demiri-fiyatlari/");
    preg_match_all('#<td class="sagaYasla">(.*?) ₺ <img#si',$site,$deger);
    $ilkdeger = $deger[1][0];
    $delimiter = array(" ","<"<".","'","\"","|","\\","/",";",":");
    $replace = str_replace($delimiter, $delimiter[0], $ilkdeger);
    $explode = explode($delimiter[0], $replace);
    $ilk = substr($explode[28], 1);
    
   //Ankara//
$ankara8  = $ilk;
$ankara10 = $deger[1][1];
$ankara12 = $deger[1][2];

//istanbul//
$istanbul8  = $deger[1][3];
$istanbul10 = $deger[1][4];
$istanbul12 = $deger[1][5];

//izmir//
$izmir8  = $deger[1][6];
$izmir10 = $deger[1][7];
$izmir12 = $deger[1][8];
 
$iskenderun8  = $deger[1][9];
$iskenderun10 = $deger[1][10];
$iskenderun12 = $deger[1][11];

$konya8  = $deger[1][12];
$konya10 = $deger[1][13];
$konya12 = $deger[1][14];

$kayseri8  = $deger[1][15];
$kayseri10 = $deger[1][16];
$kayseri12 = $deger[1][17];

$karabuk8  = $deger[1][18];
$karabuk10 = $deger[1][19];
$karabuk12 = $deger[1][20];

$samsun8  = $deger[1][21];
$samsun10 = $deger[1][22];
$samsun12 = $deger[1][23];

$biga8  = $deger[1][24];
$biga10 = $deger[1][25];
$biga12 = $deger[1][26];

$sivas8  = $deger[1][27];
$sivas10 = $deger[1][28];
$sivas12 = $deger[1][29];

$diyarbakir8  = $deger[1][30];
$diyarbakir10 = $deger[1][31];
$diyarbakir12 = $deger[1][32];

$mardin8  = $deger[1][33];
$mardin10 = $deger[1][34];
$mardin12 = $deger[1][35];

$van8  = $deger[1][36];
$van10 = $deger[1][37];
$van12 = $deger[1][38];

$query = $db->prepare("INSERT INTO demir SET sekizlik = ?, onluk = ?, satis = ?, kategori = ?");
$insert1 = $query->execute(array($ankara8, $ankara10, $ankara12, 1));
$insert2 = $query->execute(array($istanbul8, $istanbul10, $istanbul12, 2));
$insert3 = $query->execute(array($izmir8, $izmir10, $izmir12, 3));
$insert4 = $query->execute(array($iskenderun8, $iskenderun10, $iskenderun12, 4));
$insert5 = $query->execute(array($konya8, $konya10, $konya12, 5));
$insert6 = $query->execute(array($kayseri8, $kayseri10, $kayseri12, 6));
$insert7 = $query->execute(array($karabuk8, $karabuk10, $karabuk12, 7));
$insert8 = $query->execute(array($samsun8, $samsun10, $samsun12, 8));
$insert9 = $query->execute(array($biga8, $biga10, $biga12, 9));
$insert10 = $query->execute(array($sivas8, $sivas10, $sivas12, 10));
$insert11 = $query->execute(array($diyarbakir8, $diyarbakir10, $diyarbakir12, 11));
$insert12 = $query->execute(array($mardin8, $mardin10, $mardin12, 12));
$insert13 = $query->execute(array($van8, $van10, $van12, 13));


if ( $insert1 && $insert2 && $insert3 && $insert4 && $insert5 && $insert6 && $insert7 && $insert8 && $insert9 && $insert10 && $insert11 && $insert12 && $insert13){
    $last_id = $db->lastInsertId();
    print "Demir verileri güncellendi!";
} else{ echo "\nPDO::errorInfo():\n";
    print_r($db->errorInfo());}

   //api dogru calisacak kod sonu //
   
   
}else{
    echo "Api kodunuz hatalıdır, lütfen api kodunuzu kontrol ediniz....";
}

?>
</body>
</html>