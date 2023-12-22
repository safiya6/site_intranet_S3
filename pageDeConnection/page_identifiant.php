<?php require "./Views/view_begin.php" ;
session_start();
?>


<div class="space-y-[25px] flex flex-col items-center justify-center h-screen">
    <h1 class= "text-xl italic text-indigo-100">vous êtes connectées</h1>

    <figure class="flex w-3/5  flex-col shadow-2xl mx-auto bg-center w-fit rounded-xl p-8 bg-gradient-to-r from-indigo-50 to-indigo-100">
       <div class= text-zinc-950> votre role actuel : <?php

        if (isset($_SESSION['prenom']) && isset($_SESSION['role'])) {
            echo "Bonjour, <strong>" . $_SESSION['prenom'] . "</strong>.</br> Vous êtes connecté en tant que <strong>" . $_SESSION['role'] . "</strong>.";
        } else {
            echo "Vous n'êtes pas connecté.";
        }
    ?>
    </div>

 </figure>
</div>
<?php require "view_end.php"?>