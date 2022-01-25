<?php
  include('config.php');
  // Retrieve data from html
  $report_id = trim($_POST['report_id']);
  $user_id = trim($_POST['user_id']);
  $username = trim($_POST['username']);
  $account = trim($_POST['account']);
  $town = trim($_POST['town']);
  $title = trim($_POST['title']);
  $year = trim($_POST['year']);


  $missione = trim($_POST['missione']);
  $programma = trim($_POST['programma']);
  $macroaggregato = trim($_POST['macroaggregato']);


  $descrizione = trim($_POST['descrizione']);
  $impegno = trim($_POST['impegno']);
  $ptari = trim($_POST['ptari']);
  $pef = trim($_POST['pef']);
  $costo = trim($_POST['costo']);
  $piva = trim($_POST['piva']);
  $bilancio = trim($_POST['bilancio']);
  $gestione = trim($_POST['gestione']);
  $netto = trim($_POST['netto']);
  $iva = trim($_POST['iva']);
  $note = trim($_POST['note']);
  //if($conto==''){$conto='0';}
  if(!$impegno){$impegno=0;}
  if(!$ptari){$ptari=0;}
  if(!$pef){$pef=0;}


// INSERT INTO `input`(`report_id`, `completed`, `user_creator_id`, `create_date`, `year`, `conto`, `impegno`, `descrizione`, `pef_comp`, `p_tari`, `pef_costo`, `pef_iva`, `pef_ben`, `note`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15],[value-16],[value-17],[value-18],[value-19])
// $sql = "INSERT INTO `input`(`report_id`, `user_creator_id`) VALUES ($id_report,$id_user)";
//mysqli_query($db, $sql);
  $sql = "INSERT INTO `input`(`report_id`, `completed`, `year`, `user_creator_id`, `last_modified_id`, `last_modified_date`, `missione`, `programma`, `macroaggregato`, `descrizione`, `impegno`, `ptari`, `pef`, `costo`, `piva`, `bilancio`, `gestione`, `netto`, `iva`, `note`)
    VALUES ($report_id,1,$year,$user_id,$user_id,now(),'$missione','$programma','$macroaggregato','$descrizione',$impegno,$ptari,$pef,'$costo',$piva,'$bilancio','$gestione',$netto,$iva,'$note')";
  mysqli_query($db,$sql);
  echo $db->error;

  // Update Report
  $sql = "UPDATE `reports` SET `id_status`=2, `last_modified_id`=$user_id WHERE `id`=$report_id";
  mysqli_query($db,$sql);
  // Insert Event new => open in event table
  // $sql = "INSERT INTO `events` (`id_report`, `id_status_from`, `id_status`, `id_user`) VALUES ($report_id,1,2,$user_id)";
  $sql = "INSERT INTO `events` (`id_report`, `id_status_from`, `id_status`, `id_user`) SELECT $report_id,1,2,$user_id FROM `events` WHERE NOT EXISTS (SELECT * FROM `events` WHERE `id_report`=$report_id AND `id_status_from`=1 AND `id_status`=2 AND `id_user`=$user_id LIMIT 1)";
  mysqli_query($db,$sql);
  echo $db->error;
  header("location: ./input.php");
  header("location: ./input.php?report_id=".$report_id."&year=".$year."&username=".$username."&account=".$account."&town=".$town."&title=".$title);
?>
