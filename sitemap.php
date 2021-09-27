<?php 
include ("db.php");
header('Content-Type: text/xml'); 
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>"; 
echo "<urlset xmlns=\"https://www.sitemaps.org/schemas/sitemap/0.9\">";
echo "<url><loc>https://" . $_SERVER['HTTP_HOST'] . "</loc></url>"; 
echo "<url><loc>https://" . $_SERVER['HTTP_HOST'] . "/index.html</loc></url>"; 
echo "<url><loc>https://" . $_SERVER['HTTP_HOST'] . "/doviz.html</loc></url>"; 
echo "<url><loc>https://" . $_SERVER['HTTP_HOST'] . "/altin.html</loc></url>";
echo "<url><loc>https://" . $_SERVER['HTTP_HOST'] . "/kripto.html</loc></url>";
echo "<url><loc>https://" . $_SERVER['HTTP_HOST'] . "/demir.html</loc></url>";
echo "<url><loc>https://" . $_SERVER['HTTP_HOST'] . "/detay-borsa-endeks.html</loc></url>";
echo "<url><loc>https://" . $_SERVER['HTTP_HOST'] . "/emtia.html</loc></url>";
echo "<url><loc>https://" . $_SERVER['HTTP_HOST'] . "/detay-faiz-oran.html</loc></url>";
echo "<url><loc>https://" . $_SERVER['HTTP_HOST'] . "/habers-ekonomi.html</loc></url>";
echo "<url><loc>https://" . $_SERVER['HTTP_HOST'] . "/habers-doviz.html</loc></url>";
echo "<url><loc>https://" . $_SERVER['HTTP_HOST'] . "/habers-altin.html</loc></url>";
echo "<url><loc>https://" . $_SERVER['HTTP_HOST'] . "/habers-borsa.html</loc></url>";
echo "<url><loc>https://" . $_SERVER['HTTP_HOST'] . "/habers-kriptopara.html</loc></url>";
echo "<url><loc>https://" . $_SERVER['HTTP_HOST'] . "/habers-emtia.html</loc></url>";

$doviz = $db->query("SELECT * FROM `kategoridoviz`", PDO::FETCH_ASSOC);
if ( $doviz->rowCount() ){
     foreach( $doviz as $dovizcek){
echo "<url><loc>https://" . $_SERVER['HTTP_HOST'] . "/detay-doviz-".$dovizcek['seo'].".html</loc></url>";
                }
            }
$altin = $db->query("SELECT * FROM `altinkategori`", PDO::FETCH_ASSOC);
if ( $doviz->rowCount() ){
     foreach( $altin as $altincek){
echo "<url><loc>https://" . $_SERVER['HTTP_HOST'] . "/detay-altin-".$altincek['seo'].".html</loc></url>";
                }
            }
$kripto = $db->query("SELECT * FROM `kriptokategori`", PDO::FETCH_ASSOC);
if ( $doviz->rowCount() ){
     foreach( $kripto as $kriptocek){
echo "<url><loc>https://" . $_SERVER['HTTP_HOST'] . "/detay-kripto-".$kriptocek['seo'].".html</loc></url>";
                }
            }
$emtia = $db->query("SELECT * FROM `emtiakategori`", PDO::FETCH_ASSOC);
if ( $doviz->rowCount() ){
     foreach( $emtia as $emtiacek){
echo "<url><loc>https://" . $_SERVER['HTTP_HOST'] . "/detay-emtia-".$emtiacek['seo'].".html</loc></url>";
                }
            }
$demir = $db->query("SELECT * FROM `demirkategori`", PDO::FETCH_ASSOC);
if ( $demir->rowCount() ){
     foreach( $demir as $demircek){
echo "<url><loc>https://" . $_SERVER['HTTP_HOST'] . "/detay-demir-".$demircek['seo'].".html</loc></url>";
                }
            }
$adrescek = $db->query("SELECT * FROM `haberler`", PDO::FETCH_ASSOC);
if ( $adrescek->rowCount() ){
     foreach( $adrescek as $adrescekhaber){
echo "<url><loc>https://" . $_SERVER['HTTP_HOST'] . "/haber-".$adrescekhaber['seo']."-".$adrescekhaber['ID'].".html</loc></url>";
                }
            }
echo "</urlset>";