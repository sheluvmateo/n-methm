<?php
	require_once("includes/functions.php");
    if (isset($_GET["u"])) {
		$page = explode("/", htmlentities($_GET["u"]));
		$exp_page = $page[0];
		
		// if (is_numeric((int)$page[1]) && $page[0] == "dash") {
			// $exp_page = "dash";
		// }
		
		// /* 404 Error */ TODO + Brute
		if (!file_exists("pages/" . $page[0] . ".php") && $page[0] != "" && $page[0] != "login" && $page[0] != "logout") {
			$exp_page = "404";
		}
		/* Bejelentkezve Ellenőrzés / Átirányitás */
		if ($exp_page == "" || $exp_page == "login") {
			if (isset($_SESSION["USER:LOGGED"])){
				$exp_page = "dash";
			}else{
				$exp_page = "login";
			}
		}
		/* Szükséges oldal megnyitása */
		switch ($exp_page) {
		case "":
			require_once("partials/header.php");
            require_once("pages/login.php");
            require_once("partials/footer-clean.php");  
			break;
		case "login":
			require_once("partials/header.php");
			require_once("pages/login.php");
			require_once("partials/footer-clean.php");   
			break;	
		case "dash":
			require_once("partials/header.php");
			require_once("pages/dash.php");
			require_once("partials/footer.php");   
			break;
		case "settings":
			require_once("partials/header.php");
			require_once("pages/settings.php");
			require_once("partials/footer.php");   
			break;		
		case "serialchange":
			require_once("partials/header.php");
			require_once("pages/serialchange.php");
			require_once("partials/footer.php");   
			break;		
		case "admin":
			require_once("partials/header.php");
			require_once("pages/admin.php");
			require_once("partials/footer.php");   
			break;	
		case "admin2":
				require_once("partials/header.php");
				require_once("pages/admin2.php");
				require_once("partials/footer.php");   
		break;	
		case "karakter":
			require_once("partials/header.php");
			require_once("pages/karakter.php");
			require_once("partials/footer.php");   
		break;	
		case "fetch":
			require_once("partials/header.php");
			require_once("pages/fetch.php");
			require_once("partials/footer.php");   
		break;	
		case "kereso":
		require_once("partials/header.php");
		require_once("pages/kereso.php");
		require_once("partials/footer.php");   
		break;	
		case "adminstats":
			require_once("partials/header.php");
			require_once("pages/adminstats.php");
			require_once("partials/footer.php");   
			break;	
		case "lostusername":
			require_once("partials/header.php");
			require_once("pages/lostusername.php");
			require_once("partials/footer.php");   
		break;	
		case "lostpassword":
			require_once("partials/header.php");
			require_once("pages/lostpassword.php");
			require_once("partials/footer.php");   
		break;	
		case "elfelejtettem":
			require_once("partials/header.php");
			require_once("pages/elfelejtettem.php");
			require_once("partials/footer.php");   
			break;
		case "serialmanage":
			require_once("partials/header.php");
			require_once("pages/serialmanage.php");
			require_once("partials/footer.php");   
			break;
		case "namemanage":
			require_once("partials/header.php");
			require_once("pages/namemanage.php");
			require_once("partials/footer.php");   
			break;
		case "banlist":
			require_once("partials/header.php");
			require_once("pages/banlist.php");
			require_once("partials/footer.php");   
			break;
		case "pwchange":
			require_once("partials/header.php");
			require_once("pages/pwchange.php");
			require_once("partials/footer.php");   
			break;		
		case "changename":
			require_once("partials/header.php");
			require_once("pages/changename.php");
			require_once("partials/footer.php");   
			break;
		case "kereso":
			require_once("partials/header.php");
			require_once("pages/kereso.php");
			require_once("partials/footer.php");   
			break;
		case "logout":
			unset($_SESSION["USER:LOGGED"]);
			unset($_SESSION["USER:DATA"]);
			Redirect("login", false);   
			break;
		case "404":
			require_once("partials/header.php");
			require_once("pages/404.php");
			require_once("partials/footer-clean.php");   
			break;
		}
    }
?>