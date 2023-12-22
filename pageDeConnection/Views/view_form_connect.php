<?php require "view_begin.php" ?>

    <div id="pagelogin">
            <p><img id="imgIutv" src="./src/img/iutv.jpg"></p>
            <div id="login">
                <img id="logo" src="./src/img/logo.svg" >
                <div id="form">
                    <h2>Portail Enseignant</h2>    

                    <form id="form" action="" method="post">
                        <p>
                            <img class="imgInput" src="./src/img/personne.svg">
                            <input type="number" name="ide" placeholder="Identifiant">
                        </p>
                        <p> <img class="imgInput" src="./src/img/mdp.svg">
                            <input type="password" name="mdp" placeholder="Mot de passe" required pattern"[0-9]{7}"></p>
                        <p> <input type="submit" id="connexion" value="Se connecter" required> </p>
                    </form>
                </div>
            </div>
        </div>


<?php

require "view_end.php"?>
