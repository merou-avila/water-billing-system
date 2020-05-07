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
            <h4>Set Password</h4>
            <?php $conn = new PDO('mysql:host=localhost;dbname=billingsystem', 'root', '');?>
            <?php include('session.php') ;
                $query = $conn->query("select * from users where id = '$session_id'") or die(mysql_error());
                while ($row = $query->fetch()){
                {
                  $id = $row['id'];
                  $name = $row['fname']." ".$row['lname'];
                  $account_no = $row['account_no'];
                  $password = $row['password'];

                }
                ?>
            <span>Account # : <?php echo $account_no;?></span><br>
            <span>Account Name : <?php echo $name;?></span>
            <div class="form-group mt-3">
                <input type="password" class="form-control" name="password"  autofocus="" />
            </div>
            <div class="form-group mt-3">
                <input type="hidden" class="form-control" name="registered" value = "yes" autofocus="" />
            </div>
        <?php };?>
            <div class="form-group text-right">
                <input type="hidden" name="id" value="<?php echo $session_id; ?>" />
                <button type="submit" name="save" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-danger" onClick="window.location='index.php';">Cancel</button>
            </div>
        </div>
    </form>
</body>
</html>
<?php
    $conn = new PDO('mysql:host=localhost;dbname=billingsystem', 'root', '');
    if (isset($_POST['save']))
    {
      $id=$_POST['id'];
      $password=$_POST['password'];
      $registered=$_POST['registered'];

    $conn->query("update users set password = '$password',registered = '$registered' where id = '$id'");

    ?>
    echo "<script>
    window.location = 'index.php';
    alert('Password successfully set.');
    </script>";
    else {

    echo"<script>
    window.location = 'index.php';
    alert('Error:The data was not saved!');
    </script>";

<?php
}
?>
