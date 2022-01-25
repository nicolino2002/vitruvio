<?php
  include("config.php");
  //Connect to MySQL Server

  // Retrieve data from Query String
  $town = mysqli_real_escape_string($db,$_POST['new_town']);
  $account = mysqli_real_escape_string($db,$_POST['new_user']);
  $name = mysqli_real_escape_string($db,$_POST['new_name']);
  $surname = mysqli_real_escape_string($db,$_POST['new_surname']);
  $tel = mysqli_real_escape_string($db,$_POST['new_tel']);
  $role = mysqli_real_escape_string($db,$_POST['new_role']);
  $title = mysqli_real_escape_string($db,$_POST['title']);
  $pwd = mysqli_real_escape_string($db,$_POST['new_pwd']);
  $mail2 = mysqli_real_escape_string($db,$_POST['new_mail2']);
  $receipt = mysqli_real_escape_string($db,$_POST['new_receipt']);

  // Get town_id
  $sql = "SELECT `id` FROM `towns` WHERE `valid`=1 AND `visible`=1 AND `town`= '$town';";
  if ($result = mysqli_query($db, $sql)) {
    while($row = mysqli_fetch_array($result)) {
      $town_id = $row['id'];
    }
  }
  // Active Users for town town_id
  $sql = "SELECT count(`id`) `users` FROM `users` WHERE `del`=0 AND `valid`=1 AND `visible`=1 AND `town_id`= '$town_id';";
  if ($result = mysqli_query($db, $sql)) {
    while($row = mysqli_fetch_array($result)) {
       $users = $row['users'];
      if($users>=5){ // MAX NUMBER of USER per Town!!!
        echo '<script>alert("Ci sono gia` '.$users.' account attivi sul comune di '.$town.'");</script>';
        //echo '<script>window.history.go(-1);</script>'; 
      } else {
        //build query
        $sql="INSERT INTO `users`(`role_id`,`title_id`, `name`, `surname`, `town_id`, `tel`, `email`, `mail2`, `pwd`,`ins_date`, `act_date`,`valid`) VALUES (".$role.",".$title.",'".$name."','".$surname."',".$town_id.",'".$tel."','".$account."','".$mail2."','".$pwd."',now(),now(),1)";
        // $receipt => Send Mail php function
        if ($result = mysqli_query($db, $sql)) {
          if ($receipt == '1') {
            // Confirm Mail Send
            $url = 'https://www.bintobit.com/infowaste/test/php/mail.php';
            $postdata = http_build_query(
              array(
                'subject' => 'Conferma Creazione Account '.$account.'.',
                'to' => $account,
                'cc' => 'assistenza@bintobit.com',
                'message' => 'Il tuo account '.$account.' e` stato creato sul Comune di '.$town.'.'
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
          echo '<script>alert("Creato Account '.$account.' sul Comune di '.$town.'.");</script>';
          //echo '<script>window.history.go(-1);</script>';
          //header("location: ../index.html");
        } else {
          /* Query Error */
          echo '<script>alert("Si e` verificato un errore durante la creazione dell\'Account '.$account.' attivo sul comune di '.$town.'");</script>';
          //echo '<script>window.history.go(-1);</script>';
          }
        }
    }
  }
echo '<script>window.history.go(-1);</script>'; 


  /* free result set */
  //mysqli_free_result($result);
?>