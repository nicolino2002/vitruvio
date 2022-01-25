<?php
          include('config.php');
          // Retrieve data from html
          $report_id = trim($_POST['report_id']);
          $user_id = trim($_POST['user_id']);
          $mtr_id = trim($_POST['mtr_id']);
          $mtr_id2 = trim($_POST['mtr_id2']);

          $tari = trim($_POST['tari2020']);

          $ricavi_mat = trim($_POST['ricavi_mat2020']);
          $ricavi_ener = trim($_POST['ricavi_ener2020']);
          $ricavi_inc_ener = trim($_POST['ricavi_inc_ener2020']);

          $miur = trim($_POST['miur2020']);
          $rec_evasione = trim($_POST['rec_evasione2020']);
          $sanzioni = trim($_POST['sanzioni2020']);
          $ricavi_fp = trim($_POST['ricavi_fp2020']);
          $fp_fisse = trim($_POST['fp_fisse2020']);
          $fp_var = trim($_POST['fp_var2020']);
          $altre_entrate = trim($_POST['altre_entrate2020']);
          $note = trim($_POST['note2020']);

          $fondi_admin=trim($_POST['fondi_admin2020']);
          $fondi_qui=trim($_POST['fondi_qui2020']);
          $fondi_oneri=trim($_POST['fondi_oneri2020']);
          $fondi_crediti=trim($_POST['fondi_crediti2020']);
          $fondi_tasse=trim($_POST['fondi_tasse2020']);
          $fondi_post_mortem=trim($_POST['fondi_post_mortem2020']);
          $fondi_terzi=trim($_POST['fondi_terzi2020']);

          if (!$fondi_admin) {
            $fondi_admin=0;
          }

          if (!$fondi_qui) {
            $fondi_qui=0;
          }

          if (!$fondi_oneri) {
            $fondi_oneri=0;
          }

          if (!$fondi_crediti) {
            $fondi_crediti=0;
          }

          if (!$fondi_tasse) {
            $fondi_tasse=0;
          }

          if (!$fondi_post_mortem) {
            $fondi_post_mortem=0;
          }

          if (!$fondi_terzi) {
            $fondi_terzi=0;
          }


          //if ($conai_chk==1) {$conai_val = trim($_POST['conai_val']);} else {$conai_val=0;}
          //if ($miur_chk==1) {$miur_val = trim($_POST['miur_val']);} else {$miur_val=0;}

            $year="2020";
            $sql = "UPDATE `mtr` SET
            `completed`=1,
            `last_modified_id`=$user_id,
            `tari`=$tari,
            `ricavi_mat`=$ricavi_mat,
            `ricavi_ener`=$ricavi_ener,
            `ricavi_inc_ener`=$ricavi_inc_ener,
            `miur`=$miur,
            `rec_evasione`=$rec_evasione,
            `sanzioni`=$sanzioni,
            `ricavi_fp`=$ricavi_fp,
            `fp_fisse`=$fp_fisse,
            `fp_var`=$fp_var,
            `altre_entrate`=$altre_entrate,
            `note`='$note',
            `fondi_admin`='$fondi_admin',
            `fondi_qui`='$fondi_qui',
            `fondi_oneri`='$fondi_oneri',
            `fondi_crediti`='$fondi_crediti',
            `fondi_tasse`='$fondi_tasse',
            `fondi_post_mortem`='$fondi_post_mortem',
            `fondi_terzi`='$fondi_terzi'


              WHERE `id`='$mtr_id' AND `year`='$year'";
            mysqli_query($db,$sql);
            echo $db->error;
            echo $sql;



            $tari = trim($_POST['tari2021']);
            $ricavi_mat = trim($_POST['ricavi_mat2021']);
            $ricavi_ener = trim($_POST['ricavi_ener2021']);
            $ricavi_inc_ener = trim($_POST['ricavi_inc_ener2021']);
            $miur = trim($_POST['miur2021']);
            $rec_evasione = trim($_POST['rec_evasione2021']);
            $sanzioni = trim($_POST['sanzioni2021']);
            $ricavi_fp = trim($_POST['ricavi_fp2021']);
            $fp_fisse = trim($_POST['fp_fisse2021']);
            $fp_var = trim($_POST['fp_var2021']);
            $altre_entrate = trim($_POST['altre_entrate2021']);
            $note = trim($_POST['note2021']);

            $fondi_admin=trim($_POST['fondi_admin2021']);
            $fondi_qui=trim($_POST['fondi_qui2021']);
            $fondi_oneri=trim($_POST['fondi_oneri2021']);
            $fondi_crediti=trim($_POST['fondi_crediti2021']);
            $fondi_tasse=trim($_POST['fondi_tasse2021']);
            $fondi_post_mortem=trim($_POST['fondi_post_mortem2021']);
            $fondi_terzi=trim($_POST['fondi_terzi2021']);

            if (!$fondi_admin) {
              $fondi_admin=0;
            }

            if (!$fondi_qui) {
              $fondi_qui=0;
            }

            if (!$fondi_oneri) {
              $fondi_oneri=0;
            }

            if (!$fondi_crediti) {
              $fondi_crediti=0;
            }

            if (!$fondi_tasse) {
              $fondi_tasse=0;
            }

            if (!$fondi_post_mortem) {
              $fondi_post_mortem=0;
            }

            if (!$fondi_terzi) {
              $fondi_terzi=0;
            }



            //if ($conai_chk==1) {$conai_val = trim($_POST['conai_val']);} else {$conai_val=0;}
            //if ($miur_chk==1) {$miur_val = trim($_POST['miur_val']);} else {$miur_val=0;}
            $year="2021";
            $sql = "UPDATE `mtr` SET
            `completed`=1,
            `last_modified_id`=$user_id,
            `tari`=$tari,
            `ricavi_mat`=$ricavi_mat,
            `ricavi_ener`=$ricavi_ener,
            `ricavi_inc_ener`=$ricavi_inc_ener,
            `miur`=$miur,
            `rec_evasione`=$rec_evasione,
            `sanzioni`=$sanzioni,
            `ricavi_fp`=$ricavi_fp,
            `fp_fisse`=$fp_fisse,
            `fp_var`=$fp_var,
            `altre_entrate`=$altre_entrate,
            `note`='$note',
            `fondi_admin`='$fondi_admin',
            `fondi_qui`='$fondi_qui',
            `fondi_oneri`='$fondi_oneri',
            `fondi_crediti`='$fondi_crediti',
            `fondi_tasse`='$fondi_tasse',
            `fondi_post_mortem`='$fondi_post_mortem',
            `fondi_terzi`='$fondi_terzi'

              WHERE `id`='$mtr_id2' AND `year`='$year'";
            mysqli_query($db,$sql);
            echo $db->error;
            echo $sql;




          // Set mtn Completed
          $sql = "UPDATE `reports` SET `id_status`=2, `last_modified_id`='$user_id' WHERE `id`='$report_id' ";
          mysqli_query($db,$sql);
          echo $db->error;

          // Insert Event new => open in event table
          // $sql = "INSERT INTO `events` (`id_report`, `id_status_from`, `id_status`, `id_user`) VALUES ($report_id,1,2,$user_id)";
          $sql = "INSERT INTO `events` (`id_report`, `id_status_from`, `id_status`, `id_user`) SELECT $report_id,1,2,$user_id FROM `events` WHERE NOT EXISTS (SELECT * FROM `events` WHERE `id_report`=$report_id AND `id_status_from`=1 AND `id_status`=2 AND `id_user`=$user_id LIMIT 1)";
          mysqli_query($db,$sql);
          echo $db->error;

          header('Location: ' . $_SERVER['HTTP_REFERER']);

        ?>
