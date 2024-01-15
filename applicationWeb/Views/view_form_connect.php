<?php require "view_begin.php" ?>

<?php if (isset($error_message) && !empty($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

<div id="pagelogin">
            <p><img id="imgIutv" src="Content/iutv.jpg"></p>
            <div id="login">
                <img id="logo" src="Content/logo.svg" >
                <div id="form">
                    <h2>Portail Enseignant</h2>    

                    <form id="form" action="" method="post">
                        <p>
                            <img class="imgInput" src="Content/personne.svg">
                            <input type="number" name="ide" placeholder="Identifiant">
                        </p>
                        <p> <img class="imgInput" src="Content/mdp.svg">
                            <input type="password" name="mdp" placeholder="Mot de passe"></p>
                        <p> <input type="submit" id="connexion" value="Se connecter"> </p>
                    </form>
                </div>
            </div>
        </div>

<?require "view_end.php"?>
