<?php
 if(isset($_POST["from_date"], $_POST["to_date"]))
 {
      $connect = mysqli_connect("localhost", "root", "", "billingsystem");
      $output = '';
      $query = "
           SELECT
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
                from bill_details JOIN users ON bill_details.user_id = users.id
           WHERE date_from BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'
      ";
      $result = mysqli_query($connect, $query);
      $output .= '
        <h3 class="text-center Printable">Monthly Reports</h3></br>
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
      ';
      if(mysqli_num_rows($result) > 0)
      {
           while($row = mysqli_fetch_array($result))
           {
                $name = $row['fname']." ".$row['lname'];
                $account_no = $row ['account_no'];
                $meter_no = $row['meter_no'];
                $prev = $row['prev'];
                $pres = $row['pres'];
                $price = $row['price'];
                $meter_maintenance = $row['meter_maintenance'];
                $usage = $pres -$prev;
                $total = $price * $usage;
                $from = $row['date_from'];
                $to = $row['date_to'];
                $due = $row['due_date'];
                $date_from = date('Y-m-d', strtotime($from));
                $date_to = date( 'm/d /y', strtotime($to));
                $duedate = date( 'm/d /y', strtotime($due));
                $alltotal = $total + $meter_maintenance;
                $output .= '
                    <tr>
                        <td class="account_no">'. $account_no .'</td>
                        <td>'. $meter_no.'</td>
                        <td>'. $name.'</td>
                        <td>'. $prev.'</td>
                        <td>'. $pres.'</td>
                        <td style="color: red">'. $price.'</td>
                        <td>'. $usage.'</td>
                        <td>'. $alltotal.'</td>
                        <td>'. $date_from.'</td>
                     </tr>
                ';
           }
      }
      else
      {
           $output .= '
                <tr>
                     <td colspan="9" class="text-center">No Order Found</td>
                </tr>
           ';
      }
      $output .= '</table>';
      echo $output;
 }
 ?>