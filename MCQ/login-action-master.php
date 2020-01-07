<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Mcq Test</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="action.js"></script>
</head>


<?php
include 'db_connection.php';
$conn = OpenCon();

$username=$_POST['uname']; 
$password=$_POST['psw']; 

// To protect MySQL injection (more detail about MySQL injection)
$sql="SELECT * FROM `master` WHERE USERNAME='$username' and PASSWORD='$password'";
$result=mysqli_query($conn,$sql);

// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);

// If result matched $username and $password, table row must be 1 row
if($count==1){
    $_SESSION['loggedinmaster'] = true;
    $_SESSION['usernamemaster'] = $username;
    $is_master = 1;
    echo "Connected Successfully";
    header('location: master-dashboard.php');
}
else {
    header('location: testm.php'); 
}

CloseCon($conn);
?>