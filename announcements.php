<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <title>Admin-Water Billing System</title>
</head>
<body>
  <nav class="navbar navbar-light bg-light mb-3">
    <a class="navbar-brand" href="#">
      <img src="images/logosample.png" width="30" height="40" class="d-inline-block align-top" alt="">
      Water Billing System
    </a>
     <ul class="nav nav-pills">
       <li class="nav-item">
        <a class="nav-link" href="logout.php"><i class="fa fa-sign-out mr-2" aria-hidden="true"></i>Logout</a>
      </li>
    </ul>
  </nav>
  <div class="container">
      <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link" href="admin.php"><i class="fa fa-home mr-2"></i>Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="consumers.php"><i class="fa fa-users mr-2" aria-hidden="true"></i>Consumers</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="announcements.php"><i class="fa fa-bell mr-2" aria-hidden="true"></i>Announcements</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="monthly-reports.php"><i class="fa fa-list-alt mr-2" aria-hidden="true"></i>Monthy Reports</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="settings.php"><i class="fa fa-cog mr-2" aria-hidden="true"></i>Settings</a>
          </li>
      </ul>
  </div>
  <div class="container">
    <div class="row mt-3">
      <div class="col-12">

        <div class="card">

          <div class="card-body">

            <div class="d-flex">
              <h5 class="card-title">Announcements</h5>
              <div class="page-header-action-col ml-auto">
                <a href="add-announcement.php" class="btn btn-primary ml-3" role="button" aria-pressed="true">New Announcement</a>
              </div>
            </div>
            <table class="table table-hover mt-3">
              <thead class="thead">
                <tr>
                  <th scope="col">Account # To:</th>
                  <th scope="col">Announcement</th>
                  <th scope="col">Date created</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <?php
                  $conn = new PDO('mysql:host=localhost;dbname=billingsystem', 'root', '');
                  $query = $conn->query("select * from announcements") or die(mysql_error());
                  while ($row = $query->fetch()){
                  {
                    $id = $row ['id'];
                    $account_no = $row ['account_no'];
                    $announcement = $row ['announcement'];
                    $date = $row ['date_created'];
                    $date_created = date('M-d-yy', strtotime($date));
                  }
                  ?>
              <tbody>
                  <tr>
                    <td class="account-no">
                        <?php echo $account_no; ?>
                    </td>
                    <td>
                     <?php echo $announcement; ?>
                    </td>
                    <td>
                     <?php echo $date_created; ?>
                    </td>
                    <td>
                      <a href = "edit-announcement.php?id=<?php echo $id; ?>" style="text-decoration: none; !important" > <i class="fa fa-edit mr-2"> Edit</i></a>
                    </td>
                 <?php } ?>
                  </tr>
                </tbody>
            </table>


          </div>

        </div>

      </div>
    </div>
  </div>

</body>
</html>