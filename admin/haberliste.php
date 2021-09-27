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
          
           <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Resim</th>
      <th scope="col">Başlık</th>
      <th scope="col">Kategori</th>
      <th scope="col">Ekleyen</th>
      <th scope="col">İşlem</th>
    </tr>
  </thead>
  <tbody>
          <?php
		  if(empty($_GET["s"])){
			  $_GET["s"] = 1;
		  }else {}
    $toplamVeri = $db->query("SELECT COUNT(*) FROM haberler")->fetchColumn();
	$goster = 10;
	$toplamSayfa = ceil($toplamVeri / $goster);
	$sayfa = $_GET["s"];
	if($sayfa < 1) $sayfa = 1; 
	if($sayfa > $toplamSayfa)
	{
		$sayfa = (int)$toplamSayfa;
	}
	$limit = ($sayfa - 1) * $goster;

	$veriler = $db->prepare("SELECT * FROM haberler INNER JOIN kategori ON haberler.kategori = kategori.kategorino ORDER BY haberler.ID DESC LIMIT :basla, :bitir");
	$veriler->bindValue(":basla",$limit,PDO::PARAM_INT);
	$veriler->bindValue(":bitir",$goster,PDO::PARAM_INT);
	$veriler->execute();
	$dizi = $veriler->fetchAll(PDO::FETCH_OBJ);
	foreach ($dizi as $item) {
		?>
	
		    
		  <tr>
		    <th class="w-25"><img src="../haberler/<?php echo $item->resim;?>" class="img-fluid img-thumbnail"></th>
		    <td class="w-25" scope="row"><?php echo $item->baslik;?></td>
		    <td class="w-10" scope="row"><?php echo $item->ekleyen;?></td>
		    <td class="w-10" scope="row"><?php echo $item->kategoriyadi;?></td>
		    <td class="w-30" aligin="center"><a href="sil.php?sil=<?php echo $item->ID;?>"><button type="button" class="btn btn-danger btn-sm">Sil</button></a> <a href="haberduzenle.php?id=<?php echo $item->ID; ?>"><button type="button" class="btn btn-success btn-sm">Düzenle</button></a> </td></tr>
    
		
		<?php
	}
	?>
	</tbody>
	</table>
	
	<nav aria-label="Page navigation example">
  <ul class="pagination">
           <?php 
           
           $sayfa_goster = 15; // gösterilecek sayfa sayısı
    
       $en_az_orta = ceil($sayfa_goster/2);
       $en_fazla_orta = ($toplamSayfa+1) - $en_az_orta;
        
       $sayfa_orta = $sayfa;
       if($sayfa_orta < $en_az_orta) $sayfa_orta = $en_az_orta;
       if($sayfa_orta > $en_fazla_orta) $sayfa_orta = $en_fazla_orta;
        
       $sol_sayfalar = round($sayfa_orta - (($sayfa_goster-1) / 2));
       $sag_sayfalar = round((($sayfa_goster-1) / 2) + $sayfa_orta); 
        
       if($sol_sayfalar < 1) $sol_sayfalar = 1;
       if($sag_sayfalar > $toplamSayfa) $sag_sayfalar = $toplamSayfa;
        
       if($sayfa != 1) echo ' <li class="page-item"><a class="page-link" href="haberliste.php?s=1">İlk Sayfa</a></li> ';
       if($sayfa != 1) echo ' <li class="page-item"><a class="page-link" href="haberliste.php?s='.($sayfa-1).'">&lt;Önceki</a></li> ';
        
       for($s = $sol_sayfalar; $s <= $sag_sayfalar; $s++) {
           if($sayfa == $s) {
               echo '<li class="page-item"><a class="page-link">' . $s . '</a></li>';
           } else {
               echo ' <li class="page-item"><a class="page-link" href="haberliste.php?s='.$s.'">'.$s.'</a></li> ';
           }
       }
        
       if($sayfa != $toplamSayfa) echo ' <li class="page-item"><a class="page-link" href="haberliste.php?s='.($sayfa+1).'">Sonraki&gt;</a></li> ';
       if($sayfa != $toplamSayfa) echo ' <li class="page-item"><a class="page-link" href="haberliste.php?s='.$toplamSayfa.'">Son sayfa&gt;&gt;</a></li>';
           ?>
     </ul>
</nav>
	
  
			
        
      </div>
    </div>
  </div>
   </body>
</html>




<?php
}
?>
