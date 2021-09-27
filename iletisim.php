<?php 
include ("db.php");
$sayfaadi="iletisim";
$ogtitle = '<meta property="og:title" content="Güncel döviz, altın, borsa, kripto paralar ve emtia değerleri ve döviz birim dönüştürme piyasaci.net adresinde">';
include("header.php"); ?>
    
          <script type="text/javascript"> 
         

					$(function(){ 
					   $("#mesajyolla").click(function(){
						$.ajax({ 
							type: "POST",
							url: "post.php",
							data: $('#mesajgonder').serialize(), 
							error:function(){ 
							   $(".iletisimcevap").html("<span style='color: red'>Mesaj İletilirken Hata Oluştu, Daha Sonra Tekrar Deneyin.</span>");
							},
							success: function(veri) { 
							        if ( veri == "bos" ){
							             $(".iletisimcevap").html(veri);
							        }else{
							             $(".iletisimcevap").html(veri);
							             document.forms["mesajgonder"].reset();
							        }
							}   
							});
						});
					});
					</script>
    <div class="container p-t-4 p-b-40">
		<h2 class="f1-l-1 cl2">
			İletişim Formu
		</h2>
	</div>

	<!-- Content -->
	<section class="bg0 p-b-10">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-8 p-b-5">
					<div class="p-r-10 p-r-0-sr991">
						<form name="mesajgonder"  id="mesajgonder" action="#">
                    <div class="card mt-4">
                        <div class="card-body p-3">
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-user text-info"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="adsoyad" placeholder="Ad Soyad" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-envelope text-info"></i>
                                        </div>
                                    </div>
                                    <input type="email" class="form-control" name="mail" placeholder="E-Posta" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-tag text-info"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="konu" placeholder="Konu" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-comment text-info"></i>
                                        </div>
                                    </div>
                                    <textarea name="mesaj" class="form-control" placeholder="Lütfen Mesajınızı Buraya Yazın.." rows="6" required></textarea>
                                </div>
                            </div>
                            <div class="text-center">
                                <input type="submit"  id="mesajyolla"value="GÖNDER" class="btn btn-info btn-block" onclick="return false">
                            </div>
                        </div>
                    </div>
                </form>
					</div>
				</div>
				
				<!-- Sidebar -->
				<div class="col-md-5 col-lg-4 p-t-25 p-b-5">
					<div class="p-l-10 p-rl-0-sr991">
						<!-- Popular Posts -->
						<div>
							<div class="how2 how2-cl4 flex-s-c">
								<h3 class="f1-m-2 cl3 tab01-title">
								İletişim Bilgiler
								</h3>
							</div>

							<ul class="p-t-35">
								<li class="flex-wr-sb-s p-b-30">
								    <div class="size-w-30">
										<h6 class="p-b-4" >
										<a href="tel:<?php echo $genela['telefon']; ?>" class="f1-s-5 cl18 hov-cl10 trans-03 p-tb-8" ><i class="fas fa-phone"> <?php echo $genela['telefon']; ?></i></a>
										</h6>

									</div>
								</li>
								<li class="flex-wr-sb-s p-b-30">
								    <div class="size-w-30">
										<h6 class="p-b-4" >
										<a href="mailto:<?php echo $genela['telefon']; ?>" class="f1-s-5 cl18 hov-cl10 trans-03 p-tb-8"><i class="fas fa-envelope"> <?php echo $genela['mail']; ?></i></a>
										</h6>
									</div>
								</li>
								<li class="flex-wr-sb-s p-b-30">
							        <div class="iletisimcevap"></div>
							    </li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section class="bg0 p-t-2 p-b-10">
	   <div class="container">
          
	            <div class="text-white text-center py-2 mt-5">
                     <?php echo $genela['googlemaps']; ?>
                </div>
            
        </div>
    </section>
    <?php include("footer.php"); ?>