<?php
error_reporting(0);
include ("../db.php");
$genelayar = $db->prepare("SELECT * FROM ayarlar WHERE id = 1");
$genelayar->bindParam(1, $sira, PDO::PARAM_INT);
$genelayar->execute();
$genela = $genelayar->fetch(PDO::FETCH_ASSOC);

if($_GET['api'] == $genela['api']) {

    function vericek(){ 
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
        $site_adresimiz = curl_connect("https://www.tcmb.gov.tr/kurlar/today.xml");
        $kur_bayrak =  curl_search('Kod="', '"', $site_adresimiz);
        $kur_adi = curl_search('<Isim>', '</Isim>', $site_adresimiz);
        $kur_birim = curl_search('<Unit>', '</Unit>', $site_adresimiz);
        $kur_alis = curl_search('<ForexBuying>', '</ForexBuying>', $site_adresimiz);
        $kur_satis = curl_search('<ForexSelling>', '</ForexSelling>', $site_adresimiz);
        $kur_kisa_kod = curl_search('CurrencyCode="', '"', $site_adresimiz);
       
        for($sayi = 0; $sayi < 19; $sayi++) {
            $kes = strtolower($kur_bayrak[$sayi]);
            
       $sonuc .="<tr><td id='kur_adi'><span class='flag-icon flag-icon-".substr($kes , 0 , 2)."'></span> - ".$kur_adi[$sayi]." ( ".$kur_kisa_kod[$sayi]." )</td><td>".($kur_alis[$sayi]/$kur_birim[$sayi])." TL</td><td>".($kur_satis[$sayi]/$kur_birim[$sayi])." TL</td></tr>";
            }
            return $sonuc;
        }
            $deger = vericek();
        
          $query = $db->prepare("UPDATE tcmb SET deger = :deger WHERE id = 1");
          $update = $query->execute(array(
          "deger" => $deger
          ));
      if ( $update ){
          print "TCMB verileri güncellendi";
             }

}else{
    echo "Api kodunuz hatalıdır, lütfen api kodunuzu kontrol ediniz....";
}

                         ?>