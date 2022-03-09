<?php
$firmi = $db->prepare("SELECT * FROM firm WHERE id = ?");
	$firmi->execute(array($_GET['i']));
	$firm = $firmi->fetch(PDO::FETCH_ASSOC);
?>


<center><h3><?=$firm['ad'];?></h3></center>
<center><h5>Mevcut Borç = <font color="#f00"><?=$firm['borc'];?> TL</font></h5></center>


<center>Gelen Mallar</center>

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
<?php foreach ($db->query("SELECT * from gelen Order by id DESC") as $giden) {

	if ($giden['firm']==$_GET['i']) {
?>	  
	  <?php if (date('l',$giden['tarih'])!="Monday" and $yenigun=="Monday"){echo "<tr><td colspan='6'></td></tr>";} ?>
 	<?php $yenigun = date('l',$giden['tarih']) ;?>
<?php if ($giden['aciklama']!="bospazartesi") {?>
    <tr>
      <th scope="row" class="d-none d-sm-block"><?=$giden['id'];?></th>
      <td><?=$giden['miktar'];?> TL</td>
      <td class="d-none d-sm-block"><?php if($giden['aciklama']==null){echo "açıklama yok"; } else {echo $giden['aciklama'];}?></td>
      <td><?=$firm['ad'];?></td>
      <td class="m-0 p-0"><small class="m-0 p-0"><?=date('d.m.Y-l' ,$giden['tarih']);?><br><?=$giden['saat'];?></small></td>
      <td>
		  <a href="index.php?s=gelensil&id=<?=$giden['id'];?>" class="btn btn-sm btn-outline-danger">SİL</a>
	  </td>
   </tr>
	  <tr class="d-block d-sm-none"></tr><tr class=" d-sm-none"><td colspan="4"><?php if($giden['aciklama']==null){echo "açıklama yok"; } else {echo $giden['aciklama'];}?></td></tr>
<?php } //bos pazartesi sonu ?>	  
<?php } }?>	  
  </tbody>
</table>

<center>Yapılan Ödemeler</center>
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
<?php foreach ($db->query("SELECT * from giden Order by id DESC") as $giden2) {

	if ($giden2['firm']==$_GET['i']) {
?>	  
	  <?php if (date('l',$giden2['tarih'])!="Monday" and $yenigun=="Monday"){echo "<tr><td colspan='6'></td></tr>";} ?>
 	<?php $yenigun = date('l',$giden2['tarih']) ;?>
<?php if ($giden2['aciklama']!="bospazartesi") {?>
    <tr>
      <th scope="row" class="d-none d-sm-block"><?=$giden2['id'];?></th>
      <td><?=$giden2['miktar'];?> TL</td>
      <td class="d-none d-sm-block"><?php if($giden2['aciklama']==null){echo "açıklama yok"; } else {echo $giden2['aciklama'];}?></td>
      <td><?=$firm['ad'];?></td>
      <td class="m-0 p-0"><small class="m-0 p-0"><?=date('d.m.Y-l' ,$giden2['tarih']);?><br><?=$giden2['saat'];?></small></td>
      <td>
		  <a href="index.php?s=gelensil&id=<?=$giden2['id'];?>" class="btn btn-sm btn-outline-danger">SİL</a>
	  </td>
   </tr>
	  <tr class="d-block d-sm-none"></tr><tr class=" d-sm-none"><td colspan="4"><?php if($giden2['aciklama']==null){echo "açıklama yok"; } else {echo $giden2['aciklama'];}?></td></tr>
<?php } //bos pazartesi sonu ?>	  
<?php } }?>	  
  </tbody>
</table>
