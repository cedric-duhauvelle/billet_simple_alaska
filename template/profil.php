<?php 

require_once '../modele/User.php';

$title = "Profil";

include("header.php");
$user = new User($this->_db);
$user_name = $user->displayName($_SESSION['id_user']);
$user_email = $user->displayEmail($_SESSION['id_user']);
$user_inscription = $user->displayDateInscription($_SESSION['id_user']);
?>
<div id="content">
    <div id="content_book">
        <h2 class="title_section">Profil</h2>
        <div class="profil_user_content">
            <p class="user_name"><?= $user_name; ?></p>            
            <p><?= $user_email; ?></p>
            <?= $user_inscription; ?>
            <a href="update-profil">Modifier profil</a>
        </div>
    </div>
    <div class="content_deconnexion">
        <a class="button_deconnexion" href="DeconnexionController">Déconnexion</a>
    </div>
</div>
<?php include("footer.php"); ?>