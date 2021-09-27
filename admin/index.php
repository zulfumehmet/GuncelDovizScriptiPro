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
?>
	  <!-- Page Content -->
	  <div class="container">
	       <div class="row">
      <div class="col-lg-12 text-center">
        <h3>Veritabanında Kayıtlı Veri Sayısı</h3></h3>
      </div>
    </div>
	      
	  </div>
	  
  <div class="container">
  <div class="row">
      
                                  <div class="col-md">
                                                                           <div class="card text-white bg-success  mb-3" >
                                                                          <div class="card-header">Döviz</div>
                                                                          <div class="card-body">
                                                                            <h5 class="card-title">Kayıtlı Veri</h5>
                                                                            <p class="card-text"><?php $sorgu = $db->prepare("SELECT COUNT(*) FROM doviz");
                                                                                                                $sorgu->execute();
                                                                                                                $say = $sorgu->fetchColumn();
                                                                                                                echo  number_format($say, 0, ',', '.');
                                                                                    ?> Adet</p>
                                                                          </div>
                                                                        </div>
                                </div>
                                <div class="col-md">
                                                                         <div class="card text-white bg-warning mb-3" >
                                                                          <div class="card-header">Altın</div>
                                                                          <div class="card-body">
                                                                            <h5 class="card-title">Kayıtlı Veri</h5>
                                                                            <p class="card-text"><?php $asorgu = $db->prepare("SELECT COUNT(*) FROM altin");
                                                                                                                $asorgu->execute();
                                                                                                                $asay = $asorgu->fetchColumn();
                                                                                                                echo  number_format($asay, 0, ',', '.');
                                                                                    ?> Adet</p>
                                                                          </div>
                                                                        </div>
                                </div>
                                <div class="col-md">
                                                                          <div class="card text-white bg-primary mb-3" >
                                                                          <div class="card-header">Emtia</div>
                                                                          <div class="card-body">
                                                                            <h5 class="card-title">Kayıtlı Veri</h5>
                                                                            <p class="card-text"><?php $esorgu = $db->prepare("SELECT COUNT(*) FROM emtia");
                                                                                                                $esorgu->execute();
                                                                                                                $esay = $esorgu->fetchColumn();
                                                                                                                echo  number_format($esay, 0, ',', '.');
                                                                                    ?> Adet</p>
                                                                          </div>
                                                                        </div>
                                </div>
                                <div class="col-md">
                                                                          <div class="card text-white bg-danger mb-3" >
                                                                          <div class="card-header">Kripto Para</div>
                                                                          <div class="card-body">
                                                                            <h5 class="card-title">Kayıtlı Veri</h5>
                                                                            <p class="card-text"><?php $ksorgu = $db->prepare("SELECT COUNT(*) FROM kripto");
                                                                                                                $ksorgu->execute();
                                                                                                                $ksay = $ksorgu->fetchColumn();
                                                                                                                echo  number_format($ksay, 0, ',', '.');
                                                                                    ?> Adet</p>
                                                                          </div>
                                                                        </div>
                                </div>
                </div>
                
                <div class="row">
                    <div class="col-md">
                                                                          <div class="card text-white bg-dark mb-3" >
                                                                          <div class="card-header">Demir</div>
                                                                          <div class="card-body">
                                                                            <h5 class="card-title">Kayıtlı Veri</h5>
                                                                            <p class="card-text"><?php $dsorgu = $db->prepare("SELECT COUNT(*) FROM demir");
                                                                                                                $dsorgu->execute();
                                                                                                                $dsay = $dsorgu->fetchColumn();
                                                                                                                echo  number_format($dsay, 0, ',', '.');
                                                                                    ?> Adet</p>
                                                                          </div>
                                                                        </div>
                                </div>
                                 <div class="col-md">
                                                                          <div class="card text-white bg-info mb-3" >
                                                                          <div class="card-header">Faiz</div>
                                                                          <div class="card-body">
                                                                            <h5 class="card-title">Kayıtlı Veri</h5>
                                                                            <p class="card-text"><?php $fsorgu = $db->prepare("SELECT COUNT(*) FROM faiz");
                                                                                                                $fsorgu->execute();
                                                                                                                $fsay = $fsorgu->fetchColumn();
                                                                                                                echo  number_format($fsay, 0, ',', '.');
                                                                                    ?> Adet</p>
                                                                          </div>
                                                                        </div>
                                </div>
                                <div class="col-md">
                                                                          <div class="card text-white bg-secondary mb-3" >
                                                                          <div class="card-header">Borsa</div>
                                                                          <div class="card-body">
                                                                            <h5 class="card-title">Kayıtlı Veri</h5>
                                                                            <p class="card-text"><?php $bsorgu = $db->prepare("SELECT COUNT(*) FROM borsa");
                                                                                                                $bsorgu->execute();
                                                                                                                $bsay = $bsorgu->fetchColumn();
                                                                                                                echo  number_format($bsay, 0, ',', '.');
                                                                                    ?> Adet</p>
                                                                          </div>
                                                                        </div>
                                </div>
                                <div class="col-md">
                                                                          <div class="card text-white bg-warning mb-3" >
                                                                          <div class="card-header">Haberler</div>
                                                                          <div class="card-body">
                                                                            <h5 class="card-title">Kayıtlı Veri</h5>
                                                                            <p class="card-text"><?php $hsorgu = $db->prepare("SELECT COUNT(*) FROM haberler");
                                                                                                                $hsorgu->execute();
                                                                                                                $hsay = $hsorgu->fetchColumn();
                                                                                                                echo  number_format($hsay, 0, ',', '.');
                                                                                    ?> Adet</p>
                                                                          </div>
                                                                        </div>
                                </div>
                    
                </div>
     


      
    <div class="row">
      <div class="col-lg-12 text-center">
          
        <h3>Hoşgeldiniz <?php echo $gelenkullanici["adsoyad"]; ?></h3>
        <h1 class="mt-5">ZulfuMehmet.Com</h1>
        <p class="lead">Güncel Döviz Scripti Yönetim Paneli</p>
        <ul class="list-unstyled">
		<li>info@zulfumehmet.com</li>
        </ul>
      </div>
    </div>
  </div>
  <?php
include("alt.php");
}
?>
