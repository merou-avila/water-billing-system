<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "waterbill";

    // create connection
    $con = new mysqli($servername, $username, $password, $dbname);

    // check connection
    if($con->connect_error) {
        die("Connection Failed : " . $con->connect_error);
    } else {
        // echo "Successfully Connected";
    }
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {

        $account_no= mysqli_real_escape_string($con,$_POST['account_no']);

        $sql = "SELECT * FROM client_users WHERE account_no = '$account_no' and type ='client' and registered= 'no'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        if($count == 1)
        {
         // session_register
         $_SESSION['id']=$row['id'];
         header("location:set-password.php");
        }
        else
        {
         echo "<script>
            window.location = 'confirm-account.php';
            alert('Account already exist.');
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
    <title>Water Billing System</title>
</head>
<body>

    <form method="post" class="container">
        <div class="container col-lg-6 form">
            <p class="mb-3">Please input your account number.</p>
            <div class="form-group">
                <input type="text" class="form-control" name="account_no"placeholder="Account Number" autofocus="" />
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-danger" onClick="window.location='index.php';">Cancel</button>
            </div>
        </div>
    </form>

</body>
</html>
