<?php
define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);

if(!isset($_FILES)) $_FILES = $HTTP_POST_FILES;
if(!isset($_SERVER)) $_SERVER = $HTTP_SERVER_VARS;


// https://guide.hosting.aruba.it/hosting/linux/servizi-inclusi-creazione-sito-web/file-manager-assegnare-e-modificare-i-permessi-di.aspx
$town_id = trim($_POST['town_id']); 
$target_dir= "../uploads/".$town_id."/";
$target_file = $target_dir . basename($_FILES["pef_file"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if (file_exists($target_file)) {
  echo '<script>alert("Il File '.basename($_FILES["pef_file"]["name"]).' e` stato gia inviato.");</script>';
  $uploadOk = 0;
}

// Check file size
if ($_FILES["pef_file"]["size"] > 10*MB) {
  echo '<script>alert("File troppo grande (dim max = 10 MB), conttattare l\'amministratore di sistema.");</script>';
  $uploadOk = 0;
}

// Allow certain file formats
if($fileType != "pdf" && $fileType != "txt" && $fileType != "xls" && $fileType != "xlsx" ) {
  echo '<script>alert("Sono ammessi solo files .pdf, ,txt, .xls e .xlsx.");</script>';
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  //echo '<script>alert("Si e` verificato un problema durante l\'invio del file, conttattare l\'amministratore di sistema.");</script>';
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["pef_file"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["pef_file"]["name"])). " has been uploaded.";
  } else {
    echo '<script>alert("Si e` verificato un problema durante il trasferimento del file, conttattare l\'amministratore di sistema.");</script>';
  }
}
//echo '<script>window.history.go(-1);</script>'; 
?>