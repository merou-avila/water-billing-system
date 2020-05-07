<?php
$conn = new PDO('mysql:host=localhost;dbname=billingsystem', 'root', '');
?>
<?php  include('../session.php') ;
  $id=$_REQUEST['id'];
  $bill = $conn->query("select
    bill_details.user_id,
    bill_details.prev,
    bill_details.pres,
    bill_details.price,
    bill_details.meter_maintenance,
    bill_details.penalty,
    bill_details.date_from,
    bill_details.date_to,
    bill_details.due_date,
    users.id,
    users.account_no,
    users.fname,
    users.lname,
    users.address,
    users.meter_no,
    users.image
    from bill_details JOIN users ON bill_details.user_id = users.id WHERE bill_details.id = '$id'") or die(msql_error());
    while ($r = $bill->fetch()) {{
    $name = $r['fname']." ".$r['lname'];
    $address = $r ['address'];
    $account_no = $r ['account_no'];
    $meter_no = $r['meter_no'];
    $prev = $r['prev'];
    $pres = $r['pres'];
    $price = $r['price'];
    $meter_maintenance = $r['meter_maintenance'];
    $penalty = $r['penalty'];
    $usage = $pres -$prev;
    $total = $price * $usage;
    $from = $r['date_from'];
    $to = $r['date_to'];
    $due = $r['due_date'];
    $date_from = date('m/d/y', strtotime($from));
    $date_to = date( 'm/d/y', strtotime($to));
    $date = date( 'F Y', strtotime($from));
    $duedate = date( 'm/d/Y ', strtotime($due));
    $alltotal = $total + $meter_maintenance;
    $afterdue = $alltotal + $penalty;
    $image = $r['image'];
  }}
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
    <script>
     function printBill() {
        //Get the print button and put it into a variable
        var printButton = document.getElementById("btnprint");
        //Set the print button visibility to 'hidden'
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print()
        printButton.style.visibility = 'visible';
    }
    </script>
</head>
<body>
<div class="container">
    <section>
        <div class="row">
            <div class="col"></div>
            <div class="col-lg-4 mb-3">
                <div class="details mt-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                               <div class="col"></div>
                               <div class="d-flex mt-4 mt-md-0 text-center">
                                    <div>
                                        <img src="../images/logosample.png" class="img-fluid" style="width: 20%" alt="">
                                        <p class="mb-0"> Republic of the Philippines</p>
                                        <p class="mb-0"> <strong>BANSALAN WATER DISTRICT</strong></p>
                                        <p class="mb-0"> Camia St., Pob-1, Bansalan, Davao del Sur</p>
                                        <p>TEL NO: (082) 553 9228; 09282086804</p>
                                        <p class="mb-0">WATER BILL</p>
                                        <p class="mb-0">Month of <?php echo $date;?> </p>
                                        <p class="mb-0"><strong><?php echo $name;?> </strong></p>
                                    </div>
                                </div>
                               <div class="col"></div>
                            </div>
                            <div class="row">
                                <div class="col mt-3">
                                    <p class="mb-0" style="font-size: 16px">Account #: <?php echo $account_no;?></p>
                                    <p class="mb-0" style="font-size: 16px">Service Address: <?php echo $address;?></p>
                                    <p class="mb-0" style="font-size: 16px">Meter #: <?php echo $meter_no;?></p>
                                </div>
                            </div>
                            ------------------------------------------------
                            <div class="row">
                                 <div class="col">
                                    <p class="mb-0" style="font-size: 16px">Due Date:</p>
                                    <p class="mb-0" style="font-size: 16px">Period From:</p>
                                    <p class="mb-0" style="font-size: 16px">Period To:</p>
                                </div>
                                 <div class="col">
                                    <p class="mb-0" style="font-size: 16px"><?php echo $duedate;?></p>
                                    <p class="mb-0" style="font-size: 16px"><?php echo $date_from;?></p>
                                    <p class="mb-0" style="font-size: 16px"><?php echo $date_to;?></p>
                                </div>
                            </div>
                             ------------------------------------------------
                            <div class="row">
                                 <div class="col">
                                    <p class="mb-0" style="font-size: 16px">Present Reading:</p>
                                    <p class="mb-0" style="font-size: 16px">Previous Reading</p>
                                    <p class="mb-0" style="font-size: 16px">Consumption:</p>
                                </div>
                                 <div class="col">
                                    <p class="mb-0" style="font-size: 16px"><?php echo $pres;?></p>
                                    <p class="mb-0" style="font-size: 16px"><?php echo $prev;?></p>
                                    <p class="mb-0" style="font-size: 16px"><?php echo $usage;?></p>
                                </div>
                            </div>
                            ------------------------------------------------
                            <div class="row">
                                 <div class="col">
                                    <p class="mb-0" style="font-size: 16px">Bill Amount:</p>
                                    <p class="mb-0" style="font-size: 16px">Mtr Maintenance:</p>
                                </div>
                                 <div class="col">
                                    <p class="mb-0" style="font-size: 16px"><?php echo $total;?></p>
                                    <p class="mb-0" style="font-size: 16px"><?php echo $meter_maintenance;?></p>
                                </div>
                            </div>
                            ------------------------------------------------
                            <div class="row">
                                 <div class="col">
                                    <p class="mb-0" style="font-size: 16px"><strong>TOTAL AMOUNT:</strong></p>
                                    <p class="mb-0" style="font-size: 16px">PENALTY AFTER DUE:</p>
                                    <p class="mb-0" style="font-size: 16px">TOTAL AFTER DUE:</p>
                                </div>
                                 <div class="col">
                                    <p class="mb-0" style="font-size: 16px"><strong><?php echo $alltotal;?></strong></p>
                                    <p class="mb-0" style="font-size: 16px"></p><br>
                                    <p class="mb-0" style="font-size: 16px"><?php echo $penalty;?></p>
                                    <p class="mb-0" style="font-size: 16px"></p>
                                    <p class="mb-0" style="font-size: 16px"><?php echo $afterdue;?></p>
                                </div>
                            </div>
                            ------------------------------------------------
                            <div class="row mb-3">
                                 <div class="col">
                                    <p class="mb-0" style="font-size: 16px">Remarks: Normal Reading</p>
                                    <p class="mb-0" style="font-size: 16px">Receive by: MR2</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <strong>IMPORTANT:</strong>
                                    <p style="font-size: 14px;">
                                        Please bring this bill when paying at BWD office. A 10% surcharge shall be added to your bill if not paid on or before the due dat. In case of disconnection, additional charges will be required to re established service.
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    <?php echo'
                                      <img src="data:image/jpeg;base64,'.base64_encode($image).'" style="width:75%">
                                      '?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary mt-3 float-right" onclick="printBill()" id="btnprint">Print</button>
            </div>
            <div class="col"></div>
        </div>
    </section>
</div>
</body>
</html>