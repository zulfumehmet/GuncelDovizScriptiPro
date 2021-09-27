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
if($mesajyetki == 1){}else{header("Location:index.php");}

if(isset($_GET["sil"])){
    $sil = $db->prepare("DELETE FROM iletisim WHERE id = :id");
    $delete = $sil->execute(array(
       'id' => $_GET['sil']
    ));
    $sonuc = '<div class="alert alert-danger">Mesaj SilindiSilindi</div>';

  }
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

<?php 
$mesaj_varmi = $db->query("SELECT MAX(id) FROM `iletisim`")->fetch(PDO::FETCH_ASSOC);
$mesajvarmi = $mesaj_varmi["MAX(id)"];
?>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
          
           <table class="table table-hover table-bordered">
  <thead>
    <tr>
      <th scope="col">Ad / Soyad</th>
      <th scope="col">Mail</th>
      <th scope="col">Konu</th>
      <th scope="col">Mesaj</th>
      <th scope="col">İşlem</th>
    </tr>
  </thead>
  <tbody>
      <?php  if(empty($_GET["s"])){
			  $_GET["s"] = 1;
		  }else {}
      
      if($mesajvarmi == 0){ ?>
         <tr>
       <td colspan="5">Mesaj kutunuz boş...</td>
        </tr>
        <?php }else {
		 
    $toplamVeri = $db->query("SELECT COUNT(*) FROM iletisim")->fetchColumn();
	$goster = 10;
	$toplamSayfa = ceil($toplamVeri / $goster);
	$sayfa = $_GET["s"];
	if($sayfa < 1) $sayfa = 1; 
	if($sayfa > $toplamSayfa)
	{
		$sayfa = (int)$toplamSayfa;
	}
	$limit = ($sayfa - 1) * $goster;

	$veriler = $db->prepare("SELECT * FROM iletisim  ORDER BY id DESC LIMIT :basla, :bitir");
	$veriler->bindValue(":basla",$limit,PDO::PARAM_INT);
	$veriler->bindValue(":bitir",$goster,PDO::PARAM_INT);
	$veriler->execute();
	$dizi = $veriler->fetchAll(PDO::FETCH_OBJ);
	foreach ($dizi as $item) {
		?>
	 		  <tr  <?php $okundu = $item->okundu; if( $okundu == 1 ){echo 'class="table-danger"';}else{} ?> >
		    <th class="w-25"><?php echo $item->adsoyad;?></th>
		    <td scope="row"><?php echo $item->mail;?></td>
		    <td scope="row"><?php echo $item->konu;?></td>
		    <td scope="row"><?php echo mb_substr($item->mesaj, 0, 20, 'utf-8'); ?>...</td>
		    <td aligin="center"><a href="mesajlar.php?sil=<?php echo $item->id;?>"><button type="button" class="btn btn-danger btn-sm">Sil</button></a> / <a href="oku.php?id=<?php echo $item->id; ?>"><button type="button" class="btn btn-primary btn-sm">Oku</button></a> </td>
		  </tr>
    
		
		<?php
	}
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
        
       if($sayfa != 1) echo ' <li class="page-item"><a class="page-link" href="?s=1">İlk Sayfa</a></li> ';
       if($sayfa != 1) echo ' <li class="page-item"><a class="page-link" href="?s='.($sayfa-1).'">&lt;Önceki</a></li> ';
        
       for($s = $sol_sayfalar; $s <= $sag_sayfalar; $s++) {
           if($sayfa == $s) {
               echo '<li class="page-item"><a class="page-link">' . $s . '</a></li>';
           } else {
               echo ' <li class="page-item"><a class="page-link" href="?s='.$s.'">'.$s.'</a></li> ';
           }
       }
        
       if($sayfa != $toplamSayfa) echo ' <li class="page-item"><a class="page-link" href="?s='.($sayfa+1).'">Sonraki&gt;</a></li> ';
       if($sayfa != $toplamSayfa) echo ' <li class="page-item"><a class="page-link" href="?s='.$toplamSayfa.'">Son sayfa&gt;&gt;</a></li>';
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
