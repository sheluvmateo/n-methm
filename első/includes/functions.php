<?php

session_start();
ob_start();
require_once("config.php");
$connection = new Database;

function encryptPassword ($password) {
	return ($password);
}

if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) 
{ 
	function undo_magic_quotes_gpc(&$array) 
	{ 
		foreach($array as &$value) 
		{ 
			if(is_array($value)) 
			{ 
				undo_magic_quotes_gpc($value); 
			} 
			else 
			{ 
				$value = stripslashes($value); 
			} 
		} 
	} 
 
	undo_magic_quotes_gpc($_POST); 
	undo_magic_quotes_gpc($_GET); 
	undo_magic_quotes_gpc($_COOKIE); 
}

function Redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);

    exit();
}

function data_filter($data)
{
    $data = trim($data);
	$data = htmlentities($data);
	$data = strip_tags($data);
	str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $data);
    if(get_magic_quotes_gpc())
    {
        $data = stripslashes($data);
    }
    return $data;
}

function tryToLogin($post){
	if (!empty($post["username"]) && !empty($post["password"])) {
		if (strrpos($_POST["username"], " ") || strrpos($_POST["password"], " ")){
			echo '<div class="alert alert-danger alert-dismissible" role="alert">				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<p>Nem tartalmazhat szóközt a bejelentkezési adat.</p>
			</div>';	
		}else{
			global $connection;
			$username = data_filter($post["username"]);
			$password = $post["password"];
			
			/* Sql Ellenőrzés */
			$stmt = $connection->pdo->prepare("SELECT * FROM accounts WHERE username = :username and password = :password");
			$pass = encryptPassword($password);
		
			$stmt->bindParam(":username", $username);
			$stmt->bindParam(":password", $pass);

			$stmt->execute();
			$result = $stmt->rowCount();
			$account_data = $stmt->fetch(PDO::FETCH_ASSOC);
			
			/* Feltétel */
			if ($result > 0) {
				$_SESSION["USER:LOGGED"] = true;
				$_SESSION["USER:DATA"] = $account_data;
				echo '<div class="alert alert-success alert-dismissible" role="alert">							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<p>Sikeres bejelentkezés!</p>
				</div>';			
				Redirect("dash", false);
			}else{
				echo '<div class="alert alert-danger alert-dismissible" role="alert">						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<p>Sikertelen belépés: Hibás adatok!</p>
				</div>';
			}
		}
	}else{
		echo '<div class="alert alert-danger alert-dismissible" role="alert">			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>			<p>Minden mező kitöltése kötelező!</p>
		</div>';
	}
}

function tryToChangePassword($post){
	if (!empty($post["old_password"]) && !empty($post["new_password_1"]) && !empty($post["new_password_2"])) {
		if (strrpos($_POST["old_password"], " ") || strrpos($_POST["new_password_1"], " ") || strrpos($_POST["new_password_2"], " ")){
			echo '
			<div class="alert alert-danger alert-dismissible" role="alert">				
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<p>Nem tartalmazhat szóközt a jelszó mező.</p>
			</div>';	
		}else{
			if ($_POST["new_password_1"] != $_POST["new_password_2"]) {
				echo '
				<div class="alert alert-danger alert-dismissible" role="alert">				
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<p>A jelszavak nem egyeznek.</p>
				</div>';	
			} else {
				global $connection;
				$account_id = $_SESSION["USER:DATA"]["id"];
				$username = $_SESSION["USER:DATA"]["username"];
				$old_password = data_filter($post["old_password"]);
				$new_password_1 = data_filter($post["new_password_1"]);
				$new_password_2 = data_filter($post["new_password_2"]);
				
				/* Sql Ellenőrzés */
				$stmt = $connection->pdo->prepare("SELECT * FROM accounts WHERE username = :username and password = :password");
				$pass = $password;
			
				$stmt->bindParam(":username", $username);
				$stmt->bindParam(":password", $pass);

				$stmt->execute();
				$result = $stmt->rowCount();
				
				/* Feltétel */
				if ($result > 0) {
					$n_password = $new_password_2;
					$stmt = $connection->pdo->prepare("UPDATE accounts SET password = :password WHERE id = :id");
					$stmt->bindParam(":id", $account_id);
					$stmt->bindParam(":password", $n_password);
					$stmt->execute();     
					
					unset($_SESSION["USER:LOGGED"]);
					unset($_SESSION["USER:DATA"]);
					echo '<div class="alert alert-success alert-dismissible" role="alert">			
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<p>Sikeres jelszó változtatás!</p>
					</div>
					<meta http-equiv="refresh" content="0; url=login" />
					';	
					// Redirect("login", true);
				}else{
					echo '<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<p>Sikertelen változtatás: Hibás régi jelszó!</p>
					</div>';
				}
			}
		}
	}else{
		echo '<div class="alert alert-danger alert-dismissible" role="alert">			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>			<p>Minden mező kitöltése kötelező!</p>
		</div>';
	}
}

function serialChange($post){
	if (!empty($post["serial"]) && !empty($post["reason"])) {
		if (strrpos($_POST["serial"], " ")){
			echo '
			<div class="alert alert-danger alert-dismissible" role="alert">				
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<p>Nem tartalmazhat szóközt a serial mező.</p>
			</div>';	
		}else{	
			global $connection;
			$account_id = $_SESSION["USER:DATA"]["id"];
			$serial = data_filter($post["serial"]);
			$reason = data_filter($post["reason"]);
			
			/* Sql Ellenőrzés */
			$stmt = $connection->pdo->prepare("SELECT * FROM ucp_serial WHERE owner = :owner and accepted = 0");
			$stmt->bindParam(":owner", $account_id);
			
			$stmt->execute();
			$result = $stmt->rowCount();
			
			/* Feltétel */
			if ($result == 0) {
				$date = date("Y-m-d");
				$stmt = $connection->pdo->prepare("INSERT INTO ucp_serial(serial, reason, owner, date) VALUES (:serial, :reason, :owner, :date)");
				$stmt->bindParam(":serial", $serial);						
				$stmt->bindParam(":reason", $reason);						
				$stmt->bindParam(":owner", $account_id);	
				$stmt->bindParam(":date", $date);	
				$stmt->execute();						
				echo '<div class="alert alert-success alert-dismissible" role="alert">			
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<p>Sikeresen elküldted a kérelmet!</p>
				</div>
				';	
			}else{
				echo '<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
					<p>Már van függőben lévő kérelmed!</p>
				</div>';
			}
		}
	}else{
		echo '<div class="alert alert-danger alert-dismissible" role="alert">		
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<p>Minden mező kitöltése kötelező!</p>
		</div>';
	}
}

function nameChange($post){
	if (!empty($post["new_name"]) && !empty($post["reason"])) {
		if (strrpos($_POST["new_name"], "")){
			echo '
			<div class="alert alert-danger alert-dismissible" role="alert">				
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<p>Nem tartalmazhat szóközt a mező.</p>
			</div>';	
		}else{	
			global $connection;
			$account_id = $_SESSION["USER:DATA"]["id"];
			$old_name = getCharacterData($_SESSION["USER:DATA"]["id"])["charname"];
			$new_name = data_filter($post["new_name"]);
			$reason = data_filter($post["reason"]);
			
			/* Sql Ellenőrzés */
			$stmt = $connection->pdo->prepare("SELECT * FROM ucp_name WHERE owner = :owner and status = 0");
			$stmt->bindParam(":owner", $account_id);
			
			$stmt->execute();
			$result = $stmt->rowCount();
			
			/* Feltétel */
			if ($result == 0) {
				$date = date("Y-m-d");
				$stmt = $connection->pdo->prepare("INSERT INTO ucp_name(old_name, new_name, date, owner, reason) VALUES (:old_name, :new_name, :date, :owner, :reason)");
				$stmt->bindParam(":old_name", $old_name);						
				$stmt->bindParam(":new_name", $new_name);						
				$stmt->bindParam(":date", $date);	
				$stmt->bindParam(":owner", $account_id);	
				$stmt->bindParam(":reason", $reason);	
				$stmt->execute();						
				echo '<div class="alert alert-success alert-dismissible" role="alert">			
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<p>Sikeresen elküldted a kérelmet!</p>
					
				</div>
				
				';	
			}else{
				echo '<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
					<p>Már van függőben lévő kérelmed!</p>
				</div>';
			}
		}
	}else{
		echo '<div class="alert alert-danger alert-dismissible" role="alert">			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>			<p>Minden mező kitöltése kötelező!</p>
		</div>';
	}
}

function getCharacterData($account_id) {
	global $connection;
	$stmt = $connection->pdo->prepare("SELECT * FROM characters WHERE account = :account_id");
	$stmt->bindParam(":account_id", $account_id);
	$stmt->execute();
	$character_data = $stmt->fetch(PDO::FETCH_ASSOC);
	return $character_data;
}

function getNews(){
	global $connection;
	$stmt = $connection->pdo->prepare("SELECT * FROM ucp_news order by id DESC");
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($data as $data_query) {
		echo "
		<div class='panel panel-default'>
			<div class='panel-heading'>
				<h3 class='panel-title'><i class='fa fa-newspaper-o' aria-hidden='true'></i> {$data_query["subject"]}</h3>
			</div>
			<div class='panel-body'>
				{$data_query["text"]}
			</div>
			<div class='panel-footer'><p class='text-muted'>{$data_query["date"]} | Írta: {$data_query["writed"]}</p></div>
		</div>
		";
	}
}

function getSerialChanges($account_id){
	global $connection;
	$stmt = $connection->pdo->prepare("SELECT * FROM ucp_serial WHERE owner = :owner");
	$stmt->bindParam(":owner", $account_id);
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($data as $data_query) {
		$classType = "";
		$classText = "";
		if ($data_query["accepted"] == 0) {
			$classType = "info";
			$classText = "Függőben";
		}elseif ($data_query["accepted"] == 1) {
			$classType = "success";
			$classText = "Elfogadva";
		}elseif ($data_query["accepted"] == 2) {
			$classType = "danger";
			$classText = "Elutasítva";
		}
		echo "
		<tr>		
			<th>{$data_query["id"]}</th>		
			<th>{$data_query["serial"]}</th>
			<th>{$data_query["reason"]}</th>	
			<th>{$data_query["date"]}</th>				
			<th><span class='label label-{$classType}'>{$classText}</span></th>	
		</tr>	
		";
	}
}

function getBans($account_id){
	global $connection;
	$stmt = $connection->pdo->prepare("SELECT * FROM bans WHERE accountID = :owner");
	$stmt->bindParam(":owner", $account_id);
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($data as $data_query) {
		$classType = "";
		$classText = "";

		if ($data_query["status"] == 2) {
			$classType = "info";
			$classText = "Deaktiválva";
		} elseif ($time = strtotime($data_query['timeZone']) < time()) {
			$classType = "info";
			$classText = "Lejárt";
		} elseif ($data_query["status"] == 1) {
			$classType = "info";
			$classText = "Aktív";
		}

		echo "
		<tr>		
		<th>{$data_query["id"]}</th>		
			<th>{$data_query["bannedBy"]}</th>		
			<th>{$data_query["reason"]}</th>
			<th>{$data_query["Date"]}</th>	
			<th>{$data_query["timeZone"]}</th>				
			<th><span class='label label-{$classType}'>{$classText}</span></th>	
		</tr>	
		";
	}
}

function getAjails($account_id){
	global $connection;
	$stmt = $connection->pdo->prepare("SELECT * FROM adminjails WHERE jailed_accountID = :owner");
	$stmt->bindParam(":owner", $account_id);
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($data as $data_query) {
	
		echo "
		<tr>		
		<th>{$data_query["jailed_idopont"]} {$data_query["jailed_idopontora"]}</th>		
		<th>{$data_query["jailed_reason"]}</th>				
			<th>{$data_query["jailed_ido"]} perc</th>	
			<th>{$data_query["jailed_admin"]}</th>		
		</tr>	
		";
	}
}

function getNameChanges($account_id){
	global $connection;
	$stmt = $connection->pdo->prepare("SELECT * FROM ucp_name WHERE owner = :owner");
	$stmt->bindParam(":owner", $account_id);
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($data as $data_query) {
		$classType = "";
		$classText = "";
		if ($data_query["status"] == 0) {
			$classType = "info";
			$classText = "Függőben";
		}elseif ($data_query["status"] == 1) {
			$classType = "success";
			$classText = "Elfogadva";
		}elseif ($data_query["status"] == 2) {
			$classType = "danger";
			$classText = "Elutasítva";
		}
		echo "
		<tr>		
			<th>{$data_query["id"]}</th>		
			<th>{$data_query["old_name"]}</th>
			<th>{$data_query["new_name"]}</th>	
			<th>{$data_query["reason"]}</th>
			<th>{$data_query["date"]}</th>			
			<th><span class='label label-{$classType}'>{$classText}</span></th>	
		</tr>	
		";
	}
}

function getCars($account_id){
	global $connection;
	$stmt = $connection->pdo->prepare("SELECT * FROM vehicle WHERE owner = :owner");
	$stmt->bindParam(":owner", $account_id);
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($data as $data_query) {
		$classType = "";
		$classText = "";
		if ($data_query["model"] == 400) {
			$classType = "";
			$classText = "Ford Raptor";

		}elseif ($data_query["model"] == 401) {
			$classType = "";
			$classText = "Ford Escort RS";
			
		}elseif ($data_query["model"] == 402) {
			$classType = "";
			$classText = "Pontiac Firebird";

		}elseif ($data_query["model"] == 403) {
			$classType = "";
			$classText = "Linerunner";

		}elseif ($data_query["model"] == 404) {
			$classType = "";
			$classText = "Tesla Model S 2014";

		}elseif ($data_query["model"] == 405) {
			$classType = "";
			$classText = "Audi A8";

		}elseif ($data_query["model"] == 406) {
			$classType = "";
			$classText = "Dumper";

		}elseif ($data_query["model"] == 407) {
			$classType = "";
			$classText = "Firetruck";

		}elseif ($data_query["model"] == 408) {
			$classType = "";
			$classText = "Trashmaster";

		}elseif ($data_query["model"] == 409) {
			$classType = "";
			$classText = "Lincoln Towncar Limuzin";

		}elseif ($data_query["model"] == 410) {
			$classType = "";
			$classText = "Volkswagen Golf 1";

		}elseif ($data_query["model"] == 411) {
			$classType = "";
			$classText = "Ferrari 488 Pista";

		}elseif ($data_query["model"] == 412) {
			$classType = "";
			$classText = "Voodoo";

		}elseif ($data_query["model"] == 413) {
			$classType = "";
			$classText = "Ford E150";

		}elseif ($data_query["model"] == 414) {
			$classType = "";
			$classText = "Mule";

		}elseif ($data_query["model"] == 415) {
			$classType = "";
			$classText = "Bugatti Veyron SS";

		}elseif ($data_query["model"] == 416) {
			$classType = "";
			$classText = "Mentőautó";

		}elseif ($data_query["model"] == 417) {
			$classType = "";
			$classText = "Leviathan";

		}elseif ($data_query["model"] == 418) {
			$classType = "";
			$classText = "Ford Explorer NAV";

		}elseif ($data_query["model"] == 419) {
			$classType = "";
			$classText = "Koenigsegg";

		}elseif ($data_query["model"] == 420) {
			$classType = "";
			$classText = "BMW M5 e34 Taxi";

		}elseif ($data_query["model"] == 421) {
			$classType = "";
			$classText = "BMW 760";

		}elseif ($data_query["model"] == 422) {
			$classType = "";
			$classText = "Bobcat";

		}elseif ($data_query["model"] == 423) {
			$classType = "";
			$classText = "Family Frost";

		}elseif ($data_query["model"] == 424) {
			$classType = "";
			$classText = "BF Injection";

		}elseif ($data_query["model"] == 425) {
			$classType = "";
			$classText = "Hunter";

		}elseif ($data_query["model"] == 426) {
			$classType = "";
			$classText = "Dodge Demon SRT";

		}elseif ($data_query["model"] == 427) {
			$classType = "";
			$classText = "Mercedes Sprinter Police";

		}elseif ($data_query["model"] == 428) {
			$classType = "";
			$classText = "Securicar";

		}elseif ($data_query["model"] == 429) {
			$classType = "";
			$classText = "Banshee";

		}elseif ($data_query["model"] == 430) {
			$classType = "";
			$classText = "Predator";

		}elseif ($data_query["model"] == 431) {
			$classType = "";
			$classText = "Bus";

		}elseif ($data_query["model"] == 432) {
			$classType = "";
			$classText = "Rhino";

		}elseif ($data_query["model"] == 433) {
			$classType = "";
			$classText = "Barracks";

		}elseif ($data_query["model"] == 434) {
			$classType = "";
			$classText = "Ford Ratrod 1934";

		}elseif ($data_query["model"] == 435) {
			$classType = "";
			$classText = "Article Trailer";

		}elseif ($data_query["model"] == 436) {
			$classType = "";
			$classText = "Previon";

		}elseif ($data_query["model"] == 437) {
			$classType = "";
			$classText = "Coach";

		}elseif ($data_query["model"] == 438) {
			$classType = "";
			$classText = "Cabbie Taxi";

		}elseif ($data_query["model"] == 439) {
			$classType = "";
			$classText = "Dodge Charger 69 R/T";

		}elseif ($data_query["model"] == 440) {
			$classType = "";
			$classText = "Rumpo";

		}elseif ($data_query["model"] == 441) {
			$classType = "";
			$classText = "RC Bandit";

		}elseif ($data_query["model"] == 442) {
			$classType = "";
			$classText = "Romero";

		}elseif ($data_query["model"] == 443) {
			$classType = "";
			$classText = "Packer";

		}elseif ($data_query["model"] == 444) {
			$classType = "";
			$classText = "Monster";

		}elseif ($data_query["model"] == 445) {
			$classType = "";
			$classText = "BMW M5 e60";

		}elseif ($data_query["model"] == 446) {
			$classType = "";
			$classText = "Squallo";

		}elseif ($data_query["model"] == 447) {
			$classType = "";
			$classText = "Seasparrow";

		}elseif ($data_query["model"] == 448) {
			$classType = "";
			$classText = "Pizzaboy";

		}elseif ($data_query["model"] == 449) {
			$classType = "";
			$classText = "4-6 Villamos";

		}elseif ($data_query["model"] == 450) {
			$classType = "";
			$classText = "Article Trailer 2";
		}elseif ($data_query["model"] == 451) {
			$classType = "";
			$classText = "Lamborghini Huracan";
		
		}elseif ($data_query["model"] == 452) {
			$classType = "";
			$classText = "Speeder";
		
		}elseif ($data_query["model"] == 453) {
			$classType = "";
			$classText = "Reefer";
		
		}elseif ($data_query["model"] == 454) {
			$classType = "";
			$classText = "Tropic";
		
		}elseif ($data_query["model"] == 455) {
			$classType = "";
			$classText = "Flatbed";
		
		}elseif ($data_query["model"] == 456) {
			$classType = "";
			$classText = "Yankee";
		
		}elseif ($data_query["model"] == 457) {
			$classType = "";
			$classText = "Golf kocsi";
		
		}elseif ($data_query["model"] == 458) {
			$classType = "";
			$classText = "Lada Kombi";
		
		}elseif ($data_query["model"] == 459) {
			$classType = "";
			$classText = "Topfun Van";
		
		}elseif ($data_query["model"] == 460) {
			$classType = "";
			$classText = "Skimmer";
		
		}elseif ($data_query["model"] == 461) {
			$classType = "";
			$classText = "Kavasaki Z1";
		
		}elseif ($data_query["model"] == 462) {
			$classType = "";
			$classText = "Honda Click";
		
		}elseif ($data_query["model"] == 463) {
			$classType = "";
			$classText = "Harley Davidson Softail Springer";
		
		}elseif ($data_query["model"] == 464) {
			$classType = "";
			$classText = "RC Baron";
		
		}elseif ($data_query["model"] == 465) {
			$classType = "";
			$classText = "RC Raider";
		
		}elseif ($data_query["model"] == 466) {
			$classType = "";
			$classText = "Mercedes-Benz CLS 63 AMG";
		
		}elseif ($data_query["model"] == 467) {
			$classType = "";
			$classText = "BMW M8 Competition";
		
		}elseif ($data_query["model"] == 468) {
			$classType = "";
			$classText = "Sanchez";
		
		}elseif ($data_query["model"] == 469) {
			$classType = "";
			$classText = "Sparrow";
		
		}elseif ($data_query["model"] == 470) {
			$classType = "";
			$classText = "Lánctalpas terepjáró";
		
		}elseif ($data_query["model"] == 471) {
			$classType = "";
			$classText = "Quad";
		
		}elseif ($data_query["model"] == 472) {
			$classType = "";
			$classText = "Coastguard";
		
		}elseif ($data_query["model"] == 473) {
			$classType = "";
			$classText = "Dinghy";
		
		}elseif ($data_query["model"] == 474) {
			$classType = "";
			$classText = "Volkswagen Bogar";
		
		}elseif ($data_query["model"] == 475) {
			$classType = "";
			$classText = "Sabre Turbocharged";
		
		}elseif ($data_query["model"] == 476) {
			$classType = "";
			$classText = "Rustler";
		
		}elseif ($data_query["model"] == 477) {
			$classType = "";
			$classText = "Ferrari F40 1987";
		
		}elseif ($data_query["model"] == 478) {
			$classType = "";
			$classText = "Walton";
		
		}elseif ($data_query["model"] == 479) {
			$classType = "";
			$classText = "Audi RS6";
		
		}elseif ($data_query["model"] == 480) {
			$classType = "";
			$classText = "Porsche SS";
		
		}elseif ($data_query["model"] == 481) {
			$classType = "";
			$classText = "BMX";
		
		}elseif ($data_query["model"] == 482) {
			$classType = "";
			$classText = "Burrito";
		
		}elseif ($data_query["model"] == 483) {
			$classType = "";
			$classText = "Barkas";
		
		}elseif ($data_query["model"] == 484) {
			$classType = "";
			$classText = "Marquis";
		
		}elseif ($data_query["model"] == 485) {
			$classType = "";
			$classText = "Baggage";
		
		}elseif ($data_query["model"] == 486) {
			$classType = "";
			$classText = "Dozer";
		
		}elseif ($data_query["model"] == 487) {
			$classType = "";
			$classText = "Maverick";
		
		}elseif ($data_query["model"] == 488) {
			$classType = "";
			$classText = "News Chopper";
		
		}elseif ($data_query["model"] == 489) {
			$classType = "";
			$classText = "Mercedes AMG G65";
		
		}elseif ($data_query["model"] == 490) {
			$classType = "";
			$classText = "ARMY Humvee";
		
		}elseif ($data_query["model"] == 491) {
			$classType = "";
			$classText = "Volkswagen Passat Police";
		
		}elseif ($data_query["model"] == 492) {
			$classType = "";
			$classText = "BMW M5 F10 Taxi";
		
		}elseif ($data_query["model"] == 493) {
			$classType = "";
			$classText = "Jetmax";
		
		}elseif ($data_query["model"] == 494) {
			$classType = "";
			$classText = "Mercedes-Benz SLS AMG";
		
		}elseif ($data_query["model"] == 495) {
			$classType = "";
			$classText = "Sandking";
		
		}elseif ($data_query["model"] == 496) {
			$classType = "";
			$classText = "Volkswagen Scirocco 2011";
		
		}elseif ($data_query["model"] == 497) {
			$classType = "";
			$classText = "Eurocopter Police";
		
		}elseif ($data_query["model"] == 498) {
			$classType = "";
			$classText = "Boxville";
		
		}elseif ($data_query["model"] == 499) {
			$classType = "";
			$classText = "Benson";
		
		}elseif ($data_query["model"] == 500) {
			$classType = "";
			$classText = "Jeep Wrangler";

		}elseif ($data_query["model"] == 501) {
			$classType = "";
			$classText = "RC Goblin";
			
		}elseif ($data_query["model"] == 502) {
			$classType = "";
			$classText = "Wiesmann MF5";

		}elseif ($data_query["model"] == 503) {
			$classType = "";
			$classText = "Bugatti Chiron";

		}elseif ($data_query["model"] == 504) {
			$classType = "";
			$classText = "Bloodering Banger";

		}elseif ($data_query["model"] == 505) {
			$classType = "";
			$classText = "Range Rover Evoque";

		}elseif ($data_query["model"] == 506) {
			$classType = "";
			$classText = "McLaren P1";

		}elseif ($data_query["model"] == 507) {
			$classType = "";
			$classText = "Mercedes-Benz e500 w124";

		}elseif ($data_query["model"] == 508) {
			$classType = "";
			$classText = "Journey";

		}elseif ($data_query["model"] == 509) {
			$classType = "";
			$classText = "Bike";

		}elseif ($data_query["model"] == 510) {
			$classType = "";
			$classText = "Mountain Bike";

		}elseif ($data_query["model"] == 511) {
			$classType = "";
			$classText = "Airplane";

		}elseif ($data_query["model"] == 512) {
			$classType = "";
			$classText = "Cropduster";

		}elseif ($data_query["model"] == 513) {
			$classType = "";
			$classText = "Stuntplane";

		}elseif ($data_query["model"] == 514) {
			$classType = "";
			$classText = "Tanker";

		}elseif ($data_query["model"] == 515) {
			$classType = "";
			$classText = "Roadtrain";

		}elseif ($data_query["model"] == 516) {
			$classType = "";
			$classText = "Mercedes-Benz E420";

		}elseif ($data_query["model"] == 517) {
			$classType = "";
			$classText = "Nissan GT-R";

		}elseif ($data_query["model"] == 518) {
			$classType = "";
			$classText = "Bentley Continental GT";

		}elseif ($data_query["model"] == 519) {
			$classType = "";
			$classText = "Shamal";

		}elseif ($data_query["model"] == 520) {
			$classType = "";
			$classText = "Hydra";

		}elseif ($data_query["model"] == 521) {
			$classType = "";
			$classText = "Ducati Desmosedici RR";

        }elseif ($data_query["model"] == 522) {
			$classType = "";
			$classText = "BMW S1000";

		}elseif ($data_query["model"] == 523) {
			$classType = "";
			$classText = "BMW Police Motor";

		}elseif ($data_query["model"] == 524) {
			$classType = "";
			$classText = "Cement Truck";

		}elseif ($data_query["model"] == 525) {
			$classType = "";
			$classText = "Towtruck";

		}elseif ($data_query["model"] == 526) {
			$classType = "";
			$classText = "Alfa Romeo Brera";

		}elseif ($data_query["model"] == 527) {
			$classType = "";
			$classText = "Ford Mustang GT";

		}elseif ($data_query["model"] == 528) {
			$classType = "";
			$classText = "FBI Truck";

		}elseif ($data_query["model"] == 529) {
			$classType = "";
			$classText = "Subaru BRZ";

		}elseif ($data_query["model"] == 530) {
			$classType = "";
			$classText = "Forklift";

		}elseif ($data_query["model"] == 531) {
			$classType = "";
			$classText = "Traktor";

		}elseif ($data_query["model"] == 532) {
			$classType = "";
			$classText = "Kombájn";

		}elseif ($data_query["model"] == 533) {
			$classType = "";
			$classText = "Audi R8 V10";

		}elseif ($data_query["model"] == 534) {
			$classType = "";
			$classText = "Remington";

		}elseif ($data_query["model"] == 535) {
			$classType = "";
			$classText = "Ford Woodie Wagon";

		}elseif ($data_query["model"] == 536) {
			$classType = "";
			$classText = "Ford Thunderbird 64";

		}elseif ($data_query["model"] == 537) {
			$classType = "";
			$classText = "Freight";

		}elseif ($data_query["model"] == 538) {
			$classType = "";
			$classText = "Brownstreak";

		}elseif ($data_query["model"] == 539) {
			$classType = "";
			$classText = "Vortex";

		}elseif ($data_query["model"] == 540) {
			$classType = "";
			$classText = "Subaru Impreza WRX STI";

		}elseif ($data_query["model"] == 541) {
			$classType = "";
			$classText = "Chevrolet Camaro ZL1";

		}elseif ($data_query["model"] == 542) {
			$classType = "";
			$classText = "Chevrolet Chevelle 71";

		}elseif ($data_query["model"] == 543) {
			$classType = "";
			$classText = "Dodge RAM 3500";

		}elseif ($data_query["model"] == 544) {
			$classType = "";
			$classText = "Tűzoltó";

		}elseif ($data_query["model"] == 545) {
			$classType = "";
			$classText = "Hustler";

		}elseif ($data_query["model"] == 547) {
			$classType = "";
			$classText = "Mercedes-Benz E420";

		}elseif ($data_query["model"] == 548) {
			$classType = "";
			$classText = "Cargobob";

		}elseif ($data_query["model"] == 549) {
			$classType = "";
			$classText = "BMW M5 F10";

		}elseif ($data_query["model"] == 550) {
			$classType = "";
			$classText = "BMW M5 e34";

		}elseif ($data_query["model"] == 551) {
			$classType = "";
			$classText = "BMW 750i e38";
		}elseif ($data_query["model"] == 552) {
			$classType = "";
			$classText = "Chevrolet Silverado Utility";
		
		}elseif ($data_query["model"] == 553) {
			$classType = "";
			$classText = "Nevada";
		
		}elseif ($data_query["model"] == 554) {
			$classType = "";
			$classText = "Chevrolet";
		
		}elseif ($data_query["model"] == 555) {
			$classType = "";
			$classText = "Ferrari 250 GTO";
		
		}elseif ($data_query["model"] == 556) {
			$classType = "";
			$classText = "Monster A";
		
		}elseif ($data_query["model"] == 557) {
			$classType = "";
			$classText = "Monster B";
		
		}elseif ($data_query["model"] == 558) {
			$classType = "";
			$classText = "BMW M3 E46";
		
		}elseif ($data_query["model"] == 559) {
			$classType = "";
			$classText = "Toyota Supra";
		
		}elseif ($data_query["model"] == 560) {
			$classType = "";
			$classText = "Mitsubishi Lancer Evo X";
		
		}elseif ($data_query["model"] == 561) {
			$classType = "";
			$classText = "Ford Mustang GT";
		
		}elseif ($data_query["model"] == 562) {
			$classType = "";
			$classText = "Nissan Skyline R34 GT-R";
		
		}elseif ($data_query["model"] == 563) {
			$classType = "";
			$classText = "Raindance";
		
		}elseif ($data_query["model"] == 564) {
			$classType = "";
			$classText = "RC Tiger";
		
		}elseif ($data_query["model"] == 565) {
			$classType = "";
			$classText = "Honda CRX SiR 90";
		
		}elseif ($data_query["model"] == 566) {
			$classType = "";
			$classText = "Peugeot 406";
		
		}elseif ($data_query["model"] == 567) {
			$classType = "";
			$classText = "Chevrolet Impala 64";
		
		}elseif ($data_query["model"] == 568) {
			$classType = "";
			$classText = "Bandito";
		
		}elseif ($data_query["model"] == 569) {
			$classType = "";
			$classText = "Freight Flat Trailer";
		
		}elseif ($data_query["model"] == 570) {
			$classType = "";
			$classText = "Streak Trailer";
		
		}elseif ($data_query["model"] == 571) {
			$classType = "";
			$classText = "Gokart";
		
		}elseif ($data_query["model"] == 572) {
			$classType = "";
			$classText = "Mower";
		
		}elseif ($data_query["model"] == 573) {
			$classType = "";
			$classText = "Dune";
		
		}elseif ($data_query["model"] == 574) {
			$classType = "";
			$classText = "Sweeper";
		
		}elseif ($data_query["model"] == 575) {
			$classType = "";
			$classText = "Broadway";
		
		}elseif ($data_query["model"] == 576) {
			$classType = "";
			$classText = "Chevrolet Bel Air";
		
		}elseif ($data_query["model"] == 577) {
			$classType = "";
			$classText = "AT400";
		
		}elseif ($data_query["model"] == 578) {
			$classType = "";
			$classText = "DFT-30";
		
		}elseif ($data_query["model"] == 579) {
			$classType = "";
			$classText = "Range Rover SS";
		
		}elseif ($data_query["model"] == 580) {
			$classType = "";
			$classText = "Audi RS4 Avant";
		
		}elseif ($data_query["model"] == 582) {
			$classType = "";
			$classText = "Newsvan";
		
		}elseif ($data_query["model"] == 583) {
			$classType = "";
			$classText = "Tug";
		
		}elseif ($data_query["model"] == 584) {
			$classType = "";
			$classText = "Petrol Trailer";
		
		}elseif ($data_query["model"] == 585) {
			$classType = "";
			$classText = "Ford Crown Victoria";
		
		}elseif ($data_query["model"] == 586) {
			$classType = "";
			$classText = "Honda Goldwing";
		
		}elseif ($data_query["model"] == 587) {
			$classType = "";
			$classText = "Nissan GT-R";
		
		}elseif ($data_query["model"] == 588) {
			$classType = "";
			$classText = "Hot-Dog";
		
		}elseif ($data_query["model"] == 589) {
			$classType = "";
			$classText = "Volkswagen Golf 2";
		
		}elseif ($data_query["model"] == 590) {
			$classType = "";
			$classText = "Freight Box";
		
		}elseif ($data_query["model"] == 591) {
			$classType = "";
			$classText = "Article Trailer 3";
		
		}elseif ($data_query["model"] == 592) {
			$classType = "";
			$classText = "Andromada";
		
		}elseif ($data_query["model"] == 593) {
			$classType = "";
			$classText = "Dodo";
		
		}elseif ($data_query["model"] == 594) {
			$classType = "";
			$classText = "RC Cam";
		
		}elseif ($data_query["model"] == 595) {
			$classType = "";
			$classText = "Launcher";
		
		}elseif ($data_query["model"] == 596) {
			$classType = "";
			$classText = "Audi RS6 Police";
		
		}elseif ($data_query["model"] == 597) {
			$classType = "";
			$classText = "BMW M5 e60 Rendőrség";
		
		}elseif ($data_query["model"] == 598) {
			$classType = "";
			$classText = "Opel Astra H Police";
		
		}elseif ($data_query["model"] == 599) {
			$classType = "";
			$classText = "Dodge NAV";
		
		}elseif ($data_query["model"] == 600) {
			$classType = "";
			$classText = "Dinnyelopós Mercedes";
		
		}elseif ($data_query["model"] == 601) {
			$classType = "";
			$classText = "APC T.E.K. Páncélautó";

        }elseif ($data_query["model"] == 602) {
			$classType = "";
			$classText = "Audi Quattro";
		
		}elseif ($data_query["model"] == 603) {
			$classType = "";
			$classText = "Dodge Coronet 440";
		
		}elseif ($data_query["model"] == 604) {
			$classType = "";
			$classText = "Chevrolet Chevelle SS 67";
		
		}elseif ($data_query["model"] == 605) {
			$classType = "";
			$classText = "Ford F-150";
		
		}elseif ($data_query["model"] == 606) {
			$classType = "";
			$classText = "Baggage Trailer A";
		
		}elseif ($data_query["model"] == 607) {
			$classType = "";
			$classText = "Baggage Trailer B";
		
		}elseif ($data_query["model"] == 608) {
			$classType = "";
			$classText = "Tug Stairs Trailer";
		
		}elseif ($data_query["model"] == 609) {
			$classType = "";
			$classText = "Boxville";
		
		}elseif ($data_query["model"] == 610) {
			$classType = "";
			$classText = "Farm Trailer";
		
		}elseif ($data_query["model"] == 611) {
			$classType = "";
			$classText = "Utility Trailer";
		}
		echo "
		<tr>		
			<th>{$data_query["id"]}</th>		
			<th><span class='{$classType}'>{$classText}</span></th>	
			<th>{$data_query["rendszam"]}</th>		
			<th>{$data_query["hp"]}%</th>
		</tr>	
		";
	}
}

function getSerialChangeRequests(){
	global $connection;
	$stmt = $connection->pdo->prepare("SELECT * FROM ucp_serial WHERE accepted = 0");
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($data as $data_query) {
		echo "
		<tr>			
			<th>{$data_query["owner"]}</th>			
			<th>{$data_query["serial"]}</th>			
			<th>{$data_query["reason"]}</th>			
			<th>{$data_query["date"]}</th>			
			<th><span class='label label-info'>Függőben</span></th>	
			<th>
				<form class='form-inline' method='POST'>
					  <div class='form-group'>
						<input type='hidden' value='{$data_query["id"]}' name='serial_post_id_{$data_query["id"]}'>
						<input type='hidden' value='{$data_query["owner"]}' name='serial_post_owner_{$data_query["id"]}'>
						<input type='hidden' value='{$data_query["serial"]}' name='serial_post_serial_{$data_query["id"]}'>
						<input type='submit' class='form-control btn-success' value='Elfogadás' name='accept_change_{$data_query["id"]}' >
						<input type='submit' class='form-control btn-danger' value='Elutasítás' name='deny_change_{$data_query["id"]}' >
					  </div>
				</form>
				";
				if (isset($_POST["accept_change_{$data_query["id"]}"])) {
					$accepted = 1;
					$post_id = $_POST["serial_post_id_{$data_query["id"]}"];
					$post_account_owner = $_POST["serial_post_owner_{$data_query["id"]}"];
					$post_serial_new = $_POST["serial_post_serial_{$data_query["id"]}"];
					
					$stmt = $connection->pdo->prepare("UPDATE ucp_serial SET accepted = :accepted WHERE id = :id");
					$stmt->bindParam(":accepted", $accepted);
					$stmt->bindParam(":id", $post_id);
					$stmt->execute();	
					
					$stmt = $connection->pdo->prepare("UPDATE accounts SET mtaserial = :serial WHERE id = :id");
					$stmt->bindParam(":serial", $post_serial_new);
					$stmt->bindParam(":id", $post_account_owner);
					$stmt->execute();
					
					echo '<meta http-equiv="refresh" content="0; url=admin" />';
				}
				if (isset($_POST["deny_change_{$data_query["id"]}"])) {
					$accepted = 2;
					$post_id = $_POST["serial_post_id_{$data_query["id"]}"];
				
					$stmt = $connection->pdo->prepare("UPDATE ucp_serial SET accepted = :accepted WHERE id = :id");
					$stmt->bindParam(":accepted", $accepted);
					$stmt->bindParam(":id", $post_id);
					$stmt->execute();	
					
					echo '<meta http-equiv="refresh" content="0; url=admin" />';
				}
		echo "
			</th>	
		</tr>		
		";
	}
}

function getNameChangeRequests(){
	global $connection;
	$stmt = $connection->pdo->prepare("SELECT * FROM ucp_name WHERE status = 0");
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($data as $data_query) {
		echo "
		<tr>			
			<th>{$data_query["owner"]}</th>			
			<th>{$data_query["old_name"]}</th>			
			<th>{$data_query["new_name"]}</th>			
			<th>{$data_query["reason"]}</th>			
			<th>{$data_query["date"]}</th>			
			<th><span class='label label-info'>Függőben</span></th>	
			<th>
				<form class='form-inline' method='POST'>
					  <div class='form-group'>
						<input type='hidden' value='{$data_query["id"]}' name='name_post_id_{$data_query["id"]}'>
						<input type='hidden' value='{$data_query["owner"]}' name='name_post_owner_{$data_query["id"]}'>
						<input type='hidden' value='{$data_query["new_name"]}' name='name_post_name_{$data_query["id"]}'>
						<input type='submit' class='form-control btn-success' value='Elfogadás' name='accept_change_{$data_query["id"]}' >
						<input type='submit' class='form-control btn-danger' value='Elutasítás' name='deny_change_{$data_query["id"]}' >
					  </div>
				</form>
				";
				if (isset($_POST["accept_change_{$data_query["id"]}"])) {
					$status = 1;
					$post_id = $_POST["name_post_id_{$data_query["id"]}"];
					$post_account_owner = getCharacterData($_POST["name_post_owner_{$data_query["id"]}"])["id"];
					$post_name_new = $_POST["name_post_name_{$data_query["id"]}"];
					
					$stmt = $connection->pdo->prepare("UPDATE ucp_name SET status = :status WHERE id = :id");
					$stmt->bindParam(":status", $status);
					$stmt->bindParam(":id", $post_id);
					$stmt->execute();	
					
					$stmt = $connection->pdo->prepare("UPDATE characters SET charname = :name WHERE id = :id");
					$stmt->bindParam(":name", $post_name_new);
					$stmt->bindParam(":id", $post_account_owner);
					$stmt->execute();

					echo '<meta http-equiv="refresh" content="0; url=admin" />';
				}
				if (isset($_POST["deny_change_{$data_query["id"]}"])) {
					$status = 2;
					$post_id = $_POST["name_post_id_{$data_query["id"]}"];
					
					$stmt = $connection->pdo->prepare("UPDATE ucp_name SET status = :status WHERE id = :id");
					$stmt->bindParam(":status", $status);
					$stmt->bindParam(":id", $post_id);
					$stmt->execute();	
					
					echo '<meta http-equiv="refresh" content="0; url=admin" />';
				}
		echo "
			</th>	
		</tr>		
		";
	}
}

function getBanList(){
	global $connection;
	$stmt = $connection->pdo->prepare("SELECT * FROM bans WHERE status = 1");
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($data as $data_query) {
		echo "
		<tr>			
			<th>{$data_query["accountID"]}</th>			
			<th>{$data_query["playername"]}</th>			
			<th>{$data_query["bannedBy"]}</th>			
			<th>{$data_query["reason"]}</th>			
			<th>{$data_query["Date"]}</th>			
			<th>{$data_query["timeZone"]}</th>	
			<th><span class='label label-info'>Aktív</span></th>	
			<th>
				<form class='form-inline' method='POST'>
					  <div class='form-group'>
						<input type='hidden' value='{$data_query["id"]}' name='name_post_id_{$data_query["id"]}'>
						<input type='hidden' value='{$data_query["owner"]}' name='name_post_owner_{$data_query["id"]}'>
						<input type='hidden' value='{$data_query["new_name"]}' name='name_post_name_{$data_query["id"]}'>
						<input type='submit' class='form-control btn-success' value='Feloldás' name='accept_change_{$data_query["id"]}' >
					  </div>
				</form>
				";
				if (isset($_POST["accept_change_{$data_query["id"]}"])) {
					$status = 0;
					$post_id = $_POST["name_post_id_{$data_query["id"]}"];
					$post_account_owner = getCharacterData($_POST["name_post_owner_{$data_query["id"]}"])["id"];
					$post_name_new = $_POST["name_post_name_{$data_query["id"]}"];
					
					$stmt = $connection->pdo->prepare("UPDATE bans SET status = :status WHERE id = :id");
					$stmt->bindParam(":status", $status);
					$stmt->bindParam(":id", $post_id);
					$stmt->execute();	

					echo '<meta http-equiv="refresh" content="0; url=admin2" />';
				}
		echo "
			</th>	
		</tr>		
		";
	}
}

function getBanList2(){
	global $connection;
	$stmt = $connection->pdo->prepare("SELECT * FROM bans WHERE status = 1");
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($data as $data_query) {
		echo "
		<tr>			
			<th>{$data_query["accountID"]}</th>			
			<th>{$data_query["playername"]}</th>			
			<th>{$data_query["bannedBy"]}</th>			
			<th>{$data_query["reason"]}</th>			
			<th>{$data_query["Date"]}</th>			
			<th>{$data_query["timeZone"]}</th>	
			<th><span class='label label-info'>Aktív</span></th>	
			<th>
				<form class='form-inline' method='POST'>
					  <div class='form-group'>
						<input type='hidden' value='{$data_query["id"]}' name='name_post_id_{$data_query["id"]}'>
						<input type='hidden' value='{$data_query["owner"]}' name='name_post_owner_{$data_query["id"]}'>
						<input type='hidden' value='{$data_query["new_name"]}' name='name_post_name_{$data_query["id"]}'>
					  </div>
				</form>
				";
				if (isset($_POST["accept_change_{$data_query["id"]}"])) {
					$status = 0;
					$post_id = $_POST["name_post_id_{$data_query["id"]}"];
					$post_account_owner = getCharacterData($_POST["name_post_owner_{$data_query["id"]}"])["id"];
					$post_name_new = $_POST["name_post_name_{$data_query["id"]}"];
					
					$stmt = $connection->pdo->prepare("UPDATE bans SET status = :status WHERE id = :id");
					$stmt->bindParam(":status", $status);
					$stmt->bindParam(":id", $post_id);
					$stmt->execute();	

					echo '<meta http-equiv="refresh" content="0; url=adminstats" />';
				}
		echo "
			</th>	
		</tr>		
		";
	}
}

function getAdminJails2(){
		global $connection;
		$stmt = $connection->pdo->prepare("SELECT * FROM adminjails WHERE id >= 1");
		$stmt->execute();
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($data as $data_query) {
		
			echo "
			<tr>
			<th>{$data_query["id"]}</th>	
			<th>{$data_query["jailed_admin"]}</th>			
			<th>Account ID: {$data_query["jailed_accountID"]}</th>				
			<th>{$data_query["jailed_idopont"]} {$data_query["jailed_idopontora"]}</th>		
			<th>{$data_query["jailed_reason"]}</th>				
			<th>{$data_query["jailed_ido"]} perc</th>	
			<th>{$data_query["jailed_playerSerial"]}</th>	
			</tr>	
			";
		}
	}

function getAdminList(){
	global $connection;
	$stmt = $connection->pdo->prepare("SELECT * FROM accounts WHERE admin >= 1");
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

	foreach ($data as $data_query) {
		echo "
		<tr>			
			<th>{$data_query["id"]}</th>			
			<th>{$data_query["anick"]}</th>		
			<th>{$data_query["admin"]}</th>		
			<th>{$data_query["username"]}</th>			
			<th>{$data_query["mtaserial"]}</th>			
			<th>{$data_query["ip"]}</th>			
			<th>{$data_query["lastlogin"]}</th>			
			<th>{$data_query["adutyTime"]}</th>	
			<th>{$data_query["allapot"]}</th>	
			<th>
				<form class='form-inline' method='POST'>
					  <div class='form-group'>
						<input type='hidden' value='{$data_query["id"]}' name='name_post_id_{$data_query["id"]}'>
						<input type='hidden' value='{$data_query["owner"]}' name='name_post_owner_{$data_query["id"]}'>
						<input type='hidden' value='{$data_query["new_name"]}' name='name_post_name_{$data_query["id"]}'>
						<input type='submit' class='form-control btn-success' value='Kirúgás' name='accept_change_{$data_query["id"]}' >
					  </div>
				</form>
				";
				if (isset($_POST["accept_change_{$data_query["id"]}"])) {
					$status = 0;
					$post_id = $_POST["name_post_id_{$data_query["id"]}"];
					$post_account_owner = getCharacterData($_POST["name_post_owner_{$data_query["id"]}"])["id"];
					$post_name_new = $_POST["name_post_name_{$data_query["id"]}"];
					
					$stmt = $connection->pdo->prepare("UPDATE accounts SET admin = :status WHERE id = :id");
					$stmt->bindParam(":status", $status);
					$stmt->bindParam(":id", $post_id);
					$stmt->execute();	

					echo '<meta http-equiv="refresh" content="0; url=admin2" />';
				}
		echo "
			</th>	
		</tr>		
		";
	}
}
?>