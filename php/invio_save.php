<?php
  include('config.php');
  // Retrieve data from html
  $report_id = trim($_POST['report_id']); 
  $user_id = trim($_POST['user_id']); 
  $invio_id = trim($_POST['invio_id']); 
  $town_id = trim($_POST['town_id']); 
  $cura_italia = trim($_POST['cura_italia']);
  $tar2020_date = trim($_POST['tar2020_date']);
  $appalto_date = trim($_POST['appalto_date']);
  $bil_amm = trim($_POST['bil_amm']);
  $bil_lav = trim($_POST['bil_lav']);
  $pef2020_appr_file = basename($_FILES["pef2020_appr_file"]["name"]); 
  $pef2018_comune_file = basename($_FILES["pef2018_comune_file"]["name"]); 
  $pef2019_comune_file = basename($_FILES["pef2019_comune_file"]["name"]); 
  $pef2020_comune_file = basename($_FILES["pef2020_comune_file"]["name"]); 
  $pef2018_gestore_file = basename($_FILES["pef2018_gestore_file"]["name"]); 
  $pef2019_gestore_file = basename($_FILES["pef2019_gestore_file"]["name"]); 
  $pef2020_gestore_file = basename($_FILES["pef2020_gestore_file"]["name"]); 


  $sql = "UPDATE `invio` SET `completed`=1,`last_modified_id`=$user_id,";
    if(strlen($pef2020_appr_file)){$sql=$sql."`pef2020_appr_file`='$pef2020_appr_file',";}
    if(strlen($pef2018_comune_file)){$sql=$sql."`pef2018_comune_file`='$pef2018_comune_file',";}
    if(strlen($pef2019_comune_file)){$sql=$sql."`pef2019_comune_file`='$pef2019_comune_file',";}
    if(strlen($pef2020_comune_file)){$sql=$sql."`pef2020_comune_file`='$pef2020_comune_file',";}
    if(strlen($pef2018_gestore_file)){$sql=$sql."`pef2018_gestore_file`='$pef2018_gestore_file',";}
    if(strlen($pef2019_gestore_file)){$sql=$sql."`pef2019_gestore_file`='$pef2019_gestore_file',";}
    if(strlen($pef2020_gestore_file)){$sql=$sql."`pef2020_gestore_file`='$pef2020_gestore_file',";}
    $sql = $sql."`cura_italia`=$cura_italia,
    `tar2020_date`='$tar2020_date',
    `appalto_date`='$appalto_date',
    `bil_amm`=$bil_amm,
    `bil_lav`=$bil_lav
    WHERE `id`=$invio_id";

  mysqli_query($db,$sql);
  // Set mtn Completed
  $sql = "UPDATE `reports` SET `id_status`=2, `last_modified_id`=$user_id WHERE `id`=$report_id";
  mysqli_query($db,$sql);
  // Insert Event new => open in event table
  // $sql = "INSERT INTO `events` (`id_report`, `id_status_from`, `id_status`, `id_user`) VALUES ($report_id,1,2,$user_id)";
  $sql = "INSERT INTO `events` (`id_report`, `id_status_from`, `id_status`, `id_user`) SELECT $report_id,1,2,$user_id FROM `events` WHERE NOT EXISTS (SELECT * FROM `events` WHERE `id_report`=$report_id AND `id_status_from`=1 AND `id_status`=2 AND `id_user`=$user_id LIMIT 1)";
  mysqli_query($db,$sql);

  // Upload Files
  define('KB', 1024);
  define('MB', 1048576);
  define('GB', 1073741824);
  define('TB', 1099511627776);
  define('FL', 20*MB);

  // Set Dir
  // https://guide.hosting.aruba.it/hosting/linux/servizi-inclusi-creazione-sito-web/file-manager-assegnare-e-modificare-i-permessi-di.aspx
  $target_dir = "../uploads/".$town_id."/";
  if(strlen($pef2020_appr_file)){upload_file($target_dir,'pef2020_appr_file');}
  if(strlen($pef2018_comune_file)){upload_file($target_dir,'pef2018_comune_file');}
  if(strlen($pef2019_comune_file)){upload_file($target_dir,'pef2019_comune_file');}
  if(strlen($pef2020_comune_file)){upload_file($target_dir,'pef2020_comune_file');}
  if(strlen($pef2018_gestore_file)){upload_file($target_dir,'pef2018_gestore_file');}
  if(strlen($pef2019_gestore_file)){upload_file($target_dir,'pef2019_gestore_file');}
  if(strlen($pef2020_gestore_file)){upload_file($target_dir,'pef2020_gestore_file');}
  
  function upload_file($target_dir,$fileid) {
    $source_file = $_FILES[$fileid]["tmp_name"];
    $source_size = $_FILES[$fileid]["size"];
    $target_file = $target_dir . basename($_FILES[$fileid]["name"]);
    $uploadOk = 1;
    // Check if file exist
    if (file_exists($target_file)) {$uploadOk = 0;}
    // Check pef_file size
    if ($source_size > FL) {$uploadOk = 0;}
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 1) {move_uploaded_file($source_file, $target_file);}
    return 1;
  }
  header("location: ./welcome.php");
?>
