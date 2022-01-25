<?php
  include('config.php');
  // Retrieve data from html
  $report_id = trim($_POST['report_id']); 
  $user_id = trim($_POST['user_id']); 
  $mtr_id = trim($_POST['mtr_id']); 
  $canone = trim($_POST['canone']); 
  $canone_ben = trim($_POST['canone_ben']); 
  $canone_iva = trim($_POST['canone_iva']); 
  $cts_chk = trim($_POST['cts_chk']); 
  $cts = trim($_POST['cts']); 
  $cts_ben = trim($_POST['cts_ben']); 
  $cts_iva = trim($_POST['cts_iva']); 
  $ctr_chk = trim($_POST['ctr_chk']); 
  $ctr = trim($_POST['ctr']); 
  $ctr_ben = trim($_POST['ctr_ben']); 
  $ctr_iva = trim($_POST['ctr_iva']); 
  $cov = trim($_POST['cov']); 
  $cos = trim($_POST['cos']); 
  $rcnd = trim($_POST['rcnd']); 
  $csl_chk = trim($_POST['csl_chk']); 
  $csl = trim($_POST['csl']); 
  $csl_ben = trim($_POST['csl_ben']); 
  $csl_comp = trim($_POST['csl_comp']); 
  $csl_iva = trim($_POST['csl_iva']); 
  $carc_pers = trim($_POST['carc_pers']); 
  $carc_pers_iva = trim($_POST['carc_pers_iva']); 
  $carc_post = trim($_POST['carc_post']); 
  $carc_post_iva = trim($_POST['carc_post_iva']); 
  $carc_risc = trim($_POST['carc_risc']); 
  $carc_risc_iva = trim($_POST['carc_risc_iva']); 
  $carc_cont = trim($_POST['carc_cont']); 
  $carc_cont_iva = trim($_POST['carc_cont_iva']); 
  $carc_soft = trim($_POST['carc_soft']); 
  $carc_soft_iva = trim($_POST['carc_soft_iva']); 
  $carc_gest = trim($_POST['carc_gest']); 
  $carc_gest_iva = trim($_POST['carc_gest_iva']); 
  $cc_cgg = trim($_POST['cc_cgg']); 
  $cc_cgg_iva = trim($_POST['cc_cgg_iva']); 
  $cc_ccd = trim($_POST['cc_ccd']); 
  $cc_ccd_iva = trim($_POST['cc_ccd_iva']); 
  $cc_coal = trim($_POST['cc_coal']); 
  $cc_coal_iva = trim($_POST['cc_coal_iva']); 
  $acc_disc = trim($_POST['acc_disc']); 
  $acc_cde = trim($_POST['acc_cde']); 
  $acc_risc = trim($_POST['acc_risc']); 
  $acc_nor_trib = trim($_POST['acc_nor_trib']); 
  $miur_eff = trim($_POST['miur_eff']); 
  $rec_eva_eff = trim($_POST['rec_eva_eff']); 
  $proc_sanz = trim($_POST['proc_sanz']); 
  $part_ent_comp = trim($_POST['part_ent_comp']); 
  $att_fp = trim($_POST['att_fp']); 
  $att_fp_ben = trim($_POST['att_fp_ben']); 
  $att_fp_iva = trim($_POST['att_fp_iva']); 

  //if ($conai_chk==1) {$conai_val = trim($_POST['conai_val']);} else {$conai_val=0;}
  //if ($miur_chk==1) {$miur_val = trim($_POST['miur_val']);} else {$miur_val=0;}
  
  $sql = "UPDATE `mtr` SET 
    `completed`=1,
    `last_modified_id`=$user_id,
    `canone`=$canone,
    `canone_ben`='$canone_ben',
    `canone_iva`=$canone_iva,
    `cts_chk`=$cts_chk,
    `cts`=$cts,
    `cts_ben`=$cts_ben,
    `cts_iva`=$cts_iva,
    `ctr_chk`=$ctr_chk,
    `ctr`=$ctr,
    `ctr_ben`=$ctr_ben,
    `ctr_iva`=$ctr_iva,
    `cov`=$cov,
    `cos`=$cos,
    `rcnd`=$rcnd,
    `csl_chk`=$csl_chk,
    `csl`=$csl,
    `csl_ben`=$csl_ben,
    `csl_comp`=$csl_comp,
    `csl_iva`=$csl_iva,
    `carc_pers`=$carc_pers,
    `carc_pers_iva`=$carc_pers_iva,
    `carc_post`=$carc_post,
    `carc_post_iva`=$carc_post_iva,
    `carc_risc`=$carc_risc,
    `carc_risc_iva`=$carc_risc_iva,
    `carc_cont`=$carc_cont,
    `carc_cont_iva`=$carc_cont_iva,
    `carc_soft`=$carc_soft,
    `carc_soft_iva`=$carc_soft_iva,
    `carc_gest`=$carc_gest,
    `carc_gest_iva`=$carc_gest_iva,
    `cc_cgg`=$cc_cgg,
    `cc_cgg_iva`=$cc_cgg_iva,
    `cc_ccd`=$cc_ccd,
    `cc_ccd_iva`=$cc_ccd_iva,
    `cc_coal`=$cc_coal,
    `cc_coal_iva`=$cc_coal_iva,
    `acc_disc`=$acc_disc,
    `acc_cde`=$acc_cde,
    `acc_risc`=$acc_risc,
    `acc_nor_trib`=$acc_nor_trib,
    `miur_eff`=$miur_eff,
    `rec_eva_eff`=$rec_eva_eff,
    `proc_sanz`=$proc_sanz,
    `part_ent_comp`=$part_ent_comp,
    `att_fp`=$att_fp,
    `att_fp_ben`=$att_fp_ben,
    `att_fp_iva`=$att_fp_iva
    WHERE `id`=$mtr_id";
  mysqli_query($db,$sql);
  // Set mtn Completed
  $sql = "UPDATE `reports` SET `id_status`=2, `last_modified_id`=$user_id WHERE `id`=$report_id";
  mysqli_query($db,$sql);
  // Insert Event new => open in event table
  // $sql = "INSERT INTO `events` (`id_report`, `id_status_from`, `id_status`, `id_user`) VALUES ($report_id,1,2,$user_id)";
  $sql = "INSERT INTO `events` (`id_report`, `id_status_from`, `id_status`, `id_user`) SELECT $report_id,1,2,$user_id FROM `events` WHERE NOT EXISTS (SELECT * FROM `events` WHERE `id_report`=$report_id AND `id_status_from`=1 AND `id_status`=2 AND `id_user`=$user_id LIMIT 1)";
  mysqli_query($db,$sql);
  header("location: ./welcome.php");
?>



