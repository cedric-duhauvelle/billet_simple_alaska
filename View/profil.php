<div id="content">
    <div id="content_book">
        <h2 class="title_section">Profil</h2>
        <div class="profil_user_content">
            <p class="user_name"><?= $user->getName(); ?></p>            
            <p><?= $user->getEmail(); ?></p>
            <p>Inscrit depuis le <?= date_format(date_create($user->getInscription()), 'd/m/Y à H:i:s'); ?></p>
            <a href="update-profil">Modifier profil</a>
        </div>
    </div>
    <div class="content_deconnexion">
        <a class="button_deconnexion" href="DeconnexionController">Déconnexion</a>
    </div>
</div>