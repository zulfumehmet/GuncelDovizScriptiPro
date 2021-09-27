<?php
ob_start();

//Reklamlar
    $reklam = $db->prepare("SELECT * FROM reklam WHERE id = 1");
    $reklam->bindParam(1, $sira, PDO::PARAM_INT);
    $reklam->execute();
    $reklamkod = $reklam->fetch(PDO::FETCH_ASSOC);
?>
 
<!DOCTYPE html>
<html itemscope="" itemtype="http://schema.org/WebPage" lang="tr">
<head>
   <script data-ad-client="ca-pub-6239201094967208" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<title><?php echo $genela["sitebaslik"]; ?></title>
	<meta charset="UTF-8">
	<meta name="theme-color" content="#1f4a81">
    <meta name="description" content="<?php echo $genela['descv']; ?>">
    <meta name="keywords" content="<?php echo $genela['keyword']; ?>">
    <meta name="author" content="<?php echo $genela['author']; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:site_name" content="<?php echo $genela['author']; ?>">
    <?php echo $ogtitle; ?>
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="preload" as="style" href="fonts/fontawesome-5.0.8/css/fontawesome-all.min.css">
	<link rel="preload" as="style" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <link href="css/flag/flag-icon.css" rel="stylesheet">
    <script src="js/highcharts.js"></script>
    <script src="js/timeline.js"></script>
    <script src="js/data.js"></script>
    <script src="js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="slick/slick.css">
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css">
</head>
<body>
	<header>
		<div class="container-menu-desktop fixed-top">
			<div class="topbar">
				<div class="content-topbar container h-100">
					<div class="wrap-main-nav">
				<div class="main-nav">
					<nav class="menu-desktop">
						<a class="logo-stick" href="index.html">
							<img src="images/icons/logo-01.png" alt="LOGO">
						</a>
						<ul class="main-menu">
							<li class="main-menu-<?php switch ($sayfaadi) { case 'anasayfa': echo 'active';	break; default:	echo 'item';break;}?>">
								<a href="index.html">Ana Sayfa</a>
							</li>

							<li class="main-menu-<?php switch ($sayfaadi) { case 'doviz': echo 'active';	break; default:	echo 'item';break;}?>">
								<a href="doviz.html">Döviz</a>
							</li>

							<li class="main-menu-<?php switch ($sayfaadi) { case 'altin': echo 'active';	break; default:	echo 'item';break;}?>">
								<a href="altin.html">Altın</a>
							</li>

							<li class="main-menu-<?php switch ($sayfaadi) { case 'kripto': echo 'active';	break; default:	echo 'item';break;}?>">
								<a href="kripto.html">Kripto Para</a>
							</li>

							<li class="main-menu-<?php switch ($sayfaadi) { case 'borsa': echo 'active';	break; default:	echo 'item';break;}?>">
								<a href="detay-borsa-endeks.html">Borsa</a>
							</li>

							<li class="main-menu-<?php switch ($sayfaadi) { case 'emtia': echo 'active';	break; default:	echo 'item';break;}?>">
								<a href="emtia.html">Emtialar</a>
							</li>
							
							<li class="main-menu-<?php switch ($sayfaadi) { case 'haberler': echo 'active';	break; default:	echo 'item';break;}?>">
								<a href="haberler.html">Haberler</a>
							</li>
						</ul>
					</nav>
				</div>
			</div>	
				</div>
			</div>
			<div class="wrap-header-mobile">
				<div class="logo-mobile">
					<a href="index.html"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
				</div>
				<div class="btn-show-menu-mobile hamburger hamburger--squeeze m-r--8">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</div>
			</div>
			<div class="menu-mobile">
				
				<ul class="main-menu-m">
					<li>
						<a href="index.html">Ana Sayfa</a>
					</li>
					<li>
						<a href="doviz.html">Döviz</a>
					</li>
					<li>
						<a href="altin.html">Altın</a>
					</li>
					<li>
						<a href="kripto.html">Kripto Para</a>
					</li>
					<li>
						<a href="detay-borsa-endeks.html">Borsa</a>
					</li>
					<li>
						<a href="emtia.html">Emtialar</a>
					</li>
					<li>
						<a href="haberler.html">Haberler</a>
					</li>

					</ul>
			</div>
			<div class="wrap-logo container-menu">
			   
				<div class="container align-items-center">
	
            <?php
$dovizust = $db->query("SELECT * FROM (SELECT * FROM `doviz` WHERE `kategori` IN (1,2,3)  
ORDER BY `doviz`.`id` DESC  LIMIT 0,3) as tmp inner join kategoridoviz on tmp.kategori = kategoridoviz.kategorino ORDER BY kategori ASC", PDO::FETCH_ASSOC);
if ( $dovizust->rowCount() ){
     foreach( $dovizust as $dovizusta ){
            ?>
            <div class="ustayrinti">
                <a href="detay-doviz-<?php echo $dovizusta["seo"]; ?>.html" class="card-link">
                    <span class="birim"><?php echo $dovizusta["adi"]; ?></span><br>
                    <span class="deger"><?php echo number_format($dovizusta["satis"], 4, ',', '.'); ?></span>
                    <div class="sonucust">
                    <span class="birim"><?php echo $dovizusta["yuzde"]; ?>%</span>
                    <?php $kontroldoviz = $dovizusta["degisim"]; 
                    if($kontroldoviz == "flat") {
                      echo '<i class="fas fa-arrows-alt-h" style="color:aqua; margin-left: 10%; margin-right:10%;"></i>';
                        } else if($kontroldoviz == "up") {
                                 echo '<i class="fas fa-chevron-up" style="color:green; margin-left: 10%; margin-right:10%;"></i>';
                        } else if($kontroldoviz == "down") {
                                echo '<i class="fas fa-chevron-down" style="color:red; margin-left: 10%; margin-right:10%;"></i>';
                        } else {
                                echo '<i class="fas fa-equals" style="color:aqua; margin-left: 10%; margin-right:10%;"></i>';
                        }
                    ?>
                        </div>
                    </div>
                </a>
                <?php
                }
            }
$altinust = $db->query("SELECT * from altin where kategori = 2 order by id desc limit 1", PDO::FETCH_ASSOC);
if ( $altinust->rowCount() ){
     foreach( $altinust as $altinusta ){
            ?>
            <div class="ustayrinti">
                <a href="detay-altin-giramaltin.html" class="card-link">
                    <span class="birim">Gram Altın</span><br>
                    <span class="deger"><?php echo number_format($altinusta["satis"], 2, ',', '.'); ?></span>
                    <div class="sonucust">
                    <span class="birim"><?php echo $altinusta["yuzde"]; ?>%</span>
                    <?php $kontrolaltin = $altinusta["degisim"]; 
                    if($kontrolaltin == "flat") {
                      echo '<i class="fas fa-arrows-alt-h" style="color:aqua; margin-left: 10%; margin-right:10%;"></i>';
                        } else if($kontrolaltin == "up") {
                                 echo '<i class="fas fa-chevron-up" style="color:green; margin-left: 10%; margin-right:10%;"></i>';
                        } else if($kontrolaltin == "down") {
                                echo '<i class="fas fa-chevron-down" style="color:red; margin-left: 10%; margin-right:10%;"></i>';
                        } else {
                                echo '<i class="fas fa-equals" style="color:aqua; margin-left: 10%; margin-right:10%;"></i>';
                        }
                    ?>
                        </div>
                    </div>
                </a>
                <?php
                }
            }
            $petrolust = $db->query("SELECT * from emtia where kategori = 4 order by id desc limit 1", PDO::FETCH_ASSOC);
          if ( $petrolust->rowCount() ){
          foreach( $petrolust as $petrolusta ){
            ?>
            <div class="ustayrinti">
                <a href="detay-emtia-brentpetrol.html" class="card-link">
                    <span class="birim">Petrol</span><br>
                    <span class="deger"><i class="fas fa-dollar-sign"></i><?php echo $petrolusta["satis"]; ?></span>
                    <div class="sonucust">
                    <span class="birim"><?php echo $petrolusta["yuzde"]; ?>%</span>
                    <?php $kontrolpetrol = $petrolusta["degisim"]; 
                    if($kontrolpetrol == "flat") {
                      echo '<i class="fas fa-arrows-alt-h" style="color:aqua; margin-left: 10%; margin-right:10%;"></i>';
                        } else if($kontrolpetrol == "up") {
                                 echo '<i class="fas fa-chevron-up" style="color:green; margin-left: 10%; margin-right:10%;"></i>';
                        } else if($kontrolpetrol == "down") {
                                echo '<i class="fas fa-chevron-down" style="color:red; margin-left: 10%; margin-right:10%;"></i>';
                        } else {
                                echo '<i class="fas fa-equals" style="color:aqua; margin-left: 10%; margin-right:10%;"></i>';
                        }
                    ?>
                        </div>
                    </div>
                </a>
                <?php
                }
            }  $kriptoust = $db->query("SELECT * from kripto where kategori = 1 order by id desc limit 1", PDO::FETCH_ASSOC);
          if ( $kriptoust->rowCount() ){
          foreach( $kriptoust as $kriptousta ){
            ?>
            <div class="ustayrinti">
                <a href="detay-kripto-bitcoin.html" class="card-link">
                    <span class="birim">Bitcoin</span><br>
                    <span class="deger"><i class="fas fa-dollar-sign"></i><?php echo number_format($kriptousta["satis"], 0, ',', '.'); ?></span>
                    <div class="sonucust">
                    <span class="birim"><?php echo $kriptousta["yuzde"]; ?>%</span>
                    <?php $kontrolkripto = $kriptousta["degisim"]; 
                    if($kontrolkripto == "flat") {
                      echo '<i class="fas fa-arrows-alt-h" style="color:aqua; margin-left: 10%; margin-right:10%;"></i>';
                        } else if($kontrolkripto == "up") {
                                 echo '<i class="fas fa-chevron-up" style="color:green; margin-left: 10%; margin-right:10%;"></i>';
                        } else if($kontrolkripto == "down") {
                                echo '<i class="fas fa-chevron-down" style="color:red; margin-left: 10%; margin-right:10%;"></i>';
                        } else {
                                echo '<i class="fas fa-equals" style="color:aqua; margin-left: 10%; margin-right:10%;"></i>';
                        }
                    ?>
                        </div>
                    </div>
                </a>
                <?php
                }
            } 
            $borsaust = $db->query("SELECT * from borsa where kategori = 1 order by id desc limit 1", PDO::FETCH_ASSOC);
if ( $borsaust->rowCount() ){
     foreach( $borsaust as $borsausta ){
            ?>
            <div class="ustayrinti">
                <a href="detay-borsa-endeks.html" class="card-link">
                    <span class="birim">Borsa </span><br>
                    <span class="deger"><?php echo $borsausta["satis"]; ?></span>
                    <div class="sonucust">
                    <span class="birim"><?php echo $borsausta["yuzde"]; ?></span>
                    <?php $kontrolborsa = $borsausta["degisim"]; 
                    if($kontrolborsa == "flat") {
                      echo '<i class="fas fa-arrows-alt-h" style="color:aqua; margin-left: 10%; margin-right:10%;"></i>';
                        } else if($kontrolborsa == "up") {
                                 echo '<i class="fas fa-chevron-up" style="color:green; margin-left: 10%; margin-right:10%;"></i>';
                        } else if($kontrolborsa == "down") {
                                echo '<i class="fas fa-chevron-down" style="color:red; margin-left: 10%; margin-right:10%;"></i>';
                        } else {
                                echo '<i class="fas fa-equals" style="color:aqua; margin-left: 10%; margin-right:10%;"></i>';
                        }
                    ?>
                        </div>
                    </div>
                </a>
                <?php
                }
            }
            ?>
               </div>
			</div>	
			</div>
	</header>
	<?php if($reklamkod["sol"]==""){}else { ?>
<div class="yanreklam" id="soldakayan1" style="position: fixed; left: 10px; top: 160px; z-index: 1;"> <?php echo $reklamkod["sol"]; ?><br><a href="javascript:void(0)" onclick="document.getElementById('soldakayan1' ).style.display = 'none';" style="background-color: "><button type="button" class="btn btn-primary btn-sm btn-block">Kapat</button></a></div>
<div class="yanreklam" id="sagdakayan" style="position: fixed; right:10px; top: 160px; z-index: 1;"> <?php echo $reklamkod["sag"]; ?><br><a href="javascript:void(0)" onclick="document.getElementById('sagdakayan' ).style.display = 'none';" style="background-color: "><button type="button" class="btn btn-primary btn-sm btn-block">Kapat</button></a></div>
<?php } ?>