<!DOCTYPE html>

<html>

  <head>

	  <!-- Global site tag (gtag.js) - Google Analytics -->

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-59451860-2"></script>

<script>

  window.dataLayer = window.dataLayer || [];

  function gtag(){dataLayer.push(arguments);}

  gtag('js', new Date());



  gtag('config', 'UA-59451860-2');

</script>



<link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">







	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



      <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">



	  <meta name="viewport" content="width=device-width, initial-scale=1">



	  <title>kasa</title>



	  <link href="../css/bootstrap-4.4.1.css" rel="stylesheet">





	  <style>

		  #saat {

			  position: absolute;

			  top: 5px;

			  left: 5px;

			  height: 35px;
			  z-index: 10;

		  }

		  #bilgilendirme {

			  position: absolute;

			  top: 62px;

			  left: 5px;

			  height: 35px;

			  z-index: 1;

		  }

		  .ustcizili {

			  text-decoration-line: line-through !important;

		  }



		  .bg-soft-black {

			  background-color: #000000dd;

		  }

		  .bg-soft-black2 {

			  background-color: #00000099;

		  }

		  .bg-soft-red {

			  background-color: #5d1410;

		  }

		  .nav-ust {

			  color: aliceblue;

			  font-size: 12px;

		  }

		  .nav-ust:hover {

			  color:#767676;

			  text-decoration: none;

		  }

		  .slayt {

			  font-family: "Lucida Calligraphy" !important;

			  font-style: italic !important;

			  color:#968517 !important;

		  }

		  .btn-link {

             color: #dc3545 !important;

            text-decoration: none;

          }

		  .btn-link:hover {

             color: #e87f89 !important;

            text-decoration: none;

          }

		  .btn-link:focus {

             color: #dc3545 !important;

            text-decoration: none;

          }

		  .btn-link2 {

             color: #dc3545 !important;

            text-decoration: none;

          }

		  .btn-link2:hover {

             color: #e87f89 !important;

            text-decoration: none;

          }

		  .dropdown-item {

            color: #f8f9fa !important;

            background-color: #dc3545 !important;

          }

		  .dropdown-item:hover {

            color: #f8f9fa !important;

            background-color: #e87f89 !important;

          }

         .dropdown-menu {

            background-color: #dc3545 !important;

          }

::-webkit-scrollbar {

    width: 10px;

    background-color: #eaeaea;

    border-left: 1px solid #ccc;

}

::-webkit-scrollbar-thumb {

    background-color: #596971;

}

::-webkit-scrollbar-thumb:hover {

    background-color: #2E3944;

}

.navbar-dark .navbar-nav .nav-link {

  color: rgba(255, 255, 255, 0.80) !important;

}



.navbar-dark .navbar-nav .nav-link:hover, .navbar-dark .navbar-nav .nav-link:focus {

  color: rgba(255, 255, 255, 0.50) !important;

}



.navbar-dark .navbar-nav .nav-link.disabled {

  color: rgba(255, 255, 255, 0.25) !important;

}

	  </style>

<script>

function gizleGoster(ID) {

  var secilenID = document.getElementById(ID);

  if (secilenID.style.display == "none") {

    secilenID.style.display = "";

  } else {

    secilenID.style.display = "none";

  }

}

</script>





	  

	  

	  

	</head>







		        <body>



	<div id="saat"><?php echo date('d.m.Y H:i:s')?><br>
					<a href="siparis.php" class="btn btn-outline-danger btn-sm" >Siparişler</a></div>	

<?php if (isset($_GET['d'])) { ?>

	<div id="bilgilendirme" class="text-warning"><h5><?php echo $_GET['d']; ?></h5></div>				

<?php } ?>					



<!-- tadilat baş -->

	<?php

	if (!isset($_SESSION['giriskontrol'])) {

		?>

<nav class="col-12 fixed-top text-white bg-soft-black2 my-0 py-0 text-center">

    <div class="container border border-0 mt-0 pt-5" style="min-height: 900px;">

	<form action="uyeislem.php?islem=giris" method="post" id="uyegiris">



<div class="row ml-auto pl-auto mt-5 text-center">

	<div class="col-12 col-md-8 col-lg-6 mx-auto mt-2 py-2 border border-1">		

		<div class="row">

			<div class="col-12">KASA YÖNETİMİ <BR></div>

		</div>



	  

<input type="password" name="sahte_parola" id="sahte_parola" value="" style="display:none;" >

		<div class="row text-left py-2">

			<div class="col-12 col-md-3">Şifreniz<span class="required">*</span></div>

			<div class="col-12 col-md 9"><input name="password" value="" size="7" onKeyUp="pin();" placeholder="Şifrenizi Giriniz" type="number" id="password" required="required" class="form-control col-md-12 col-xs-12" autocomplete="false"></div>

		</div>

<script>

function pin() {

  var pinlen = <?php echo strlen($pin['pass']);?>;

 

  if (document.getElementById("password").value.length == pinlen) {

	document.getElementById("subb").click() ; 

  }

  

}

</script>

	

		<div class="row text-center py-2">

			<div class="col-12 col-md 6"><button type="submit" id="subb" name="uyegiris" class="btn btn-success btn-sm">Giriş Yap</button></div>

		</div>

	

	</div>	

</div>	



		

	</form>



	

	</div>

</nav>

    <?php

	} else {

	}

	?>

<!-- tadilat son -->















		 <nav class="navbar navbar-dark bg-soft-black my-0 py-0 text-center">



 <div class="container">



	         <div class="col-md-2  d-block d-sm-block d-md-none d-lg-none d-xl-none">

				  <a class="navbar-brand" href="index.php">

				   <img src="../images/logo.png" width="100" class="img-fluid">

				  </a>

                </div>















                <div class="col-md-2 d-none d-md-block">

				  <a class="navbar-brand" href="index.php">

				   <img src="../images/logo.png" class="img-fluid">

				  </a>

                </div>

				 <div class="col-md-5 ml-0 pl-0 mr-auto text-white d-none d-md-block">

					<h2 class="mr-auto pl-0 ml-0 slayt">Lokumcu Muhammed</h2>

	             </div>

				<div class="col-md-5 mt-0 pt-0">

				  <div class="row">



<div class="text-white p-0 mt-0 ml-auto ">



              <div class="row">



<?php

		if (isset($_SESSION['giriskontrol'])) { 

			if (!isset($_SESSION['cihaz'])) {

				  ?>

			

	  <a href="uyeislem.php?islem=cikis">

	  <button class="btn btn-outline-danger btn-sm btn-link2 m-1 my-sm-1" type="submit">Çıkış Yap</button></a>



<?php					

				}

 } else { ?>





		<?php } ?>















		</div>

</div>







					</div>



               </div>



 </div>



		</nav>







<!-- ----------------------------------------------------------------------------------------------------------------------------- -->



 



<div class="row navbar-dark bg-soft-red text-white p-0 m-0" style="min-height: 40px;">

	<div class="col-6 col-sm-3 text-center my-1"><a class="col-12 btn btn-outline-warning" href="index.php?s=gelensirala">GELENLER</a></div>

	<div class="col-6 col-sm-3 text-center my-1"><a class="col-12 btn btn-outline-warning" href="index.php?s=odemesirala">ÖDEMELER</a></div>

	<div class="col-6 col-sm-3 text-center my-1"><a class="col-12 btn btn-outline-warning" href="index.php?s=firmasirala">FİRMALAR</a></div>

	<div class="col-6 col-sm-3 text-center my-1"><a class="col-12 btn btn-outline-warning" href="index.php?s=kasasirala">KASA DURUMU</a></div>

</div>



					<div class="bg-dark text-white m-0 p-0">

