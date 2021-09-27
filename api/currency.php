<?php 
try {
     $db = new PDO("mysql:host=localhost;dbname=zulfuuhq_piyasam", "zulfuuhq_piyasam", "le3!%&;0MFe=");
     $db->exec("SET CHARACTER SET utf8");
} catch ( PDOException $e ){
     print $e->getMessage();
}

$gelen = $_GET["gelen"];
$statementa = $db->prepare("SELECT cinsi, seo as kisaisim, alis, satis FROM
                            (SELECT *  FROM altin WHERE kategori IN (1,2,3,4,5,6,7,8,9) ORDER BY id DESC LIMIT 9) AS T inner join altinkategori as ikinci on T.kategori = ikinci.kategorino ORDER BY kategorino ASC");
$statementa->execute();
$resultsa = $statementa->fetchAll(PDO::FETCH_ASSOC);
   

$statement = $db->prepare("SELECT cinsi, kisaisim, alis, satis  FROM
                            (SELECT * FROM doviz WHERE kategori IN (1,2,3,4,5,6,7,8,9,10,11,12,13) ORDER BY id DESC LIMIT 13) AS T inner join kategoridoviz as ikinci on T.kategori = ikinci.kategorino ORDER BY kategorino ASC");
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);


header('Content-type: application/json');
$json = json_encode($results, JSON_UNESCAPED_UNICODE);
$jsona = json_encode($resultsa, JSON_UNESCAPED_UNICODE);

if($gelen == "doviz"){
echo $json;} elseif($gelen == "altin"){

echo $jsona;} else
{echo "Error 404";}




$db = null;