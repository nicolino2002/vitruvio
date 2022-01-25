<?php
  //include('session.php');
  // Retrieve data from html
  $report_id = trim($_GET['report_id']); 
  $username = trim($_GET['username']); 
  $year = trim($_GET['year']);
  $account = trim($_GET['account']);
  $town = trim($_GET['town']);
  $fy = date('Y'); 
  // Retrieve data from table
  include('config.php');
  // get user id
  $sql = "SELECT `id` FROM `users` WHERE `email`= '$account'";
  $ses_sql = mysqli_query($db,$sql);
  $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
  $user_id = $row['id'];
  // get mtr report record data
  $sql = "SELECT * FROM `mtR` WHERE `report_id`= $report_id AND `year`=$year";
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
  $mtr_canone = $row['canone'];
  $mtr_canone_ben = $row['canone_ben'];
  $mtr_canone_iva = $row['canone_iva'];
  $mtr_cts_chk = $row['cts_chk'];
  $mtr_cts = $row['cts'];
  $mtr_cts_ben = $row['cts_ben'];
  $mtr_cts_iva = $row['cts_iva'];
  $mtr_ctr_chk = $row['ctr_chk'];
  $mtr_ctr = $row['ctr'];
  $mtr_ctr_ben = $row['ctr_ben'];
  $mtr_ctr_iva = $row['ctr_iva'];
  $mtr_cov = $row['cov'];
  $mtr_cos = $row['cos'];
  $mtr_rcnd = $row['rcnd'];
  $mtr_csl_chk = $row['csl_chk'];
  $mtr_csl = $row['csl'];
  $mtr_csl_ben = $row['csl_ben'];
  $mtr_csl_comp = $row['csl_comp'];
  $mtr_csl_iva = $row['csl_iva'];
  $mtr_carc_pers = $row['carc_pers'];
  $mtr_carc_pers_iva = $row['carc_pers_iva'];
  $mtr_carc_post = $row['carc_post'];
  $mtr_carc_post_iva = $row['carc_post_iva'];
  $mtr_carc_risc = $row['carc_risc'];
  $mtr_carc_risc_iva = $row['carc_risc_iva'];
  $mtr_carc_cont = $row['carc_cont'];
  $mtr_carc_cont_iva = $row['carc_cont_iva'];
  $mtr_carc_soft = $row['carc_soft'];
  $mtr_carc_soft_iva = $row['carc_soft_iva'];
  $mtr_carc_gest = $row['carc_gest'];
  $mtr_carc_gest_iva = $row['carc_gest_iva'];
  $mtr_cc_cgg = $row['cc_cgg'];
  $mtr_cc_cgg_iva = $row['cc_cgg_iva'];
  $mtr_cc_ccd = $row['cc_ccd'];
  $mtr_cc_ccd_iva = $row['cc_ccd_iva'];
  $mtr_cc_coal = $row['cc_coal'];
  $mtr_cc_coal_iva = $row['cc_coal_iva'];
  $mtr_acc_disc = $row['acc_disc'];
  $mtr_acc_cde = $row['acc_cde'];
  $mtr_acc_risc = $row['acc_risc'];
  $mtr_acc_nor_trib = $row['acc_nor_trib'];
  $mtr_miur_eff = $row['miur_eff'];
  $mtr_rec_eva_eff = $row['rec_eva_eff'];
  $mtr_proc_sanz = $row['proc_sanz'];
  $mtr_part_ent_comp = $row['part_ent_comp'];
  $mtr_att_fp = $row['att_fp'];
  $mtr_att_fp_ben = $row['att_fp_ben'];
  $mtr_att_fp_iva = $row['att_fp_iva'];
  $mtr_valid = $row['valid'];
  $mtr_visible = $row['visible'];

   /* close connection */
   mysqli_close($db);
?>

<html>
   <head>
      <title>MTR Template ver. 1.0</title>
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
            }
      </style>
    </head>
   
      <h1 id="user" name="user" value="<?php echo $username; ?>">Welcome: <?php echo $username; ?></h1> 
      <h1 id="account" name="account" value="<?php echo $account; ?>">account: <?php echo $account; ?></h1> 
      <h3 id="comune" name="comune">Comune: <?php echo $account; ?></h3> 
      <h3 id="fy" name="fy">Anno Fiscale: <?php echo $fy; ?></h3> 
      <h3 id="year" name="year"> DATI A CONSUNTIVO DA BILANCIO DELL' ANNO: <?php echo $year; ?></h3> 
      <form action="./mtr_save.php" method = "post">
      <input type="number" id="report_id" name = "report_id" value="<?php echo $report_id; ?>" hidden></input>
      <input type="number" id="user_id" name = "user_id" value="<?php echo $user_id; ?>" hidden></input>
      <input type="number" id="mtr_id" name = "mtr_id" value="<?php echo $mtr_id; ?>" hidden></input>
      <table width="100%">
          <thead>
            <tr>
              <th width="25%">Campo</th>
              <th width="5%">Valore</th>
			  <th width="20%">Soggetto beneficiario del pagamento</th>
			  <th width="5%">IVA Pagata</th>
              <th width="40%">Descrizione</th>
              <th width="5%">Supporto</th>
           </tr>
         </thead>
         <tbody>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold; color: red;">1. Canone annuo EFFETTIVAMENTE pagato al gestore:</label>
             </td>
             <td>
               <input type="number" class="campo" id="canone" name = "canone" onchange="calcola_iva(this, 0.1);mtr_submit_chk();" placeholder="0" required autofocus value="<?php echo $mtr_canone; ?>"></input>
             </td>
             <td style="text-align:center">
               <input type="text" class="campo" style="padding:2px 2px; height:30px; width:250px; v-align:middle;" id="canone_ben" name = "canone_ben" onchange=";mtr_submit_chk();" placeholder="Inserire ragione sociale del gestore" required autofocus value="<?php echo $mtr_canone_ben; ?>"></input>
             </td>
             <td>
               <input type="number" class="campo" id="canone_iva" name = "canone_iva" onchange=";mtr_submit_chk();" placeholder="0" required autofocus value="<?php echo $mtr_canone_iva; ?>"></input>
             </td>
             <td>Inserire il valore dell'imponibile e dell'IVA pagata al gestore dell'anno <?php echo $year ?> per il servizio di gestione RSU, come risultanti dal bilancio comunale.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 1. Canone Gestore.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold; color: red;">2. Il comune ha pagato dal proprio bilancio i costi CTS relativi al Trasporto e Smaltimento dei rifiuti?</label>
             </td>
             <td>
                <select class="select" style="padding:2px 2px; height:30px; width:100px; v-align:middle;" id="cts_chk" name="cts_chk" onchange="get_cts_val(this);mtr_submit_chk();" required autofocus>
                  <option value="0" <?php if ($mtr_cts_chk==0){echo 'selected';} ?>>No</option>
                  <option value="1" <?php if ($mtr_cts_chk==1){echo 'selected';} ?>>Si</option>
                </select>
             </td>
             <td></td>
             <td></td>
             <td>Indicare se i CTS sono stati pagati dal comune (anche a terzi) o se sono compresi nel canone pagato al gestore del servizio.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 2. CTS Yes/No.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold; color: red;">3. CTS - Costi della attività di trattamento e smaltimento dei rifiuti urbani effettivamente pagato:</label>
             </td>
             <td>
               <input type="number" class="campo" id="cts" name = "cts" onchange="calcola_iva(this, 0.1);mtr_submit_chk();" placeholder="0" <?php if ($mtr_cts_chk==0){echo 'disabled';} ?> required autofocus value="<?php echo $mtr_cts; ?>"></input>
             </td>
             <td style="text-align:center">
                <select class="select" style="padding:2px 2px; height:30px; width:200px; v-align:middle;" id="cts_ben" name="cts_ben" onchange="mtr_submit_chk();" <?php if ($mtr_cts_chk==0){echo 'disabled';} ?> required autofocus>
                  <option value="1" <?php if ($mtr_cts_ben==1){echo 'selected';} ?>>Seleziona</option>
                  <option value="2" <?php if ($mtr_cts_ben==2){echo 'selected';} ?>>Gestore</option>
                  <option value="3" <?php if ($mtr_cts_ben==3){echo 'selected';} ?>>ARO</option>
                  <option value="4" <?php if ($mtr_cts_ben==4){echo 'selected';} ?>>Terzi</option>
                </select>
             </td>
             <td>
               <input type="number" class="campo" id="cts_iva" name = "cts_iva" onchange=";mtr_submit_chk();" placeholder="0" <?php if ($mtr_cts_chk==0){echo 'disabled';} ?> required autofocus value="<?php echo $mtr_cts_iva; ?>"></input>
             </td>
             <td>Indicare se i CTR sono stati pagati dal comune o se sono compresi nel canone pagato al gestore del servizio.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 3. CTS.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold; color: red;">4. Il comune ha pagato dal proprio bilancio i costi CTR relativi al Trattamento e Riciclo dei rifiuti?</label>
             </td>
             <td>
                <select class="select" style="padding:2px 2px; height:30px; width:100px; v-align:middle;" id="ctr_chk" name="ctr_chk" onchange="get_ctr_val(this);mtr_submit_chk();" required autofocus>
                  <option value="0" <?php if ($mtr_ctr_chk==0){echo 'selected';} ?>>No</option>
                  <option value="1" <?php if ($mtr_ctr_chk==1){echo 'selected';} ?>>Si</option>
                </select>
             </td>
             <td></td>
             <td></td>
             <td>Indicare se i CTR sono stati pagati dal comune o se sono compresi nel canone pagato al gestore del servizio.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 4. CTR Yes/No.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold; color: red;">5. CTR - Costi della  attività di trattamento e recupero dei rifiuti urbani effettivamente pagato:</label>
             </td>
             <td>
               <input type="number" class="campo" id="ctr" name = "ctr" onchange="calcola_iva(this, 0.1);mtr_submit_chk();" placeholder="0" <?php if ($mtr_ctr_chk==0){echo 'disabled';} ?> required autofocus value="<?php echo $mtr_ctr; ?>"></input>
             </td>
             <td style="text-align:center">
                <select class="select" style="padding:2px 2px; height:30px; width:200px; v-align:middle;" id="ctr_ben" name="ctr_ben" onchange="mtr_submit_chk();" <?php if ($mtr_ctr_chk==0){echo 'disabled';} ?> required autofocus>
                  <option value="1" <?php if ($mtr_ctr_ben==1){echo 'selected';} ?>>Seleziona</option>
                  <option value="2" <?php if ($mtr_ctr_ben==2){echo 'selected';} ?>>Gestore</option>
                  <option value="3" <?php if ($mtr_ctr_ben==3){echo 'selected';} ?>>ARO</option>
                  <option value="4" <?php if ($mtr_ctr_ben==4){echo 'selected';} ?>>Terzi</option>
                </select>
             </td>
             <td>
               <input type="number" class="campo" id="ctr_iva" name = "ctr_iva" onchange=";mtr_submit_chk();" placeholder="0" <?php if ($mtr_ctr_chk==0){echo 'disabled';} ?> required autofocus value="<?php echo $mtr_ctr_iva; ?>"></input>
             </td>
             <td>Inserire il valore dell'imponibile e dell'IVA  presenti a bilancio del comune dell'anno <?php echo $year ?>.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 5. CTR.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold;">6. COV V - Copertura degli scostamenti attesti - previsionale:</label>
             </td>
             <td>
               <input type="number" class="campo" id="cov" name = "cov" placeholder="0" value="<?php echo $mtr_cov; ?>"></input>
             </td>
             <td></td>
             <td></td>
             <td>Come da determina ARERA n. XXXXX.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 6. COV.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold;">7. COS V - Copertura degli oneri a favore delle utenze domestiche:</label>
             </td>
             <td>
               <input type="number" class="campo" id="cos" name = "cos" placeholder="0" value="<?php echo $mtr_cos; ?>"></input>
             </td>
             <td></td>
             <td></td>
             <td>Come da determina ARERA n. XXXXX.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 7. COS.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold;">8. RCND V - Copertura con rinvio alle annualità successive per la quota delle utenze non domestiche:</label>
             </td>
             <td>
               <input type="number" class="campo" id="rcnd" name = "rcnd" placeholder="0" value="<?php echo $mtr_rcnd; ?>"></input>
             </td>
             <td></td>
             <td></td>
             <td>Come da determina ARERA n. XXXXX.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 8. RCND.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold; color: red;">9. Il comune ha pagato dal proprio bilancio TUTTI o PARTE dei costi CSL relativi allo Spazzamento e Lavaggio delle strade?</label>
             </td>
             <td>
                <select class="select" style="padding:2px 2px; height:30px; width:100px; v-align:middle;" id="csl_chk" name="csl_chk" onchange="get_csl_val(this);mtr_submit_chk();" required autofocus>
                  <option value="0" <?php if ($mtr_csl_chk==0){echo 'selected';} ?>>No</option>
                  <option value="1" <?php if ($mtr_csl_chk==1){echo 'selected';} ?>>Si</option>
                </select>
             </td>
             <td></td>
             <td></td>
             <td>Indicare se i CLS  sono stati pagati per intero oparzialmente dal comune (anche a terzi) o se sono compresi nel canone pagato al gestore del servizio.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 9. CSL Yes/No.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold; color: red;">10. CSL - Costi delle attività di spazzamento e lavaggio:</label>
             </td>
             <td>
               <input type="number" class="campo" id="csl" name = "csl" onchange="calcola_iva(this, 0.1);mtr_submit_chk();" placeholder="0" <?php if ($mtr_csl_chk==0){echo 'disabled';} ?> required autofocus value="<?php echo $mtr_csl; ?>"></input>
             </td>
             <td style="text-align:center">
                <select class="select" style="padding:2px 2px; height:30px; width:100px; v-align:middle;" id="csl_ben" name="csl_ben" onchange="mtr_submit_chk();" <?php if ($mtr_csl_chk==0){echo 'disabled';} ?> required autofocus>
                  <option value="1" <?php if ($mtr_csl_ben==1){echo 'selected';} ?>>Seleziona</option>
                  <option value="2" <?php if ($mtr_csl_ben==2){echo 'selected';} ?>>Gestore</option>
                  <option value="3" <?php if ($mtr_csl_ben==3){echo 'selected';} ?>>ARO</option>
                  <option value="4" <?php if ($mtr_csl_ben==4){echo 'selected';} ?>>Terzi</option>
                </select>
                <select class="select" style="padding:2px 2px; height:30px; width:100px; v-align:middle;" id="csl_comp" name="csl_comp" <?php if ($mtr_csl_chk==0){echo 'disabled';} ?> required autofocus>
                  <option value="0" <?php if ($mtr_csl_comp==0){echo 'selected';} ?>>No</option>
                  <option value="1" <?php if ($mtr_csl_comp==1){echo 'selected';} ?>>Si</option>
                </select>
             </td>
             <td>
               <input type="number" class="campo" id="csl_iva" name = "csl_iva" onchange=";mtr_submit_chk();" placeholder="0" <?php if ($mtr_csl_chk==0){echo 'disabled';} ?> required autofocus value="<?php echo $mtr_csl_iva; ?>"></input>
             </td>
             <td>Inserire il valore dell'imponibile e dell'IVA  presenti a bilancio del comune dell'anno <?php echo $year ?>.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 10. CSL.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold;">11. Costo del personale del Comune per accertamento, ricossione e contenzioso TARI (CARC_PERS):</label>
             </td>
             <td>
               <input type="number" class="campo" id="carc_pers" name = "carc_pers" onchange="calc_carc_tot();" placeholder="0" value="<?php echo $mtr_carc_pers; ?>"></input>
             </td>
             <td></td>
             <td>
               <input type="number" class="campo" id="carc_pers_iva" name = "carc_pers_iva" onchange="calc_carc_iva();" placeholder="0" value="<?php echo $mtr_carc_pers_iva; ?>"></input>
             </td>
             <td>Inserire il valore dell'imponibile e dell'IVA  presenti a bilancio del comune dell'anno <?php echo $year ?>.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 11. CARC PERS.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold;">12. Costo spese postali del Comune per accertamento, ricossione e contenzioso TARI (CARC_POST):</label>
             </td>
             <td>
               <input type="number" class="campo" id="carc_post" name = "carc_post" onchange="calc_carc_tot();" placeholder="0" value="<?php echo $mtr_carc_post; ?>"></input>
             </td>
             <td></td>
             <td>
               <input type="number" class="campo" id="carc_post_iva" name = "carc_post_iva" onchange="calc_carc_iva();" placeholder="0" value="<?php echo $mtr_carc_post_iva; ?>"></input>
             </td>
             <td>Inserire il valore dell'imponibile e dell'IVA  presenti a bilancio del comune dell'anno <?php echo $year ?>.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 12. CARC POST.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold;">13. Costo della riscossione TARI pagata a terzi (CARC_RISC):</label>
             </td>
             <td>
               <input type="number" class="campo" id="carc_risc" name = "carc_risc" onchange="calcola_iva(this, 0.22);calc_carc_tot();" placeholder="0" value="<?php echo $mtr_carc_risc; ?>"></input>
             </td>
             <td></td>
             <td>
               <input type="number" class="campo" id="carc_risc_iva" name = "carc_risc_iva" onchange="calc_carc_iva();" placeholder="0" value="<?php echo $mtr_carc_risc_iva; ?>"></input>
             </td>
             <td>Inserire il valore dell'imponibile e dell'IVA  presenti a bilancio del comune dell'anno <?php echo $year ?>.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 13. CARC RISC.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold;">14. Costo del contenzioso TARI pagato a terzi (CARC_CONT):</label>
             </td>
             <td>
               <input type="number" class="campo" id="carc_cont" name = "carc_cont" onchange="calcola_iva(this, 0.22);calc_carc_tot();" placeholder="0" value="<?php echo $mtr_carc_cont; ?>"></input>
             </td>
             <td></td>
             <td>
               <input type="number" class="campo" id="carc_cont_iva" name = "carc_cont_iva" onchange="calc_carc_iva();" placeholder="0" value="<?php echo $mtr_carc_cont_iva; ?>"></input>
             </td>
             <td>Inserire il valore dell'imponibile e dell'IVA  presenti a bilancio del comune dell'anno <?php echo $year ?>.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 14. CARC CONT.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold;">15. Costo dei canoni software per accertamento, ricossione e contenzioso TARI (CARC_SOFT):</label>
             </td>
             <td>
               <input type="number" class="campo" id="carc_soft" name = "carc_soft" onchange="calcola_iva(this, 0.22);calc_carc_tot();" placeholder="0" value="<?php echo $mtr_carc_soft; ?>"></input>
             </td>
             <td></td>
             <td>
               <input type="number" class="campo" id="carc_soft_iva" name = "carc_soft_iva" onchange="calc_carc_iva();" placeholder="0" value="<?php echo $mtr_carc_soft_iva; ?>"></input>
             </td>
             <td>Inserire il valore dell'imponibile e dell'IVA  presenti a bilancio del comune dell'anno <?php echo $year ?>.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 15. CARC SOFT.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold;">16. Ulteriori costi per accertamento, ricossione e contenzioso TARI, sostenuti e pagati al gestore extra canone (CARC_GEST):</label>
             </td>
             <td>
               <input type="number" class="campo" id="carc_gest" name = "carc_gest" onchange="calcola_iva(this, 0.22);calc_carc_tot();" placeholder="0" value="<?php echo $mtr_carc_gest; ?>"></input>
             </td>
             <td></td>
             <td>
               <input type="number" class="campo" id="carc_gest_iva" name = "carc_gest_iva" onchange="calc_carc_iva();" placeholder="0" value="<?php echo $mtr_carc_gest_iva; ?>"></input>
             </td>
             <td>Inserire il valore dell'imponibile e dell'IVA  presenti a bilancio del comune dell'anno <?php echo $year ?>.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 16. CARC GEST.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold; color:#044A92; background-color:yellow;">17. Totale CARC e relativa IVA:</label>
             </td>
             <td>
               <input type="number" class="campo" id="carc_tot" name = "carc_tot" placeholder="0" value="0" disabled></input>
             </td>
             <td></td>
             <td>
               <input type="number" class="campo" id="carc_tot_iva" name = "carc_tot_iva" placeholder="0" value="0" disabled></input>
             </td>
             <td>Campo non editabile dato dalla somma di CARC_PERS, CARC_POST, CARC_RISC, CARC_CONT, CARC_SOFT dell'anno <?php echo $year ?>.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 17. CARC TOT.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold;">18. Eventuali Costi Generali di Gestione sostenuti dal comune (CC_CGG):</label>
             </td>
             <td>
               <input type="number" class="campo" id="cc_cgg" name = "cc_cgg" onchange="calcola_iva(this, 0.22);calc_cc_tot();" placeholder="0" value="<?php echo $mtr_cc_cgg; ?>"></input>
             </td>
             <td></td>
             <td>
               <input type="number" class="campo" id="cc_cgg_iva" name = "cc_cgg_iva" onchange="calc_cc_iva();" placeholder="0" value="<?php echo $mtr_cc_cgg_iva; ?>"></input>
             </td>
             <td>Inserire il valore dell'imponibile e dell'IVA  presenti a bilancio del comune dell'anno <?php echo $year ?>.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 18. CC_CGG.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold;">19. Eventuali Costi relativi alla quota di crediti inesigibili di competenza del comune  (CC_CCD):</label>
             </td>
             <td>
               <input type="number" class="campo" id="cc_ccd" name = "cc_ccd" onchange="calcola_iva(this, 0.22);calc_cc_tot();" placeholder="0" value="<?php echo $mtr_cc_ccd; ?>"></input>
             </td>
             <td></td>
             <td>
               <input type="number" class="campo" id="cc_ccd_iva" name = "cc_ccd_iva" onchange="calc_cc_iva();" placeholder="0" value="<?php echo $mtr_cc_ccd_iva; ?>"></input>
             </td>
             <td>Inserire il valore dell'imponibile e dell'IVA presenti a bilancio del comune dell'anno <?php echo $year ?>.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 19. CC_CCD.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold;">20. Eventuali Altri Costi sostenuti dal comune (CC_CoaL):</label>
             </td>
             <td>
               <input type="number" class="campo" id="cc_coal" name = "cc_coal" onchange="calc_cc_tot();" placeholder="0" value="<?php echo $mtr_cc_coal; ?>"></input>
             </td>
             <td></td>
             <td>
               <input type="number" class="campo" id="cc_coal_iva" name = "cc_coal_iva" onchange="calc_cc_iva();" placeholder="0" value="<?php echo $mtr_cc_coal_iva; ?>"></input>
             </td>
             <td>Inserire il valore dell'imponibile e dell'IVA  presenti a bilancio del comune dell'anno <?php echo $year ?>.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 20. CC_CoaL.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold; color:#044A92; background-color:yellow;">21. Totale Costi Comuni e relativa IVA:</label>
             </td>
             <td>
               <input type="number" class="campo" id="cc_tot" name = "cc_tot" placeholder="0" value="0" disabled></input>
             </td>
             <td></td>
             <td>
               <input type="number" class="campo" id="cc_tot_iva" name = "cc_tot_iva" placeholder="0" value="0" disabled></input>
             </td>
             <td>Campo non editabile dato dalla somma di CC_CGG, CC_CCD, CC_CoaL dell'anno <?php echo $year ?>.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 21. COSTI TOT.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold;">22. Accantonamenti di gestione post operativa delle discariche (ACC_DISC):</label>
             </td>
             <td>
               <input type="number" class="campo" id="acc_disc" name = "acc_disc" onchange="calc_acc_tot();" placeholder="0" value="<?php echo $mtr_acc_disc; ?>"></input>
             </td>
             <td></td>
             <td></td>
             <td>Campo opzionale.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 22. ACC_DISC.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold; color:red;">23. Accantonamenti per crediti di dubbia esigibilità (ACC_CDE):</label>
             </td>
             <td>
               <input type="number" class="campo" id="acc_cde" name = "acc_cde" onchange="calc_acc_tot();" placeholder="0" value="<?php echo $mtr_acc_cde; ?>" required autofocus></input>
             </td>
             <td></td>
             <td></td>
             <td>Indicare l'importo del Fondo Crediti di Dubbia Esigibilità riferito alla TARI (default 80% del totale FCDE a bilancio).</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 23. ACC_CDE.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold;">24. Accantonamenti per rischi e oneri previsti dalla normativa di settore e/o dal contratto di affidamento (ACC_RISC):</label>
             </td>
             <td>
               <input type="number" class="campo" id="acc_risc" name = "acc_risc" onchange="calc_acc_tot();" placeholder="0" value="<?php echo $mtr_acc_risc; ?>"></input>
             </td>
             <td></td>
             <td></td>
             <td>Campo opzionale.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 24. ACC_RISC.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold;">25. Accantonamenti per altri oneri non in eccesso rispetto alle norme tributarie (ACC_NOR_TRIB):</label>
             </td>
             <td>
               <input type="number" class="campo" id="acc_nor_trib" name = "acc_nor_trib" onchange="calc_acc_tot();" placeholder="0" value="<?php echo $mtr_acc_nor_trib; ?>"></input>
             </td>
             <td></td>
             <td></td>
             <td>Campo opzionale.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 25. ACC_NOR_TRIB.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold; color:#044A92; background-color:yellow;";>26. Totale Accantonamenti:</label>
             </td>
             <td>
               <input type="number" class="campo" id="acc_tot" name = "acc_tot" placeholder="0" value="0" disabled></input>
             </td>
             <td></td>
             <td></td>
             <td>Campo non editabile dato dalla somma di ACC_DISC, ACC_CDE, ACC_RISC, ACC_NOR_TRIB dell'anno <?php echo $year ?>.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 26. ACC TOT.','<?php echo $account; ?>')">
             </td>
           </tr>


           <tr>
             <td>
               <label class="campo" style="font-weight: bold; color:red;">27. Detrazioni di cui all'art. 1.4 della Determina ARERA 2/2020 - Contributo MIUR (MIUR_EFF):</label>
             </td>
             <td>
               <input type="number" class="campo" id="miur_eff" name = "miur_eff" onchange="calc_det_tot();" placeholder="0" value="<?php echo $mtr_miur_eff; ?>" required autofocus></input>
             </td>
             <td></td>
             <td></td>
             <td>Inserire il valore presente a bilancio del comune dell'anno <?php echo $year ?>. Tipicamente questo importo è stato rimborsato dal MIUR per il servizio offerto alle istituzioni scolastiche del comune.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 27. MIUR_EFF.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold;">28. Detrazioni di cui all'art. 1.4 della Determina ARERA 2/2020 - Entrate effettivamente conseguite a seguito dell'attività di recupero dell'evasione (REC_EVA_EFF):</label>
             </td>
             <td>
               <input type="number" class="campo" id="rec_eva_eff" name = "rec_eva_eff" onchange="calc_det_tot();" placeholder="0" value="<?php echo $mtr_rec_eva_eff; ?>"></input>
             </td>
             <td></td>
             <td></td>
             <td>Campo opzionale.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 28. REC_EVA_EFF.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold;">29. Detrazioni di cui all'art. 1.4 della Determina ARERA 2/2020 - Entrate derivanti da procedure sanzionatorie (PROC_SANZ):</label>
             </td>
             <td>
               <input type="number" class="campo" id="proc_sanz" name = "proc_sanz" onchange="calc_det_tot();" placeholder="0" value="<?php echo $mtr_proc_sanz; ?>"></input>
             </td>
             <td></td>
             <td></td>
             <td>Campo opzionale.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 29. PROC_SANZ.','<?php echo $account; ?>')">
             </td>
           </tr>           <tr>
             <td>
               <label class="campo" style="font-weight: bold;">30. Detrazioni di cui all'art. 1.4 della Determina ARERA 2/2020 - Ulteriori partite approvate dall'Ente Territorialmente competente (PART_ENT_COMP):</label>
             </td>
             <td>
               <input type="number" class="campo" id="part_ent_comp" name = "part_ent_comp" onchange="calc_det_tot();" placeholder="0" value="<?php echo $mtr_part_ent_comp; ?>"></input>
             </td>
             <td></td>
             <td></td>
             <td>Campo opzionale.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 30. PART_ENT_COMP.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold; color:#044A92; background-color:yellow;";>31. Totale Detrazioni:</label>
             </td>
             <td>
               <input type="number" class="campo" id="det_tot" name = "det_tot" placeholder="0" value="0" disabled></input>
             </td>
             <td></td>
             <td></td>
             <td>Campo non editabile dato dalla somma di MIUR_EFF, REC_EVA_EFF, PRC_SANZ, PART_ENT_COMP dell'anno <?php echo $year ?>.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 31. DET TOT.','<?php echo $account; ?>')">
             </td>
           </tr>
           <tr>
             <td>
               <label class="campo" style="font-weight: bold;">32. Importo riferito alle eventuali attività esterne ciclo integrato RU (ATT_FP):</label>
             </td>
             <td>
               <input type="number" class="campo" id="att_fp" name = "att_fp" onchange="calcola_iva(this, 0.1);" placeholder="0" value="<?php echo $mtr_att_fp; ?>"></input>
             </td>
             <td style="text-align:center">
                <select class="select" style="padding:2px 2px; height:30px; width:200px; v-align:middle;" id="att_fp_ben" name="att_fp_ben">
                  <option value="1" <?php if ($mtr_att_fp_ben==1){echo 'selected';} ?>>Seleziona</option>
                  <option value="2" <?php if ($mtr_att_fp_ben==2){echo 'selected';} ?>>Gestore</option>
                  <option value="4" <?php if ($mtr_att_fp_ben==4){echo 'selected';} ?>>Terzi</option>
                </select>
             </td>
             <td>
               <input type="number" class="campo" id="att_fp_iva" name = "att_fp_iva" placeholder="0" value="<?php echo $mtr_att_fp_iva; ?>"></input>
             </td>
             <td>Inserire il valore dell'imponibile e dell'IVA presenti a bilancio del comune dell'anno <?php echo $year ?> al netto di IVA. Tipicamente questo importo è stato pagato al gestore del servizio per i servizi Fuori Perimetro.</td>
             <td>
               <input class="send" type="button" value="Richiedi Supporto via Mail" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: Registrazione MTR-<?php echo $year ?>, Campo: 32. ATT_FP.','<?php echo $account; ?>')">
             </td>
           </tr>
        </tbody>
      </table>
      <input id="save_mtr" name="save_mtr" class="send" style="width: 100%; color: <?php   if($mtr_canone >= 100000) {echo 'green';}else{echo 'red';} ?>" type="submit" value="Salva mtr-2018" <?php   if($mtr_canone >= 100000) {echo '';}else{echo 'disabled="true"';} ?>>
       </form>
      <a href="welcome.php" class="link-primary">Torna alla pagina principale</a>
      <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
      <script type="text/javascript" src="../js/scripts.js"></script>
   <footer style="font-weight: bold; color: red;">
      <p>* Campi Obbligatori</p>
   </footer>
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