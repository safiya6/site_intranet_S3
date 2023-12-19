<?php
$title = "Formulaire ajout question";
require "view_begin.php";
require "./Utils/tailwind.php";
require "./Utils/login.php";
initPhpSession();
 ?>



<div class="flex flex-col items-center justify-center h-screen">

<h1 class="mb-6"><strong> Remplissez le formulaire pour poster la question </strong></h1>
<figure class="flex w-3/5 shadow-2xl mx-auto bg-center w-fit rounded-xl p-8 bg-gradient-to-r from-teal-50 to-teal-100">


<form action="?controller=modif&action=default" method="post">   
    
   <label class="decoration-dashed ">
        <em>Question</em>
        <input class="decoration-dashed ml-2" type="text" name="question"  required>
    </label>
</br>
</br>
    <label class="decoration-dashed">
         <em>Pour</em>
        <input class="decoration-dashed ml-2" type="number" name="pour"  required>
    </label>

</br>
</br>
    <label class="decoration-dashed" >
        <em>Contre</em>
        <input class="decoration-dashed ml-2" type="number" name="contre"  required>
    </label>

    </br>
    </br>
    
    <button class="bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-4 rounded-full mr-10" type="submit"> Poster </button>
   
   </form>
</figure>

  <div class="flexitems-center justify-center mt-10">
  <a href="?controller=user&action=results">
        <button class="shadow-2xl bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-4 rounded-full mr-10">Voir tout les Sondages</button>
    </a>
    <a href="?controller=modif&action=addQuestion">
        <button class="shadow-2xl bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-4 rounded-full">Ajouter une question</button>
    </a>
    </div>

</div>
</div>


<?php 
var_dump($_SESSION);
require "view_end.php"; ?>