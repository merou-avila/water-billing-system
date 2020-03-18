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
    <title>Water Billing System</title>
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
            <a class="nav-link" href="clients.php"><i class="fa fa-users mr-2" aria-hidden="true"></i>Clients</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="create-bill.php"><i class="fa fa-sticky-note-o mr-2" aria-hidden="true"></i>Create Bill</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="view-records.php"><i class="fa fa-list-ul mr-2" aria-hidden="true"></i>View Records</a>
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
        <div class="col-12 mt-3">
            <div class="d-inline-flex">
              <h3>View Records</h3>
            </div>
            <div class="d-inline-flex float-right">
              <input class="form-control search-input ml-3" type="search" placeholder="Search"  data-table= "bill-list">
            </div>
        </div>
        <table class="table mt-3 ml-3 bill-list" id="searchtable">

            <thead class="thead-light">
              <tr>
                <th scope="col">Account #</th>
                <th scope="col">Meter #</th>
                <th scope="col">Name</th>
                <th scope="col">Previous</th>
                <th scope="col">Present</th>
                <th scope="col">Rate</th>
                <th scope="col">Usage</th>
                <th scope="col">Total</th>
                <th scope="col">Period Covered</th>
                <th scope="col">Due Date</th>
              </tr>
            </thead>

          <?php
              $conn = new PDO('mysql:host=localhost;dbname=waterbill', 'root', '');
              $bill = $conn->query("select
                bill_details.account_no,
                bill_details.prev,
                bill_details.pres,
                bill_details.price,
                bill_details.meter_maintenance,
                bill_details.date_from,
                bill_details.date_to,
                bill_details.due_date,
                client_users.fname,
                client_users.lname,
                client_users.meter_no
                from bill_details JOIN client_users ON bill_details.account_no = client_users.account_no") or die(msql_error());
                while ($r = $bill->fetch()) {{
                $name = $r['fname']." ".$r['lname'];
                $account_no = $r ['account_no'];
                $meter_no = $r['meter_no'];
                $prev = $r['prev'];
                $pres = $r['pres'];
                $price = $r['price'];
                $meter_maintenance = $r['meter_maintenance'];
                $usage = $pres -$prev;
                $total = $price * $usage;
                $from = $r['date_from'];
                $to = $r['date_to'];
                $due = $r['due_date'];
                $date_from = date('m/d /y', strtotime($from));
                $date_to = date( 'm/d /y', strtotime($to));
                $duedate = date( 'm/d /y', strtotime($due));
                $alltotal = $total + $meter_maintenance;
              }
           ?>
        <tbody>
          <tr>
            <td class="account-no"><?php echo $account_no; ?></td>
            <td><?php echo $meter_no; ?></td>
            <td><?php echo $name; ?></td>
            <td><?php echo $prev; ?></td>
            <td><?php echo $pres; ?></td>
            <td><?php echo $price; ?></td>
            <td><?php echo $usage; ?></td>
            <td style="color: red">P <?php echo $alltotal; ?></td>
            <td><?php echo $date_from; ?> - <?php echo $date_to;?></td>
            <td><?php echo $duedate; ?></td>


         <?php } ?>
          </tr>
        </tbody>
        </table>
    </div>
</body>
</html>
<script>
        (function(document) {
            'use strict';

            var TableFilter = (function(myArray) {
                var search_input;

                function _onInputSearch(e) {
                    search_input = e.target;
                    var tables = document.getElementsByClassName(search_input.getAttribute('data-table'));
                    myArray.forEach.call(tables, function(table) {
                        myArray.forEach.call(table.tBodies, function(tbody) {
                            myArray.forEach.call(tbody.rows, function(row) {
                                var text_content = row.textContent.toLowerCase();
                                var search_val = search_input.value.toLowerCase();
                                row.style.display = text_content.indexOf(search_val) > -1 ? '' : 'none';
                            });
                        });
                    });
                }

                return {
                    init: function() {
                        var inputs = document.getElementsByClassName('search-input');
                        myArray.forEach.call(inputs, function(input) {
                            input.oninput = _onInputSearch;
                        });
                    }
                };
            })(Array.prototype);

            document.addEventListener('readystatechange', function() {
                if (document.readyState === 'complete') {
                    TableFilter.init();
                }
            });

        })(document);
    </script>