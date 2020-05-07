<!DOCTYPE html>
 <html>
      <head>
          <title>Admin-Water Billing System</title>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <meta http-equiv="X-UA-Compatible" content="ie=edge">
          <link rel="stylesheet" href="css/bootstrap.css">
          <link rel="stylesheet" href="css/style.css">
          <link rel="stylesheet" href="css/font-awesome.css">
          <link rel="stylesheet" href="css/font-awesome.min.css">
          <script src="js/jquery.min.js"></script>
          <script src="js/jquery-ui.js"></script>
          <link rel="stylesheet" href="css/jquery-ui.css">
          <script>
           function printBill() {
              //Get the print button and put it into a variable
              var printButton = document.getElementById("print");
              //Set the print button visibility to 'hidden'
              printButton.style.visibility = 'hidden';
              //Print the page content
              window.print()
              printButton.style.visibility = 'visible';
          }
          </script>
          <style type="text/css" media="print">
            .NonPrintable
            {
              display: none;
            }
          </style>
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
          <ul class="nav nav-pills mb-3" id="print">
              <li class="nav-item">
                <a class="nav-link" href="admin.php"><i class="fa fa-home mr-2"></i>Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="consumers.php"><i class="fa fa-users mr-2" aria-hidden="true"></i>Consumers</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="announcements.php"><i class="fa fa-bell mr-2" aria-hidden="true"></i>Announcements</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="monthly-reports.php"><i class="fa fa-list-alt mr-2" aria-hidden="true"></i>Monthy Reports</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="settings.php"><i class="fa fa-cog mr-2" aria-hidden="true"></i>Settings</a>
              </li>
          </ul>
      </div>
           <div class="container">
                <p class="ml-3 mb-3 NonPrintable">Select date range to filter records</p>
                <div class ="row ml-1">
                <div class="col-md-3 NonPrintable">
                     <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />
                </div>
                <div class="col-md-3 NonPrintable">
                     <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />
                </div>
                <div class="col-md-5 NonPrintable">
                     <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />
                     <button class="btn btn-primary" onclick="printBill()" id="print">Print</button>
                </div></div>
                <div style="clear:both"></div>
                <br />
                <div id="order_table">
                    <h3 class="text-center Printable">Monthly Bill Reports</h3></br>
                     <table class="table table-bordered ml-3">
                          <tr>
                            <th>Account #</th>
                            <th>Meter #</th>
                            <th>Name</th>
                            <th>Previous</th>
                            <th>Present</th>
                            <th>Price</th>
                            <th>Usage</th>
                            <th>Total</th>
                            <th>Date</th>
                          </tr>
                  <?php
                  $conn = new PDO('mysql:host=localhost;dbname=billingsystem', 'root', '');
                  $bill = $conn->query("select
                    bill_details.user_id,
                    bill_details.prev,
                    bill_details.pres,
                    bill_details.price,
                    bill_details.meter_maintenance,
                    bill_details.date_from,
                    bill_details.date_to,
                    bill_details.due_date,
                    users.account_no,
                    users.fname,
                    users.lname,
                    users.meter_no
                    from bill_details JOIN users ON bill_details.user_id = users.id") or die(msql_error());
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
                    $date_from = date('Y-m-d', strtotime($from));
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
              <td><?php echo $date_from; ?></td>


           <?php } ?>
            </tr>
                       </table>
                  </div>
             </div>
      </body>
 </html>
 <script>
      $(document).ready(function(){
           $.datepicker.setDefaults({
                dateFormat: 'yy-mm-dd'
           });
           $(function(){
                $("#from_date").datepicker();
                $("#to_date").datepicker();
           });
           $('#filter').click(function(){
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if(from_date != '' && to_date != '')
                {
                     $.ajax({
                          url:"filter-date.php",
                          method:"POST",
                          data:{from_date:from_date, to_date:to_date},
                          success:function(data)
                          {
                               $('#order_table').html(data);
                          }
                     });
                }
                else
                {
                     alert("Please Select Date");
                }
           });
      });
 </script>