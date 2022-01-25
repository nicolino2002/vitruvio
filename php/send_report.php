<?php
   include('config.php');
   $id_user = mysqli_real_escape_string($db,$_POST['id_user']);
   $id_report = mysqli_real_escape_string($db,$_POST['id_report']);
   $fy = date('Y');

   $sql="SELECT `sent_times` FROM `reports` WHERE `id`=$id_report AND `valid`=1 AND `visible`=1;";
   $res = $db->query($sql);
   $row = $res->fetch_assoc();
   $sent_times=$row['sent_times'];
   echo "<br>";

   echo $db->error;
   if ($sent_times<5) {
     // code...
     $sent_times++;
     echo $sent_times;

   // Update Report Status
   $sql = "UPDATE `reports` SET `id_status`=3,`sent_times`=$sent_times,`last_modified_id`=$id_user,`last_modified_date`=now() WHERE `id`=$id_report";
   mysqli_query($db, $sql);

  // Send mail to all active users + assistenza
  // Get town_id and town
  $sql = "SELECT `r`.`id_town`, `t`.`town` FROM `reports` `r` INNER JOIN `towns` `t` ON `r`.`id_town`=`t`.`id` WHERE `r`.`id`=$id_report";
  if ($result = mysqli_query($db, $sql)) {
    while($row = mysqli_fetch_array($result)) {
      $town_id = $row['id_town'];
      $town = $row['town'];
    }
  }
  // Get user who sent report
  $sql = "SELECT `email` FROM `users` WHERE `del`=0 AND `valid`=1 AND `visible`=1 AND `id`= '$id_user';";
  if ($result = mysqli_query($db, $sql)) {
    while($row = mysqli_fetch_array($result)) {
      $user = $row['email'];
    }
  }
  $sql = "SELECT `email` FROM `users` WHERE `del`=0 AND `valid`=1 AND `visible`=1 AND `town_id`= '$town_id';";
  if ($result = mysqli_query($db, $sql)) {
    // Get DateTime String
    $currtime   = new DateTime(); //this returns the current date time
    $timestr = $currtime->format('d/m/Y H:i:s');  // Active Users for town town_id
    //Build To Array
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_array($result)) {
       $accounts[] = $row['email'];
      }
      $to = implode(", ", $accounts);
    }
    // Confirm Mail Send
    $url = 'https://www.bintobit.com/infowaste/test/php/mail.php';
    $postdata = http_build_query(
      array(
        'subject' => 'Inviato Report del Comune di '.$town.'.',
        'to' => $to,
        'cc' => 'assistenza@bintobit.com',
        'message' => 'Si conferma in data '.$timestr.', l\'invio del report relativo al Comune di '.$town.', da parte del seguente account: '.$user.'.'
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
    //echo '<script>alert("Si conferma in data '.$timestr.', l\'invio del report relativo al Comune di '.$town.', da parte del seguente account: '.$user.'.");</script>';
    //echo '<script>window.history.go(-1);</script>';
    //header("location: ../index.html");
  } else {
    /* Query Error */
    //echo '<script>alert("Si e` verificato un errore durante l\'invio della mail di conferma.");</script>';
    //echo '<script>window.history.go(-1);</script>';
  }
}else {
  echo "<h3>Hai raggiunto il limite di invio del report</h3>";
}

   /* close connection */
   mysqli_close($db);
   header("Location: ./welcome.php");
?>
