<?php
//Start session
 session_start();
//Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['id']) || ($_SESSION['id'] == '')) { ?>
    <script>
     window.location = 'index.php';
    </script>
<?php
    exit();
}

$session_id=$_SESSION['id'];
date_default_timezone_set('Asia/Manila');
$query = $conn->query("select * from client_users where id = '$session_id'");
$row = $query->fetch();
$fullname = $row['lname']." ,".$row['fname'] ;

?>