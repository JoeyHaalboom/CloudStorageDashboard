<?php
$servername = "localhost";
$database = "CloudStorageDashboard";
$user = "root";
$password = "";
$conn = new PDO("mysql:host=$servername;dbname=$database", $user, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  function checkLogin($conn, $username, $password) {
    $sql = "SELECT username, password FROM users WHERE username = '" .$username. "' AND password = '" .md5($password). "';";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $number_of_rows = count($result);

    if($number_of_rows == 0) {
      return false;
    } else {
      return true;
    }
  }

  function getFileTypeInfo($conn) {
    $types;

    $sql = "SELECT Name FROM files;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    foreach ($result as $row) {
      $string = $row['Name'];
      $sstring = strstr($string, '.');
      $newstring = str_replace(".","",$sstring);
      $types[] = $newstring;
    }
    return $types;
  }

  function getStorageUsed($conn) {
    $sql = "SELECT Size FROM files;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $storage = 0;
    foreach ($result as $row) {
      $size = $row['Size'];
      $storage += $size;
    }
    return $storage;
  }

  function getAverageFileSize($conn) {
    $sql = "SELECT Size FROM files;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $storage = 0;
    foreach ($result as $row) {
      $size = $row['Size'];
      $storage += $size;
    }
    $sql = "SELECT COUNT(ID) FROM files;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $totalFiles = $stmt->fetch();
    $average = $storage/$totalFiles["COUNT(ID)"];
    return $average;
  }

  function getTotalFiles($conn) {
    $sql = "SELECT COUNT(ID) FROM files;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $totalFiles = $stmt->fetch();
    return $totalFiles["COUNT(ID)"];
  }

  function getTotalUsers($conn) {
    $sql = "SELECT COUNT(ID) FROM users;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $totalFiles = $stmt->fetch();
    return $totalFiles["COUNT(ID)"];
  }
?>
