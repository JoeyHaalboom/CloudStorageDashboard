<?php
  require 'php/database.php';
  require 'php/session.php';

  if(login($conn)) {
    header("Location: dashboard.php");
    exit();
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
