<?php
  include('config.php');
  //include('session.php');
  // IF TOWN SELECTED GET town_id AND RELOAD PAGE (ELSE TOWN_ID=0 => FIRST LOAD)
  if(isset($_GET['town_id'])){
    $town_id=mysqli_real_escape_string($db,$_GET['town_id']);
  } else {
    $town_id=0;
  }
  // SESSION
  $sql = "
  SELECT `t`.`town` 
    , case when isnull(`n`.`id`)=1 then 1 else 0 end as `new_report`
    ,`s`.`status`
    , `n`.`id` `report_id`
    , `n`.`id_status` `status_id`
    , `mtn`.`id` `mtn_id`
    , `mtr`.`id` `mtr_id`
    , `invio2020`.`id` `invio_id`
    , `extra2020`.`id` `extra_id`
    , `input2017`.`id` `input2017_id`
    , `input2019`.`id` `input2019_id`
    , case when (`mtn`.`completed`=0 or isnull(`mtn`.`id`)=1) then 'red' else 'white' end as `mtn`
    , case when (`mtr`.`completed`=0 or isnull(`mtr`.`id`)=1) then 'red' else 'white' end as `mtr`
    , case when (`invio2020`.`completed`=0 or isnull(`invio2020`.`id`)=1)  then 'red' else 'white' end as `invio`
    , case when (`extra2020`.`completed`=0 or isnull(`extra2020`.`id`)=1) then 'red' else 'white' end as `extra`
    , case when (`input2017`.`completed`=0 or isnull(`input2017`.`id`)=1) then 'red' else 'white' end as `input2017`
    , case when (`input2019`.`completed`=0 or isnull(`input2019`.`id`)=1) then 'red' else 'white' end as `input2019`
  FROM `towns` `t` 
    LEFT JOIN (SELECT `id`,`id_status`,`id_town` FROM `reports` WHERE `fy`=year(now()) AND `valid`=1 AND `visible`=1) `n` ON `t`.`id`=`n`.`id_town`
    LEFT JOIN `status` `s` ON `n`.`id_status`=`s`.`id`
    LEFT JOIN `mtn` `mtn` ON `n`.`id`=`mtn`.`report_id`
    LEFT JOIN `mtr` `mtr` ON `n`.`id`=`mtr`.`report_id`
    LEFT JOIN (SELECT `id`, `report_id`, `completed` FROM `mtr` WHERE `year`=2018) `mtr2018` ON `n`.`id`=`mtr2018`.`report_id`
    LEFT JOIN (SELECT `id`, `report_id`, `completed` FROM `mtr` WHERE `year`=2019) `mtr2019` ON `n`.`id`=`mtr2019`.`report_id`
    LEFT JOIN (SELECT `id`, `report_id`, `completed` FROM `invio`) `invio2020` ON `n`.`id`=`invio2020`.`report_id`
    LEFT JOIN (SELECT max(`id`) `id`, `report_id`, max(`completed`) `completed` FROM `extra` GROUP BY `report_id`) `extra2020` ON `n`.`id`=`extra2020`.`report_id`
    LEFT JOIN (SELECT max(`id`) `id`, `report_id`, max(`completed`) `completed` FROM `input` WHERE `year`=2017 GROUP BY `report_id`) `input2017` ON `n`.`id`=`input2017`.`report_id`
    LEFT JOIN (SELECT max(`id`) `id`, `report_id`, max(`completed`) `completed` FROM `input` WHERE `year`=2019 GROUP BY `report_id`) `input2019` ON `n`.`id`=`input2019`.`report_id`
  WHERE `t`.`id` = $town_id 
    AND `t`.`valid`=1 
    AND `t`.`visible`=1 
  ";

  $result = mysqli_query($db, $sql);
  $count = mysqli_num_rows($result);
  if($count>0) {
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $town = $row['town']; // 1=New Report Needed (Button enabled, MTN/MTR/ETC DISABLED) else 0
    $new_report = $row['new_report']; // 1=New Report Needed (Button enabled, MTN/MTR/ETC DISABLED) else 0
    $status = $row['status']; // (text)
    $report_id = $row['report_id']; // (number)
    $status_id = $row['status_id']; // (number)
    $mtn_id = $row['mtn_id']; // (number)
    $mtr_id = $row['mtr_id']; // (number)
    $invio_id = $row['invio_id']; // (number)
    $extra_id = $row['extra_id']; // (number)
    $input2017_id = $row['input2017_id']; // (number)
    $input2019_id = $row['input2019_id']; // (number)
    $mtn = $row['mtn'];
    $mtr = $row['mtr'];
    $invio = $row['invio'];
    $extra = $row['extra'];
    $input2017 = $row['input2017'];
    $input2019 = $row['input2019'];
  } else {
    $town = '';
    $new_report = 1;
    $status = '-';
    $report_id = 0;
    $status_id = 0;
    $mtn_id = 0;
    $mtr_id = 0;
    $invio_id = 0;
    $extra_id = 0;
    $input2017_id = 0;
    $input2019_id = 0;
    $mtn = 'red';
    $mtr = 'red';
    $invio = 'red';
    $extra = 'red';
    $input2017 = 'red';
    $input2019 = 'red';
  }
  
?>

<html>
   <head>
      <title>KAM ADMIN ver. 1.0</title>
      <style media="screen">
        .mainform
            {
              width:90%;
              height:20%;
              margin-left:5%;
              border-color: #044A92;
            }
        .forms {
                width:30%;
                height: 100%;
                padding:2px 5px;
                border: 3px solid #044A92;
                display: inline-block;
                float: left
                text-align:center;
                margin:8px;
                margin-right:30px;
            }
            .campo
            {
              padding:2px 2px;
              height:30px;
              width:100px;
              v-align:middle;
            }
            .send
            {
              height:60px;
              padding:10px;
              v-align:middle;
      			  background-color: #044A92;
      			  color: #ffffff;
              width:100%;
			  font-size:20px;
            }

            .formtitle
            {text-align: center;
              margin-bottom: 20px;}
            .fld
            {
              padding:2px 2px;
              height:30px;
              width:100px;
              v-align:middle;
              text-align:center;
              font-weight: bold;
              border-bottom: 1px solid black;
            }
            .rec
            {
              padding:2px 2px;
              height:30px;
              v-align:middle;
              text-align:center;
            }

      </style>
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    </head>

   <body>
    <div style="margin: 5%;">
      <a href="./welcome.php"><input class="btn btn-lg btn-primary" style="background-color: #fff;color:#044A92 ;width:15%;margin:1%" type="button"  value="Indietro"></input></a>
      <a href="./logout.php"><input class="btn btn-lg btn-primary" style="background-color: #044A92;width:15%;margin:1%;float:right" type="button"  value="Logout"></input></a>
      <div class="formtitle" >
        <h1 style="color:#000">WELLKAM!</h1>
      </div>
      <!-- COMUNE -->
      <h4 class="send" style="color:#FFFFFF;">COMUNE: <?php echo $town; ?></h4>
      <hr>
     <?php
       //build query
       $sql = "
        SELECT `t`.`id` `town_id`,
          `t`.`town`,
          `t`.`kam_id`,
          `r`.`id` `report_id`,
          CASE WHEN `r`.`id`>0 THEN 'green' ELSE 'red' END as `color` 
        FROM `towns` `t` 
          LEFT JOIN (SELECT * FROM `reports` WHERE `valid`=1 AND `visible`=1) `r` ON `t`.`id`=`r`.`id_town` 
        WHERE `t`.`valid`=1 AND `t`.`visible`=1
        ORDER BY `t`.`town`
      ";
       /* Select queries return a resultset */
       if ($result = mysqli_query($db, $sql)) {
       ?>
         <select id="town" class="select" name="town" onchange="document.location.href=this.value" method="GET">
           <option value="0">Please Select</option>
           <?php foreach ($result as $rs) { ?>
             <option value="./report.php?town_id=<?php echo $rs["town_id"]; ?>" style="color:<?php echo $rs["color"]; ?>"><?php echo $rs["town"]; ?></option>
           <?php } ?>
         </select>
       <?php
       }
       /* free result set */
       mysqli_free_result($result);
     ?>
      <hr>
      <!-- UTENTI ATTIVI SUL COMUNE -->
      <h4>UTENTI ATTIVI SUL COMUNE DI <?php echo $town; ?></h4>
      <p>
        <table id="users" width="100%">
          <thead>
            <tr>
              <th width="20%" hidden></th>
              <th width="20%" hidden></th>
              <th width="20%" hidden></th>
              <th width="20%" hidden></th>
              <th width="20%" hidden></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="fld">Nome e Cognome</td>
              <td class="fld">Attivo dal</td>
              <td class="fld">Telefono</td>
              <td class="fld">Account (email)</td>
              <td class="fld">Altra email</td>
            </tr>
            <?php
                //build query
              $sql = "
                SELECT * FROM `users` WHERE `valid`=1 AND `visible`=1 AND `town_id`=$town_id
              ";
              /* Select queries return a resultset */
              if ($result = mysqli_query($db, $sql)) {?>
              <tr><?php
              if(mysqli_num_rows($result)>0) {
                // output data of each row
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) { ?>
                  <td class="rec"><?php echo $row['name'].', '.$row['surname']; ?></td>
                  <td class="rec"><?php echo $row['act_date']; ?></td>
                  <td class="rec"><?php echo $row['tel']; ?></td>
                  <td class="rec"><?php echo $row['email']; ?></td>
                  <td class="rec"><?php echo $row['mail2']; ?></td>
                </tr>
                <?php
                  }
                }
              }
            ?>
          </tbody>
        </table>
      </p>
      <hr>
      <!-- EVENTS -->
      <p>
        <table id="events" width="100%">
          <thead>
            <tr>
              <th width="20%" hidden></th>
              <th width="20%" hidden></th>
              <th width="20%" hidden></th>
              <th width="20%" hidden></th>
              <th width="20%" hidden></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="100%" class="send">
                <h4 style="color:<?php if ($new_report==0) {echo 'white';} else {echo 'red';} ?>">REPORT EVENTS (STATUS: <?php echo $status; ?>)</h4>
              </td>
            </tr>
            <tr>
              <td class="fld">ReportID</td>
              <td class="fld">StatusFrom</td>
              <td class="fld">Status</td>
              <td class="fld">Account</td>
              <td class="fld">Data</td>
            </tr>
            <?php
                //build query
              $sql = "
                SELECT `id_report`, `f`.`status` `from`, `s`.`status`, `email`, max(`event date`) `event date`
                FROM `events` `e` 
                  INNER JOIN `reports` `r` ON `e`.`id_report`=`r`.`id`
                  INNER JOIN `towns` `t` ON `r`.`id_town`=`t`.`id`
                  INNER JOIN `users` `u` ON `e`.`id_user`=`u`.`id`
                  LEFT JOIN `status` `f` ON `e`.`id_status_from`=`f`.`id`
                  INNER JOIN `status` `s` ON `e`.`id_status`=`s`.`id`
                WHERE `r`.`valid`=1 AND `r`.`visible`=1 AND `e`.`valid`=1 AND `e`.`visible`=1 AND `town_id`=$town_id
                GROUP BY `id_report`, `f`.`status`, `s`.`status`, `email`
                ORDER BY `event date`
              ";
              /* Select queries return a resultset */
              if ($result = mysqli_query($db, $sql)) {?>
              <tr><?php
              if(mysqli_num_rows($result)>0) {
                // output data of each row
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) { ?>
                  <td class="rec"><?php echo $row['id_report']; ?></td>
                  <td class="rec"><?php echo $row['from']; ?></td>
                  <td class="rec"><?php echo $row['status']; ?></td>
                  <td class="rec"><?php echo $row['email']; ?></td>
                  <td class="rec"><?php echo $row['event date']; ?></td>
                </tr>
                <?php
                  }
                }
              }
            ?>
          </tbody>
        </table>
      </p>
      <!-- A. DATI 2019 -->
      <p>
        <table id="form_a" width="100%">
          <thead>
            <tr>
              <th width="50%" hidden></th>
              <th width="50%" hidden></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="100%" class="send">
                <h4 style="color:<?php echo $mtn; ?>">A. DATI 2019</h4>
              </td>
            </tr>
            <tr>
              <td class="fld">Descrizione</td>
              <td class="fld">Valore</td>
            </tr>
            <?php
                //build query
              $sql = "
                SELECT `a`.`completed`, 
                  `a`.`canone_mtn`,
                  `a`.`tari`,
                   CASE WHEN `a`.`conai_chk`=0 THEN 'NO' ELSE 'SI' END AS `conai_chk`,
                  `a`.`conai_val`,
                  `a`.`conai_ctr_chk`,
                  `a`.`miur_chk`,
                  `a`.`miur_val`,
                  `a`.`miur_ccd_chk`,
                  `a`.`disavanzo`,
                  `a`.`recupero_tari`,
                  `a`.`riduzioni_var`,
                  `a`.`riduzioni_fix`,
                  `a`.`canone_mtr`,
                  `a`.`canone_ben`,
                  `a`.`canone_iva`,
                  CASE WHEN `a`.`cts_chk`=0 THEN 'NO' ELSE 'SI' END AS `cts_chk`,
                  `a`.`cts`,
                  `s1`.`subject` `cts_ben`,
                  `a`.`cts_iva`,
                  CASE WHEN `a`.`ctr_chk`=0 THEN 'NO' ELSE 'SI' END AS `ctr_chk`,
                  `a`.`ctr`,
                  `s2`.`subject` `ctr_ben`,
                  `a`.`ctr_iva`,
                  `a`.`csl_par`,
                  CASE WHEN `a`.`csl_chk`=0 THEN 'NO' ELSE 'SI' END AS `csl_chk`,
                  `a`.`csl`,
                  `s3`.`subject` `csl_ben`,
                  `a`.`csl_iva`,
                  `a`.`miur_eff`,
                  `a`.`att_fp`,
                  `s4`.`subject` `att_fp_ben`,
                  `a`.`att_fp_iva`,
                  `a`.`pef_file`,
                  `a`.`ent_ev`,
                  `a`.`conai_ric`,
                  `c`.`email` `creator`,
                  `a`.`create_date`,
                  `m`.`email` `modifier`,
                  `a`.`last_modified_date`
                FROM `reports` `r`
                  INNER JOIN `mtn` `a` ON `r`.`id`=`a`.`report_id`
                  INNER JOIN `towns` `t` ON `r`.`id_town`=`t`.`id`
                  INNER JOIN `users` `c` ON `a`.`user_creator_id`=`c`.`id`
                  INNER JOIN `users` `m` ON `a`.`last_modified_id`=`m`.`id`
                  LEFT JOIN `subjects` `s1` ON `a`.`cts_ben`=`s1`.`id`
                  LEFT JOIN `subjects` `s2` ON `a`.`ctr_ben`=`s2`.`id`
                  LEFT JOIN `subjects` `s3` ON `a`.`csl_ben`=`s3`.`id`
                  LEFT JOIN `subjects` `s4` ON `a`.`att_fp_ben`=`s4`.`id`
                WHERE `a`.`valid`=1 AND `a`.`visible`=1 AND `r`.`valid`=1 AND `r`.`visible`=1 AND `t`.`id`=$town_id
                ";
              /* Select queries return a resultset */
              if ($result = mysqli_query($db, $sql)) {
              if(mysqli_num_rows($result)>0) {
                // output data of each row
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) { ?>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">1. Canone gestore contrattualmente previsto, compensivo di IVA:</td><td style="text-align: left;"><?php echo $row['canone_mtn']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">2. Ammontare complessivo del RUOLO TARI previsionale (MTN):</td><td style="text-align: left;"><?php echo $row['tari']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">3. Il Comune percepisce direttamente i ricavi CONAI dalla vendita del materiale riciclabile?</td><td style="text-align: left;"><?php echo $row['conai_chk']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">4. Previsione eventuali ricavi CONAI percepiti dal Comune:</td><td style="text-align: left;"><?php echo $row['conai_val']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left;">5. Ricavi da TARI (attività NON inserite nel perimetro):</td><td style="text-align: left;"><?php echo $row['recupero_tari']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left;">6.  di cui quote fisse:</td><td style="text-align: left;"><?php echo $row['riduzioni_fix']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left;">7.  di cui quote variabili:</td><td style="text-align: left;"><?php echo $row['riduzioni_var']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">8. Canone annuo EFFETTIVAMENTE pagato al gestore come risultante da conto consuntivo:</td><td style="text-align: left;"><?php echo $row['canone_mtr']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">8.a. Sogetto Beneficiario::</td><td style="text-align: left;"><?php echo $row['canone_ben']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">8.b. IVA Pagata:</td><td style="text-align: left;"><?php echo $row['canone_iva']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">9. Il Comune ha pagato dal proprio bilancio i costi CTS relativi al Trattamento e Smaltimento dei rifiuti?</td><td style="text-align: left;"><?php echo $row['cts_chk']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">10. CTS - Costi della attività di trattamento e smaltimento dei rifiuti urbani effettivamente pagato:</td><td style="text-align: left;"><?php echo $row['cts']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">10.a. Sogetto Beneficiario::</td><td style="text-align: left;"><?php echo $row['cts_ben']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">10.b. IVA Pagata:</td><td style="text-align: left;"><?php echo $row['cts_iva']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">11. Il Comune ha pagato dal proprio bilancio i costi CTR relativi al Trattamento e Riciclo dei rifiuti?</td><td style="text-align: left;"><?php echo $row['ctr_chk']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">12. CTR - Costi della  attività di trattamento e recupero dei rifiuti urbani effettivamente pagato:</td><td style="text-align: left;"><?php echo $row['ctr']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">12.a. Sogetto Beneficiario::</td><td style="text-align: left;"><?php echo $row['ctr_ben']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">12.b. IVA Pagata:</td><td style="text-align: left;"><?php echo $row['ctr_iva']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">13. Il Comune ha pagato dal proprio bilancio TUTTI o PARTE dei costi CSL relativi allo Spazzamento e Lavaggio delle strade?</td><td style="text-align: left;"><?php echo $row['csl_chk']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">14. CSL - Costi delle attività di spazzamento e lavaggio:</td><td style="text-align: left;"><?php echo $row['csl']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">14.a. Sogetto Beneficiario::</td><td style="text-align: left;"><?php echo $row['csl_ben']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">14.b. IVA Pagata:</td><td style="text-align: left;"><?php echo $row['csl_iva']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">15. Detrazioni di cui all'art. 1.4 della Determina ARERA 2/2020 - Contributo MIUR:</td><td style="text-align: left;"><?php echo $row['miur_eff']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left;">16. Importo riferito alle eventuali attività esterne ciclo integrato RU:</td><td style="text-align: left;"><?php echo $row['att_fp']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left;">16.a. Sogetto Beneficiario:</td><td style="text-align: left;"><?php echo $row['att_fp_ben']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left;">16.b. IVA Pagata:</td><td style="text-align: left;"><?php echo $row['att_fp_iva']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">17. Entrate effettivamente conseguite a seguito dell’attività di recupero dell'evasione:</td><td style="text-align: left;"><?php echo $row['ent_ev']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red; border-bottom: 1px solid black">18. Ricavi da CONAI effettivamente conseguiti dal comune:</td><td style="text-align: left; border-bottom: 1px solid black;"><?php echo $row['conai_ric']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold;">Data Creazione: <?php echo $row['create_date']; ?></td><td style="font-weight: bold; text-align: left;">Account: <?php echo $row['creator']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; border-bottom: 1px solid black;">Data Ultima Modifica: <?php echo $row['last_modified_date']; ?></td><td style="font-weight: bold; text-align: left; border-bottom: 1px solid black;">Account: <?php echo $row['modifier']; ?></td></tr>
                <?php
                  }
                }
              }
            ?>
          </tbody>
        </table>
      </p>
      <br>
      <!-- B. DATI PREVISIONALI 2021 -->
      <p>
        <table id="form_b" width="100%">
          <thead>
            <tr>
              <th width="50%" hidden></th>
              <th width="50%" hidden></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="100%" class="send">
                <h4 style="color:<?php echo $mtr; ?>">B. DATI PREVISIONALI 2021</h4>
              </td>
            </tr>
            <tr>
              <td class="fld">Descrizione</td>
              <td class="fld">Valore</td>
            </tr>
            <?php
                //build query
              $sql = "
                SELECT `a`.`completed`,
                  `a`.`miur`,
                  `a`.`rec_eva`,
                  `a`.`proc_sanz`,
                  `a`.`part_ent_comp`,
                  `a`.`coitv`,
                  `a`.`coitf`,
                  `a`.`covtv`,
                  `a`.`covtf`,
                  `a`.`costv`,
                  `c`.`email` `creator`,
                  `a`.`create_date`,
                  `m`.`email` `modifier`,
                  `a`.`last_modified_date`
                FROM `reports` `r`
                  INNER JOIN `mtr` `a` ON `r`.`id`=`a`.`report_id`
                  INNER JOIN `towns` `t` ON `r`.`id_town`=`t`.`id`
                  INNER JOIN `users` `c` ON `a`.`user_creator_id`=`c`.`id`
                  INNER JOIN `users` `m` ON `a`.`last_modified_id`=`m`.`id`
                WHERE `a`.`valid`=1 AND `a`.`visible`=1 AND `r`.`valid`=1 AND `r`.`visible`=1 AND `t`.`id`=$town_id
                ";
              /* Select queries return a resultset */
              if ($result = mysqli_query($db, $sql)) {
              if(mysqli_num_rows($result)>0) {
                // output data of each row
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) { ?>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">1. Contributo del MIUR per le istituzioni scolastiche statali ai sensi dell’articolo 33 bis del decreto-legge 248/07:</td><td style="text-align: left;"><?php echo $row['miur']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">2. Previsione di entrate da conseguire a seguito dell’attività di recupero dell'evasione:</td><td style="text-align: left;"><?php echo $row['rec_eva']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">3. Entrate derivanti da procedure sanzionatorie:</td><td style="text-align: left;"><?php echo $row['proc_sanz']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">4. Ulteriori partite approvate dall’Ente territorialmente competente:</td><td style="text-align: left;"><?php echo $row['part_ent_comp']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left;">5. COITV:</td><td style="text-align: left;"><?php echo $row['coitv']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left;">6. COITF:</td><td style="text-align: left;"><?php echo $row['coitf']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left;">7. COVTV:</td><td style="text-align: left;"><?php echo $row['covtv']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left;">8. COVTF:</td><td style="text-align: left;"><?php echo $row['covtf']; ?></td></tr>
                  <tr><td style="text-align: left; border-bottom: 1px solid black;">9. COSTV:</td><td style="text-align: left; border-bottom: 1px solid black;"><?php echo $row['costv']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold;">Data Creazione: <?php echo $row['create_date']; ?></td><td style="font-weight: bold; text-align: left;">Account: <?php echo $row['creator']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; border-bottom: 1px solid black;">Data Ultima Modifica: <?php echo $row['last_modified_date']; ?></td><td style="font-weight: bold; text-align: left; border-bottom: 1px solid black;">Account: <?php echo $row['modifier']; ?></td></tr>
                <?php
                  }
                }
              }
            ?>
          </tbody>
        </table>
      </p>
      <br>
      <!-- C. ALTRI DATI -->
      <p>
        <table id="form_c" width="100%">
          <thead>
            <tr>
              <th width="50%" hidden></th>
              <th width="50%" hidden></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="100%" class="send">
                <h4 style="color:<?php echo $invio; ?>">C. ALTRI DATI</h4>
              </td>
            </tr>
            <tr>
              <td class="fld">Descrizione</td>
              <td class="fld">Valore</td>
            </tr>
            <?php
                //build query
              $sql = "
                SELECT `a`.`completed`,
                  CASE `a`.`cura_italia` WHEN 0 THEN 'NO' ELSE 'SI' END AS `cura_italia`,
                  `a`.`pef2020_appr_file`,
                  `a`.`tar2020_date`,
                  `a`.`appalto_date`,
                   CASE `a`.`bil_amm` WHEN 0 THEN 'NO' ELSE 'SI' END AS `bil_amm`,
                   CASE `a`.`bil_lav` WHEN 0 THEN 'NO' ELSE 'SI' END AS `bil_lav`,
                  `a`.`pef2018_comune_file`,
                  `a`.`pef2019_comune_file`,
                  `a`.`pef2020_comune_file`,
                  `a`.`pef2018_gestore_file`,
                  `a`.`pef2019_gestore_file`,
                  `a`.`pef2020_gestore_file`,
                  `c`.`email` `creator`,
                  `a`.`create_date`,
                  `m`.`email` `modifier`,
                  `a`.`last_modified_date`
                FROM `reports` `r`
                  INNER JOIN `invio` `a` ON `r`.`id`=`a`.`report_id`
                  INNER JOIN `towns` `t` ON `r`.`id_town`=`t`.`id`
                  INNER JOIN `users` `c` ON `a`.`user_creator_id`=`c`.`id`
                  INNER JOIN `users` `m` ON `a`.`last_modified_id`=`m`.`id`
                WHERE `a`.`valid`=1 AND `a`.`visible`=1 AND `r`.`valid`=1 AND `r`.`visible`=1 AND `t`.`id`=$town_id
                ";
              /* Select queries return a resultset */
              if ($result = mysqli_query($db, $sql)) {
              if(mysqli_num_rows($result)>0) {
                // output data of each row
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) { ?>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">1. Per il 2020 il Comune ha usufruito della deroga ex art 107 c.5 d.l. 18/20 Cura Italia?</td><td style="text-align: left;"><?php echo $row['cura_italia']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">2. File esito approvazione PEF 2020 da ETC (Ager):</td><td style="text-align: left;"><a href="../uploads/<?php echo $town_id; ?>/<?php echo $row['pef2020_appr_file']; ?>" class="link-primary" target="_blank"><?php echo $row['pef2020_appr_file']; ?></a></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">3. Data della delibera tariffaria comunale relativa al 2020:</td><td style="text-align: left;"><?php echo $row['tar2020_date']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">4. Data di inizio dell'appalto RSU nell'attuale configurazione:</td><td style="text-align: left;"><?php echo $row['tar2020_date']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">5. Nel bilancio comunale sono presenti dei cespiti ammortizzabili (impianti, attrezzature, etc.)?</td><td style="text-align: left;"><?php echo $row['bil_amm']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">6. Nel bilancio comunale sono presenti lavori in corso (es. realizzazione isola ecologica)?</td><td style="text-align: left;"><?php echo $row['bil_lav']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">7. File PEF COMUNE 2018:</td><td style="text-align: left;"><a href="../uploads/<?php echo $town_id; ?>/<?php echo $row['pef2018_comune_file']; ?>" class="link-primary" target="_blank"><?php echo $row['pef2018_comune_file']; ?></a></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">8. File PEF COMUNE 2019:</td><td style="text-align: left;"><a href="../uploads/<?php echo $town_id; ?>/<?php echo $row['pef2019_comune_file']; ?>" class="link-primary" target="_blank"><?php echo $row['pef2019_comune_file']; ?></a></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">9. File PEF COMUNE 2020:</td><td style="text-align: left;"><a href="../uploads/<?php echo $town_id; ?>/<?php echo $row['pef2020_comune_file']; ?>" class="link-primary" target="_blank"><?php echo $row['pef2020_comune_file']; ?></a></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">10. File PEF GESTORE 2018:</td><td style="text-align: left;"><a href="../uploads/<?php echo $town_id; ?>/<?php echo $row['pef2018_gestore_file']; ?>" class="link-primary" target="_blank"><?php echo $row['pef2018_gestore_file']; ?></a></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; color: red;">11. File PEF GESTORE 2019:</td><td style="text-align: left;"><a href="../uploads/<?php echo $town_id; ?>/<?php echo $row['pef2019_gestore_file']; ?>" class="link-primary" target="_blank"><?php echo $row['pef2019_gestore_file']; ?></a></td></tr>
                  <tr><td style="text-align: left; border-bottom: 1px solid black; font-weight: bold; color: red;">12. File PEF GESTORE 2020:</td><td style="text-align: left; border-bottom: 1px solid black;"><a href="../uploads/<?php echo $town_id; ?>/<?php echo $row['pef2020_gestore_file']; ?>" class="link-primary" target="_blank"><?php echo $row['pef2020_gestore_file']; ?></a></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold;">Data Creazione: <?php echo $row['create_date']; ?></td><td style="font-weight: bold; text-align: left;">Account: <?php echo $row['creator']; ?></td></tr>
                  <tr><td class="rec" style="text-align: left; font-weight: bold; border-bottom: 1px solid black;">Data Ultima Modifica: <?php echo $row['last_modified_date']; ?></td><td style="font-weight: bold; text-align: left; border-bottom: 1px solid black;">Account: <?php echo $row['modifier']; ?></td></tr>
                <?php
                  }
                }
              }
            ?>
          </tbody>
        </table>
      </p>
      <br>
      <!-- D. TAVOLA DI INPUT DELL'ANNO 2017 -->
      <p>
        <table id="form_d" width="100%">
          <thead>
            <tr>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
           </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="100%" class="send">
                <h4 style="color:<?php echo $input2017; ?>">D. TAVOLA DI INPUT DELL'ANNO 2017</h4>
              </td>
            </tr>
            <tr style="text-align:center;">
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Account</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Data Inserimento</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold; color: red;'>Anno</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Capitolo</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold; color: red;'>Certificato</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Piano Conti</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Descrizione</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Impegno</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>TARI%</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>PEF Lordo</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold; color: red;'>Tipo di costo</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold; color: red;'>IVA%</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold; color: red;'>Voce Bilancio</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold; color: red;'>Gestione</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Netto</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>IVA</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Note</span></td>
            </tr>
            <?php
            $sql = "
                    SELECT `u`.`email`,
                      `i`.* 
                    FROM `input` `i` 
                      INNER JOIN `reports` `r` ON `i`.`report_id`=`r`.`id` 
                      INNER JOIN `towns` `t` ON `r`.`id_town`=`t`.`id` 
                      INNER JOIN `users` `u` ON `i`.`user_creator_id`=`u`.`id` 
                    WHERE `year`=2017 AND `t`.`id`=$town_id
                    ";
            $res = mysqli_query($db, $sql);
            if (mysqli_num_rows($res) > 0) {
              // output data of each row
              while($row = mysqli_fetch_assoc($res)) {
              ?><tr>
                <td style="text-align:center"> <?php echo $row["email"]; ?></td>
                <td style="text-align:center"> <?php echo $row["create_date"]; ?></td>
                <td style="text-align:center"> <?php echo $row["year"]; ?></td>
                <td style="text-align:center"> <?php echo $row["capitolo"]; ?></td>
                <td style="text-align:center"> <?php echo $row["certificato"]; ?></td>
                <td style="text-align:center"> <?php echo $row["conto"]; ?></td>
                <td style="text-align:center"> <?php echo $row["descrizione"]; ?></td>
                <td style="text-align:center"> <?php echo $row["impegno"]; ?></td>
                <td style="text-align:center"> <?php echo $row["ptari"]; ?></td>
                <td style="text-align:center"> <?php echo $row["pef"]; ?></td>
                <td style="text-align:center"> <?php echo $row["costo"]; ?></td>
                <td style="text-align:center"> <?php echo $row["piva"]; ?></td>
                <td style="text-align:center"> <?php echo $row["bilancio"]; ?></td>
                <td style="text-align:center"> <?php echo $row["gestione"]; ?></td>
                <td style="text-align:center"> <?php echo $row["netto"]; ?></td>
                <td style="text-align:center"> <?php echo $row["iva"]; ?></td>
                <td style="text-align:center"> <?php echo $row["note"]; ?></td>
              </tr><?php
              }
            } else {
              echo '<a style="margin:10px">0 results</a>';
            }
            ?>
          </tbody>
        </table>
      </p>
      <br>
      <!-- E. TAVOLA DI INPUT DELL'ANNO 2019 -->
      <p>
        <table id="form_e" width="100%">
          <thead>
            <tr>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
              <th width="6.6%" hidden></th>
           </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="100%" class="send">
                <h4 style="color:<?php echo $input2019; ?>">E. TAVOLA DI INPUT DELL'ANNO 2019</h4>
              </td>
            </tr>
            <tr style="text-align:center;">
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Account</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Data Inserimento</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold; color: red;'>Anno</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Capitolo</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold; color: red;'>Certificato</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Piano Conti</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Descrizione</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Impegno</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>TARI%</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>PEF Lordo</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold; color: red;'>Tipo di costo</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold; color: red;'>IVA%</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold; color: red;'>Voce Bilancio</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold; color: red;'>Gestione</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Netto</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>IVA</span></td>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Note</span></td>
            </tr>
            <?php
            $sql = "
                    SELECT `u`.`email`,
                      `i`.* 
                    FROM `input` `i` 
                      INNER JOIN `reports` `r` ON `i`.`report_id`=`r`.`id` 
                      INNER JOIN `towns` `t` ON `r`.`id_town`=`t`.`id` 
                      INNER JOIN `users` `u` ON `i`.`user_creator_id`=`u`.`id` 
                    WHERE `year`=2019 AND `t`.`id`=$town_id
                    ";
            $res = mysqli_query($db, $sql);
            if (mysqli_num_rows($res) > 0) {
              // output data of each row
              while($row = mysqli_fetch_assoc($res)) {
              ?><tr>
                <td style="text-align:center"> <?php echo $row["email"]; ?></td>
                <td style="text-align:center"> <?php echo $row["create_date"]; ?></td>
                <td style="text-align:center"> <?php echo $row["year"]; ?></td>
                <td style="text-align:center"> <?php echo $row["capitolo"]; ?></td>
                <td style="text-align:center"> <?php echo $row["certificato"]; ?></td>
                <td style="text-align:center"> <?php echo $row["conto"]; ?></td>
                <td style="text-align:center"> <?php echo $row["descrizione"]; ?></td>
                <td style="text-align:center"> <?php echo $row["impegno"]; ?></td>
                <td style="text-align:center"> <?php echo $row["ptari"]; ?></td>
                <td style="text-align:center"> <?php echo $row["pef"]; ?></td>
                <td style="text-align:center"> <?php echo $row["costo"]; ?></td>
                <td style="text-align:center"> <?php echo $row["piva"]; ?></td>
                <td style="text-align:center"> <?php echo $row["bilancio"]; ?></td>
                <td style="text-align:center"> <?php echo $row["gestione"]; ?></td>
                <td style="text-align:center"> <?php echo $row["netto"]; ?></td>
                <td style="text-align:center"> <?php echo $row["iva"]; ?></td>
                <td style="text-align:center"> <?php echo $row["note"]; ?></td>
              </tr><?php
              }
            } else {
              echo '<a style="margin:10px">0 results</a>';
            }
            ?>
          </tbody>
        </table>
      </p>
      <br>
      <!-- F. TAVOLA EXTRA COSTI DELL' ANNO 2021  -->
      <p>
        <table id="form_f" width="100%">
          <thead>
            <tr style="width:80%">
              <th width="8%" hidden></th>
              <th width="8%" hidden></th>
              <th width="8%" hidden></th>
              <th width="8%" hidden></th>
              <th width="8%" hidden></th>
              <th width="8%" hidden></th>
              <th width="8%" hidden></th>
              <th width="8%" hidden></th>
              <th width="8%" hidden></th>
              <th width="8%" hidden></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="100%" class="send">
                <h4 style="color:<?php echo $extra; ?>">F. TAVOLA EXTRA COSTI DELL' ANNO 2021</h4>
              </td>
            </tr>
            <tr style="text-align:center;">
              <td class="editCellHead"><span style="font-size: 12px; font-weight: bold;">Account</span></td>
              <td class="editCellHead"><span style="font-size: 12px; font-weight: bold;">Data Inserimento</span></td>
              <td class="editCellHead"><span style="font-size: 12px; font-weight: bold;">Soggetto</td>
              <td class="editCellHead"><span style="font-size: 12px; font-weight: bold; color: red;">Tipologia</td>
              <td class="editCellHead"><span style="font-size: 12px; font-weight: bold; color: red;">Codice</td>
              <td class="editCellHead"><span style="font-size: 12px; font-weight: bold;">Quantitativi 2019</td>
              <td class="editCellHead"><span style="font-size: 12px; font-weight: bold;">Prezzo 2019</td>
              <td class="editCellHead"><span style="font-size: 12px; font-weight: bold;">Quantitativi 2020</td>
              <td class="editCellHead"><span style="font-size: 12px; font-weight: bold;">Prezzo 2020</td>
              <td class="editCellHead"><span style="font-size: 12px; font-weight: bold;">Prezzo 2021</td>
              <td class="editCellHead"><span style="font-size: 12px; font-weight: bold;">Stima smaltimento 2019/2021</td>
              <td class="editCellHead"><span style="font-size: 12px; font-weight: bold;">Stima smaltimento 2020/2021</td>
            </tr>
            <?php
            $sql = "
                    SELECT `u`.`email`,
                      `e`.* 
                    FROM `extra` `e` 
                      INNER JOIN `reports` `r` ON `e`.`report_id`=`r`.`id` 
                      INNER JOIN `towns` `t` ON `r`.`id_town`=`t`.`id` 
                      INNER JOIN `users` `u` ON `e`.`user_creator_id`=`u`.`id` 
                    WHERE `t`.`id`=$town_id
                    ";
            $res = mysqli_query($db, $sql);
            if (mysqli_num_rows($res) > 0) {
              // output data of each row
              while($row = mysqli_fetch_assoc($res)) {
              ?><tr>
                <td style="text-align:center"> <?php echo $row["email"]; ?></td>
                <td style="text-align:center"> <?php echo $row["create_date"]; ?></td>
                <td style="text-align:center"> <?php echo $row["soggetto"]; ?></td>
                <td style="text-align:center"> <?php echo $row["tipologia"]; ?></td>
                <td style="text-align:center"> <?php echo $row["codice"]; ?></td>
                <td style="text-align:center"> <?php echo $row["q2019"]; ?></td>
                <td style="text-align:center"> <?php echo $row["p2019"]; ?></td>
                <td style="text-align:center"> <?php echo $row["q2020"]; ?></td>
                <td style="text-align:center"> <?php echo $row["p2020"]; ?></td>
                <td style="text-align:center"> <?php echo $row["p2021"]; ?></td>
                <td style="text-align:center"> <?php echo $row["s2019"]; ?></td>
                <td style="text-align:center"> <?php echo $row["s2020"]; ?></td>
              </tr><?php
              }
            } else {
              echo '<a style="margin:10px">0 results</a>';
            }
            ?>
          </tbody>
        </table>
      </p>
      <?php //include('xlsx_export.php'); ?>
      <form id="export" name="export" method="GET" action="./xlsx_export.php">
        <input id="town_id" name="town_id" type="number" value="<?php echo $town_id; ?>" hidden></input>
        <input id="getExcel" name="getExcel" type="submit" value="Download Excel File"></input>
      </form>
      <!--<a href="./xlsx-sheets.xslx" class="link-primary" target="_blank">Download Excel File</a>-->
      <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
      <script type="text/javascript" src="../js/scripts.js"></script>
    </div>
  </body>
</html>

<?php
//  /* free result set */
mysqli_free_result($result);
?>