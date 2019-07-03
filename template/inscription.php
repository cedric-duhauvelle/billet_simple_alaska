<?php
$title = "Inscription";
include("header.php");
?>
<div id="content">
    <form method="POST" action="inscription-controller" id="form_inscription">
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
                <label for="pseudoInscription">
                    Pseudo : </br>
                    <input type="text" name="pseudoInscription" id="inscription_pseudo" placeholder="Pseudo" required />    
                </label>
            </p>
            <p>
                <label for="emailInscription">
                    Email : </br>
                    <input type="email" name="emailInscription" id="inscription_email" placeholder="Email" required />
                </label>
            </p>
            <p>
                <label for="passwordInscription">
                    Mot de passe : </br>
                    <input type="password" name="passwordInscription" id="inscription_password" minlength="5" placeholder="Mot de passe" required />
                </label>
            </p>
            <p>
                <label for="confirmationPasswordInscription">
                    Retapez mot de passe : </br>
                    <input type="password" name="confirmationPasswordInscription" id="inscription_confirmation_password" minlength="5" placeholder="Retapez mot de passe" required/>
                </label>
            </p>
            <input type="submit" id="button_inscription" name="button_inscription" value="Inscription" />
        </div>
    </form>
</div>
<?php include("footer.php"); ?>