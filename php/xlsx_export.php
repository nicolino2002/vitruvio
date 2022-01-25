<?php
$town_id = trim($_GET['town_id']); 
//set_include_path(get_include_path().PATH_SEPARATOR."..");
include('config.php');
include_once("xlsxwriter.class.php");
//export filename
$filename = '../uploads/'.$town_id.'/pef_export.xlsx';
$writer = new XLSXWriter();

//  ******** mysql => xlsxwriter field type mapping ********
function gFldType($mysql_fld) {
switch ($mysql_fld) {
  case 1: return "integer"; break;
  case 2: return "integer"; break;
  case 3: return "integer"; break;
  case 4: return "price"; break;
  case 5: return "price"; break;
  case 7: return "datetime"; break;
  case 8: return "integer"; break;
  case 9: return "integer"; break;
  case 10: return "date"; break;
  case 11: return "time"; break;
  case 12: return "datetime"; break;
  case 13: return "integer"; break;
  case 16: return "integer"; break;
  case 246: return "price"; break;
  case 252: return "string"; break;
  case 253: return "string"; break;
  case 254: return "string"; break;
  default: return "string";
  }
}
//  ******** sheet1: UTENTI ********
$sName = "UTENTI";
$sql = "
  SELECT `name` `Nome`,
    `surname` `Cognome`,
    `act_date` `Attivo dal`,
    `tel` `Telefono`,
    `email` `Account (email)`,
    `mail2` `Altra email`
  FROM `users` WHERE `valid`=1 AND `visible`=1 AND `town_id`=$town_id
  ";
if ($result = mysqli_query($db, $sql)) {
  if(mysqli_num_rows($result)>0) {
    $header=array();
    while($row = mysqli_fetch_field($result)){
      $header[$row->name]=gFldType($row->type);
    }
    $data = mysqli_fetch_all($result);
  }
}
//save sheet data
$writer->writeSheetHeader($sName, $header);
foreach($data as $row)
  $writer->writeSheetRow($sName, $row);

//  ******** sheet2: EVENTI ********
$sName = "EVENTI";
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
if ($result = mysqli_query($db, $sql)) {
  if(mysqli_num_rows($result)>0) {
    $header=array();
    while($row = mysqli_fetch_field($result)){
      $header[$row->name]=gFldType($row->type);
    }
    $data = mysqli_fetch_all($result);
  }
}
//save sheet data
$writer->writeSheetHeader($sName, $header);
foreach($data as $row)
  $writer->writeSheetRow($sName, $row);

//  ******** sheet3: A. DATI 2019 ********
$sName = "A. DATI 2019";
$sql = "
   SELECT `a`.`completed`, 
     `a`.`canone_mtn`,
     `a`.`tari`,
      CASE WHEN `a`.`conai_chk`=0 THEN 'NO' ELSE 'SI' END AS `conai_chk`,
     `a`.`conai_val`,
     CASE WHEN `a`.`conai_ctr_chk`=0 THEN 'NO' ELSE 'SI' END AS `conai_ctr_chk`,
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
if ($result = mysqli_query($db, $sql)) {
  if(mysqli_num_rows($result)>0) {
    $data_tmp = mysqli_fetch_all($result);
  }
}

$header = array(
    'Campo'=>'string',
    'Valore'=>'string',
);
$data = array(
    array('1. Canone gestore contrattualmente previsto, compensivo di IVA:',$data_tmp[0][1]),
    array('2. Ammontare complessivo del RUOLO TARI previsionale (MTN):',$data_tmp[0][2]),
    array('3. Il Comune percepisce direttamente i ricavi CONAI dalla vendita del materiale riciclabile?',$data_tmp[0][3]),
    array('4. Previsione eventuali ricavi CONAI percepiti dal Comune:',$data_tmp[0][4]),
    array('5. Ricavi da TARI (attività NON inserite nel perimetro):',$data_tmp[0][10]),
    array('6. di cui quote fisse:',$data_tmp[0][11]),
    array('7. di cui quote variabili:',$data_tmp[0][12]),
    array('8. Canone annuo EFFETTIVAMENTE pagato al gestore come risultante da conto consuntivo:',$data_tmp[0][13]),
    array('8.a. Sogetto Beneficiario:',$data_tmp[0][14]),
    array('8.b. IVA Pagata:',$data_tmp[0][15]),
    array('9. Il Comune ha pagato dal proprio bilancio i costi CTS relativi al Trattamento e Smaltimento dei rifiuti?',$data_tmp[0][16]),
    array('10. CTS - Costi della attività di trattamento e smaltimento dei rifiuti urbani effettivamente pagato:',$data_tmp[0][17]),
    array('10.a. Sogetto Beneficiario:',$data_tmp[0][18]),
    array('10.b. IVA Pagata:',$data_tmp[0][19]),
    array('11. Il Comune ha pagato dal proprio bilancio i costi CTR relativi al Trattamento e Riciclo dei rifiuti?',$data_tmp[0][20]),
    array('12. CTR - Costi della attività di trattamento e recupero dei rifiuti urbani effettivamente pagato:',$data_tmp[0][21]),
    array('12.a. Sogetto Beneficiario:',$data_tmp[0][22]),
    array('12.b. IVA Pagata:',$data_tmp[0][23]),
    array('13. Il Comune ha pagato dal proprio bilancio TUTTI o PARTE dei costi CSL relativi allo Spazzamento e Lavaggio delle strade?',$data_tmp[0][25]),
    array('14. CSL - Costi delle attività di spazzamento e lavaggio:',$data_tmp[0][26]),
    array('14.a. Sogetto Beneficiario:',$data_tmp[0][27]),
    array('14.b. IVA Pagata:',$data_tmp[0][28]),
    array("15. Detrazioni di cui all'art. 1.4 della Determina ARERA 2/2020 - Contributo MIUR:",$data_tmp[0][29]),
    array('16. Importo riferito alle eventuali attività esterne ciclo integrato RU:',$data_tmp[0][30]),
    array('16.a. Sogetto Beneficiario:',$data_tmp[0][31]),
    array('16.b. IVA Pagata:',$data_tmp[0][32]),
    array('17. Entrate effettivamente conseguite a seguito dell’attività di recupero dell\'evasione:',$data_tmp[0][34]),
    array('18. Ricavi da CONAI effettivamente conseguiti dal comune:',$data_tmp[0][35]),
    array('Data Creazione: '.$data_tmp[0][37],'Account: '.$data_tmp[0][36]),
    array('Data Ultima Modifica: '.$data_tmp[0][39],'Account: '.$data_tmp[0][38]),
);

//save sheet data
$writer->writeSheetHeader($sName, $header);
foreach($data as $row)
  $writer->writeSheetRow($sName, $row);

//  ******** sheet3: B. DATI PREVISIONALI 2021 ********
$sName = "B. DATI PREVISIONALI 2021";
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

if ($result = mysqli_query($db, $sql)) {
  if(mysqli_num_rows($result)>0) {
    $data_tmp = mysqli_fetch_all($result);
  }
}

$header = array(
    'Campo'=>'string',
    'Valore'=>'string',
);
$data = array(
    array('1. Contributo del MIUR per le istituzioni scolastiche statali ai sensi dell’articolo 33 bis del decreto-legge 248/07:',$data_tmp[0][1]),
    array("2. Previsione di entrate da conseguire a seguito dell’attività di recupero dell'evasione:",$data_tmp[0][2]),
    array('3. Entrate derivanti da procedure sanzionatorie:',$data_tmp[0][3]),
    array("4. Ulteriori partite approvate dall’Ente territorialmente competente:",$data_tmp[0][4]),
    array('5. COITV:',$data_tmp[0][5]),
    array('6. COITF:',$data_tmp[0][6]),
    array('7. COVTV:',$data_tmp[0][7]),
    array('8. COVTF:',$data_tmp[0][8]),
    array('8. COSTV:',$data_tmp[0][9]),
    array('Data Creazione: '.$data_tmp[0][11],'Account: '.$data_tmp[0][10]),
    array('Data Ultima Modifica: '.$data_tmp[0][13],'Account: '.$data_tmp[0][12]),
);

//save sheet data
$writer->writeSheetHeader($sName, $header);
foreach($data as $row)
  $writer->writeSheetRow($sName, $row);

//  ******** sheet4: C. ALTRI DATI ********
$sName = "C. ALTRI DATI";
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

if ($result = mysqli_query($db, $sql)) {
  if(mysqli_num_rows($result)>0) {
    $data_tmp = mysqli_fetch_all($result);
  }
}

$header = array(
    'Campo'=>'string',
    'Valore'=>'string',
);
$data = array(
    array('1. Per il 2020 il Comune ha usufruito della deroga ex art 107 c.5 d.l. 18/20 Cura Italia?',$data_tmp[0][1]),
    array('2. File esito approvazione PEF 2020 da ETC (Ager):',$data_tmp[0][2]),
    array('3. Data della delibera tariffaria comunale relativa al 2020:',$data_tmp[0][3]),
    array("4. Data di inizio dell'appalto RSU nell'attuale configurazione:",$data_tmp[0][4]),
    array('5. Nel bilancio comunale sono presenti dei cespiti ammortizzabili (impianti, attrezzature, etc.)?',$data_tmp[0][5]),
    array('6. Nel bilancio comunale sono presenti lavori in corso (es. realizzazione isola ecologica)?',$data_tmp[0][6]),
    array('7. File PEF COMUNE 2018:',$data_tmp[0][7]),
    array('8. File PEF COMUNE 2019:',$data_tmp[0][8]),
    array('9. File PEF COMUNE 2020:',$data_tmp[0][9]),
    array('10. File PEF GESTORE 2018:',$data_tmp[0][10]),
    array('11. File PEF GESTORE 2019:',$data_tmp[0][11]),
    array('12. File PEF GESTORE 2020:',$data_tmp[0][12]),
    array('Data Creazione: '.$data_tmp[0][14],'Account: '.$data_tmp[0][13]),
    array('Data Ultima Modifica: '.$data_tmp[0][16],'Account: '.$data_tmp[0][15]),
);

//save sheet data
$writer->writeSheetHeader($sName, $header);
foreach($data as $row)
  $writer->writeSheetRow($sName, $row);


//  ******** sheet5: D. TAVOLA DI INPUT DELL'ANNO 2017 ********
$sName = "D. TAVOLA DI INPUT 2017";
$sql = "
  SELECT `u`.`email`,
    `i`.* 
  FROM `input` `i` 
    INNER JOIN `reports` `r` ON `i`.`report_id`=`r`.`id` 
    INNER JOIN `towns` `t` ON `r`.`id_town`=`t`.`id` 
    INNER JOIN `users` `u` ON `i`.`user_creator_id`=`u`.`id` 
  WHERE `year`=2017 AND `t`.`id`=$town_id
  ORDER BY `create_date`
  ";
if ($result = mysqli_query($db, $sql)) {
  if(mysqli_num_rows($result)>0) {
    $header=array();
    while($row = mysqli_fetch_field($result)){
      $header[$row->name]=gFldType($row->type);
    }
    $data = mysqli_fetch_all($result);
  }
}
//save sheet data
$writer->writeSheetHeader($sName, $header);
foreach($data as $row)
  $writer->writeSheetRow($sName, $row);

//  ******** sheet6: E. TAVOLA DI INPUT DELL'ANNO 2019 ********
$sName = "E. TAVOLA DI INPUT 2019";
$sql = "
  SELECT `u`.`email`,
    `i`.* 
  FROM `input` `i` 
    INNER JOIN `reports` `r` ON `i`.`report_id`=`r`.`id` 
    INNER JOIN `towns` `t` ON `r`.`id_town`=`t`.`id` 
    INNER JOIN `users` `u` ON `i`.`user_creator_id`=`u`.`id` 
  WHERE `year`=2019 AND `t`.`id`=$town_id
  ORDER BY `create_date`
  ";
if ($result = mysqli_query($db, $sql)) {
  if(mysqli_num_rows($result)>0) {
    $header=array();
    while($row = mysqli_fetch_field($result)){
      $header[$row->name]=gFldType($row->type);
    }
    $data = mysqli_fetch_all($result);
  }
}
//save sheet data
$writer->writeSheetHeader($sName, $header);
foreach($data as $row)
  $writer->writeSheetRow($sName, $row);
  
//  ******** sheet7: F. TAVOLA EXTRA COSTI DELL' ANNO 2021 ********
$sName = "F. TAVOLA EXTRA COSTI 2021";
$sql = "
  SELECT `u`.`email`,
    `e`.* 
  FROM `extra` `e` 
    INNER JOIN `reports` `r` ON `e`.`report_id`=`r`.`id` 
    INNER JOIN `towns` `t` ON `r`.`id_town`=`t`.`id` 
    INNER JOIN `users` `u` ON `e`.`user_creator_id`=`u`.`id` 
  WHERE `t`.`id`=$town_id
  ORDER BY `create_date`
  ";
if ($result = mysqli_query($db, $sql)) {
  if(mysqli_num_rows($result)>0) {
    $header=array();
    while($row = mysqli_fetch_field($result)){
      $header[$row->name]=gFldType($row->type);
    }
    $data = mysqli_fetch_all($result);
  }
}
//save sheet data
$writer->writeSheetHeader($sName, $header);
foreach($data as $row)
  $writer->writeSheetRow($sName, $row);
  
//empty msqli
mysqli_free_result($result);
mysqli_close($db);

//Save File
$writer->writeToFile($filename);
//$writer->writeToStdOut();
//echo $writer->writeToString();

//export file
if(file_exists($filename)) {
  //Define header information
  header('Content-Description: File Transfer');
  header('Content-Type: application/octet-stream');
  header("Cache-Control: no-cache, must-revalidate");
  header("Expires: 0");
  header('Content-Disposition: attachment; filename="'.basename($filename).'"');
  header('Content-Length: ' . filesize($filename));
  header('Pragma: public');
  //Clear system output buffer
  flush();
  //Read the size of the file
  readfile($filename);
  //Terminate from the script
  die();
} else {
  echo "File does not exist.";
}
//come back to previous page
echo '<script>window.history.go(-1);</script>';
exit(0);
?>

