<?php
      include('session.php');
      $row_id=$_POST['id_riga'];//echo $row_id . "<br>";
      $account=$_SESSION['login_user'];//echo $account . "<br>";
      $user_id=$_SESSION['user_id'];//echo $user_id . "<br>";
      $create_date=$_POST['create_date'];//echo $create_date . "<br>";
      $soggetto=$_POST['soggetto'];  echo $soggetto . "<br>";
      $tipologia=$_POST['tipologia']; echo $tipologia . "<br>";
      $componente=$_POST['componente']; echo $componente . "<br>";
      $anno=$_POST['anno'];    echo $anno . "<br>";
      $quant=$_POST['quant']; echo $quant . "<br>";
      $prezzo=$_POST['prezzo']; echo $prezzo . "<br>";
      $totale=$_POST['totale']; echo $totale . "<br>";



      $id = preg_replace('/[^0-9]/', '', $row_id);
      $op = preg_replace('/[^a-zA-Z]/', '', $row_id);

      if ($op=="s") {

        $sql="UPDATE `extra` SET `soggetto`='$soggetto', `tipologia`='$tipologia',`componente`='$componente',`anno`='$anno',
        `quant`='$quant', `prezzo`='$prezzo',`totale`='$totale',`last_modified_id`='$user_id'
        WHERE `report_id`='$report_id' AND `id`='$id'";
        $db->query($sql);
      }
      else if($op=="d"){
        $sql="UPDATE `extra` SET `valid`=0  WHERE `report_id`='$report_id' AND `id`='$id'";
        $db->query($sql);
      }

      //echo "Error: " . "<br>" . $db->error;

      header('Location: ' . $_SERVER['HTTP_REFERER']);

        $db->close();
 ?>
