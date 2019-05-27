
<?php 
$title = "Inscription";
include("header.php");
?>
<div id="form_inscription_content">
    <form method="POST" action="../controller/index.php" id="form_inscription">
        <div>
            <p>
                <label for="pseudo_inscription">
                    Pseudo :
                    <input type="text" name="pseudo_inscription" id="inscription_pseudo" placeholder="Pseudo" />
                </label>
            </p>
            <p>
                <label for="email_inscription">
                    Email :
                    <input type="email" name="email_inscription" id="inscription_email" placeholder="Email" />
                </label>
            </p>
            <p>
                <label for="password_inscription">
                    Mot de passe :
                    <input type="password" name="password_inscription" id="inscription_password" minlength="5" placeholder="Mot de passe" />
                </label>
            </p>
            <p>
                <label for="confirmation_password_inscription">
                    Retapez mot de passe :
                    <input type="password" name="confirmation_password_inscription" id="inscription_confirmation_password" minlength="5" placeholder="Retapez mot de passe" />
                </label>
            </p>
            
            
            <input type="submit" id="button_connexion" name="button_connexion" value="Inscription" />
        </div>
    </form>
</div>

<?php include("footer.php"); ?>