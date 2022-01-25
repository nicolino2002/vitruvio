<?php
  include("config.php");
  //Connect to MySQL Server

  // Retrieve data from Query String
  $user = mysqli_real_escape_string($db,$_POST['user']);

  //build query
  $sql = "SELECT `u`.*, `role`, `title` FROM `users` `u` INNER JOIN `roles` `r` ON `u`.`role_id`=`r`.`id` INNER JOIN `titles` `t` ON `u`.`title_id`=`t`.`id` WHERE `u`.`id`= '$user';";
  if ($result = mysqli_query($db, $sql)) {
    while($row = mysqli_fetch_array($result)) {
      $id = $row['id'];
      $role_id = $row['role_id'];
      $title_id = $row['title_id'];
      $name = $row['name'];
      $surname = $row['surname'];
      $town_id = $row['town_id'];
      $tel = $row['tel'];
      $email = $row['email'];
      $mail2 = $row['mail2'];
      $pwd = $row['pwd'];
      $service = $row['service'];
      $privacy = $row['privacy'];
      $sent = $row['sent'];
      $ins_date = $row['ins_date'];
      $act_date = $row['act_date'];
      $del_date = $row['del_date'];
      $valid = $row['valid'];
      $visible = $row['visible'];
      $role = $row['role'];
      $title = $row['title'];
    }
  }

  $return_arr[] = array(
    "id" => $id,
    "role_id" => $role_id,
    "title_id" => $title_id,
    "name" => $name,
    "surname" => $surname,
    "town_id" => $town_id,
    "tel" => $tel,
    "email" => $email,
    "mail2" => $mail2,
    "pwd" => $pwd,
    "service" => $service,
    "privacy" => $privacy,
    "sent" => $sent,
    "ins_date" => $ins_date,
    "act_date" => $act_date,
    "del_date" => $del_date,
    "valid" => $valid,
    "visible" => $visible,
    "role" => $role,
    "title" => $title);

  // Encoding array in JSON format
  //print_r($return_arr);
  echo json_encode($return_arr);
  /* free result set */
  mysqli_free_result($result);
?>
