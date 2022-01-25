<?php
  include('config.php');
  // Retrieve data from html
  $report_id = trim($_POST['report_id']); 
  $user_id = trim($_POST['user_id']); 
  $mtn_id = trim($_POST['mtn_id']); 
  $canone_mtn = trim($_POST['canone_mtn']); 
  $tari = trim($_POST['tari']); 
  $conai_chk = trim($_POST['conai_chk']); 
  if ($conai_chk==1) {$conai_val = trim($_POST['conai_val']);} else {$conai_val=0;}
  $tari_ric = trim($_POST['tari_ric']); 
  $tari_fix = trim($_POST['tari_fix']); 
  $tari_var = trim($_POST['tari_var']); 
  $canone_mtr = trim($_POST['canone_mtr']); 
  $canone_ben = trim($_POST['canone_ben']); 
  $canone_iva = trim($_POST['canone_mtr_iva']); 
  $cts_chk = trim($_POST['cts_chk']); 
  if($cts_chk==0){
    $cts = 0; 
    $cts_ben = 1; 
    $cts_iva = 0; 
  }else{
    $cts = trim($_POST['cts']); 
    $cts_ben = trim($_POST['cts_ben']); 
    $cts_iva = trim($_POST['cts_iva']); 
  }
  $ctr_chk = trim($_POST['ctr_chk']); 
  if($ctr_chk==0){
    $ctr = 0; 
    $ctr_ben = 1; 
    $ctr_iva = 0; 
  }else{
    $ctr = trim($_POST['ctr']); 
    $ctr_ben = trim($_POST['ctr_ben']); 
    $ctr_iva = trim($_POST['ctr_iva']); 
  }
  $csl_chk = trim($_POST['csl_chk']); 
  if($csl_chk==0){
    $csl = 0; 
    $csl_ben = 1; 
    $csl_iva = 0; 
  }else{
    $csl = trim($_POST['csl']); 
    $csl_ben = trim($_POST['csl_ben']); 
    $csl_iva = trim($_POST['csl_iva']); 
  }
  $miur_eff = trim($_POST['miur_eff']); 
  $att_fp = trim($_POST['att_fp']); 
  $att_fp_ben = trim($_POST['att_fp_ben']); 
  $att_fp_iva = trim($_POST['att_fp_iva']); 
  $ent_ev = trim($_POST['ent_ev']); 
  $conai_ric = trim($_POST['conai_ric']); 

  $sql = "UPDATE `mtn` SET 
    `completed`=1,
    `last_modified_id`=$user_id,
    `canone_mtn`=$canone_mtn,
    `tari`=$tari,
    `conai_chk`=$conai_chk,
    `conai_val`=$conai_val,
    `recupero_tari`=$tari_ric,
    `riduzioni_var`=$tari_var,
    `riduzioni_fix`=$tari_fix,
    `canone_mtr`=$canone_mtr,
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
    `csl_chk`=$csl_chk,
    `csl`=$csl,
    `csl_ben`=$csl_ben,
    `csl_iva`=$csl_iva,
    `miur_eff`=$miur_eff,
    `att_fp`=$att_fp,
    `att_fp_ben`=$att_fp_ben,
    `att_fp_iva`=$att_fp_iva,
    `ent_ev`=$ent_ev,
    `conai_ric`=$conai_ric
    WHERE `id`=$mtn_id";
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

