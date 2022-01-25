<?php
  include("config.php");
  //Connect to MySQL Server

  // Retrieve data from Query String
  $user = mysqli_real_escape_string($db,$_POST['del_users']);
  $receipt = mysqli_real_escape_string($db,$_POST['del_receipt']);


  // Get user
  $sql = "SELECT `email`,`town_id` FROM `users` WHERE `id`= '$user';";
  echo $sql;
  if ($result = mysqli_query($db, $sql)) {
    while($row = mysqli_fetch_array($result)) {
      $account = $row['email'];
      $town_id = $row['town_id'];
    }
  }
  // Get town
  $sql = "SELECT `town` FROM `towns` WHERE `valid`=1 AND `visible`=1 AND `id`= '$town_id';";
  if ($result = mysqli_query($db, $sql)) {
    while($row = mysqli_fetch_array($result)) {
      $town = $row['town'];
    }
  }


  //build query
  $sql = "UPDATE `users` SET `del`=1,`valid`=0 WHERE `id`= '$user';";
  if ($result = mysqli_query($db, $sql)) {
    echo '<script>alert("Cancellato Account '.$account.' sul Comune di '.$town.'.");</script>';
    //echo '<script>window.history.go(-1);</script>';
    // $receipt => Send Mail php function
      if ($receipt == 1) {
        // Confirm Mail Send
        $url = 'https://www.bintobit.com/infowaste/test/php/mail.php';
        $postdata = http_build_query(
          array(
            'subject' => 'Conferma Disattivazione Account '.$account.'.',
            'to' => $account,
            'cc' => 'assistenza@bintobit.com',
            'message' => 'Il tuo account '.$account.' e` stato disattivato sul Comune di '.$town.'.'
          )
        );
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context  = stream_context_create($opts);
        $result = file_get_contents($url, false, $context);
      }
    }else{
     echo '<script>alert("Si e` verificato un errore durante la cancellazione dell\'Account '.$name.' attivo sul comune di '.$town.'");</script>';
     //echo '<script>window.history.go(-1);</script>';
    }
    //echo '<script>window.history.go(-1);</script>';
  /* free result set */
  //mysqli_free_result($result);
  echo '<script>window.history.go(-1);</script>';


?>
