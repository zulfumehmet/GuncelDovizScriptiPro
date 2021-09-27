<?php
include ("db.php");
$urlal = ''.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$sayfaadi = $_GET["tur"];
$gelendovizseo = $_GET["doviz"];
$site_adi = $genela['author'];
if (preg_match("/[\-]{2,}|[;]|[']|[\\\*]/", $gelendovizseo)){ header("Location:404.html");} else{}
if (preg_match("/[\-]{2,}|[;]|[']|[\\\*]/", $sayfaadi)){ header("Location:404.html");} else{}

switch ($sayfaadi) {
case "doviz":
    $ogtitle = '<meta property="og:title" content="Güncel döviz, ABD Dolar, Euro, İngiliz Sterlin, Kanada Doları, İsviçre Frangı ve daha bir çoğu '. $site_adi . ' adresinde">
    <meta property="og:image" content="/images/icons/iconp.png" />
    <meta property="og:url" content="'. $urlal .'" />
    ';
    $ubaslik="SERBEST PİYASA DÖVİZ KURLARI";
    $baslik="DÖVİZ";
    $renk = "how2-cl5";
    $dovizcek = $db->prepare("SELECT * FROM doviz INNER JOIN kategoridoviz ON doviz.kategori = kategoridoviz.kategorino where seo = '$gelendovizseo' limit 1");
    $dovizcek->bindParam(1, $sira, PDO::PARAM_INT);
    $dovizcek->execute();
    $dovizceka = $dovizcek->fetch(PDO::FETCH_ASSOC);
    $dovizadi = $dovizceka["kisaisim"];
    $dovizbirim = $dovizceka["birim"];
    $gelendoviz = $dovizceka["kategori"];
    if(isset($dovizceka["birim"])){}else{header("Location:404.html");}
    $baslama = $db->query("SELECT * FROM doviz WHERE tarih >= DATE_SUB( CURDATE( ) , INTERVAL 30 DAY ) AND kategori = $gelendoviz AND tarih <> '' ORDER BY tarih ASC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
    $mindeger = $db->query("SELECT Min(satis) As satis, min(tarih) As tarih From doviz Where tarih >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND kategori = $gelendoviz Group By satis, tarih Order By satis ASC Limit 1")->fetch(PDO::FETCH_ASSOC);
    $makdeger = $db->query("SELECT Max(satis) As satis, Max(tarih) As tarih From doviz Where tarih >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND kategori = $gelendoviz Group By satis, tarih Order By satis Desc Limit 1")->fetch(PDO::FETCH_ASSOC);
    $kur = "Kur";
    
break;
case "altin":
    $ogtitle = '<meta property="og:title" content="Güncel altın, ons, çeyrek altın, gram altın, reşat altını, bilezik, tam altın, cumguriyet altını '. $site_adi . ' adresinde">
    <meta property="og:image" content="/images/icons/iconp.png" />
    <meta property="og:url" content="'. $urlal .'" />';
    $ubaslik="GÜNCEL ALTIN FİYATLARI";
    $baslik="ALTIN";
    $renk = "how2-cl3";
    $dovizcek = $db->prepare("SELECT * FROM altin INNER JOIN altinkategori ON altin.kategori = altinkategori.kategorino where seo = '$gelendovizseo' limit 1");
    $dovizcek->bindParam(1, $sira, PDO::PARAM_INT);
    $dovizcek->execute();
    $dovizceka = $dovizcek->fetch(PDO::FETCH_ASSOC);
    $dovizadi = $dovizceka["cinsi"];
    $dovizbirim = $dovizceka["birim"];
    $gelendoviz = $dovizceka["kategori"];
    if(isset($dovizceka["birim"])){}else{header("Location:404.html");}
    $baslama = $db->query("SELECT * FROM altin WHERE tarih >= DATE_SUB( CURDATE( ) , INTERVAL 30 DAY ) AND kategori = $gelendoviz AND tarih <> '' ORDER BY tarih ASC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
    $mindeger = $db->query("SELECT Min(satis) As satis, min(tarih) As tarih From altin Where tarih >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND kategori = $gelendoviz Group By satis, tarih Order By satis ASC Limit 1")->fetch(PDO::FETCH_ASSOC);
    $makdeger = $db->query("SELECT Max(satis) As satis, Max(tarih) As tarih From altin Where tarih >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND kategori = $gelendoviz Group By satis, tarih Order By satis Desc Limit 1")->fetch(PDO::FETCH_ASSOC);
    $kur = "Kur";    
break;
case "kripto":
    $ogtitle = '<meta property="og:title" content="Güncel kripto paralar, Bitcoin ve diğerleri '. $site_adi . ' adresinde">
    <meta property="og:image" content="/images/icons/iconp.png" />
    <meta property="og:url" content="'. $urlal .'" />';
    $ubaslik="KRİPTO BORSASI";
    $baslik="KRİPTO PARALAR";
    $renk = "how2-cl4";
    $dovizcek = $db->prepare("SELECT * FROM kripto INNER JOIN kriptokategori ON kripto.kategori = kriptokategori.kategorino where seo = '$gelendovizseo' limit 1");
    $dovizcek->bindParam(1, $sira, PDO::PARAM_INT);
    $dovizcek->execute();
    $dovizceka = $dovizcek->fetch(PDO::FETCH_ASSOC);
    $dovizadi = $dovizceka["cinsi"];
    $dovizbirim = $dovizceka["birim"];
     $gelendoviz = $dovizceka["kategori"];
    if(isset($dovizceka["birim"])){}else{header("Location:404.html");}
    $baslama = $db->query("SELECT * FROM kripto WHERE tarih >= DATE_SUB( CURDATE( ) , INTERVAL 30 DAY ) AND kategori = $gelendoviz AND tarih <> '' ORDER BY tarih ASC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
    $mindeger = $db->query("SELECT Min(satis) As satis, min(tarih) As tarih From kripto Where tarih >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND kategori = $gelendoviz Group By satis, tarih Order By satis ASC Limit 1")->fetch(PDO::FETCH_ASSOC);
    $makdeger = $db->query("SELECT Max(satis) As satis, Max(tarih) As tarih From kripto Where tarih >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND kategori = $gelendoviz Group By satis, tarih Order By satis Desc Limit 1")->fetch(PDO::FETCH_ASSOC);
    $kur = "Kur"; 
break;
case "borsa":
    $ogtitle = '<meta property="og:title" content="Güncel Borsa İstanbul 100 endeksi '. $site_adi . ' adresinde">
    <meta property="og:image" content="/images/icons/iconp.png" />
    <meta property="og:url" content="'. $urlal .'" />';
    $ubaslik="BORSA BİLGİLERİ";
    $baslik="BORSA";
    $gelendoviz = 1;
    if($_GET["doviz"] == "endeks"){}else{header("Location:404.html");}
    $renk = "how2-cl5";
    $dovizadi = "BİST";
    $dovizbirim = "%";
    $kur = "Endeks";
break;
case "faiz":
    $ogtitle = '<meta property="og:title" content="Güncel faiz oranları '. $site_adi . ' adresinde">
    <meta property="og:image" content="/images/icons/iconp.png" />
    <meta property="og:url" content="'. $urlal .'" />';
    $ubaslik="FAZİ BİLGİLERİ";
    $baslik="EKONOMİ";
    $renk = "how2-cl5";
    $dovizadi = "Faiz";
    if($_GET["doviz"] == "oran"){}else{header("Location:404.html");}
    $dovizbirim = "%";
    $kur = "Endeks";
break;
case "demir":
    $ogtitle = '<meta property="og:title" content="Güncel inşaat demir fiyatları '. $site_adi . ' adresinde">
    <meta property="og:image" content="/images/icons/iconp.png" />
    <meta property="og:url" content="'. $urlal .'" />';
    $ubaslik="GÜNCEL DEMİR FİYATLARI";
    $baslik="EKONOMİ";
    $renk = "how2-cl5";
    $dovizadi = "Demir";
    $dovizbirim = "TL";
    $kur = "Endeks";
break;
case "emtia":
    $ogtitle = '<meta property="og:title" content="Güncel Brent Petolü, gümüş ve diğer emtiya değerleri '. $site_adi . ' adresinde">
    <meta property="og:image" content="/images/icons/iconp.png" />
    <meta property="og:url" content="'. $urlal .'" />';
    $ubaslik="GÜNCEL EMTİA FİYATLARI";
    $baslik="EMTİYALAR";
    $renk = "how2-cl6";
    $dovizcek = $db->prepare("SELECT * FROM emtia INNER JOIN emtiakategori ON emtia.kategori = emtiakategori.kategorino where seo = '$gelendovizseo' limit 1");
    $dovizcek->bindParam(1, $sira, PDO::PARAM_INT);
    $dovizcek->execute();
    $dovizceka = $dovizcek->fetch(PDO::FETCH_ASSOC);
    $dovizadi = $dovizceka["cinsi"];
    $dovizbirim = $dovizceka["birim"];
    $gelendoviz = $dovizceka["kategori"];
    if(isset($dovizceka["birim"])){}else{header("Location:404.html");}
    $baslama = $db->query("SELECT * FROM emtia WHERE tarih >= DATE_SUB( CURDATE( ) , INTERVAL 30 DAY ) AND kategori = $gelendoviz AND tarih <> '' ORDER BY tarih ASC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
    $mindeger = $db->query("SELECT Min(satis) As satis, min(tarih) As tarih From emtia Where tarih >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND kategori = $gelendoviz Group By satis, tarih Order By satis ASC Limit 1")->fetch(PDO::FETCH_ASSOC);
    $makdeger = $db->query("SELECT Max(satis) As satis, Max(tarih) As tarih From emtia Where tarih >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND kategori = $gelendoviz Group By satis, tarih Order By satis Desc Limit 1")->fetch(PDO::FETCH_ASSOC);
    $kur = "Kur";
break;
default:
    header("Location:404.html");
    
}
include ("header.php");

?>

	<!-- Content -->
	<section class="bg0 p-b-10 p-t-10">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-10 col-lg-8 p-b-30">
					<div class="p-r-10 p-r-0-sr991">
					     <div class="p-t-10 p-b-10" style="width:100%;margin:auto;text-align:center;float:none;display:scroll;">
                                         <?php echo $reklamkod["dovizust"]; ?>
                                    </div>
						<!-- Blog Detail -->
						<div class="p-b-30">
							<div class="how2 <?php echo $renk; ?> flex-s-c">
								<h3 class="f1-m-2 cl3 tab01-title">
								<?php echo $ubaslik; ?>
								</h3>
							</div>
							
                            <div class="container">
                                <div class="flex-c-c p-t-5">
                            
                                </div>
                            </div>
					<?php if ($sayfaadi == "faiz"){ ?> 
					
						<div class="container">
						    <div class="tab01 p-b-5 p-t-5">
                            <div class="tab01-head how2 bocl12 flex-s-c m-r-10 m-r-0-sr991">
                               
                                 <ul class="nav navbar-right nav-tabs justify-content-end">
                                    <li class="nav-item"><a href="#buhafta" class="nav-link active text-dark" data-toggle="tab">Bir Hafta</a></li>
                                    <li class="nav-item"><a href="#buay" class="nav-link text-dark" data-toggle="tab">Bir Ay</a></li>
                                    <li class="nav-item"><a href="#buyil" class="nav-link text-dark" data-toggle="tab">Bir Yıl</a></li>
                                    <li class="nav-item-more dropdown dis-none">
										<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
											<i class="fa fa-ellipsis-h"></i>
										</a>

										<ul class="dropdown-menu">
											
										</ul>
									</li>
                                  </ul>
                            </div></div>
     
      
      <div class="tab-content">
       <div id="buhafta" class="tab-pane fade show active">
          <figure class="highcharts-figure">
                <div id="buhafta"></div>
            </figure>
      <script language = "JavaScript">
     Highcharts.getJSON(
    'grafikdata-<?php echo $sayfaadi; ?>-1-7.json',
    function (data) {

        Highcharts.chart('buhafta', {
            chart: {
                zoomType: 'x'
            },
            title: {
                text: '<?php echo $dovizadi. "/".$dovizbirim; ?>'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Büyütmek için grafiği seçin' : 'Yakınlaştırmak için grafiği seçin'
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                     enabled: false
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[2]],
                            [1, Highcharts.color(Highcharts.getOptions().colors[2]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                name: '<?php echo $kur; ?>',
                type: 'area',
                data: data
            }]
        });
    }
);
      </script>
           </div>
           <div id="buay" class="tab-pane fade">
          <figure class="highcharts-figure">
    <div id="buay"></div>
</figure>
      <script language = "JavaScript">
     Highcharts.getJSON(
    'grafikdata-<?php echo $sayfaadi; ?>-1-30.json',
    function (data) {

        Highcharts.chart('buay', {
            chart: {
                zoomType: 'x'
            },
            title: {
                text: '<?php echo $dovizadi. "/".$dovizbirim; ?>'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Büyütmek için grafiği seçin' : 'Yakınlaştırmak için grafiği seçin'
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    enabled: false
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[2]],
                            [1, Highcharts.color(Highcharts.getOptions().colors[2]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                name: '<?php echo $kur; ?>',
                type: 'area',
                data: data
            }]
        });
    }
);
      </script>
           </div>
        <div id="buyil" class="tab-pane fade">
          <figure class="highcharts-figure">
    <div id="buyil"></div>
</figure>
      <script language = "JavaScript">
     Highcharts.getJSON(
    'grafikdata-<?php echo $sayfaadi; ?>-1-364.json',
    function (data) {

        Highcharts.chart('buyil', {
            chart: {
                zoomType: 'x'
            },
            title: {
                text: '<?php echo $dovizadi. "/".$dovizbirim; ?>'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Büyütmek için grafiği seçin' : 'Yakınlaştırmak için grafiği seçin'
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                     enabled: false
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[2]],
                            [1, Highcharts.color(Highcharts.getOptions().colors[2]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                name: '<?php echo $kur; ?>',
                type: 'area',
                data: data
            }]
        });
    }
);
      </script>
           </div>
      </div>
   </div>
							<!-- Share -->
							<div class="flex-s-s">
								<span class="f1-s-12 cl5 p-t-1 m-r-15">
                                <p><span>Not:</span> Piyasaların kapalı olduğu günlerde veri akışı yapılmamaktadır.</p></span>
                                    							
							</div>
					
					<?php // faiz son 
					}elseif($sayfaadi == "demir"){ 
					    
					//demir baslama //?>
					    <div class="container">
					        <div class="row">
                                                    <div class="col-12 col-sm-5">
                                                        <form class="select">
                                                               <select onchange="if (this.value) window.location.href=this.value">
                                                                                    <option value="">Seçiniz</option>
                                                                                <?php 
                                                                                   $demirtablo = $db->query("SELECT * FROM (SELECT * FROM demir WHERE kategori IN (1,2,3,4,5,6,7,8,9,10,11,12,13) ORDER BY id DESC LIMIT 13) AS T inner join demirkategori as ikinci on T.kategori = ikinci.kategori", PDO::FETCH_ASSOC);
                                                                                        if ( $demirtablo->rowCount() ){
                                                                                            foreach( $demirtablo as $demirtabloa ){ ?>
                                                                                
                                                                                     <option value="detay-demir-<?php echo $demirtabloa['seo'] ?>.html" <?php if($gelendovizseo == $demirtabloa['seo']){echo "selected";}else{} ?>><?php echo $demirtabloa['adi'];?></option>
                                                                                  <?php }} ?></select> </form>
                                                                                 
                                                            </div>
                                                            <div class="col-12 col-sm-7">
                                                                      <?php switch ($gelendovizseo){
                                                                                        case "ankara": $demirtip = "1"; break;
                                                                                        case "istanbul": $demirtip = "2"; break;
                                                                                        case "izmir": $demirtip = "3"; break;
                                                                                        case "iskenderun": $demirtip = "4"; break;
                                                                                        case "konya": $demirtip = "5"; break;
                                                                                        case "kayseri": $demirtip = "6"; break;
                                                                                        case "karabuk": $demirtip = "7"; break;
                                                                                        case "samsun": $demirtip = "8"; break;
                                                                                        case "biga": $demirtip = "9"; break;
                                                                                        case "sivas": $demirtip = "10"; break;
                                                                                        case "diyarbakir": $demirtip = "11"; break;
                                                                                        case "mardin": $demirtip = "12"; break;
                                                                                        case "van": $demirtip = "13"; break;
                                                                                        default: header("Location:404.html");
                                                                                        }?>
                                                                <?php $dovizsatisbilgisi = $db->query("SELECT * FROM demir WHERE kategori = '{$demirtip}' order by id DESC limit 1")->fetch(PDO::FETCH_ASSOC);?>
                                                                <table class="table table-borderless">
                                                                  <thead>
                                                                    <tr style="font-size: 17px;">
                                                                      <th scope="col">Satış : <?php echo $dovizsatisbilgisi['satis']; ?><i class="fas fa-lira-sign" style="font-size: 12px;"></i></th>
                                                                     </tr>
                                                                  </thead>
                                                                 </table>
                                                              </div>
                                                          </div>
					        
					        <div class="tab01 p-b-5 p-t-5">
                            <div class="tab01-head how2 bocl12 flex-s-c m-r-10 m-r-0-sr991">
                                                               <ul class="nav navbar-right nav-tabs justify-content-end">
                                    <li class="nav-item"><a href="#buhafta" class="nav-link active text-dark" data-toggle="tab">Bir Hafta</a></li>
                                    <li class="nav-item"><a href="#buay" class="nav-link text-dark" data-toggle="tab">Bir Ay</a></li>
                                    <li class="nav-item"><a href="#buyil" class="nav-link text-dark" data-toggle="tab">Bir Yıl</a></li>
                                    <li class="nav-item-more dropdown dis-none">
										<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
											<i class="fa fa-ellipsis-h"></i>
										</a>

										<ul class="dropdown-menu">
											
										</ul>
									</li>
                                  </ul>
                            </div></div>
      <div class="tab-content">
       <div id="buhafta" class="tab-pane fade show active">
          <figure class="highcharts-figure">
                <div id="buhafta"></div>
            </figure>
      <script language = "JavaScript">
     Highcharts.getJSON(
    'grafikdata-<?php echo $sayfaadi; ?>-<?php echo $demirtip ?>-7.json',
    function (data) {

        Highcharts.chart('buhafta', {
            chart: {
                zoomType: 'x'
            },
            title: {
                text: '<?php echo $dovizadi. "/".$dovizbirim; ?>'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Büyütmek için grafiği seçin' : 'Yakınlaştırmak için grafiği seçin'
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                     enabled: false
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[2]],
                            [1, Highcharts.color(Highcharts.getOptions().colors[2]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                name: '<?php echo $kur; ?>',
                type: 'area',
                data: data
            }]
        });
    }
);
      </script>
           </div>
           <div id="buay" class="tab-pane fade">
          <figure class="highcharts-figure">
    <div id="buay"></div>
</figure>
      <script language = "JavaScript">
     Highcharts.getJSON(
    'grafikdata-<?php echo $sayfaadi. '-' . $demirtip; ?>-30.json',
    function (data) {

        Highcharts.chart('buay', {
            chart: {
                zoomType: 'x'
            },
            title: {
                text: '<?php echo $dovizadi. "/".$dovizbirim; ?>'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Büyütmek için grafiği seçin' : 'Yakınlaştırmak için grafiği seçin'
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                     enabled: false
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[2]],
                            [1, Highcharts.color(Highcharts.getOptions().colors[2]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                name: '<?php echo $kur; ?>',
                type: 'area',
                data: data
            }]
        });
    }
);
      </script>
           </div>
        <div id="buyil" class="tab-pane fade">
          <figure class="highcharts-figure">
    <div id="buyil"></div>
</figure>
      <script language = "JavaScript">
     Highcharts.getJSON(
    'grafikdata-<?php echo $sayfaadi . '-' . $demirtip; ?>-364.json',
    function (data) {

        Highcharts.chart('buyil', {
            chart: {
                zoomType: 'x'
            },
            title: {
                text: '<?php echo $dovizadi. "/".$dovizbirim; ?>'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Büyütmek için grafiği seçin' : 'Yakınlaştırmak için grafiği seçin'
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    enabled: false
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[2]],
                            [1, Highcharts.color(Highcharts.getOptions().colors[2]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                name: '<?php echo $kur; ?>',
                type: 'area',
                data: data
            }]
        });
    }
);
      </script>
           </div>
      </div>
   </div>
							<!-- Share -->
							<div class="flex-s-s">
								<span class="f1-s-12 cl5 p-t-1 m-r-15">
                                <p><span>Not:</span> Piyasaların kapalı olduğu günlerde veri akışı yapılmamaktadır. Grafik Ø12-32 demir fiyatını göstermektedir. </p></span>
                                    							
							</div>
					
					    
					    
					    <?php //demirson
					    }else{ 
					// diger sayfalar basla ?>
					
						<div class="container">
						    <?php switch ($sayfaadi) {
                                                    case 'doviz': ?>
                                                          <div class="row">
                                                            <div class="col-12 col-sm-5">
                                                              
                                                        <form class="select">
                                                               <select onchange="if (this.value) window.location.href=this.value">
                                                                                    <option value="">Seçiniz</option>
                                                                                <?php 
                                                                                   $dovizlistecek = $db->query("SELECT * FROM
                                                                                                            (SELECT * FROM doviz WHERE kategori IN (1,2,3,4,5,6,7,8,9,10,11,12,13) ORDER BY id DESC LIMIT 13) AS T inner join kategoridoviz as ikinci on T.kategori = ikinci.kategorino ORDER BY kategorino ASC", PDO::FETCH_ASSOC);
                                                                                        if ( $dovizlistecek->rowCount() ){
                                                                                            foreach( $dovizlistecek as $dovizlisteceka ){ ?>
                                                                                
                                                                                    <option value="detay-doviz-<?php echo $dovizlisteceka['seo'] ?>.html" <?php if($gelendovizseo == $dovizlisteceka['seo']){echo "selected";}else{} ?>><?php echo $dovizlisteceka['cinsi'];?></option>
                                                                                 <?php }} ?></select> </form>
                                                                                 
                                                            </div>
                                                            <div class="col-12 col-sm-7">
                                                                <?php $dovizsatisbilgisi = $db->query("SELECT * FROM doviz WHERE kategori = '{$gelendoviz}' order by id DESC limit 1")->fetch(PDO::FETCH_ASSOC);?>
                                                                <table class="table table-borderless">
                                                                  <thead>
                                                                    <tr style="font-size: 17px;">
                                                                      <th scope="col">Alış : <?php echo  number_format($dovizsatisbilgisi['alis'], 4, ',', '.'); ?><i class="fas fa-lira-sign" style="font-size: 12px;"></i></th>
                                                                      <th scope="col">Satış : <?php echo number_format($dovizsatisbilgisi['satis'], 4, ',', '.'); ?><i class="fas fa-lira-sign" style="font-size: 12px;"></i></th>
                                                                      
                                                                    </tr>
                                                                  </thead>
                                                                 </table>
                                                              </div>
                                                          </div>
                                                <?php break;
                                                    case "altin": ?>
                                                         <div class="row">
                                                            <div class="col-12 col-sm-5">
                                                              
                                                        <form class="select">
                                                               <select onchange="if (this.value) window.location.href=this.value">
                                                                                    <option value="">Seçiniz</option>
                                                                                <?php 
                                                                                   $dovizlistecek = $db->query("SELECT * FROM
                                                                                                                    (SELECT *  FROM altin WHERE kategori IN (1,2,3,4,5,6,7,8,9) ORDER BY id DESC LIMIT 9) AS T inner join altinkategori as ikinci on T.kategori = ikinci.kategorino ORDER BY kategorino ASC", PDO::FETCH_ASSOC);
                                                                                        if ( $dovizlistecek->rowCount() ){
                                                                                            foreach( $dovizlistecek as $dovizlisteceka ){ ?>
                                                                                
                                                                                    <option value="detay-altin-<?php echo $dovizlisteceka['seo'] ?>.html" <?php if($gelendovizseo == $dovizlisteceka['seo']){echo "selected";}else{} ?>><?php echo $dovizlisteceka['cinsi'];?></option>
                                                                                 <?php }} ?></select> </form>
                                                                                 
                                                            </div>
                                                            <div class="col-12 col-sm-7">
                                                                <?php $dovizsatisbilgisi = $db->query("SELECT * FROM altin WHERE kategori = '{$gelendoviz}' order by id DESC limit 1")->fetch(PDO::FETCH_ASSOC);?>
                                                                <table class="table table-borderless">
                                                                  <thead>
                                                                    <tr style="font-size: 17px;">
                                                                      <th scope="col">Alış : <?php if($gelendovizseo == "ons"){echo "$";}else{}?><?php echo  number_format($dovizsatisbilgisi['alis'], 2, ',', '.'); ?> <?php if($gelendovizseo == "ons"){}else{echo '<i class="fas fa-lira-sign" style="font-size: 12px;"></i>';}?></th>
                                                                      <th scope="col">Satış : <?php if($gelendovizseo == "ons"){echo "$";}else{}?><?php echo number_format($dovizsatisbilgisi['satis'], 2, ',', '.'); ?> <?php if($gelendovizseo == "ons"){}else{echo '<i class="fas fa-lira-sign" style="font-size: 12px;"></i>';}?></th>
                                                                      
                                                                    </tr>
                                                                  </thead>
                                                                 </table>
                                                              </div>
                                                          </div>
                                                      <?php  break;
                                                    case "emtia": ?>
                                                                    <div class="row">
                                                                            <div class="col-12 col-sm-5">
                                                                              
                                                                        <form class="select">
                                                                               <select onchange="if (this.value) window.location.href=this.value">
                                                                                                    <option value="">Seçiniz</option>
                                                                                                <?php 
                                                                                                   $dovizlistecek = $db->query("SELECT * FROM 
                                                                                                                                (SELECT * FROM emtia WHERE kategori IN (1,2,3,4) ORDER BY id DESC LIMIT 4) AS T inner join emtiakategori as ikinci on T.kategori = ikinci.kategorino", PDO::FETCH_ASSOC);
                                                                                                        if ( $dovizlistecek->rowCount() ){
                                                                                                            foreach( $dovizlistecek as $dovizlisteceka ){ ?>
                                                                                                
                                                                                                    <option value="detay-emtia-<?php echo $dovizlisteceka['seo'] ?>.html" <?php if($gelendovizseo == $dovizlisteceka['seo']){echo "selected";}else{} ?>><?php echo $dovizlisteceka['cinsi'];?></option>
                                                                                                 <?php }} ?></select> </form>
                                                                                                 
                                                                            </div>
                                                                            <div class="col-12 col-sm-7">
                                                                                <?php $dovizsatisbilgisi = $db->query("SELECT * FROM emtia WHERE kategori = '{$gelendoviz}' order by id DESC limit 1")->fetch(PDO::FETCH_ASSOC);?>
                                                                                <table class="table table-borderless">
                                                                                  <thead>
                                                                                    <tr style="font-size: 17px;">
                                                                                      <th scope="col">Alış : $<?php echo  $dovizsatisbilgisi['alis']; ?></th>
                                                                                      <th scope="col">Satış : $<?php echo $dovizsatisbilgisi['satis']; ?></th>
                                                                                      
                                                                                    </tr>
                                                                                  </thead>
                                                                                 </table>
                                                                              </div>
                                                                          </div>
                                                    
                                                       <?php break;
                                                    case "kripto": ?>
                                                                    <div class="row">
                                                                                            <div class="col-12 col-sm-5">
                                                                                              
                                                                                        <form class="select">
                                                                                               <select onchange="if (this.value) window.location.href=this.value">
                                                                                                                    <option value="">Seçiniz</option>
                                                                                                                <?php 
                                                                                                                   $dovizlistecek = $db->query("SELECT * FROM
                                                                                                                                                    (SELECT *  FROM kripto WHERE kategori IN (1,2,3,4,5,6,7,8,9,10) ORDER BY id DESC LIMIT 10) AS T inner join kriptokategori as ikinci on T.kategori = ikinci.kategorino ORDER BY kategorino ASC", PDO::FETCH_ASSOC);
                                                                                                                        if ( $dovizlistecek->rowCount() ){
                                                                                                                            foreach( $dovizlistecek as $dovizlisteceka ){ ?>
                                                                                                                
                                                                                                                    <option value="detay-kripto-<?php echo $dovizlisteceka['seo'] ?>.html" <?php if($gelendovizseo == $dovizlisteceka['seo']){echo "selected";}else{} ?>><?php echo $dovizlisteceka['cinsi'];?></option>
                                                                                                                 <?php }} ?></select> </form>
                                                                                                                 
                                                                                            </div>
                                                                                            <div class="col-12 col-sm-7">
                                                                                                <?php $dovizsatisbilgisi = $db->query("SELECT * FROM kripto WHERE kategori = '{$gelendoviz}' order by id DESC limit 1")->fetch(PDO::FETCH_ASSOC);
                                                                                                      $dolarkactl = $db->query("SELECT * FROM doviz WHERE kategori = 1 order by id DESC limit 1")->fetch(PDO::FETCH_ASSOC);
                                                                                                ?>
                                                                                                <table class="table table-borderless">
                                                                                                  <thead>
                                                                                                    <tr style="font-size: 17px;">
                                                                                                      <th scope="col">Satış : $<?php echo  number_format($dovizsatisbilgisi['satis'], 2,".",","); ?></th>
                                                                                                      <th scope="col"><?php echo $dovizceka["kisaisim"]; ?>/TL : <?php  $krtpkactl = $dovizsatisbilgisi['satis']*$dolarkactl['satis']; echo number_format($krtpkactl, 2,".",",");?><i class="fas fa-lira-sign" style="font-size: 12px;"></i></th>
                                                                                                      
                                                                                                    </tr>
                                                                                                  </thead>
                                                                                                 </table>
                                                                                              </div>
                                                                                          </div>
                                                    
                                                    
                                                    
                                                        <?php break;
                                                    default:
                                                        echo "";
                                                    } 
                                    ?>
						    <div class="tab01 p-b-5 p-t-5">
                            <div class="tab01-head how2 bocl12 flex-s-c m-r-10 m-r-0-sr991">
                                  <ul class="nav navbar-right nav-tabs justify-content-end">
                                    <li class="nav-item"><a href="#bugun" class="nav-link active text-dark" data-toggle="tab">Bugün</a></li>
                                    <li class="nav-item"><a href="#buhafta" class="nav-link text-dark" data-toggle="tab">Bir Hafta</a></li>
                                    <li class="nav-item"><a href="#buay" class="nav-link text-dark" data-toggle="tab">Bir Ay</a></li>
                                    <li class="nav-item"><a href="#buyil" class="nav-link text-dark" data-toggle="tab">Bir Yıl</a></li>
                                    <li class="nav-item-more dropdown dis-none">
										<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
											<i class="fa fa-ellipsis-h"></i>
										</a>

										<ul class="dropdown-menu">
											
										</ul>
									</li>
                                  </ul>
                            </div></div>
      <div class="tab-content">
        <div id="bugun" class="tab-pane fade show active">
          <figure class="highcharts-figure">
    <div id="bugun"></div>
</figure>
      <script language = "JavaScript">
     Highcharts.getJSON(
    'grafikdata-<?php echo $sayfaadi; ?>-<?php echo $gelendoviz; ?>-1.json',
    function (data) {

        Highcharts.chart('bugun', {
            chart: {
                zoomType: 'x'
            },
            title: {
                text: '<?php echo $dovizadi. "/".$dovizbirim; ?>'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Büyütmek için grafiği seçin' : 'Yakınlaştırmak için grafiği seçin'
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                     enabled: false
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[2]],
                            [1, Highcharts.color(Highcharts.getOptions().colors[2]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                name: '<?php echo $kur; ?>',
                type: 'area',
                data: data
            }]
        });
    }
);
      </script>

</div>
<div id="buhafta" class="tab-pane fade">
          <figure class="highcharts-figure">
    <div id="buhafta"></div>
</figure>
      <script language = "JavaScript">
     Highcharts.getJSON(
    'grafikdata-<?php echo $sayfaadi; ?>-<?php echo $gelendoviz; ?>-7.json',
    function (data) {

        Highcharts.chart('buhafta', {
            chart: {
                zoomType: 'x'
            },
            title: {
                text: '<?php echo $dovizadi. "/".$dovizbirim; ?>'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Büyütmek için grafiği seçin' : 'Yakınlaştırmak için grafiği seçin'
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                     enabled: false
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[2]],
                            [1, Highcharts.color(Highcharts.getOptions().colors[2]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                name: '<?php echo $kur; ?>',
                type: 'area',
                data: data
            }]
        });
    }
);
      </script>
           </div>
           <div id="buay" class="tab-pane fade">
          <figure class="highcharts-figure">
    <div id="buay"></div>
</figure>
      <script language = "JavaScript">
     Highcharts.getJSON(
    'grafikdata-<?php echo $sayfaadi; ?>-<?php echo $gelendoviz; ?>-30.json',
    function (data) {

        Highcharts.chart('buay', {
            chart: {
                zoomType: 'x'
            },
            title: {
                text: '<?php echo $dovizadi. "/".$dovizbirim; ?>'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Büyütmek için grafiği seçin' : 'Yakınlaştırmak için grafiği seçin'
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                     enabled: false
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[2]],
                            [1, Highcharts.color(Highcharts.getOptions().colors[2]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                name: '<?php echo $kur; ?>',
                type: 'area',
                data: data
            }]
        });
    }
);
      </script>
           </div>
        <div id="buyil" class="tab-pane fade">
          <figure class="highcharts-figure">
    <div id="buyil"></div>
</figure>
      <script language = "JavaScript">
     Highcharts.getJSON(
    'grafikdata-<?php echo $sayfaadi; ?>-<?php echo $gelendoviz; ?>-364.json',
    function (data) {

        Highcharts.chart('buyil', {
            chart: {
                zoomType: 'x'
            },
            title: {
                text: '<?php echo $dovizadi. "/".$dovizbirim; ?>'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Büyütmek için grafiği seçin' : 'Yakınlaştırmak için grafiği seçin'
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                     enabled: false
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[2]],
                            [1, Highcharts.color(Highcharts.getOptions().colors[2]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                name: '<?php echo $kur; ?>',
                type: 'area',
                data: data
            }]
        });
    }
);
      </script>
           </div>
      </div>
   </div>
							<!-- Share -->
							<div class="flex-s-s">
								<span class="f1-s-12 cl5 p-t-1 m-r-15">
                                <?php if($sayfaadi == "borsa"){
                                            echo "<p><span>Not:</span> Piyasaların kapalı olduğu günlerde veri akışı yapılmamaktadır.</p>";
                                        } else 
                                    { ?>
                                    <p><span>Not:</span> Piyasaların kapalı olduğu günlerde veri akışı yapılmamaktadır.</p>
                                    <p>Son bir ay içinde <?php if ($dovizbirim == "$"){echo "$";} else {}
                                    echo  $baslama["satis"]; ?><?php if ($dovizbirim == "TL"){echo '<i class="fas fa-lira-sign" style="font-size: 12px;"></i>';} else {}; ?> ile işleme başlayan <?php echo $dovizadi; ?>, <?php echo date_format(date_create($mindeger['tarih']), 'd/m/Y'); ?> tarihinde <?php if ($dovizbirim == "$"){echo "$";} else {} ?><?php echo  $mindeger["satis"]; if ($dovizbirim == "TL"){echo '<i class="fas fa-lira-sign" style="font-size: 12px;"></i>';} else {}?> ile son bir ayın en düşük, <br/>
                                    <?php echo date_format(date_create($makdeger['tarih']), 'd/m/Y'); ?> tarihinde ise <?php if ($dovizbirim == "$"){echo "$";} else {} echo  $makdeger["satis"]; if ($dovizbirim == "TL"){echo '<i class="fas fa-lira-sign" style="font-size: 12px;"></i>';} else {} ?> ile son bir ayın en yüksek değerinden işlem gördü.</p>							
                                    <?php } ?></span>
                                    							
							</div>
					
					<?php } ?>
						</div>

						<!-- Leave a comment -->
						<div>
                            <div class="how2 how2-cl2 flex-s-c">
								<h3 class="f1-m-2 cl3 tab01-title">
								Yorumlar
								</h3>
							</div>
                            <?php echo $genela["yorum"];?>
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
                                        case "faiz":
                                            $katbaslik=1;
                                            break;
                                        default:
                                            $katbaslik=1;
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

	<!-- Footer -->
	<?php include("footer.php"); ?>