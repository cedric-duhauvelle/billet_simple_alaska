<?php

$title = "Connexion";
include("header.php"); 
?>
<div id="form_connexion_content">
    <form action="connexionValidation" method="POST" id="form_connexion">
        <div>
            <p>
                <label for="pseudo">
                    Pseudo :
                    <input type="text" name="pseudo" id="pseudo" />
                </label>
            </p>
            <p>
                <label for="password">
                    Mot de passe :
                    <input type="password" name="password" id="password" minlength="5" />
                </label>
            </p>
            
            <input type="submit" id="button_connexion" placeholder="Connexion" />
        </div>
    </form>
</div>

<?php include("footer.php"); ?>