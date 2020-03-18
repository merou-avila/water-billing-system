<?php
    $conn = new PDO('mysql:host=localhost;dbname=waterbill', 'root', '');
    if (isset($_POST['save']))
    {
      $id=$_POST['id'];
      $price=$_POST['price'];
      $meter_maintenance=$_POST['meter_maintenance'];
      $penalty=$_POST['penalty'];

    $conn->query("update bill_settings set price = '$price',meter_maintenance = '$meter_maintenance', penalty = '$penalty' where id = '$id'");

    ?>
    echo "<script>
    window.location = 'settings.php';
    alert('Data successfully saved.');
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
            <a class="nav-link" href="clients.php"><i class="fa fa-users mr-2" aria-hidden="true"></i>Clients</a>
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
            <a class="nav-link active" href="settings.php"><i class="fa fa-cog mr-2" aria-hidden="true"></i>Settings</a>
          </li>
        </ul>
    </div>
<form method="POST">
      <div class="container">

          <h3 class="mt-5 mb-3">Settings</h3>
          <?php
            $conn = new PDO('mysql:host=localhost;dbname=waterbill', 'root', '');
            $query = $conn->query("select * from bill_settings") or die(mysql_error());
            while ($row = $query->fetch()){
            {
              $id = $row['id'];
              $price = $row ['price'];
              $meter_maintenance = $row ['meter_maintenance'];
              $penalty = $row ['penalty'];
            }
            ?>
          <div class="form-group row">
            <div class="col-6">
              <label for="">Rate</label>
                <input type="text" class="form-control" value = "<?php echo $price; ?>" name="price" >
            </div>
          </div>
          <div class="form-group row">
            <div class="col-6">
              <label for="">Meter Maintenance</label>
                <input type="text" class="form-control" value = "<?php echo $meter_maintenance; ?>" name="meter_maintenance" >
            </div>
          </div>
          <div class="form-group row">
            <div class="col-6">
              <label for="">Penalty After Due</label>
                <input type="text" class="form-control" value = "<?php echo $penalty; ?>" name="penalty" >
            </div>
          </div>
        <?php }?>
          <div class="form-group col-6">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <button type="submit" name="save" class="btn btn-primary float-right">Save</button>
          </div>
      </div>
    </form>

<?php}?>
</body>
</html>