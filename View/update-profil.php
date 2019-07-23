<?php

$title = "Modication de profil";

include("Template/header.php");
?>
<div id="content">
    <h2 class="title_section">Modification profil</h2>
    <div id="form_update_content">
        <?php
        if (array_key_exists('errorName', $_SESSION)) {
            echo '<p class="error_message">' . $_SESSION['errorName'] . '</p></br>';
            unset($_SESSION['errorName']);
        }
        ?>
        <form method="POST" action="UpdateProfilController" class="form_update">
            <label for="update_name">Nom : </label>
            <input type="text" name="updateName" class="update_profil_input" id="update_name" required/>
            <input type="submit" name="buttonUpdateName" value="Modifier" class="button_update_profil" />
        </form>
        <?php
        if (array_key_exists('errorEmail', $_SESSION)) {
            echo  '<p class="error_message">' .$_SESSION['errorEmail'] . '</p></br>';
            unset($_SESSION['errorEmail']);
        }
        ?>
        <form method="POST" action="uUpdateProfilControllerr" class="form_update">
            <label for="update_email">Email : </label>
            <input type="email" name="updateEmail" class="update_profil_input" id="update_email" required/>
            <input type="submit" name="buttonUpdateEmail" value="Modifier" class="button_update_profil" />
        </form>
        <?php
        if (array_key_exists('errorPassword', $_SESSION)) {
            echo  '<p class="error_message">' .$_SESSION['errorPassword'] . '</p></br>';
            unset($_SESSION['errorPassword']);
        }
        ?>
        <form method="POST" action="UpdateProfilController" class="form_update">
            <label for="update_password">Mot de passe : </label>
            <input type="password" name="updatePassword" class="update_profil_input" id="update_password" required/>
            <label for="update_check_password">Retapez mot de passe</label>
            <input type="password" name="updatePasswordCheck" class="update_profil_input" id="update_check_password" required/>
            <input type="submit" name="buttonUpdatePassword" value="Modifier" class="button_update_profil" />
        </form>
        <a href="profil">Retour au profil</a>
    </div>
</div>
<?php include("Template/footer.php"); ?>