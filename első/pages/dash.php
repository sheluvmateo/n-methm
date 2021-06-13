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
					}(document, 'script', 'facebook-jssdk'));</script><div class="container">
			<div class="row">
				
				<div class="col-md-8 content1 mb">
					<h4 class="gr" style="color: #7cc576; font-size: 200%;"><i class="fa fa-newspaper-o"></i> Hírek</h2>
					<div class="date">2020-04-24 20:16:58 | Írta: Webmaster</div>
				<h2 class="newstitle">SanMTA v3 </h2>
				<p style="text-align:center;">
<img width="100%" src="/Assets/Images/forum7b698.png" alt=" " />
<br>
<br>
Regisztrációnál a következőket vedd figyelembe:
<br><br>1. NE használd más MTA szerveren ugyan azt a jelszót, amit SanMTA-n is használsz!<br>2. NE egyezzen meg FÓRUM és SZERVER-en lévő jelszavad!<br><br><span style="font-weight:bold;">Account feltörésekért SanMTA felelősséget semmilyen formában nem vállal!</span>
<br>
<br>
TS3 IP: sangame.tsdns.hu<br>
Forum: <a href="http://forum.sangame.best/" title="forum.sangame.best">forum.sangame.best</a><br>
MTA SA 1.5 IP: 37.221.209.131:22318<br>
<br>
<br>
Segítő videók:
<br>
<br>Letöltés, telepítés, csatlakozás:<br><iframe width="100%" height="400px" src="https://www.youtube.com/embed/tcTaSyUEuq0" frameborder="0" allowfullscreen></iframe><br>
</p>				<div class="more">
							<a href=""> <i class="fa fa-comments-o"></i> Hozzászólások </a>
						</div>
									<div class="date">2020-04-24 12:16:58 | Írta: Webmaster</div>
						<h2 class="newstitle">Account lopás elleni tippek</h2>
						<span style="font-weight:bold;">MINDENFÉLEKÉPPEN válts jelszót az alábbi tippeket követve!</span><br><br>1. - NE használd más MTA szerveren ugyan azt a jelszót, amit SanMTA-n is használsz, hiszen volt már példa arra, hogy más MTA szerverek jelszavakat loptak.<br>2. - Ne egyezzen meg FÓRUM és SZERVER-en lévő jelszavad!<br><br><span style="font-weight:bold;">Account feltörésekért SanMTA felelősséget semmilyen formában nem vállal!</span>				<div class="more">
							<a href=""> <i class="fa fa-comments-o"></i> Hozzászólások </a>
						</div>
							</div>
							<div class="col-md-4 content1">
						<h4 class="gr"><i class="fa fa-unlock-alt"></i> Üdv, <font color="#32b3ef"><?=$account_data["username"];?></font>!</h4>
		
						<font color="#7cc576">Account felfüggesztve:</font>
						<br>Nem
										<br>
						<!-- ACC ID -->
						<font color="#7cc576">Account ID:</font>
						<br><?=$account_data["id"];?>
										<br>
						
						<!-- SERIAL -->
						<font color="#7cc576">Jelenlegi serial:</font>
						<br><?=$account_data["mtaserial"];?>
										<br>
						<!-- IP -->
						<font color="#7cc576">IP címed:</font>
						<br><?=$account_data["ip"];?>
										<br>
						<!-- REGTIME -->
						<font color="#7cc576">Regisztráció ideje:</font>
										<br><?=$account_data["regdate"];?>
						<hr>
						
							
																	<font color="#7cc576">Elérhető karakterek (1/1):</font>
							
													<br>
								<i class="fa fa-location-arrow"></i>
								<a href="karakter">
								<?=$character_data["charname"];?> (<?=$account_data["id"];?>)
								</a>
														</div>
						<div class="col-md-4 content1">
				<h4 class="gr"><i class="fa fa-gamepad"></i> Szerver Státusz:</h4>
								<center>
						<h4 style="font-weight: normal; margin-top: 20px;">
						<div class="synhosting-w" data-addr="37_221_209_131_22318" data-bdradius="4" data-ppadding="0"></div>
<script>
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://synhosting.eu/js/w.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','synhosting-w');
</script>
						</h4>
						<!--<iframe src="http://www.game-state.com/iframe.php?ip=37.187.138.237&port=22003&bgcolor=363636&bordercolor=26A8FF&fieldcolor=FFFFFF&valuecolor=EDEDED&oddrowscolor=4D4D4D&showgraph=true&showplayers=true&graphvalues=EDEDED&graphaxis=FFFFFF&width=300&graph_height=105&plist_height=101&font_size=9" frameborder="0" allowfullscreen scrolling="no" style="width: 300px; height: 371px"></iframe>-->
					</center>
				</div>
				<div class="col-md-4 content1">
				<h4 class="gr"><i class="fa fa-gamepad"></i> Kliens letöltése:</h4>
					<a href="https://mtasa.com/download/">
					<button id="connectButton" type="button" class="btn btn-success btn-block"><i class="fa fa-cloud-download"></i> Letöltés</button>
					</a>
				
				</div>
				<div class="col-md-4 content1 mb">
				<h4 class="gr"><i class="fa fa-gamepad"></i> Csatlakozás a szerverre:</h4>
					<a href="mtasa://ip.sangame.best:22003">
					<button id="connectButton" type="button" class="btn btn-info btn-block"><i class="fa fa-plug"></i> Connect</button>
					</a>
				
				</div>
				
			</div>
		</div>
		</div>
		<div id="footer">
		<div class="container-fluid">
				<div class="col-md-8">SanMTA v3 | User Control Panel<br>Copyright @ 2020 - www.sangame.best | Minden jog fenntartva!<br>Az oldal létrehozásának ideje 0.1236 másodperc.</div>
				<div class="col-md-4 fr">Készítette: Webmaster</div>
				
		</div>
	</div>
</body>

<!-- Mirrored from sangame.best/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Aug 2018 03:01:41 GMT -->
</html>
		<script>
			$(document).ready(function() {
				$('.progress .progress-bar').progressbar();
			});
		</script>
		