<?php 
include ("db.php");

$adsoyad = $_POST["adsoyad"];
$mail = $_POST["mail"];
$konu = $_POST["konu"];
$mesaj = $_POST["mesaj"];


if(empty($adsoyad) || empty($mail)|| empty($konu)|| empty($mesaj)) {
      echo '<div class="alert alert-danger">Lütfen boş alan bırakmayınız....</div>';
   } else {
      
        $query = $db->prepare("INSERT INTO iletisim SET
    adsoyad = ?,
    mail = ?,
    konu = ?,
    mesaj = ?,
    okundu = ?");
    $insert = $query->execute(array(
        $adsoyad, $mail, $konu, $mesaj, "1"
    ));
    if ( $insert ){
        $last_id = $db->lastInsertId();
        echo '<div class="alert alert-success">Mesajınız alındı...</div>';
    }
      
      
      
   }
?>