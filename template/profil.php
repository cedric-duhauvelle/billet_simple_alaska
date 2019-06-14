<?php 
$title = "Profil";
require_once '../modele/DataRecover.php';
require_once '../modele/private/adressDataBase.php';
include("header.php");
$data = new DataRecover($db);
?>
<div id="content">
	<div id="content_book">
		<p>
			<?php
			if (array_key_exists('name', $_SESSION)) {
			 	echo $_SESSION['name']; 
			}
			var_dump($_SESSION);
			?>
		</p>
		<p>
			<?php
			if (isset($_SESSION['id_user'])) {
			 	echo $_SESSION['id_user']; 
			}
			?>
		</p>
	</div>
    <div>
    	<a class="button_deconnexion" href="deconnexion">Deconnexion</a>
    </div>
</div>
<?php include("footer.php"); ?>