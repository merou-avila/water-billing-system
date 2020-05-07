<?php
$conn = new PDO('mysql:host=localhost;dbname=billingsystem', 'root', '');
?>
<?php  include('../session.php') ;?>
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
                         <h5 style="font-size: 30px; font-weight: 300; margin-bottom: 0;">Hello, <?php echo $fullname;?></h5>
                         <div class="text-center">
                             <img src="../images/img-1.svg" class="mt-5" style="height: 350px; max-width: 100%;" />
                         </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <dic class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title" style="font-weight: 300;" >Bills</h5>
                        <?php
                            $conn = new PDO('mysql:host=localhost;dbname=billingsystem', 'root', '');
                            $bills = $conn->query("select * from bill_details where user_id = '$session_id' order by date_from desc") or die(mysql_error());

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
            </dic>
        </div>
    </div>
</body>
</html>
