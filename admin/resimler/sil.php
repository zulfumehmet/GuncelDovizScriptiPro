<?php
include("../../db.php");
session_start();
if(!isset($_SESSION["login"])){
	echo "Bu sayfayı görüntüleme yetkiniz yoktur.";
	header("Location:../giris.php");
}
else
{
$gelen_kod = $_GET["id"]; 

$parametreler = strtolower($_SERVER['QUERY_STRING']); //Adres satırından gelen tüm sorguları aldık.
$yasaklar="%¿¿'¿¿`¿¿insert¿¿concat¿¿delete¿¿join¿¿update¿¿select¿¿\"¿¿\\¿¿<¿¿>¿¿tablo_adim¿¿kolon_adim"; //Buraya tablo adlarınızı da ekleyiniz. Her ekleme sonrasını ¿¿ ile ayırmalısınız.
$yasakla=explode('¿¿',$yasaklar);
$sayiver=substr_count($yasaklar,'¿¿');
$i=0;
while ($i<=$sayiver) {
if (strstr($parametreler,$yasakla[$i])) {
header("location:http://localhost/"); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}
 
$i++;	
}
 
if (strlen($parametreler)>=90) {
header("location:http://localhost/");
exit;	
}
?>
<html>
    <head>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Resimler </title>
        <link rel="stylesheet" href="assets/css/styles.css" />
        <script src="assets/js/script.js"></script>
		<script src="assets/js/albumPreviews.js"></script>
        <script src="http://cdn.tutorialzine.com/misc/adPacks/v1.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
	    <script type="text/javascript" src="jquery/jquery.js"></script>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="w3.css">

	    </head>
	    <body>
<?php

$id = $_GET['id']; 


// veri cekme

  $veri = $db->prepare('SELECT * FROM resimtoplu WHERE id = :sira');
  $veri->bindValue(':sira', $id, PDO::PARAM_INT); 
  $veri->execute();
  $dizi = $veri->fetchAll(PDO::FETCH_ASSOC);
  
    $kucuk = $dizi[0]['kucuk']; 
    $resimid = $dizi[0]['id']; 
    $resim_adi = $dizi[0]['resim_adi']; 
    $ilanid = $dizi[0]['ilanid']; 
  
    

?> 


<div class="w3-container">
    <h1>İlan Resmi silme.</h1>
<a href="ac.php?id=<?php echo $ilanid; ?>"><p class="button">Başka Resim Sil</p></a>
   <ul class="w3-ul w3-card-4">


<?php

// kaydi silme



$kullanici_rutbe=$ilanid;
if ($kullanici_rutbe==$ilanid) { 
echo " ";
{
$sorgu = $db->query("DELETE FROM resimtoplu WHERE id = '$resimid'");

    if ($sorgu->rowCount() > 0) {
        echo $sorgu->rowCount() . '<li class="w3-bar"><span  class="w3-bar-item w3-button w3-white w3-xlarge w3-right">Silindi</span><img src="cop.jpg" class="w3-bar-item w3-circle w3-hide-small" style="width:85px"><div class="w3-bar-item"><span class="w3-large">';
    } else {
        echo '<li class="w3-bar"><span  class="w3-bar-item w3-button w3-white w3-xlarge w3-right">Silinmedi !!!</span><img src="no.png" class="w3-bar-item w3-circle w3-hide-small" style="width:85px"><div class="w3-bar-item"><span class="w3-large">Bir Sorun Oluştu </span><br><span>Herhangi bir kayıt silinmedi</span> </div></li>';
    }

} 

// sunucudan silme kismi
unlink("$uploadyolu$ilanid/$resim_adi");

unlink("$uploadyolu$ilanid/thumbnail/$kucuk");
echo 'Silinen Resimler'.$kucuk.' </span><br><span>Resim: '.$resim_adi.'</span> </div></li>';

} else {
echo '<li class="w3-bar"><span  class="w3-bar-item w3-button w3-white w3-xlarge w3-right">Silinmedi !!!</span><img src="no.png" class="w3-bar-item w3-circle w3-hide-small" style="width:85px"><div class="w3-bar-item"><span class="w3-large">Bir Sorun Oluştu </span><br><span>Bu resmi silme yetkiniz yoktur</span> </div></li>';
}



 ?>

 </ul>
</div>

</body>
</html>
<?php } ?>