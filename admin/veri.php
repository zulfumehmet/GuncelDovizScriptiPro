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
if($botyetki == 1){}else{header("Location:index.php");}

if(isset($_GET["sil"])){
    $siltur = $_GET['tur'];
  $query = $db->prepare("DELETE FROM $siltur WHERE id = :id");
$delete = $query->execute(array(
   'id' => $_GET['sil']
));
  }
  
  if(empty($_GET['tur'])){$_GET['tur'] = 1;}else {}


if(empty($sonuc)){

}else{
    echo '<div class="container"><div class="row"><div class="col-lg-12 text-center">'.$sonuc.'</div></div></div>';
}
?>
	  <!-- Page Content -->
  <div class="container">
  <br>
    <div class="row">
      <div class="col-lg-12 text-center">
              <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <a href="veri.php?tur=doviz&tip=1"><button type="button" class="btn btn-info">Döviz</button></a>
                        </div>
                        <div class="col-sm">
                            <a href="veri.php?tur=altin&tip=1"><button type="button" class="btn btn-info">Altın</button></a>
                        </div>
                        <div class="col-sm">
                            <a href="veri.php?tur=kripto&tip=1"><button type="button" class="btn btn-info">Kripto</button></a>
                        </div>
                        <div class="col-sm">
                            <a href="veri.php?tur=borsa&tip=1"><button type="button" class="btn btn-info">Borsa</button></a>
                        </div>
                        <div class="col-sm">
                            <a href="veri.php?tur=emtia&tip=1"><button type="button" class="btn btn-info">Emtia</button></a>
                        </div>
                        <div class="col-sm">
                            <a href="veri.php?tur=faiz&tip=1"><button type="button" class="btn btn-info">Faiz</button></a>
                        </div>
                        <div class="col-sm">
                            <a href="veri.php?tur=demir&tip=1"><button type="button" class="btn btn-info">Demir</button></a>
                        </div>
                    </div>
                </div>
                </br>
                <?php 
                if($_GET['tur'] == 'doviz'){?> 
                 <div class="container">
                    <div class="row">
                        <div class="col-sm">
                        <select class="select-css" class="select-css" onchange="if (this.value) window.location.href=this.value">
                            <option value="">Seçiniz</option>
                        <?php 
                        $tip = $_GET["tip"];
                        $doviztablo = $db->query("SELECT * FROM
                            (SELECT * FROM doviz WHERE kategori IN (1,2,3,4,5,6,7,8,9,10,11,12,13) ORDER BY id DESC LIMIT 13) AS T inner join kategoridoviz as ikinci on T.kategori = ikinci.kategorino ORDER BY kategorino ASC", PDO::FETCH_ASSOC);
                                if ( $doviztablo->rowCount() ){
                                    foreach( $doviztablo as $doviztabloa ){ ?>
                        
                            <option value="veri.php?tur=<?php echo $_GET['tur']; ?>&tip=<?php echo $doviztabloa['kategori']; ?>" <?php if($tip == $doviztabloa['kategori']){echo "selected";}else{} ?>><?php echo $doviztabloa['cinsi'];?></option>
                         <?php }} ?></select>
                         <table class="table table-hover">
                            <thead>
                                <tr>
                                <th scope="col">İd</th>
                                <th scope="col">Alış</th>
                                <th scope="col">Satış</th>
                                <th scope="col">Tarih</th>
                                <th scope="col">Sil</th>
                                </tr>
                            </thead>
                            <tbody>
                         <?php
		 if(empty($_GET["s"])){
            $_GET["s"] = 1;
        }else {}
  $toplamVeri = $db->query("SELECT COUNT(*) FROM doviz where kategori = $tip")->fetchColumn();
  $goster = 100;
  $toplamSayfa = ceil($toplamVeri / $goster);
  $sayfa = $_GET["s"];
  if($sayfa < 1) $sayfa = 1; 
  if($sayfa > $toplamSayfa)
  {
      $sayfa = (int)$toplamSayfa;
  }
  $limit = ($sayfa - 1) * $goster;

  $veriler = $db->prepare("SELECT * FROM `doviz` where kategori = $tip ORDER BY id DESC LIMIT :basla, :bitir");
  $veriler->bindValue(":basla",$limit,PDO::PARAM_INT);
  $veriler->bindValue(":bitir",$goster,PDO::PARAM_INT);
  $veriler->execute();
  $dizi = $veriler->fetchAll(PDO::FETCH_OBJ);
  foreach ($dizi as $item) {
		?>
	  <tr>
		    <th class="w-25"><?php echo $item->id;?></th>
		    <td scope="row"><?php echo $item->alis;?></td>
		    <td scope="row"><?php echo $item->satis;?></td>
		    <td aligin="center"><?php echo $item->tarih;?> </td>
            <td aligin="center"> <a href="veri.php?tur=<?php echo $_GET['tur']; ?>&tip=<?php echo $_GET['tip']; ?>&s=<?php echo $_GET["s"];?>&sil=<?php echo $item->id;?>"><button type="button" class="btn btn-danger btn-sm">Sil</button></a> </td>
        </tr>
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
     
    if($sayfa != 1) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur=doviz&tip='.$tip.'">İlk Sayfa</a></li> ';
    if($sayfa != 1) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur=doviz&tip='.$tip.'&s='.($sayfa-1).'">&lt;Önceki</a></li> ';
     
    for($s = $sol_sayfalar; $s <= $sag_sayfalar; $s++) {
        if($sayfa == $s) {
            echo '<li class="page-item"><a class="page-link">' . $s . '</a></li>';
        } else {
            echo ' <li class="page-item"><a class="page-link" href="veri.php?tur=doviz&tip='.$tip.'&s='.$s.'">'.$s.'</a></li> ';
        }
    }
     
    if($sayfa != $toplamSayfa) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur=doviz&tip='.$tip.'&s='.($sayfa+1).'">Sonraki&gt;</a></li> ';
    if($sayfa != $toplamSayfa) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur=doviz&tip='.$tip.'&s='.$toplamSayfa.'">Son sayfa&gt;&gt;</a></li>';
        
        
        
        ?>
  </ul>
</nav>

                        </div>
                    </div>
                </div>
                <?php }  
                elseif($_GET['tur'] == 'altin'){?> 
                    <div class="container">
                       <div class="row">
                           <div class="col-sm">
                           <select class="select-css" class="select-css" onchange="if (this.value) window.location.href=this.value">
                               <option value="">Seçiniz</option>
                           <?php 
                           $tip = $_GET["tip"];
                           $doviztablo = $db->query("SELECT * FROM
                           (SELECT *  FROM altin WHERE kategori IN (1,2,3,4,5,6,7,8,9) ORDER BY id DESC LIMIT 9) AS T inner join altinkategori as ikinci on T.kategori = ikinci.kategorino", PDO::FETCH_ASSOC);
                                   if ( $doviztablo->rowCount() ){
                                       foreach( $doviztablo as $doviztabloa ){ ?>
                           
                               <option value="veri.php?tur=<?php echo $_GET['tur']; ?>&tip=<?php echo $doviztabloa['kategori']; ?>" <?php if($tip == $doviztabloa['kategori']){echo "selected";}else{} ?>><?php echo $doviztabloa['cinsi'];?></option>
                            <?php }} ?></select>
                            <table class="table table-hover">
                               <thead>
                                   <tr>
                                   <th scope="col">İd</th>
                                   <th scope="col">Alış</th>
                                   <th scope="col">Satış</th>
                                   <th scope="col">Tarih</th>
                                   <th scope="col">Sil</th>
                                   </tr>
                               </thead>
                               <tbody>
                            <?php
            if(empty($_GET["s"])){
               $_GET["s"] = 1;
           }else {}
     $toplamVeri = $db->query("SELECT COUNT(*) FROM altin where kategori = $tip")->fetchColumn();
     $goster = 100;
     $toplamSayfa = ceil($toplamVeri / $goster);
     $sayfa = $_GET["s"];
     if($sayfa < 1) $sayfa = 1; 
     if($sayfa > $toplamSayfa)
     {
         $sayfa = (int)$toplamSayfa;
     }
     $limit = ($sayfa - 1) * $goster;
   
     $veriler = $db->prepare("SELECT * FROM `altin` where kategori = $tip ORDER BY id DESC LIMIT :basla, :bitir");
     $veriler->bindValue(":basla",$limit,PDO::PARAM_INT);
     $veriler->bindValue(":bitir",$goster,PDO::PARAM_INT);
     $veriler->execute();
     $dizi = $veriler->fetchAll(PDO::FETCH_OBJ);
     foreach ($dizi as $item) {
           ?>
         <tr>
               <th class="w-25"><?php echo $item->id;?></th>
               <td scope="row"><?php echo $item->alis;?></td>
               <td scope="row"><?php echo $item->satis;?></td>
               <td aligin="center"><?php echo $item->tarih;?> </td>
               <td aligin="center"><a href="veri.php?tur=<?php echo $_GET['tur']; ?>&tip=<?php echo $_GET['tip']; ?>&s=<?php echo $_GET["s"];?>&sil=<?php echo $item->id;?>"><button type="button" class="btn btn-danger btn-sm">Sil</button></a> </td>
           </tr>
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
        
       if($sayfa != 1) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'">İlk Sayfa</a></li> ';
       if($sayfa != 1) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'&s='.($sayfa-1).'">&lt;Önceki</a></li> ';
        
       for($s = $sol_sayfalar; $s <= $sag_sayfalar; $s++) {
           if($sayfa == $s) {
               echo '<li class="page-item"><a class="page-link">' . $s . '</a></li>';
           } else {
               echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'&s='.$s.'">'.$s.'</a></li> ';
           }
       }
        
       if($sayfa != $toplamSayfa) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'&s='.($sayfa+1).'">Sonraki&gt;</a></li> ';
       if($sayfa != $toplamSayfa) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'&s='.$toplamSayfa.'">Son sayfa&gt;&gt;</a></li>';
           
           
           
           ?>
     </ul>
   </nav>
   
                           </div>
                       </div>
                   </div>
                   <?php
                }
                elseif($_GET['tur'] == 'kripto'){?> 
                    <div class="container">
                       <div class="row">
                           <div class="col-sm">
                           <select class="select-css" class="select-css" onchange="if (this.value) window.location.href=this.value">
                               <option value="">Seçiniz</option>
                           <?php 
                           $tip = $_GET["tip"];
                           $doviztablo = $db->query("SELECT * FROM
                           (SELECT *  FROM kripto WHERE kategori IN (1,2,3,4,5,6,7,8,9,10) ORDER BY id DESC LIMIT 10) AS T inner join kriptokategori as ikinci on T.kategori = ikinci.kategorino", PDO::FETCH_ASSOC);
                                   if ( $doviztablo->rowCount() ){
                                       foreach( $doviztablo as $doviztabloa ){ ?>
                           
                               <option value="veri.php?tur=<?php echo $_GET['tur']; ?>&tip=<?php echo $doviztabloa['kategori']; ?>" <?php if($tip == $doviztabloa['kategori']){echo "selected";}else{} ?>><?php echo $doviztabloa['cinsi'];?></option>
                            <?php }} ?></select>
                            <table class="table table-hover">
                               <thead>
                                   <tr>
                                   <th scope="col">İd</th>
                                   <th scope="col">Satış</th>
                                   <th scope="col">Tarih</th>
                                   <th scope="col">Sil</th>
                                   </tr>
                               </thead>
                               <tbody>
                            <?php
            if(empty($_GET["s"])){
               $_GET["s"] = 1;
           }else {}
     $toplamVeri = $db->query("SELECT COUNT(*) FROM kripto where kategori = $tip")->fetchColumn();
     $goster = 100;
     $toplamSayfa = ceil($toplamVeri / $goster);
     $sayfa = $_GET["s"];
     if($sayfa < 1) $sayfa = 1; 
     if($sayfa > $toplamSayfa)
     {
         $sayfa = (int)$toplamSayfa;
     }
     $limit = ($sayfa - 1) * $goster;
   
     $veriler = $db->prepare("SELECT * FROM `kripto` where kategori = $tip ORDER BY id DESC LIMIT :basla, :bitir");
     $veriler->bindValue(":basla",$limit,PDO::PARAM_INT);
     $veriler->bindValue(":bitir",$goster,PDO::PARAM_INT);
     $veriler->execute();
     $dizi = $veriler->fetchAll(PDO::FETCH_OBJ);
     foreach ($dizi as $item) {
           ?>
         <tr>
               <th class="w-25"><?php echo $item->id;?></th>
               <td scope="row"><?php echo $item->satis;?></td>
               <td aligin="center"><?php echo $item->tarih;?> </td>
               <td aligin="center"><a href="veri.php?tur=<?php echo $_GET['tur']; ?>&tip=<?php echo $_GET['tip']; ?>&s=<?php echo $_GET["s"];?>&sil=<?php echo $item->id;?>"><button type="button" class="btn btn-danger btn-sm">Sil</button></a></td>
           </tr>
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
        
       if($sayfa != 1) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'">İlk Sayfa</a></li> ';
       if($sayfa != 1) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'&s='.($sayfa-1).'">&lt;Önceki</a></li> ';
        
       for($s = $sol_sayfalar; $s <= $sag_sayfalar; $s++) {
           if($sayfa == $s) {
               echo '<li class="page-item"><a class="page-link">' . $s . '</a></li>';
           } else {
               echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'&s='.$s.'">'.$s.'</a></li> ';
           }
       }
        
       if($sayfa != $toplamSayfa) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'&s='.($sayfa+1).'">Sonraki&gt;</a></li> ';
       if($sayfa != $toplamSayfa) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'&s='.$toplamSayfa.'">Son sayfa&gt;&gt;</a></li>';
           ?>
     </ul>
   </nav>
   
                           </div>
                       </div>
                   </div>
                   <?php
                }
                elseif($_GET['tur'] == 'borsa'){?> 
                    <div class="container">
                       <div class="row">
                           <div class="col-sm">
                           <select class="select-css" onchange="if (this.value) window.location.href=this.value">
                               <option value="">Seçiniz</option>
                           <?php 
                           $tip = $_GET["tip"]; ?>
                               <option value="veri.php?tur=<?php echo $_GET['tur']; ?>&tip=1" <?php if($tip == 1){echo "selected";}else{} ?>>Borsa </option>
                            </select>
                            <table class="table table-hover">
                               <thead>
                                   <tr>
                                   <th scope="col">İd</th>
                                   <th scope="col">Satış</th>
                                   <th scope="col">Tarih</th>
                                   <th scope="col">Sil</th>
                                   </tr>
                               </thead>
                               <tbody>
                            <?php
            if(empty($_GET["s"])){
               $_GET["s"] = 1;
           }else {}
     $toplamVeri = $db->query("SELECT COUNT(*) FROM borsa where kategori = $tip")->fetchColumn();
     $goster = 100;
     $toplamSayfa = ceil($toplamVeri / $goster);
     $sayfa = $_GET["s"];
     if($sayfa < 1) $sayfa = 1; 
     if($sayfa > $toplamSayfa)
     {
         $sayfa = (int)$toplamSayfa;
     }
     $limit = ($sayfa - 1) * $goster;
   
     $veriler = $db->prepare("SELECT * FROM `borsa` where kategori = $tip ORDER BY id DESC LIMIT :basla, :bitir");
     $veriler->bindValue(":basla",$limit,PDO::PARAM_INT);
     $veriler->bindValue(":bitir",$goster,PDO::PARAM_INT);
     $veriler->execute();
     $dizi = $veriler->fetchAll(PDO::FETCH_OBJ);
     foreach ($dizi as $item) {
           ?>
         <tr>
               <th class="w-25"><?php echo $item->id;?></th>
               <td scope="row"><?php echo $item->satis;?></td>
               <td aligin="center"><?php echo $item->tarih;?> </td>
               <td aligin="center"><a href="veri.php?tur=<?php echo $_GET['tur']; ?>&tip=<?php echo $_GET['tip']; ?>&s=<?php echo $_GET["s"];?>&sil=<?php echo $item->id;?>"><button type="button" class="btn btn-danger btn-sm">Sil</button></a> </td>
           </tr>
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
        
       if($sayfa != 1) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'">İlk Sayfa</a></li> ';
       if($sayfa != 1) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'&s='.($sayfa-1).'">&lt;Önceki</a></li> ';
        
       for($s = $sol_sayfalar; $s <= $sag_sayfalar; $s++) {
           if($sayfa == $s) {
               echo '<li class="page-item"><a class="page-link">' . $s . '</a></li>';
           } else {
               echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'&s='.$s.'">'.$s.'</a></li> ';
           }
       }
        
       if($sayfa != $toplamSayfa) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'&s='.($sayfa+1).'">Sonraki&gt;</a></li> ';
       if($sayfa != $toplamSayfa) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'&s='.$toplamSayfa.'">Son sayfa&gt;&gt;</a></li>';
           ?>
     </ul>
   </nav>
   
                           </div>
                       </div>
                   </div>
                   <?php
                }
                elseif($_GET['tur'] == 'emtia'){?> 
                    <div class="container">
                       <div class="row">
                           <div class="col-sm">
                           <select class="select-css" onchange="if (this.value) window.location.href=this.value">
                               <option value="">Seçiniz</option>
                           <?php 
                           $tip = $_GET["tip"];
                           $doviztablo = $db->query("SELECT * FROM 
                           (SELECT * FROM emtia WHERE kategori IN (1,2,3,4) ORDER BY id DESC LIMIT 4) AS T inner join emtiakategori as ikinci on T.kategori = ikinci.kategorino", PDO::FETCH_ASSOC);
                                   if ( $doviztablo->rowCount() ){
                                       foreach( $doviztablo as $doviztabloa ){ ?>
                           
                               <option value="veri.php?tur=<?php echo $_GET['tur']; ?>&tip=<?php echo $doviztabloa['kategori']; ?>" <?php if($tip == $doviztabloa['kategori']){echo "selected";}else{} ?>><?php echo $doviztabloa['cinsi'];?></option>
                            <?php }} ?></select>
                            <table class="table table-hover">
                               <thead>
                                   <tr>
                                   <th scope="col">İd</th>
                                   <th scope="col">Alış</th>
                                   <th scope="col">Satış</th>
                                   <th scope="col">Tarih</th>
                                   <th scope="col">Sil</th>
                                   </tr>
                               </thead>
                               <tbody>
                            <?php
            if(empty($_GET["s"])){
               $_GET["s"] = 1;
           }else {}
     $toplamVeri = $db->query("SELECT COUNT(*) FROM emtia where kategori = $tip")->fetchColumn();
     $goster = 100;
     $toplamSayfa = ceil($toplamVeri / $goster);
     $sayfa = $_GET["s"];
     if($sayfa < 1) $sayfa = 1; 
     if($sayfa > $toplamSayfa)
     {
         $sayfa = (int)$toplamSayfa;
     }
     $limit = ($sayfa - 1) * $goster;
   
     $veriler = $db->prepare("SELECT * FROM `emtia` where kategori = $tip ORDER BY id DESC LIMIT :basla, :bitir");
     $veriler->bindValue(":basla",$limit,PDO::PARAM_INT);
     $veriler->bindValue(":bitir",$goster,PDO::PARAM_INT);
     $veriler->execute();
     $dizi = $veriler->fetchAll(PDO::FETCH_OBJ);
     foreach ($dizi as $item) {
           ?>
         <tr>
               <th class="w-25"><?php echo $item->id;?></th>
               <td scope="row"><?php echo $item->alis;?></td>
               <td scope="row"><?php echo $item->satis;?></td>
               <td aligin="center"><?php echo $item->tarih;?> </td>
               <td aligin="center"><a href="veri.php?tur=<?php echo $_GET['tur']; ?>&tip=<?php echo $_GET['tip']; ?>&s=<?php echo $_GET["s"];?>&sil=<?php echo $item->id;?>"><button type="button" class="btn btn-danger btn-sm">Sil</button></a> </td>
           </tr>
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
        
       if($sayfa != 1) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'">İlk Sayfa</a></li> ';
       if($sayfa != 1) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'&s='.($sayfa-1).'">&lt;Önceki</a></li> ';
        
       for($s = $sol_sayfalar; $s <= $sag_sayfalar; $s++) {
           if($sayfa == $s) {
               echo '<li class="page-item"><a class="page-link">' . $s . '</a></li>';
           } else {
               echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'&s='.$s.'">'.$s.'</a></li> ';
           }
       }
        
       if($sayfa != $toplamSayfa) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'&s='.($sayfa+1).'">Sonraki&gt;</a></li> ';
       if($sayfa != $toplamSayfa) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'&s='.$toplamSayfa.'">Son sayfa&gt;&gt;</a></li>';
           
           
           
           ?>
     </ul>
   </nav>
   
                           </div>
                       </div>
                   </div>
                   <?php
                //demir
                }
                elseif($_GET['tur'] == 'demir'){?> 
                    <div class="container">
                       <div class="row">
                           <div class="col-sm">
                           <select class="select-css" onchange="if (this.value) window.location.href=this.value">
                               <option value="">Seçiniz</option>
                           <?php 
                           $tip = $_GET["tip"];
                           $doviztablo = $db->query("SELECT * FROM `demirkategori`", PDO::FETCH_ASSOC);
                                   if ( $doviztablo->rowCount() ){
                                       foreach( $doviztablo as $doviztabloa ){ ?>
                           
                               <option value="veri.php?tur=<?php echo $_GET['tur']; ?>&tip=<?php echo $doviztabloa['kategori']; ?>" <?php if($tip == $doviztabloa['kategori']){echo "selected";}else{} ?>><?php echo $doviztabloa['adi'];?></option>
                            <?php }} ?></select>
                            <table class="table table-hover">
                               <thead>
                                   <tr>
                                   <th scope="col">İd</th>
                                   <th scope="col">Ø8</th>
                                   <th scope="col">Ø10</th>
                                   <th scope="col">Ø32</th>
                                   <th scope="col">Tarih</th>
                                   <th scope="col">Sil</th>
                                   </tr>
                               </thead>
                               <tbody>
                            <?php
            if(empty($_GET["s"])){
               $_GET["s"] = 1;
           }else {}
     $toplamVeri = $db->query("SELECT COUNT(*) FROM demir where kategori = $tip")->fetchColumn();
     $goster = 100;
     $toplamSayfa = ceil($toplamVeri / $goster);
     $sayfa = $_GET["s"];
     if($sayfa < 1) $sayfa = 1; 
     if($sayfa > $toplamSayfa)
     {
         $sayfa = (int)$toplamSayfa;
     }
     $limit = ($sayfa - 1) * $goster;
   
     $veriler = $db->prepare("SELECT * FROM `demir` where kategori = $tip ORDER BY id DESC LIMIT :basla, :bitir");
     $veriler->bindValue(":basla",$limit,PDO::PARAM_INT);
     $veriler->bindValue(":bitir",$goster,PDO::PARAM_INT);
     $veriler->execute();
     $dizi = $veriler->fetchAll(PDO::FETCH_OBJ);
     foreach ($dizi as $item) {
           ?>
         <tr>
               <th class="w-25"><?php echo $item->id;?></th>
                                   <th scope="row"><?php echo $item->sekizlik;?></th>
                                   <th scope="row"><?php echo $item->onluk;?></th>
                                   <th scope="row"><?php echo $item->satis;?></th>
               <td aligin="center"><?php echo $item->tarih;?> </td>
               <td aligin="center"><a href="veri.php?tur=<?php echo $_GET['tur']; ?>&tip=<?php echo $_GET['tip']; ?>&s=<?php echo $_GET["s"];?>&sil=<?php echo $item->id;?>"><button type="button" class="btn btn-danger btn-sm">Sil</button></a> </td>
           </tr>
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
        
       if($sayfa != 1) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'">İlk Sayfa</a></li> ';
       if($sayfa != 1) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'&s='.($sayfa-1).'">&lt;Önceki</a></li> ';
        
       for($s = $sol_sayfalar; $s <= $sag_sayfalar; $s++) {
           if($sayfa == $s) {
               echo '<li class="page-item"><a class="page-link">' . $s . '</a></li>';
           } else {
               echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'&s='.$s.'">'.$s.'</a></li> ';
           }
       }
        
       if($sayfa != $toplamSayfa) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'&s='.($sayfa+1).'">Sonraki&gt;</a></li> ';
       if($sayfa != $toplamSayfa) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'&s='.$toplamSayfa.'">Son sayfa&gt;&gt;</a></li>';
           
           
           
           ?>
     </ul>
   </nav>
   
                           </div>
                       </div>
                   </div>
                   <?php
                //demirson

                }
                elseif($_GET['tur'] == 'faiz'){
                    ?> 
                    <div class="container">
                       <div class="row">
                           <div class="col-sm">
                           <select class="select-css" onchange="if (this.value) window.location.href=this.value">
                               <option value="">Seçiniz</option>
                           <?php 
                           $tip = $_GET["tip"]; ?>
                               <option value="veri.php?tur=<?php echo $_GET['tur']; ?>&tip=1" <?php if($tip == 1){echo "selected";}else{} ?>>Faiz </option>
                            </select>
                            <table class="table table-hover">
                               <thead>
                                   <tr>
                                   <th scope="col">İd</th>
                                   <th scope="col">Satış</th>
                                   <th scope="col">Tarih</th>
                                   <th scope="col">Sil</th>
                                   </tr>
                               </thead>
                               <tbody>
                            <?php
            if(empty($_GET["s"])){
               $_GET["s"] = 1;
           }else {}
     $toplamVeri = $db->query("SELECT COUNT(*) FROM faiz ")->fetchColumn();
     $goster = 100;
     $toplamSayfa = ceil($toplamVeri / $goster);
     $sayfa = $_GET["s"];
     if($sayfa < 1) $sayfa = 1; 
     if($sayfa > $toplamSayfa)
     {
         $sayfa = (int)$toplamSayfa;
     }
     $limit = ($sayfa - 1) * $goster;
   
     $veriler = $db->prepare("SELECT * FROM `faiz`  ORDER BY id DESC LIMIT :basla, :bitir");
     $veriler->bindValue(":basla",$limit,PDO::PARAM_INT);
     $veriler->bindValue(":bitir",$goster,PDO::PARAM_INT);
     $veriler->execute();
     $dizi = $veriler->fetchAll(PDO::FETCH_OBJ);
     foreach ($dizi as $item) {
           ?>
         <tr>
               <th class="w-25"><?php echo $item->id;?></th>
               <td scope="row"><?php echo $item->satis;?></td>
               <td aligin="center"><?php echo $item->tarih;?> </td>
               <td aligin="center"><a href="veri.php?tur=<?php echo $_GET['tur']; ?>&tip=<?php echo $_GET['tip']; ?>&s=<?php echo $_GET["s"];?>&sil=<?php echo $item->id;?>"><button type="button" class="btn btn-danger btn-sm">Sil</button></a></td>
           </tr>
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
        
       if($sayfa != 1) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'">İlk Sayfa</a></li> ';
       if($sayfa != 1) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'&s='.($sayfa-1).'">&lt;Önceki</a></li> ';
        
       for($s = $sol_sayfalar; $s <= $sag_sayfalar; $s++) {
           if($sayfa == $s) {
               echo '<li class="page-item"><a class="page-link">' . $s . '</a></li>';
           } else {
               echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'&s='.$s.'">'.$s.'</a></li> ';
           }
       }
        
       if($sayfa != $toplamSayfa) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'&s='.($sayfa+1).'">Sonraki&gt;</a></li> ';
       if($sayfa != $toplamSayfa) echo ' <li class="page-item"><a class="page-link" href="veri.php?tur='.$_GET['tur'].'&tip='.$tip.'&s='.$toplamSayfa.'">Son sayfa&gt;&gt;</a></li>';
           ?>
     </ul>
   </nav>
   
                           </div>
                       </div>
                   </div>
                   <?php
                }
                
                ?>
     </div>
    </div>
   </div>
  </div>
   </body>
</html>
<?php
}
?>
