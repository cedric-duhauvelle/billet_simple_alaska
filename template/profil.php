<?php 
$title = "Profil";
include("header.php");


?>
<div id="content">
	<div id="content_book">
		<p><?php echo $_POST['pseudoInscription']; ?></p>
	    <p><?php echo $_POST['emailInscription']; ?></p>
	    <p><?php echo $_POST['passwordInscription']; ?></p>
	    <p><?php echo $_POST['confirmationPasswordInscription']; ?></p>
	</div>
    
</div>

<?php include("footer.php"); ?>