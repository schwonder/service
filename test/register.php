<?php
$link=mysqli_connect("localhost", "root", "celmz321") or die ('error1' . mysql_error ());
mysqli_select_db($link, "test") or die('error' . mysql_error());

$Email=$_GET['Email'];
$Password=$_GET['Password'];

$strSQL = "SELECT * FROM users  WHERE email = '$Email'";
$result=mysqli_query($link, $strSQL) or die('error2' .mysql_error());
$line = mysqli_fetch_array($result, MYSQL_ASSOC);

if ($line) {echo "This e-mail is already registered<br><a href='index.php'>log in</a>";}
else{


$strSQL = "INSERT INTO users(email, password) VALUES('$Email', '$Password')"; 
mysqli_query($link, $strSQL) or die('error3' .mysql_error());

echo "Registration successful<br><a href='index.php'>log in</a>";
  }


mysqli_close($link);
?>