<?php
//error_reporting(0);
$dizinyolu= "/images/"; //Resimlerin acilacagi yol
$uploadyolu = "../../images/"; // resimleri bir ust dizine yukleyecegimiz icin ../ ust sizinlere cikiyoruz.
try {
     $db = new PDO("mysql:host=localhost;dbname=dbadi", "DbKullaniciadi", "DbSifre");
     $db->exec("SET CHARACTER SET utf8");
} catch ( PDOException $e ){
     print $e->getMessage();
}

 $genelayar = $db->prepare("SELECT * FROM ayarlar WHERE id = 1");
    $genelayar->bindParam(1, $sira, PDO::PARAM_INT);
    $genelayar->execute();
    $genela = $genelayar->fetch(PDO::FETCH_ASSOC);
    
    $site_adi = $genela['author'];

function noktacevir($data)
         {
         if(strpos($data,","))
         {$chng = str_replace(",",".",$data); $data = $chng;}
         return $data;
         }

function virgulcevir($data)
         {
         $chng = number_format($data, 2, ',', '.');
         }

function noktasil($data)
         {
         if(strpos($data,","))
         {$chng = str_replace(".","",$data); $data = $chng;}
         return $data;
         }

function etiketler()
            {
             $etiketler=array('<a href="doviz.html" class="flex-c-c size-h-1 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                   Döviz
              </a>',
              '<a href="altin.html" class="flex-c-c size-h-1 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                   Altın
              </a>',
              '<a href="detay-altin-ons.html" class="flex-c-c size-h-1 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                   Ons
              </a>',
              '<a href="kripto.html" class="flex-c-c size-h-1 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                   Kripto Para
              </a>',
              '<a href="emtia.html" class="flex-c-c size-h-1 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                   Emtialar
              </a>',
              '<a href="detay-altin-giramaltin.html" class="flex-c-c size-h-1 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                   Gram Altın
              </a>',
              '<a href="detay-emtia-brentpetrol.html" class="flex-c-c size-h-1 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                   Petrol
              </a>',
              '<a href="haberler.html" class="flex-c-c size-h-1 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                   Haberler
              </a>',
              '<a href="habers-ekonomi.html" class="flex-c-c size-h-1 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                   Ekonomi
              </a>',
              '<a href="detay-doviz-amerikandolari.html" class="flex-c-c size-h-1 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                   Dolar
              </a>',
              '<a href="detay-doviz-ingilizsterlini.html" class="flex-c-c size-h-1 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                   Sterlin
              </a>',
                   '<a href="detay-doviz-euro.html" class="flex-c-c size-h-1 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                   Euro
              </a>',
                   '<a href="demir.html" class="flex-c-c size-h-1 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                   Demir Fiyatları
              </a>',
                   '<a href="detay-faiz-oran.html" class="flex-c-c size-h-1 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                   Faiz Oranları
              </a>');
                    shuffle($etiketler);
                    
                      foreach ($etiketler as $rastgelelistele)
                                      {
                                          echo "$rastgelelistele";
                                                    }
              }

      function deger($fiyat) { 
          if($fiyat < "9") {
              $var1 =  substr($fiyat, 0, 1)." ";
          } 
          elseif($fiyat < "99") {
              $var1 =  substr($fiyat, 0, 2)." ";
          }
          elseif($fiyat < "999") {
              $var1 =  substr($fiyat, 0, 3)." ";
          }
          elseif($fiyat < "9999") {
              $var1 =  substr($fiyat, 0, 1)." BİN";
          }
          elseif($fiyat < "99999") {
                  $var1 =  substr($fiyat, 0, 2)." BİN";
          }
          elseif($fiyat < "999999") {
                  $var1 =  substr($fiyat, 0, 3)." BİN";
          }
          elseif($fiyat < "999999") {
                  $var1 =  substr($fiyat, 0, 3)." BİN";
          }
          elseif($fiyat < "9999999") {
                  $var1 =  substr($fiyat, 0, 1)." MLYN";
          }
          elseif($fiyat < "99999999") {
                  $var1 =  substr($fiyat, 0, 2)." MLYN";
          }
          elseif($fiyat < "999999999") {
                 $var1 =  substr($fiyat, 0, 3)." MLYN";
          }
          elseif($fiyat < "9999999999") {
                  $var1 =  substr($fiyat, 0, 1)." MLYR";
          }
          elseif($fiyat < "99999999999") {
                  $var1 =  substr($fiyat, 0, 2)." MLYR";
          }
          elseif($fiyat < "999999999999") {
                  $var1 =  substr($fiyat, 0, 3)." MLYR";
          }
          elseif($fiyat < "9999999999999") {
                  $var1 =  substr($fiyat, 0, 1)." TRLY";
          }
          elseif($fiyat < "99999999999999") {
                  $var1 =  substr($fiyat, 0, 2)." TRLY";
          } 
          elseif($fiyat < "99999999999999") {
                  $var1 =  substr($fiyat, 0, 3)." TRLY";
          }  
          return $var1;                     
      }

function degisim($metin){

        if($metin > 0){ 
            $var2 = "up";
        }elseif ($metin == 0){
           $var2 = "flat";
        }elseif($metin < 0){
            $var2 =  "down";
        }
        return $var2;
}
function tr_karakter($text) {
     $text = trim($text);
     $search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ','%',"'","=",'?','"','/','(');
     $replace = array('c','c','g','g','i','i','o','o','s','s','u','u','-');
     $new_text = str_replace($search,$replace,$text);
     return $new_text;
  }
  function tr_karakterhaber($text) {
     $text = trim($text);
     $search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü','%',"'","=",'?','"','/','(');
     $replace = array('c','c','g','g','i','i','o','o','s','s','u','u',' ');
     $new_text = str_replace($search,$replace,$text);
     return $new_text;
  } 
?>