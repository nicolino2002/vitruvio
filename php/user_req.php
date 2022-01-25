<?php
  include("config.php");
  //Connect to MySQL Server

  // Retrieve data from Query String
  $reg = mysqli_real_escape_string($db,$_POST['reg']);
  $prov = mysqli_real_escape_string($db,$_POST['prov']);
  $town = mysqli_real_escape_string($db,$_POST['town']);
  $name = mysqli_real_escape_string($db,$_POST['name']);
  $surname = mysqli_real_escape_string($db,$_POST['surname']);
  $title = mysqli_real_escape_string($db,$_POST['title']);
  $tel = mysqli_real_escape_string($db,$_POST['tel']);
  $account = mysqli_real_escape_string($db,$_POST['account']);
  $password = mysqli_real_escape_string($db,$_POST['password']);
  $email2 = mysqli_real_escape_string($db,$_POST['email2']);
  $service = mysqli_real_escape_string($db,$_POST['service']);
  $privacy = mysqli_real_escape_string($db,$_POST['privacy']);
  if(!isset($_POST['receipt'])) {$receipt = 0;}else{$receipt = mysqli_real_escape_string($db,$_POST['receipt']);}

  // Get town_id
  $sql = "SELECT `id` FROM `towns` WHERE `valid`=1 AND `visible`=1 AND `town`= '$town';";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_array($result);
  $count = mysqli_num_rows($result);
  if($count==0) {echo '<script>alert("Comune di '.$town.' non ancora attivo su Infowaste");</script>';echo '<script>window.history.go(-2);</script>';exit();} else {$town_id = $row['id'];}
  //echo 'sql:'.$sql.', town_id:'.$town_id.',<br>';
  // User already exists
  $sql = "SELECT `id` FROM `users` WHERE `del`=0 AND `valid`=1 AND `visible`=1 AND `email`= '$account';";
  $result = mysqli_query($db, $sql);
  $count = mysqli_num_rows($result);
  //echo 'sql:'.$sql.', active_count:'.$count.',<br>';
  if($count>0) {
    echo '<script>alert("Account '.$account.' gia` attivo su Supporto PEF");</script>';
  } else {
    // User Request already exists
    $sql = "SELECT `id` FROM `users` WHERE `del`=0 AND `valid`=0 AND `visible`=1 AND `email`= '$account' AND `town_id`= '$town_id';";
    $result = mysqli_query($db, $sql);
    $count = mysqli_num_rows($result);
    //echo 'sql:'.$sql.', req_count:'.$count.',<br>';
    if($count>0) {
      echo '<script>alert("Richiesta di Account '.$account.' gia` presente sul comune di '.$town.'");</script>';
    } else {
      // MAX NUMBER of USER per Town!!!
      $sql = "SELECT count(`id`) `users` FROM `users` WHERE `del`=0 AND `valid`=1 AND `visible`=1 AND `town_id`= '$town_id';";
      $result = mysqli_query($db, $sql);
      $row = mysqli_fetch_array($result);
      $users = $row['users'];
      //echo 'sql:'.$sql.', users_count:'.$users.',<br>';
      if($users>=5){ // MAX NUMBER of USER per Town!!!
        echo '<script>alert("Ci sono gia` '.$users.' account attivi sul comune di '.$town.'");</script>';
      } else {
        //build query
        $sql="INSERT INTO `users`(`title_id`, `name`, `surname`, `town_id`, `tel`, `email`, `mail2`, `pwd`,`valid`) VALUES (".$title.",'".$name."','".$surname."',".$town_id.",'".$tel."','".$account."','".$email2."','".$password."',0)";
        if ($result = mysqli_query($db, $sql)) {
        // $receipt => Send Mail php function
          echo '<script>alert("Richiesta account '.$account.' sul comune di '.$town.' inviata.");</script>';
          //echo 'sql:'.$sql.',<br>';
         if ($receipt == '1') {
           // Confirm Mail Send
           $url = 'https://www.bintobit.com/infowaste/test/php/mail.php';
           $postdata = http_build_query(
             array(
               'subject' => 'Richiesta Attivazione Account '.$account.'.',
               'to' => $account,
               'cc' => 'assistenza@bintobit.com',
               'message' => 'Richiesta attivazione account '.$account.' sull Comune di '.$town.' e` stata inviata.'
             )
           );
           $opts = array('http' =>
               array(
                   'method'  => 'POST',
                   'header'  => 'Content-type: application/x-www-form-urlencoded',
                   'content' => $postdata
               )
           );
           $context  = stream_context_create($opts);
           $result = file_get_contents($url, false, $context);
         }
        } else {
          /* Query Error */
          echo '<script>alert("Si e` verificato un errore durante la creazione dell\'Account '.$account.' attivo sul comune di '.$town.'");</script>';
          }
        }
      }
   }
   //header("location: ../index.html");
   echo '<script>window.history.go(-2);</script>';

  // Verifica Consistenza Password
  // TimeStamp Accettazione + Valid = True
  // Invio mail User Attivo
  // Pagina Disattivazione User + TimeStamp Disttivazione + Notifica Disattivazione?


  //build query
  //$sql = "SELECT DISTINCT `prov` FROM `towns` WHERE `reg` = '$reg' AND `valid`=1 ORDER BY `prov`";

  /* Select queries return a resultset */
/*
  if ($result = mysqli_query($db, $sql)) {
  ?>
  <label style="font-weight: bold; color: red;">Provincia:
    <select id="prov" class="select" name="prov" onchange="get_town(this);">
      <option value="">Please Select</option>
      <?php foreach ($result as $rs) { ?>
        <option value="<?php echo $rs["prov"]; ?>"><?php echo $rs["prov"]; ?></option>
      <?php } ?>
    </select>
  </label>
  <?php
  }
*/
  /* free result set */
  //mysqli_free_result($result);
?>
