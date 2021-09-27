<?php
include("baglanti.php");
session_start();
if(!isset($_SESSION["login"])){
	echo "Bu sayfayı görüntüleme yetkiniz yoktur.";
	header("Location:giris.php");
}
else
{
    
//mesaj okundu
$gelen_id = $_GET["id"] ;
$mesajoku = $db->query("SELECT * FROM iletisim WHERE id = '{$gelen_id}'")->fetch(PDO::FETCH_ASSOC);
$kgncl = $db->prepare("UPDATE iletisim SET
                    okundu = ?
                            WHERE id = ?");
                    $update = $kgncl->execute(array(
                    "0", $gelen_id
                    ));
                    
include("ust.php");
if($mesajyetki == 1){}else{header("Location:index.php");}

  if(empty($sonuc)){

      }else{
          echo '<div class="container"><div class="row"><div class="col-lg-12 text-center">'.$sonuc.'</div></div></div>';
      }
?>
	  <!-- Page Content -->
	  <style>

.table-image {
  td, th {
    vertical-align: middle;
  }
}
</style>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
          <table class="table table-bordered">
 <tbody>
  <tr>
   <td style="width: 14.2683%;">Adı Soyadı</td>
   <td style="width: 85.7317%;"><?php echo $mesajoku["adsoyad"] ?></td>
  </tr>
  <tr>
   <td style="width: 14.2683%;">Mail</td>
   <td style="width: 85.7317%;"><?php echo $mesajoku["mail"] ?></td>
  </tr>
  <tr>
   <td style="width: 14.2683%;">Konu</td>
   <td style="width: 85.7317%;"><?php echo $mesajoku["konu"] ?></td>
  </tr>
  <tr>
   <td style="width: 14.2683%;">Mesajı</td>
   <td style="width: 85.7317%;"><?php echo $mesajoku["mesaj"] ?></td>
  </tr>
 </tbody>
</table>
      </div>
      <div class="col-lg-12"><a href="mesajlar.php?sil=<?php echo $mesajoku["id"] ?>"><button type="button" class="btn btn-danger">Sil</button></a>  <a  href="mesajlar.php"><button type="button" class="btn btn-primary">Gelen Kutusuna Git</button></a></div>
    </div>
  </div>
   </body>
</html>




<?php
}
?>
