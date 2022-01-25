<?php
      include('session.php');
      $row_id=$_POST['id_riga'];//echo $row_id . "<br>";
      $account=$_SESSION['login_user'];//echo $account . "<br>";
      $user_id=$_SESSION['user_id'];//echo $user_id . "<br>";
      $create_date=$_POST['create_date'];//echo $create_date . "<br>";
      $anno=$_POST['anno'];//echo $anno . "<br>";
      $missione=$_POST['missione'];//echo $capitolo . "<br>";
      $programma=$_POST['programma'];//echo $certificato . "<br>";
      $macroaggregato=$_POST['macroaggregato'];//echo $conto . "<br>";
      $descrizione=$_POST['descrizione'];//echo $descrizione . "<br>";
      $impegno=$_POST['impegno'];//echo $impegno . "<br>";
      $ptari=$_POST['ptari'];//echo $ptari . "<br>";
      $pef=$_POST['pef'];//echo $pef . "<br>";
      $costo=$_POST['costo'];//echo $costo . "<br>";
      $piva=$_POST['piva'];//echo $piva . "<br>";
      $bilancio=$_POST['bilancio'];//echo $bilancio . "<br>";
      $gestione=$_POST['gestione'];//echo $gestione . "<br>";
      $costo=$_POST['costo'];//echo $costo . "<br>";
      $netto=$_POST['netto'];//echo $netto . "<br>";
      $iva=$_POST['iva'];//echo $iva . "<br>";
      $note=$_POST['note'];//echo $note . "<br>";

      $id = preg_replace('/[^0-9]/', '', $row_id);
      $op = preg_replace('/[^a-zA-Z]/', '', $row_id);

      if ($op=="s") {

        $sql="UPDATE `input` SET `missione`='$missione',`programma`='$programma',`macroaggregato`='$macroaggregato',`descrizione`='$descrizione',`impegno`='$impegno',`ptari`='$ptari',`pef`='$pef',`costo`='$costo',
        `piva`='$piva',`bilancio`='$bilancio',`gestione`='$gestione',`costo`='$costo',`netto`='$netto',`iva`='$iva', `note`='$note'
        WHERE `user_creator_id`='$user_id' AND `id`='$id'";
        $db->query($sql);
      }
      else if($op=="d"){
        $sql="UPDATE `input` SET `valid`=0,`visible`=0 WHERE `user_creator_id`='$user_id' AND `id`='$id'";
        $db->query($sql);
      }

      //echo "Error: " . "<br>" . $db->error;

      header('Location: ' . $_SERVER['HTTP_REFERER']);

        $db->close();
 ?>
