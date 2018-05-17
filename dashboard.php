<?php
  require 'php/database.php';
  require 'php/session.php';
  require 'php/formule.php';

  if(!checkIfLoggedIn()) {
    header("Location: index.php");
    exit();
  }

  function createTableRow($conn, $row) {
    if($row == "Files") {
      if(getTotalFiles($conn) >= 750) {
        echo '<tr class="table-warning">';
      } else if(getTotalFiles($conn) >= 1000) {
        echo '<tr class="table-danger">';
      } else {
        echo '<tr class="table-success">';
      }
      echo '<td>Totale bestanden</td>';
      echo '<td>'.getTotalFiles($conn).'</td>';


    } else if($row == "Users") {
      if(getTotalUsers($conn) >= 250) {
        echo '<tr class="table-warning">';
      } else if(getTotalUsers($conn) >= 500) {
        echo '<tr class="table-danger">';
      } else {
        echo '<tr class="table-success">';
      }
      echo '<td>Totale gebruikers</td>';
      echo '<td>'.getTotalUsers($conn).'</td>';


    } else if($row == "StorageSpace") {
      if(getStorageUsed($conn) >= 3500000) {
        echo '<tr class="table-warning">';
      } else if(getStorageUsed($conn) >= 3000000) {
        echo '<tr class="table-danger">';
      } else {
        echo '<tr class="table-success">';
      }
      echo '<td>Totale ruimte over (MB)</td>';
      echo '<td>',4000000-getStorageUsed($conn).'</td>';


    } else if($row == "FileSize") {
      echo '<tr>';
      echo '<td>Gemiddelde bestands grote (MB)</td>';
      echo '<td>'.floor(getAverageFileSize($conn)).'</td>';


    } else if($row == "SharedFiles") {
      echo '<tr>';
      echo '<td>Gedeelde bestanden</td>';
      echo '<td>'.getSharedFiles($conn).'%</td>';


    } else if($row == "AgeFiles") {
      echo '<tr>';
      echo '<td>Gemiddelde leeftijd bestand</td>';
      echo '<td>'.floor(getAverageAge($conn)).' dagen</td>';
    }
    echo '</tr>';
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cloud Storage Dashboard</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet">

    <link href="css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Joey INC</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="logout.php">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="users.php">
                  <span data-feather="users"></span>
                  Users
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
          </div>
          <div class="row">
            <div class="col-sm-4">
              <canvas id="fileTypes" width="500" height="300"></canvas>
            </div>
            <div class="col-sm-4">
              <canvas id="storage" width="400" height="300"></canvas>
            </div>
            <div class="col-sm-4">
              <div class="container">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Statistieken</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    createTableRow($conn, "Files");
                    createTableRow($conn, "Users");
                    createTableRow($conn, "StorageSpace");
                    createTableRow($conn, "FileSize");
                    createTableRow($conn, "SharedFiles");
                    createTableRow($conn, "AgeFiles");
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          </div>

          <div class="row">
            <div class="col-sm-4">

            </div>
          </div>
        </main>
      </div>
    </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"><\/script>')</script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
  <script>
    feather.replace()
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
  <script>
    var ctx = document.getElementById("storage");
    var myChart = new Chart(ctx, {
      type: 'doughnut',
      data: data = {
        datasets: [{
          label:"Opslag (MB)",
          data: [30, 70],
          backgroundColor: ["#ff0000", "#00ff00"]
        }],
        labels: ["Gebruikt", "Niet gebruikt"]
      },
      options: {
        responsive: false,
        title:{
            display: true,
            text: "Opslag (MB)"
        }
    }
    });
  </script>
  <script>
    var ctx = document.getElementById("fileTypes");
    var myChart = new Chart(ctx, {
      type: 'doughnut',
      data: data = {
        datasets: [{
          label:"Filetypes",
          data: <?php echo json_encode(filePercentage($conn));?>,
          backgroundColor: ["#ff0000", "#e6001a", "#cc0033", "#b2004c", "#990066", "#8c0073", "#800080", "#660099", "#4000bf", "#4d00b2", "#3300cc", "#1900e6", "#0000ff"]
        }],
        labels: <?php echo json_encode(fileTypes($conn));?>
      },
      options: {
        responsive: false,
        title:{
            display: true,
            text: "Filetypes"
        }
    }
    });
  </script>
</body>
</html>
