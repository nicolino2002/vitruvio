<?php
  include("config.php");
  //Connect to MySQL Server

  // Retrieve data from Query String
  $user = mysqli_real_escape_string($db,$_POST['aut_users']);
  $role = mysqli_real_escape_string($db,$_POST['aut_role']);
  $receipt = mysqli_real_escape_string($db,$_POST['aut_receipt']);

  // Get account
  $sql = "SELECT `email`,`town_id` FROM `users` WHERE `id`= '$user';";
  if ($result = mysqli_query($db, $sql)) {
    while($row = mysqli_fetch_array($result)) {
      $account = $row['email'];
      $town_id = $row['town_id'];
    }
  }
  // Get town_id
  $sql = "SELECT `town`,`id` FROM `towns` WHERE `valid`=1 AND `visible`=1 AND `id`= '$town_id';";
  if ($result = mysqli_query($db, $sql)) {
    while($row = mysqli_fetch_array($result)) {
      $town = $row['town'];
  

    }
  }
  // Active Users for town town_id
  $sql = "SELECT count(`id`) `users` FROM `users` WHERE `del`=0 AND `valid`=1 AND `visible`=1 AND `town_id`= '$town_id';";
  if ($result = mysqli_query($db, $sql)) {
    while($row = mysqli_fetch_array($result)) {
       $users = $row['users'];
      if($users>=5){ // MAX NUMBER of USER per Town!!!
        echo '<script>alert("Ci sono gia` '.$users.' account attivi sul comune di '.$town.'"); window.history.go(-1);</script>';
      } else {
        //build query
        $sql = "UPDATE `users` SET `act_date`=now(),`valid`=1 WHERE `id`= '$user';";
        // $receipt => Send Mail php function
        if ($result = mysqli_query($db, $sql)) {
          echo '<script>alert("Account '.$account.' attivato sul comune di '.$town.'");</script>';
          //echo '<script>window.history.go(-1);</script>';
         if ($receipt == '1') {
           // Confirm Mail Send
           $url = 'https://www.bintobit.com/infowaste/test/php/mail.php';
           $postdata = http_build_query(
             array(
               'subject' => 'Conferma Attivazione Account '.$account.'.',
               'to' => $account,
               'cc' => 'assistenza@bintobit.com',
               'message' => 'Il tuo account '.$account.' e` stato attivato sul Comune di '.$town.'.'
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
       } else {
         /* Query Error */
         echo '<script>alert("Si e` verificato un errore durante la creazione dell\'Account '.$name.' attivo sul comune di '.$town.'");</script>';
         //echo '<script>window.history.go(-1);</script>';
       }
     }
    }
  }
  echo '<script>window.history.go(-1);</script>';

  header('Location: ' . $_SERVER['HTTP_REFERER']);

  /* free result set */
  //mysqli_free_result($result);
?>
