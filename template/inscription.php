<?php

$title = "Inscription";
include("header.php");
?>
<div id="form_inscription_content">
    <form method="POST" action="../controller/inscriptionController.php" id="form_inscription">
        <div>
            <p>
                <label for="pseudoInscription">
                    Pseudo :
                    <input type="text" name="pseudoInscription" id="inscription_pseudo" placeholder="Pseudo" />
                </label>
            </p>
            <p>
                <label for="emailInscription">
                    Email :
                    <input type="email" name="emailInscription" id="inscription_email" placeholder="Email" />
                </label>
            </p>
            <p>
                <label for="passwordInscription">
                    Mot de passe :
                    <input type="password" name="passwordInscription" id="inscription_password" minlength="5" placeholder="Mot de passe" />
                </label>
            </p>
            <p>
                <label for="confirmationPasswordInscription">
                    Retapez mot de passe :
                    <input type="password" name="confirmationPasswordInscription" id="inscription_confirmation_password" minlength="5" placeholder="Retapez mot de passe" />
                </label>
            </p>
            
            
            <input type="submit" id="button_connexion" name="button_connexion" value="Inscription" />
        </div>
    </form>
</div>

<?php include("footer.php"); ?>