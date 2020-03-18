<?php
    $conn = new PDO('mysql:host=localhost;dbname=waterbill', 'root', '');
    if (isset($_POST['save']))
    {
      $account_no=$_POST['account_no'];
      $meter_no=$_POST['meter_no'];
      $fname=$_POST['fname'];
      $lname=$_POST['lname'];
      $age=$_POST['age'];
      $gender=$_POST['gender'];
      $address=$_POST['address'];
      $phone_no=$_POST['phone_no'];
      $type=$_POST['type'];
      $registered='no';

    $conn->query("insert into client_users (account_no,meter_no,fname,lname,age,gender,address,phone_no,type,registered)
         values('$account_no','$meter_no','$fname','$lname','$age','$gender','$address','$phone_no','$type','$registered')");

    ?>
    <script>
    window.location = 'clients.php';
    alert('Data successfully saved.');
    </script>
    else {

    <script>
    window.location = 'add-client.php';
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
    </div>
  <form method="POST">
      <div class="container">

          <h3 class="mt-5 mb-3">Add Client</h3>

          <div class="form-group row">
            <div class="col-6">
              <input type="text" class="form-control" name="account_no" placeholder="Account Number" autofocus="" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-6">
              <input type="text" class="form-control" name="meter_no" placeholder="Meter Number" autofocus="" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-6">
              <input type="text" class="form-control" name="fname" placeholder="First name" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-6">
                <input type="text" class="form-control" name="lname" placeholder="Last name" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-6">
                <input type="text" class="form-control" name="age" placeholder="Age" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-6">
              <select class="form-control"  name="gender" required>
                <option></option>
                <option>Male</option>
                <option>Female</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-6">
                <input type="text" class="form-control" name="address" placeholder="Address" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-6">
                <input type="text" class="form-control" name="phone_no" placeholder="Phone Number" required>
            </div>
          </div>
          <div class="form-group row mb-0">
            <div class="col-6">
                <input type="hidden" class="form-control" name="registered" value="<?php echo $registered;?>" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-6">
              <select class="form-control"  name="type" required>
                <option></option>
                <option>client</option>
                <option>admin</option>
              </select>
            </div>
          </div>
          <div class="form-group col-6">
            <button type="submit" name="save" class="btn btn-primary float-right"><i class="fa fa-floppy-o mr-2" aria-hidden="true"></i>Save</button>
          </div>
      </div>
  </form>
</body>
</html>