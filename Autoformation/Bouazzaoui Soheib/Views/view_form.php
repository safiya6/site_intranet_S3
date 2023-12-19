<?php
$title = "Formulaire de Vote";
require "view_begin.php";
require "./Utils/tailwind.php";
require "./Utils/login.php";
initPhpSession();
 ?>

<div class="flex flex-col items-center justify-center h-screen">

<h1 class=mb-5><strong>Sondage</strong></h1>

<figure class="flex w-3/5 shadow-2xl mx-auto bg-center w-fit rounded-xl p-8 bg-gradient-to-r from-teal-50 to-teal-100">

    <form action="?controller=user&action=default" method="post">
        <input type="hidden" name="q" value="<?= e($randomQuestion[0][0]) ?>">
        <div class="text-center m space-y-4">

            <h1><strong>Question :</strong> <?= e($randomQuestion[0][1]) ?> </h1>

            <label>
                <input type="radio" name="r" value="1" required class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 focus:border-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"> &nbsp;Pour&nbsp;
          </label>
           <label>
                <input type="radio" name="r" value="0" required class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 focus:ring-red-500 focus:border-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"> &nbsp;Contre&nbsp;</label>
            <br>
            <button type="submit" class="box-shadow-2xl bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-4  rounded-full">Soumettre</button>
        </div>
    </form>
</figure>
    <!--
    <div class="flexitems-center justify-center mt-10">
        <a href="?controller=connection&action=default">
        <button class="bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-4 rounded-full mr-10">Se connecter</button>

        </a>
    </div>
    -->
  <div class="flexitems-center justify-center mt-10">
  <a href="?controller=user&action=results">
        <button class="bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-4 rounded-full mr-10">Voir tout les Sondages</button>
    </a>
    <a href="?controller=modif&action=addQuestion">
        <button class="bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-4 rounded-full">Ajouter une question</button>
    </a>
    </div>

</div>


<?php
var_dump($_SESSION);
require "view_end.php";
 ?>
