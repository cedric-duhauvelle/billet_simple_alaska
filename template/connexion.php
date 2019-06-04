<?php

$title = "Connexion";
include("header.php"); 
?>
<div id="form_connexion_content">
    <form action="connexionValidation" method="POST" id="form_connexion">
        <div>
            <p>
                <?php
                if (array_key_exists('errorName', $_SESSION)) {
                    echo $_SESSION['errorName'] . '</br>';
                    unset($_SESSION['errorName']);
                }
                ?>
            </p>
            <p>
                <label for="pseudo">
                    Pseudo :
                    <input type="text" name="pseudo" id="pseudo" />
                </label>
            </p>
            <p>
                <?php
                if (array_key_exists('errorPassword', $_SESSION)){
                    echo $_SESSION['errorPassword'] . '</br>';
                    unset($_SESSION['errorPassword']);
                }
                ?>
            </p>
            <p>
                <label for="password">
                    Mot de passe :
                    <input type="password" name="password" id="password" minlength="5" />
                </label>
            </p>
            
            <input type="submit" id="button_connexion" placeholder="Connexion" />

            <a href="inscription">Inscrivez-vous</a>
        </div>
    </form>
</div>

<?php include("footer.php"); ?>