<?php
   include('session.php');
   if ($report_id) {
   $sql="SELECT `sent_times` FROM `reports` WHERE `id`=$report_id AND `valid`=1 AND `visible`=1";
   $res = $db->query($sql);
   $row = $res->fetch_assoc();
   $sent_times=$row['sent_times'];

  }else {
  }
   echo "<br>";
   // echo $sent_times;
   // echo $report_id;

?>

<!doctype html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/colors.css" rel="stylesheet">
    <link href="../js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>InfoWaste ver. 1.0</title>
    <style media="screen">
        html {zoom: 110%;}

        .navbut
        {
          background-color:white;
          border-radius: 10px;
          margin:4px;
        }

    </style>
  </head>
  <body>


    <div style="width:90%; margin-left:5%;">
      <h3 class="ml-1">Benvenuto: <?php echo $login_name; ?></h3>
      <h3 class="ml-1">Stai operando sul PEF 2022-2025 del Comune di <?php echo $login_town; ?> con l’account <?php echo $login_user; ?> e il ruolo <?php echo $login_title; ?>.</h3>
      <?php if($new_report==0 && $status_id==3 && $sent_times>=5)echo "<h3 class='ml-1 text-red'>Il comune su cui stai operando, ha inviato il report troppe volte, contatta l'assistenza.</h3>"; ?>
    <nav class="navbar navbar-expand-lg navbar-light " style="background-color:#d1d1d1;margin-top:2%;margin-bottom:2%;">
      <div class="container-fluid">
        <!--<a class="navbar-brand" href="#">Navbar</a>-->
        <a class="navbar-brand" href="#">
          <div style="margin:1%; height:100%"><a class="navbar-brand" target="_blank" href="https://www.infowaste.it/"> <img src="../img/logo2.png" height="50" width="120" > </a></div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <!--<li class="nav-item">-->
              <!--<a class="nav-link active" aria-current="page" href="#">Home</a>-->
              <!--<a class="nav-link active" aria-current="page" href="test1.html" target="_blank">Home</a>-->
            <!--</li>-->
            <li class="nav-item">
            <div class="navbut">
            <a class="nav-link<?php if($new_report==1 || $status_id>2){echo ' disabled';} ?>" <?php if($new_report==0){echo 'style="color: '.$mtn.';font-weight:bold"';} ?> href="./mtn_input.php?report_id=<?php echo $report_id; ?>&year=2019&username=<?php echo $login_name; ?>&account=<?php echo $login_user; ?>&town=<?php echo $login_town; ?>&title=<?php echo $login_title; ?>">A. Dati Generali</a>
            </div>
            </li>

            <div class="navbut">
            <li class="nav-item">
              <a class="nav-link<?php if($new_report==1 || $status_id>2){echo ' disabled';} ?>" <?php if($new_report==0){echo 'style="color: '.$mtr.';font-weight:bold"';} ?> href="./mtr_input.php?report_id=<?php echo $report_id; ?>&year=2021&username=<?php echo $login_name; ?>&account=<?php echo $login_user; ?>&town=<?php echo $login_town; ?>&title=<?php echo $login_title; ?>">B. Accertato e Previsionali</a>
            </li>
            </div>

            <div class="navbut">
             <li class="nav-item">
              <a class="nav-link<?php if($new_report==1 || $status_id>2){echo ' disabled';} ?>" <?php if($new_report==0){echo 'style="color: '.$invio.';font-weight:bold"';} ?> aria-current="page" href="./invio.php?report_id=<?php echo $report_id; ?>&username=<?php echo $login_name; ?>&account=<?php echo $login_user; ?>&town=<?php echo $login_town; ?>&title=<?php echo $login_title; ?>">C. File Dati</a>
            </li>
          </div>


            <div class="navbut">
            <li class="nav-item">
              <a class="nav-link<?php if($new_report==1 || $status_id>2){echo ' disabled';} ?>" <?php if($new_report==0){echo 'style="color: '.$input2020.';font-weight:bold"';} ?> aria-current="page" href="./input.php?report_id=<?php echo $report_id; ?>&year=2020&username=<?php echo $login_name; ?>&account=<?php echo $login_user; ?>&town=<?php echo $login_town; ?>&title=<?php echo $login_title; ?>">D. Tavola di input 2020</a>
            </li>
          </div>


            <div class="navbut"  <?php if ($login_role=="Normal") {echo "hidden";} ?>>
           <li class="nav-item">
              <a class="nav-link<?php if($new_report==1 || $status_id>2){echo ' disabled';} ?>" <?php if($new_report==0){echo 'style="color: '.$input2021.';font-weight:bold"';} ?> aria-current="page" href="./input.php?report_id=<?php echo $report_id; ?>&year=2021&username=<?php echo $login_name; ?>&account=<?php echo $login_user; ?>&town=<?php echo $login_town; ?>&title=<?php echo $login_title; ?>">E. Tavola di input 2021</a>
            </li>
          </div>


          <div class="navbut">
            <li class="nav-item">
              <a class="nav-link <?php if($new_report==1 || $status_id>2){echo ' disabled';} ?>" <?php if($new_report==0){echo 'style="color: '.$extra.';font-weight:bold"';} ?> aria-current="page" href="./extra.php?report_id=<?php echo $report_id; ?>&username=<?php echo $login_name; ?>&account=<?php echo $login_user; ?>&town=<?php echo $login_town; ?>&title=<?php echo $login_title; ?>">F. Extracosti smaltimenti</a>
            </li>
          </div>



          <div class="navbut"  <?php if ($login_role != 'Admin') {echo "hidden";}?>>
            <li class="nav-item">
              <a  id="report_tab" class="<?php if ($login_role == 'Admin' OR $login_role == 'Supervisor') {echo 'nav-link active';} else {echo 'nav-link disabled';} ?>" href="./report_export.php" aria-disabled="true">Report</a>
            </li>
          </div>


          <div class="navbut"  <?php if ($login_role != 'Admin') {echo "hidden";}?>>
            <li class="nav-item">
              <a id="admin_tab" class="<?php if ($login_role == 'Admin') {echo 'nav-link active';} else {echo 'nav-link disabled';} ?>" href="../admin.php" aria-disabled="true">Admin</a>
            </li>
          </div>

          <div class="navbut"  <?php if ($login_role != 'Admin') {echo "hidden";}?>>
          <li class="nav-item">
            <a id="admin_tab" class="<?php if ($login_role == 'Admin') {echo 'nav-link active';} else {echo 'nav-link disabled';} ?>" href="../new_town.php" aria-disabled="true">Aggiungi Comune</a>
          </li>
        </div>


            <div class="navbut">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../help.html">Help</a>
            </li>
          </div>


            <li class="nav-item">
              <b class="nav-link active" aria-current="page" href="#">Status: <?php echo $status; ?></b>
            </li>
          </ul>
        </div>
      </div>
    </nav>



  <b>SUPPORTO PEF</b> è un servizio a disposizione dei Comuni per la compilazione del <b> PEF (Piano Economico Finanziario)
   per la definizione della TARI secondo le disposizioni di ARERA</b>.

      Il servizio si svolge nel rispetto della normativa sulla privacy e sulla gestione dei dati sensibili.</p>
    <p>L’utente, dopo essersi accreditato, inizia a compilare le sezione del menù superiore utilizzando i dati contabili in suo possesso. <b>L’utente è guidato passo passo nella compilazione,</b> utilizzando schemi già consolidati nell’ambito della Pubblica Amministrazione. <b>In ogni pagina è presente un pulsante di Help</b>, grazie al quale viene fornito un servizio di assistenza offline. E' sufficiente dettagliare la richiesta nel campo testuale che appare a video: un incaricato contatterà l'utente entro la giornata lavorativa successiva.
    <p>Dopo aver compilato una sezione, <b>il sistema fa salvare i dati inseriti e ne controlla la consistenza</b> <b style="color:red">(evidenziando in ROSSO i campi di compilazione obbligatoria)</b>. Terminata la compilazione di una pagina, <b>l’utente è invitato (tramite apposito pulsante) a tornare  alla pagina principale</b>, per continuare nella compilazione delle altre pagine.</p>
    <p><b>Ogni Comune ha un proprio Key Account Manager (KAM)</b>.
    La piattaforma, effettuata la fase di inserimento di tutti i dati necessari, prevede <b>l’invio degli stessi all’utente e a Infowaste. Tutti i dati inseriti sono modificabili</b> fino al momento in cui avviene l’invio finale degli stessi. Da questo momento <b>parte un periodo di elaborazione dei dati inviati</b>, sotto la supervisione del KAM.</p>
    <p>Terminata l’elaborazione, <b>viene restituito all’utente un elaborato grezzo</b> che potrà essere verificato ed eventualmente modificato entro 3 giorni lavorativi. <b>In mancanza di rilievi scritti al KAM, l'elaborato prodotto sarà considerato validato.</b></p>
    <p>Durante il periodo di elaborazione, nel caso in cui l’utente voglia modificare uno o più dati imputati, <b>è possibile richiedere l’annullamento dell’ultimo invio e la creazione di un nuovo inserimento</b> (che ricopia automaticamente tutti i dati dell’invio annullato per la successiva modifica e salvataggio). Il periodo di elaborazione di cui sopra, parte nuovamente dal momento dell’invio dell’invio dei dati aggiornati da parte dell’utente.</p>
    <p><b>Ogni operazione eseguita sulla piattaforma garantisce la tracciabilità e l’archiviazione di tutti i dati</b>, comprese le richieste di assistenza inoltrate.</p>
    <form style="width:100%" class="d-flex" action="./<?php if($new_report==1){echo 'new_report';}else{if($status_id<3){echo 'send_report';}else{echo 'corr_report';}} ?>.php" method = "post">
      <input  type="text" id="id_user" name = "id_user" class="form-control" value="<?php echo $user_id; ?>" required hidden>
      <input  type="text" id="id_town" name = "id_town" class="form-control" value="<?php echo $town_id; ?>" required hidden>
      <input  type="text" id="id_report" name = "id_report" class="form-control" value="<?php if ($new_report==0) {echo $report_id;} else {echo '0';} ?>" required hidden>

          <div style="width:100%">
            <a href="./logout.php"><input class="btn btn-lg btn-primary" style="float:left;background-color: #044A92;margin:1%;" type="button" value="Logout"></a>


                <button
                  class=" btn btn-lg btn-primary" style="float:right;margin:1%;background-color: #044A92" type="submit"

                  <?php if($new_report==0 && $status_id==2 || $status_id==1 )
                        {
                          if ($mtn=='red' || $mtr=='red' || $invio=='red' || $input2020=='red' || $input2021=='red' || $extra=='red') {
                            echo "disabled";
                          }else {
                            echo "";
                          }
                        }
                   ?>

                   <?php if($new_report==1){echo '';}else{if($status_id<3){echo '';}else{echo '';}} ?>
                   <?php if($new_report==0 && $status_id==3 && $sent_times>=5)echo "disabled"; //disattivo la possibilità di riprendere il report
                   ?>
                >
                  <?php if($new_report==1){echo 'Crea Nuovo Report';}//definisco l'operazione possibile sul report
                  else{if($status_id<3){echo 'Invia Report';}else{echo 'Riprendi Elaborazione';}} ?>

              </button>

            </div>
          </form>
        </div>



    <!--<h4 style="margin-left:10px">Il tuo KAM è (kam_user) contattabile al numero (tel_cam)</h4> -->
    <script src="../js/bootstrap.bundle.min.js"></script>
    <!--<script src="../js/scripts.js"></script>-->
  </div>
 </body>
</html>
