<?php
    $conn = new PDO('mysql:host=localhost;dbname=billingsystem', 'root', '');
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
      $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

      $sql = $conn->query("SELECT COUNT(*) FROM users WHERE account_no='$account_no'");

      if ($sql->fetchColumn() > 0) {
        $error = "Sorry account number already exists.";
      }
      else
      {
           $conn->query("INSERT INTO users (account_no,meter_no,fname,lname,age,gender,address,phone_no,type,registered,image)values('$account_no','$meter_no','$fname','$lname','$age','$gender','$address','$phone_no','$type','$registered','$file')");

       echo " <script>
        window.location = 'consumers.php';
        alert('Consumer successfully added.');
        </script>";
      }
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
    <script src="js/image.min.js"></script>
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
        <form method="POST" enctype="multipart/form-data">
          <div class="card mt-3">
            <div class="card-body">

              <h3 class="card-title">
                Add Consumer
              </h3>

              <div class="form-group" <?php if (isset($error)): ?> class="form_error" <?php endif ?> >
                <label for="account-number">Account Number</label>
                <input type="text" class="form-control" name="account_no" placeholder="Account Number" autofocus="" required>
                <?php if (isset($error)): ?>
                  <span style="color: red;"><?php echo $error; ?></span>
                <?php endif ?>
              </div>
              <div class="form-group">
                <label for="meter-no">Meter Number</label>
                <input type="text" class="form-control" name="meter_no" placeholder="Meter Number" required>
              </div>
              <div class="form-group">
                <label for="first-name">First Name</label>
                <input type="text" class="form-control" name="fname" placeholder="First name" required>
              </div>
              <div class="form-group">
                <label for="last-name">Last Name</label>
                <input type="text" class="form-control" name="lname" placeholder="Last name" required>
              </div>
              <div class="form-group">
                <label for="age">Age</label>
                <input type="text" class="form-control" name="age" placeholder="Age" required>
              </div>
              <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control"  name="gender" required>
                  <option>Male</option>
                  <option>Female</option>
                </select>
              </div>
              <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" placeholder="Address" required>
              </div>
              <div class="form-group">
                <label for="phone-number">Phone Number</label>
                <input type="text" class="form-control" name="phone_no" placeholder="Phone Number" required>
              </div>
              <div class="form-group">
                <input type="hidden" class="form-control" name="registered" value="<?php echo $registered;?>" required>
              </div>
              <div class="form-group">
                <label for="type">Type</label>
                <select class="form-control"  name="type" required>
                  <option>client</option>
                  <option>admin</option>
                </select>
              </div>
              <div class="form-group">
                <strong>Barcode Image (Image maximum size: 700KB only)</strong>
                <label>Use this link to generate barcode: <a href="https://www.barcodesinc.com/generator/index.php">https://www.barcodesinc.com/generator/index.php</a></label>
                <input type="file" name="image" id="image" required>
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
<script>
  $(document).ready(function(){
    $('#save').click(function() {
      var image_name = $('#image').val();
      if (image_name=='')
      {
        alert("Please select image!");
        return false;
      }
      else
      {
        var extension = $('#image').val().split('.').pop().toLowerCase();
        if(jquery.inArray(extension,['jpg','png','jpeg']) == -1)
        {
          alert('Invalid image file.');
          $('#image').val('');
          return false;
        }
      }
    });
  });
</script>





