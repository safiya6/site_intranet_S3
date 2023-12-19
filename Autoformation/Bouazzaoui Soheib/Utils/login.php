<?php
  function initPhpSession()
  {
    if(!session_id()){
        session_start();
        session_regenerate_id();
    } 
    echo("fait");
  }

  function cleanPhpSession() : void{
    session_unset();
    session_destroy;
  }

  function islogged() : bool {
    return True;
  }

  function isAdmin() : bool {
    return True;
  }
?>