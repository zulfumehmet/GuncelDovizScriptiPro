<?php
$gelen_seo=$_GET["seo"];
$gelen_id=$_GET["id"];
$sayfaadi= "haberler";
include ("db.php");

if (preg_match("/[\-]{2,}|[;]|[']|[\\\*]/", $gelen_seo)){ header("Location:404.html");} else{}
if (preg_match("/[\-]{2,}|[;]|[']|[\\\*]/", $gelen_id)){ header("Location:404.html");} else{}

$query = $db->query("SELECT * FROM haberler WHERE seo = '$gelen_seo'  AND id = '$gelen_id'", PDO::FETCH_ASSOC);
if ( $query->rowCount() ){
     foreach( $query as $row ){
               }
}

$kategoriad = $db->query("SELECT 
                        haberler.kategori, 
                        kategori.kategorino, 
                        kategori.kategoriyadi,
                        kategori.kateseo
                    FROM haberler 
                    INNER JOIN kategori ON haberler.kategori = kategori.kategorino 
                    WHERE haberler.id = $gelen_id", PDO::FETCH_ASSOC);
if ( $kategoriad->rowCount() ){
     foreach( $kategoriad as $katea ){
               }
}
if(isset($row['baslik'])){}else{header("Location:404.html");}
$baslik = $row['baslik'];
$resim = $row['resim'];
$urlal = ''.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$ogtitle = '<meta property="og:title" content="'. $baslik .'">
    <meta property="og:image" content="haberler/'. $resim . '" />
    <meta property="og:url" content="'. $urlal .'" />
    ';

include ("header.php");

?>
<!-- Google Yapısal Veri İşaretleme Yardımcısı tarafından oluşturulan JSON-LD işaretlemesi. -->
<script type="application/ld+json">{"@context" : "http://schema.org", "@type" : "Article", "name" : "<?php print $row['baslik']; ?>",  "author" : { "@type" : "Person", "name" : "<?php print $row['ekleyen']; ?>"}, "datePublished" : "<?php  echo date_format(date_create($row['tarih']), 'd.m.y'); ?>","image" : "https://<?php echo $_SERVER['SERVER_NAME'];?>/haberler/<?php print $row['resim']; ?>",  "articleSection" : "<?php print $row['icerik']; ?>"}</script>

	<section class="bg0 p-b-10 p-t-10">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-10 col-lg-8 p-b-10">
					<div class="p-r-10 p-r-0-sr991">
						<!-- Blog Detail -->
                        <div class="container">
                                <div class="flex-c-c p-t-5  p-b-5">
                                    <div class="p-t-10 p-b-10" style="width:100%;margin:auto;text-align:center;float:none;display:scroll;">
                                          <?php echo $reklamkod["haberbanner"]; ?>
                                    </div>
                                
                                </div>
                            </div>
						<div itemscope itemtype="http://schema.org/Article" class="p-b-70">
						     <a href="haberler.html" class="f1-s-10 cl2 hov-cl10 trans-03 text-uppercase">
							Haberler
							</a> <i class="fas fa-angle-right"></i> 
							<a href="habers-<?php echo $katea["kateseo"];?>.html" class="f1-s-10 cl2 hov-cl10 trans-03 text-uppercase"> <?php echo $katea["kategoriyadi"]; ?>
							</a> <i class="fas fa-angle-right"></i> <?php print $row['baslik']; ?>
							<h3 itemprop="headline name" class="f1-l-3 cl2 p-b-16 p-t-33 respon2">
								<?php print $row['baslik']; ?>
							</h3>
							
							<div class="flex-wr-s-s p-b-40">
								<span itemprop="author" itemscope itemtype="http://schema.org/Person" class="f1-s-3 cl8 m-r-15" >
									<a span itemprop="name" href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
										<?php print $row['ekleyen']; ?>
									</a>

									<span class="m-rl-3">-</span>

									<span itemprop="datePublished" content="<?php  echo date_format(date_create($row['tarih']), 'd.m.y'); ?>">
										<?php  echo date_format(date_create($row['tarih']), 'd.m.y'); ?>
									</span>
								</span>
							</div>

							<div class="wrap-pic-max-w p-b-30">
								<img itemprop="image" src="haberler/<?php print $row['resim']; ?>" alt="<?php print $row['baslik']; ?>">
							</div>

							<div itemprop="articleSection" class="haber">
								<?php print $row['icerik']; ?>
							</div>

							<!-- Tag -->
							<div class="flex-s-s p-t-12 p-b-15">
								<span class="f1-s-12 cl5 m-r-8">
									Etiket:
								</span>
								
								<div class="flex-wr-s-s size-w-0">
								    <?php 
        $metin=  $row['etiket'];
            $yenimetin = explode(',',$metin);
            foreach($yenimetin as $yazdir){
            echo '<a href="etiket-'.tr_karakterhaber($yazdir).'.html" class="f1-s-12 cl8 hov-link1 m-r-15">'.$yazdir.'</a>';
                    }
        
        ?> 
								    
									

								</div>
				</div>
						</div>

						<!-- Leave a comment -->
						<div>
							<h4 class="f1-l-4 cl3 p-b-12">
								Yorumlar
							</h4>
							<?php echo $genela["yorum"];?>
							<!-- Life Style  -->
							<div class="p-b-25 m-r--10 m-r-0-sr991">
							<div class="how2 how2-cl5 flex-s-c m-r-10 m-r-0-sr991">
								<h3 class="f1-m-2 cl17 tab01-title">
								YENİ HABERLER
								</h3>
							</div>

							<div class="row p-t-35">
								<div class="col-sm-6 p-r-25 p-r-15-sr991">
								   <?php 
						 $dovizalti = $db->query("SELECT * FROM haberler  ORDER BY id DESC LIMIT 4", PDO::FETCH_ASSOC);
                                        if ( $dovizalti->rowCount() ){
                                             foreach( $dovizalti as $dovizalt ){
                                                 ?>
                                    <!-- Item post -->  
                                    <div class="flex-wr-sb-s m-b-30">
                                        <a href="haber-<?php echo $dovizalt["seo"]; ?>-<?php echo $dovizalt["ID"]; ?>.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                            <img src="haberler/<?php echo $dovizalt["resim"]; ?>" alt="IMG">
                                        </a>

                                        <div class="size-w-2">
                                            <h5 class="p-b-5">
                                                <a href="haber-<?php echo $dovizalt["seo"]; ?>-<?php echo $dovizalt["ID"]; ?>.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                    <?php echo mb_substr($dovizalt["baslik"], 0, 50, 'UTF-8'); ?>
                                                </a>
                                            </h5>

                                            <span class="cl8">
                                                <a href="haber-<?php echo $dovizalt["seo"]; ?>-<?php echo $dovizalt["ID"]; ?>.html" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                Tarih
                                                </a>

                                                <span class="f1-s-3 m-rl-3">
                                                -   
                                                </span>

                                                <span class="f1-s-3">
                                                    <?php  echo date_format(date_create($dovizalt['tarih']), 'd.m.y'); ?>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <?php }
      }
            ?>
								</div>

								<div class="col-sm-6 p-r-25 p-r-15-sr991">
								<?php
                            $dovizaltyaniyan = $db->query("SELECT * FROM haberler  ORDER BY id DESC LIMIT 4,4", PDO::FETCH_ASSOC);
                            if ( $dovizaltyaniyan->rowCount() ){
                                 foreach( $dovizaltyaniyan as $dovizaltyan ){
                                     ?>
                                        <!-- Item post -->  
                                    <div class="flex-wr-sb-s m-b-30">
                                        <a href="haber-<?php echo $dovizaltyan["seo"]; ?>-<?php echo $dovizaltyan["ID"]; ?>.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                            <img src="haberler/<?php echo $dovizaltyan["resim"]; ?>" alt="IMG">
                                        </a>

                                        <div class="size-w-2">
                                            <h5 class="p-b-5">
                                                <a href="haber-<?php echo $dovizaltyan["seo"]; ?>-<?php echo $dovizaltyan["ID"]; ?>.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                    <?php echo mb_substr($dovizaltyan["baslik"], 0, 50, 'UTF-8'); ?>
                                                </a>
                                            </h5>

                                            <span class="cl8">
                                                <a href="haber-<?php echo $dovizaltyan["seo"]; ?>-<?php echo $dovizaltyan["ID"]; ?>.html" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                Tarih
                                                </a>

                                                <span class="f1-s-3 m-rl-3">
                                                -   
                                                </span>

                                                <span class="f1-s-3">
                                                    <?php  echo date_format(date_create($dovizaltyan['tarih']), 'd.m.y'); ?>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <?php }
      }
            ?>
								</div>
							</div>
						</div>
						</div>
					</div>
				</div>
				
				<!-- Sidebar -->
				<?php include("habersol.php");?>
			</div>
		</div>
	</section>
<?php include ("footer.php"); ?>
	