<?php
    $conn = new PDO('mysql:host=localhost;dbname=billingsystem', 'root', '');
    if (isset($_POST['save']))
    {
      $account_no=$_POST['account_no'];
      $announcement=addslashes($_POST['announcement']);

    $conn->query("insert into announcements (account_no,announcement) values('$account_no','$announcement')");
    ?>
    <script>
    window.location = 'announcements.php';
    alert('Announcement successfully saved.');
    </script>
    else {

    <script>
    window.location = 'add-announcement.php';
    alert('Error:The data was not saved!');
    </script>

<?php
}
?>
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
    <div class="row justify-content-center">
      <div class="col-12 col-md-12 col-lg-6">
        <form method="POST">
          <div class="card mt-3">
            <div class="card-body">

              <h3 class="card-title">
                New Announcement
              </h3>

              <div class="form-group">
                <label for="account-number">Account Number</label>
                <select class="form-control" name="account_no" id="">
                 <?php
                  $conn = new PDO('mysql:host=localhost;dbname=billingsystem', 'root', '');
                  $query = $conn->query("select * from users where type ='client' ") or die(mysql_error());
                  while ($row = $query->fetch()){
                  {
                    $account_no = $row ['account_no'];
                  }
                  ?>
                <option><?php echo $account_no; }?></option>
              </select>
              </div>
              <div class="form-group">
                <label for="announcement">Announcement</label>
                <textarea type="text" rows="4" class="form-control" name="announcement" placeholder="Type your announcement" required></textarea>
              </div>

              <div class="form-group">
                <button type="submit" name="save" class="btn btn-primary float-right"><i class="fa fa-floppy-o mr-2" aria-hidden="true"></i>Save</button>
              </div>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>

</body>
</html>