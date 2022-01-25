<?php
  include('config.php');
  // Retrieve data from html
  $report_id = trim($_POST['report_id']);
  $user_id = trim($_POST['user_id']);
  $mtn_id = trim($_POST['mtn_id']);

  $rag_soc= $_POST['rag_soc'];


  $canone_mtn = $_POST['canone_mtn'];
  $contr_chk = trim($_POST['contr_chk']);
  $conai_chk = trim($_POST['conai_chk']);

  $cts_chk = trim($_POST['cts_chk']);
  $ctr_chk = trim($_POST['ctr_chk']);
  $csl_chk = trim($_POST['csl_chk']);

  $ru_chk=trim($_POST['ru_chk']);

  $data_del=trim($_POST['data_del']);
  $data_app=trim($_POST['data_app']);


  $ces_chk=trim($_POST['ces_chk']);
  $ces_desc=trim($_POST['ces_desc']);

  $lav_chk=trim($_POST['lav_chk']);
  $lav_desc=trim($_POST['lav_desc']);

  $att_gest_chk=trim($_POST['att_gest_chk']);
  $qual_chk=trim($_POST['qual_chk']);

  /*  var_dump($canone_mtn);echo "<br>";
    var_dump($conai_chk);echo "<br>";
    var_dump($conai_val);echo "<br>";
    var_dump($tari_ric);echo "<br>";
    var_dump($tari_fix);echo "<br>";
    var_dump($tari_var);echo "<br>";

    var_dump($canone_mtr);echo "<br>";
    var_dump($canone_ben);echo "<br>";
    var_dump($cts_chk);echo "<br>";
    var_dump($ctr_chk);echo "<br>";
    var_dump($csl_chk);echo "<br>";
    var_dump($miur_eff);echo "<br>";
    var_dump($att_fp);echo "<br>";
    var_dump($att_fp_ben);echo "<br>";
  */
$sql = "UPDATE `mtn` SET
    `completed`=1,
    `last_modified_id`='$user_id',
    `canone_mtn`='$canone_mtn',
    `contr_chk`='$contr_chk',
    `rag_soc`='$rag_soc',
    `conai_chk`='$conai_chk',
    `cts_chk`='$cts_chk',
    `ctr_chk`='$ctr_chk',
    `csl_chk`='$csl_chk',
    `ru_chk`='$ru_chk',
    `data_del`=('$data_del'),
    `data_app`=('$data_app'),
    `ces_chk`='$ces_chk',
    `ces_desc`='$ces_desc',
    `lav_chk`='$lav_chk',
    `lav_desc`='$lav_desc',
    `att_gest_chk`='$att_gest_chk',
    `qual_chk`='$qual_chk'
     WHERE `id`='$mtn_id'";
     echo $sql;
    if ($db->query($sql) === TRUE) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . $db->error;
    }
    echo $db->error;

  // Set mtn Completed
  $sql = "UPDATE `reports` SET `id_status`=2, `last_modified_id`=$user_id WHERE `id`=$report_id";
  mysqli_query($db,$sql);
  // Insert Event new => open in event table
  // $sql = "INSERT INTO `events` (`id_report`, `id_status_from`, `id_status`, `id_user`) VALUES ($report_id,1,2,$user_id)";
  $sql = "INSERT INTO `events` (`id_report`, `id_status_from`, `id_status`, `id_user`) SELECT $report_id,1,2,$user_id FROM `events` WHERE NOT EXISTS (SELECT * FROM `events` WHERE `id_report`=$report_id AND `id_status_from`=1 AND `id_status`=2 AND `id_user`=$user_id LIMIT 1)";

      if (!mysqli_query($db,$sql))
      {
       echo("Error description: " . mysqli_error($db));
      }

      header('Location: ' . $_SERVER['HTTP_REFERER']);

?>
