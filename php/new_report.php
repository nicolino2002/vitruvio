<?php
   include('config.php');
   $id_user = mysqli_real_escape_string($db,$_POST['id_user']);
   $id_town = mysqli_real_escape_string($db,$_POST['id_town']);
   $fy = date('Y');

   $sql = "INSERT INTO `reports`(`fy`, `id_town`, `user_creator_id`) VALUES ($fy,$id_town,$id_user)";
   mysqli_query($db, $sql);
   $id_report = mysqli_insert_id($db);
   echo $db->error;


   $sql = "INSERT INTO `mtn`(`report_id`, `year`, `user_creator_id`) VALUES ($id_report,2019,$id_user)";
   mysqli_query($db, $sql);
   echo $db->error;

   //$current_year=date('Y');
   $sql = "INSERT INTO `mtr`(`report_id`, `year`, `user_creator_id`) VALUES ($id_report,2020,$id_user)";
   mysqli_query($db, $sql);
   echo $db->error;

   $sql = "INSERT INTO `mtr`(`report_id`, `year`, `user_creator_id`) VALUES ($id_report,2021,$id_user)";
   mysqli_query($db, $sql);
   echo $db->error;

   //$sql = "INSERT INTO `extra`(`report_id`, `user_creator_id`) VALUES ($id_report,$id_user)";
   //mysqli_query($db, $sql);
   $sql = "INSERT INTO `invio`(`report_id`, `user_creator_id`) VALUES ($id_report,$id_user)";
   mysqli_query($db, $sql);
   echo $db->error;

   //$sql = "INSERT INTO `input`(`report_id`, `user_creator_id`) VALUES ($id_report,$id_user)";
   //mysqli_query($db, $sql);
   /* close connection */
   mysqli_close($db);
   header("Location: ./welcome.php");
?>
