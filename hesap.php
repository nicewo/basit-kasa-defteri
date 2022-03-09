<?php
include 'baglanti.php';
include 'head.php' ;
include 'ililce.php'; 
?>

<div class="py-3">




  <script src="js/jquery.min.js"></script>



<div class="container">
<?php
	$id = $_SESSION['user']['id'];
	
	$uyeler = $db -> prepare("Select * From uye WHERE id=?");
	$uyeler -> execute(array($id));
	$uye = $uyeler->Fetch();
  ?>  
    <div class="row">
				<div class="container col-12 col-xl-8 col-lg-8 col-md-10 col-sm-12">
					<div class="row">
						<div class="col-md-12">
							<h4 class="mt-3 mb-3">Merhaba <?php echo $uye['name']."&nbsp;".$uye['surname'] ?></h4>
							<small class="text-success">Bu bölümde e-posta adresinizi ve şifrenizi değiştirebilirsiniz.<br>Şifrenizi değiştirmek istemiyorsanız bu bölümü boş bırakınız.</small>
							
							<div class="divider divider-primary divider-small mb-xl">
								<hr>
							</div>

							<h4 class="text-danger text-center">
							<?php
	if (isset($_GET['sonuc'])) {
		if ($_GET['sonuc']=="ok") {
			echo "Şifreniz başarıyla değiştirildi.";
		} elseif ($_GET['sonuc']=="pass12no") {
			echo "Yeni şifreleriniz birbiriyle uyuşmuyor.";
		} elseif ($_GET['sonuc']=="mpassno") {
			echo "Mevcut şifreniz kayıtlarımızdakiyle uyuşmuyor.";
		}
	}
								?>
							
							</h4>

							<form id="passguncelle" action="uyeislem.php?islem=guncelle" method="POST">

								
                      <div class="form-group">
						  <div class="row">
							  <div class="col-4">
                            <label class="control-label col-12 btn-sm" for="mail">E-Posta Adresiniz
							<span class="required">*</span>
                            </label>
							  </div>
                        <div class="col-8">
                          <input name="mail" value="<?php echo $uye['mail']; ?>" disabled placeholder="E-Posta Adresiniz" type="mail" required="required" class="form-control col-md-12 col-xs-12 btn-sm">
                        </div>
						  </div>
                      </div>		  
								

								
                      <div class="form-group">
						  <div class="row">
							  <div class="col-4">
                            <label class="control-label col-12 btn-sm" for="mpass">Mevcut Şifreniz
							<span class="required">*</span>
                            </label>
							  </div>
                        <div class="col-8">
                          <input name="mpass" placeholder="Mevcut Şifreniz" type="password" required="required" class="form-control col-md-12 col-xs-12 btn-sm">
                        </div>
						  </div>
                      </div>		  								
								
                      <div class="form-group">
						  <div class="row">
							  <div class="col-4">
                            <label class="control-label col-12 btn-sm" for="pass">Yeni Şifreniz
							<span class="required">*</span>
                            </label>
							  </div>
                        <div class="col-3">
                          <input name="pass" id="pass" value="" placeholder="Yeni Şifrenizi Giriniz" type="password" required="required" class="form-control col-md-12 col-xs-12 btn-sm mr-0 pr-0">
							<label id="guclu_mu"></label>
                        </div>
							  <div class="col-2">
                            <label class="control-label col-12 btn-sm mx-0 px-0" for="pass2">Şifreniz (tekrar)
							<span class="required">*</span>
                            </label>
							  </div>
                        <div class="col-3">
                          <input name="pass2" id="pass2" value="" placeholder="Yeni Şifrenizi tekrar giriniz" type="password" required="required" class="form-control col-md-12 col-xs-12 btn-sm ml-0 pl-0">
							<label id="sifre_sonuc"></label>
                        </div>
						  </div>
                      </div>		  
								
								<div class="row col-12 ml-auto mr-0 pl-auto pr-0 text-right">
									<div class="col-12 ml-auto mr-0">
										<input type="submit" name="passguncelle" value="Şifreyi Güncelle" class="btn btn-sm btn-primary mr-0 mb-xlg ml-auto" data-loading-text="Gönderiliyor...">
									</div>
								</div>
							</form>
								

							
							
							<small>Bu bölümde bilgilerinizi güncelleyebilirsiniz.</small>
							
							<div class="divider divider-primary divider-small mb-xl">
								<hr>
							</div>							
							
							
							<form id="bilgiguncelle" name="bilgiguncelle" action="uyeislem.php?islem=guncelle" method="POST">

								
                      <div class="form-group">
						  <div class="row">
							  <div class="col-4">
                            <label class="control-label col-12 btn-sm" for="name">Adınız ve Soyadınız
							<span class="required">*</span>
                            </label>
							  </div>
                        <div class="col-4">
                          <input name="name" value="<?php echo $uye['name']; ?>" placeholder="Adınız" type="text" required="required" class="form-control col-md-12 col-xs-12 btn-sm">
                        </div>
                        <div class="col-4">
                          <input name="surname" value="<?php echo $uye['surname']; ?>" placeholder="Soyadınız" type="text" required="required" class="form-control col-md-12 col-xs-12 btn-sm">
                        </div>
						  </div>
                      </div>		  
								


								
                      <div class="form-group">
						  <div class="row">
							  <div class="col-4">
                            <label class="control-label col-12 btn-sm" for="tel">Telefon Numaranız
							<span class="required">*</span>
                            </label>
							  </div>
                        <div class="col-8">
                          <input name="tel" id="tel" type="tel" value="<?php echo $uye['tel']; ?>" placeholder="0 (123) 123 4567" required="required" class="form-control col-md-12 col-xs-12 btn-sm">
                        </div>
						  </div>
                      </div>		  
  
					 <div class="form-group">
						  <div class="row">
							  <div class="col-4">
                            <label class="control-label col-12 btn-sm" for="tel">Adresiniz
							<span class="required">*</span>
                            </label>
							  </div>
                        <div class="col-8">
						  <textarea class="form-control col-12 btn-sm" name="address"><?php echo $uye['address']; ?></textarea>
                        </div>
						  </div>
                      </div>		  

								
								
					 <div class="form-group">
						  <div class="row">
							  <div class="col-4">
                            <label class="control-label col-12 btn-sm" for="tel">İl
							<span class="required">*</span>
                            </label>
							  </div>
                        <div class="col-8">

							  
    <select name="il" id="il" onchange="set_player()" class="form-control">
    <option selected="selected" style="background-color:#FFCC00;">Lütfen Seçiniz</option>
    <option value="Ankara">Ankara</option>
    <option value="İstanbul">İstanbul</option>
    <option value="İzmir">İzmir</option>
    <option>--------------</option>
    <option value="Adana">Adana</option>
    <option value="Adıyaman">Adıyaman</option>
    <option value="Afyon">Afyon</option>
    <option value="Ağrı">Ağrı</option>
    <option value="Aksaray">Aksaray</option>
    <option value="Amasya">Amasya</option>
    <option value="Antalya">Antalya</option>
    <option value="Ardahan">Ardahan</option>
    <option value="Artvin">Artvin</option>
    <option value="Aydın">Aydın</option>
    <option value="Balıkesir">Balıkesir</option>
    <option value="Bartın">Bartın</option>
    <option value="Batman">Batman</option>
    <option value="Bayburt">Bayburt</option>
    <option value="Bilecik">Bilecik</option>
    <option value="Bingöl">Bingöl</option>
    <option value="Bitlis">Bitlis</option>
    <option value="Bolu">Bolu</option>
    <option value="Burdur">Burdur</option>
    <option value="Bursa">Bursa</option>
    <option value="Çanakkale">Çanakkale</option>
    <option value="Çankırı">Çankırı</option>
    <option value="Çorum">Çorum</option>
    <option value="Denizli">Denizli</option>
    <option value="Diyarbakır">Diyarbakır</option>
    <option value="Düzce">Düzce</option>
    <option value="Edirne">Edirne</option>
    <option value="Elazığ">Elazığ</option>
    <option value="Erzincan">Erzincan</option>
    <option value="Erzurum">Erzurum</option>
    <option value="Eskişehir">Eskişehir</option>
    <option value="Gaziantep">Gaziantep</option>
    <option value="Giresun">Giresun</option>
    <option value="Gümüşhane">Gümüşhane</option>
    <option value="Hakkari">Hakkari</option>
    <option value="Hatay">Hatay</option>
    <option value="Iğdır">Iğdır</option>
    <option value="Isparta">Isparta</option>
    <option value="Kahramanmaraş">Kahramanmaraş</option>
    <option value="Karabük">Karabük</option>
    <option value="Karaman">Karaman</option>
    <option value="Kars">Kars</option>
    <option value="Kastamonu">Kastamonu</option>
    <option value="Kayseri">Kayseri</option>
    <option value="Kırıkkale">Kırıkkale</option>
    <option value="Kırklareli">Kırklareli</option>
    <option value="Kırşehir">Kırşehir</option>
    <option value="Kilis">Kilis</option>
    <option value="Kocaeli">Kocaeli</option>
    <option value="Konya">Konya</option>
    <option value="Kütahya">Kütahya</option>
    <option value="Malatya">Malatya</option>
    <option value="Manisa">Manisa</option>
    <option value="Mardin">Mardin</option>
    <option value="Mersin">Mersin</option>
    <option value="Muğla">Muğla</option>
    <option value="Muş">Muş</option>
    <option value="Nevşehir">Nevşehir</option>
    <option value="Niğde">Niğde</option>
    <option value="Ordu">Ordu</option>
    <option value="Osmaniye">Osmaniye</option>
    <option value="Rize">Rize</option>
    <option value="Sakarya">Sakarya</option>
    <option value="Samsun">Samsun</option>
    <option value="Siirt">Siirt</option>
    <option value="Sinop">Sinop</option>
    <option value="Sivas">Sivas</option>
    <option value="Şanlıurfa">Şanlıurfa</option>
    <option value="Şırnak">Şırnak</option>
    <option value="Tekirdağ">Tekirdağ</option>
    <option value="Tokat">Tokat</option>
    <option value="Trabzon">Trabzon</option>
    <option value="Tunceli">Tunceli</option>
    <option value="Uşak">Uşak</option>
    <option value="Van">Van</option>
    <option value="Yalova">Yalova</option>
    <option value="Yozgat">Yozgat</option>
    <option value="Zonguldak">Zonguldak</option>
    </select>							  
							  
							  </div>
						  </div>
                      </div>		  
								
								
								
								
								
					 <div class="form-group">
						  <div class="row">
							  <div class="col-4">
                            <label class="control-label col-12 btn-sm" for="tel">İl
							<span class="required">*</span>
                            </label>
							  </div>
                        <div class="col-8">

							  
    <select name="ilce" id="ilce" onchange="set_player2()" class="form-control">
    <option>Önce İl Seçiniz</option>
	<option value="diger">Listede Yok</option>
    </select>
							<input type="text" id="ilce_sonuc" name="ilce2" placeholder="İlçenizi Yazınız." class="d-none form-control">
							
							  </div>
						  </div>
                      </div>		  
								
								
																
								<div class="row col-12 ml-auto mr-0 pl-auto pr-0 text-right">
									<div class="col-12 ml-auto mr-0">
										<input type="submit" name="bilgiguncelle" value="Bilgileri Güncelle" class="btn btn-sm btn-primary mr-0 mb-xlg ml-auto" data-loading-text="Gönderiliyor...">
									</div>
								</div>
							</form>

						</div>

					</div>
				</div>

				<div class="container col-0 col-xl-4 col-lg-4 col-md-2 col-sm-0 text-white"></div>

    
    
    </div>
    
    
    </div>
	
	
	
	
	
	
	
	
</div>

<?php include'headalt.php'; ?>