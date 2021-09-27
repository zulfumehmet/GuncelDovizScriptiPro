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
$sil = $_GET["sil"];

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
        <?php 
       $stmt=$db->prepare("DELETE FROM haberler WHERE id=:id");
    $result=$stmt->execute([
        ":id" => $sil
    ]);
    
    echo '<div class="alert alert-success">Haber Başarıyla Silindi</div>';
?>
  
			
        
      </div>
    </div>
  </div>
   </body>
</html>




<?php
}
?>
