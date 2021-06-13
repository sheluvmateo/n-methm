<?php
	if (!isset($_SESSION["USER:LOGGED"])) {
		Redirect("login", false);
	}
	if ($_SESSION["USER:DATA"]["admin"] <= 0) {
		Redirect("dash", false);
	}
?>

<div class="container margin">
<div class="row menu">
	<div class="col-xs-12 col-md-12">
		<nav class="navbar navbar-default">
		  <div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Navigáció elrejtése</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			</div>
			<?php require_once("partials/menu.php"); ?>
		  </div><!-- /.container-fluid -->
		</nav>
	</div>	
</div>	

<div class="row">
	<div class="col-xs-12 col-md-12">			
	<h4>Aktív kérelmek</h4>		
	<table class="table table-hover">		  
		<tr>			
			<th>Account ID:</th>			
			<th>Régi neve:</th>			
			<th>Új neve:</th>			
			<th>Indok:</th>			
			<th>Dátum:</th>		  
			<th>Állapot:</th>		  
			<th>Kezelés:</th>		  		  
		</tr>		  
		<?=getNameChangeRequests();?>	 
	</table>		
	</div>
</div>
</div>
