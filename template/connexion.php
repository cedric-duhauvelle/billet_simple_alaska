<?php

$title = "Connexion";
include("header.php"); 
?>
<div id="form_connexion_content">
    <form action="connexionValidation" method="POST" id="form_connexion">
        <div id="connexion_content">   
            <?php
            if (array_key_exists('errorName', $_SESSION)) {
            ?>
            <p class="error_message">
            <?php
                echo $_SESSION['errorName'] . '</br>';
                unset($_SESSION['errorName']);
            ?>
            </p>
            <?php
            }
            ?>
            <p>
                <label for="pseudo">
                    Pseudo : </br>
                    <input type="text" name="pseudo" id="pseudo" />
                </label>
            </p>
            <?php
            if (array_key_exists('errorPassword', $_SESSION)) {
            ?>
            <p class="error_message">
            <?php
                echo $_SESSION['errorPassword'] . '</br>';
                unset($_SESSION['errorPassword']);

            ?>
            </p>
            <?php
            }
            ?>
            <p>
                <label for="password">
                    Mot de passe : </br>
                    <input type="password" name="password" id="password" minlength="5" />
                </label>
            </p>
            
            <input type="submit" id="button_connexion" value="Connexion" />

            <a href="inscription" id="lien_inscription_connexion">Inscrivez-vous</a>
        </div>
    </form>
</div>
<?php include("footer.php"); ?>