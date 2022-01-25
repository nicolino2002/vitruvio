<?php

  include ('config.php');
  session_start();

  $file_names=  array(

                       'pef_comune_grezzo_2020',
                       'relazione_pef_comune_2020',
                       'pef_comune_grezzo_2021',
                       'relazione_pef_comune_2021',
                       'pef_comune_etc_2020',
                       'pef_comune_etc_2021',
                       'contratto_gestore',
                       'delibera_2021',

                      );

  $filename=$_REQUEST['file'];
  $town=$_REQUEST['town'];
  $index=$_REQUEST['i'];
  $report_id=$_SESSION['report_id'];

  echo $file_names[$index];
  $sql="UPDATE `invio` SET `$file_names[$index]`=NULL WHERE `report_id`=$report_id AND `valid`=1 AND `visible`=1";
  $db->query($sql);
  $db->close();



  $town_name=$_SESSION['login_town'];
  unlink('../uploads/'.$town_name.'-'.$town.'-'.$filename);
  //header("Location: https://mail.google.com/");



 ?>
