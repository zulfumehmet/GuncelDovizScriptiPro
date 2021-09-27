<?php
include ("db.php");
$sayfaadi= "anasayfa";
$urlal = ''.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$ogtitle = '<meta property="og:title" content="Güncel döviz, altın, borsa, kripto paralar, demir piyasası, faiz oranları, emtia değerleri, döviz birim dönüştürme ve ekonomi haberler '. $site_adi .' adresinde">
    <meta property="og:image" content="/images/icons/iconp.png" />
    <meta property="og:url" content="'. $urlal .'" />
    ';
include ("header.php");
?>  
    <div class="container">
        <style>.tabloveri{font-size: 14px;
    color: #333435;
        }</style>
        <?php  $duyuru = $db->query("SELECT * FROM duyuru WHERE aktif = 1")->fetch(PDO::FETCH_ASSOC);
                if ( $duyuru['aktif'] == 1 ){ echo $duyuru['icerik'];}else{}
                    
        ?>
                      <div class="bg0 flex-wr-sb-c p-rl-0 p-t-10 ">
                            <div class="f2-s-1 p-r-0 size-w-0 m-tb-6 flex-wr-s-c">
                               
                                   <div class="mobiltablo" style="width: 100%;">
                                       <div class="tab01 p-b-20">
                                        <div class="tab01-head how2 how2-cl3 bocl12 flex-s-c m-r-10 m-r-0-sr991">
                               <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active"  href="#" role="tab">Piyasa Özeti</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"  href="#birim-donusturme" role="tab">Birim Dönüştürücü</a>
                                    </li>
                                </ul>
                            </div></div>
                                        
                                       <table class="table table-borderless table-hover table-striped">
                                        <tbody>
                                         <?php
                            $dovizust11 = $db->query("SELECT * FROM (SELECT * FROM `doviz` WHERE `kategori` IN (1,2,3)  
                            ORDER BY `doviz`.`id` DESC  LIMIT 0,3) as tmp inner join kategoridoviz on tmp.kategori = kategoridoviz.kategorino ORDER BY kategori ASC", PDO::FETCH_ASSOC);
                            if ( $dovizust11->rowCount() ){
                                 foreach( $dovizust11 as $dovizusta11 ){
                                        ?>
                                        <tr>
                                            
                                          <th style="text-align: left;" width="50%"><a href="detay-doviz-<?php echo $dovizusta11["seo"]; ?>.html" class="tabloveri"><?php echo $dovizusta11["cinsi"]; ?></a></th>
                                          <td width="30%"><?php echo number_format($dovizusta11["satis"], 4, ',', '.'); ?><i class="fas fa-lira-sign" style="font-size: 11;"></i></td>
                                          
                                          <td width="20%" <?php $kontroldoviz11 = $dovizusta11["degisim"]; 
                    if($kontroldoviz11 == "flat") {
                      echo '';
                        } else if($kontroldoviz11 == "up") {
                                 echo 'style="color: green;"';
                        } else if($kontroldoviz11 == "down") {
                                echo 'style="color: red;"';
                        } else {
                                echo '';
                        }
                    ?>><?php echo $dovizusta11["yuzde"]; ?>%
                    </td>
                                        </tr>
                
                <?php
                }
            } 
            $altinust1 = $db->query("SELECT * from altin where kategori = 2 order by id desc limit 1", PDO::FETCH_ASSOC);
            if ( $altinust1->rowCount() ){
     foreach( $altinust1 as $altinusta1 ){ ?>
                    
                    <tr>
                                            
                                          <th style="text-align: left;" width="50%"><a href="detay-altin-giramaltin.html" class="tabloveri">Gram Altın</a></th>
                                          <td width="30%"><?php echo number_format($altinusta1["satis"], 2, ',', '.'); ?><i class="fas fa-lira-sign" style="font-size: 11;"></i></td>
                                          <td width="20%" <?php  $kontrolaltin1 = $altinusta1["degisim"]; 
                    if($kontrolaltin1 == "flat") {
                      echo '';
                        } else if($kontrolaltin1 == "up") {
                                 echo 'style="color: green;"';
                        } else if($kontrolaltin1 == "down") {
                                echo 'style="color: red;"';
                        } else {
                                echo '';
                        } ?>
                        ><?php echo $altinusta1["yuzde"]; ?>%
                    </td>
                                        </tr>
                    
                <?php
                }
            } 
             $vericekmobil1 = $db->query("SELECT * from emtia where kategori = 4 order by id desc limit 1", PDO::FETCH_ASSOC);
            if ( $vericekmobil1->rowCount() ){
     foreach( $vericekmobil1 as $vericekmobila1 ){ ?>
                    
                    <tr>
                                            
                                          <th style="text-align: left;" width="50%"><a href="detay-emtia-brentpetrol.htmll" class="tabloveri">Brent Petrol</a></th>
                                          <td width="30%">$<?php echo number_format($vericekmobila1["satis"], 2, ',', '.'); ?></td>
                                          <td width="20%" <?php  $kontrolmobil = $vericekmobila1["degisim"]; 
                    if($kontrolmobil == "flat") {
                      echo '';
                        } else if($kontrolmobil == "up") {
                                 echo 'style="color: green;"';
                        } else if($kontrolmobil == "down") {
                                echo 'style="color: red;"';
                        } else {
                                echo '';
                        } ?>
                        ><?php echo $vericekmobila1["yuzde"]; ?>%
                    </td>
                                        </tr>
                    
                <?php
                }
            }  $vericekmobil1 = $db->query("SELECT * from borsa where kategori = 1 order by id desc limit 1", PDO::FETCH_ASSOC);
            if ( $vericekmobil1->rowCount() ){
     foreach( $vericekmobil1 as $vericekmobila1 ){ ?>
                    
                    <tr>
                                            
                                          <th style="text-align: left;" width="50%"><a href="detay-borsa-endeks.html" class="tabloveri">BİST 100</a></th>
                                          <td width="30%">%<?php echo number_format($vericekmobila1["satis"], 0, ',', '.'); ?></td>
                                          <td width="20%" <?php  $kontrolmobil = $vericekmobila1["degisim"]; 
                    if($kontrolmobil == "flat") {
                      echo '';
                        } else if($kontrolmobil == "up") {
                                 echo 'style="color: green;"';
                        } else if($kontrolmobil == "down") {
                                echo 'style="color: red;"';
                        } else {
                                echo '';
                        } ?>
                        ><?php echo $vericekmobila1["yuzde"]; ?>
                    </td>
                                        </tr>
                    
                <?php
                }
            }
            $vericekmobil1 = $db->query("SELECT * from kripto where kategori = 1 order by id desc limit 1", PDO::FETCH_ASSOC);
            if ( $vericekmobil1->rowCount() ){
     foreach( $vericekmobil1 as $vericekmobila1 ){ ?>
                    
                    <tr>
                                            
                                          <th style="text-align: left;" width="50%"><a href="detay-kripto-bitcoin.html" class="tabloveri">Bit Coin</a></th>
                                          <td width="30%">$<?php echo number_format($vericekmobila1["satis"], 2, ',', '.'); ?></td>
                                          <td width="20%" <?php  $kontrolmobil = $vericekmobila1["degisim"]; 
                    if($kontrolmobil == "flat") {
                      echo '';
                        } else if($kontrolmobil == "up") {
                                 echo 'style="color: green;"';
                        } else if($kontrolmobil == "down") {
                                echo 'style="color: red;"';
                        } else {
                                echo '';
                        } ?>
                        ><?php echo $vericekmobila1["yuzde"]; ?>%
                    </td>
                                        </tr>
                    
                <?php
                }
            }
            
          
            $demirfiyat = $db->query("SELECT * from demir where kategori = 2 order by id desc limit 1,1")->fetch(PDO::FETCH_ASSOC);
               
            $vericekmobil1 = $db->query("SELECT * from demir where kategori = 2 order by id desc limit 1", PDO::FETCH_ASSOC);
            if ( $vericekmobil1->rowCount() ){
     foreach( $vericekmobil1 as $vericekmobila1 ){ ?>
                    
                    <tr>
                                            
                                          <th style="text-align: left;" width="50%"><a href="detay-demir-istanbul.html" class="tabloveri">Demir İstanbul </a></th>
                                          <td width="30%"><?php echo number_format($vericekmobila1["satis"], 0, ',', '.'); ?><i class="fas fa-lira-sign" style="font-size: 11;"></td>
                                          <td width="20%" <?php  $ddeger = $vericekmobila1["satis"] - $demirfiyat['satis']; 
                                $dyuzde = $ddeger / $demirfiyat['satis'] * 100;
                    if($dyuzde == 0) {
                      echo '';
                        } else if($dyuzde > 0) {
                                 echo 'style="color: green;"';
                        } else if($dyuzde < 0) {
                                echo 'style="color: red;"';
                        } else {
                                echo '';
                        } ?>
                        ><?php echo number_format($dyuzde, 2, ',', '.'); ?>%
                    </td>
                                        </tr>
                    
                <?php
                }
            } 
             $vericekmobil1 = $db->query("SELECT * from faiz where kategori = 1 order by id desc limit 1", PDO::FETCH_ASSOC);
            if ( $vericekmobil1->rowCount() ){
     foreach( $vericekmobil1 as $vericekmobila1 ){ ?>
                    
                    <tr>
                                            
                                          <th style="text-align: left;" width="50%"><a href="detay-faiz-oran.html" class="tabloveri">Faiz</a></th>
                                          <td width="30%">%<?php echo number_format($vericekmobila1["satis"], 2, ',', '.'); ?></td>
                                          <td width="20%" <?php  $sayiyap = $vericekmobila1["yuzde"];
                                          $faizsayi = str_replace(',', '0', $sayiyap);
                                          $kontrolmobil =  $faizsayi;
                    if($kontrolmobil == 0) {
                      echo '';
                        } else if($kontrolmobil > 0) {
                                 echo 'style="color: green;"';
                        } else if($kontrolmobil < 0) {
                                echo 'style="color: red;"';
                        } else {
                                echo '';
                        } ?>
                        ><?php echo $vericekmobila1["yuzde"]; ?>%
                    </td>
                                        </tr>
                    
                <?php
                }
            }
            ?>
            
            
            
                                      </tbody>
                                    </table>
                                       
                                     
                                    </div>
                            </div>
                </div>
    </div>

    <section class="bg0">
   
<div class="container">
    <div class="row">
        <div class="col-12 pb-1">
            <section class="row">
               
                <div class="col-12 col-md-6 pb-0 pb-md-3 p-t-2 pr-md-0">
                    <div id="featured" class="carousel slide carousel" data-ride="carousel">
                       
                     <ol class="carousel-indicators top-indicator">
                            <li data-target="#featured" data-slide-to="0" class="active"></li>
                            <li data-target="#featured" data-slide-to="1"></li>
                            <li data-target="#featured" data-slide-to="2"></li>
                            <li data-target="#featured" data-slide-to="3"></li>
                            <li data-target="#featured" data-slide-to="4"></li>
                        </ol>
                        
                        <div class="carousel-inner">
                        <?php
                         $query0 = $db->query("SELECT 
                        *
                    FROM haberler 
                    INNER JOIN kategori ON haberler.kategori = kategori.kategorino 
                    ORDER BY haberler.id DESC LIMIT 5", PDO::FETCH_ASSOC);
                        if ( $query0->rowCount() ){
                            $b = 0;
                        foreach( $query0 as $slide ){
                        $baslik = mb_substr($slide["baslik"], 0, 50, 'UTF-8');
                        ?>
                           
                            <div class="carousel-item <?php if ( $b == 0 ){
                                        echo "active";
                                     } else {
                                       echo " ";
                                     }
                                     $b++; ?>">
                                <div class="card border-0 rounded-0 text-light overflow zoom">
                                    <div class="position-relative">
                                       
                                        <div class="ratio_left-cover-1 image-wrapper">
                                            <a href="haber-<?php echo $slide["seo"]; ?>-<?php echo $slide["ID"]; ?>.html">
                                                <img class="img-fluid w-100"
                                                     src="haberler/<?php echo $slide["resim"]; ?>"
                                                     alt="<?php echo $baslik;?>" >
                                            </a>
                                        </div>
                                        <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                           
                                            <a href="haber-<?php echo $slide["seo"]; ?>-<?php echo $slide["ID"]; ?>.html">
                                                <h2 class="h3 post-title text-white my-1"><?php echo $baslik; ?></h2>
                                            </a>
                                            
                                            <div class="news-meta">
                                                <span class="news-author"><a class="text-white font-weight-bold" href="haber-<?php echo $slide["seo"]; ?>-<?php echo $slide["ID"]; ?>.html"><?php echo $slide["kategoriyadi"]; ?></a></span>
                                                <span class="news-date"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php     }
                                    } ?>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#featured" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#featured" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="col-12 col-md-6 p-t-2 pl-md-1 mb-3 mb-lg-1">
                    <div class="row">
                <?php 
                $query2 = $db->query("SELECT  * FROM haberler INNER JOIN kategori ON haberler.kategori = kategori.kategorino 
                                        ORDER BY haberler.id DESC LIMIT 5,4", PDO::FETCH_ASSOC);
                                if ( $query2->rowCount() ){
                                    $i = 0;
                                    foreach( $query2 as $slider2 ){
                                    $baslik2 = mb_substr($slider2["baslik"], 0, 30, 'UTF-8'); 
                                    ?>
                                     <div class="<?php if ( $i == 0 ){
                                        echo "col-6 pb-1 pt-0 pr-1";
                                     } elseif ( $i == 1){
                                       echo "col-6 pb-1 pl-1 pt-0";
                                     } elseif ( $i == 2){
                                       echo "col-6 pb-1 pr-1 pt-1";
                                     } elseif ( $i == 3){
                                       echo "col-6 pb-1 pl-1 pt-1";
                                     }
                                     $i++; ?>">
                                     <div class="card border-0 rounded-0 text-white overflow zoom">
                                         <div class="position-relative">
                                             <div class="ratio_right-cover-2 image-wrapper">
                                                 <a href="haber-<?php echo $slider2["seo"]; ?>-<?php echo $slider2["ID"]; ?>.html">
                                                     <img class="img-fluid"
                                                          src="haberler/<?php echo $slider2["resim"]; ?>"
                                                          alt="simple blog template bootstrap">
                                                 </a>
                                             </div>
                                             <div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow">
                                                 <a class="p-1 badge badge-primary rounded-0" href="haber-<?php echo $slider2["seo"]; ?>-<?php echo $slider2["ID"]; ?>.html"><?php echo $slider2["kategoriyadi"]; ?></a>
                                                 <a href="haber-<?php echo $slider2["seo"]; ?>-<?php echo $slider2["ID"]; ?>.html">
                                                     <h2 class="h5 text-white my-1"><?php echo $baslik2; ?></h2>
                                                 </a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                     <?php
                                    }
                                }
                                ?>
                    </div>
                </div>
                </section>
            </div>
    </div>
</div>
     </section>
    <section class="bg0">

    </section>
      
<section class="bg0 p-t-2">
<div class="container">
<div class="slider one-time" style="
    height: 100px;
">
<?php
$dovizbilgi = $db->query("SELECT * FROM (SELECT * FROM `doviz` WHERE `kategori` IN (1,2,3,4,5,6,9) ORDER BY `doviz`.`id` DESC LIMIT 0,7) as tmp inner join kategoridoviz on tmp.kategori = kategoridoviz.kategorino ORDER BY tmp.kategori ASC", PDO::FETCH_ASSOC);
if ( $dovizbilgi->rowCount() ){
     foreach( $dovizbilgi as $dovizbilgia ){
            ?>
            <div class="multiple">
            <div class="ovalkenar" style="height: 85px;">
                <a href="detay-doviz-<?php echo $dovizbilgia["seo"]; ?>.html" class="card-link" style="position: relative;top: 5;">
                <table>
  <tr>
    <td class="tablobayrak"><?php echo $dovizbilgia['bayrak']; ?></td>
    <td> <span class="birimalt"><?php echo $dovizbilgia["adi"]; ?>(<i class="fas fa-lira-sign"></i>)</span></td>
  </tr>
  </table>
    <table>
  <tr>
    <td><span class="degeralt">Alış </span></td>
    <td><span class="degeralt">: </span></td>
    <td><span class="degeralt"><?php echo number_format($dovizbilgia["alis"], 4, ',', '.'); ?></span></td>
  </tr>
  <tr>
    <td>  <span class="degeralt">Satış </span></td>
    <td>  <span class="degeralt">: </span></td>
    <td>  <span class="degeralt"><?php echo number_format($dovizbilgia["satis"], 4, ',', '.'); ?></span></td>
  </tr>
</table>
                <div class="sonucust">
                    <span class="birimalt">%<?php echo $dovizbilgia["yuzde"]; ?></span>
                    <?php $kontroldoviz1 = $dovizbilgia["degisim"]; 
                    if($kontroldoviz1 == "flat") {
                      echo '<i class="fas fa-arrows-alt-h hareketalt" style="color:aqua; margin-left: 10%; margin-right:10%;"></i>';
                        } else if($kontroldoviz1 == "up") {
                                 echo '<i class="fas fa-chevron-up hareketalt" style="color:green; margin-left: 10%; margin-right:10%;"></i>';
                        } else if($kontroldoviz1 == "down") {
                                echo '<i class="fas fa-chevron-down hareketalt" style="color:red; margin-left: 10%; margin-right:10%;"></i>';
                        } else {
                                echo '<i class="fas fa-equals hareketalt" style="color:aqua; margin-left: 10%; margin-right:10%;"></i>';
                        }
                    ?>
                        </div>
                    </div>
                </a>
                </div>
                <?php
                }
            }?>
            <?php
$altinbilgi = $db->query("SELECT * FROM (SELECT * FROM `altin` WHERE `kategori` IN (1,2,6) ORDER BY `altin`.`id` DESC LIMIT 0,3) as tmp inner join altinkategori on tmp.kategori = altinkategori.kategorino", PDO::FETCH_ASSOC);
if ( $altinbilgi->rowCount() ){
     foreach( $altinbilgi as $altinbilgia ){
            ?>
            <div class="multiple">
            <div class="ovalkenar" style="height: 85px;">
                <a href="detay-altin-<?php echo $altinbilgia["seo"]; ?>.html" class="card-link" style="position: relative;top: 5;">
                <table>
  <tr>
    <td class="tablobayrak"><?php echo $altinbilgia['simge']; ?></td>
    <td> <span class="birimalt"><?php echo $altinbilgia["cinsi"]; ?> </td>
  </tr>
  </table>
    <table>
  <tr>
    <td><span class="degeralt">Alış </span></td>
    <td><span class="degeralt">: </span></td>
    <td><span class="degeralt"><?php echo number_format($altinbilgia["alis"], 2, ',', '.'); ?></span></td>
  </tr>
  <tr>
    <td>  <span class="degeralt">Satış </span></td>
    <td>  <span class="degeralt">: </span></td>
    <td>  <span class="degeralt"><?php echo number_format($altinbilgia["satis"], 2, ',', '.'); ?></span></td>
  </tr>
</table>
                <div class="sonucust">
                    <span class="birimalt">%<?php echo $altinbilgia["yuzde"]; ?></span>
                    <?php $kontrolaltin1 = $altinbilgia["degisim"]; 
                    if($kontrolaltin1 == "flat") {
                      echo '<i class="fas fa-arrows-alt-h hareketalt" style="color:aqua; margin-left: 10%; margin-right:10%;"></i>';
                        } else if($kontrolaltin1 == "up") {
                                 echo '<i class="fas fa-chevron-up hareketalt" style="color:green; margin-left: 10%; margin-right:10%;"></i>';
                        } else if($kontrolaltin1 == "down") {
                                echo '<i class="fas fa-chevron-down hareketalt" style="color:red; margin-left: 10%; margin-right:10%;"></i>';
                        } else {
                                echo '<i class="fas fa-equals hareketalt" style="color:aqua; margin-left: 10%; margin-right:10%;"></i>';
                        }
                    ?>
                        </div>
                    </div>
                </a>
                </div>
                <?php
                }
            }?>
    </div>
</div>
            
  <script type="text/javascript">
    $(document).on('ready', function() {
          $('.one-time').slick({
            dots: false,
            slidesToShow: 5,
            slidesToScroll: 1,
            touchMove: false,
                responsive: [
                        {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1,
                            infinite: true,
                            dots: false
                        }
                        },
                        {
                        breakpoint: 800,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                        },
                        {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                        },
                        {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                        }
                    ]
            });
    });
</script>

</section>
    <section class="bg0 p-t-20">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="p-b-20">
                        <div class="tab01 p-b-20">
                            <div class="tab01-head how2 how2-cl1 bocl12 flex-s-c m-r-10 m-r-0-sr991">
                                <h3 class="f1-m-2 cl12 tab01-title">
                                    Ekonomi Takvimi
                                </h3>
                            </div>
                            <style> .altinsimge {
  background: url('css/simge/altin.png');
  height: 20px;
  width: 20px;
  display: block;
}</style>
                            <?php $tsorgu = $db->prepare("SELECT * FROM takvim WHERE id = 1");
    $tsorgu->bindParam(1, $sira, PDO::PARAM_INT);
    $tsorgu->execute();

    $takvim = $tsorgu->fetch(PDO::FETCH_ASSOC); ?>
	        <p class="f1-s-12 cl6 p-b-2">Ekonomik takvim uygulaması her ekonomist, uzman, analiz ve yatırımcı tarafından kullanılmaktadır. Piyasanın gün içinde değişen trend oluşumlarını belirlemek amacıyla kullanılan bu uygulamada, dünyadaki bütün ülkelerin ekonomik verileri takip edilir.</p>
           
	      
                            <div class="row p-t-10 takvim"> <?php

    echo $takvim["takvim"];
	     
	     ?></div>
                        </div>
                        <div class="tab01 p-b-20">
                            <div class="tab01-head how2 how2-cl2 bocl12 flex-s-c m-r-10 m-r-0-sr991">
                               
                                <h3 class="f1-m-2 cl13 tab01-title">
                                    Pariteler
                                </h3>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tab2-1" role="tab">Dolar</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab2-2" role="tab">Euro</a>
                                    </li>
                                </ul>
                            </div>
                            <?php
                        $sth = $db->prepare("SELECT * FROM
                        (SELECT
                            *
                            FROM
                            doviz
                            WHERE kategori IN (1,2,3,4,5,6,7,8,9,10,11,12,13)
                            ORDER BY id DESC
                            LIMIT 13
                        ) AS T inner join kategoridoviz as ikinci on T.kategori = ikinci.kategorino ORDER BY kategorino ASC");
                        $sth->execute();
                        $result = $sth->fetchAll();
                        ?>
                            <div class="tab-content p-t-35">
                                
                                <div class="tab-pane fade show active" id="tab2-1" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-12 p-r-25 p-r-15-sr991">
                                              <h3 class="p-t-5">Ülke para birimlerinin birbirine oranını ifade eder.</h3>
                                        <table class="table table-borderless table-hover table-striped">
                                            <thead>
                                                 <tr>
                                                    <th scope="col">Parite</th>
                                                    <th scope="col">%</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $result[0]['bayrak']."</span>"; ?> / <?php echo $result[1]['bayrak']."</span>"; ?> - Euro</td>
                                                    <td><?php $deger1= noktacevir($result[0]['satis'])/noktacevir($result[1]['satis']); echo number_format($deger1, 2, '.', ',');?></td>
                                             </tr>
                                                <tr>
                                                    <td><?php echo $result[0]['bayrak']."</span>"; ?> / <?php echo $result[2]['bayrak']."</span>"; ?> - İngiliz Sterlini</td>
                                                    <td><?php $deger2= noktacevir($result[0]['satis'])/noktacevir($result[2]['satis']); echo number_format($deger2, 2, '.', ',');?></td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $result[0]['bayrak']."</span>"; ?> / <?php echo $result[3]['bayrak']."</span>"; ?> - Kanada Doları</td>
                                                    <td><?php $deger3= noktacevir($result[0]['satis'])/noktacevir($result[3]['satis']); echo number_format($deger3, 2, '.', ',');?></td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $result[0]['bayrak']."</span>"; ?> / <?php echo $result[4]['bayrak']."</span>"; ?> - İsviçre Frangı</td>
                                                    <td><?php $deger4= noktacevir($result[0]['satis'])/noktacevir($result[4]['satis']); echo number_format($deger4, 2, '.', ',');?></td>
                                                 </tr>
                                                <tr>
                                                    <td><?php echo $result[0]['bayrak']."</span>"; ?> / <?php echo $result[5]['bayrak']."</span>"; ?> - Sudi Arabistan Riyali</td>
                                                    <td><?php $deger5= noktacevir($result[0]['satis'])/noktacevir($result[5]['satis']); echo number_format($deger5, 2, '.', ',');?></td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $result[0]['bayrak']."</span>"; ?> / <?php echo $result[7]['bayrak']."</span>"; ?> - Avusturalya Doları</td>
                                                    <td><?php $deger7= noktacevir($result[0]['satis'])/noktacevir($result[7]['satis']); echo number_format($deger7, 2, '.', ',');?></td>
                                                 </tr>
                                                 <tr>
                                                    <td><?php echo $result[0]['bayrak']."</span>"; ?> / <?php echo $result[6]['bayrak']."</span>"; ?> - 100 Japon Yeni</td>
                                                    <td><?php $deger6= noktacevir($result[0]['satis'])/noktacevir($result[6]['satis']); echo number_format($deger6, 2, '.', ',');?></td>
                                                 </tr>
                                                <tr>
                                                    <td><?php echo $result[0]['bayrak']."</span>"; ?> / <?php echo $result[8]['bayrak']."</span>"; ?> - Norveç Kronu</td>
                                                    <td><?php $deger8= noktacevir($result[0]['satis'])/noktacevir($result[8]['satis']); echo number_format($deger8, 2, '.', ',');?></td>
                                                 </tr>
                                                <tr>
                                                    <td><?php echo $result[0]['bayrak']."</span>"; ?> / <?php echo $result[9]['bayrak']."</span>"; ?> - Danimarka Kronu</td>
                                                    <td><?php $deger9= noktacevir($result[0]['satis'])/noktacevir($result[9]['satis']); echo number_format($deger9, 2, '.', ',');?></td>
                                                 </tr>
                                                <tr>
                                                    <td><?php echo $result[0]['bayrak']."</span>"; ?> / <?php echo $result[10]['bayrak']."</span>"; ?> - İsveç Kronu</td>
                                                    <td><?php $deger10= noktacevir($result[0]['satis'])/noktacevir($result[10]['satis']); echo number_format($deger10, 2, '.', ',');?></td>
                                                 </tr>
                                                <tr>
                                                    <td><?php echo $result[0]['bayrak']."</span>"; ?> / <?php echo $result[11]['bayrak']."</span>"; ?> - Kuveyt Dinarı</td>
                                                    <td><?php $deger11= noktacevir($result[0]['satis'])/noktacevir($result[11]['satis']); echo number_format($deger11, 2, '.', ',');?></td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $result[0]['bayrak']."</span>"; ?> / <?php echo $result[12]['bayrak']."</span>"; ?> - Rus Rublesi</td>
                                                    <td><?php $deger12= noktacevir($result[0]['satis'])/noktacevir($result[12]['satis']); echo number_format($deger12, 2, '.', ',');?></td>
                                                </tr>
                                            </tbody>    
                                        </table>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab2-2" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-12 p-r-25 p-r-15-sr991">
                                        <h3 class="p-t-5">Ülke para birimlerinin birbirine oranını ifade eder.</h3>
                                            
                                            <table class="table table-borderless table-hover table-striped">
                                            <thead>
                                                 <tr>
                                                    <th scope="col">Parite</th>
                                                    <th scope="col">%</th>
                                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $result[1]['bayrak']."</span>"; ?> / <?php echo $result[0]['bayrak']."</span>"; ?> - Abd Doları</td>
                                                    <td><?php $degera1= noktacevir($result[1]['alis'])/noktacevir($result[0]['alis']); echo number_format($degera1, 2, '.', ',');?></td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $result[1]['bayrak']."</span>"; ?> / <?php echo $result[2]['bayrak']."</span>"; ?> - İngiliz Sterlini</td>
                                                    <td><?php $degera2= noktacevir($result[1]['alis'])/noktacevir($result[2]['alis']); echo number_format($degera2, 2, '.', ',');?></td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $result[1]['bayrak']."</span>"; ?> / <?php echo $result[3]['bayrak']."</span>"; ?> - Kanada Doları</td>
                                                    <td><?php $degera3= noktacevir($result[1]['alis'])/noktacevir($result[3]['alis']); echo number_format($degera3, 2, '.', ',');?></td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $result[1]['bayrak']."</span>"; ?> / <?php echo $result[4]['bayrak']."</span>"; ?> - İsviçre Frangı</td>
                                                    <td><?php $degera4= noktacevir($result[1]['alis'])/noktacevir($result[4]['alis']); echo number_format($degera4, 2, '.', ',');?></td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $result[1]['bayrak']."</span>"; ?> / <?php echo $result[5]['bayrak']."</span>"; ?> - Sudi Arabistan Riyali</td>
                                                    <td><?php $degera5= noktacevir($result[1]['alis'])/noktacevir($result[5]['alis']); echo number_format($degera5, 2, '.', ',');?></td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $result[1]['bayrak']."</span>"; ?> / <?php echo $result[7]['bayrak']."</span>"; ?> - Avusturalya Doları</td>
                                                    <td><?php $degera7= noktacevir($result[1]['alis'])/noktacevir($result[7]['alis']); echo number_format($degera7, 2, '.', ',');?></td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $result[1]['bayrak']."</span>"; ?> / <?php echo $result[6]['bayrak']."</span>"; ?> - 100 Japon Yeni</td>
                                                    <td><?php $degera6= noktacevir($result[1]['alis'])/noktacevir($result[6]['alis']); echo number_format($degera6, 2, '.', ',');?></td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $result[1]['bayrak']."</span>"; ?> / <?php echo $result[8]['bayrak']."</span>"; ?> - Norveç Kronu</td>
                                                    <td><?php $degera8= noktacevir($result[1]['alis'])/noktacevir($result[8]['alis']); echo number_format($degera8, 2, '.', ',');?></td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $result[1]['bayrak']."</span>"; ?> / <?php echo $result[9]['bayrak']."</span>"; ?> - Danimarka Kronu</td>
                                                    <td><?php $degera9= noktacevir($result[1]['alis'])/noktacevir($result[9]['alis']); echo number_format($degera9, 2, '.', ',');?></td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $result[1]['bayrak']."</span>"; ?> / <?php echo $result[10]['bayrak']."</span>"; ?> - İsveç Kronu</td>
                                                    <td><?php $degera10= noktacevir($result[1]['alis'])/noktacevir($result[10]['alis']); echo number_format($degera10, 2, '.', ',');?></td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $result[1]['bayrak']."</span>"; ?> / <?php echo $result[11]['bayrak']."</span>"; ?> - Kuveyt Dinarı</td>
                                                    <td><?php $degera11= noktacevir($result[1]['alis'])/noktacevir($result[11]['alis']); echo number_format($degera11, 2, '.', ',');?></td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $result[1]['bayrak']."</span>"; ?> / <?php echo $result[12]['bayrak']."</span>"; ?> - Rus Rublesi</td>
                                                    <td><?php $degera12= noktacevir($result[1]['alis'])/noktacevir($result[12]['alis']); echo number_format($degera12, 2, '.', ',');?></td>
                                                </tr>
                                            </tbody>    
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab01 p-b-20">
                            <div class="tab01-head how2 how2-cl3 bocl12 flex-s-c m-r-10 m-r-0-sr991">
                               
                                <h3 class="f1-m-2 cl13 tab01-title">
                                    10.000 TL
                                </h3>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#gecenhafta" role="tab">BİR HAFTA</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#gecenay" role="tab">BİR AY</a>
                                    </li>
                                </ul>
                            </div>
                                     <?php
                                      $haftadoviz = $db->query("select kategori, id, (select AVG(satis) from doviz df where tarih >= DATE_SUB( CURDATE( ) , INTERVAL 7 DAY ) and df.kategori=dd.kategori limit 1) as satis from doviz dd where tarih >= DATE_SUB( CURDATE( ) , INTERVAL 7 DAY ) and kategori in(1, 2, 3) group by kategori", PDO::FETCH_ASSOC);
                                      $aydoviz = $db->query("select kategori, id, (select AVG(satis) from doviz df where tarih >= DATE_SUB( CURDATE( ) , INTERVAL 30 DAY ) and df.kategori=dd.kategori limit 1) as satis from doviz dd where tarih >= DATE_SUB( CURDATE( ) , INTERVAL 30 DAY ) and kategori in(1, 2, 3) group by kategori", PDO::FETCH_ASSOC);
                                      $haftaaltin = $db->query("SELECT AVG(`satis`) , DATE(`tarih`) FROM altin WHERE tarih >= DATE_SUB( CURDATE( ) , INTERVAL 7 DAY ) and kategori = 2 GROUP BY DATE(`tarih`) ASC limit 1", PDO::FETCH_ASSOC);
                                      $ayaltin = $db->query("SELECT AVG(`satis`) , DATE(`tarih`) FROM altin WHERE tarih >= DATE_SUB( CURDATE( ) , INTERVAL 30 DAY ) and kategori = 2 GROUP BY DATE(`tarih`) ASC limit 1", PDO::FETCH_ASSOC);
                                        ?>
                            
                            <div class="tab-content p-t-15">
                                <div class="tab-pane fade show active" id="gecenhafta" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-12 p-r-25 p-r-15-sr991">
                                              <h3 class="p-t-5">Bir hafta önce 10.000 TL yatırım yapmış olsaydınız bugün ki karşılığı.</h3></br>
                                              <table class="table table-borderless table-hover table-striped">
                                          <thead>
                                            <tr>
                                              <th scope="col">Birim Adı</th>
                                              <th scope="col">Tutar</th>
                                              <th scope="col">Fark</th>
                                              <th scope="col">Değişim</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <?php if ( $haftadoviz->rowCount() ){
                                                         foreach( $haftadoviz as $hdoviz ){ ?>
                                                         <tr>
                                                         <th style="text-align: left;" scope="row"><?php switch ($hdoviz["kategori"]){case 1: echo "Dolar"; break; case 2: echo "Euro"; break; case 3: echo "İngiliz Sterlini"; break;}?></th>
                                                         <td><?php switch ($hdoviz["kategori"]){case 1: $haftaeskidolar= 10000/$hdoviz["satis"]; echo number_format($haftaeskidolar*$result[0]['satis'], 2, ',', '.'); break; case 2: $haftaeskidolar= 10000/$hdoviz["satis"]; echo number_format($haftaeskidolar*$result[1]['satis'], 2, ',', '.'); break; case 3:$haftaeskidolar= 10000/$hdoviz["satis"]; echo number_format($haftaeskidolar*$result[2]['satis'], 2, ',', '.'); break;}?></td>
                                                         <td><?php switch ($hdoviz["kategori"]){case 1: $hdovizfark = $haftaeskidolar*$result[0]['satis']; $hdfark = $hdovizfark-10000; echo number_format($hdfark, 2, ',', '.'); break; case 2: $hdovizfark = $haftaeskidolar*$result[1]['satis']; $hdfark = $hdovizfark-10000; echo number_format($hdfark, 2, ',', '.'); break; case 3: $hdovizfark = $haftaeskidolar*$result[2]['satis']; $hdfark = $hdovizfark-10000; echo number_format($hdfark, 2, ',', '.'); break;}?></td>
                                                         <td><?php if($hdfark == 0 ) {
                      echo '<i class="fas fa-arrows-alt-h hareketalt" style="color:aqua; margin-left: 10%; margin-right:10%;"></i>';
                        } else if($hdfark > 0) {
                                 echo '<i class="fas fa-chevron-up hareketalt" style="color:green; margin-left: 10%; margin-right:10%;"></i>';
                        } else if($hdfark < 0) {
                                echo '<i class="fas fa-chevron-down hareketalt" style="color:red; margin-left: 10%; margin-right:10%;"></i>';
                        } else {
                                echo '<i class="fas fa-equals hareketalt" style="color:aqua; margin-left: 10%; margin-right:10%;"></i>';
                        }
                    ?></td>
                                                         </tr>
                                                         <?php }
                                                    }
                                                    if ( $haftaaltin->rowCount() ){
                                                         foreach( $haftaaltin as $hhafta ){ ?>
                                                         <tr>
                                                         <th style="text-align: left;" scope="row">Gram Altın</th>
                                                         <td><?php $haftaeskihafta= 10000/$hhafta["AVG(`satis`)"]; $haftasimdi = $haftaeskihafta*$altinusta["satis"]; echo number_format($haftasimdi, 2, ',', '.'); ?></td>
                                                         <td><?php $hhaftafark = $haftasimdi - 10000; echo number_format($hhaftafark, 2, ',', '.'); ?></td>
                                                         <td> <?php if($hhaftafark == 0 ) {
                      echo '<i class="fas fa-arrows-alt-h hareketalt" style="color:aqua; margin-left: 10%; margin-right:10%;"></i>';
                        } else if($hhaftafark > 0) {
                                 echo '<i class="fas fa-chevron-up hareketalt" style="color:green; margin-left: 10%; margin-right:10%;"></i>';
                        } else if($hhaftafark < 0) {
                                echo '<i class="fas fa-chevron-down hareketalt" style="color:red; margin-left: 10%; margin-right:10%;"></i>';
                        } else {
                                echo '<i class="fas fa-equals hareketalt" style="color:aqua; margin-left: 10%; margin-right:10%;"></i>';
                        }
                    ?></td>
                                                         </tr>
                                                         <?php }
                                                    }?>
                                          </tbody>
                                        </table>
                                            
                                        </div>
                                    </div>
                                </div>
                                                                <div class="tab-pane fade" id="gecenay" role="tabpanel">
                                    <div class="row">
                                        <div class="col-sm-12 p-r-25 p-r-15-sr991">
                                        <h3 class="p-t-5">Bir ay önce 10.000 TL yatırım yapmış olsaydınız bugün ki karşılığı.</h3> </br>
                                        
                                        <table class="table borderless table-hover table-striped">
                                          <thead>
                                            <tr>
                                              <th scope="col">Birim Adı</th>
                                              <th scope="col">Tutar</th>
                                              <th scope="col">Fark</th>
                                              <th scope="col">Değişim</th>
                                             
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <?php if ( $aydoviz->rowCount() ){
                                                         foreach( $aydoviz as $adoviz ){ ?>
                                                         <tr>
                                                         <th style="text-align: left;" scope="row"><?php switch ($adoviz["kategori"]){case 1: echo "Dolar"; break; case 2: echo "Euro"; break; case 3: echo "İngiliz Sterlini"; break;}?></th>
                                                         <td><?php switch ($adoviz["kategori"]){case 1: $ayeskidolar= 10000/$adoviz["satis"]; echo number_format($ayeskidolar*$result[0]['satis'], 2, ',', '.'); break; case 2: $ayeskidolar= 10000/$adoviz["satis"]; echo number_format($ayeskidolar*$result[1]['satis'], 2, ',', '.'); break; case 3:$ayeskidolar= 10000/$adoviz["satis"]; echo number_format($ayeskidolar*$result[2]['satis'], 2, ',', '.'); break;}?></td>
                                                         <td><?php switch ($adoviz["kategori"]){case 1: $dovizfark = $ayeskidolar*$result[0]['satis']; $dfark = $dovizfark-10000; echo number_format($dfark, 2, ',', '.'); break; case 2: $dovizfark = $ayeskidolar*$result[1]['satis']; $dfark = $dovizfark-10000; echo number_format($dfark, 2, ',', '.'); break; case 3: $dovizfark = $ayeskidolar*$result[2]['satis']; $dfark = $dovizfark-10000; echo number_format($dfark, 2, ',', '.'); break;} ?></td>
                                                         <td><?php  if($dfark == 0 ) {
                      echo '<i class="fas fa-arrows-alt-h hareketalt" style="color:aqua; margin-left: 10%; margin-right:10%;"></i>';
                        } else if($dfark > 0) {
                                 echo '<i class="fas fa-chevron-up hareketalt" style="color:green; margin-left: 10%; margin-right:10%;"></i>';
                        } else if($dfark < 0) {
                                echo '<i class="fas fa-chevron-down hareketalt" style="color:red; margin-left: 10%; margin-right:10%;"></i>';
                        } else {
                                echo '<i class="fas fa-equals hareketalt" style="color:aqua; margin-left: 10%; margin-right:10%;"></i>';
                        }
                    ?></td>
                                                         </tr>
                                                         <?php }
                                                    } if ( $ayaltin->rowCount() ){
                                                         foreach( $ayaltin as $aaltin ){ ?>
                                                         <tr>
                                                         <th style="text-align: left;" scope="row">Gram Altın</th>
                                                         <td><?php $ayeskialtin= 10000/$aaltin["AVG(`satis`)"]; $altinsimdi = $ayeskialtin*$altinusta["satis"]; echo number_format($altinsimdi, 2, ',', '.'); ?></td>
                                                         <td><?php $aaltinfark = $altinsimdi - 10000; echo number_format($aaltinfark, 2, ',', '.'); ?></td>
                                                         <td><?php if($aaltinfark == 0 ) {
                      echo '<i class="fas fa-arrows-alt-h hareketalt" style="color:aqua; margin-left: 10%; margin-right:10%;"></i>';
                        } else if($aaltinfark > 0) {
                                 echo '<i class="fas fa-chevron-up hareketalt" style="color:green; margin-left: 10%; margin-right:10%;"></i>';
                        } else if($aaltinfark < 0) {
                                echo '<i class="fas fa-chevron-down hareketalt" style="color:red; margin-left: 10%; margin-right:10%;"></i>';
                        } else {
                                echo '<i class="fas fa-equals hareketalt" style="color:aqua; margin-left: 10%; margin-right:10%;"></i>';
                        }
                    ?></td>
                                                         </tr>
                                                         <?php }
                                                    }?>
                                          </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        <div class="col-md-10 col-lg-4">
            <div class="p-l-10 p-rl-0-sr991 p-b-20">
                                           <div class="p-b-10" style="width: 100%;margin:auto;text-align:center;float:none;display:scroll;">
                                                    <?php echo $reklamkod["sliderana300250"]; ?> 
                                                </div>
                                                
                                                 <a name="birim-donusturme"></a>
                        <div class="how2 how2-cl4 flex-s-c">
                                <h3 class="f1-m-2 cl3 tab01-title">
                                    Birim Dönüştürme
                                </h3>
                        </div>
                                                    <div class="tab01 p-b-5 p-t-5">
                                                        <div class="tab01-head how2 bocl12 flex-s-c m-r-10 m-r-0-sr991">
                                                            <ul class="nav nav-tabs p-t-5" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" data-toggle="tab" href="#doviz" role="tab">Döviz</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" data-toggle="tab" href="#altin" role="tab">Altın</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="tab-content p-t-15">
                                                            <div class="tab-pane fade show active" id="doviz" role="tabpanel">
                                                                <div class="row">
                                                                    <div class="col-sm-12 p-r-25 p-r-15-sr991">
                                                                         <div class="converter-wrapper">
                                                                            <div class="TL">
                                                                              <h2>Türk Lirası</h2>
                                                                              <input id="inputTL"  type="number" oninput="dovizConverter(this.id,this.value)" onchange="dovizConverter(this.id,this.value)">
                                                                            </div>
                                                                            <div class="Dolar">
                                                                            <h2>Amerikan Doları</h2>
                                                                            <input id="inputDLR"  type="number" oninput="dovizConverter(this.id,this.value)" onchange="dovizConverter(this.id,this.value)">
                                                                            </div>
                                                                            <div class="Euro">
                                                                              <h2>Euro</h2>
                                                                              <input id="inputEUR"  type="number" oninput="dovizConverter(this.id,this.value)" onchange="dovizConverter(this.id,this.value)">
                                                                            </div>
                                                                        	<div class="Sterlin">
                                                                              <h2>İngiliz Sterlin</h2>
                                                                              <input id="inputSTR"  type="number" oninput="dovizConverter(this.id,this.value)" onchange="dovizConverter(this.id,this.value)">
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="altin" role="tabpanel">
                                                <div class="row">
                                                                    <div class="col-sm-12 p-r-25 p-r-15-sr991">
                                                                         <?php
                                                    $altinfiyata = $db->prepare("SELECT satis FROM altin WHERE kategori IN (1,2,6) ORDER BY id DESC LIMIT 3");
                                                    $altinfiyata->execute();
                                                    $altinfiyatal = $altinfiyata->fetchAll();
                                                    ?>
                                                            <div class="converter-wrapper">
                                                                 <div class="TL">
                                                                      <h2>Türk Lirası</h2>
                                                                      <input id="inputT"  type="number" oninput="altinConverter(this.id,this.value)" onchange="altinConverter(this.id,this.value)">
                                                                    </div>
                                                                    <div class="gramaltin">
                                                                    <h2>Gram Altın</h2>
                                                                    <input id="inputGA"  type="number" oninput="altinConverter(this.id,this.value)" onchange="altinConverter(this.id,this.value)">
                                                                    </div>
                                                                    <div class="Ons">
                                                                      <h2>Ons </h2>
                                                                      <input id="inputONS"  type="number" oninput="altinConverter(this.id,this.value)" onchange="altinConverter(this.id,this.value)">
                                                                    </div>
                                                                	<div class="Sterlin">
                                                                      <h2>Cumhuriyet Altını</h2>
                                                                      <input id="inputCA"  type="number" oninput="altinConverter(this.id,this.value)" onchange="altinConverter(this.id,this.value)">
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                       
                                        
                                        <script>function dovizConverter(source,valNum) {
                                      valNum = parseFloat(valNum);
                                      var inputTL = document.getElementById("inputTL");
                                      var inputDLR = document.getElementById("inputDLR");
                                      var inputEUR = document.getElementById("inputEUR");
                                      var inputSTR = document.getElementById("inputSTR");
                                      if (source=="inputTL") {
                                        inputDLR.value=(valNum/<?php echo noktacevir($result[0]['satis']); ?>).toFixed(4);
                                        inputEUR.value=(valNum/<?php echo noktacevir($result[1]['satis']); ?>).toFixed(4);
                                        inputSTR.value=(valNum/<?php echo noktacevir($result[2]['satis']); ?>).toFixed(4);
                                      }
                                      if (source=="inputDLR") {
                                        inputTL.value=(valNum*<?php echo noktacevir($result[0]['satis']); ?>).toFixed(4);
                                        inputEUR.value=((valNum*<?php echo noktacevir($result[0]['satis']); ?>)/<?php echo noktacevir($result[1]['satis']); ?>).toFixed(4);
                                        inputSTR.value=((valNum*<?php echo noktacevir($result[0]['satis']); ?>)/<?php echo noktacevir($result[2]['satis']); ?>).toFixed(4);
                                      }
                                      if (source=="inputEUR") {
                                        inputTL.value=(valNum*<?php echo noktacevir($result[1]['satis']); ?>).toFixed(4);
                                        inputDLR.value=((valNum*<?php echo noktacevir($result[1]['satis']); ?>)/<?php echo noktacevir($result[0]['satis']); ?>).toFixed(4);
                                        inputSTR.value=((valNum*<?php echo noktacevir($result[1]['satis']); ?>)/<?php echo noktacevir($result[2]['satis']); ?>).toFixed(4);
                                      }
                                      if (source=="inputSTR") {
                                        inputTL.value=(valNum*<?php echo noktacevir($result[2]['satis']); ?>).toFixed(4);
                                        inputDLR.value=((valNum*<?php echo noktacevir($result[2]['satis']); ?>)/<?php echo noktacevir($result[0]['satis']); ?>).toFixed(4);
                                        inputEUR.value=((valNum*<?php echo noktacevir($result[2]['satis']); ?>)/<?php echo noktacevir($result[1]['satis']); ?>).toFixed(4);
                                      }
                                    }
                                    
                                        
                                    function altinConverter(source,valNum) {
                                      valNum = parseFloat(valNum);
                                      var inputT = document.getElementById("inputT");
                                      var inputGA = document.getElementById("inputGA");
                                      var inputONS = document.getElementById("inputONS");
                                      var inputCA = document.getElementById("inputCA");
                                      if (source=="inputT") {
                                        inputGA.value=(valNum/<?php echo noktacevir($altinfiyatal[1]['satis']); ?>).toFixed(4);
                                        inputONS.value=(valNum/<?php echo noktacevir($altinfiyatal[2]['satis'])*noktacevir($result[0]['satis']); ?>).toFixed(4);
                                        inputCA.value=(valNum/<?php echo noktacevir($altinfiyatal[0]['satis'])?>).toFixed(4);
                                      }
                                      if (source=="inputGA") {
                                        inputT.value=(valNum*<?php echo noktacevir($altinfiyatal[1]['satis']); ?>).toFixed(2);
                                        inputONS.value=((valNum*<?php echo noktacevir($altinfiyatal[1]['satis']); ?>)/(<?php echo noktacevir($altinfiyatal[2]['satis'])*noktacevir($result[0]['satis']); ?>)).toFixed(4);
                                        inputCA.value=((valNum*<?php echo noktacevir($altinfiyatal[1]['satis']); ?>)/<?php echo noktacevir($altinfiyatal[0]['satis']); ?>).toFixed(4);
                                      }
                                      if (source=="inputONS") {
                                        inputT.value=(valNum*(<?php echo noktacevir($altinfiyatal[2]['satis'])*noktacevir($result[0]['satis']); ?>)).toFixed(4);
                                        inputGA.value=((valNum*(<?php echo noktacevir($altinfiyatal[2]['satis'])*noktacevir($result[0]['satis']); ?>))/<?php echo noktacevir($altinfiyatal[1]['satis']); ?>).toFixed(4);
                                        inputCA.value=((valNum*(<?php echo noktacevir($altinfiyatal[2]['satis'])*noktacevir($result[0]['satis']); ?>))/<?php echo noktacevir($altinfiyatal[0]['satis']); ?>).toFixed(4);
                                      }
                                      if (source=="inputCA") {
                                        inputT.value=(valNum*<?php echo noktacevir($altinfiyatal[0]['satis']); ?>).toFixed(2);
                                        inputGA.value=((valNum*<?php echo noktacevir($altinfiyatal[0]['satis']); ?>)/<?php echo noktacevir($altinfiyatal[1]['satis']); ?>).toFixed(4);
                                        inputONS.value=((valNum*<?php echo noktacevir($altinfiyatal[0]['satis']); ?>)/(<?php echo noktacevir($altinfiyatal[2]['satis'])*noktacevir($result[0]['satis']); ?>)).toFixed(4);
                                      }
                                    }</script>
                                        </div>
        
                            <a href ="detay-faiz-oran.html" class="card-link" >
                            <div class="p-t-10">
                            <?php 
                                    $faizler = $db->query("SELECT * FROM faiz ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                                    ?>
    						<div class="bg12 p-rl-15 p-t-15 p-b-15 m-b-10">
    							<h5 class="f1-m-5 cl0 p-b-5">
    								FAİZ ORANI
    							</h5>
    							<p class="f1-s-10 cl0 p-b-5" style="text-align: center;">
    								<span style="font-size: 32px;"><?php echo $faizler["satis"]; ?> </span><span>%<?php echo $faizler["yuzde"]; ?></span>
    							</p>
                                <p class="f1-s-10 cl0 p-b-2" style="">
                                <span style="position: absolute; left: 190px;"><?php  echo date_format(date_create($faizler['tarih']), 'd.m.y'); ?></span>
    							</p>
    						
    						</div></a>
                            
                                <div class="flex-c-s p-t-8">
                                            <div class="p-t-10 p-b-10" style="width:100%;margin:auto;text-align:center;float:none;display:scroll;">
                                                    <?php echo $reklamkod["sliderana30060"]; ?>
                                                </div>
                                    
                                    
                                
                            </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
    
    
    <section class="bg0 p-t-20 p-b-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12 p-b-20">
                    <div class="how2 how2-cl5 flex-s-c m-r-10 m-r-0-sr991">
                        <h3 class="f1-m-2 cl3 tab01-title">
                           Demir Piyasası
                        </h3>
                    </div>
                   <div class="slider one-time" style="height: 100px;">
<?php
$demirkayar = $db->query("SELECT * FROM (SELECT * FROM demir WHERE kategori IN (1,2,3,4,5,8,11) ORDER BY id DESC LIMIT 7) AS T inner join demirkategori as ikinci on T.kategori = ikinci.kategori", PDO::FETCH_ASSOC);
if ( $demirkayar->rowCount() ){
     foreach( $demirkayar as $demirkayara ){
            ?>
            <div class="multiple">
            <div class="ovalkenar" style="height: 85px;">
                <a href="detay-demir-<?php echo $demirkayara["seo"]; ?>.html" class="card-link" style="position: relative;top: 5;">
                <table>
                      <tr>
                       <td rowspan="5"><img src="images/demir.png"></td>
                       
                      </tr>
                      <tr>
                            <td><i class="fas fa-map-marker-alt" style="color: #1f4a81;"></i></td>
                            <td style="color: black; font-weight: bold;"><?php echo $demirkayara["adi"]; ?></td>
                      </tr>
                      <tr>
                          <td style="color: black; font-weight: bold;">Ø08 </td>
                           <td style="color: black; font-weight: bold;">: <?php echo $demirkayara["sekizlik"]; ?><i class="fas fa-lira-sign" style="font-size: 11;"></i></td>
                      </tr>
                      <tr>
                           <td style="color: black; font-weight: bold;">Ø10 </td>
                           <td style="color: black; font-weight: bold;">: <?php echo $demirkayara["onluk"]; ?><i class="fas fa-lira-sign" style="font-size: 11;"></i></td>
                      </tr>
                      <tr>
                          <td style="color: black; font-weight: bold;">Ø12 </td>
                          <td style="color: black; font-weight: bold;">: <?php echo $demirkayara["satis"]; ?><i class="fas fa-lira-sign" style="font-size: 11;"></i></td>
                      </tr>
                </table>
                
                    </div>
                </a>
                </div>
                <?php
                }
            }?>
                <div class="multiple">
                <div class="ovalkenar" style="height: 85px;">
                    <a href="demir.html" class="card-link" style="position: relative;top: 5;">
                    <table>
                        <tr>
                             <td><img src="images/demir.png"></td>
                             <td><button type="button" class="btn btn-secondary">Tümü <i class="fas fa-chevron-right"></i></button></td>
                        </tr>
                    </table>
                    
                        </div>
                    </a>
                    </div>
    </div>
                </div>
            </div>
        </div>
    </section>
    
    
    <div class="container">
        <div class="flex-c-c">
                            <div class="p-t-10 p-b-10" style="width:100%;margin:auto;text-align:center;float:none;display:scroll;">
                               <?php echo $reklamkod["anasayfa720"]; ?>
                        </div>
                                                </div>
            
    </div>
    <section class="bg0 p-t-20 p-b-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8 p-b-20">
                    <div class="how2 how2-cl4 flex-s-c m-r-10 m-r-0-sr991">
                        <h3 class="f1-m-2 cl3 tab01-title">
                           TCMB Kurları
                        </h3>
                    </div>
                    <p class="f1-s-12 cl6 p-b-25"> Türkiye Cumhuriyeti Merkez Bankası Kur Bilgileri </p>
                    <table class="table table-borderless table-hover table-striped table-sm">
                    <tr>
                    <td id="kur_adi"><b>Kur Adı</b></td>
                    <td id="kur_alis"><b>Alış</b></td>
                    <td id="kur_satis"><b>Satış</b>
                    </td>
                    </tr>
                    <?php $tcmb= $db->prepare("SELECT * FROM tcmb WHERE id = 1");
    $tcmb->bindParam(1, $sira, PDO::PARAM_INT);
    $tcmb->execute();

    $tcmbtblo = $tcmb->fetch(PDO::FETCH_ASSOC); 

    echo $tcmbtblo["deger"];
	     
	     ?>
                    </table>
                </div>

                <div class="col-md-10 col-lg-4">
                    <div class="p-l-10 p-rl-0-sr991 p-b-2">
                        <div class="p-b-55">
                            <div>
                                <div class="wrap-pic-w pos-relative">
                                     <div class="p-t-10 p-b-10" style="width:100%;margin:auto;text-align:center;float:none;display:scroll;">
                                          <?php echo $reklamkod["sliderana300250"]; ?>
                                    </div>
                                
                                </div>

                            </div>  
                        </div>
                    </div>
                    
                    <div class="p-b-5">
                            <div class="how2 how2-cl3 flex-s-c m-b-30">
                                <h3 class="f1-m-2 cl3 tab01-title">
                                    Etiket
                                </h3>
                            </div>

                            <div class="flex-wr-s-s m-rl--5">
                                <?php echo etiketler(); ?>
                            </div>  
                        </div>
                </div>
            </div>
        </div>
    </section>
<?php
include ("footer.php");
?> 