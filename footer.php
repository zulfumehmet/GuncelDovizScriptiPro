 <section class="bg0 p-t-0 p-b-2">
    <div class="container">
        <div class="flex-c-c">
            <div class="p-t-10 p-b-10" style="width:100%;margin:auto;text-align:center;float:none;display:scroll;">
                                         <?php echo $reklamkod["footer720"]; ?>
                                    </div>
        
        </div>
    </div>
</section>
    <footer>
        <div class="bg12 p-t-0 p-b-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 p-b-20">
                        <div class="size-h-3 flex-s-c p-t-5">
                            <a href="index.html">
                                <img class="max-s-full" src="images/icons/logo-01.png" alt="<?php echo $genela["descv"];?>">
                            </a>
                        </div>

                        <div>
                            <p class="f1-s-1 cl11 p-b-16">
                                <?php echo $genela["aciklama"];?>
                                </p>

                            <ul class="m-t--12">
                            <li class="how-bor1 p-rl-5 p-tb-10">
                                <a href="iletisim.html" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
                                    İletişim
                                </a>
                            </li>
                            </ul>

                            <div class="p-t-15">
                                <a href="<?php echo $genela["facebook"];?>" class="fs-18 cl11 hov-cl19 trans-03 m-r-8">
                                    <span class="fab fa-facebook-f"></span>
                                </a>

                                <a href="<?php echo $genela["twitter"];?>" class="fs-18 cl11 hov-cl20 trans-03 m-r-8">
                                    <span class="fab fa-twitter"></span>
                                </a>

                                <a href="<?php echo $genela["youtube"];?>" class="fs-18 cl11 hov-cl21 trans-03 m-r-8">
                                    <span class="fab fa-youtube"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4 p-b-20">
                        <div class="size-h-3 flex-s-c">
                            <h5 class="f1-m-7 cl0">
                                Son Haberler
                            </h5>
                        </div>

                        <ul>
                        <?php
                            $haberalt = $db->query("SELECT * FROM haberler  ORDER BY id DESC LIMIT 4", PDO::FETCH_ASSOC);
                            if ( $haberalt->rowCount() ){
                                 foreach( $haberalt as $haberalta ){
                                     ?>

                            <li class="flex-wr-sb-s p-b-20">
                                <a href="#" class="size-w-4 wrap-pic-w hov1 trans-03">
                                    <img src="haberler/<?php echo $haberalta["resim"]; ?>" alt="<?php echo $haberalta["baslik"]; ?>">
                                </a>

                                <div class="size-w-5">
                                    <h6 class="p-b-5">
                                        <a href="haber-<?php echo $haberalta["seo"]; ?>-<?php echo $haberalta["ID"]; ?>.html" class="f1-s-5 cl11 hov-cl10 trans-03">
                                        <?php echo mb_substr($haberalta["baslik"], 0, 50, 'UTF-8'); ?>
                                        </a>
                                    </h6>

                                    <span class="f1-s-3 cl11">
                                    <?php  echo date_format(date_create($haberalta['tarih']), 'd.m.y'); ?>
                                    </span>
                                </div>
                            </li>
                                 <?php }  
                                }?>
                        </ul>
                    </div>

                    <div class="col-sm-6 col-lg-4 p-b-20">
                        <div class="size-h-3 flex-s-c">
                            <h5 class="f1-m-7 cl0">
                                Haberler
                            </h5>
                        </div>

                        <ul class="m-t--12">
                            <li class="how-bor1 p-rl-5 p-tb-10">
                                <a href="habers-ekonomi.html" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
                                    Ekonomi
                                </a>
                            </li>

                            <li class="how-bor1 p-rl-5 p-tb-10">
                                <a href="habers-doviz.html" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
                                    Döviz
                                </a>
                            </li>

                            <li class="how-bor1 p-rl-5 p-tb-10">
                                <a href="habers-altin.html" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
                                    Altın
                                </a>
                            </li>

                            <li class="how-bor1 p-rl-5 p-tb-10">
                                <a href="habers-kriptopara-4.html" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
                                    Kripto Para
                                </a>
                            </li>
                            <li class="how-bor1 p-rl-5 p-tb-10">
                                <a href="habers-borsa.html" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
                                    Borsa
                                </a>
                            </li>
                            <li class="how-bor1 p-rl-5 p-tb-10">
                                <a href="habers-emtia.html" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
                                    Emtialar
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg11">
            <div class="container size-h-1 flex-c-c p-tb-15">
                <span class="f1-s-1 cl0 txt-center">Copyright © 2020 <a href="https://www.zulfumehmet.com/" class="f1-s-1 cl10 hov-link1">Zülfü Mehmet</a> Tüm Hakları Saklıdır</span><br>
                 </div>
        </div>
    </footer>
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <span class="fas fa-angle-up"></span>
        </span>
    </div>
    
	<link rel="stylesheet" type="text/css" href="fonts/fontawesome-5.0.8/css/fontawesome-all.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <script src="js/highcharts.js"></script>
    <script src="js/timeline.js"></script>
    <script src="js/data.js"></script>
    <script src="js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="slick/slick.js" type="text/javascript" charset="utf-8"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/uyari.js"></script>
    <script src="js/cookie.js"></script>
    <p style="font-size: 0pt; color: white;">Dolar, Euro, İngiliz Sterlini, Kanada Doları, İsviçre Frangı, Sudi Arabistan Riyali, 100 Japon Yeni, Avusturalya Doları, Norveç Kronu, Danimarka Kronu, İsveç Kronu, Kuveyt Dinarı, Rus Rublesi, Rumen Leyi, Katar Riyali, Pakistan Pupisi, Bulgar Levası, İran Riyali, Çin Yuanı, Kaç, TL, Yapar, Eder, Döviz Fiyatları, Güncel Döviz Kurları, forex, satış, exchange, currency, piyasam.net, piyasa, haberler, döviz, altın fiyatları, demir fiyatları</p>
           
</body>
</html>
<?php $db = null; ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-177951478-1"></script><script>window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'UA-177951478-1');</script>

<?php $html = ob_get_clean(); 
 echo preg_replace(array('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '/\r\n|\r|\n|\t|\s\s+/'), '', $html); ?>