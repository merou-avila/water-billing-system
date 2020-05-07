<?php
$conn = new PDO('mysql:host=localhost;dbname=billingsystem', 'root', '');
?>
<?php  include('session.php') ;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/main.css">
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
            <a class="nav-link active" href="admin.php"><i class="fa fa-home mr-2"></i>Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="consumers.php"><i class="fa fa-users mr-2" aria-hidden="true"></i>Consumers</a>
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
  <p class="mt-3 mb-3">Welcome <strong><?php echo $fullname;?></strong> to Water Billing System!</p>
  </div>
  <div class="container">
      <div class="bg-white pd-20 box-shadow border-radius-5 mb-30">
        <h4 class="mb-30">Total Summary of Water Consumption (Cubic feet per second)</h4>
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12 xs-mb-20">
            <div id="areaspline-chart" style="min-width: 210px; height: 400px; margin: 0 auto"></div>
          </div>
        </div>
      </div>
  </div>
</body>
</html>
<script src="plugins/highcharts-6.0.7/code/highcharts.js"></script>
  <script src="plugins/highcharts-6.0.7/code/highcharts-more.js"></script>
  <script type="text/javascript">
    Highcharts.chart('areaspline-chart', {
      chart: {
        type: 'areaspline'
      },
      title: {
        text: ''
      },
      legend: {
        layout: 'vertical',
        align: 'left',
        verticalAlign: 'top',
        x: 100,
        y: 20,
        floating: true,
        borderWidth: 1,
        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
      },
      xAxis: {
        categories: [
          'Jan',
          'Feb',
          'March',
          'April',
          'May',
          'June',
          'July',
          'August',
          'Sept',
          'Oct',
          'Nov',
          'Dec'
        ],
        plotBands: [{
          from: 4.5,
          to: 6.5,
        }],
        gridLineDashStyle: 'longdash',
                gridLineWidth: 1,
                crosshair: true
      },
      yAxis: {
        title: {
          text: ''
        },
        gridLineDashStyle: 'longdash',
      },
      tooltip: {
        shared: true,
        valueSuffix: ' cfs'
      },
      credits: {
        enabled: false
      },
      plotOptions: {
        areaspline: {
          fillOpacity: 0.6
        }
      },
      series: [ {
        name: 'Year 2019',
        data: [457, 3380, 5186, 6809, 4560, 2300, 1234, 5716, 4410, 1260, 4617, 3004],
        color: '#41ccba'
      }]
    });

  </script>