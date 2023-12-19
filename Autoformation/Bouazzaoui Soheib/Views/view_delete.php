<?php
$title = "Validation de suppression";
require "view_begin.php";
require "./Utils/tailwind.php";
require "./Utils/login.php";
initPhpSession();
  ?>




<div class="flex flex-col items-center justify-center h-screen">

<h1 class=mb-5><strong>Suppresion de question </strong></h1>

<figure class="flex w-3/5  flex-col shadow-2xl mx-auto bg-center w-fit rounded-xl p-8 bg-gradient-to-r from-red-400 to-red-500">
<h1> <strong> Attention : suppression definitive ! </strong></h1>
<p> Voulez vous supprimer la question suivante avec tout les avis associé  : &nbsp;&nbsp;<strong> <?php echo $data[0][1] ?> </strong>  </p>


<form action='?controller=modif&action=confirmedDeleteQuestion' method="post">
    <input  type=radio name=idDelete value=<?= $data[0][0]?> > oui </input>
    <input type=radio name=idDelete value=<?= NULL?> > non </input>
    <input class="bg-white hover:bg-red-200 text-black font-bold py-2 px-4 rounded-full" value="submit" type="submit"> </input>
</form>

</figure>

  <div class="flexitems-center justify-center mt-10">
    <a href="?controller=user&action=randomQuestion">
        <button class="bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-4 rounded-full mr-10">Question aléatoire</button>
    </a>

  <a href="?controller=user&action=results">
        <button class="bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-4 rounded-full mr-10"> Retourner à la liste </button>
    </a>
    <a href="?controller=modif&action=addQuestion">
        <button class="bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-4 rounded-full"> Ajouter une question </button>
    </a>
</div>

</div>




<?php require "view_end.php"; ?>

