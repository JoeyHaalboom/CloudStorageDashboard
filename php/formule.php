<?php

  function fileTypes($conn) {
    $types = getFileTypeInfo($conn);
    $type = array_unique($types);
    $finalarray = array_values($type); //Retuns array with unique file names
    return $finalarray;
  }

  function filePercentage($conn) {
    $types = getFileTypeInfo($conn);
    $tmp = array_count_values($types); //
    $type = array_unique($types);
    $finalarray = array_values($type); //Retuns array with unique file names

    $countarray;
    foreach ($type as $row) {
      $countarray[] = $tmp[$row];
    }
    return $countarray;
  }
?>
