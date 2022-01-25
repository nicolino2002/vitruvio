<?php
include('session.php');
include('cdn.php');
  // Retrieve data from html
  $report_id = trim($_GET['report_id']);
  $username = trim($_GET['username']);
  $account = trim($_GET['account']);
  $town = trim($_GET['town']);
  $title = trim($_GET['title']);
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
      <title>INPUT Template ver. 1.0</title>
      <script type="text/javascript">



      function calcolo_totale()
      {
        document.getElementById("totale").value = parseFloat(document.getElementById("quant").value)*parseFloat(document.getElementById("prezzo").value);
      }

      function updateInput(ish,type){
        document.getElementById(type).value = ish;
      }

      function load_del_id(id){
        id2 = id.match(/\d+/)[0] // "3"
        document.getElementById('del_id'+id2).value=id;

      }


          function calcolo_totale_riga(pos)
            {

                    var totale = document.getElementById('totale'+pos);
                    totale.value = parseFloat(document.getElementById('quant'+pos).value)*parseFloat(document.getElementById('prezzo'+pos).value);

                  }





      </script>

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

            .th
            {
              padding:2px 2px;
              height:30px;
              width:100px;
              v-align:middle;
              text-align:center;
			        font-weight: bold;
            }
            .man
            {
              padding:2px 2px;
              height:30px;
              width:100px;
              v-align:middle;
              text-align:center;
			        font-weight: bold;
              color:red;
            }
            .campo
            {
              padding:2px 2px;
              height:30px;
              width:80px;
              v-align:middle;
              text-align:center;
            }
            .btn-add,.btn-add:disabled
            {
              color: red;
              background-color: #044A92;
              vertical-align:middle;
            }

            .btn-blu,.btn-blu:disabled
            {
              color: white;
              background-color: #044A92;
              vertical-align:middle;
            }
            .btn-dismiss,.btn-dismiss:disabled
            {
              color: white;
              background-color: grey;
              vertical-align:middle;
            }
            .formtitle
            {text-align: center;
              margin-bottom: 20px;}
            .l-5{
              width: 50px;
            }
            .l-10{
              width: 100px;
            }
            .bold{font-weight: bold}

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

      </style>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/colors.css" rel="stylesheet">

    </head>

   <body>
    <div class="m-5 auto">
      <div class="row">
        <div class="col-7">
          <h1>F. Acquisto servizi CTS CTR</h1>
          <a style="font-weight: bold; color: red;"> * Campi Obbligatori</a>
        </div>
        <div class="col-4 offset-1 text-right">
          <button type="button" class="btn" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: F ','<?php echo $account;  ?>')" ><a class="text-primary">Help?</a></button>
          <button type="button" class="btn" id="logout" data-toggle="modal" data-target="#exampleModalCenter">
            Esci
          </button>
          <a href="./welcome.php"><button class="btn mr-2" id="back"  type="submit">Indietro</button></a>
        </div>
      </div>

<hr>
    <!--<h4 style="margin-left:10px">Il tuo KAM è (kam_user) contattabile al numero (tel_cam)</h4> -->
    <form action="./extra_save.php" method = "post"  style="margin:10px">
      <input type="number" id="report_id" name = "report_id" value="<?php echo $report_id; ?>" hidden></input>
      <input type="number" id="user_id" name = "user_id" value="<?php echo $user_id; ?>" hidden></input>
      <input type="text" id="username" name = "username" value="<?php echo $username; ?>" hidden></input>
      <input type="text" id="account" name = "account" value="<?php echo $account; ?>" hidden></input>
      <input type="text" id="town" name = "town" value="<?php echo $town; ?>" hidden></input>
      <input type="text" id="year" name = "year" value="<?php echo $year; ?>" hidden></input>
      <input type="text" id="title" name = "title" value="<?php echo $title; ?>" hidden></input>


<table style=" width: 1400px; height: 84px;">
  <tbody>

    <tr style="height: 40px;" class="text-center">
      <td style='width: 14%; height: 40px;'class=" text-red font-weight-bold">Soggetto da cui si acquista</td>
      <td style='width: 12%; height: 40px;'class=" text-red font-weight-bold">Tipologia di rifiuto</td>
      <td style='width: 5%; height: 40px;'class=" text-red font-weight-bold">Componente (CTS/CTR)</td>
      <td style='width: 10%; height: 40px;'class=" text-black font-weight-bold">Anno di conferimento</td>
      <td style='width: 12%; height: 40px;'class=" text-red font-weight-bold">Quantitativi conferiti (ton)</td>
      <td style='width: 10%; height: 40px;'class=" text-black font-weight-bold">Prezzo unitario IVA inclusa (Eur/ton)</td>
      <td style='width: 17%; height: 40px;'class=" text-black font-weight-bold">IMPORTO IVA INCLUSA [Euro]</td>
    </tr>

      <tr style="height: 40px;" class="text-center ">

        <td class=" p-1">
          <input type="text" class="form-control w-100" id="soggetto" name="soggetto" required autofocus>
        </td>
        <td class=" p-1">
          <input type="text" class="form-control w-100" id="tipologia" name="tipologia" required autofocus>
        </td>
        <td class=" p-1">
          <select class="form-select w-100" id="componente" name="componente">
            <option value="0">Seleziona</option>
            <option value="CTS">CTS</option>
            <option value="CTR">CTR</option>
          </select>
        </td>
        <td class=" p-1">
          <select class="form-select w-100" id="anno" name="anno">
            <option value="0">Seleziona</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
          </select>
        </td>

        <td class=" p-1">
          <input type="number" step="0.01" class="form-control w-100" id="quant" name="quant" onchange="calcolo_totale()" required autofocus>
        </td>

        <td class=" p-1">
          <input type="number" step="0.01" class="form-control w-100" id="prezzo" name="prezzo" onchange="calcolo_totale()" required autofocus>
        </td>

        <td class=" p-1">
          <input type="number" step="0.01" class="form-control w-100" id="totale" name="totale" required>
        </td>

        <td style='width: 2%; height: 40px;'class=" p-1">
          <input id="save_extra" name="save_extra" class="btn bg-theme btn-save w-100 rounded font-weight-bold text-light" type="submit" value="Aggiungi" disabled="true">
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
      $sql = "SELECT * FROM `extra` WHERE  `report_id`=$report_id AND valid AND visible =1";
      $sql = "SELECT `u`.`email`, `e`.* FROM `extra` `e` INNER JOIN `users` `u` ON `e`.`user_creator_id`=`u`.`id` WHERE `e`.`report_id`= $report_id  AND `e`.`valid`=1 AND `e`.`visible`=1";

      $res = $db->query($sql);

      if (mysqli_num_rows($res) > 0) {

        echo "<table  width=1450px style=margin:10px>
          <thead>
            <tr style=text-align:center>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Account</span></th>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Data Inserimento</span></th>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Soggetto da cui si acquista</span></th>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Tipologia di rifiuto</span></th>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Componente (CTS/CTR)</span></th>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Anno di conferimento	</span></th>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Quantitativi conferiti (ton)</span></th>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>Prezzo unitario IVA inclusa (Eur/ton)	</span></th>
              <td class='editCellHead'><span style='font-size: 12px; font-weight: bold;'>IMPORTO IVA INCLUSA [Euro]</span></th>
            </tr>
          </thead>";


        // output data of each row
        $cont=0;
        while($row = $res->fetch_assoc()) {
          echo "
                <tr>
              <form method='post' action='edit_row_extra.php'>
                <tr>

                  <td><input name=account class='l-10 w-100' type=text value=".$row['email']." readonly></td>
                  <td><input name=create_date class='l-10 w-100' type=text value=\"".$row['create_date']."\" readonly></td>

                  <td><input class='l-10 w-100' name=soggetto value=\"".$row['soggetto']."\"></td>
                  <td><input class='l-10 w-100' name=tipologia value=\"".$row['tipologia']."\"></td>

                  <td>
                    <select class='l-10 w-100' name=componente>
                      <option value=".$row["componente"].">".$row["componente"]."</option>
                      <option value='CTS'>CTS</option>
                      <option value='CTR'>CTR</option>
                    </select>
                  </td>

                  <td>
                    <select class='l-5 w-100' name=anno>
                      <option value=".$row["anno"].">".$row["anno"]."</option>
                      <option value='2020'>2020</option>
                      <option value='2021'>2021</option>
                    </select>
                  </td>

                  <td><input id=quant$cont min=0 step=0.01 name=quant onchange=calcolo_totale_riga($cont); class='l-10 w-100' type=number value=".$row["quant"]." ></td>
                  <td><input id=prezzo$cont min=0 step=0.01 name=prezzo onchange=calcolo_totale_riga($cont); class='l-10 w-100' type=number value=".$row["prezzo"]." ></td>
                  <td><input id=totale$cont min=0 step=0.01 name=totale class='l-10 w-100' type=number value=".$row["totale"]." ></td>

                  ";
                  $id=$row["id"];
                   echo"
                  <td><button type=submit class='btn btn-blu' name=id_riga value=s".$row["id"]." style=visibility:visible>Salva</button></td>
                  <td class=p-0><button type='button' height='100%' class='btn btn-danger' data-bs-toggle='modal' data-bs-target=#exampleModal$id  value=d".$row["id"]." onClick=load_del_id(this.value); style=visibility:visible>
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
      <!-- Button trigger modal -->
      <!-- Modal -->

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
              <form action="./logout.php" method="post">
                <button style="width:70px" type="submit" id="back" class="btn">Si</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="../js/jquery.js"></script>
      <script type="text/javascript" src="../js/scripts.js"></script>
      <script type="text/javascript" src="../js/save_extra.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    </div>
  </body>
</html>
