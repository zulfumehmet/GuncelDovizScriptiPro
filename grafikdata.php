[<?php
include ("db.php");
$tur = $_GET["tur"];
$doviz = $_GET["doviz"];
$gun = $_GET["gun"];
if ($_GET["gun"] == 1)
                    {
                    
                    $getAll_query = "SELECT * FROM $tur WHERE Date(tarih) = (Select Max(Date(tarih)) From $tur) And kategori = $doviz";
                    
                    $grap_statement = $db->prepare($getAll_query);
                     if ( $grap_statement->execute() );
                    $grap_output = "";
                    foreach ($grap_statement->fetchAll(PDO::FETCH_ASSOC) as $row) {
                     
                    $tarihm = strtotime($row['tarih'])*1000;
                    $tarihs = $tarihm+10800000;
                    
                    $grap_output .= "[";
                    $grap_output .= $tarihs.", ";
                    $grap_output .= $row['satis'];
                    $grap_output .= "],";
                    }
                    
                    echo  rtrim($grap_output,",");
                    }
        elseif ($_GET["gun"] == 7)
                    {
                    
                    $getAll_query = "SELECT AVG(`satis`) , DATE(`tarih`) FROM $tur WHERE tarih >= DATE_SUB( CURDATE( ) , INTERVAL 7 DAY ) and kategori = $doviz GROUP BY DATE(`tarih`) ASC";
                    
                    $grap_statement = $db->prepare($getAll_query);
                     if ( $grap_statement->execute() );
                    $grap_output = "";
                    foreach ($grap_statement->fetchAll(PDO::FETCH_ASSOC) as $row) {
                     
                    $tarihm = strtotime($row['DATE(`tarih`)'])*1000;
                    $tarihs = $tarihm+10800000;
                    
                    $grap_output .= "[";
                    $grap_output .= $tarihs.", ";
                    $satis = $row['AVG(`satis`)'];
                    if ($tur == "doviz"){$grap_output .= number_format($satis, 4,".",""); } else {$grap_output .= number_format($satis, 2,".","");}
                    $grap_output .= "],";
                    }
                    echo  rtrim($grap_output,",");
                }
    elseif ($_GET["gun"] == 30)
                    {
                    
                    $getAll_query = "SELECT AVG(`satis`) , DATE(`tarih`) FROM $tur WHERE tarih >= DATE_SUB( CURDATE( ) , INTERVAL 30 DAY ) and kategori = $doviz GROUP BY DATE(`tarih`) ASC";
                    
                    $grap_statement = $db->prepare($getAll_query);
                     if ( $grap_statement->execute() );
                    $grap_output = "";
                    foreach ($grap_statement->fetchAll(PDO::FETCH_ASSOC) as $row) {
                     
                    $tarihm = strtotime($row['DATE(`tarih`)'])*1000;
                    $tarihs = $tarihm+10800000;
                    
                    $grap_output .= "[";
                    $grap_output .= $tarihs.", ";
                    $satis = $row['AVG(`satis`)'];
                    if ($tur == "doviz"){$grap_output .= number_format($satis, 4,".",""); } else {$grap_output .= number_format($satis, 2,".","");}
                    $grap_output .= "],";
                    }
                    
                    echo  rtrim($grap_output,",");
                    }
                    else
                    {
                    
                     $getAll_query = "SELECT AVG(`satis`) , DATE(`tarih`) FROM $tur WHERE tarih >= DATE_SUB( CURDATE( ) , INTERVAL 365 DAY ) and kategori = $doviz GROUP BY DATE(`tarih`) ASC";
                    
                    $grap_statement = $db->prepare($getAll_query);
                     if ( $grap_statement->execute() );
                    $grap_output = "";
                    foreach ($grap_statement->fetchAll(PDO::FETCH_ASSOC) as $row) {
                     
                    $tarihm = strtotime($row['DATE(`tarih`)'])*1000;
                    $tarihs = $tarihm+10800000;
                    
                    $grap_output .= "[";
                    $grap_output .= $tarihs.", ";
                    $satis = $row['AVG(`satis`)'];
                    if ($tur == "doviz"){$grap_output .= number_format($satis, 4,".",""); } else {$grap_output .= number_format($satis, 2,".","");}
                    $grap_output .= "],";
                    }
                    
                    echo  rtrim($grap_output,",");
                    }

?>]