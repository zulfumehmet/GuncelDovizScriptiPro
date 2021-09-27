<?php
include ("db.php");
$urlal = '//'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$sayfaadi= $_GET["tur"];
switch ($sayfaadi) {
case "doviz":
    $ogtitle = '<meta property="og:title" content="Güncel döviz, ABD Dolar, Euro, İngiliz Sterlin, Kanada Doları, İsviçre Frangı ve daha bir çoğu piyasaci.net adresinde">
    <meta property="og:image" content="/images/icons/iconp.png" />
    <meta property="og:url" content="'. $urlal .'" />';
    $ubaslik="SERBEST PİYASA DÖVİZ KURLARI";
    $baslik="DÖVİZ";
    $renk = "how2-cl5";
    $doviztablo = $db->query("SELECT * FROM
                            (SELECT * FROM doviz WHERE kategori IN (1,2,3,4,5,6,7,8,9,10,11,12,13) ORDER BY id DESC LIMIT 13) AS T inner join kategoridoviz as ikinci on T.kategori = ikinci.kategorino ORDER BY kategorino ASC ", PDO::FETCH_ASSOC);
    $simge = "bayrak";
    $birim = "birim";
    break;
case "altin":
    $ogtitle = '<meta property="og:title" content="Güncel altın, ons, çeyrek altın, gram altın, reşat altını, bilezik, tam altın, cumguriyet altını piyasaci.net adresinde">
    <meta property="og:image" content="/images/icons/iconp.png" />
    <meta property="og:url" content="'. $urlal .'" />';
    $ubaslik="GÜNCEL ALTIN FİYATLARI";
    $baslik="ALTIN";
    $renk = "how2-cl3";
    $doviztablo = $db->query("SELECT * FROM
                            (SELECT *  FROM altin WHERE kategori IN (1,2,3,4,5,6,7,8,9) ORDER BY id DESC LIMIT 9) AS T inner join altinkategori as ikinci on T.kategori = ikinci.kategorino ORDER BY kategorino ASC", PDO::FETCH_ASSOC);
   $simge = "simge";
    break;
case "kripto":
    $ogtitle = '<meta property="og:title" content="Güncel kripto paralar, Bitcoin ve diğerleri piyasaci.net adresinde">
    <meta property="og:image" content="/images/icons/iconp.png" />
    <meta property="og:url" content="'. $urlal .'" />';
    $ubaslik="KRİPTO BORSASI";
    $baslik="KRİPTO PARALAR";
    $renk = "how2-cl4";
    $doviztablo = $db->query("SELECT * FROM
                            (SELECT *  FROM kripto WHERE kategori IN (1,2,3,4,5,6,7,8,9,10) ORDER BY id DESC LIMIT 10) AS T inner join kriptokategori as ikinci on T.kategori = ikinci.kategorino ORDER BY kategorino ASC", PDO::FETCH_ASSOC);
   $simge = "simge";
    break;
case "borsa":
    $ogtitle = '<meta property="og:title" content="Güncel Borsa İstanbul 100 endeksi piyasaci.net adresinde">
    <meta property="og:image" content="/images/icons/iconp.png" />
    <meta property="og:url" content="'. $urlal .'" />';
    $ubaslik="BORSA BİLGİLERİ";
    $baslik="BORSA";
    $renk = "how2-cl5";
    break;
case "emtia":
    $ogtitle = '<meta property="og:title" content="Güncel Brent Petolü, gümüş ve diğer emtiya değerleri piyasaci.net adresinde">
    <meta property="og:image" content="/images/icons/iconp.png" />
    <meta property="og:url" content="'. $urlal .'" />';
    $ubaslik="GÜNCEL EMTİA FİYATLARI";
    $baslik="EMTİYALAR";
    $renk = "how2-cl6";
    $doviztablo = $db->query("SELECT * FROM 
                            (SELECT * FROM emtia WHERE kategori IN (1,2,3,4) ORDER BY id DESC LIMIT 4) AS T inner join emtiakategori as ikinci on T.kategori = ikinci.kategorino", PDO::FETCH_ASSOC);
    $simge = "simge";
    break;
 case "demir":
    $ogtitle = '<meta property="og:title" content="Güncel inşaat demir fiyatları piyasaci.net adresinde">
    <meta property="og:image" content="/images/icons/iconp.png" />
    <meta property="og:url" content="'. $urlal .'" />';
    $ubaslik="GÜNCEL DEMİR FİYATLARI";
    $baslik="EKONOMİ";
    $renk = "how2-cl6";
    $doviztablo = $db->query("SELECT * FROM (SELECT * FROM demir WHERE kategori IN (1,2,3,4,5,6,7,8,9,10,11,12,13) ORDER BY id DESC LIMIT 13) AS T inner join demirkategori as ikinci on T.kategori = ikinci.kategori", PDO::FETCH_ASSOC);
    $simge = "simge";
    break;
default:
   header("Location:404.html");
}
include ("header.php");
?>
<?php $dovizbaslik = $db->prepare("SELECT * FROM `doviz` ORDER BY id DESC");
    $dovizbaslik->bindParam(1, $sira, PDO::PARAM_INT);
    $dovizbaslik->execute();
    $dovizb = $dovizbaslik->fetch(PDO::FETCH_ASSOC);
?>
	<!-- Content -->
	<section class="bg0 p-b-4 p-t-10">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-10 col-lg-8 p-b-30">
					<div class="p-r-10 p-r-0-sr991">
						<!-- Blog Detail -->
						<div class="p-t-10 p-b-30">
						<div class="how2 <?php echo $renk; ?> flex-s-c">
								<h3 class="f1-m-2 cl3 tab01-title">
								<?php echo $ubaslik; ?>
								</h3>
							</div>
                            <style>
                            .doviztabloa {
                                color: #007bff;
                                font-weight: bold;
                            }
                            </style>
                            <div class="container">
                                <div class="flex-c-c p-t-5">
                                    <div class="p-t-10 p-b-10" style="width:100%;margin:auto;text-align:center;float:none;display:scroll;">
                                         <?php echo $reklamkod["dovizust"]; ?>
                                    </div>
                                
                                </div>
                            </div>
<p class="p-t-10" style="font-weight: bold;">Son Güncelleme : <?php echo date_format(date_create($dovizb["tarih"]), 'd.m.y H:s');  ?>   </p>
<?php if ($sayfaadi == "kripto"){ ?>
    <table class="table table-borderless table-hover table-striped" style="font-size: 12px;">
    <thead>
      <tr>
        <th scope="col">Adı</th>
        <th scope="col">Satış</th>
        <th scope="col">Piy. Değ.</th>
        <th scope="col">Değişim</th>
      </tr>
    </thead>
    <tbody>

    <?php  if ( $doviztablo->rowCount() ){
        foreach( $doviztablo as $doviztabloa ){ ?>
    <tr>
     <td width="55%"><?php echo $doviztabloa['bayrak']; ?> <a href="detay-<?php echo $sayfaadi; ?>-<?php echo $doviztabloa['seo']; ?>.html" class="doviztabloa"> <?php echo $doviztabloa['simge'] . "<br/>". $doviztabloa['cinsi']; ?></a></td>
      <td width="15%"><?php echo "$" . $doviztabloa['satis']; ?> </td>
      <td width="15%"><?php echo "$". $doviztabloa['deger']; ?> </td>
      <td width="15%" <?php $dvza = $doviztabloa['degisim'];
                    if($dvza == "flat") {
                      echo 'style="text-align: center;"';
                        } else if($dvza== "up") {
                                 echo 'style="color: green; text-align: center;"';
                        } else if($dvza == "down") {
                                echo 'style="color: red; text-align: center;"';
                        } else {
                                echo 'style="text-align: center;"';
                        } ?>>%<?php echo $doviztabloa['yuzde']; ?>  
     </td>
    </tr>  
<?php } }?>
<?php }elseif($sayfaadi == "demir"){ ?>


 <table class="table table-borderless table-hover table-striped" style="font-size: 12px;">
    <thead>
      <tr>
        <th scope="col">Bölge</th>
        <th scope="col">Ø8</th>
        <th scope="col">Ø10</th>
        <th scope="col">Ø12-32</th>
      </tr>
    </thead>
    <tbody>

    <?php  if ( $doviztablo->rowCount() ){
        foreach( $doviztablo as $doviztabloa ){ ?>
    <tr>
     <td><a href="detay-<?php echo $sayfaadi; ?>-<?php echo $doviztabloa['seo']; ?>.html" class="doviztabloa"> <?php echo  $doviztabloa['adi']; ?></a></td>
      <td style="text-align: center;"><?php echo $doviztabloa['sekizlik']; ?> </td>
      <td style="text-align: center;"><?php echo $doviztabloa['onluk']; ?> </td>
      <td style="text-align: center;"><?php echo $doviztabloa['satis']; ?> </td>
    </tr>  
<?php } }
}else

{ ?>
<table class="table table-borderless table-hover table-striped" style="font-size: 12px;">
  <thead>
    <tr>
      <th scope="col">Birim Adı</th>
      <th scope="col" style="text-align: center;">Alış</th>
      <th scope="col"style="text-align: center;">Satış</th>
      <th scope="col"style="text-align: center;">Değişim</th>
    </tr>
  </thead>
  <tbody>
<?php  if ( $doviztablo->rowCount() ){
        foreach( $doviztablo as $doviztabloa ){ ?>
    <tr>
<?php if($sayfaadi == "doviz"){ ?>
    <td width="50%"><?php echo $doviztabloa[$simge]; ?> <a href="detay-<?php echo $sayfaadi; ?>-<?php echo $doviztabloa['seo']; ?>.html" class="doviztabloa"> <?php echo $doviztabloa['kisaisim']; ?><br/><?php echo $doviztabloa['cinsi']; ?></a></td>
      <td width="15%" style="text-align: center;"><?php echo number_format($doviztabloa['alis'], 4, ',', '.'); ?> <?php echo $doviztabloa['birim']; ?></td>
      <td width="15%" style="text-align: center;"><?php echo number_format($doviztabloa['satis'], 4, ',', '.'); ?> <?php echo $doviztabloa['birim']; ?></td>
      <td width="20%" <?php $dvza = $doviztabloa['degisim'];
                    if($dvza == "flat") {
                      echo 'style="text-align: center;"';
                        } else if($dvza== "up") {
                                 echo 'style="color: green; text-align: center;"';
                        } else if($dvza == "down") {
                                echo 'style="color: red; text-align: center;"';
                        } else {
                                echo 'style="text-align: center;"';
                        } ?>>%<?php echo $doviztabloa['yuzde']; ?> </td>
    </tr>  

<?php } elseif($sayfaadi == "altin") {?>
    <td width="50%"><?php echo $doviztabloa[$simge]; ?> <a href="detay-<?php echo $sayfaadi; ?>-<?php echo $doviztabloa['seo']; ?>.html" class="doviztabloa"> <?php echo $doviztabloa['cinsi']; ?> </a></td>
      <td width="15%" style="text-align: center;"><?php echo number_format($doviztabloa['alis'], 2, ',', '.'); ?></td>
      <td width="15%" style="text-align: center;"><?php echo number_format($doviztabloa['satis'], 2, ',', '.'); ?></td>
      <td width="20%" <?php $dvza = $doviztabloa['degisim'];
                    if($dvza == "flat") {
                      echo 'style="text-align: center;"';
                        } else if($dvza== "up") {
                                 echo 'style="color: green; text-align: center;"';
                        } else if($dvza == "down") {
                                echo 'style="color: red; text-align: center;"';
                        } else {
                                echo 'style="text-align: center;"';
                        } ?>>%<?php echo $doviztabloa['yuzde']; ?></td>
    </tr> 

    <?php } elseif($sayfaadi == "emtia") {?>
    <td width="40%"><?php echo $doviztabloa[$simge]; ?> <a href="detay-<?php echo $sayfaadi; ?>-<?php echo $doviztabloa['seo']; ?>.html" class="doviztabloa"> <?php echo $doviztabloa['cinsi']; ?></a></td>
      <td width="20%" style="text-align: center;"><?php echo number_format($doviztabloa['alis'], 2, ',', '.'); ?> <?php echo $doviztabloa['birim']; ?></td>
      <td width="20%" style="text-align: center;"><?php echo number_format($doviztabloa['satis'], 2, ',', '.'); ?> <?php echo $doviztabloa['birim']; ?></td>
      <td width="20%" <?php $dvza = $doviztabloa['degisim'];
                    if($dvza == "flat") {
                      echo 'style="text-align: center;"';
                        } else if($dvza== "up") {
                                 echo 'style="color: green; text-align: center;"';
                        } else if($dvza == "down") {
                                echo 'style="color: red; text-align: center;"';
                        } else {
                                echo 'style="text-align: center;"';
                        } ?>>%<?php echo $doviztabloa['yuzde']; ?></td>
    </tr> 


        
<?php } 
                }
            }
        }?>
  </tbody>
</table>
							<!-- Share -->
						
						</div>

						<!-- Leave a comment -->
						<div>
							<div class="how2 how2-cl2 flex-s-c">
								<h3 class="f1-m-2 cl3 tab01-title">
								Yorumlar
								</h3>
							</div>
                            <?php echo $genela["yorum"];?>
						<!-- Life Style  -->
						<div class="p-b-25 m-r--10 m-r-0-sr991">
							<div class="how2 <?php echo $renk; ?> flex-s-c m-r-10 m-r-0-sr991">
								<h3 class="f1-m-2 cl17 tab01-title">
								<?php echo $baslik; ?>
								</h3>
							</div>

							<div class="row p-t-35">
								<div class="col-sm-6 p-r-25 p-r-15-sr991">
								   <?php switch ($sayfaadi) {
                                        case "doviz":
                                            $katbaslik=2;
                                            break;
                                        case "altin":
                                            $katbaslik=3;
                                            break;
                                        case "kripto":
                                            $katbaslik=4;
                                            break;
                                        case "borsa":
                                            $katbaslik=5;
                                            break;
                                        case "emtia":
                                            $katbaslik=6;
                                            break;
                                        default:
                                            $katbaslik =1;
                                        }
						 $dovizalti = $db->query("SELECT * FROM haberler where kategori=$katbaslik ORDER BY id DESC LIMIT 3", PDO::FETCH_ASSOC);
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
                            $dovizaltyaniyan = $db->query("SELECT * FROM haberler where kategori=$katbaslik ORDER BY id DESC LIMIT 3,3", PDO::FETCH_ASSOC);
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
				<?php
include ("sidebardoviz.php");
?>
			</div>
		</div>
	</section>
<?php
include ("footer.php");
?>