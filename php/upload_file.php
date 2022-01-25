<?php
  ob_start();
  include('session.php');

  // Retrieve data from html

  $uploaded=0;
  $sign=$_SESSION["login_town"]."-".$town_id."-";  //firmo il file
  //echo $sign;
          $file_name = array(
            "pef_comune_grezzo_2020",
            "pef_comune_grezzo_2021",
            "relazione_pef_comune_2020",
            "relazione_pef_comune_2021",
            "pef_comune_etc_2020",
            "pef_comune_etc_2021",
            "contratto_gestore",
            "delibera_2021"
          );

          for ($i=0; $i < 8; $i++)
          {
              upload_file($file_name[$i],$sign);

          }

function upload_file($file_name,$sign)
{
  $target_dir = "../uploads/";
  $target_file = $target_dir . $sign.basename($_FILES[$file_name]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



  // Check if file already exists
  if (file_exists($target_file)) {
    unlink($target_file);
    $uploadOk = 1;
  }

  // Check file size

  if ($_FILES[$file_name]["size"] > 50000000000) {
    echo "Il tuo file è troppo grande per essere caricato.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "xls"  && $imageFileType != "xlsx" && $imageFileType != "doc" &&
     $imageFileType != "docx" && $imageFileType != "txt"  && $imageFileType != "msg" &&
     $imageFileType != "pdf"  && $imageFileType != "zip" ) {
    echo "Sono ammessi solo file in formato : .xls, .xlsx, .doc, .docx, .txt, .pdf, .msg , .zip"."<br>";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Il tuo file non è stato caricato";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES[$file_name]["tmp_name"], $target_file)) {
      echo "Il file ". htmlspecialchars( basename( $_FILES[$file_name]["name"])). " è stato caricato.";
      $uploaded=1;
    } else {
      echo "Errore nel caricamento del file.";
      }
    }
  }


  //$pef2020_gestore_file = basename($_FILES["pef2020_gestore_file"]["name"]);
  $pef_comune_grezzo_2020 = basename($_FILES["pef_comune_grezzo_2020"]["name"]);
  $relazione_pef_comune_2020 = basename($_FILES["relazione_pef_comune_2020"]["name"]);
  $pef_comune_grezzo_2021 = basename($_FILES["pef_comune_grezzo_2021"]["name"]);
  $relazione_pef_comune_2021 = basename($_FILES["relazione_pef_comune_2021"]["name"]);
  $pef_comune_etc_2020 = basename($_FILES["pef_comune_etc_2020"]["name"]);
  $pef_comune_etc_2021 = basename($_FILES["pef_comune_etc_2021"]["name"]);
  $contratto_gestore = basename($_FILES["contratto_gestore"]["name"]);
  $delibera_2021 = basename($_FILES["delibera_2021"]["name"]);

  for ($i=0; $i < 8; $i++) {
    $file_content[$i]=basename($_FILES[$file_name[$i]]["name"]);
  }

  echo $delibera_2021;

for ($i=0; $i < 8 ; $i++) {
    if (!empty($file_content[$i])) {
      $sql = "UPDATE `invio` SET `completed`=1,`last_modified_id`=$user_id ,`$file_name[$i]`='$file_content[$i]'  WHERE `id`='$invio_id'";
        mysqli_query($db,$sql);
        echo $db->error;
        }
      }

    // Set mtn Completed
    $sql = "UPDATE `reports` SET `id_status`=2, `last_modified_id`=$user_id  WHERE `id`=$report_id";
    mysqli_query($db,$sql);
    echo $db->error;
    // Insert Event new => open in event table
    // $sql = "INSERT INTO `events` (`id_report`, `id_status_from`, `id_status`, `id_user`) VALUES ($report_id,1,2,$user_id)";



    header('Location: ' . $_SERVER['HTTP_REFERER']);
    ob_end_flush();

?>
