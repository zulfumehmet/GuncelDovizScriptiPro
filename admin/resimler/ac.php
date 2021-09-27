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
header("location:../../"); //Sql injection girişimi yakalandığında yönlendiriyoruz.
exit;
}
 
$i++;	
}
 
if (strlen($parametreler)>=90) {
header("location:../../");
exit;	
}
// yukardaki komutlar sql injection onlemek maksatli

?>

<!DOCTYPE html>
<html>
    <head>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Resimler </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	    
	    <style>
body,html{width:100%;height:100%;margin:0; padding:0}
div.container{min-height:100%; height:auto !important; height:100%;}

.box{ 
    margin: 5px 0;
 }
 
 .blue{
   position:static;
   
}


input[type=button], input[type=submit], input[type=file] { 
 
    background-color: #346fed;
 
    border: none;
 
    color: white;
 
    padding: 18px 36px;
 
    margin: 5px 3px;
 
    cursor: pointer;
}
.button {
  background-color: #346fed; /* Green */
  border: none;
  color: white;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 4px 2px;
  cursor: pointer;
}

.button1 {font-size: 10px;}
.button2 {font-size: 12px;}

.ic_bolme{
    float:left;
  
}
	    </style>
    </head>
    <body>
        <div style="position:fixed;top:10px;right: 10px;z-index:99999;font-size:12px;">
		<button type="button" 
        onclick="window.open('', '_self', ''); window.close();">Pencereyi Kapat</button>
	</div>
       
<script>
    function Goster()
    {
        document.getElementById("alan").hidden = false;
    }
</script>    
        
        
 <div hidden class="container" id="alan" >
            <center><img src="loading.gif" alt="yukleniyor" title="yukleniyor"/></center>
        </div>        
        
 <div class="box blue"><a href="liste.php"><button type="button" class="btn btn-success">Klasörlere Bak</button></a></br></div>     
<div class="box blue"><p>Lütfen resim seçip Yükle butonuna tıklayınız. Resim Yükleme işleminin bitmesini bekleyiniz.</p>
<form action="aupload.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="adi" value="<?php echo $gelen_kod; ?>">
<input type="file" name="image[]" accept="image/png, image/jpeg" multiple /><hr />
<button class="btn btn-primary"  type="submit" name="submit" value="Yükle" onclick="Goster()">Yükle</button>
</form>
</div>
<!--Yukarilar susleme sanati ile alakali -->
<div class="box blue"></div>
 
<?php
$query= $db -> prepare("SELECT * FROM resimtoplu where ilanid='$gelen_kod' ORDER BY id DESC"); // resimler tablaosunda bulunan atadigimiz id ait bilgi varsa resimleri gostersin.
$query-> execute();
$musteriler = $query -> fetchAll(); ?>
<script type="text/javascript">
       function copyToClipboard(element) {
          var $temp = $("<input>");
          $("body").append($temp);
          $temp.val($(element).text()).select();
          document.execCommand("copy");
          $temp.remove();
        }

    </script>
    <div class="container">
  <div class="row">
  
<?php 
        foreach($musteriler as $dizi){
       ?>
       
       <div class="card" style="width: 10rem;">
  <img src="<?=$uploadyolu;?><?php echo $gelen_kod ?>/thumbnail/<?=$dizi["kucuk"]?>" class="card-img-top" alt="<?=$dizi["kucuk"]?>" width="150px"height="115px"/>
  <div class="card-body">
     <a href="sil.php?id=<?=$dizi["id"]?>" onclick="return confirm('Silmek istediğinize emin misiniz ?')"><button type="button " class="btn btn-primary btn-sm">Sil</button></a>
				  <button type="button" class="btn btn-primary btn-sm" onclick="copyToClipboard('#p<?=$dizi["id"]?>')">Kopyala</button>
				   <p id="p<?=$dizi["id"]?>"  class="d-none d-print-block">//<?php echo $_SERVER["HTTP_HOST"]; ?><?=$dizinyolu;?><?php echo $gelen_kod ?>/<?=$dizi["resim_adi"]?></p>

  </div>
</div>
       
				
      
       <?php } 
       // dongu olusturup resimlerin hepsini siralamasini istedik. Arti olarak silmek icinde resmin idsini kullanacagiz
       ?>
       </div>
       </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  
 
</body>
</html>
<?php } ?>