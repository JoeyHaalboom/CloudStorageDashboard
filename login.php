<?php
  require 'php/database.php';
  if(login($conn)) {
    header("Location: dashboard.php");
    exit();
  }

  function GetLoginSessionVar() {
     $retvar = md5("Joey");
     $retvar = 'usr_'.substr($retvar,0,10);
     return $retvar;
  }

  function Login($conn) {
    if(empty($_POST['username'])) {
        echo "UserName is empty!";
        return false;
    }

    if(empty($_POST['password'])) {
        echo "Password is empty!";
        return false;
    }

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if(checkLogin($conn, $username,$password)) {
        echo "WERKT";

    } else {
        echo "WERKT NIET";
        return false;
    }

    session_start();

    $_SESSION[GetLoginSessionVar()] = $username;

    return true;
}

?>
