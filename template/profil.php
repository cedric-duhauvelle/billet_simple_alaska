<?php 
$title = "Profil";
require_once '../modele/User.php';
require_once '../modele/private/adressDataBase.php';
include("header.php");
$user = new User($db);
?>
<div id="content">
    <div id="content_book">
        <p>
            <?php
            $user->displayUser(empty($_SESSION['id_user']), $_SESSION['name']);
            ?>
        </p>
    </div>
    <div>
        <a class="button_deconnexion" href="deconnexion">Deconnexion</a>
    </div>
</div>
<?php include("footer.php"); ?>