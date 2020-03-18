<?php

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "waterbill";

  // create connection
  $con = new mysqli($servername, $username, $password, $dbname);

  // check connection
  if($con->connect_error) {
    die("Connection Failed : " . $connect->connect_error);
  } else {
    // echo "Successfully Connected";
  }
  session_start();

  if($_SERVER["REQUEST_METHOD"] == "POST") {

    $account_no= mysqli_real_escape_string($con,$_POST['account_no']);
    $password = mysqli_real_escape_string($con,$_POST['password']);

    $sql = "SELECT * FROM client_users WHERE account_no = '$account_no' and password = '$password'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $type = $row['type'];

        if($type==admin)
        {
            $_SESSION['id'] = $row['id'];
            // Redirect user to admin.php
            header("Location: admin.php");
        }
        if($type==client)
        {
            $_SESSION['id'] = $row['id'];
            // Redirect user to client-bill.php
            header("Location: client-bill.php");
        }
        else
        {
            echo "<script>
            window.location = 'index.php';
            alert('Account do not exist. Please try again...');
            </script>";
        }
    }
    else{
?>
<?php } ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Water Billing System</title>
</head>
<body>

    <form method="post" class="container">
        <div class="container col-lg-6 form">
            <h2 class="text-center mb-3">Login</h2>
            <div class="form-group">
                <input type="text" class="form-control" name="account_no"placeholder="Account Number" required  autofocus="" />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required />
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            Don't have an account?
            <a href="confirm-account.php">Click here!</a><br>
            <!-- Forgotten your password?
            <a href="reset_password.php">Reset Password</a> -->
        </div>
    </form>

</body>
</html>