<?php 
require '../controller/inscriptionController.php';
$title = "Profil";
include("header.php");

$pseudo = $_POST['pseudoInscription'];
$email = $_POST['emailInscription'];
$password = $_POST['passwordInscription'];
$passwordConfirm = $_POST['confirmationPasswordInscription'];
?>
<div>
    <p><?php echo $pseudo; ?></p>
    <p><?php echo $email; ?></p>
    <p><?php echo $password; ?></p>
    <p><?php echo $passwordConfirm; ?></p>
</div>

<?php include("footer.php"); ?>