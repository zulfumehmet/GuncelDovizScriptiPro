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
if($haberyetki == 1){}else{header("Location:index.php");}
?>

    <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
          
<?php  
         $haberid = $_POST["haberid"];
         $baslik = $_POST["baslik"];
         $resim = $_FILES['dosya']['name'];
         $icerik = $_POST["icerik"];
         $etiket = $_POST["etiket"];
         $kategori = $_POST["kategori"];

        // Gönderilen dosya adınındaki türkçe karakter ve boşlukları dönüştürücü fonksiyonumuz
  
  // Gönderilen dosya adınındaki türkçe karakter ve boşlukları dönüştürücü fonksiyonumuz
  function dosyaadi($degisken){
    $bul  = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', 'Ö', 'İ', 'Ü', '-');
    $degistir = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'o', 'i', 'u', ' ');
    $sonuc = strtolower(str_replace($bul, $degistir, $degisken));
    $sonuc = str_replace(' ', '-', $sonuc);
    return $sonuc;
  }
  
  function seo($s) {
            $tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',':',',','&','%','?','!',"'",' ');
            $eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','','-','','-','-','-','-');
            $s = str_replace($tr,$eng,$s);
            $s = strtolower($s);
            $s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
            $s = preg_replace('/\s+/', '-', $s);
            $s = preg_replace('|-+|', '-', $s);
            $s = preg_replace('/#/', '', $s);
            $s = str_replace('.', '', $s);
            $s = trim($s, '-');
    return $s;
}

$seo = seo($baslik);

    if(isset($_FILES['dosya']))//Dosya yüklendimi diye kontrol ediyoruz.
    {
        $hata = $_FILES['dosya']['error'];//Dosyada hata var ise hata değişkenine aktardık. Buradan 1 veya 0 sonucu çıkar.
        if($hata != 0)//hata 0 değilse hatayı göster dedik.
        {

$query = $db->prepare("UPDATE haberler SET
                                baslik = :baslik,
                                icerik = :icerik,
                                seo = :seo,
                                etiket = :etiket,
                                kategori = :kategori,
                                ekleyen = :ekleyen
WHERE ID = :haberid");
$update = $query->execute(array(
                "baslik" => $baslik,
                "icerik" => $icerik,
                "seo" => $seo,
                "etiket" => $etiket,
                "ekleyen" => $ekleyen,
                "kategori" => $kategori,
                "haberid" => $haberid
));
if ( $update ){
     print '<div class="alert alert-success">Haber Güncellendi</div>';
                }
}
        else//Hata yoksa dedik
        {
            function resizeImage($resourceType,$image_width,$image_height) {
    $resizeWidth = 700;
    $resizeHeight = 450;
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}
 
if(isset($_POST["form_submit"])) {
  $imageProcess = 0;
    if(is_array($_FILES)) {
        $fileName = $_FILES['dosya']['tmp_name']; 
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = time();
        $uploadPath = "../haberler/";
        $fileExt = pathinfo($_FILES['dosya']['name'], PATHINFO_EXTENSION);
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagejpeg($imageLayer,$uploadPath."haberresim_".$resizeFileName.'.'. $fileExt);
                break;
 
            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagegif($imageLayer,$uploadPath."haberresim_".$resizeFileName.'.'. $fileExt);
                break;
 
            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagepng($imageLayer,$uploadPath."haberresim_".$resizeFileName.'.'. $fileExt);
                break;
 
            default:
                $imageProcess = 0;
                break;
        }
        move_uploaded_file($file, $uploadPath. $resizeFileName. ".". $fileExt);
        $imageProcess = 1;
        $resimyol = "haberresim_".$resizeFileName.'.'. $fileExt;
    }
 
  if($imageProcess == 1){
    
  
 $sonuc = '<div class="alert alert-success">Haber Güncellendi</div>';
    
    $query = $db->prepare("UPDATE haberler SET
                                baslik = :baslik,
                                icerik = :icerik,
                                resim = :resim,
                                seo = :seo,
                                etiket = :etiket,
                                kategori = :kategori,
                                ekleyen = :ekleyen
WHERE ID = :haberid");
$update = $query->execute(array(
                "baslik" => $baslik,
                "icerik" => $icerik,
                "resim" => $resimyol,
                "seo" => $seo,
                "etiket" => $etiket,
                "ekleyen" => $ekleyen,
                 "kategori" => $kategori,
                "haberid" => $haberid
));
if ( $update ){
     print $sonuc;

}

  }
  else
  {
    Echo '<div class="alert alert-danger">Yüklemek istediğiniz dosya formatı uygun değil.</div>';;
        }
  $imageProcess = 0;
}
        }
    }
          ?>
      </div>
    </div>
  </div>
   </body>
</html>




<?php
}
?>
