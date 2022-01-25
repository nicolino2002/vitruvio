<?php
   session_start();
   include('config.php');

   $user_check = $_SESSION['login_user'];

   $sql = "
        SELECT CONCAT(`u`.`name` , ', ' , `u`.`surname`) `username`
        , `u`.`email` `account`
        , `r`.`role`
        , `t`.`title`
        , `c`.`town`
        , `u`.`id` `user_id`
        , `c`.`id` `town_id`
        , case when isnull(`n`.`id`)=1 then 1 else 0 end as `new_report`
        ,`s`.`status`
        , `n`.`id` `report_id`
        , `n`.`id_status` `status_id`
        , `mtn`.`id` `mtn_id`
        , `mtr`.`id` `mtr_id`
        , `invio2020`.`id` `invio_id`
        , case when (`mtn`.`completed`=0 or isnull(`mtn`.`id`)=1) then 'red' else 'green' end as `mtn`
        , case when (`mtr`.`completed`=0 or isnull(`mtr`.`id`)=1) then 'red' else 'green' end as `mtr`
        , case when (`invio2020`.`completed`=0 or isnull(`invio2020`.`id`)=1)  then 'red' else 'green' end as `invio`
      FROM `users` `u`
        INNER JOIN `titles` `t` ON `u`.`title_id`=`t`.`id`
        INNER JOIN `roles` `r` ON `u`.`role_id`=`r`.`id`
        INNER JOIN `towns` `c` ON `u`.`town_id`=`c`.`id`
        LEFT JOIN (SELECT `id`,`id_status`,`id_town` FROM `reports` WHERE `fy`=year(now()) AND `valid`=1 AND `visible`=1) `n` ON `c`.`id`=`n`.`id_town`
        LEFT JOIN `status` `s` ON `n`.`id_status`=`s`.`id`
        LEFT JOIN `mtn` `mtn` ON `n`.`id`=`mtn`.`report_id`
        LEFT JOIN `mtr` `mtr` ON `n`.`id`=`mtr`.`report_id`
        LEFT JOIN (SELECT `id`, `report_id`, `completed` FROM `mtr` WHERE `year`=2020) `mtr2018` ON `n`.`id`=`mtr2018`.`report_id`
        LEFT JOIN (SELECT `id`, `report_id`, `completed` FROM `mtr` WHERE `year`=2021) `mtr2019` ON `n`.`id`=`mtr2019`.`report_id`
        LEFT JOIN (SELECT `id`, `report_id`, `completed` FROM `invio`) `invio2020` ON `n`.`id`=`invio2020`.`report_id`

      WHERE `u`.`email` = '$user_check'
        AND `u`.`valid`=1
        AND `u`.`visible`=1
      ";


   $ses_sql = mysqli_query($db,$sql);

   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $login_name = $row['username']; // (e.g. Giuseppe De Palo)
   $login_user = $row['account']; /* (e.g. gdepalo@gmail.com)*/$_SESSION['account']=$login_user;
   $login_role = $row['role']; /* (e.g. Normal User)*/         $_SESSION['role']=$login_role;
   $login_title = $row['title']; // (e.g. Consultant)
   $login_town = $row['town']; /* (e.g. Bari)*/                $_SESSION['login_town']=$login_town;
   $user_id = $row['user_id']; // (number)
   $town_id = $row['town_id']; /* (number)*/                   $_SESSION['town_id']=$town_id;
   $new_report = $row['new_report']; // 1=New Report Needed (Button enabled, MTN/MTR/ETC DISABLED) else 0
   //echo "NEW REPORT ".$new_report;
   $status = $row['status']; /* (text)*/                       $_SESSION['status']=$status;
   //echo "STATUS ".$status;
   $report_id = $row['report_id']; /* (number)*/$_SESSION['report_id']=$report_id;

   $status_id = $row['status_id']; /* (number)*/$_SESSION['status_id']=$status_id;
   //echo "STATUS ID:".$status_id;
   $mtn_id = $row['mtn_id'];//echo $mtn_id;//(number)
   $mtr_id = $row['mtr_id'];//echo $mtr_id; // (number)
   $invio_id = $row['invio_id']; // (number)

   $mtn = $row['mtn'];
   $mtr = $row['mtr'];


   if ($report_id) {

    $sql = "SELECT `id` FROM `input` WHERE `year`=2020 AND `report_id`=$report_id  AND `visible`=1 AND `valid`=1 ";
    //$sql = "SELECT A.*, B.`valid`,B.`visible`, B.`year` FROM `users` A, `input` B
    //WHERE (A.`id` = B.`user_creator_id` || A.`id` = B.`last_modified_id`) AND B.`year`=2020 AND B.`visible`=1 AND B.`valid`=1;";
    $result = $db->query($sql);
    $input2020=$result -> num_rows;
    $input2020=assign_color($input2020);

  /*  $sql = "SELECT `id` FROM `input` WHERE `year`=2021 AND `report_id`=$report_id  AND `visible`=1 AND `valid`=1 ";
    //$sql = "SELECT A.*, B.`valid`,B.`visible`, B.`year` FROM `users` A, `input` B
    //WHERE (A.`id` = B.`user_creator_id` || A.`id` = B.`last_modified_id`) AND B.`year`=2021 AND B.`visible`=1 AND B.`valid`=1;";
    $result = $db->query($sql);
    $input2021=$result -> num_rows;
    $input2021=assign_color($input2021);*/



      $sql = "SELECT * FROM `invio` WHERE `report_id`=$report_id
       AND `valid`=1 AND `visible`=1 AND `pef_comune_grezzo_2020`<> 'NULL'
       AND `relazione_pef_comune_2020`<> 'NULL' AND `pef_comune_grezzo_2021`<> 'NULL' AND `relazione_pef_comune_2021`<> 'NULL'
        AND `pef_comune_etc_2020`<> 'NULL' AND `pef_comune_etc_2021`<> 'NULL' AND `contratto_gestore`<> 'NULL'
        AND `delibera_2021`<> 'NULL' AND `visible`=1 AND `valid`=1;";
    $result = $db->query($sql);
    $invio=$result -> num_rows;
    $invio=assign_color($invio);

    $sql = "SELECT `id` FROM `extra` WHERE  `report_id`=$report_id  AND `visible`=1 AND `valid`=1 ";
    $result = $db->query($sql);
    $extra=$result -> num_rows;
    $extra=assign_color($extra);

    }


        function assign_color($n){
            if ($n>=1){
              return "green";
            }
            else {
              return "red";
            }
          }


   if(!isset($_SESSION['login_user'])){
      die();
   }
?>
