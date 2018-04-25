<?php
require 'php/database.php';
require 'php/session.php';

if(checkIfLoggedIn()) {
  session_unset();
  header("Location: index.php");
  exit();
} else {
  header("Location: index.php");
  exit();
}
 ?>
