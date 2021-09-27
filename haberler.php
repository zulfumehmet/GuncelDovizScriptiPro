<?php
include ("db.php");
$sayfaadi= "haberler";
$urlal = ''.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$ogtitle = '<meta property="og:title" content="Güncel döviz, altın, borsa, kripto para ve emtia haberleri '. $site_adi . ' adresinde">
    <meta property="og:image" content="/images/icons/iconp.png" />
    <meta property="og:url" content="'. $urlal .'" />
    ';
include ("header.php");
?>
    <section class="bg0 p-t-20 p-b-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8 p-b-20">
                <div class="container">
                                <div class="flex-c-c p-t-5 p-b-5">
                                     <div class="p-t-10 p-b-10" style="width:100%;margin:auto;text-align:center;float:none;display:scroll;">
                                          <?php echo $reklamkod["haberbanner"]; ?>
                                    </div>
                                </div>
                            </div>
                    <div class="how2 how2-cl1 flex-s-c m-r-10 m-r-0-sr991">
                        <a href="habers-ekonomi.html"><h3 class="f1-m-2 cl3 tab01-title">
                           Ekonomi
                        </h3></a>
                    </div>

                    <div class="row p-t-35">
                        <?php
$haberler1 = $db->query("SELECT * FROM haberler where kategori=1 ORDER BY id DESC LIMIT 6", PDO::FETCH_ASSOC);
if ( $haberler1->rowCount() ){
     foreach( $haberler1 as $haberler ){
         ?>

<div class="col-sm-6 p-r-25 p-r-15-sr991">
                            <div class="m-b-45">
                                <a href="haber-<?php echo $haberler["seo"]; ?>-<?php echo $haberler["ID"]; ?>.html" class="wrap-pic-w hov1 trans-03">
                                    <img src="haberler/<?php echo $haberler["resim"]; ?>" alt="IMG">
                                </a>

                                <div class="p-t-16">
                                    <h5 class="p-b-5">
                                        <a href="haber-<?php echo $haberler["seo"]; ?>-<?php echo $haberler["ID"]; ?>.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                            <?php echo mb_substr($haberler["baslik"], 0, 50, 'UTF-8'); ?>
                                        </a>
                                    </h5>

                                    <span class="cl8">
                                        <a href="haber-<?php echo $haberler["seo"]; ?>-<?php echo $haberler["ID"]; ?>.html" class="f1-s-4 cl8 hov-cl10 trans-03">
                                            <?php echo $haberler["ekleyen"]; ?>
                                        </a>

                                        <span class="f1-s-3 m-rl-3">
                                            -
                                        </span>

                                        <span class="f1-s-3">
                                            <?php  echo date_format(date_create($haberler['tarih']), 'd.m.y'); ?>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
 <?php }
}
?>
                    </div>
                    <div class="container">
                                <div class="flex-c-c p-t-5  p-b-5">
                                <div class="p-t-10 p-b-10" style="width:100%;margin:auto;text-align:center;float:none;display:scroll;">
                                          <?php echo $reklamkod["haberbanner"]; ?>
                                    </div>
                                </div>
                            </div>
<div class="how2 how2-cl5 flex-s-c m-r-10 m-r-0-sr991">
                       <a href="habers-doviz.html"><h3 class="f1-m-2 cl2 tab01-title">
                           Döviz
                        </h3></a>
                    </div>

                    <div class="row p-t-35">
                        <?php
$dovizhaber = $db->query("SELECT * FROM haberler where kategori=2 ORDER BY id DESC LIMIT 6", PDO::FETCH_ASSOC);
if ( $dovizhaber->rowCount() ){
     foreach( $dovizhaber as $dovizh ){
         ?>

<div class="col-sm-6 p-r-25 p-r-15-sr991">
                            <div class="m-b-45">
                                <a href="haber-<?php echo $dovizh["seo"]; ?>-<?php echo $dovizh["ID"]; ?>.html" class="wrap-pic-w hov1 trans-03">
                                    <img src="haberler/<?php echo $dovizh["resim"]; ?>" alt="IMG">
                                </a>

                                <div class="p-t-16">
                                    <h5 class="p-b-5">
                                        <a href="haber-<?php echo $dovizh["seo"]; ?>-<?php echo $dovizh["ID"]; ?>.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                            <?php echo mb_substr($dovizh["baslik"], 0, 50, 'UTF-8'); ?>
                                        </a>
                                    </h5>

                                    <span class="cl8">
                                        <a href="haber-<?php echo $dovizh["seo"]; ?>-<?php echo $dovizh["ID"]; ?>.html" class="f1-s-4 cl8 hov-cl10 trans-03">
                                            <?php echo $dovizh["ekleyen"]; ?>
                                        </a>

                                        <span class="f1-s-3 m-rl-3">
                                            -
                                        </span>

                                        <span class="f1-s-3">
                                            <?php  echo date_format(date_create($dovizh['tarih']), 'd.m.y'); ?>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
 <?php }
}
?>
                    </div> 
                    <div class="container">
                                <div class="flex-c-c p-t-5  p-b-5">
                                <div class="p-t-10 p-b-10" style="width:100%;margin:auto;text-align:center;float:none;display:scroll;">
                                          <?php echo $reklamkod["haberbanner"]; ?>
                                    </div>
                                </div>
                            </div>          
                  <div class="how2 how2-cl3 flex-s-c m-r-10 m-r-0-sr991">
                        <a href="habers-altin.html"><h3 class="f1-m-2 cl3 tab01-title">
                           Altın
                        </h3></a>
                    </div>

                    <div class="row p-t-35">
                        <?php
$altinhaber = $db->query("SELECT * FROM haberler where kategori=3 ORDER BY id DESC LIMIT 6", PDO::FETCH_ASSOC);
if ( $altinhaber->rowCount() ){
     foreach( $altinhaber as $altinh ){
         ?>

<div class="col-sm-6 p-r-25 p-r-15-sr991">
                            <div class="m-b-45">
                                <a href="haber-<?php echo $altinh["seo"]; ?>-<?php echo $altinh["ID"]; ?>.html" class="wrap-pic-w hov1 trans-03">
                                    <img src="haberler/<?php echo $altinh["resim"]; ?>" alt="IMG">
                                </a>

                                <div class="p-t-16">
                                    <h5 class="p-b-5">
                                        <a href="haber-<?php echo $altinh["seo"]; ?>-<?php echo $altinh["ID"]; ?>.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                            <?php echo  mb_substr($altinh["baslik"], 0, 50, 'UTF-8'); ?>
                                        </a>
                                    </h5>

                                    <span class="cl8">
                                        <a href="haber-<?php echo $altinh["seo"]; ?>-<?php echo $altinh["ID"]; ?>.html" class="f1-s-4 cl8 hov-cl10 trans-03">
                                            <?php echo $altinh["ekleyen"]; ?>
                                        </a>

                                        <span class="f1-s-3 m-rl-3">
                                            -
                                        </span>

                                        <span class="f1-s-3">
                                            <?php  echo date_format(date_create($altinh['tarih']), 'd.m.y'); ?>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
 <?php }
}
?>
                    </div>
                    <div class="container">
                                <div class="flex-c-c p-t-5 p-b-5">
                                <div class="p-t-10 p-b-10" style="width:100%;margin:auto;text-align:center;float:none;display:scroll;">
                                          <?php echo $reklamkod["haberbanner"]; ?>
                                    </div>
                                </div>
                            </div>
                    <div class="how2 how2-cl4 flex-s-c m-r-10 m-r-0-sr991">
                        <a href="habers-kriptopara.html"><h3 class="f1-m-2 cl3 tab01-title">
                           Kripto Paralar
                        </h3></a>
                    </div>

                    <div class="row p-t-35">
                    <?php
$kriptohaber = $db->query("SELECT * FROM haberler where kategori=4 ORDER BY id DESC LIMIT 6", PDO::FETCH_ASSOC);
if ( $kriptohaber->rowCount() ){
     foreach( $kriptohaber as $kriptoh ){
         ?>

<div class="col-sm-6 p-r-25 p-r-15-sr991">
                            <div class="m-b-45">
                                <a href="haber-<?php echo $kriptoh["seo"]; ?>-<?php echo $kriptoh["ID"]; ?>.html" class="wrap-pic-w hov1 trans-03">
                                    <img src="haberler/<?php echo $kriptoh["resim"]; ?>" alt="IMG">
                                </a>

                                <div class="p-t-16">
                                    <h5 class="p-b-5">
                                        <a href="haber-<?php echo $kriptoh["seo"]; ?>-<?php echo $kriptoh["ID"]; ?>.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                            <?php echo  mb_substr($kriptoh["baslik"], 0, 50, 'UTF-8'); ?>
                                        </a>
                                    </h5>

                                    <span class="cl8">
                                        <a href="haber-<?php echo $kriptoh["seo"]; ?>-<?php echo $kriptoh["ID"]; ?>.html" class="f1-s-4 cl8 hov-cl10 trans-03">
                                            <?php echo $kriptoh["ekleyen"]; ?>
                                        </a>

                                        <span class="f1-s-3 m-rl-3">
                                            -
                                        </span>

                                        <span class="f1-s-3">
                                            <?php  echo date_format(date_create($kriptoh['tarih']), 'd.m.y'); ?>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
 <?php }
}
?>
                    </div>
                    <div class="container">
                                <div class="flex-c-c p-t-5 p-b-5">
                                <div class="p-t-10 p-b-10" style="width:100%;margin:auto;text-align:center;float:none;display:scroll;">
                                          <?php echo $reklamkod["haberbanner"]; ?>
                                    </div>
                                </div>
                            </div>
                    <div class="how2 how2-cl5 flex-s-c m-r-10 m-r-0-sr991">
                        <a href="habers-borsa.html"><h3 class="f1-m-2 cl3 tab01-title">
                           Borsa
                        </h3></a>
                    </div>

                    <div class="row p-t-35">
                    <?php
$borsahaber = $db->query("SELECT * FROM haberler where kategori=5 ORDER BY id DESC LIMIT 6", PDO::FETCH_ASSOC);
if ( $borsahaber->rowCount() ){
     foreach( $borsahaber as $borsah ){
         ?>

<div class="col-sm-6 p-r-25 p-r-15-sr991">
                            <div class="m-b-45">
                                <a href="haber-<?php echo $borsah["seo"]; ?>-<?php echo $borsah["ID"]; ?>.html" class="wrap-pic-w hov1 trans-03">
                                    <img src="haberler/<?php echo $borsah["resim"]; ?>" alt="IMG">
                                </a>

                                <div class="p-t-16">
                                    <h5 class="p-b-5">
                                        <a href="haber-<?php echo $borsah["seo"]; ?>-<?php echo $borsah["ID"]; ?>.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                            <?php echo  mb_substr($borsah["baslik"], 0, 50, 'UTF-8'); ?>
                                        </a>
                                    </h5>

                                    <span class="cl8">
                                        <a href="haber-<?php echo $borsah["seo"]; ?>-<?php echo $borsah["ID"]; ?>.html" class="f1-s-4 cl8 hov-cl10 trans-03">
                                            <?php echo $borsah["ekleyen"]; ?>
                                        </a>

                                        <span class="f1-s-3 m-rl-3">
                                            -
                                        </span>

                                        <span class="f1-s-3">
                                            <?php  echo date_format(date_create($borsah['tarih']), 'd.m.y'); ?>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
 <?php }
}
?>
                    </div>
                    <div class="container">
                                <div class="flex-c-c p-t-5 p-b-5">
                               <div class="p-t-10 p-b-10" style="width:100%;margin:auto;text-align:center;float:none;display:scroll;">
                                          <?php echo $reklamkod["haberbanner"]; ?>
                                    </div>
                                </div>
                            </div>
                    <div class="how2 how2-cl6 flex-s-c m-r-10 m-r-0-sr991">
                        <a href="habers-emtia.html"><h3 class="f1-m-2 cl3 tab01-title">
                           Emtialar
                        </h3></a>
                    </div>

                    <div class="row p-t-35">
                    <?php
$emtiahaber = $db->query("SELECT * FROM haberler where kategori=6 ORDER BY id DESC LIMIT 6", PDO::FETCH_ASSOC);
if ( $emtiahaber->rowCount() ){
     foreach( $emtiahaber as $emtiah ){
         ?>

<div class="col-sm-6 p-r-25 p-r-15-sr991">
                            <div class="m-b-45">
                                <a href="haber-<?php echo $emtiah["seo"]; ?>-<?php echo $emtiah["ID"]; ?>.html" class="wrap-pic-w hov1 trans-03">
                                    <img src="haberler/<?php echo $emtiah["resim"]; ?>" alt="IMG">
                                </a>

                                <div class="p-t-16">
                                    <h5 class="p-b-5">
                                        <a href="haber-<?php echo $emtiah["seo"]; ?>-<?php echo $emtiah["ID"]; ?>.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                            <?php echo  mb_substr($emtiah["baslik"], 0, 50, 'UTF-8'); ?>
                                        </a>
                                    </h5>

                                    <span class="cl8">
                                        <a href="haber-<?php echo $emtiah["seo"]; ?>-<?php echo $emtiah["ID"]; ?>.html" class="f1-s-4 cl8 hov-cl10 trans-03">
                                            <?php echo $emtiah["ekleyen"]; ?>
                                        </a>

                                        <span class="f1-s-3 m-rl-3">
                                            -
                                        </span>

                                        <span class="f1-s-3">
                                            <?php  echo date_format(date_create($emtiah['tarih']), 'd.m.y'); ?>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
 <?php }
}
?>
                    </div> 

                </div>
                <?php include('habersol.php'); ?>
            </div>
        </div>
    </section>

<?php
include ("footer.php");
?> 