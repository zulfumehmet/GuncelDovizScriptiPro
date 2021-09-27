<?php
include ("db.php");
$sayfaadi= "haberler";
$seo = $_GET["seo"];
$link = $seo. "-";
switch ($seo) {
case "ekonomi":
    $gelen_kategori = 1;
    break;
case "doviz":
    $gelen_kategori = 2;
    break;
case "altin":
    $gelen_kategori = 3;
    break;
case "kriptopara":
    $gelen_kategori = 4;
    break;
case "borsa":
    $gelen_kategori = 5;
    break;    
case "emtia":
    $gelen_kategori = 6;
    break;
default:
   header("Location:404.html");
}
    
    $kategoriad = $db->prepare("SELECT haberler.kategori, kategori.kategorino, kategori.kategoriyadi FROM haberler INNER JOIN kategori ON haberler.kategori = kategori.kategorino WHERE kategori = $gelen_kategori");
    $kategoriad->bindParam(1, $sira, PDO::PARAM_INT);
    $kategoriad->execute();
    $katea = $kategoriad->fetch(PDO::FETCH_ASSOC);

$kategori_adi = $katea["kategoriyadi"];

$urlal = ''.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$ogtitle = '<meta property="og:title" content="Güncel '. $kategori_adi . ' haberleri '. $site_adi . ' adresinde">
    <meta property="og:image" content="/images/icons/iconp.png" />
    <meta property="og:url" content="'. $urlal .'" />
    ';
include ("header.php");



?>

	<!-- Page heading -->
		<div class="container">
                                <div class="flex-c-c p-t-5 p-b-5">
                                    <div class="p-t-10 p-b-10" style="width:100%;margin:auto;text-align:center;float:none;display:scroll;">
                                          <?php echo $reklamkod["haberbanner"]; ?>
                                    </div>
                                </div>
                            </div>
	
	<!-- Post -->
	<section class="bg0 p-b-55">
		<div class="container">
		    <div class="row justify-content-center">
				<div class="col-md-10 col-lg-8 p-b-10">
					<div class="p-r-10 p-r-0-sr991">
						<div class="m-t-00 p-b-40">
						    <div class="row">
					<div class="how2 how2-cl7 flex-s-c m-r-10 m-r-0-sr991" style="width: 100%;">
                        <h3 class="f1-m-2 cl3 tab01-title">
                          <?php echo $katea["kategoriyadi"]; ?>
                        </h3>
                    </div></div>
						    <?php
							if(empty($_GET["s"])){
								$_GET["s"] = 1;
							}else {}
    $toplamVeri = $db->query("SELECT COUNT(*) FROM haberler WHERE kategori = $gelen_kategori")->fetchColumn();
	$goster = 10;
	$toplamSayfa = ceil($toplamVeri / $goster);
	$sayfa = $_GET["s"]; 
	if($sayfa > $toplamSayfa)
	{
		$sayfa = (int)$toplamSayfa;
	}
	$limit = ($sayfa - 1) * $goster;

	$veriler = $db->prepare("SELECT * FROM haberler WHERE kategori = $gelen_kategori ORDER BY ID DESC LIMIT :basla, :bitir");
	$veriler->bindValue(":basla",$limit,PDO::PARAM_INT);
	$veriler->bindValue(":bitir",$goster,PDO::PARAM_INT);
	$veriler->execute();
	$dizi = $veriler->fetchAll(PDO::FETCH_OBJ);
	foreach ($dizi as $item) {
		?>
							<!-- Item post -->
							<div class="flex-wr-sb-s p-t-40 p-b-15 how-bor2">
								<a href="haber-<?php echo $item->seo.'-'.$item->ID; ?>.html" class="size-w-8 wrap-pic-w hov1 trans-03 w-full-sr575 m-b-25">
									<img src="haberler/<?php echo $item->resim;?>" alt="<?php echo $item->baslik;?>">
								</a>

								<div class="size-w-9 w-full-sr575 m-b-25">
									<h5 class="p-b-12">
										<a href="haber-<?php echo $item->seo.'-'.$item->ID; ?>.html" class="f1-l-1 cl2 hov-cl10 trans-03 respon2">
											<?php echo mb_substr($item->baslik, 0, 50, 'utf-8'); ?>
										</a>
									</h5>

									<div class="cl8 p-b-18">
										<a  href="haber-<?php echo $item->seo.'-'.$item->ID; ?>.html" class="f1-s-4 cl8 hov-cl10 trans-03">
											<span><?php echo $item->ekleyen;?></span>
										</a>
										<span class="f1-s-3 m-rl-3"> - </span>

										<span class="f1-s-3"><?php  echo date_format(date_create($item->tarih), 'd.m.y'); ?></span>
									</div>

									<p class="f1-s-1 cl6 p-b-24">
										<?php echo mb_substr($item->icerik, 0, 100, 'utf-8'); ?>
									</p>

									<a href="haber-<?php echo $item->seo.'-'.$item->ID; ?>.html" class="f1-s-1 cl9 hov-cl10 trans-03">
										Devamı
										<i class="m-l-2 fa fa-long-arrow-alt-right"></i>
									</a>
								</div>
							</div>
<?php
	}
	?>
						</div>

						<div class="flex-wr-c-c m-rl--7 p-t-15">
						<?php 
        
						    $sayfa_goster = 15;
						
							$en_az_orta = ceil($sayfa_goster/2);
							$en_fazla_orta = ($toplamSayfa+1) - $en_az_orta;
							
							$sayfa_orta = $sayfa;
							if($sayfa_orta < $en_az_orta) $sayfa_orta = $en_az_orta;
							if($sayfa_orta > $en_fazla_orta) $sayfa_orta = $en_fazla_orta;
							
							$sol_sayfalar = round($sayfa_orta - (($sayfa_goster-1) / 2));
							$sag_sayfalar = round((($sayfa_goster-1) / 2) + $sayfa_orta); 
							
							if($sol_sayfalar < 1) $sol_sayfalar = 1;
							if($sag_sayfalar > $toplamSayfa) $sag_sayfalar = $toplamSayfa;
							
							if($sayfa != 1) echo ' <a class="flex-c-c pagi-item hov-btn1 trans-03 m-all-7 pagi-"  href="haberl-'.$link.'1.html"><i class="fas fa-angle-double-left"></i></a> ';
							if($sayfa != 1) echo ' <a class="flex-c-c pagi-item hov-btn1 trans-03 m-all-7 pagi-" href="haberl-'.$link.''.($sayfa-1).'.html"><i class="fas fa-chevron-left"></i></a> ';
							
							for($s = $sol_sayfalar; $s <= $sag_sayfalar; $s++) {
								if($sayfa == $s) {
									echo '<a class="flex-c-c pagi-item hov-btn1 trans-03 m-all-7 pagi-active">' . $s . '</a>';
								} else {
									echo '<a class="flex-c-c pagi-item hov-btn1 trans-03 m-all-7 pagi-" href="haberl-'.$link.''.$s.'.html">'.$s.'</a> ';
								}
							}
							
							if($sayfa != $toplamSayfa) echo ' <a class="flex-c-c pagi-item hov-btn1 trans-03 m-all-7 pagi-" href="haberl-'.$link.''.($sayfa+1).'.html"><i class="fas fa-chevron-right"></i></a> ';
							if($sayfa != $toplamSayfa) echo ' <a class="flex-c-c pagi-item hov-btn1 trans-03 m-all-7 pagi-"href="haberl-'.$link.''.$toplamSayfa.'.html"><i class="fas fa-angle-double-right"></i></a>';
        				?>



                        </div>
					</div>
				</div>

				<?php include("habersol.php");?>
			</div>
		</div>
	</section>

	<?php include ("footer.php"); ?>