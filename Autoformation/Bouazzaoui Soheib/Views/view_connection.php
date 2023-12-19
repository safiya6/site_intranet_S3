<?php
$title = " connection";
require "view_begin.php";
require "./Utils/tailwind.php";
require "./Utils/login.php";
initPhpSession();
 ?>

<div class="flex flex-col items-center justify-center h-screen">

<div class="w-full max-w-xs">
  <form class="bg-gradient-to-l from-teal-50 to-teal-100 shadow-xl rounded-xl px-8 pt-6 pb-8 mb-4" method=post action="?controller=connection&" >
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
        Username
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="username" id="username" type="text" placeholder="Username">
    </div>
    <div class="mb-6">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
        Password
      </label>
      <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="password" id="password" type="password" placeholder="******************">
      <p class="text-red-500 text-xs italic">Please choose a password.</p>
    </div>
    <div class="flex items-center justify-between">
      <button class="bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-4 rounded-full mr-10" type="submit">
        Sign In
      </button>
    
    </div>
  </form>
  <p class="text-center text-gray-500 text-xs">
    &copy;Bouazzaoui Soheib All rights reserved.
  </p>
</div>
</div>

<?php
  echo $_POST["username"];
  $pass = $_POST["username"];
  $hash = password_hash($pass, PASSWORD_BCRYPT);
  echo $hash;
  echo password_verify($pass,$hash); 
  var_dump($_POST);
  require "view_end.php"; 
?>






//password_verify



