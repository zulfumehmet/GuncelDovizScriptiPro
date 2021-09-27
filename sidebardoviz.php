<div class="col-md-10 col-lg-4 p-b-30">
    <div class="flex-c-s p-t-4">
                             <div class="p-t-10 p-b-10" style="width:100%;margin:auto;text-align:center;float:none;display:scroll;">
                                        <?php echo $reklamkod["dovizsidebarust"]; ?>
                                    </div>
                        </div>
					<div class="p-l-10 p-rl-0-sr991 p-t-10">						
						<!-- Category -->
						<div class="p-b-20">
							<div class="how2 how2-cl3 flex-s-c">
								<h3 class="f1-m-2 cl3 tab01-title">
									Kategori
								</h3>
							</div>

							<ul class="p-t-35">
								<li class="how-bor3 p-rl-4">
									<a href="habers-doviz.html" class="dis-block f1-s-10 text-uppercase cl2 hov-cl10 trans-03 p-tb-13">
										Döviz
									</a>
								</li>

								<li class="how-bor3 p-rl-4">
									<a href="habers-altin.html" class="dis-block f1-s-10 text-uppercase cl2 hov-cl10 trans-03 p-tb-13">
										Altın
									</a>
								</li>

								<li class="how-bor3 p-rl-4">
									<a href="habers-kriptopara.html" class="dis-block f1-s-10 text-uppercase cl2 hov-cl10 trans-03 p-tb-13">
										Kripto Para
									</a>
								</li>

								<li class="how-bor3 p-rl-4">
									<a href="habers-borsa.html" class="dis-block f1-s-10 text-uppercase cl2 hov-cl10 trans-03 p-tb-13">
										Borsa
									</a>
								</li>

								<li class="how-bor3 p-rl-4">
									<a href="habers-emtia.html" class="dis-block f1-s-10 text-uppercase cl2 hov-cl10 trans-03 p-tb-13">
									Emtialar
									</a>
								</li>
								<li class="how-bor3 p-rl-4">
									<a href="habers-ekonomi.html" class="dis-block f1-s-10 text-uppercase cl2 hov-cl10 trans-03 p-tb-13">
									Ekonomi
									</a>
								</li>
							</ul>
						</div>
						
						<!-- Popular Posts -->
						<div class="p-b-20">
							<div class="how2 how2-cl4 flex-s-c">
								<h3 class="f1-m-2 cl3 tab01-title">
									Haberler
								</h3>
							</div>

							<ul class="p-t-35">
							    <?php
$haberler1 = $db->query("SELECT * FROM haberler ORDER BY id DESC LIMIT 3", PDO::FETCH_ASSOC);
if ( $haberler1->rowCount() ){
     foreach( $haberler1 as $haberler ){
         ?>
								<li class="flex-wr-sb-s p-b-30">
									<a href="haber-<?php echo $haberler["seo"]; ?>-<?php echo $haberler["ID"]; ?>.html" class="size-w-10 wrap-pic-w hov1 trans-03">
										<img src="haberler/<?php echo $haberler["resim"]; ?>" alt="IMG">
									</a>

									<div class="size-w-11">
										<h6 class="p-b-4">
											<a href="haber-<?php echo $haberler["seo"]; ?>-<?php echo $haberler["ID"]; ?>.html" class="f1-s-5 cl3 hov-cl10 trans-03">
												<?php echo mb_substr($haberler["baslik"], 0, 50,'UTF-8'); ?>
											</a>
										</h6>

										<span class="cl8 txt-center p-b-24">
											<a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
												Tarih
											</a>

											<span class="f1-s-3 m-rl-3">
												-
											</span>

											<span class="f1-s-3">
												<?php  echo date_format(date_create($haberler['tarih']), 'd.m.y'); ?>
											</span>
										</span>
									</div>
								</li>
								<?php }
                                    }
                                ?>
							</ul>
						</div>
						<div class="flex-c-s p-t-0">
						    <div class="p-t-10 p-b-10" style="width:100%;margin:auto;text-align:center;float:none;display:scroll;">
                                        <?php echo $reklamkod["dovizsidebaralt"]; ?>
                                    </div>
                        </div>
						<!-- Tag -->
						<div></br>
							<div class="how2 how2-cl4 flex-s-c m-b-30 ">
								<h3 class="f1-m-2 cl3 tab01-title">
									Etiket
								</h3>
							</div>

							<div class="flex-wr-s-s m-rl--5">
								<?php
								etiketler();
                                            ?>
							</div>	
						</div>
					</div>
				</div>