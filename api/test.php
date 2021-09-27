<?php

 //api olumlu calisacak kod basi //
   $url = 'https://www.piyasam.net/api/piyasa-altin'; 
   // path to your JSON file
   $veri = file_get_contents($url); // put the contents of the file into a variable
   $data = json_decode($veri, 1); // decode the JSON feed
   
   print_r($data);