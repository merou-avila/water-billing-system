<?php
$conn = new PDO('mysql:host=localhost;dbname=billingsystem', 'root', '');
?>
<?php include('../session.php') ;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/font-awesome.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <title>Water Billing System</title>
</head>
<body>
    <?php include('nav.php') ?>
    <div class="container">
        <div class="row mt-3">
            <div class="col"></div>
            <div class="col-md-8 col-lg-8">
                <form method="POST">
                  <div class="card mt-3">
                    <div class="card-body">

                      <h5 class="card-title">Change Password</h5>
                        <div class="form-group">
                            <label for="old-password">Old Password</label>
                            <input type="password" class="form-control" value="<?php echo $password;?>" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="new-password">New Password</label>
                            <input type="password" class="form-control" name="password" placeholder="">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            <button type="submit" name="save" class="btn btn-primary float-right"><i class="fa fa-floppy-o mr-2" aria-hidden="true"></i>Save New Password</button>
                        </div>

                      </div>
                    </div>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
</body>
</html>
<?php
    $conn = new PDO('mysql:host=localhost;dbname=billingsystem', 'root', '');
    if (isset($_POST['save']))
    {
      $password=$_POST['password'];

    $conn->query("update users set password = '$password' where id = '$id'");
    ?>
    <script>
    window.location = 'change-password.php';
    alert('Password changed successfully.');
    </script>
    else {

    <script>
    window.location = 'change-password.php';
    alert('Error:The data was not saved!');
    </script>

<?php
}
?>