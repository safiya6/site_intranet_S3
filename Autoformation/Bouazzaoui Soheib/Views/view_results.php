
<?php
$title = "Liste des questions dans la BDD";
require "view_begin.php";
require "./Utils/tailwind.php";
require "./Utils/login.php";
?>
<div class="flex flex-col items-center justify-center h-auto">
<figure class="flex flex-wrap shadow-2xl mx-auto bg-center w-auto h-auto rounded-xl p-10 bg-gradient-to-r from-teal-50 to-teal-100">
        

    <form action='?controller=modif&action=deleteQuestion' method="post">
        <h1>Liste des sondages enregistrés dans la BDD</h1>
        <dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
            <?php 
            $i = 1;
            foreach ($results as $row) {
                echo '<div class="flex flex-col text-sm py-3 max-w-full">';
                echo '<dt class="mb-1 text-sm text-stone-900 md:text-lg dark:text-stone-900"><strong>Question ' . $i . '</strong></dt>';
                echo '<dd class="text-stone-800 text-lg text-sm">'.$row[1]. '</dd>' ;
                echo '<dd class="text-stone-600 text-lg text-sm">' ."pour ". $row['pour'] . ' | contre ' . $row['contre'] . '  <button class="text-red-700" type="submit" name="id" value="' . $row['id'] . '">  | Supprimer</button></dd>';
                echo '</div>';
                $i += 1;
            }
            ?>
        </dl>

    </form>
        


</figure>
<div class="mt-3.5 mb-3.5">
        <a href="?controller=user&action=default">
            <button class="bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-4 rounded-full">  Retourner aux sondage</button>
            &nbsp;
        </a>

        <a href="?controller=modif&action=addQuestion">
            <button class="bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-4 rounded-full">Ajouter une question</button>
        </a>
    </div>   

</div>  
<?php require 'view_end.php' ?>
