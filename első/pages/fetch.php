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

<?php
$connect = mysqli_connect("hostip", "username", "password", "databasename");
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM accounts
    WHERE id LIKE '%".$search."%'
    OR username LIKE '%".$search."%' 
	OR mtaserial LIKE '%".$search."%' 
	OR email LIKE '%".$search."%' 
	";
}
else
{
	$query = "
	SELECT * FROM accounts ORDER BY id";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>Account ID</th>
							<th>Felhasználónév</th>
							<th>Serial</th>
							<th>E-mail</th>
						</tr>';
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
			<tr>
				<td>'.$row["id"].'</td>
				<td>'.$row["username"].'</td>
				<td>'.$row["mtaserial"].'</td>
				<td>'.$row["email"].'</td>
			</tr>
		';
	}
	echo $output;
}
else
{
	echo 'Ilyen felhasználó nem létezik!';
}
?>