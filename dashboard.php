<?php
  require 'php/database.php';

  if(checkIfLoggedIn()) {
    echo "<br> SESSION COMPLETE";
  } else {
    header("Location: index.php");
    exit();
  }

  function GetLoginSessionVar() {
     $retvar = md5("Joey");
     $retvar = 'usr_'.substr($retvar,0,10);
     return $retvar;
  }

  function checkIfLoggedIn() {
       session_start();

       $sessionvar = GetLoginSessionVar();

       if(empty($_SESSION[$sessionvar]))
       {
          return false;
       }
       return true;
  }

?>
