<?php
	if (!isset($_SESSION["USER:LOGGED"])) {
		Redirect("login", false);
	}
	if (isset($_SESSION["USER:DATA"])) {
		$account_data = $_SESSION["USER:DATA"];
		$character_data = getCharacterData($_SESSION["USER:DATA"]["id"]);
	}
?>


        
<!DOCTYPE html>
		<html lang="en" xmlns="https://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">
			<head>
				<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
				
				<meta charset="utf-8">
				<meta name="description" content="San MTA v3">
				<meta name="keywords" content="Sanmta San mta, v3, multi theft auto, Multi Theft Auto, grand theft auto, Grand Theft Auto, San Andreas stories, san andreas stories, mta, cnr, cops and robbers, clan war, clan wars">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<meta property="fb:app_id" content="757511084286070"/>
				<meta property="og:url" content="https://sangame.best" />
				<meta property="og:title" content="SanMTA | www.sangame.best" />
				<meta property="og:image" content="https://sangame.best/Assets/Images/bg2.jpg" />
		
				<title>SanMTA | www.sangame.best</title>
				<link rel="icon" href="favicon.ico"/>
				<!-- Bootstrap, Fonts Awesome -->
				<link href="Assets/Stylesheets/bootstrap.css" rel="stylesheet">
				<link href="Assets/Stylesheets/font-awesome.css" rel="stylesheet">
				<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
				<link href="Assets/Stylesheets/alertify.core.css" rel="stylesheet">
				<link href="Assets/Stylesheets/alertify.bootstrap.css" rel="stylesheet">
				<script src="Assets/Scripts/alertify.js"></script>
				<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
				<script src="Assets/Scripts/bootstrap.min.js"></script>
				<script src="Assets/Scripts/utils.js"></script>
				<script src="Assets/Scripts/login.js"></script>
				<script src="Assets/Scripts/circles.js"></script>
				<script src="Assets/Scripts/bootstrap-progressbar.js"></script>
				<!-- Highcharts -->
				<script src="https://code.highcharts.com/highcharts.js"></script>
				<script src="Assets/Scripts/charts_dark.js"></script>
				<script src='https://www.google.com/recaptcha/api.js'></script>
			</head>
			<body>
				<nav class="navbar navbar-inverse navbar-fixed-top">
					<div class="container-fluid">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarMain">
								<span class="sr-only">Navigáció</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="https://ucp.sangame.best/"><img src="Assets/Images/logo.png" style="max-height: 125%; margin-top: -5px; display: inline; margin: 0 10px;"/>San<font color="#7cc576">MTA v3</font> <font color="lightgrey"> -   User Control Panel</font></a>
						</div>
		
						<div class="collapse navbar-collapse" id="navbarMain">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="http://ucp.sangame.best/">Kezdőlap</a></li>
						<li class="active"><a href="http://sangame.best/#premium"><img width="16px" height="16px" src="Assets/Images/premiumlogos/diamond.png"/> Vásárlás - PrémiumPont</a></li>
						<li><a href="http://www.forum.sangame.best/index.php?threads/v3-szerver-szab%C3%A1lyzat.2/">Szabályzat</a></li>
						<!--<li><a href="index.php?page=jobs">Munkák</a></li>-->
						<li><a href="http://forum.sangame.best/">Fórum</a></li>
											</ul>
				</div>
			</div>
		</nav>
		
		<div id="wrap">
									<div class="topmenu">
							<div class="container-fluid">
								<div class="col-md-4">
									<i class="fa fa-user"></i>
									Üdv, <font color="#32b3ef"><?=$account_data["username"];?></font>!
								</div>
								<div class="col-md-8 toplinks">				<?php
				if ($account_data["admin"] >= $config['min_admin2']){
			?>
		<a href="admin2"><i class="fa fa-street-view"></i> Admin+</a> <img src="Assets/Images/nex.png"/>
			<?php
				}
			?><?php
				if ($account_data["admin"] >= $config['min_admin']){
			?>
		<a href="admin"><i class="fa fa-street-view"></i> Admin</a> <img src="Assets/Images/nex.png"/>
		<a href="adminstats"><i class="fa fa-street-view"></i> Admin Statok</a> <img src="Assets/Images/nex.png"/>
		<a href="kereso"><i class="fa fa-search"></i> Kereső</a> <img src="Assets/Images/nex.png"/>
			<?php
				}
			?>
																	<a href="serialchange"><i class="fa fa-hdd-o"></i> Serial váltás</a> <img src="Assets/Images/nex.png"/> <a href="changename"><i class="fa fa-ticket"></i> Név váltás</a> <img src="Assets/Images/nex.png"/> <a href="settings"><i class="fa fa-user"></i> Profil </a> <img src="Assets/Images/nex.png"/><a href="logout"><i class="fa fa-sign-out"></i> Kijelentkezés</a>
															</div>
							</div>
						</div>
			
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v2.0";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
<script>
    $(function ($) {
        $("a").tooltip({html: true})
    });
</script>

<div class="container">
	<h2 class="pagetitle"><i class="fa fa-info-circle"></i> <font color="#32b3ef"><?=$account_data["username"];?></font> profilja</h2>
	<div class="col-md-12 content1">
		<h2>Általános információk</h2>
						<span class="badge3"><?=$character_data["premiumpont"];?></span>
				Prémium Pont:		<hr>
			</li>
			<span class="badge3"><?=$character_data["coins"];?></span>
				San Pontok:		<hr>
			</li>
				<span class="badge3"><?=$account_data["email"];?></span>
				Email cím:		<hr>
			</li>
				<span class="badge6"><?=$account_data["regdate"];?></span>
				Regisztráció ideje:		<hr>
			</li>
				<span class="badge4"><?=$account_data["mtaserial"];?></span>
				MTA Serial:		<hr>
			</li>
				<span class="badge5"><?=$account_data["admin"];?></span>
				Admin szint:	<hr>
			</li>
				<span class="badge5"><?=$character_data["anick"];?></span>
				Admin nick (ha van):	<hr>
			</li>
				<span class="badge5"><?=$account_data["aseged"];?></span>
				Adminsegéd szint:<hr>
			</li>
		</ul>
	</div>

		<div class="col-md-12 content1">
		<h2>Kitiltások</h2>
		<div class="table-responsive"> 
			<table class="table">
				<thead>
					<tr class="tr2">
						<th class="col-md-1">ID</th>
						<th class="col-md-2">Admin</th>
						<th class="col-md-4">Indok</th>
						<th class="col-md-2">Időpont</th>
						<th class="col-md-2">Lejár</th>
						<th class="col-md-1">Állapot</th>
						</tr>		
			<tr>		
				<?=getBans($account_data["id"]);?>	 	
			</tr>		 	
		</table>
		</div>
	</div>

		<div class="col-md-12 content1">
		<h2>Admin jailek</h2>
		<div class="table-responsive"> 
			<table class="table">
				<thead>
					<tr class="tr2">
						<th class="col-md-2">Időpont</th>
						<th class="col-md-5">Indoklás</th>
						<th class="col-md-2">Hossz</th>
						<th class="col-md-3">Admin</th>
						</tr>		
			<tr>		
				<?=getAjails($account_data["id"]);?>	 	
			</tr>		 	
		</table>
		</div>
	</div>

		<div class="col-md-12 content1">
		<h2>Serial váltási kérelmek</h2>
		<div class="table-responsive"> 
			<table class="table">
				<thead>
					<tr class="tr2">
						<th class="col-md-1">ID</th>
						<th class="col-md-2">Serial</th>
						<th class="col-md-5">Indok</th>
						<th class="col-md-3">Időpont</th>
						<th class="col-md-1">Állapot</th>
						</tr>		
			<tr>		
				<?=getSerialChanges($account_data["id"]);?>	 	
			</tr>		 	
		</table>
		</div>
	</div>

		<div class="col-md-12 content1">
		<h2>Név váltási kérelmek</h2>
		<div class="table-responsive"> 
			<table class="table">
				<thead>
					<tr class="tr2">
						<th class="col-md-1">ID</th>
						<th class="col-md-2">Név</th>
						<th class="col-md-2">Új név</th>
						<th class="col-md-5">Indok</th>
						<th class="col-md-3">Időpont</th>
						<th class="col-md-1">Állapot</th>
						</tr>		
				<?=getNameChanges($account_data["id"]);?>	
				</table>	
		</div>
	</div>
	
	<div class="col-md-12 content1 mb">
				<h2>Karakterek (1)</h2>
				<i class="fa fa-location-arrow"></i>
				<a href="karakter">
				<?=$character_data["charname"];?> (<?=$account_data["id"];?>)				</a>
						</div>

</div>

<script>
	$(document).ready(function() {
		$('.progress .progress-bar').progressbar();
	});
</script></div>
	<div id="footer">
		<div class="container-fluid">
			<div class="col-md-8">SanMTA v3 - User Control Panel<br>Copyright @ 2020 - www.sangame.best | Minden jog fenntartva!<br>Az oldal létrehozásának ideje 0.1916 másodperc.</div>
			<div class="col-md-4 fr"><a style="color: grey;" href="">Általános Szerződési Feltételek</a></div>
		</div>
	</div>
</body>
</html>
<script>
	$(document).ready(function() {
		$('.progress .progress-bar').progressbar();
	});
</script>
