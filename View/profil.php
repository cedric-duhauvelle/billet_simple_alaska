<div id="content">
    <div id="content_book">
        <h2 class="title_section">Profil</h2>
        <div class="profil_user_content">
            <p class="user_name"><?= $user->displayName($_SESSION['id_user']); ?></p>            
            <p><?= $user->displayEmail($_SESSION['id_user']); ?></p>
            <?= $user->displayDateInscription($_SESSION['id_user']); ?>
            <a href="update-profil">Modifier profil</a>
        </div>
    </div>
    <div class="content_deconnexion">
        <a class="button_deconnexion" href="DeconnexionController">Déconnexion</a>
    </div>
</div>