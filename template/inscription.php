<?php

$title = "Inscription";
include("header.php");
?>
<div id="content">
    <form method="POST" action="InscriptionController" id="form_inscription">
        <div id="inscription_content">
            <p class="error_message">
                <?php 
                if (array_key_exists('errorName', $_SESSION)) {
                    echo $_SESSION['errorName'] . '</br>';
                    unset($_SESSION['errorName']);
                }
                if (array_key_exists('errorEmail', $_SESSION)) {
                    echo $_SESSION['errorEmail'] . '</br>';
                    unset($_SESSION['errorEmail']);
                }
                if (array_key_exists('errorPassword', $_SESSION)) {
                    echo $_SESSION['errorPassword'] . '</br>';
                    unset($_SESSION['errorPassword']);
                }
                ?> 
            </p>
            <p>
                <label for="inscription_pseudo">Pseudo : </label>
                <input type="text" name="pseudoInscription" id="inscription_pseudo" placeholder="Pseudo" required />       
            </p>
            <p>
                <label for="inscription_email">Email : </label>
                <input type="email" name="emailInscription" id="inscription_email" placeholder="Email" required />   
            </p>
            <p>
                <label for="inscription_password">Mot de passe : </label>
                <input type="password" name="passwordInscription" id="inscription_password" minlength="5" placeholder="Mot de passe" required />    
            </p>
            <p>
                <label for="inscription_confirmation_password">Retapez mot de passe : </label>
                <input type="password" name="confirmationPasswordInscription" id="inscription_confirmation_password" minlength="5" placeholder="Retapez mot de passe" required />   
            </p>
            <input type="submit" id="button_inscription" name="button_inscription" value="Inscription" alt="inscription" />
        </div>
    </form>
</div>
<?php include("footer.php"); ?>