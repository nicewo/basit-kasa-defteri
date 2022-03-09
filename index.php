<?php
include 'baglanti.php';
include 'head.php' ;
?>
<h2 class="text-center">Kasa</h2>






<div class="container mt-3">
<div class="row">
<div class="col-12" style="min-height: 500px;">
<?php $yenigun = "yok" ;?>	

<?php if (isset($_GET['s'])) {
	if ($_GET['s']=="firmayrinti") {
		include('firm.php');
	}
}	
?>		
	
	
	

<!-- gelen bölümü başı -->

<?php if (isset($_GET['s'])) {
	if ($_GET['s']=='gelen') {
			$gider = $_POST['gider'];
			$firm = $_POST['firm'];
			$nerden = 1;
			$aciklama = $_POST['aciklama'];
			$tarih = strtotime(date('d.m.Y'));
			$saat = date('H:i:s');
if (isset($_GET['id'])) { 
	//eski hesap çıkartma işlemi baş
$aab = $db->prepare("SELECT * FROM gelen WHERE id = ?");
$aab->bindParam(1, $_GET['id'], PDO::PARAM_STR);
$aab->execute();
    $kab=$aab->fetch(PDO::FETCH_ASSOC);
		
		
		
$aa = $db->prepare("SELECT * FROM firm WHERE id = ?");
$aa->bindParam(1, $kab['firm'], PDO::PARAM_STR);
$aa->execute();
    $ka=$aa->fetch(PDO::FETCH_ASSOC);

$eksiborc = $ka['borc'] - $kab['miktar'] ;		

$sorguz = $db->prepare("UPDATE firm SET borc = ? WHERE id = ?");
$sorguz->bindParam(1, $eksiborc, PDO::PARAM_STR);
$sorguz->bindParam(2, $kab['firm'], PDO::PARAM_STR);
$sorguz->execute();

	
	//eski hesap çıkartma işlemi son 
	//düzenlenen hesap toplama işlemi baş 
		
		
$az = $db->prepare("SELECT * FROM firm WHERE id = ?");
$az->bindParam(1, $firm, PDO::PARAM_STR);
$az->execute();
    $kz=$az->fetch(PDO::FETCH_ASSOC);
	
$borc = $kz['borc'] + $gider ;
	
$sorgua = $db->prepare("UPDATE firm SET borc = ? WHERE id = ?");
$sorgua->bindParam(1, $borc, PDO::PARAM_STR);
$sorgua->bindParam(2, $firm, PDO::PARAM_STR);
$sorgua->execute();
	//düzenlenen hesap toplama işlemi son 
	
	if (strtotime($_POST['tarih'])==$kab['tarih']) { $tarih=$kab['tarih'] ; $saat=$kab['saat']; } else { $tarih=strtotime($_POST['tarih']);}
	
$sorgu = $db->prepare("UPDATE gelen SET firm = ?, aciklama = ?, miktar = ?, tarih = ?, saat = ?, nerden = ? WHERE id = ?");
$sorgu->bindParam(1, $firm, PDO::PARAM_STR);
$sorgu->bindParam(2, $aciklama, PDO::PARAM_STR);
$sorgu->bindParam(3, $gider, PDO::PARAM_STR);
$sorgu->bindParam(4, $tarih, PDO::PARAM_STR);
$sorgu->bindParam(5, $saat, PDO::PARAM_STR);
$sorgu->bindParam(6, $nerden, PDO::PARAM_STR);
$sorgu->bindParam(7, $_GET['id'], PDO::PARAM_STR);
$sorgu->execute();

    if ($sorgu->rowCount() > 0) {
        header('Location: index.php?s=gelensirala&d='. $sorgu->rowCount() .' gelen kaydı güncellendi.');
    } else {
        header('Location: index.php?s=gelensirala&d=Herhangi bir kayıt güncellenemedi.');
    }

} else {
////////ekle baş		
		
$aa = $db->prepare("SELECT * FROM firm WHERE id = ?");
$aa->bindParam(1, $firm, PDO::PARAM_STR);
$aa->execute();
    $ka=$aa->fetch(PDO::FETCH_ASSOC);

$borc = $ka['borc'] + $gider ;		
		
$sorgua = $db->prepare("UPDATE firm SET borc = ? WHERE id = ?");
$sorgua->bindParam(1, $borc, PDO::PARAM_STR);
$sorgua->bindParam(2, $firm, PDO::PARAM_STR);
$sorgua->execute();
		
		
		
		
		
$sorgu = $db->prepare("INSERT INTO gelen SET firm = ?, aciklama = ?, miktar = ?, tarih = ?, saat = ?, nerden = ?");
$sorgu->bindParam(1, $firm, PDO::PARAM_STR);
$sorgu->bindParam(2, $aciklama, PDO::PARAM_STR);
$sorgu->bindParam(3, $gider, PDO::PARAM_STR);
$sorgu->bindParam(4, $tarih, PDO::PARAM_STR);
$sorgu->bindParam(5, $saat, PDO::PARAM_STR);
$sorgu->bindParam(6, $nerden, PDO::PARAM_STR);
$sorgu->execute();

    if ($sorgu->rowCount() > 0) {
        header('Location: index.php?d='. $sorgu->rowCount() .' gelen kaydı eklendi.');
    } else {
        header('Location: index.php?d=Herhangi bir kayıt eklenemedi.');
    }

	
	
	}
//////ekle son
	} elseif ($_GET['s']=="gelensil") {
		

$aab = $db->prepare("SELECT * FROM gelen WHERE id = ?");
$aab->bindParam(1, $_GET['id'], PDO::PARAM_STR);
$aab->execute();
    $kab=$aab->fetch(PDO::FETCH_ASSOC);
		
		
		
$aa = $db->prepare("SELECT * FROM firm WHERE id = ?");
$aa->bindParam(1, $kab['firm'], PDO::PARAM_STR);
$aa->execute();
    $ka=$aa->fetch(PDO::FETCH_ASSOC);

$borc = $ka['borc'] - $kab['miktar'] ;		
		
$sorgua = $db->prepare("UPDATE firm SET borc = ? WHERE id = ?");
$sorgua->bindParam(1, $borc, PDO::PARAM_STR);
$sorgua->bindParam(2, $kab['firm'], PDO::PARAM_STR);
$sorgua->execute();
		
		
		
		
		
$sorgu = $db->prepare("DELETE FROM gelen WHERE id = ?");
$sorgu->bindParam(1, $_GET['id'], PDO::PARAM_INT);
$sorgu->execute();

    if ($sorgu->rowCount() > 0) {
        header('Location: index.php?s=gelensirala&d='. $sorgu->rowCount() .' gelen kaydı silindi.');
    } else {
        header('Location: index.php?s=gelensirala&d=Herhangi bir kayıt silinemedi.');
    }

	} elseif ($_GET['s']=="gelensirala") { ?>

	
<table class="table table-sm table-dark table-striped">
  <thead>
    <tr>
      <th scope="col" class="d-none d-sm-block">Sıra</th>
      <th scope="col">Miktar</th>
      <th scope="col" class="d-none d-sm-block">Açıklama</th>
      <th scope="col">Firma</th>
      <th scope="col">Tarih</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($db->query("SELECT * from gelen Order by tarih DESC") as $giden) {
	  		 $gicon=$db->prepare("select * from firm where id=?");
             $gicon->execute(array($giden['firm']));
             $firma=$gicon->fetch(PDO::FETCH_ASSOC);
?>	  
	  <?php if (date('l',$giden['tarih'])!="Monday" and $yenigun=="Monday"){echo "<tr><td colspan='6'></td></tr>";} ?>
 	<?php $yenigun = date('l',$giden['tarih']) ;?>
<?php if ($giden['aciklama']!="bospazartesi") {?>
    <tr>
      <th scope="row" class="d-none d-sm-block"><?=$giden['id'];?></th>
      <td><?=$giden['miktar'];?> TL</td>
      <td class="d-none d-sm-block"><?php if($giden['aciklama']==null){echo "açıklama yok"; } else {echo $giden['aciklama'];}?></td>
      <td><?=$firma['ad'];?></td>
      <td class="m-0 p-0"><small class="m-0 p-0"><?=date('d.m.Y-l' ,$giden['tarih']);?><br><?=$giden['saat'];?></small></td>
      <td>
		  <a href="index.php?s=gelensil&id=<?=$giden['id'];?>" class="btn btn-sm btn-outline-danger">SİL</a>
	  </td>
   </tr>
	  <tr class="d-block d-sm-none"></tr><tr class=" d-sm-none"><td colspan="4"><?php if($giden['aciklama']==null){echo "açıklama yok"; } else {echo $giden['aciklama'];}?></td></tr>
<?php } //bos pazartesi sonu ?>	  
<?php } ?>	  
  </tbody>
</table>
	<div class="col-12 border border-1 float-left" style="min-height: 250px;">
	<form action="?s=gelen" method="post" enctype="multipart/form-data">
		<div class="col-12 text-center">Girdi Ekle </div>
		<div class="row mt-3">
			<div class="col-7"><input type="number"  step="0.01" name="gider" class="form form-control" placeholder="Girdi Ekle"></div>
			<div class="col-5">
				<select class="form form-control" name="firm">
<?php foreach ($db->query("SELECT * from firm Order by id ASC") as $firmv) {?>
					<option value="<?=$firmv['id'];?>" ><?=$firmv['ad'];?></option>
<?php } ?>
				</select>
			</div>
		</div>
		<div class="col-12 mt-4 px-0">
			<input type="text" name="aciklama" class="form form-control" placeholder="Açıklama">
		</div>
		<div class="row my-3">
			<div class="col-6 text-left"><a href="?s=gelensirala" class="btn btn-outline-warning">TÜM GİRDİLER</a></div>
			<div class="col-6 text-right"><input type="submit" value="EKLE" class="btn btn-outline-success"></div>
		</div>
	</form>
	</div>
<?php }
} else {	
?>	
	<div class="col-12 col-lg-6 border border-1 float-left" style="min-height: 250px;">
	<form action="?s=gelen" method="post" enctype="multipart/form-data">
		<div class="col-12 text-center">Girdi Ekle</div>
		<div class="row mt-3">
			<div class="col-7"><input type="number"  step="0.01" name="gider" class="form form-control" placeholder="Girdi Ekle"></div>
			<div class="col-5">
				<select class="form form-control" name="firm">
<?php foreach ($db->query("SELECT * from firm Order by id ASC") as $firmv) {?>
					<option value="<?=$firmv['id'];?>" ><?=$firmv['ad'];?></option>
<?php } ?>
				</select>
			</div>
		</div>
		<div class="col-12 mt-4 px-0">
			<input type="text" name="aciklama" class="form form-control" placeholder="Açıklama">
		</div>
		<div class="row my-3">
			<div class="col-6 text-left"><a href="?s=gelensirala" class="btn btn-outline-warning">TÜM GİRDİLER</a></div>
			<div class="col-6 text-right"><input type="submit" value="EKLE" class="btn btn-outline-success"></div>
		</div>
	</form>
	</div>
<?php } ?>	
<!-- gelen bölümü sonu -->		
	
	
	
	
<!-- ödeme bölümü başı -->

<?php if (isset($_GET['s'])) {
	if ($_GET['s']=='odeme') {
			$gider = $_POST['gider'];
			$firm = $_POST['firm'];
			$nerden = $_POST['nerden'];
			$aciklama = $_POST['aciklama'];
			$tarih = strtotime(date('d.m.Y'));
			$saat = date('H:i:s');

		
		
$aa = $db->prepare("SELECT * FROM firm WHERE id = ?");
$aa->bindParam(1, $firm, PDO::PARAM_STR);
$aa->execute();
    $ka=$aa->fetch(PDO::FETCH_ASSOC);

$borc = $ka['borc'] - $gider ;		
		
$sorgua = $db->prepare("UPDATE firm SET borc = ? WHERE id = ?");
$sorgua->bindParam(1, $borc, PDO::PARAM_STR);
$sorgua->bindParam(2, $firm, PDO::PARAM_STR);
$sorgua->execute();

		
		
// nerden ceptense muhammede gelen kaydı başı		
		
if ($nerden=="cepten") {
$aaw = $db->prepare("SELECT * FROM firm WHERE id = ?");
$aaw->execute(array(1));
    $kaw=$aaw->fetch(PDO::FETCH_ASSOC);

$borcw = $kaw['borc'] + $gider ;		
$idida=1;
$acika="Cepten Ödeme Kaydı...";
$sorguaw = $db->prepare("UPDATE firm SET borc = ? WHERE id = ?");
$sorguaw->bindParam(1, $borcw, PDO::PARAM_STR);
$sorguaw->bindParam(2, $idida, PDO::PARAM_INT);
$sorguaw->execute();
		
		
		
		
		
$sorgu = $db->prepare("INSERT INTO gelen SET firm = ?, aciklama = ?, miktar = ?, tarih = ?, saat = ?, nerden = ?");
$sorgu->bindParam(1, $idida, PDO::PARAM_STR);
$sorgu->bindParam(2, $acika, PDO::PARAM_STR);
$sorgu->bindParam(3, $gider, PDO::PARAM_STR);
$sorgu->bindParam(4, $tarih, PDO::PARAM_STR);
$sorgu->bindParam(5, $saat, PDO::PARAM_STR);
$sorgu->bindParam(6, $nerden, PDO::PARAM_STR);
$sorgu->execute();
	
}
		
// nerden ceptense muhammede gelen kaydı sonu		
		
		
		
		
		
		
$sorgu = $db->prepare("INSERT INTO giden SET firm = ?, aciklama = ?, miktar = ?, tarih = ?, saat = ?, nerden = ?");
$sorgu->bindParam(1, $firm, PDO::PARAM_STR);
$sorgu->bindParam(2, $aciklama, PDO::PARAM_STR);
$sorgu->bindParam(3, $gider, PDO::PARAM_STR);
$sorgu->bindParam(4, $tarih, PDO::PARAM_STR);
$sorgu->bindParam(5, $saat, PDO::PARAM_STR);
$sorgu->bindParam(6, $nerden, PDO::PARAM_STR);
$sorgu->execute();

    if ($sorgu->rowCount() > 0) {
        header('Location: index.php?d='. $sorgu->rowCount() .' ödeme kaydı eklendi.');
    } else {
        header('Location: index.php?d=Herhangi bir kayıt eklenemedi.');
    }


	} elseif ($_GET['s']=="odemesil") {
		

$aab = $db->prepare("SELECT * FROM giden WHERE id = ?");
$aab->bindParam(1, $_GET['id'], PDO::PARAM_STR);
$aab->execute();
    $kab=$aab->fetch(PDO::FETCH_ASSOC);
		
		
		
$aa = $db->prepare("SELECT * FROM firm WHERE id = ?");
$aa->bindParam(1, $kab['firm'], PDO::PARAM_STR);
$aa->execute();
    $ka=$aa->fetch(PDO::FETCH_ASSOC);

$borc = $ka['borc'] + $kab['miktar'] ;		
		
$sorgua = $db->prepare("UPDATE firm SET borc = ? WHERE id = ?");
$sorgua->bindParam(1, $borc, PDO::PARAM_STR);
$sorgua->bindParam(2, $kab['firm'], PDO::PARAM_STR);
$sorgua->execute();
		
		
		
		
		
$sorgu = $db->prepare("DELETE FROM giden WHERE id = ?");
$sorgu->bindParam(1, $_GET['id'], PDO::PARAM_INT);
$sorgu->execute();

    if ($sorgu->rowCount() > 0) {
        header('Location: index.php?s=odemesirala&d='. $sorgu->rowCount() .' ödeme kaydı silindi.');
    } else {
        header('Location: index.php?s=odemesirala&d=Herhangi bir kayıt silinemedi.');
    }

	} elseif ($_GET['s']=="odemesirala") { ?>

	
<table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col" class="d-none d-sm-block">Sıra</th>
      <th scope="col">Miktar</th>
      <th scope="col" class="d-none d-sm-block">Açıklama</th>
      <th scope="col">Firma</th>
      <th scope="col">Tarih</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($db->query("SELECT * from giden Order by tarih DESC") as $giden) {
	  		 $gicon=$db->prepare("select * from firm where id=?");
             $gicon->execute(array($giden['firm']));
             $firma=$gicon->fetch(PDO::FETCH_ASSOC);
?>	  
 	  <?php if (date('l',$giden['tarih'])!="Monday" and $yenigun=="Monday"){echo "<tr><td colspan='6'></td></tr>";} ?>
 	<?php $yenigun = date('l',$giden['tarih']) ;?>
<?php if ($giden['aciklama']!="bospazartesi") {?>
   <tr>
      <th scope="row" class="d-none d-sm-block"><?=$giden['id'];?></th>
      <td><?=$giden['miktar'];?> TL</td>
      <td class="d-none d-sm-block"><small><?=$giden['nerden'];?>-<?=$giden['aciklama'];?></small></td>
      <td><?=$firma['ad'];?></td>
      <td class="m-0 p-0"><small class="m-0 p-0"><?=date('d.m.Y-l' ,$giden['tarih']);?><br><?=$giden['saat'];?></small></td>
      <td><a href="index.php?s=odemesil&id=<?=$giden['id'];?>" class="btn btn-sm btn-outline-danger">SİL</a></td>
   </tr>
	  <tr class="d-block d-sm-none"></tr><tr class=" d-sm-none"><td colspan="4"><?php if($giden['aciklama']==null){echo $giden['nerden']."-açıklama yok"; } else {echo $giden['nerden']."-".$giden['aciklama'];}?></td></tr>
<?php } ?>
<?php } ?>	  
  </tbody>
</table>
	<div class="col-12 border border-1 float-left" style="min-height: 250px;">
	<form action="?s=odeme" method="post" enctype="multipart/form-data">
		<div class="col-12 text-center">Ödeme Ekle</div>
		<div class="row mt-3">
			<div class="col-7"><input type="number"  step="0.01" name="gider" class="form form-control" placeholder="Gider Ekle"></div>
			<div class="col-5">
				<select class="form form-control" name="firm">
<?php foreach ($db->query("SELECT * from firm Order by id ASC") as $firm) {?>
					<option value="<?=$firm['id'];?>" ><?=$firm['ad'];?></option>
<?php } ?>
				</select>
			</div>
		</div>
		<div class="col-12">
			<input type="radio" name="nerden" value="kasadan" checked>Kasadan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" name="nerden" value="cepten">Cepten
		</div>
		<div class="col-12 mt-4 px-0">
			<input type="text" name="aciklama" class="form form-control" placeholder="Açıklama">
		</div>
		<div class="row my-3">
			<div class="col-6 text-left"><a href="?s=odemesirala" class="btn btn-outline-warning">TÜM GİDERLER</a></div>
			<div class="col-6 text-right"><input type="submit" value="EKLE" class="btn btn-outline-success"></div>
		</div>
	</form>
	</div>
	
<?php }
} else {	
?>	
	<div class="col-12 col-lg-6 border border-1 float-left" style="min-height: 250px;">
	<form action="?s=odeme" method="post" enctype="multipart/form-data">
		<div class="col-12 text-center">Ödeme Ekle</div>
		<div class="row mt-3">
			<div class="col-7"><input type="number"  step="0.01" name="gider" class="form form-control" placeholder="Gider Ekle"></div>
			<div class="col-5">
				<select class="form form-control" name="firm">
<?php foreach ($db->query("SELECT * from firm Order by id ASC") as $firm) {?>
					<option value="<?=$firm['id'];?>" ><?=$firm['ad'];?></option>
<?php } ?>
				</select>
			</div>
		</div>
		<div class="col-12">
			<input type="radio" name="nerden" value="kasadan" checked>Kasadan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" name="nerden" value="cepten">Cepten
		</div>
		<div class="col-12 mt-4 px-0">
			<input type="text" name="aciklama" class="form form-control" placeholder="Açıklama">
		</div>
		<div class="row my-3">
			<div class="col-6 text-left"><a href="?s=odemesirala" class="btn btn-outline-warning">TÜM GİDERLER</a></div>
			<div class="col-6 text-right"><input type="submit" value="EKLE" class="btn btn-outline-success"></div>
		</div>
	</form>
	</div>
<?php } ?>	
<!-- ödeme bölümü sonu -->	
	
<!-- kasa bölümü başı -->
	
	
<?php if (isset($_GET['s'])) {
	if ($_GET['s']=='kasa') {
			$sayim = $_POST['sayim'];
			$saat = date('H:i:s');
				
		
if ($_POST['tarih']==null) { $tarih = strtotime(date('d.m.Y')); } else { $tarih=strtotime($_POST['tarih']);}
		$nerden = "kasadan";
		
$sorgu2 = $db->prepare("SELECT SUM(miktar) as toplam FROM giden WHERE tarih=? AND nerden=?");
$sorgu2->bindParam(1, $tarih, PDO::PARAM_STR);
$sorgu2->bindParam(2, $nerden, PDO::PARAM_STR);
	$sorgu2->execute();
  $veribgn=$sorgu2->fetch(PDO::FETCH_ASSOC); 

		
$veridnn=$db->prepare("select * from kasa order by id DESC");
    $veridnn->execute();
    $veridn=$veridnn->fetch(PDO::FETCH_ASSOC);
	
		$kazanc1 = $veribgn['toplam'] + $_POST['sayim'] ;
		$kazanc = $kazanc1 - $veridn['sayim'] ;
		
$sorgu = $db->prepare("INSERT INTO kasa SET sayim = ?, tarih = ?, saat = ?, kazanc = ?");
$sorgu->bindParam(1, $sayim, PDO::PARAM_STR);
$sorgu->bindParam(2, $tarih, PDO::PARAM_STR);
$sorgu->bindParam(3, $saat, PDO::PARAM_STR);
$sorgu->bindParam(4, $kazanc, PDO::PARAM_STR);
$sorgu->execute();

if (date('l',$tarih)=="Monday") {		
$bos = "bospazartesi";		
$sorguge = $db->prepare("INSERT INTO gelen SET aciklama = ?, tarih = ?");
$sorguge->bindParam(1, $bos, PDO::PARAM_STR);
$sorguge->bindParam(2, $tarih, PDO::PARAM_STR);
$sorguge->execute();
$sorgugi = $db->prepare("INSERT INTO giden SET aciklama = ?, tarih = ?");
$sorgugi->bindParam(1, $bos, PDO::PARAM_STR);
$sorgugi->bindParam(2, $tarih, PDO::PARAM_STR);
$sorgugi->execute();
}		
		
    if ($sorgu->rowCount() > 0) {
        header('Location: index.php?d='. $sorgu->rowCount() .' kasa kaydı eklendi.');
    } else {
        header('Location: index.php?d=Herhangi bir kayıt eklenemedi.');
    }


	} elseif ($_GET['s']=="kasasil") {
$sorgu = $db->prepare("DELETE FROM kasa WHERE id = ?");
$sorgu->bindParam(1, $_GET['id'], PDO::PARAM_INT);
$sorgu->execute();

    if ($sorgu->rowCount() > 0) {
        header('Location: index.php?s=kasasirala&d='. $sorgu->rowCount() .' kasa kaydı silindi.');
    } else {
        header('Location: index.php?s=kasasirala&d=Herhangi bir kayıt silinemedi.');
    }

	} elseif ($_GET['s']=="kasasirala") { ?>

	
<table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col" class="d-none d-sm-block">Sıra</th>
      <th scope="col">Sayım</th>
      <th scope="col">Kazanç</th>
      <th scope="col">Tarih</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($db->query("SELECT * from kasa Order by tarih DESC") as $kasa) {
?>	  
    <tr>
      <th scope="row" class="d-none d-sm-block"><?=$kasa['id'];?></th>
      <td><?=$kasa['sayim'];?> TL</td>
      <td><?=$kasa['kazanc'];?></td>
      <td class="m-0 p-0"><small class="m-0 p-0"><?=date('d.m.y-l' ,$kasa['tarih']);?><br><?=$kasa['saat'];?></small></td>
      <td><a href="index.php?s=kasasil&id=<?=$kasa['id'];?>" class="btn btn-sm btn-outline-danger">SİL</a></td>
   </tr>
	  <?php if (date('l',$kasa['tarih'])=="Monday"){echo "<tr><td colspan='6' height='3'></td></tr>";} ?>
<?php } ?>	  
  </tbody>
</table>
	
	<div class="col-12 border border-1 float-left" style="min-height: 250px;">
	<form action="?s=kasa" method="post" enctype="multipart/form-data">
		<div class="col-12 text-center">Kasa Sayım Ekle</div>
		<div class="col-12 mt-4">
			<input type="number"  step="0.01" name="sayim" class="form form-control" placeholder="Sayım Ekle">
		</div>
		<div class="row my-3">
			<div class="col-4">
				<div class="col-12 mt-0 pl-3 pt-0"><input type="checkbox" onclick="gizleGoster('tarih');"> Elle Tarih Gir</div>
			</div>
			<div class="col-8" id="tarih" style="display: none;">
				<input type="text" name="tarih" class="form form-control col-11" placeholder="Tarih Ekle (gg.aa.yyyy)">
			</div>
		</div>
		<div class="row my-3">
			<div class="col-6 text-left"><a href="?s=kasasirala" class="btn btn-outline-warning">TÜM SAYIMLAR</a></div>
			<div class="col-6 text-right"><input type="submit" value="EKLE" class="btn btn-outline-success"></div>
		</div>
		<div class="col-12"></div>
	</form>
	</div>

	
<?php }
} else {	
?>	
	
	<div class="col-12 col-lg-6 border border-1 float-left" style="min-height: 250px;">
	<form action="?s=kasa" method="post" enctype="multipart/form-data">
		<div class="col-12 text-center">Kasa Sayım Ekle</div>
		<div class="col-12 mt-4">
			<input type="number"  step="0.01" name="sayim" class="form form-control" placeholder="Sayım Ekle">
		</div>
		<div class="row my-3">
			<div class="col-4">
				<div class="col-12 mt-0 pl-3 pt-0"><input type="checkbox" onclick="gizleGoster('tarih');"> Elle Tarih Gir</div>
			</div>
			<div class="col-8" id="tarih" style="display: none;">
				<input type="text" name="tarih" class="form form-control col-11" placeholder="Tarih Ekle (gg.aa.yyyy)">
			</div>
		</div>
		<div class="row my-3">
			<div class="col-6 text-left"><a href="?s=kasasirala" class="btn btn-outline-warning">TÜM SAYIMLAR</a></div>
			<div class="col-6 text-right"><input type="submit" value="EKLE" class="btn btn-outline-success"></div>
		</div>
		<div class="col-12"></div>
	</form>
	</div>

<?php } ?>	
	
	
	
<!-- kasa bölümü sonu -->
	
	
	
	
	
	
<!-- firma bölümü başı -->

<?php if (isset($_GET['s'])) {
	if ($_GET['s']=='firma') {
			$ad = $_POST['ad'];
			$borc = $_POST['borc'];
			$kisi = $_POST['kisi'];
			$tel = $_POST['tel'];

		
$sorgu = $db->prepare("INSERT INTO firm SET ad = ?, borc = ?, kisi = ?, tel = ?");
$sorgu->bindParam(1, $ad, PDO::PARAM_STR);
$sorgu->bindParam(2, $borc, PDO::PARAM_STR);
$sorgu->bindParam(3, $kisi, PDO::PARAM_STR);
$sorgu->bindParam(4, $tel, PDO::PARAM_STR);
$sorgu->execute();

    if ($sorgu->rowCount() > 0) {
        header('Location: index.php?d='. $sorgu->rowCount() .' ödeme kaydı eklendi.');
    } else {
        header('Location: index.php?d=Herhangi bir kayıt eklenemedi.');
    }


	} elseif ($_GET['s']=="firmasil") {
$sorgu = $db->prepare("DELETE FROM firm WHERE id = ?");
$sorgu->bindParam(1, $_GET['id'], PDO::PARAM_INT);
$sorgu->execute();

    if ($sorgu->rowCount() > 0) {
        header('Location: index.php?s=firmasirala&d='. $sorgu->rowCount() .' ödeme kaydı silindi.');
    } else {
        header('Location: index.php?s=firmasirala&d=Herhangi bir kayıt silinemedi.');
    }

	} elseif ($_GET['s']=="firmasirala") { ?>
	
<table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col" class="d-none d-sm-block">Sıra</th>
      <th scope="col">Firma Adı</th>
      <th scope="col" class="d-none d-sm-block">Pazarlamacı</th>
      <th scope="col">Telefon</th>
      <th scope="col">Borç</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($db->query("SELECT * from firm Order by id DESC") as $giden) {
	  if ($giden['ad']!="Muhammed") {?>	  
    <tr>
      <th scope="row" class="d-none d-sm-block"><?=$giden['id'];?></th>
      <td><a href="?s=firmayrinti&i=<?=$giden['id'];?>" class="nav-link"><?=$giden['ad'];?></a></td>
      <td class="d-none d-sm-block"><?=$giden['kisi'];?></td>
      <td><?=$giden['tel'];?></td>
      <td><?=$giden['borc'];?> TL</td>
      <td><a href="index.php?s=firmasil&id=<?=$giden['id'];?>" class="btn btn-sm btn-outline-danger">SİL</a></td>
   </tr>
<?php } } ?>

<?php	  
$toplm = $db->prepare("SELECT SUM(borc) as toplam FROM firm");
	$toplm->execute();
  $tplmsncz=$toplm->fetch(PDO::FETCH_ASSOC); 
	
										  
$mhmmdz = $db->prepare("SELECT * FROM firm WHERE id = ?");
	$mhmmdz->execute(array(1));
	$mhmd = $mhmmdz->fetch(PDO::FETCH_ASSOC);
										 
$tplmsnc=$tplmsncz['toplam']-$mhmd['borc'];
?>	  
     <tr>
      <th scope="row" class="d-none d-sm-block"></th>
      <td>Toplam Borç</td>
      <td class="d-none d-sm-block"></td>
      <td></td>
      <td><?=$tplmsnc;?> TL</td>
      <td></td>
   </tr>
     <tr>
      <th scope="row" class="d-none d-sm-block"></th>
      <td>Muhammed Tarafından Alınan</td>
      <td class="d-none d-sm-block"></td>
      <td></td>
      <td><?=$mhmd['borc'];?> TL</td>
      <td></td>
   </tr>
 </tbody>
</table>

	
	<div class="col-12 col-lg-12 border border-1 float-left" style="min-height: 250px;">
	<form action="?s=firma" method="post" enctype="multipart/form-data">
		<div class="col-12 text-center">Firma Ekle</div>
		<div class="col-12 mt-4 px-0"><input type="text" name="ad" class="form form-control" placeholder="Firma Adı"></div>
		<div class="col-12 mt-4 px-0"><input type="text" name="kisi" class="form form-control" placeholder="Pazarlamacı"></div>
		<div class="col-12 mt-4 px-0"><input type="number"  step="0.01" name="borc" class="form form-control" placeholder="Mevcut Borç"></div>
		<div class="col-12 mt-4 px-0"><input type="text" name="tel" class="form form-control" placeholder="Telefon"></div>
		<div class="row my-3">
			<div class="col-6 text-left"><a href="?s=firmasirala" class="btn btn-outline-warning">TÜM FİRMALAR</a></div>
			<div class="col-6 text-right"><input type="submit" value="EKLE" class="btn btn-outline-success"></div>
		</div>
	</form>
	</div>	
	
	
	
<?php }
} else {	
?>	
	<div class="col-12 col-lg-6 border border-1 float-left" style="min-height: 250px;">
	<form action="?s=firma" method="post" enctype="multipart/form-data">
		<div class="col-12 text-center">Firma Ekle</div>
		<div class="col-12 mt-4 px-0"><input type="text" name="ad" class="form form-control" placeholder="Firma Adı"></div>
		<div class="col-12 mt-4 px-0"><input type="text" name="kisi" class="form form-control" placeholder="Pazarlamacı"></div>
		<div class="col-12 mt-4 px-0"><input type="number"  step="0.01" name="borc" class="form form-control" placeholder="Mevcut Borç"></div>
		<div class="col-12 mt-4 px-0"><input type="text" name="tel" class="form form-control" placeholder="Telefon"></div>
		<div class="row my-3">
			<div class="col-6 text-left"><a href="?s=firmasirala" class="btn btn-outline-warning">TÜM FİRMALAR</a></div>
			<div class="col-6 text-right"><input type="submit" value="EKLE" class="btn btn-outline-success"></div>
		</div>
	</form>
	</div>
<?php } ?>	
<!-- firma bölümü sonu -->		
	
	
	
	

</div>
</div>
</div>



<?php include'headalt.php'; ?>
