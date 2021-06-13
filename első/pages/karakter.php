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
		<html lang="en" xmlns="https://www.w3.org/10/xhtml" xmlns:fb="http://ogp.me/ns/fb#">
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
							<a class="navbar-brand" href="http://ucp.sangame.best/"><img src="Assets/Images/logo.png" style="max-height: 125%; margin-top: -5px; display: inline; margin: 0 10px;"/>San<font color="#7cc576">MTA v3</font> <font color="lightgrey"> -   User Control Panel</font></a>
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
		<a href="kereso"><i class="fas fa-search"></i> Kereső</a> <img src="Assets/Images/nex.png"/>
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
	<div class="row">
		<h2 class="pagetitle"><i class="fa fa-info-circle"></i> <font color="#7cc576"><?=$character_data["charname"];?></font> (<a href="settings"><?=$account_data["username"];?></a>) adatai</h2>
		<div class="col-md-12 content1"><br>
			<h2>Általános információk</h2>
							<h3 class="profileh4">Pénz: <font color="#7cc576"><?=$character_data["money"];?> $</font> | Bankszámla: <font color="#7cc576"><?=$character_data["bankmoney"];?> $</font> | San Pontok: <font color="#FF7F00"><?=$character_data["coins"];?></font></h3>
						<hr>
			<div class="row">
				<div class="col-md-6">
					<h4 class="profileh4">Élet: <?=$character_data["hp"];?>/100</h4>
					
					<div class="progress">
						<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:<?=$character_data["hp"];?>%;"></div>
                        <span class="sr-only"></span>
					</div>
				</div>
				<div class="col-md-6">
					<h4 class="profileh4">Páncél: <?=$character_data["armor"];?>/100</h4>
					
					<div class="progress">
					<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:<?=$character_data["armor"];?>%;"></div>
                    <span class="sr-only"></span>
					</div>
				</div>
				<div class="col-md-6">
					<h4 class="profileh4">Éhség: <?=$character_data["hunger"];?>/100</h4>
					
					<div class="progress">
						<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:<?=$character_data["hunger"];?>%;"></div>
                        <span class="sr-only"></span>
					</div>
				</div>
			</div>
			<ul class="list-group">
										<span class="badge2"><?=$account_data["lastlogin"];?></span>
					Utoljára online:
				</li>
                <hr>
										<span class="badge3"><?=$character_data["playedTime"];?> perc</span>
					Játszott idő:
				</li>
			</ul>
			
		</div>
	</div>

	<div class="row">
		<div class="col-md-8 content1">
			<h2>Személyes adatok</h2>
			
			<ul class="list-group">
            <hr>	<span class="badge6"><?=$character_data["suly"];?> kg.</span>
					Súly:
				</li>
				<hr>	<span class="badge4"><?=$character_data["magassag"];?> cm.</span>
					Magasság:
				</li>
                <hr><span class="badge5"><?=$character_data["gender"];?></span>
					Nem:
				</li>
                <hr><span class="badge5"><?=$character_data["eletkor"];?></span>
					Életkor:<hr>
				</li>
											<span class="badge3"><?=$character_data["jailed"];?></span>
										Börtönben:
				</li>
				<hr>
					<span class="badge4"><?=$character_data["rfrekvencia"];?></span>
					Rádió:
				</li>
                <hr>
					<span class="badge6">0</span>
					San Slot Coins:
				</li>
			</ul>
		</div>
		
		<!-- <div class="col-md-4 content1">
			<h2>Csoportok</h2>
			<br />
<b>Warning</b>:  PDOStatement::execute(): SQLSTATE[42S22]: Column not found: 1054 Unknown column 'groups.Name' in 'field list' in <b>C:\xampp\htdocs\Core\Classes\Database.php</b> on line <b>37</b><br />
							<center>
					<span class="badge">Jelenleg nem vagy tagja egyetlen csoportnak sem.</span>
				</center>
					</div> -->
	</div>
	<div class="row">
		<div class="col-md-12 content1">
			<h2>Fegyver Tapasztalat</h2>
			<center>
				<div class="row">
					<div class="col-md-4">
						<h4 class="profileh4">Colt-45: 0/1000</h4>
						<div class="progress">
							<div class="progress-bar progress-bar" role="progressbar" data-transitiongoal="0" aria-valuemin="0" aria-valuemax="1000"></div>
						</div>
					</div>
					<div class="col-md-4">
						<h4 class="profileh4">Silenced Colt-45: 0/1000</h4>
						<div class="progress">
							<div class="progress-bar progress-bar" role="progressbar" data-transitiongoal="0" aria-valuemin="0" aria-valuemax="1000"></div>
						</div>
					</div>
				
					<div class="col-md-4">
						<h4 class="profileh4">Desert Eagle: 20/1000</h4>
						<div class="progress">
							<div class="progress-bar progress-bar" role="progressbar" data-transitiongoal="20" aria-valuemin="0" aria-valuemax="1000"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<h4 class="profileh4">Shotgun: 0/1000</h4>
						<div class="progress">
							<div class="progress-bar progress-bar" role="progressbar" data-transitiongoal="0" aria-valuemin="0" aria-valuemax="1000"></div>
						</div>
					</div>
					<div class="col-md-4">
						<h4 class="profileh4">Sawn-Off Shotgun: 0/1000</h4>
						<div class="progress">
							<div class="progress-bar progress-bar" role="progressbar" data-transitiongoal="0" aria-valuemin="0" aria-valuemax="1000"></div>
						</div>
					</div>
				
					<div class="col-md-4">
						<h4 class="profileh4">SPAZ-12 Combat Shotgun: 0/1000</h4>
						<div class="progress">
							<div class="progress-bar progress-bar" role="progressbar" data-transitiongoal="0" aria-valuemin="0" aria-valuemax="1000"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<h4 class="profileh4">Micro UZI: 0/1000</h4>
						<div class="progress">
							<div class="progress-bar progress-bar" role="progressbar" data-transitiongoal="0" aria-valuemin="0" aria-valuemax="1000"></div>
						</div>
					</div>
					<div class="col-md-4">
						<h4 class="profileh4">MP5: 0/1000</h4>
						<div class="progress">
							<div class="progress-bar progress-bar" role="progressbar" data-transitiongoal="0" aria-valuemin="0" aria-valuemax="1000"></div>
						</div>
					</div>
				
					<div class="col-md-4">
						<h4 class="profileh4">AK-47: 0/1000</h4>
						<div class="progress">
							<div class="progress-bar progress-bar" role="progressbar" data-transitiongoal="0" aria-valuemin="0" aria-valuemax="1000"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<h4 class="profileh4">M4: 0/1000</h4>
						<div class="progress">
							<div class="progress-bar progress-bar" role="progressbar" data-transitiongoal="0" aria-valuemin="0" aria-valuemax="1000"></div>
						</div>
					</div>
					<div class="col-md-4">
						<h4 class="profileh4">Sniper Rifle: 0/1000</h4>
						<div class="progress">
							<div class="progress-bar progress-bar" role="progressbar" data-transitiongoal="0" aria-valuemin="0" aria-valuemax="1000"></div>
						</div>
					</div>
				</div>
			</center>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12 content1 mb">
						<h2>Járművek</h2>
                        <table class="table table-hover">		
				<tr>			
					<th>ID:</th>			
					<th>Típus:</th>	
					<th>Rendszám:</th>		
					<th>Állapot:</th>		
				</tr>		
				<?=getCars($account_data["id"]);?>		 		 	
			</table>	
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
