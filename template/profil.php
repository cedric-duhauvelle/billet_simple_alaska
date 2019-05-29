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

			$data->recoverDataPseudo();

			?>
		</p>
	</div>
    
</div>

<?php include("footer.php"); ?>