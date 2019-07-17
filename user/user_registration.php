<?php
  include 'dbconfig.php';
  $con = mysqli_connect($HostName, $DatabaseName, $HostUser, $HostPass);
  $json = file_get_contents('php://input');
  $obj = json_decode($json, true);
  $username = $obj['username'];
  $password = $obj['password'];
  $CheckSQL = "SELECT * FROM authentication WHERE username='$username'";
  $check = mysqli_fetch_array(mysqli_query($con,$CheckSQL));
  if (isset($check)) {
    $UnameExistMSG = 'username already exist, please try again';
    $UnameExistJson = json_encode($UnameExistMSG);
    echo $UnameExistJson;
  } else{
    $Sql_Query = "insert into authentication (username, password) values ($username, $password)";
    if (mysqli_query($con, $Sql_Query)) {
      $MSG = 'user regis successfully';
      $json = json_encode($MSG);
      echo $json;
    } else {
      echo "try again";
    }
  }
  mysqli_close($con);
?>
