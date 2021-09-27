<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Zülfü Mehmet - Site Yönetimi</title>
<link rel="stylesheet" type="text/css" media="all" href="style.css" />

</head>
<body>
<?php
include("baglanti.php");
session_start();
if(!isset($_SESSION["login"])){
	}
else
{
	
}
 ?>
  
  <div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="logo.png" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form name="kullanicigirisi" method="POST" action="giriskontrol.php">
      <input type="text" id="kadi" class="fadeIn second" name="user" placeholder="Kullanıcı Adı">
      <input type="password" id="sifre" class="fadeIn third" name="pass" placeholder="Şifre">
      <input type="submit" class="fadeIn fourth" name="girisbuton"  id="girisbuton" value="Giriş Yap">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="https://www.zulfumehmet.com/">www.zulfumehmet.com</a>
    </div>

  </div>
</div>
  
 

</body>
</html>