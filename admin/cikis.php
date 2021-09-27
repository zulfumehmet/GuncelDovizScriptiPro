
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Zülfü Mehmet - Site Yönetimi</title>
<link href="style.css" rel="stylesheet" type="text/css" media="all" />

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
session_start();
ob_start();
session_destroy();
echo "<br>Çıkış işleminiz gerçekleşmiştir. <br>Giriş sayfasına yönlendiriliyorsunuz";
header("Refresh: 3; url=giris.php");

?>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="https://www.zulfumehmet.com/">www.zulfumehmet.com</a>
    </div>

  </div>
</div>
  
 

</body>
</html>