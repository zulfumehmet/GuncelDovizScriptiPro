<?php
include("baglanti.php");
session_start();
if(!isset($_SESSION["login"])){
	echo "Bu sayfayı görüntüleme yetkiniz yoktur.";
	header("Location:giris.php");
}
else
{
    if(isset($_POST["button"])){
        $query = $db->prepare("UPDATE reklam SET
        sliderana30060 = :sliderana30060,
        sliderana300250 = :sliderana300250,
        anasayfa720 = :anasayfa720,
        footer720 = :footer720,
        sag = :sag,
        sol = :sol,
        dovizust = :dovizust,
        dovizsidebarust = :dovizsidebarust,
        dovizsidebaralt = :dovizsidebaralt,
        haberbanner = :haberbanner,
        haber300600 = :haber300600,
        haber300250 =:haber300250
WHERE ID = :id");
$update = $query->execute(array(
    "sliderana30060" => $_POST['sliderana30060'],
    "sliderana300250" => $_POST['sliderana300250'],
    "anasayfa720" => $_POST['anasayfa720'],
    "footer720" => $_POST['footer720'],
    "sag" => $_POST['sag'],
    "sol" => $_POST['sol'],
    "dovizust" => $_POST['dovizust'],
    "dovizsidebarust" => $_POST['dovizsidebarust'],
    "dovizsidebaralt" => $_POST['dovizsidebaralt'],
    "haberbanner" => $_POST['haberbanner'],
    "haber300600" => $_POST['haber300600'],
    "haber300250" => $_POST['haber300250'],
    "id" => 1
));
if ( $update ){
$sonuc = '<div class="alert alert-success">Reklamlar Güncellendi.</div>';
}
    }else
    {
    }
include("ust.php");
if($ayarlaryetki == 1){}else{header("Location:index.php");}

            $rklm = $db->prepare("SELECT * FROM reklam WHERE id=1");
			$rklm->execute(array('6'));
            $reklam=$rklm->fetch(PDO::FETCH_ASSOC);
if(empty($sonuc)){

}else{
    echo '<div class="container"><div class="row"><div class="col-lg-12 text-center">'.$sonuc.'</div></div></div>';
}
?>
<div class="card">
    <h5 class="card-header info-color white-text text-center py-3">
        <strong>Reklam İşlemleri</strong>
    </h5>
    <div class="card-body px-lg-5 pt-0">
        <form class="text-center" style="color: #757575;" method="POST" action="#">
            <div class="md-form mt-0">
                <label for="materialRegisterFormEmail">Ana Sayfa Side Bar Üst</label>
                <textarea class="form-control rounded-0" name="sliderana300250" id="sliderana300250" rows="2"><?php echo $reklam["sliderana300250"];?></textarea>
            </div>
            <div class="md-form mt-0">
                <label for="materialRegisterFormEmail">Ana Sayfa Side Bar Alt</label>
                <textarea class="form-control" name="sliderana30060" id="sliderana30060" rows="2"><?php echo $reklam["sliderana30060"];?></textarea>
            </div>


            <div class="md-form mt-0">
                <label for="materialRegisterFormEmail">Ana Sayfa Orta</label>
                <textarea class="form-control rounded-0" name="anasayfa720" id="anasayfa720" rows="2"><?php echo $reklam["anasayfa720"];?></textarea>
            </div>

            <div class="md-form mt-0">
                <label for="materialRegisterFormEmail">Footer Reklam Alanı</label>
                <textarea class="form-control rounded-0" name="footer720" id="footer720" rows="2"><?php echo $reklam["footer720"];?></textarea>
            </div>
            <br/>
            <h5 class="card-header info-color white-text text-center py-2">
                <strong>Sayfa Sol ve Sağ</strong>
             </h5>
             <br/>
            <div class="md-form mt-0">
                <label for="materialRegisterFormEmail">Sol Taraf</label>
                <textarea class="form-control rounded-0" name="sol" id="sol" rows="2"><?php echo $reklam["sol"];?></textarea>
            </div>
            <div class="md-form mt-0">
                <label for="materialRegisterFormEmail">Sağ Taraf</label>
                <textarea class="form-control rounded-0" name="sag" id="sag" rows="2"><?php echo $reklam["sag"];?></textarea>
            </div>

            <br/>
            <h5 class="card-header info-color white-text text-center py-2">
                <strong>Doviz Sayfasında Bulunan Reklamlar</strong>
             </h5>
             <br/>
            <div class="md-form mt-0">
                <label for="materialRegisterFormEmail">Döviz Üst Sayfa</label>
                <textarea class="form-control rounded-0" name="dovizust" id="dovizust" rows="2"><?php echo $reklam["dovizust"];?></textarea>
            </div>

            <div class="md-form mt-0">
                <label for="materialRegisterFormEmail">Döviz Sidebar Üst</label>
                <textarea class="form-control rounded-0" name="dovizsidebarust" id="dovizsidebarust" rows="2"><?php echo $reklam["dovizsidebarust"];?></textarea>
            </div>
            
            <div class="md-form mt-0">
                <label for="materialRegisterFormEmail">Döviz Sidebar Alt</label>
                <textarea class="form-control rounded-0" name="dovizsidebaralt" id="dovizsidebaralt" rows="2"><?php echo $reklam["dovizsidebaralt"];?></textarea>
            </div>
            <br>
            <h5 class="card-header info-color white-text text-center py-2">
                <strong>Haber Sayfasında Bulunan Reklamlar</strong>
             </h5>
             <br/>
             <div class="md-form mt-0">
                <label for="materialRegisterFormEmail">Haber Banner</label>
                <textarea class="form-control rounded-0" name="haberbanner" id="haberbanner" rows="2"><?php echo $reklam["haberbanner"];?></textarea>
            </div>

            <div class="md-form mt-0">
                <label for="materialRegisterFormEmail">Haber 300X600</label>
                <textarea class="form-control rounded-0" name="haber300600" id="haber300600" rows="2"><?php echo $reklam["haber300600"];?></textarea>
            </div>

            <div class="md-form mt-0">
                <label for="materialRegisterFormEmail">Haber 300X250</label>
                <textarea class="form-control rounded-0" name="haber300250" id="haber300250" rows="2"><?php echo $reklam["haber300250"];?></textarea>
            </div>
            <button class="btn btn-outline-info btn-rounded my-4 waves-effect z-depth-0" name="button" id="button" type="submit">Reklamları Güncelle</button>
        </form>
        

    </div>

 </div>


      </div>
    </div>
</div>

<?php
}
?>
