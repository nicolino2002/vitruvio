<?php
  //include('session.php');
  // Retrieve data from html
  $username = trim($_GET['username']);
  $report_id = trim($_GET['report_id']);
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
  // get mtn report record data
  $sql = "SELECT * FROM `mtn` WHERE `report_id`= $report_id";
  $ses_sql = mysqli_query($db,$sql);
  $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
  $mtn_id = $row['id'];
  $mtn_report_id = $row['report_id'];
  $mtn_completed = $row['completed'];
  $mtn_year = $row['year'];
  $mtn_user_creator_id = $row['user_creator_id'];
  $mtn_create_date = $row['create_date'];
  $mtn_last_modified_id = $row['last_modified_id'];
  $mtn_last_modified_date = $row['last_modified_date'];

  //PRIMA PARTE

  //SECONDA PARTE
  $mtr_cts_chk = $row['cts_chk'];
  $mtr_ctr_chk = $row['ctr_chk'];
  $mtr_csl_chk = $row['csl_chk'];
  $mtn_pef_file = $row['pef_file'];
  $mtn_valid = $row['valid'];
  $mtn_visible = $row['visible'];

  $rag_soc= $row['rag_soc'];

  $canone_mtn = $row['canone_mtn'];
  $contr_chk = $row['contr_chk'];
  $conai_chk = $row['conai_chk'];

  $cts_chk = $row['cts_chk'];
  $ctr_chk = $row['ctr_chk'];
  $csl_chk = $row['csl_chk'];

  $ru_chk=$row['ru_chk'];

  $data_del=$row['data_del'];
  $data_app=$row['data_app'];


  $ces_chk=$row['ces_chk'];
  $ces_desc=$row['ces_desc'];

  $lav_chk=$row['lav_chk'];
  $lav_desc=$row['lav_desc'];

  $att_gest_chk=$row['att_gest_chk'];
  $qual_chk=$row['qual_chk'];

   /* close connection */
   mysqli_close($db);
?>

<html>
   <head>
      <title>FORM DATI Template ver. 1.0</title>
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
              width:200px;
              margin-right: 30px;
              v-align:middle;
			        text-align:center;
            }
            .send
            {
              height:60px;
              padding:10px;
      			  background-color: #044A92;
      			  color: #ffffff;
              width:100%;
            }

            .welcome
            {
              background-color: #6592ba;
            }

            .formtitle
            {text-align: center;
              margin-bottom: 20px;}

          .container-fluid
          {

            background-color: white;

          }


          .border-07
          {
            border: 0.7px solid #d1d1d1;

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
           <div class="col-4">
             <h1>A. DATI GENERALI</h1>
           </div>
             <div class="col-4 offset-4 text-right">
               <button type="button" class="btn btn-help" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: A.','<?php echo $account; ?>')" ><a class="text-primary">Help?</a></button>
               <button type="button" class="btn" id="logout" data-toggle="modal" data-target="#exampleModalCenter">
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

       <form  action="./mtn_save.php" method = "post">
              <input type="number" id="report_id" name = "report_id" value="<?php echo $report_id; ?>" hidden></input>
              <input type="number" id="user_id" name = "user_id" value="<?php echo $user_id; ?>" hidden></input>
              <input type="number" id="mtn_id" name = "mtn_id" value="<?php echo $mtn_id; ?>" hidden></input>
         <div class="container border-07">
             <div class="row">

               <div class="col-12 bg-theme rounded" >
                 <h3 class="text-light m-4"> INFORMAZIONI GENERALI:</h3>
               </div>

               <?php $index=1; ?>
               <div class="col-sm-12 col-xl-12 p-4 border">
                 <label class="text-red font-weight-bold"><?php echo $index;$index++; ?>. Ragione sociale del gestore dei servizi di RSU:</label>
                  <div class="input-group">
                     <input type="text" class="space fields form-control rounded" id="rag_soc" name ="rag_soc" onchange="mtn_submit_chk();"  placeholder="Rag. Soc. Gestore" required autofocus value="<?php if($rag_soc) echo $rag_soc;else echo 0; ?>"></input>
                  </div>
                 <small class="cap">Inserire la ragione sociale del gestore</small>
               </div>

               <div class="col-sm-12 col-xl-6 p-4 ">
                 <label class="text-red font-weight-bold"><?php echo $index; ?>a. Canone gestore contrattualmente previsto, netto di IVA:	</label>
                 <div class="input-group">
                     <input type="number" step="0.01" min="100000" class="space fields form-control rounded" id="canone_mtn" name = "canone_mtn" onchange="mtn_submit_chk();" placeholder="0" required autofocus value="<?php if($canone_mtn) echo $canone_mtn;else echo 0; ?>"></input>
                  </div>
                 <small class="cap">Inserire l'importo previsionale del canone gestore comprensivo di IVA.</small>
               </div>

               <div class="col-sm-12 col-xl-6 p-4 ">
                 <label class="text-red font-weight-bold"><?php echo $index;$index++; ?>b. È previsto un adeguamento contrattuale del canone?:	</label>
                 <div class="input-group">
                   <select class="space fields form-select rounded"  id="contr_chk" name="contr_chk"  required autofocus>
                     <option value="0" <?php if ($contr_chk==0){echo 'selected';} ?>>No</option>
                     <option value="1" <?php if ($contr_chk==1){echo 'selected';} ?>>Si</option>
                   </select>
                  </div>
                 <small class="cap">Indicare se il contratto prevede un adeguamento automatico</small>
               </div>

               <div class="col-sm-12 col-xl-12 p-4 border">
                 <label class="text-red font-weight-bold"><?php echo $index;$index++; ?>. Il Comune percepisce direttamente i ricavi CONAI dalla vendita del materiale riciclabile?</label>
                 <div class="input-group">
                   <select class="space fields form-select rounded" id="conai_chk" name="conai_chk" onchange="get_conai_val(this);mtn_submit_chk();" required autofocus>
                     <option value="0" <?php if ($conai_chk==0){echo 'selected';} ?>>No</option>
                     <option value="1" <?php if ($conai_chk==1){echo 'selected';} ?>>Si</option>
                    </select>
                  </div>
                 <small class="cap">Si - indica che il Comune percepisce direttamente i ricavi CONAI  No -  indica che i ricavi CONAI sono trattenuti dal gestore.</small>
               </div>

               <div class="col-sm-12 col-xl-12 p-4 ">
                 <label class="text-red font-weight-bold"><?php echo $index;$index++; ?>. Il Comune ha pagato dal proprio bilancio i costi CTS relativi al Trattamento e Smaltimento dei rifiuti?</label>
                 <div class="input-group">
                     <select class="space fields form-select rounded" id="cts_chk" name="cts_chk" onchange="get_cts_val(this);mtn_submit_chk();" required autofocus>
                       <option value="0" <?php if ($cts_chk==0){echo 'selected';} ?>>No</option>
                       <option value="1" <?php if ($cts_chk==1){echo 'selected';} ?>>Si</option>
                     </select>
                  </div>
                 <small class="cap">Indicare se i CTS sono stati pagati dal comune (anche a terzi): il relativo importo dovrà essere indicato nelle tavole di input</small>
               </div>



               <div class="col-sm-12 col-xl-12 p-4 border">
                 <label class="text-red font-weight-bold"><?php echo $index;$index++; ?>. Il Comune ha pagato dal proprio bilancio i costi CTR relativi al Trattamento e Riciclo dei rifiuti?</label>
                 <div class="input-group">
                 <select class="space fields form-select rounded" id="ctr_chk" name="ctr_chk" onchange="get_ctr_val(this);mtn_submit_chk();" required autofocus>
                   <option value="0" <?php if ($ctr_chk==0){echo 'selected';} ?>>No</option>
                   <option value="1" <?php if ($ctr_chk==1){echo 'selected';} ?>>Si</option>
                 </select>
                  </div>
                 <small class="cap">Indicare se i CTR sono stati pagati dal comune (anche a terzi): il relativo importo dovrà essere indicato nelle tavole di input</small>
               </div>

               <div class="col-sm-12 col-xl-12 p-4">
                 <label class="text-red font-weight-bold"><?php echo $index;$index++; ?>. Il Comune ha pagato dal proprio bilancio TUTTI o PARTE dei costi CSL relativi allo Spazzamento e Lavaggio delle strade?</label>
                 <div class="input-group">
                   <select class="space fields form-select rounded" id="csl_chk" name="csl_chk" onchange="get_csl_val(this);mtn_submit_chk();" required autofocus>
                     <option value="0" <?php if ($csl_chk==0){echo 'selected';} ?>>No</option>
                     <option value="1" <?php if ($csl_chk==1){echo 'selected';} ?>>Si</option>
                   </select>
                  </div>
                 <small class="cap">Indicare se i CSL sono stati pagati dal comune (anche a terzi): il relativo importo dovrà essere indicato nelle tavole di input</small>
               </div>

               <div class="col-sm-12 col-xl-12 p-4 border">
                 <label class="text-red font-weight-bold"><?php echo $index;$index++; ?>. Il contratto con il gestore prevede anche l'espletamento di servizi NON inseriti nel perimetro del ciclo integrato RU?</label>
                 <div class="input-group">
                   <select class="space fields form-select rounded" id="ru_chk" name="ru_chk" onchange="get_csl_val(this);mtn_submit_chk();" required autofocus>
                     <option value="0" <?php if ($ru_chk==0){echo 'selected';} ?>>No</option>
                     <option value="1" <?php if ($ru_chk==1){echo 'selected';} ?>>Si</option>
                   </select>
                  </div>
                 <small class="cap">Indicare se il contratto con il gestore prevede anche l'espletamento di servizi non compresi nel perimetro del ciclo RU (es. derattizzazione, sfalcio erba etc): il relativo importo dovrà essere indicato nelle tavole di input</small>
               </div>

               <div class="col-sm-12 col-xl-6 p-4 border">
                 <label class="text-red font-weight-bold"><?php echo $index;$index++; ?>. Inserire la data della delibera tariffaria comunale relativa al 2021 (GG/MM/AAAA)</label>
                 <div class="input-group">
                     <input type="date"  class="space fields form-control rounded" id="data_del" name = "data_del" onchange="mtn_submit_chk();" placeholder="0" value="<?php if($data_del)echo $data_del;else{echo 0;} ?>" required autofocus></input>
                  </div>
               </div>

               <div class="col-sm-12 col-xl-6 p-4 border">
                 <label class="text-red font-weight-bold"><?php echo $index;$index++; ?>. Inserire la data di inizio dell'appalto RSU nell'attuale configurazione (GG/MM/AAAA)	</label>
                  <div class="input-group">
                     <input type="date" class="space fields form-control rounded" id="data_app" name="data_app" onchange="mtn_submit_chk();" placeholder="0" value="<?php if($data_app)echo $data_app;else{echo 0;} ?>" required autofocus></input>
                  </div>
               </div>

               <div class="col-sm-12 col-xl-6 p-4 border-bottom">
                 <label class="text-red font-weight-bold"><?php echo $index; ?>a. A bilancio comunale sono presenti dei cespiti ammortizzabili (impianti, attrezzature…)?	</label>
                 <div class="input-group">
                   <select class="space fields form-select rounded" id="ces_chk" name="ces_chk" onchange="mtn_submit_chk();" placeholder="Cespiti" required autofocus>
                     <option value="0" <?php if ($ces_chk==0){echo 'selected';} ?>>No</option>
                     <option value="1" <?php if ($ces_chk==1){echo 'selected';} ?>>Si</option>
                   </select>
                 </div>
                 <small class="cap">Indicare se ci sono beni in ammortamento impiegati nel servizio <b>solo se NON sono stati finanziati da fondi pubblici</b>.</small>
               </div>

               <div class="col-sm-12 col-xl-6 p-4 border-bottom">
                 <label class="text-black font-weight-bold"><?php echo $index;$index++; ?>b. Descrizione cespiti ammortizzabili	</label>
                 <div class="input-group">
                   <input type="text" class="space fields form-control rounded" id="ces_desc" name="ces_desc" onchange="mtn_submit_chk();" placeholder="Descrizione" value="<?php if($ces_desc) echo $ces_desc;else{echo 0;} ?>" autofocus></input>
                  </div>
                  <small class="cap">Indicare per i beni ammortizzabili: tipologia, anno di acquisto, valore di acquisto, rateo di ammortamento.</small>
               </div>

                 <div class="col-sm-12 col-xl-6 p-4 mb-5 border-top">
                 <label class="text-red font-weight-bold"><?php echo $index; ?>a. A bilancio comunale sono presenti lavori in corso (es. realizzazione isola ecologica)?	</label>
                 <div class="input-group">
                   <select class="space fields form-select rounded" id="lav_chk" name="lav_chk" onchange="mtn_submit_chk();" placeholder="Lavori in corso" required autofocus>
                     <option value="0" <?php if ($lav_chk==0){echo 'selected';} ?>>No</option>
                     <option value="1" <?php if ($lav_chk==1){echo 'selected';} ?>>Si</option>
                   </select>
                  </div>
                  <small class="cap">Si intendono opere riferite al servizio di igiene urbana in fase di realizzazione.</small>
               </div>

               <div class="col-sm-12 col-xl-6 p-4 mb-5 border-top">
                 <label class="text-black font-weight-bold"><?php echo $index;$index++; ?>b. Descrizione lavori in corso	</label>
                 <div class="input-group">
                     <input type="text" class="space fields form-control rounded" id="lav_desc" name="lav_desc" onchange="mtn_submit_chk();" value="<?php if($lav_desc)echo $lav_desc;else{echo 0;} ?>" placeholder="Descrizione"  autofocus></input>
                  </div>
                  <small class="cap">Descrivere gli eventuali lavori in corso</small>
               </div>

               <div class="col-sm-12 col-xl-6 p-4 mb-5 border-top border-right">
                 <label class="text-black font-weight-bold"><?php echo $index;$index++; ?>. Sono previste variazioni nelle attività gestionali?</label>
                 <div class="input-group">
                   <select class="space fields form-select rounded" id="att_gest_chk" name="att_gest_chk" required autofocus>
                     <option value="0" <?php if ($att_gest_chk==0){echo 'selected';} ?>>No</option>
                     <option value="1" <?php if ($att_gest_chk==1){echo 'selected';} ?>>Si</option>
                   </select>
                  </div>
               </div>

               <div class="col-sm-12 col-xl-6 p-4 mb-5 border-top">
                 <label class="text-black font-weight-bold"><?php echo $index;$index++; ?>. Sono previsti miglioramenti nei livelli di qualità?	</label>
                 <div class="input-group">
                   <select class="space fields form-select rounded" id="qual_chk" name="qual_chk" required autofocus>
                     <option value="0" <?php if ($qual_chk==0){echo 'selected';} ?>>No</option>
                     <option value="1" <?php if ($qual_chk==1){echo 'selected';} ?>>Si</option>
                   </select>
                  </div>
               </div>


              <nav class="navbar fixed-bottom navbar-light bg-light container p-0 b-0" >
                <div class="col-sm-12 col-xl-12 border-0 p-0 mb-2">
                       <input id="save_mtn" name="save_mtn" class="btn bg-theme btn-save w-100 rounded font-weight-bold" type="submit" value="SALVA DATI" style="color: <?php
                         if($canone_mtn >= 100000  )
                         {echo 'white';}else{echo 'red';} ?>" <?php
                         if($canone_mtn >= 100000 )
                      {echo '';}else{echo 'disabled="true"';} ?>>
                 </div>
               </nav>
             </div>
           </div>
         </form>
       </form>
     </div>




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
