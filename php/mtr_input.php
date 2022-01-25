<?php
      //include('session.php');
      // Retrieve data from html

      $report_id = trim($_GET['report_id']);
      $username = trim($_GET['username']);
      $year = trim($_GET['year']);
      $account = trim($_GET['account']);
      $town = trim($_GET['town']);
      $title = trim($_GET['title']);
      $fy = date('Y');
      // Retrieve data from table
      include('config.php');
      // get user id
      $sql = "SELECT `id` FROM `users` WHERE `email`= '$account'";
      $ses_sql = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
      $user_id = $row['id'];


      // get mtr report record data
      $sql = "SELECT * FROM `mtr` WHERE `report_id`= $report_id AND `year`=2020";
      $ses_sql = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
      $mtr_id = $row['id'];
      $mtr_report_id = $row['report_id'];
      $mtr_completed = $row['completed'];
      $mtr_year = $row['year'];
      $mtr_user_creator_id = $row['user_creator_id'];
      $mtr_create_date = $row['create_date'];
      $mtr_last_modified_id = $row['last_modified_id'];
      $mtr_last_modified_date = $row['last_modified_date'];


      $tari2020 =  $row['tari'];
      $ricavi_mat2020 =  $row['ricavi_mat'];
      $ricavi_ener2020 =  $row['ricavi_ener'];
      $ricavi_inc_ener2020 =  $row['ricavi_inc_ener'];
      $miur2020 =  $row['miur'];
      $rec_evasione2020 =  $row['rec_evasione'];
      $sanzioni2020 =  $row['sanzioni'];
      $ricavi_fp2020 =  $row['ricavi_fp'];
      $fp_fisse2020 =  $row['fp_fisse'];
      $fp_var2020 =  $row['fp_var'];
      $altre_entrate2020 =  $row['altre_entrate'];
      $note2020 =  $row['note'];
      $fondi_admin2020=$row['fondi_admin'];
      $fondi_qui2020=$row['fondi_qui'];
      $fondi_oneri2020=$row['fondi_oneri'];
      $fondi_crediti2020=$row['fondi_crediti'];
      $fondi_tasse2020=$row['fondi_tasse'];
      $fondi_post_mortem2020=$row['fondi_post_mortem'];
      $fondi_terzi2020=$row['fondi_terzi'];


      $sql = "SELECT * FROM `mtr` WHERE `report_id`= $report_id AND `year`=2021";
      $ses_sql = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
      $mtr_id2 = $row['id'];
      $tari2021 =  $row['tari'];
      $ricavi_mat2021 =  $row['ricavi_mat'];
      $ricavi_ener2021 =  $row['ricavi_ener'];
      $ricavi_inc_ener2021 =  $row['ricavi_inc_ener'];
      $miur2021 =  $row['miur'];
      $rec_evasione2021 =  $row['rec_evasione'];
      $sanzioni2021 =  $row['sanzioni'];
      $ricavi_fp2021 =  $row['ricavi_fp'];
      $fp_fisse2021 =  $row['fp_fisse'];
      $fp_var2021 =  $row['fp_var'];
      $altre_entrate2021 =  $row['altre_entrate'];
      $note2021 =  $row['note'];
      $fondi_admin2021=$row['fondi_admin'];
      $fondi_qui2021=$row['fondi_qui'];
      $fondi_oneri2021=$row['fondi_oneri'];
      $fondi_crediti2021=$row['fondi_crediti'];
      $fondi_tasse2021=$row['fondi_tasse'];
      $fondi_post_mortem2021=$row['fondi_post_mortem'];
      $fondi_terzi2021=$row['fondi_terzi'];

      $mtr_valid = $row['valid'];
      $mtr_visible = $row['visible'];

   /* close connection */
   mysqli_close($db);
?>
<?php
      $radius=
      "border-radius:10px";
?>
<html>
   <head>
      <title>MTR Template ver. 1.0</title>

          <style media="screen">
          .container-fluid
          {
            background-color: white;
          }

          #help.btn
          {
            color: white;
            background-color: #044e8f;
            max-width: 100%;
            border-radius: 20px;
            float: right;
          }

          #back.btn
          {
            color: white;
            background-color: #044e8f;
            max-width: 100%;
            border-radius: 20px;
            float: right;
          }

          #logout.btn
          {
            float: right;
            color: #044e8f;
            border: 2px solid #044e8f;
            background-color: white;
            max-width: 100%;
            border-radius: 20px;
          }
          #logout.btn:hover
          {
            color: red;
          }

          .fields
          {
            max-width: 50%;
            margin-right: 30%;
            margin-top: 7px;
            border:20px;
          }


          .auto
          {margin: 10% auto}

          .input-group
          {
            display: inline-block;
          }

          .title
          {
            background-color: red;
          }

          .space
          {
              margin-top: 5px;
              margin-bottom: 5px;
          }
          </style>

          <link href="../css/bootstrap.min.css" rel="stylesheet">
          <link href="../css/colors.css" rel="stylesheet">
          <link href="../js/bootstrap.bundle.min.js">


          <script type="text/javascript" src="../js/bootstrap.min.js"></script>
          <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
          <script type="text/javascript" src="../js/scripts.js"></script>


          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



    </head>

   <body>

     <div class="container-fluid" style="background-color:#f5f5f5">
       <div class="container pt-5 mb-3">
         <div class="row">
           <div class="col-7">
             <h1>B. ACCERTATO E PREVISIONALI</h1>
           </div>
           <div class="col-4 offset-1 text-right">
             <button type="button" class="btn btn-help" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: B.','<?php echo $account;  ?>')" ><a class="text-primary">Help?</a></button>
             <button type="button" class="btn mr-2" id="logout" data-toggle="modal" data-target="#exampleModalCenter">
               Esci
             </button>
             <a href="./welcome.php"><button class="btn mr-2" id="back"  type="submit">Indietro</button></a>
           </div>
         </div>
         <div class="row">
           <div class="col-12">
             <h5 class="text-red">I campi in rosso sono obbligatori</h5>
           </div>
         </div>
       </div>

       <form  action="./mtr_save.php" method = "post">

         <div class="container">
             <div class="row">
               <input type="number" id="report_id" name = "report_id" value="<?php echo $report_id; ?>" hidden></input>
               <input type="number" id="user_id" name = "user_id" value="<?php echo $user_id; ?>" hidden></input>
               <input type="number" id="mtr_id" name = "mtr_id" value="<?php echo $mtr_id; ?>" hidden></input>
               <input type="number" id="mtr_id2" name = "mtr_id2" value="<?php echo $mtr_id2; ?>" hidden></input>

               <div class="col-12 bg-theme rounded" >
                 <h3 class="text-light m-4 text-uppercase"> Entrate accertate a bilancio:</h3>
               </div>

               <!--<input id="help" class="btn" type="button" value="Help" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: B. PREVISIONALI 2021, Campo: 1. Contributo MIUR.','
               <?php //echo $account; ?>
               ')">-->

               <?php $index=1;?>
                  <div class="col-sm-12 col-xl-12 p-4 border">
                    <label class="text-red font-weight-bold"><?php echo $index;$index++; ?>. Importo TARI</label>
                    <div class="input-group">
                      <input  type="number" step="0.01"  min="0" class="form-control w-50"
                       id="tari2020" name="tari2020" onchange="mtr_submit_chk();" placeholder="Anno 2020" value="<?php if($tari2020) echo $tari2020; ?>" autofocus required>
                      </input>
                      <input  type="number" step="0.01"  min="0" class="form-control w-50"
                       id="tari2021" name="tari2021" onchange="mtr_submit_chk();" placeholder="Anno 2021" value="<?php if($tari2021) echo $tari2021; ?>" autofocus required>
                      </input>
                    </div>
                    <small class="cap">Inserire l'importo TARI bollettato per le due annalità indicate</small>
                  </div>

                  <div class="col-sm-12 col-xl-4 p-4 border">
                    <label class="text-red font-weight-bold"><?php echo $index; ?>a. Ricavi da vendita di materiale</label>
                    <div class="input-group">
                      <input  type="number" step="0.01"  min="0" class="form-control w-50"
                       id="ricavi_mat2020" name = "ricavi_mat2020" onchange="mtr_submit_chk();" placeholder="Anno 2020" value="<?php  if($ricavi_mat2020!=0) echo $ricavi_mat2020;  ?>"   autofocus required>
                      </input>
                      <input  type="number" step="0.01"  min="0" class="form-control w-50"
                       id="ricavi_mat2021" name = "ricavi_mat2021" onchange="mtr_submit_chk();" placeholder="Anno 2021" value="<?php if($ricavi_mat2021!=0) echo $ricavi_mat2021; ?>"   autofocus required>
                      </input>
                    </div>
                    <small class="cap">Inserire l'importo dei ricavi da vendita di materiale - CONAI e altri (se percepiti dal Comune)  per le due annalità indicate.</small>
                  </div>

                  <div class="col-sm-12 col-xl-4 p-4 border">
                    <label class="text-red font-weight-bold"><?php echo $index; ?>b. Ricavi da vendita di enegia</label>
                    <div class="input-group">
                      <input  type="number" step="0.01"  min="0" class="form-control w-50"
                       id="ricavi_ener2020" name = "ricavi_ener2020" onchange="mtr_submit_chk();" placeholder="Anno 2020" value="<?php if($ricavi_ener2020!=0) echo $ricavi_ener2020; ?>"   autofocus required>
                      </input>
                      <input  type="number" step="0.01"  min="0" class="form-control w-50"
                       id="ricavi_mat2021" name = "ricavi_ener2021" onchange="mtr_submit_chk();" placeholder="Anno 2021" value="<?php if($ricavi_ener2021!=0) echo $ricavi_ener2021; ?>"   autofocus required>
                      </input>
                    </div>
                    <small class="cap">Inserire l'importo dei ricavi da vendita di energia (se percepiti dal Comune)  per le due annalità indicate.</small>
                  </div>

                  <div class="col-sm-12 col-xl-4 p-4 border">
                    <label class="text-red font-weight-bold"><?php echo $index;$index++; ?>c. Ricavi da incentivi all’energia prodotta da fonti rinnovabili (solo la quota parte eventualmente da portare in detrazione)</label>
                    <div class="input-group">
                      <input  type="number" step="0.01"  min="0" class="form-control w-50"
                       id="ricavi_inc_ener2020" name = "ricavi_inc_ener2020" onchange="mtr_submit_chk();" placeholder="Anno 2020" value="<?php if($ricavi_inc_ener2020!=0) echo $ricavi_inc_ener2020; ?>"   autofocus required>
                      </input>
                      <input  type="number" step="0.01"  min="0" class="form-control w-50"
                       id="ricavi_inc_ener2021" name = "ricavi_inc_ener2021" onchange="mtr_submit_chk();" placeholder="Anno 2021" value="<?php if($ricavi_inc_ener2021!=0) echo $ricavi_inc_ener2021; ?>"   autofocus required>
                      </input>
                    </div>
                    <small class="cap">Inserire l'importo dei ricavi da incentivi sulla vendita di energia (se percepiti dal Comune)  per le due annalità indicate.</small>
                  </div>

                  <div class="col-sm-12 col-xl-6 p-4 border">
                    <label class="text-red font-weight-bold"><?php echo $index;$index++; ?>. Contributo MIUR per le istituzioni scolastiche statali ai sensi dell’articolo 33 bis del decreto-legge 248/07</label>
                    <div class="input-group">
                      <input  type="number" step="0.01"  min="0" class="form-control w-50"
                       id="miur2020" name = "miur2020" onchange="mtr_submit_chk();" placeholder="Anno 2020" value="<?php if($miur2020!=0) echo $miur2020; ?>"   autofocus required>
                     </input>
                     <input  type="number" step="0.01"  min="0" class="form-control w-50"
                      id="miur2021" name = "miur2021" onchange="mtr_submit_chk();" placeholder="Anno 2021" value="<?php if($miur2021!=0) echo $miur2021; ?>"   autofocus required>
                    </input>
                    </div>
                    <small class="cap">Inserire l'importo del contributo MIUR per le due annualità indicate</small>
                  </div>

                  <div class="col-sm-12 col-xl-6 p-4 border">
                    <label class="text-red font-weight-bold"><?php echo $index;$index++; ?>. Entrate effettivamente conseguite a seguito dell’attività di recupero dell'evasione</label>
                    <div class="input-group">
                      <input type="number" step="0.01"  min="0" class="form-control w-50"
                       id="rec_evasione2020" name="rec_evasione2020" onchange="mtr_submit_chk();" placeholder="Anno 2020" value="<?php if($rec_evasione2020!=0) echo $rec_evasione2020; ?>"   autofocus required>
                       </input>
                     <input type="number" step="0.01"  min="0" class="form-control w-50"
                        id="rec_evasione2021" name="rec_evasione2021" onchange="mtr_submit_chk();" placeholder="Anno 2021" value="<?php if($rec_evasione2021!=0) echo $rec_evasione2021; ?>"   autofocus required>
                      </input>
                    </div>
                    <small class="cap">Inserire l'importo delle entrate risultanti a bilancio a seguito dell'attività di recupero evasione TARI</small>
                  </div>

                  <div class="col-sm-12 col-xl-12 p-4 border">
                    <label class="text-red font-weight-bold"><?php echo $index;$index++; ?>. Entrate derivanti da procedure sanzionatorie</label>
                    <div class="input-group">
                      <input  type="number" step="0.01"  min="0" class="form-control w-50"
                       id="sanzioni" name = "sanzioni2020" onchange="mtr_submit_chk();" placeholder="Anno 2020" value="<?php if($sanzioni2020!=0) echo $sanzioni2020; ?>"autofocus required>
                     </input>
                     <input  type="number" step="0.01"  min="0" class="form-control w-50"
                      id="sanzioni" name = "sanzioni2021" onchange="mtr_submit_chk();" placeholder="Anno 2021" value="<?php if($sanzioni2021!=0) echo $sanzioni2021; ?>"autofocus required>
                      </input>
                    </div>
                    <small class="cap">Inserire l'importo delle entrate risultanti a bilancio derivanti da procedure sanzionatorie in merito alla TARI</small>
                  </div>

                  <div class="col-sm-12 col-xl-4 p-4 border-bottom border-left">
                    <label class="text-red font-weight-bold"><?php echo $index; ?>a. Ricavi da TARI  per attività NON inserite nel perimetro del ciclo integrato RU</label>
                    <div class="input-group">
                      <input  type="number" step="0.01"  min="0" class="w-50 form-control"
                       id="ricavi_fp2020" name = "ricavi_fp2020" onchange="mtr_submit_chk();" placeholder="Anno 2020" value="<?php if($ricavi_fp2020!=0) echo $ricavi_fp2020; ?>"autofocus required>
                     </input>
                     <input  type="number" step="0.01"  min="0" class="w-50 form-control"
                      id="ricavi_fp2021" name = "ricavi_fp2021" onchange="mtr_submit_chk();" placeholder="Anno 2021" value="<?php if($ricavi_fp2021!=0) echo $ricavi_fp2021; ?>"autofocus required>
                    </input>
                    </div>
                    <small class="cap">Inserire eventuali ricavi da TARI per attività esterne al ciclo RU</small>
                  </div>

                  <div class="col-sm-12 col-xl-4 p-4 border-bottom">
                    <label class="text-red font-weight-bold"><?php echo $index; ?>b.  di cui quote fisse</label>
                    <div class="input-group">
                      <input  type="number" step="0.01"  min="0" class="w-50 form-control"
                       id="fp_fisse2020" name = "fp_fisse2020" onchange="mtr_submit_chk();" placeholder="Anno 2020" value="<?php if($fp_fisse2020!=0) echo $fp_fisse2020; ?>"autofocus required>
                     </input>
                     <input  type="number" step="0.01"  min="0" class="w-50 form-control"
                      id="fp_fisse2021" name = "fp_fisse2021" onchange="mtr_submit_chk();" placeholder="Anno 2021" value="<?php if($fp_fisse2021!=0) echo $fp_fisse2021; ?>"autofocus required>
                    </input>
                    </div>
                    <small class="cap">Inserire eventuali ricavi da TARI per le quote fisse inerenti le attività esterne al ciclo RU</small>
                  </div>

                  <div class="col-sm-12 col-xl-4 p-4 border-bottom border-right">
                    <label class="text-red font-weight-bold"><?php echo $index;$index++; ?>c. di cui quote variabili</label>
                    <div class="input-group">
                      <input  type="number" step="0.01"  min="0" class="w-50 form-control"
                       id="fp_var2020" name = "fp_var2020" onchange="mtr_submit_chk();" placeholder="Anno 2020" value="<?php if($fp_var2020!=0) echo $fp_var2020; ?>"autofocus required>
                     </input>
                       <input  type="number" step="0.01"  min="0" class="w-50 form-control"
                        id="fp_var2021" name = "fp_var2021" onchange="mtr_submit_chk();" placeholder="Anno 2021" value="<?php if($fp_var2021!=0) echo $fp_var2021; ?>"autofocus required>
                      </input>
                    </div>
                    <small class="cap">Inserire eventuali ricavi da TARI per le quote variabili inerenti le attività esterne al ciclo RU</small>
                  </div>

                  <div class="col-sm-12 col-xl-6 p-4 border">
                    <label class="text-red font-weight-bold"><?php echo $index;$index++; ?>. Ulteriori partite approvade dall'Ente territorialmente competente</label>
                    <div class="input-group">
                      <input  type="number" step="0.01"  min="0" class="w-50 form-control"
                       id="altre_entrate2020" name="altre_entrate2020" onchange="mtr_submit_chk();" placeholder="Anno 2020" value="<?php if($altre_entrate2020!=0) echo $altre_entrate2020; ?>"autofocus required>
                     </input>
                     <input  type="number" step="0.01"  min="0" class="w-50 form-control"
                      id="altre_entrate2021" name="altre_entrate2021" onchange="mtr_submit_chk();" placeholder="Anno 2021" value="<?php if($altre_entrate2021!=0) echo $altre_entrate2021; ?>"autofocus required>
                    </input>
                    </div>
                    <small class="cap">Inserire eventuali altre entrate dettagliando nel campo NOTE</small>
                  </div>

                  <div class="col-sm-12 col-xl-6 p-4 border">
                    <label class="text-red font-weight-bold"><?php echo $index;$index++; ?>. Note</label>
                    <div class="input-group">
                      <input  type="text" step="0.01"  min="0" class="w-50 form-control"
                       id="note2020" name ="note2020" onchange="mtr_submit_chk();" placeholder="Note 2020" value="<?php if($note2020!=0) echo $note2020; ?>"autofocus required>
                     </input>
                     <input  type="text" step="0.01"  min="0" class="w-50 form-control"
                      id="note2021" name ="note2021" onchange="mtr_submit_chk();" placeholder="Note 2021" value="<?php if($note2021!=0) echo $note2021; ?>"autofocus required>
                    </input>
                    </div>
                    <small class="cap">Campo note per altre entrate</small>
                  </div>

                  <div class="col-12 bg-theme rounded" >
                    <h3 class="text-light m-4"> Poste rettificative del Capitale Circolante netto (solo se ricorrono):</h3>
                  </div>

                  <div class="col-sm-12 col-xl-6 p-4 border">
                    <label class="text-black font-weight-bold"><?php echo $index;$index++; ?>. Valore dei fondi per il trattamento di fine rapporto incluso il fondo di trattamento di fine mandato degli amministratori</label>
                    <div class="input-group">
                      <input  type="number" step="0.01"  min="0" class="w-50 form-control"
                       id="fondi_admin2020" name = "fondi_admin2020"  placeholder="Anno 2020" value="<?php if($fondi_admin2020!=0){echo $fondi_admin2020;}?>">
                     </input>
                     <input  type="number" step="0.01"  min="0" class="w-50 form-control"
                        id="fondi_admin2021" name = "fondi_admin2021"  placeholder="Anno 2021" value="<?php if($fondi_admin2021!=0){echo $fondi_admin2021;}?>">
                      </input>
                    </div>
                    <small class="cap"></small>
                  </div>

                  <div class="col-sm-12 col-xl-6 p-4 border">
                    <label class="text-black font-weight-bold"><?php echo $index;$index++; ?>. Fondo di quiescenza</label>
                    <div class="input-group">
                      <input  type="number" step="0.01"  min="0" class="w-50 form-control"
                       id="fondi_qui2020" name = "fondi_qui2020"  placeholder="Anno 2020" value="<?php if($fondi_qui2020!=0){echo $fondi_qui2020;} ?>">
                     </input>
                     <input  type="number" step="0.01"  min="0" class="w-50 form-control"
                      id="fondi_qui2021" name = "fondi_qui2021"  placeholder="Anno 2021" value="<?php if($fondi_qui2021!=0){echo $fondi_qui2021;} ?>">
                    </input>
                    </div>
                    <small class="cap"></small>
                  </div>

                  <div class="col-sm-12 col-xl-6 p-4 border">
                    <label class="text-black font-weight-bold"><?php echo $index;$index++; ?>. Fondi rischi e oneri</label>
                    <div class="input-group">
                      <input  type="number" step="0.01"  min="0" class="w-50 form-control"
                       id="fondi_oneri2020" name = "fondi_oneri2020"  placeholder="Anno 2020" value="<?php if($fondi_oneri2020!=0){echo $fondi_oneri2020;} ?>">
                     </input>
                     <input  type="number" step="0.01"  min="0" class="w-50 form-control"
                      id="fondi_oneri2021" name = "fondi_oneri2021"  placeholder="Anno 2021" value="<?php if($fondi_oneri2021!=0){echo $fondi_oneri2021;} ?>">
                    </input>
                    </div>
                    <small class="cap"></small>
                  </div>

                  <div class="col-sm-12 col-xl-6 p-4 border">
                    <label class="text-black font-weight-bold"><?php echo $index;$index++; ?>. Fondo rischi su crediti</label>
                    <div class="input-group">
                      <input  type="number" step="0.01"  min="0" class="w-50 form-control"
                       id="fondi_crediti2020" name = "fondi_crediti2020"  placeholder="Anno 2020" value="<?php if($fondi_crediti2020!=0){echo $fondi_crediti2020;} ?>">
                     </input>
                     <input  type="number" step="0.01"  min="0" class="w-50 form-control"
                      id="fondi_crediti2021" name = "fondi_crediti2021"  placeholder="Anno 2021" value="<?php if($fondi_crediti2021!=0){echo $fondi_crediti2021;} ?>">
                    </input>
                    </div>
                    <small class="cap"></small>
                  </div>

                  <div class="col-sm-12 col-xl-6 p-4 border">
                    <label class="text-black font-weight-bold"><?php echo $index;$index++; ?>. Fondo imposte e tasse</label>
                    <div class="input-group">
                      <input  type="number" step="0.01"  min="0" class="w-50 form-control"
                       id="fondi_tasse2020" name = "fondi_tasse2020"  placeholder="Anno 2020" value="<?php if($fondi_tasse2020!=0){echo $fondi_tasse2020;} ?>">
                     </input>
                     <input  type="number" step="0.01"  min="0" class="w-50 form-control"
                      id="fondi_tasse2021" name = "fondi_tasse2021"  placeholder="Anno 2021" value="<?php if($fondi_tasse2021!=0){echo $fondi_tasse2021;} ?>">
                    </input>
                    </div>
                    <small class="cap"></small>
                  </div>

                  <div class="col-sm-12 col-xl-6 p-4 border">
                    <label class="text-black font-weight-bold"><?php echo $index;$index++; ?>. Fondo per la gestione post-mortem</label>
                    <div class="input-group">
                      <input  type="number" step="0.01"  min="0" class="w-50 form-control"
                       id="fondi_post_mortem2020" name = "fondi_post_mortem2020"  placeholder="Anno 2020" value="<?php if($fondi_post_mortem2020!=0){echo $fondi_post_mortem2020;} ?>">
                     </input>
                     <input  type="number" step="0.01"  min="0" class="w-50 form-control"
                      id="fondi_post_mortem2021" name = "fondi_post_mortem2021"  placeholder="Anno 2021" value="<?php if($fondi_post_mortem2021!=0){echo $fondi_post_mortem2021;} ?>">
                    </input>
                    </div>
                    <small class="cap"></small>
                  </div>

                  <div class="col-sm-12 col-xl-12 p-4 border mb-5">
                    <label class="text-black font-weight-bold"><?php echo $index; ?>. Fondo per il ripristino beni di terzi</label>
                    <div class="input-group">
                      <input  type="number" step="0.01"  min="0" class="w-50 form-control"
                       id="fondi_terzi2020" name = "fondi_terzi2020"  placeholder="Anno 2020" value="<?php if($fondi_terzi2020!=0){echo $fondi_terzi2020;} ?>">
                     </input>
                     <input  type="number" step="0.01"  min="0" class="w-50 form-control"
                      id="fondi_terzi2021" name = "fondi_terzi2021"  placeholder="Anno 2021" value="<?php  if($fondi_terzi2021!=0){echo $fondi_terzi2021;}?>">
                    </input>
                    </div>
                    <small class="cap"></small>
                  </div>

                  <nav class="navbar fixed-bottom navbar-light bg-light container p-0 b-0" >
                    <div class="col-sm-12 col-xl-12 border-0 p-0 mb-2">
                      <input id="save_mtr" name="save_mtr" class="btn w-100 rounded font-weight-bold bg-theme text-light" type="submit" value="SALVA DATI">
                     </div>
                   </nav>
                 </div>
               </div>
             </form>
           </form>
         </div>


             <!--<div class="col-sm-12 col-xl-12" style="border: 0px">
               <nav class="navbar fixed-bottom navbar-light bg-light container" >
                 <input id="save_mtr" name="save_mtr" class="btn btn-primary" type="submit" value="SALVA DATI" style="width:100%; border-radius:20px; font-size:20px; font-weight: bold;background-color: #044e8f; float: right; color:
                   <?php //if($mtr_miur>=0 && $mtr_rec_eva>=0 && $mtr_rec_eva>=0 && $mtr_rec_eva>=0) {echo 'white';}else{echo 'red';} ?>" type="submit" value="Invia DATI"
                   <?php// if($mtr_miur>=0 && $mtr_rec_eva>=0 && $mtr_rec_eva>=0 && $mtr_rec_eva>=0) {echo '';}else{echo 'disabled="true"';} ?>>
                 </form>
               </nav>
             </div>
           -->


     <!-- Modal -->
     <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLongTitle">Conferma</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body">
             Sei sicuro di voler uscire?
           </div>
           <div class="modal-footer">
             <button style="width:100px" type="button" id="back" class="btn" data-dismiss="modal">Annulla</button>
             <form  action="./logout.php" method="post">
               <button style="width:70px" type="submit" id="back" class="btn">Si</button>
             </form>
           </div>
         </div>
       </div>
     </div>

  </body>
</html>


<!--
div
9/10 (301/302)
17/18 (440/441)
21/22 (504/505)
26/27 (588/589)
31/32 (645/646)
-->
