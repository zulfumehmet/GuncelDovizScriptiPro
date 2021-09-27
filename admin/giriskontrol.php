<?php 
ob_start();
include("baglanti.php");
?>

<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Zülfü Mehmet - Site Yönetimi</title>
<link rel="stylesheet" type="text/css" media="all" href="style.css" />

</head>
<body>
  
  <div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="logo.png" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <?php

if($_POST)
	{
		$name =$_POST["user"];
		$pass =$_POST["pass"];
		$name = str_replace("'","",$name);
		$name = str_replace("'or","",$name);
		$name = str_replace(" ","",$name);

		$pass = str_replace("'","",$pass);
		$pass = str_replace("'or","",$pass);
		$pass = str_replace(" ","",$pass);

		$query  = $db->query("SELECT * FROM yonetici WHERE kullaniciadi='{$name}' && sifre='{$pass}'",PDO::FETCH_ASSOC);
		if ( $say = $query -> rowCount() ){

			if( $say > 0 ){
				session_start();
				$_SESSION['login']=true;
				$_SESSION['user']=$name;
                $_SESSION['pass']=$pass;
        header("Location:index.php");
				
			}else{
        echo "<br>Kullanıcı adı veya Şifre Yanlış. Giriş sayfasına yönelndiriliyorsunuz...";
        header("Refresh: 2; url=giris.php");
			}
		}else{
			echo "<br>Kullanıcı adı veya Şifre Yanlış. Giriş sayfasına yönelndiriliyorsunuz...";
header("Refresh: 2; url=giris.php");
		}
	}else{
		echo "<br>Kullanıcı adı veya Şifre Yanlış. Giriş sayfasına yönelndiriliyorsunuz...";
header("Refresh: 2; url=giris.php");
	}
	











/*

if(($_POST["user"]==$kadmin) and ($_POST["pass"]==$padmin)){
		$_SESSION["login"] = "true";
		$_SESSION["user"] = $kadmin;
		$_SESSION["pass"] = $padmin;
header("Location:index.php");
}else{ 

echo "<br>Kullanıcı adı veya Şifre Yanlış. Giriş sayfasına yönelndiriliyorsunuz...";
header("Refresh: 2; url=giris.php");
}
*/
ob_end_flush();

?>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="https://www.zulfumehmet.com/">www.zulfumehmet.com</a>
    </div>

  </div>
</div>
  
 

</body>
</html>