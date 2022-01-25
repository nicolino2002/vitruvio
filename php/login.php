<?php
include("config.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
  // username and password sent from form

  $username = mysqli_real_escape_string($db,$_POST['username']);
  $password = mysqli_real_escape_string($db,$_POST['password']);
  //$hash = password_hash($password , PASSWORD_DEFAULT);

  $sql = "SELECT `id` FROM `users` WHERE `email` = '$username' AND `pwd` = '$password' AND `valid`=1 AND `visible`=1";
  //$sql = "SELECT `id` FROM `users` WHERE `email` = '$username' AND `pwd` = '$hash'";
  $result = mysqli_query($db,$sql);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  //print_r($row);
  $count = mysqli_num_rows($result);

  // If result matched $myusername and $mypassword, table row must be 1 row
  if($count == 1) {
    //session_register("username");
    $_SESSION['login_user'] = $username;
    $_SESSION['user_id'] = $row['id'];
    header("location: welcome.php");
  }else {
    $error = "User Name o Password Errati!";
	echo $error . '</BR></BR>';
	echo '<form><input type="button" value="Torna Indietro" onClick="javascript:history.go(-1)"></form>';
	//echo '<p><a href="javascript:history.go(-1)" title="Return to previous page">&laquo; Go back</a></p>';
	//header("location: ../index.html");
  }
}
?>
