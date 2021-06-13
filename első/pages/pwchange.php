<?php
	if (!isset($_SESSION["USER:LOGGED"])) {
		Redirect("login", false);
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
		<div class="alert alert-warning alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <strong>Ügyelj</strong>, hogy a jelszavad pontosan írd be.
		</div>			
			<form class="form-horizontal col-sm-offset-2" method="POST">
			  <div class="form-group">
				<label for="oldpw" class="col-sm-3 control-label">Régi jelszavad</label>
				<div class="col-sm-6">
				  <input type="password" class="form-control" name="old_password" placeholder="Régi jelszavad">
				</div>
			  </div>		 

			  <div class="form-group">
				<label for="newpw" class="col-sm-3 control-label">Új jelszavad</label>
				<div class="col-sm-6">
				  <input type="password" class="form-control" name="new_password_1" placeholder="Új jelszavad">
				</div>
			  </div> 		 

			  <div class="form-group">
				<label for="newpw2" class="col-sm-3 control-label">Új jelszavad megerősítés</label>
				<div class="col-sm-6">
				  <input type="password" class="form-control" name="new_password_2" placeholder="Új jelszavad megerősítés">
				</div>
			  </div> 
			  
			  <div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
				  <input type="submit" class="form-control btn-success" value="Elküldés" name="change_btn">
				</div>
			  </div>
			  <?php
				if (isset($_POST["change_btn"])){
					tryToChangePassword($_POST);	
				}
			  ?>
			</form>
		
		</div>
	</div>
</div>