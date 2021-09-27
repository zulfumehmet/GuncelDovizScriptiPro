<?php
include("../../db.php");
session_start();
if(!isset($_SESSION["login"])){
	echo "Bu sayfayı görüntüleme yetkiniz yoktur.";
	header("Location:../giris.php");
}
else
{

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
if($_POST){
    
    $klasor = $_POST["klasor"];
    $klasorekle2 = $db->prepare("INSERT INTO resimklasor SET klasor = ?");
    $klasorekle = $klasorekle2->execute(array($klasor));
}
if (isset($_GET['sil']))
	{
		
		$urun_silme = $db->prepare("DELETE FROM resimklasor WHERE id = :id");
		$delete = $urun_silme->execute(array('id' => $_GET['sil']));
		
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


.list li{
	list-style-type:none; 
	background:url(klasor.jpg) left center no-repeat; 
	padding:0px 10px 100px 77px;
    display: inline;
    margin: 10px;
    position: relative;
}
	    </style>
    </head>
    <body>

<div style="position:fixed;top:10px;right: 10px;z-index:99999;font-size:12px;">
		<button type="button" 
        onclick="window.open('', '_self', ''); window.close();">Pencereyi Kapat</button>
	</div>

        <div class="container">
  <div class="row">
       <div class="col-3">
     <h3>Klasör Oluştur</h3>
    </div>
    <div class="col-5">
      <form method="POST" action="">
  <div class="form-group">
      <label for="klasoradi">Klasör Adı</label>
    <input type="text" class="form-control" id="klasor" name="klasor" placeholder="Klasör Adı Gir">
  </div>
  <button type="submit" class="btn btn-primary">Oluştur</button>
</form>
    </div>
      
      
      </div></div>
      
        <div class="container">
  <div class="row">
     <hr style="border-color: blue">

      <h2>Klasör Seçiniz</h2>
      <hr style="border-color: blue">

      </div></div>
<div class="container">
  <div class="row">

      <?php
$query= $db -> prepare("SELECT * FROM resimklasor order by id desc"); // resimler tablaosunda bulunan atadigimiz id ait bilgi varsa resimleri gostersin.
$query-> execute();
$musteriler = $query -> fetchAll();  
        foreach($musteriler as $dizi){
       ?>
 
<div class="card" style="width: 8rem; padding:0;">
    <p class="text-right"><a href="liste.php?sil=<?=$dizi["id"]?>">Sil</a></p>
  <a href="ac.php?id=<?=$dizi["id"]?>"><img class="card-img-top" src="klasor.jpg" alt="Card image cap"></a>
  <div class="card-body" style=" padding:0;">
    <h5><a href="ac.php?id=<?=$dizi["id"]?>"><?=$dizi["klasor"]?></a></h5>
  </div>
</div>
  <?php } 
       
       ?>
       <div class="container">
  <div class="row"><h5>Son 20 Resim</h5>
  </div></div>

<?php
$query= $db -> prepare("SELECT * FROM resimlertoplu  ORDER BY id DESC limit 20"); // resimler tablaosunda bulunan atadigimiz id ait bilgi varsa resimleri gostersin.
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
  <img src="<?=$uploadyolu;?><?=$dizi["ilanid"]?>/thumbnail/<?=$dizi["kucuk"]?>" class="card-img-top" alt="<?=$dizi["kucuk"]?>" width="150px"height="115px"/>
  <div class="card-body">
     <a href="sil.php?id=<?=$dizi["id"]?>" onclick="return confirm('Silmek istediğinize emin misiniz ?')"><button type="button " class="btn btn-primary btn-sm">Sil</button></a>
				  <button type="button" class="btn btn-primary btn-sm" onclick="copyToClipboard('#p<?=$dizi["id"]?>')">Kopyala</button>
				   <p id="p<?=$dizi["id"]?>"  class="d-none d-print-block"><?=$dizinyolu;?><?=$dizi["ilanid"];?>/<?=$dizi["resim_adi"];?></p>

  </div>
</div>
       
				
      
       <?php } 
       // dongu olusturup resimlerin hepsini siralamasini istedik. Arti olarak silmek icinde resmin idsini kullanacagiz
       ?>
       </div>
       </div>
    
  </div>
</div>
        
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  
</body>
</html>
<?php } ?>
