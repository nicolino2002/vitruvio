<?php
  include('session.php');
  include('cdn.php');
  // Retrieve data from html
  $report_id = trim($_GET['report_id']);
  $username = trim($_GET['username']);
  $account = trim($_GET['account']);
  $town = trim($_GET['town']);
  $title = trim($_GET['title']);
  $year = trim($_GET['year']);
  $fy = date('Y');
  // Retrieve data from table
  // get user id
  $sql = "SELECT `id` FROM `users` WHERE `email`= '$account'";
  $ses_sql = mysqli_query($db,$sql);
  $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
  $user_id = $row['id'];
?>

<html>
   <head>
      <title>INPUT Page</title>
      <script type="text/javascript">

      function updateInput(ish,type){
        document.getElementById(type).value = ish;
      }

      function load_del_id(id){
        id2 = id.match(/\d+/)[0] // "3"
        document.getElementById('del_id'+id2).value=id;

      }

                function calcolo_ptari_(pos)
          {

                var ptari = document.getElementById('pef'+pos);
                ptari.value = parseFloat(document.getElementById('impegno'+pos).value)-(parseFloat(document.getElementById('impegno'+pos).value)-
                          (parseFloat(document.getElementById('impegno'+pos).value))
                          /100*
                          (parseFloat(document.getElementById('ptari'+pos).value)));

          }

          function calcolo_netto_(pos)
          {
            var netto = document.getElementById('netto'+pos);
            netto.value=parseFloat(document.getElementById('pef'+pos).value);
          }


      </script>




    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/colors.css" rel="stylesheet">
    <link href="../js/bootstrap.bundle.min.js">


    </head>

   <body>
     <div class="container-fluid" >
        <div class="container pt-5 mb-3">
      <div class="row">
        <div class="col-4">
          <h1><?php if($year==2020){echo 'D';}else{echo 'E';} ?>. TAVOLA DI INPUT DELL'ANNO <?php echo $year; ?> </h1>
          <p class="font-weight-bold text-red"> * Campi Obbligatori</p>
        </div>
        <div class="col-xl-1 offset-xl-5 ">
          <button type="button" class="btn btn-link " onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: D.','<?php echo $account; ?>')" >
           <a class="text-primary">
              Help?
           </a>
        </button>
        </div>

        <div class="col-xl-1 ">
          <a href="./welcome.php">
            <button class="btn bg-color-2 text-white mr-2">
             <i class="bi bi-arrow-90deg-left"></i>
             Indietro
            </button>
          </a>
        </div>


          <div class="col-xl-1">
             <button type="button" class="btn bg-color-1 text-white" data-toggle="modal" data-target="#exampleModalCenter">
               Esci
             </button>
           </div>
      </div>


    <!--<h4 style="margin-left:10px">Il tuo KAM è (kam_user) contattabile al numero (tel_cam)</h4> -->
      <form action="./input_save.php" method = "post"  style="margin:10px">
      <input type="number" id="report_id" name = "report_id" value="<?php echo $report_id; ?>" hidden></input>
      <input type="number" id="user_id" name = "user_id" value="<?php echo $user_id; ?>" hidden></input>
      <input type="text" id="username" name = "username" value="<?php echo $username; ?>" hidden></input>
      <input type="text" id="account" name = "account" value="<?php echo $account; ?>" hidden></input>
      <input type="text" id="town" name = "town" value="<?php echo $town; ?>" hidden></input>
      <input type="text" id="year" name = "year" value="<?php echo $year; ?>" hidden></input>
      <input type="text" id="title" name = "title" value="<?php echo $title; ?>" hidden></input>


      <hr>

<table style=" width: 1800px; height: 84px;" >
  <tbody>
    <tr style="height: 40px;" class="text-center">
      <td style='width: 15px; height: 40px;'>Anno</td>
      <td style='width: 15px; height: 40px;'class="text-red font-weight-bold">Missione</td>
      <td style='width: 15px; height: 40px;'class="text-red font-weight-bold">Programma</td>
      <td style='width: 15px; height: 40px;'class="  text-red font-weight-bold">Macroaggregato</td>
      <td style='width: 15px; height: 40px;'class="  text-red font-weight-bold">Descrizione</td>
      <td style='width: 15px; height: 40px;'class="  text-red font-weight-bold">Impegno da CCC (lordo IVA)</td>
      <td style='width: 15px; height: 40px;'class="  text-red font-weight-bold">TARI%</td>
      <td style='width: 15px; height: 40px;'class="  text-red font-weight-bold">Imputazione PEF (lordo IVA)</td>
      <td style='width: 10px; height: 40px;'class="  text-black font-weight-bold">Tipologia di costo</td>
      <td style='width: 15px; height: 40px;'class="  text-red font-weight-bold">%IVA</td>
      <td style='width: 15px; height: 40px;'class="  text-black font-weight-bold">Voce Bilancio</td>
      <td style='width: 15px; height: 40px;'class="  text-black font-weight-bold">Gestione</td>
      <td style='width: 20px; height: 40px;'class="  text-red font-weight-bold">Imputazione Netto IVA</td>
      <td style='width: 20px; height: 40px;'class="  text-red font-weight-bold">&nbsp;IVA&nbsp;</td>
      <td style='width: 20px; height: 40px;'class="  text-black font-weight-bold">Note</td>
      <td style='width: 0px; height: 40px;'class="  text-black font-weight-bold">&nbsp;</td>

    </tr>

      <tr style="height: 40px;" class="text-center">
        <td style=' height: 40px;' class="  p-1">
          <input class="w-100" type="number" class="campo" id="year" name = "year" onchange="input_submit_chk();" value="<?php echo $year; ?>" disabled required></input>
        </td>
        <td style=' height: 40px;'class="  p-1">
          <input class="w-100" type="number" class="campo" id="missione" name = "missione" required style="width:70px">
        </td>
        <td style='height: 40px;'class="  p-1">
          <input class="w-100" type="number" class="campo" id="programma" name = "programma" required>
        </td>
        <td style=' height: 40px;'class="  p-1">
          <input class="w-100" type="number" class="campo" id="macroaggregato" name = "macroaggregato" required>
        </td>
        <td style=' height: 40px;'class="  p-1">
          <input class="w-100" type="text" id="descrizione" name = "descrizione" reqired>
        </td>
        <td style=' height: 40px;'class="  p-1">
          <input class="w-100" min="0" step="0.01" type="number" id="impegno" name = "impegno" onchange="calcola_pef();calcola_netto();"></input>
        </td>
        <td style=' height: 40px;'class="  p-1">
          <input class="w-100" min="0" max="100" step="0.01" type="number" id="ptari" name = "ptari" onchange="calcola_pef();calcola_netto();"></input>
        </td>
        <td style='height: 40px;'class="  p-1">
          <input class="w-100" min="0" step="0.01" type="number" id="pef" name = "pef" onchange="calcola_netto();">
        </td>
        <td style='width: 3%; height: 40px;'class="  p-1">
          <select class="w-100" id="costo" name="costo" onchange="input_submit_chk();" required autofocus>
              <option value="">Seleziona</option>
              <option value="ACC">ACC</option>
              <option value="CGG">CGG</option>
              <option value="AMM">AMM</option>
              <option value="Canone">Canone</option>
              <option value="CARC">CARC</option>
              <option value="CoAL">CoAL</option>
              <option value="CRD">CRD</option>
              <option value="CRT">CRT</option>
              <option value="CSL">CSL</option>
              <option value="CTR">CTR</option>
              <option value="CTS">CTS</option>
            </select>
          </td>
        <td style=' height: 40px;'class="  p-1">
          <select class="w-100" id="piva" name="piva" onchange="calcola_netto();input_submit_chk();">
            <option value="">Seleziona</option>
            <option value="0">0%</option>
            <option value="10">10%</option>
            <option value="22">22%</option>
          </select>
        </td>
        <td style=' height: 40px;'class="  p-1">
          <select class="w-100" id="bilancio" name="bilancio" onchange="input_submit_chk();" required autofocus>
            <option value="">Seleziona</option>
            <option value="B6">B6: Materie Prime/Sussidiarie/Consumo/Merci</option>
            <option value="B7">B7: Servizi</option>
            <option value="B8">B8: Godimento beni di terzi</option>
            <option value="B9">B9: Personale</option>
            <option value="B10">B10: Ammortamenti e svalutazioni</option>
            <option value="B11">B11: Variazione delle rimanenze</option>
            <option value="B12">B12: Accantonamenti per rischi</option>
            <option value="B13">B13: Altri accantonamenti</option>
            <option value="B14">B14: Oneri diversi di gestione</option>
          </select>
        </td>
        <td style=" height: 40px;"class="  p-1">
          <select class="w-100" id="gestione" name="gestione" onchange="input_submit_chk();" required autofocus>
            <option value="">Seleziona</option>
            <option value="COMUNE">Comune</option>
            <option value="GESTORE">Gestore</option>
          </select>
        </td>
        <td style=' height: 40px;'class="  p-1">
          <input class="w-100" min="0" step="0.01" type="number" id="netto" name = "netto">
          </td>
        <td style=' height: 40px;'class="  p-1">
          <input class="w-100" min="0" step="0.01" type="number" id="iva" name = "iva">
        </td>
        <td style='height: 40px;'class="  p-1">
          <input class="w-100" type="text" id="note" name = "note">
        </td>
        <td style=' height: 40px;'class="  p-1">
          <input id="save_input" name="save_input" class="btn bg-theme btn-save w-100 rounded font-weight-bold text-red" type="submit" value="Aggiungi" disabled="true">
        </td>
      </tr>
    </tbody>
  </table>

    <div class="container" style="max-width:100% ">
      <div class="row"  >
        <div class="col-sm-12" width=100% style="color:#000;font-size:18px;background-color:#fff">
          <a>Compilare tutti i campi indicati nella griglia, dopo aver verificato la correttezza dei dati,cliccare il pulsante 'Aggiungi' per salvare i dati inseriti.</a><br>
          <a>La riga appena inserita sarà riportata nella tabella DATI INSERITI e sarà quindi possibile compilare una nuova riga.</a><br>
          <a>I valori presenti nella tabella DATI INSERITI possono essere ulteriormente modificati (e poi salvati tramite tramitel'apposito pulsante) oppure possono essere eliminati.</a>
        </div>
      </div>
    </div>
    <hr>
    </form>

      <h1 style="margin:10px">Dati Inseriti</h1>

      <?php
      $sql = "SELECT `u`.`email`, `i`.* FROM `input` `i` INNER JOIN `users` `u` ON `i`.`user_creator_id`=`u`.`id` WHERE `i`.`report_id`= $report_id AND `year`=$year AND `i`.`valid`=1 AND `i`.`visible`=1";
      $res = $db->query($sql);

      if (mysqli_num_rows($res)) {

        echo "<table  width=100% style=margin:10px>
          <thead>
            <tr style=text-align:center>
              <th class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Account</span></th>
              <th class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Data Inserimento</span></th>
              <th class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Anno</span></th>
              <th class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Missione</span></th>
              <th class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Programma</span></th>
              <th class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Macroaggregato</span></th>
              <th class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Descrizione</span></th>
              <th class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Impegno</span></th>
              <th class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>TARI%</span></th>
              <th class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>PEF Lordo</span></th>
              <th class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Tipo di costo</span></th>
              <th class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>IVA%</span></th>
              <th class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Voce Bilancio</span></th>
              <th class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Gestione</span></th>
              <th class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Netto</span></th>
              <th class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>IVA</span></th>
              <th class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Note</span></th>
            </tr>
          </thead>";


        // output data of each row
        $cont=0;
        while($row = $res->fetch_assoc()) {
          echo "
                <tr>
              <form method='post' action='edit_row.php'>
                <tr>
                  <td><input name=account type=text value=".$row['email']." readonly></td>
                  <td><input name=create_date class=l-10 type=text value=\"".$row['create_date']."\" readonly></td>
                  <td><input name=anno class=l-5 type=text value=".$row["year"]." readonly></td>
                  <td><input name=missione class=l-5 type=text value=\"".$row['missione']."\"></td>
                  <td><input name=programma class='l-5 w-100'  type=text value=\"".$row['programma']."\"></td>
                  <td><input name=macroaggregato class='l-5 w-100' type=text value=\"".$row['macroaggregato']."\"></td>
                  <td><input name=descrizione class='w-100' type=text value=\"".$row['descrizione']."\"></td>
                  <td><input id=impegno$cont min=0 step=0.01 onchange=calcolo_ptari_($cont);calcolo_netto_($cont); name=impegno class=l-10 type=number value=".$row["impegno"]." ></td>
                  <td><input id=ptari$cont min=0 max=100 step=0.01 onchange=calcolo_ptari_($cont);calcolo_netto_($cont); name=ptari class=l-10 type=number value=".$row["ptari"]." ></td>
                  <td><input id=pef$cont min=0 step=0.01 name=pef onchange=calcolo_netto_($cont); class=l-10 type=number value=".$row["pef"]." ></td>
                  <td><select  class='l-10' name=costo >
                    <option value=".$row["costo"]." selected>$row[costo]</option>
                    <option value=ACC>ACC</option>
                    <option value=CGG>CGG</option>
                    <option value=AMM>AMM</option>
                    <option value=Canone>Canone</option>
                    <option value=CARC>CARC</option>
                    <option value=CoAL>CoAL</option>
                    <option value=CRD>CRD</option>
                    <option value=CRT>CRT</option>
                    <option value=CSL>CSL</option>
                    <option value=CTR>CTR</option>
                    <option value=CTS>CTS</option>
                  </select></td>
                  <td>
                  <select class='l-10' name=piva>
                    <option value=".$row["piva"].">".$row["piva"]."%</option>
                    <option value=0>0%</option>
                    <option value=10>10%</option>
                    <option value=22>22%</option>
                  </select>
                  </td>

                  <td class=campo>
                    <select class=l-10 name=bilancio  required autofocus>
                      <option value=".$row["bilancio"].">".$row["bilancio"]."</option>
                      <option value=B6>B6: Materie Prime/Sussidiarie/Consumo/Merci</option>
                      <option value=B7>B7: Servizi</option>
                      <option value=B8>B8: Godimento beni di terzi</option>
                      <option value=B9>B9: Personale</option>
                      <option value=B10>B10: Ammortamenti e svalutazioni</option>
                      <option value=B11>B11: Variazione delle rimanenze</option>
                      <option value=B12>B12: Accantonamenti per rischi</option>
                      <option value=B13>B13: Altri accantonamenti</option>
                      <option value=B14>B14: Oneri diversi di gestione</option>
                    </select>
                  </td>
                  <td>
                  <select class=select name=gestione required autofocus>
                    <option value=".$row["gestione"].">".$row["gestione"]."</option>
                    <option value=COMUNE>Comune</option>
                    <option value=GESTORE>Gestore</option>
                  </select>
                  </td>
                  <td><input min=0 step=0.01 id=netto$cont class=l-10 name=netto type=number value=".$row["netto"]."></td>
                  <td><input class=l-10 name=iva type=number value=".$row["iva"]."></td>
                  <td><input class=l-10 name=note type=text value=\"".$row['note']."\"></td>
                  ";
                  $id=$row["id"];
                   echo"
                  <td><button type=submit class='btn btn-blu' name=id_riga value=s".$row["id"]." style=visibility:visible>Salva</button></td>
                  <td><button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target=#exampleModal$id  value=d".$row["id"]." onClick=load_del_id(this.value); style=visibility:visible>
                  <i class=bi-trash>&nbsp;</i>
                  </button></td>
                  <div class='modal fade' id=exampleModal$id tabindex='-1' aria-labelledby='exampleModalLabel$id' aria-hidden='true'>
                      <div class='modal-dialog'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <h5 class='modal-title' id='exampleModalLabel$id'>Conferma</h5>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                          </div>
                          <div class='modal-body'>
                            Sei sicuro di voler eliminare la riga?
                          </div>
                          <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary rounded font-weight-normal' data-bs-dismiss='modal'>Annulla</button>
                            <button type='submit' name=id_riga  id=del_id$id class='btn bg-theme rounded font-weight-normal text-light'>Elimina</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </tr>
                </form>";
              $cont++;
        }
      }else {
        echo "Nessuna riga inserita";
      }
      echo "</table>";
      echo "";
      if (isset($cont)) {
        echo " <input type=text value=$cont id=cont hidden>";
        // code...
      }
      $db->close(); ?>

      <hr>

      <h1 style="margin:10px">Esempio di Compilazione</h1>
      <img src="../img/Esempio_tavole_D_E.jpg" alt="Input Sample" style="align:center;margin:10px"><br>

      <!-- Button trigger modal -->
      <?php include 'modal.php';  ?>


      <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
      <script type="text/javascript" src="../js/scripts.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </div>
  </div>
  </body>
</html>
