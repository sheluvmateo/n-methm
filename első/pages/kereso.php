<?php
	if (!isset($_SESSION["USER:LOGGED"])) {
		Redirect("login", false);
	}
	if ($_SESSION["USER:DATA"]["admin"] <= 7) {
		Redirect("dash", false);
	}
?>

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
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Webslesson Demo - Ajax Live Data Search using Jquery PHP MySql</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
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
							<a class="navbar-brand" href="index.php"><img src="Assets/Images/logo.png" style="max-height: 125%; margin-top: -5px; display: inline; margin: 0 10px;"/>San<font color="#7cc576">MTA v3</font> <font color="lightgrey"> -   User Control Panel</font></a>
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

						<div class="container">
			<h2 align="center">SanMTA User Control Panel - Searcher</h2><br />
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Kereső</span>
					<input type="text" name="search_text" id="search_text" placeholder="Keresés a felhasználók között" class="form-control" />
				</div>
			<br />
			<div id="result"></div>
		</div>
		<div style="clear:both"></div>
		<br />					
</body>
</html>
		
<script>
$(document).ready(function(){
	load_data();
	function load_data(query)
	{
		$.ajax({
			url:"fetch",
			method:"post",
			data:{query:query},
			success:function(data)
			{
				$('#result').html(data);
			}
		});
	}
	
	$('#search_text').keyup(function(){
		var search = $(this).val();
		if(search != '')
		{
			load_data(search);
		}
		else
		{
			load_data();			
		}
	});
});
</script>




