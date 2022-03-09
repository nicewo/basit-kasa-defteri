<?php
header('Content-Type: text/html; charset=UTF-8');
ob_start();
session_start();
date_default_timezone_set('Europe/Istanbul');


error_reporting(E_ALL);
ini_set("display_errors", 1);

try {
	
	$db= new PDO("mysql:host=localhost;dbname=u9677420_kasamyg",'root','68426633');
	$db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");

	//echo "veritabanı bağlandı.";
	//name:u9677420_kasamyg
	//user:u9677420_myg
	//pass:OBuv70J2JGwa62S
	
}



catch (PDOException $e) {
	
	echo $e->getMessage();
	
}

$_POST = array_map('htmlentities',$_POST);
$_GET = array_map('htmlentities',$_GET);



			
			
			
			//	seo fonksiyon kodları başlangıç		
			
			
function seo($s) {
	$tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',' ',',','?');
	$eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','','');
	$s = str_replace($tr,$eng,$s);
	$s = strtolower($s);
	$s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
	$s = preg_replace('/\s+/', '-', $s);
	$s = preg_replace('|-+|', '-', $s);
	$s = preg_replace('/#/', '', $s);
	$s = str_replace('.', '', $s);
	$s = trim($s, '-');
	return $s;
}


// seo fonksiyon kodları bitiş

$pincon=$db->prepare("select * from uye where id=?");
    
    $pincon->execute(array(1));
    $pin=$pincon->fetch(PDO::FETCH_ASSOC);
  

	if (isset($_COOKIE['giriskontrol'])) {
		if ($_COOKIE['giriskontrol']==1) {
			
	$_SESSION['giriskontrol'] = $pin;
	setcookie("giriskontrol", "1", time()+157788000);
			
		}
	}
		

?>
