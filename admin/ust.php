<?php 
$ka = $_SESSION['user'];
$ps = $_SESSION['pass'];
$kullanicisql = $db->prepare("SELECT * FROM yonetici WHERE kullaniciadi='$ka' && sifre='$ps'");
$kullanicisql->execute(array(
  '6'
));
$gelenkullanici=$kullanicisql->fetch(PDO::FETCH_ASSOC);
$ekleyen = $gelenkullanici["adsoyad"];
$ayarlaryetki = $gelenkullanici["ayarlaryetki"];
$botyetki = $gelenkullanici["botyetki"];
$haberyetki = $gelenkullanici["haberyetki"];
$mesajyetki = $gelenkullanici["mesaj"];

// mesaj kontrol

$mesaj_kontrol = $db->query("SELECT MAX(okundu) FROM `iletisim`")->fetch(PDO::FETCH_ASSOC);

$mesajvar = $mesaj_kontrol["MAX(okundu)"];


?>

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="bootstrap/js/jquery-3.4.1.slim.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/ckeditor.js" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="../fonts/fontawesome-5.0.8/css/fontawesome-all.min.css">
    <title>ZulfuMehmet - Site Yönetim Paneli</title>
    <style>.centerText{
   text-align: center;
}
 .select-css {
    display: block;
    font-size: 14px;
    font-family: sans-serif;
    font-weight: 700;
    color: #444;
    line-height: 1.3;
    padding: .6em 1.4em .5em .8em;
    
    max-width: 100%; /* useful when width is set to anything other than 100% */
    box-sizing: border-box;
    margin: 0;
    border: 1px solid #aaa;
    box-shadow: 0 1px 0 1px rgba(0,0,0,.04);
    border-radius: .5em;
    -moz-appearance: none;
    -webkit-appearance: none;
    appearance: none;
    background-color: #fff;
    /* note: bg image below uses 2 urls. The first is an svg data uri for the arrow icon, and the second is the gradient. 
        for the icon, if you want to change the color, be sure to use `%23` instead of `#`, since it's a url. You can also swap in a different svg icon or an external image reference
        
    */
    background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23007CB2%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'),
      linear-gradient(to bottom, #ffffff 0%,#e5e5e5 100%);
    background-repeat: no-repeat, repeat;
    /* arrow icon position (1em from the right, 50% vertical) , then gradient position*/
    background-position: right .7em top 50%, 0 0;
    /* icon size, then gradient */
    background-size: .65em auto, 100%;
}
/* Hide arrow icon in IE browsers */
.select-css::-ms-expand {
    display: none;
}
/* Hover style */
.select-css:hover {
    border-color: #888;
}
/* Focus style */
.select-css:focus {
    border-color: #aaa;
    /* It'd be nice to use -webkit-focus-ring-color here but it doesn't work on box-shadow */
    box-shadow: 0 0 1px 3px rgba(59, 153, 252, .7);
    box-shadow: 0 0 0 3px -moz-mac-focusring;
    color: #222; 
    outline: none;
}

/* Set options to normal weight */
.select-css option {
    font-weight:normal;
}

/* Support for rtl text, explicit support for Arabic and Hebrew */
*[dir="rtl"] .select-css, :root:lang(ar) .select-css, :root:lang(iw) .select-css {
    background-position: left .7em top 50%, 0 0;
    padding: .6em .8em .5em 1.4em;
}

/* Disabled styles */
.select-css:disabled, .select-css[aria-disabled=true] {
    color: graytext;
    background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22graytext%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'),
      linear-gradient(to bottom, #ffffff 0%,#e5e5e5 100%);
}

.select-css:disabled:hover, .select-css[aria-disabled=true] {
    border-color: #aaa;
}
</style>
  </head>
  <body>
   <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">Yönetim Paneli </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="../index.html">Siteye Git
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <?php if($ayarlaryetki == 1){ echo'
          <li class="nav-item ">
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Ayarlar
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="genelayar.php">Genel Ayarlar</a>
                <a class="dropdown-item" href="duyuru.php">Duyru Ekle</a>
                <a class="dropdown-item" href="kullanici_ayarlari.php">Kullanıcı Ayarları</a>
                <a class="dropdown-item" href="reklamlar.php">Reklam Ayarları</a>
              </div>
            </div>
          </li>'; } else{}; ?>
          <?php if($botyetki == 1){ echo'
          <li class="nav-item">
            <a class="nav-link" href="bot.php">Boot İşlemleri
              <span class="sr-only">(current)</span>
            </a>
          </li>'; } else{}; ?>
          
          <?php if($haberyetki == 1){ echo'
          <li class="nav-item ">
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Haber Modülü
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="haberliste.php">Listele</a>
                <a class="dropdown-item" href="haberekle.php">Haber Ekle</a>
              </div>
            </div>
          </li>'; } else{}; ?>
          <?php if($mesajyetki == 1){ ?>
          <li class="nav-item">
            <a class="nav-link" href="mesajlar.php" <?php if ($mesajvar > 0 ){ echo 'style="color: red;"';} else {} ?>>Gelen Mesajlar
              <span class="sr-only">(current)</span>
            </a>
          </li> <?php } else{}; ?>
          
          <li class="nav-item">
            <a class="nav-link" href="profil.php">Profil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cikis.php">Çıkış</a>
          </li>
         </ul>
      </div>
    </div>
  </nav>