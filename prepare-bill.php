<?php
    $conn = new PDO('mysql:host=localhost;dbname=billingsystem', 'root', '');
    if (isset($_POST['save']))
    {
      $id=$_REQUEST['id'];
      $prev=$_POST['prev'];
      $pres=$_POST['pres'];
      $price=$_POST['price'];
      $meter_maintenance=$_POST['meter_maintenance'];
      $penalty=$_POST['penalty'];
      $date_from=$_POST['date_from'];
      $date_to=$_POST['date_to'];
      $due_date=$_POST['due_date'];
      $payment_status='no';

    $conn->query("insert into bill_details (user_id,prev,pres,price,meter_maintenance,penalty,date_from,date_to,due_date,payment_status)values('$id','$prev','$pres','$price','$meter_maintenance','$penalty','$date_from','$date_to','$due_date','$payment_status')");
    ?>

    echo "<script>
    window.location = 'consumers.php';
    alert('Bill successfully prepared.');
    </script>";
    else {

    echo"<script>
    window.location = 'prepare-bill.php';
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
    <title>Water Billing System</title>
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
            <a class="nav-link active" href="consumers.php"><i class="fa fa-users mr-2" aria-hidden="true"></i>Consumers</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="announcements.php"><i class="fa fa-bell mr-2" aria-hidden="true"></i>Announcements</a>
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
            <?php
              $id=$_REQUEST['id'];
              $conn = new PDO('mysql:host=localhost;dbname=billingsystem', 'root', '');
              $query = $conn->query("select * from users where id = '$id'") or die(mysql_error());
              while ($row = $query->fetch()){
              {
                $id = $row['id'];
                $fname=$row['fname'];
                $lname=$row['lname'];
              }}
            ?>
            <div class="card mt-3">
              <div class="card-body">

                <h3 class="card-title">
                  Prepare Bill
                </h3>

                <div class="form-group">
                  <span>Consumer Name: <?php echo $fname; ?> <?php echo $lname; ?></span>
                </div>
                 <?php
                  $id=$_REQUEST['id'];
                  $conn = new PDO('mysql:host=localhost;dbname=billingsystem', 'root', '');
                  $query1 = $conn->query("select * from bill_details where user_id = '$id'") or die(mysql_error());
                  while ($r = $query1->fetch()){
                  {
                    $pres = $r['pres'];
                  }}
                ?>
                <div class="form-group ">
                  <label for="">Previous Reading</label>
                  <input type="text" class="form-control" value="<?php if (isset($pres)): ?> <?php echo $pres?>  <?php endif ?>" name="prev" placeholder="Previous" required>
                </div>
                <div class="form-group">
                  <label for="">Present Reading</label>
                  <input type="text" class="form-control" name="pres" placeholder="Present" required>
                </div>
                <?php
                    $conn = new PDO('mysql:host=localhost;dbname=billingsystem', 'root', '');
                    $query = $conn->query("select * from settings") or die(mysql_error());
                    while ($row = $query->fetch()){
                    {
                      $price = $row ['price'];
                      $meter_maintenance = $row ['meter_maintenance'];
                      $penalty = $row ['penalty'];
                    }
                  ?>
                <div class="form-group">
                  <label for="">Rate</label>
                  <input type="text" class="form-control" value = "<?php echo $price; ?>" name="price" disabled>
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" value = "<?php echo $meter_maintenance; ?>" name="meter_maintenance" >
                </div>
                <div class="form-group">
                  <input type="hidden" class="form-control" value = "<?php echo $penalty; ?>" name="penalty" >
                </div>
                <?php }?>
                <label for="">Period Covered</label>
                <div class="form-group row">
                  <div class="col-6">
                      <label for="">Date from:</label>
                      <input type="date" class="form-control" name="date_from" placeholder="Date" required>
                  </div>
                  <div class="col-6">
                      <label for="">Date to:</label>
                      <input type="date" class="form-control" name="date_to" placeholder="Date" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="">Due Date</label>
                  <input type="date" class="form-control" name="due_date" placeholder="Date" required>
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