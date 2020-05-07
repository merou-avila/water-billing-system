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
            <div class="card mt-3">
              <div class="card-body">

                <h3 class="card-title">
                  Update Consumer Data
                </h3>

                <?php
                    $id=$_REQUEST['id'];
                    $conn = new PDO('mysql:host=localhost;dbname=billingsystem', 'root', '');
                    $query = $conn->query("select * from users where id = '$id'") or die(mysql_error());
                    while ($row = $query->fetch()){
                    {
                      $id = $row['id'];
                      $meter_no=$row['meter_no'];
                      $fname=$row['fname'];
                      $lname=$row['lname'];
                      $gender=$row['gender'];
                      $age=$row['age'];
                      $address=$row['address'];
                      $phone_no=$row['phone_no'];
                      $type=$row['type'];
                    }}
                  ?>

                  <div class="form-group ">
                    <label for="meter-no">Meter Number</label>
                    <input type="text" class="form-control" name="meter_no" value="<?php echo $meter_no;?>" required>
                  </div>
                  <div class="form-group">
                    <label for="first-name">First Name</label>
                    <input type="text" class="form-control" name="fname" value="<?php echo $fname;?>" required>
                  </div>
                  <div class="form-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" class="form-control" name="lname" value="<?php echo $lname;?>" required>
                  </div>
                  <div class="form-group">
                    <label for="age">Age</label>
                    <input type="text" class="form-control" name="age" value="<?php echo $age;?>" required>
                  </div>
                  <div class="form-group">
                      <label for="gender">Gender</label>
                      <select class="form-control"  name="gender" required>
                        <option><?php echo $gender;?></option>
                        <option>Male</option>
                        <option>Female</option>
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" value="<?php echo $address;?>" required>
                  </div>
                  <div class="form-group">
                    <label for="phone-number">Phone Number</label>
                    <input type="text" class="form-control" name="phone_no" value="<?php echo $phone_no;?>" required>
                  </div>

                  <div class="form-group">
                    <label for="type">Type</label>
                    <select class="form-control"  name="type" required>
                      <option><?php echo $type;?></option>
                      <option>client</option>
                      <option>admin</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <button type="submit" name="save" class="btn btn-primary float-right"><i class="fa fa-floppy-o mr-2" aria-hidden="true"></i>Save Changes</button>
                  </div>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
</body>
</html>
<?php
    $conn = new PDO('mysql:host=localhost;dbname=billingsystem', 'root', '');
    if (isset($_POST['save']))
    {
      $meter_no=$_POST['meter_no'];
      $fname=$_POST['fname'];
      $lname=$_POST['lname'];
      $age=$_POST['age'];
      $gender=$_POST['gender'];
      $address=$_POST['address'];
      $phone_no=$_POST['phone_no'];
      $type=$_POST['type'];

    $conn->query("update users set meter_no = '$meter_no', fname = '$fname',lname = '$lname', age = '$age', gender = '$gender', address = '$address', phone_no = '$phone_no', type = '$type' where id = '$id'");

    ?>
    <script>
    window.location = 'consumers.php';
    alert('Consumer info successfully updated.');
    </script>
    else {

    <script>
    window.location = 'edit-consumer.php';
    alert('Error:The data was not updated!');
    </script>

<?php
}
?>