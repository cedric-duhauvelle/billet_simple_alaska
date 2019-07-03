<?php
$title = "Modication de profil";
include("header.php");
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
        <form method="POST" action="update-profil-controller" class="form_update">
            <label for="updateName">Nom : </label>
            <input type="text" name="updateName" class="update_profil_input" />
            <input type="submit" name="buttonUpdateName" value="Modifier" class="button_update_profil" />
        </form>
        <?php
        if (array_key_exists('errorEmail', $_SESSION)) {
            echo  '<p class="error_message">' .$_SESSION['errorEmail'] . '</p></br>';
            unset($_SESSION['errorEmail']);
        }
        ?>
        <form method="POST" action="update-profil-controller" class="form_update">
            <label for="updateName">Email : </label>
            <input type="email" name="updateEmail" class="update_profil_input" />
            <input type="submit" name="buttonUpdateEmail" value="Modifier" class="button_update_profil" />
        </form>
        <?php
        if (array_key_exists('errorPassword', $_SESSION)) {
            echo  '<p class="error_message">' .$_SESSION['errorPassword'] . '</p></br>';
            unset($_SESSION['errorPassword']);
        }
        ?>
        <form method="POST" action="update-profil-controller" class="form_update">
            <label for="updateName">Mot de passe : </label>
            <input type="password" name="updatePassword" class="update_profil_input" />
            <input type="password" name="updatePasswordCheck" class="update_profil_input" />
            <input type="submit" name="buttonUpdatePassword" value="Modifier" class="button_update_profil" />
        </form>
        <a href="profil">Retour au profil</a>
    </div>
</div>
<?php include("footer.php"); ?>