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
            <a class="nav-link active" href="clients.php"><i class="fa fa-users mr-2" aria-hidden="true"></i>Clients</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="create-bill.php"><i class="fa fa-sticky-note-o mr-2" aria-hidden="true"></i>Create Bill</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="view-records.php"><i class="fa fa-list-ul mr-2" aria-hidden="true"></i>View Records</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="monthly-reports.php"><i class="fa fa-list-alt mr-2" aria-hidden="true"></i>Monthy Reports</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="settings.php"><i class="fa fa-cog mr-2" aria-hidden="true"></i>Settings</a>
          </li>
      </ul>

    <a href="add-client.php" class="btn btn-success active ml-3 mt-5" role="button" aria-pressed="true">Add Client</a>
      <table class="table mt-3 ml-3">
        <thead class="thead-light">
          <tr>
            <th scope="col">Account Number</th>
            <th scope="col">Name</th>
            <th scope="col">Age</th>
            <th scope="col">Gender</th>
            <th scope="col">Address</th>
            <th scope="col">Phone Number</th>
          </tr>
        </thead>
        <?php
          $conn = new PDO('mysql:host=localhost;dbname=waterbill', 'root', '');
          $query = $conn->query("select * from client_users where type ='client' ") or die(mysql_error());
          while ($row = $query->fetch()){
          {
            $account_no = $row ['account_no'];
            $name = $row['fname']." ".$row['lname'];
            $age = $row ['age'];
            $gender = $row ['gender'];
            $address = $row ['address'];
            $phone_no = $row ['phone_no'];
          }
          ?>
        <tbody>
          <tr>
            <td class="account-no"><?php echo $account_no; ?></td>
            <td><?php echo $name; ?></td>
            <td><?php echo $age; ?></td>
            <td><?php echo $gender; ?></td>
            <td><?php echo $address; ?></td>
            <td><?php echo $phone_no; ?></td>

         <?php } ?>
          </tr>
        </tbody>
      </table>

</body>
</html>