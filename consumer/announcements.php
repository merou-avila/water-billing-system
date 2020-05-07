<?php
$conn = new PDO('mysql:host=localhost;dbname=billingsystem', 'root', '');
?>
<?php  include('../session.php') ;
  $bills = $conn->query("select
    announcements.account_no,
    announcements.announcement,
    announcements.date_created,
    users.id,
    users.account_no,
    users.lname
    from announcements JOIN users ON announcements.account_no = users.account_no WHERE users.id = '$session_id' order by date_created desc") or die(msql_error());
    $rows = $bills->fetchAll(PDO::FETCH_ASSOC);
?>
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
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Announcements</h5>
                    </div>
                </div>
                <?php
                    foreach ($rows as $row => $announcement) {
                    echo'
                    <div class="card">
                        <div class="card-body">
                            <span style="font-weight: 500;"><i class="fa fa-bell mr-2"></i>'.  $announcement['announcement'].'</span></br>
                            <span style="font-weight: 100;">Date Posted: '. date('F j, Y - h:i:a', strtotime($announcement['date_created'])).'</span>
                        </div>
                    </div>';
                }?>
            </div>
        </div>
    </div>
</body>
</html>