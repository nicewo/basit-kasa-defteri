<?php
ob_start();
include 'baglanti.php' ;


if (isset($_GET['islem'])) {
if ($_GET['islem']=="giris") {


if (isset($_POST['uyegiris'])) {
	
	$pass = trim($_POST['password']);
	
	$kulal = $db -> prepare("Select * From uye WHERE pass=?");
	$kulal -> execute(array($pass));
	
	
if($kulal -> rowCount())   {
		
	$uyelerkulal = $kulal->Fetch();
	$_SESSION['giriskontrol'] = $uyelerkulal;
	setcookie("giriskontrol", "1", time()+157788000);



	$usss=$db->prepare("UPDATE uye SET ip=:ip, songiris=:songiris WHERE id=:id");
    $snc=$usss->execute([
        ":ip"         => $_SERVER["REMOTE_ADDR"],
        ":songiris"   => date('d.m.Y H:i:s'),
        ":id"         => $uyelerkulal['id']
    ]);
	
			

	Header("Location:index.php");
} else {
	Header("Location:index.php?uyegiris=passno");
}	
					

	
} else {
		Header("Location:index.php?uyegiris=postno");

}

}  elseif ($_GET['islem']=="cikis") {
		unset($_SESSION['giriskontrol']);
		setcookie("giriskontrol", "1", time()-3600);

	if (isset($_SESSION['cihaz'])) {
 				unset($_SESSION['cihaz']);
		}
               Header("Location:index.php");
			
	} elseif ($_GET['islem']=="mobil") {
	
$mobcon=$db->prepare("select * from uye where id=?");
  $mobcon->execute(array(1));
  $mobil=$mobcon->fetch(PDO::FETCH_ASSOC);
  

			
	$_SESSION['giriskontrol'] = $mobil;
	$_SESSION['cihaz'] = "mobil";
	setcookie("giriskontrol", "1", time()+157788000);

	
	$usss=$db->prepare("UPDATE uye SET ip=:ip, songiris=:songiris WHERE id=:id");
    $snc=$usss->execute([
        ":ip"         => $_SERVER["REMOTE_ADDR"],
        ":songiris"   => date('d.m.Y H:i:s'),
        ":id"         => $uyelerkulal['id']
    ]);

	Header("Location:index.php");	
	
	
} else {
		Header("Location:index.php?uyegiris=postno");

}
	
	
	
	
} else {
		Header("Location:index.php?uyegiris=postno");

}
?>