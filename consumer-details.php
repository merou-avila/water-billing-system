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
    <div class="row mt-3">
      <div class="col-12">
        <div class="card mb-30">
          <div class="card-body">
            <?php
              $id=$_REQUEST['id'];
              $conn = new PDO('mysql:host=localhost;dbname=billingsystem', 'root', '');
              $query = $conn->query("select * from users where id = '$id'") or die(mysql_error());
              while ($row = $query->fetch()){
              {
                $id = $row['id'];
                $fname=$row['fname'];
                $lname=$row['lname'];
                $address=$row['address'];
                $phone_no=$row['phone_no'];
              }}
            ?>
            <div class="media">
              <div class="media-body">
                <h4><?php echo $fname; ?> <?php echo $lname; ?></h4>
                <span><?php echo $phone_no; ?></span>
                <span></br><?php echo $address; ?></span>
              </div>
            </div>
          </div>
          <div class="card-body bg-light">
              <a href="prepare-bill.php?id=<?php echo $id; ?>" class="btn btn-primary">
                  <i class="fa fa-list-ul mr-2"></i>Prepare Bill
              </a>
              <a href="edit-consumer.php?id=<?php echo $id; ?>" class="btn btn-outline-primary">
                  <i class="fa fa-edit mr-2"></i>Edit
              </a>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-lg-12">

          <div class="card mb-30">
              <div class="card-body pb-0">

                  <h5 class="card-title mb-3">Bills</h5>
                  <?php
                    $conn = new PDO('mysql:host=localhost;dbname=billingsystem', 'root', '');
                    $bills = $conn->query("select * from bill_details where user_id = '$id' order by date_from desc") or die(mysql_error());

                      if ($bills->rowCount() == 0)
                        {
                        echo "<div class='text-center mb-3'>There are no bills found.</div>";
                        }
                      else
                      {
                        $rows = $bills->fetchAll(PDO::FETCH_ASSOC);

                  ?>
              </div>
              <div class="table">
                <table class="table table-hover">
                  <thead class="thead">
                    <tr>
                      <th>Period Covered</th>
                      <th>Due Date</th>
                      <th>Previous Reading</th>
                      <th>Present Reading</th>
                      <th>Rate</th>
                      <th>Total Used</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($rows as $row => $bill) {
                        $usage[$row] = $bill['pres'] - $bill['prev'];
                    echo'
                    <tr>
                      <td>
                         '.date('M d, yy', strtotime($bill['date_from'])).' - '.date('M d, yy', strtotime($bill['date_to'])).'
                      </td>
                      <td>'.date('M d, yy', strtotime($bill['due_date'])).' </td>
                      <td>'.$bill['prev'].'</td>
                      <td>'.$bill['pres'].'</td>
                      <td>'.$bill['price'].'</td>
                      <td><strong>'.$usage[$row].'</strong></td>
                      <td>
                        <a href="view-bill.php?id='.$bill['id'].'" class="btn-sm btn-secondary">
                            View  Bill
                        </a>
                      </td>
                    </tr>';
                }?>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
          </div>
        </div>
    </div>
  </div>
</body>
</html>