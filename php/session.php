<?php
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
