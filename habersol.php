<div class="col-md-10 col-lg-4 p-b-30">
    <div class="flex-c-s p-t-4">
        <div class="p-t-10 p-b-10" style="width:100%;margin:auto;text-align:center;float:none;display:scroll;">
                                         <?php echo $reklamkod["haber300250"]; ?>
                                    </div>
        </div>
                       <div class="p-l-10 p-rl-0-sr991 p-b-20">
                       
                        <div class="p-b-20">
                            <div class="how2 how2-cl2 flex-s-c m-b-1">
                                <h3 class="f1-m-2 cl3 tab01-title">
                                    Kategori
                                </h3>
                            </div>
                            <ul class="p-t-10">
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
                        
                        <div class="p-b-5">
                            <div class="how2 how2-cl3 flex-s-c m-b-5">
                                <h3 class="f1-m-2 cl3 tab01-title">
                                    Piyasa Özeti
                                </h3>
                            </div>
                            <table class="table table-borderless table-sm table-striped table-hover p-t-10">
                                <thead>
                                    <tr>
                                    <th scope="col">Birim</th>
                                    <th scope="col">Satış</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th style="text-align: left;" scope="row">Dolar</th>
                                        <td><?php $dolaryan = $db->query("SELECT * FROM `doviz` where kategori = 1 ORDER BY `doviz`.`id` DESC limit 1")->fetch(PDO::FETCH_ASSOC);
                                            if ( $dolaryan ){
                                                echo $dolaryan['satis'] . '<i class="fas fa-lira-sign" style="font-size: 12px;">';
                                            }?></td>
                                    </tr>
                                    <tr>
                                        <th style="text-align: left;" scope="row">Euro</th>
                                        <td><?php $dolaryan = $db->query("SELECT * FROM `doviz` where kategori = 2 ORDER BY `doviz`.`id` DESC limit 1")->fetch(PDO::FETCH_ASSOC);
                                            if ( $dolaryan ){
                                                echo $dolaryan['satis'].'<i class="fas fa-lira-sign" style="font-size: 12px;">';
                                            }?></td>
                                    </tr>
                                    <tr>
                                        <th style="text-align: left;" scope="row">Sterlin</th>
                                        <td><?php $dolaryan1 = $db->query("SELECT * FROM `doviz` where kategori = 3 ORDER BY `doviz`.`id` DESC limit 1")->fetch(PDO::FETCH_ASSOC);
                                            if ( $dolaryan1 ){
                                                echo $dolaryan1['satis'].'<i class="fas fa-lira-sign" style="font-size: 12px;">';
                                            }?></td>
                                    </tr>
                                    <tr>
                                        <th style="text-align: left;" scope="row">Ons</th>
                                        <td><?php $altinyan = $db->query("SELECT * FROM `altin` where kategori = 1 ORDER BY `altin`.`id` DESC limit 1")->fetch(PDO::FETCH_ASSOC);
                                            if ( $altinyan ){
                                                echo "$".$altinyan['satis'];
                                            }?></td>
                                    </tr>
                                    <tr>
                                        <th style="text-align: left;" scope="row">Gram Altın</th>
                                        <td><?php $altinyan1 = $db->query("SELECT * FROM `altin` where kategori = 2 ORDER BY `altin`.`id` DESC limit 1")->fetch(PDO::FETCH_ASSOC);
                                            if ( $altinyan1 ){
                                                echo $altinyan1['satis'].'<i class="fas fa-lira-sign" style="font-size: 12px;">';
                                            }?></td>
                                    </tr>
                                    <tr>
                                        <th style="text-align: left;" scope="row">Çeyrek Altın</th>
                                        <td><?php $altinyan2 = $db->query("SELECT * FROM `altin` where kategori = 3 ORDER BY `altin`.`id` DESC limit 1")->fetch(PDO::FETCH_ASSOC);
                                            if ( $altinyan2 ){
                                                echo $altinyan2['satis'].'<i class="fas fa-lira-sign" style="font-size: 12px;">';
                                            }?></td>
                                    </tr>
                                    <tr>
                                        <th style="text-align: left;" scope="row">Cumhuriyet Altını</th>
                                        <td><?php $altinyan2 = $db->query("SELECT * FROM `altin` where kategori = 6 ORDER BY `altin`.`id` DESC limit 1")->fetch(PDO::FETCH_ASSOC);
                                            if ( $altinyan2 ){
                                                echo $altinyan2['satis'].'<i class="fas fa-lira-sign" style="font-size: 12px;">';
                                            }?></td>
                                    </tr>
                                    <tr>
                                        <th style="text-align: left;" scope="row">Ham Petrol</th>
                                        <td><?php echo "$".$petrolusta["satis"]; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                            <div class="flex-c-s p-t-0">
                            <div class="p-t-10 p-b-10" style="width:100%;margin:auto;text-align:center;float:none;display:scroll;">
                                          <?php echo $reklamkod["haber300600"]; ?>
                                    </div>
                            </div>
                        <!-- Tag -->
                        <div class="p-b-20">
                            <div class="how2 how2-cl4 flex-s-c m-b-30">
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