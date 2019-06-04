<?php 
$title = "Profil";
require_once '../modele/class/DataRecover.php';
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
    
</div>

<?php include("footer.php"); ?>