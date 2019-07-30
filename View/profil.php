<?php 

require_once '../modele/User.php';

$user = new User($this->_db);

?>
<div id="content">
    <div id="content_book">
        <h2 class="title_section">Profil</h2>
        <div class="profil_user_content">
            <p class="user_name"><?php echo $user->displayName($_SESSION['id_user']); ?></p>            
            <p><?php echo $user->displayEmail($_SESSION['id_user']); ?></p>
            <?php echo $user->displayDateInscription($_SESSION['id_user']); ?>
            <a href="update-profil">Modifier profil</a>
        </div>
    </div>
    <div class="content_deconnexion">
        <a class="button_deconnexion" href="DeconnexionController">Déconnexion</a>
    </div>
</div>