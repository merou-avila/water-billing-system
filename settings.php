<?php
    $conn = new PDO('mysql:host=localhost;dbname=billingsystem', 'root', '');
    if (isset($_POST['save']))
    {
      $id=$_POST['id'];
      $price=$_POST['price'];
      $meter_maintenance=$_POST['meter_maintenance'];
      $penalty=$_POST['penalty'];

    $conn->query("update settings set price = '$price',meter_maintenance = '$meter_maintenance', penalty = '$penalty' where id = '$id'");

    ?>
    echo "<script>
    window.location = 'settings.php';
    alert('Settings successfully saved.');
    </script>";
    else {

    echo"<script>
    window.location = 'settings.php';
    alert('Error:The data was not saved!');
    </script>";

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
            <a class="nav-link" href="announcements.php"><i class="fa fa-bell mr-2" aria-hidden="true"></i>Announcements</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="monthly-reports.php"><i class="fa fa-list-alt mr-2" aria-hidden="true"></i>Monthy Reports</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="settings.php"><i class="fa fa-cog mr-2" aria-hidden="true"></i>Settings</a>
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
                  Settings
                </h3>
                <?php
                  $conn = new PDO('mysql:host=localhost;dbname=billingsystem', 'root', '');
                  $query = $conn->query("select * from settings") or die(mysql_error());
                  while ($row = $query->fetch()){
                  {
                    $id = $row['id'];
                    $price = $row ['price'];
                    $meter_maintenance = $row ['meter_maintenance'];
                    $penalty = $row ['penalty'];
                  }
                ?>
                  <div class="form-group">
                    <label for="">Rate</label>
                    <input type="text" class="form-control" value = "<?php echo $price; ?>" name="price" >
                  </div>
                  <div class="form-group">
                    <label for="">Meter Maintenance</label>
                      <input type="text" class="form-control" value = "<?php echo $meter_maintenance; ?>" name="meter_maintenance" >
                  </div>
                  <div class="form-group">
                    <label for="">Penalty After Due</label>
                      <input type="text" class="form-control" value = "<?php echo $penalty; ?>" name="penalty" >
                  </div>
                <?php }?>
                  <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <button type="submit" name="save" class="btn btn-primary float-right"><i class="fa fa-floppy-o mr-2" aria-hidden="true"></i>Save</button>
                  </div>
                </div>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
</body>
</html>