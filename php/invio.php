<?php
  session_start();
  // Retrieve data from html
  $report_id = trim($_GET['report_id']);
  $username = trim($_GET['username']);
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
  // get town id
  $town=addslashes($town);
  $sql = "SELECT `id` FROM `towns` WHERE `town`= '$town'";
  $ses_sql = mysqli_query($db,$sql);
  $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
  $town_id = $row['id'];
  // get invio record data
  $sql = "SELECT * FROM `invio` WHERE `report_id`= $report_id";
  $ses_sql = mysqli_query($db,$sql);
  $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
  $invio_id = $row['id'];
  $invio_report_id = $row['report_id'];
  $invio_completed = $row['completed'];
  $invio_user_creator_id = $row['user_creator_id'];
  $invio_create_date = $row['create_date'];
  $invio_last_modified_id = $row['last_modified_id'];
  $invio_last_modified_date = $row['last_modified_date'];
  $invio_id = $row['id'];
  $invio_report_id = $row['report_id'];
  $invio_completed = $row['completed'];
  $invio_user_creator_id = $row['user_creator_id'];
  $invio_create_date = $row['create_date'];
  $invio_last_modified_id = $row['last_modified_id'];
  $invio_last_modified_date = $row['last_modified_date'];

  $pef_comune_grezzo_2020 = $row['pef_comune_grezzo_2020'];
  $relazione_pef_comune_2020 = $row['relazione_pef_comune_2020'];
  $pef_comune_grezzo_2021 = $row['pef_comune_grezzo_2021'];
  $relazione_pef_comune_2021 = $row['relazione_pef_comune_2021'];
  $pef_comune_etc_2020 = $row['pef_comune_etc_2020'];
  $pef_comune_etc_2021 = $row['pef_comune_etc_2021'];
  $contratto_gestore = $row['contratto_gestore'];
  $delibera_2021 = $row['delibera_2021'];
  //$invio_pef2020_gestore_file = $row['pef2020_gestore_file'];


  $invio_valid = $row['id'];
  $invio_visible = $row['id'];

  $town=$_SESSION['login_town'];

?>
<html>
   <head>
      <title>Invio Files</title>

          <link href="../css/bootstrap.min.css" rel="stylesheet">
          <link href="../css/colors.css" rel="stylesheet">
          <link href="../js/bootstrap.bundle.min.js">
          <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>


          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

      <?php include('cdn.php'); ?>
      <script type="text/javascript">
      function refreshPage(){

        window.location.reload();
        location.reload();
        location.reload(true);

      }

      function download(filename,town_id){
        var town=document.getElementById('town').value;
        fetch('../uploads/'+town+'-'+town_id+'-'+filename)
            .then(resp => resp.blob())
            .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            // the filename you want
            a.download = filename;
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
            //alert('your file has downloaded!'); // or you know, something with better UX...
          })
          .catch(() => alert('oh no!'));
      }
      </script>


    </head>

   <body>


      <div class="container-fluid" style="background-color:#f5f5f5">
         <div class="container pt-5 mb-3">
           <div class="row">
             <div class="col-4">
               <h1>C. FILE DATI</h1>

               <?php echo " <input type='text' id='town' value= \"".$town."\"; hidden>";?>
             </div>
             <div class="col-xl-1 offset-xl-5 ">
               <button type="button" class="btn btn-link " onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: C.','<?php echo $account; ?>')" >
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
           <div class="row">
             <div class="col-12">
               <h5 class="text-red">I campi in rosso sono obbligatori</h5>
             </div>
           </div>
           <div class="row">
             <div class="col-12">
               <h5 class="text-black">
                 Per ogni box selezionare il file da caricare
                  (estensioni consentite: .pdf, .docx, .xls, .zip) e premere il pulsante di upload.<br>
                  E' possibile eliminare i singoli files caricati tramite il relativo pulsante.<br>
                 Successivamente sarà possibile caricare il file sostitutivo
                 tramite la medesima procedura usata al primo caricamento.
               </h5>
             </div>
           </div>
         </div>

         <div class="container">
           <div class="row">
               <div class="col-12 bg-theme rounded">
                 <h3 class="text-light m-4">Files:</h3>
               </div>

               <!--<input id="help" class="btn" type="button" value="Help" onclick="php_mail('Utente: <?php echo $username ?>, Comune: <?php echo $town ?>, Form: B. PREVISIONALI 2021, Campo: 1. Contributo MIUR.','
               <?php //echo $account; ?>
               ')">-->
               <?php $index=1;?>
                  <div class="col-sm-12 col-xl-6 p-3 border">
                    <form action="./upload_file.php" method = "post" enctype="multipart/form-data">
                    <label class="text-red font-weight-bold"><?php echo $index;$index++; ?>. Caricare PEF GREZZO 2020 in formato excel</label>
                    <div class="input-group">
                      <input id="pef_comune_grezzo_2020" name="pef_comune_grezzo_2020" type="file" class="form-control pr-1 w-50"  autofocus <?php if(!$pef_comune_grezzo_2020){echo "required";} ?>>

                      <?php


                      if (!$pef_comune_grezzo_2020) {
                        echo "<button type='submit' class='btn bg-theme text-light' name='button'><i class='bi bi-upload'></i></button>";
                      }



                        if ($pef_comune_grezzo_2020)
                            {
                              echo "<button type='button' class='btn btn-danger' onclick='elimina(this.value,$town_id,$index-2);refreshPage();' value='$pef_comune_grezzo_2020' name='button'><i class='bi-trash'></i></button>";
                            }
                      ?>

                    </div>
                          <small class="float-right">
                                        <?php
                                         if($pef_comune_grezzo_2020)
                                              {

                                                echo "
                                                <button name='file1' class='hidden-button'   onclick='download(this.value,$town_id)'  value='$pef_comune_grezzo_2020' >
                                                  <a href=#>".$pef_comune_grezzo_2020."&nbsp; <i class='bi bi-download'></i></a>
                                                </button>";
                                              }
                                        ?>
                          </small>
                        </form>
                      </div>


                  <div class="col-sm-12 col-xl-6 p-3 border">
                    <form action="./upload_file.php" method = "post" enctype="multipart/form-data">
                    <label class="text-red font-weight-bold"><?php echo $index;$index++; ?>. Caricare relazione di accompagnamento al PEF COMUNE 2020</label>
                    <div class="input-group">
                      <input id="relazione_pef_comune_2020" name="relazione_pef_comune_2020" type="file" class="form-control w-50" autofocus <?php if(!$relazione_pef_comune_2020){echo "required";} ?>>
                      <?php

                      if (!$relazione_pef_comune_2020) {
                        echo "<button type='submit' class='btn bg-theme text-light' name='button'><i class='bi bi-upload'></i></button>";
                      }

                        if ($relazione_pef_comune_2020)
                            {
                              echo "<button type='button' class='btn btn-danger' onclick='elimina(this.value,$town_id,$index-2);refreshPage()' value='$relazione_pef_comune_2020' name='button'><i class='bi-trash'></i></button>";
                            }
                      ?>
                    </div>
                      <small class="float-right">
                                    <?php
                                     if(isset($relazione_pef_comune_2020))
                                          {
                                            echo "
                                            <button name='file1' class=hidden-button   onclick='download(this.value,$town_id)'  value='$relazione_pef_comune_2020' >
                                              <a href=#>".$relazione_pef_comune_2020."&nbsp; <i class='bi bi-download'></i></a>
                                            </button>";
                                          }
                                    ?>
                    </small>
                  </form>
                  </div>

                  <div class="col-sm-12 col-xl-6 p-3 border">
                    <form action="./upload_file.php" method = "post" enctype="multipart/form-data">
                    <label class="text-red font-weight-bold"><?php echo $index;$index++; ?>. Caricare PEF GREZZO 2021 in formato excel</label>
                    <div class="input-group">
                      <input id="pef_comune_grezzo_2021" name="pef_comune_grezzo_2021" type="file" class="form-control w-50" autofocus <?php if(!$pef_comune_grezzo_2021){echo "required";}?>>
                      <?php
                      if (!$pef_comune_grezzo_2021) {
                        echo "<button type='submit' class='btn bg-theme text-light' name='button'><i class='bi bi-upload'></i></button>";
                      }

                        if ($pef_comune_grezzo_2021)
                            {
                              echo "<button type='button' class='btn btn-danger' onclick='elimina(this.value,$town_id,$index-2);refreshPage()' value='$pef_comune_grezzo_2021' name='button'><i class='bi-trash'></i></button>";
                            }
                      ?>
                    </div>
                    <small class="float-right">
                                  <?php
                                   if(isset($pef_comune_grezzo_2021))
                                        {
                                          $town=$_SESSION['login_town'];
                                          echo "
                                          <button name='file1' class=hidden-button   onclick='download(this.value,$town_id)'  value='$pef_comune_grezzo_2021' >
                                            <a href=#>".$pef_comune_grezzo_2021."&nbsp; <i class='bi bi-download'></i></a>
                                          </button>";
                                        }
                                  ?>
                    </small>
                  </form>
                </div>

                  <div class="col-sm-12 col-xl-6 p-3 border">
                    <form action="./upload_file.php" method = "post" enctype="multipart/form-data">

                    <label class="text-red font-weight-bold"><?php echo $index;$index++; ?>. Caricare relazione di accompagnamento al PEF COMUNE 2021</label>
                    <div class="input-group">
                      <input id="relazione_pef_comune_2021" name="relazione_pef_comune_2021" type="file" class="form-control w-50" autofocus <?php if(!$relazione_pef_comune_2021){echo "required";}?>>
                      <?php

                      if (!$relazione_pef_comune_2021) {
                        echo "<button type='submit' class='btn bg-theme text-light' name='button'><i class='bi bi-upload'></i></button>";
                      }

                        if ($relazione_pef_comune_2021)
                            {
                              echo "<button type='button' class='btn btn-danger' onclick='elimina(this.value,$town_id,$index-2);refreshPage()' value='$relazione_pef_comune_2021' name='button'><i class='bi-trash'></i></button>";
                            }
                      ?>
                    </div>
                    <small class="float-right">
                                  <?php
                                   if(isset($relazione_pef_comune_2021))
                                        {
                                          $town=$_SESSION['login_town'];
                                          echo "
                                          <button name='file1' class=hidden-button   onclick='download(this.value,$town_id)'  value='$relazione_pef_comune_2021' >
                                            <a href=#>".$relazione_pef_comune_2021."&nbsp; <i class='bi bi-download'></i></a>
                                          </button>";
                                        }
                                  ?>
                    </small>
                  </form>
                </div>

                  <div class="col-sm-12 col-xl-6 p-3 border">
                    <form action="./upload_file.php" method = "post" enctype="multipart/form-data">

                    <label class="text-red font-weight-bold"><?php echo $index;$index++; ?>. Caricare istruttoria approvazione ETC (Ager) COMUNE 2020</label>
                    <div class="input-group">
                      <input id="pef_comune_etc_2020" name="pef_comune_etc_2020" type="file" class="form-control w-50" autofocus <?php if(!$pef_comune_etc_2020){echo "required";}?>>
                      <?php

                      if (!$pef_comune_etc_2020) {
                        echo "<button type='submit' class='btn bg-theme text-light' name='button'><i class='bi bi-upload'></i></button>";
                      }
                        if ($pef_comune_etc_2020)
                            {
                              echo "<button type='button' class='btn btn-danger' onclick='elimina(this.value,$town_id,$index-2);refreshPage()' value='$pef_comune_etc_2020' name='button'><i class='bi-trash'></i></button>";
                            }
                      ?>
                    </div>
                    <small class="float-right">
                                  <?php
                                   if(isset($pef_comune_etc_2020))
                                        {
                                          $town=$_SESSION['login_town'];
                                          echo "
                                          <button name='file1' class=hidden-button   onclick='download(this.value,$town_id)'  value='$pef_comune_etc_2020' >
                                            <a href=#>".$pef_comune_etc_2020."&nbsp; <i class='bi bi-download'></i></a>
                                          </button>";
                                        }
                                  ?>
                    </small>
                  </form>
                </div>

                  <div class="col-sm-12 col-xl-6 p-3 border">
                    <form action="./upload_file.php" method = "post" enctype="multipart/form-data">

                    <label class="text-red font-weight-bold"><?php echo $index;$index++; ?>. Caricare istruttoria approvazione ETC (Ager) COMUNE 2021</label>
                    <div class="input-group">
                      <input id="pef_comune_etc_2021" name="pef_comune_etc_2021" type="file" class="form-control w-50" autofocus <?php if(!$pef_comune_etc_2021){echo "required";}?>>
                      <?php

                            if (!$pef_comune_etc_2021) {
                          echo "<button type='submit' class='btn bg-theme text-light' name='button'><i class='bi bi-upload'></i></button>";
                              }

                        if ($pef_comune_etc_2021)
                            {
                              echo "<button type='button' class='btn btn-danger' onclick='elimina(this.value,$town_id,$index-2);refreshPage()' value='$pef_comune_etc_2021' name='button'><i class='bi-trash'></i></button>";
                            }
                      ?>
                    </div>
                    <small class="float-right">
                                  <?php
                                   if(isset($pef_comune_etc_2021))
                                        {
                                          $town=$_SESSION['login_town'];
                                          echo "
                                          <button name='file1' class=hidden-button id=town   onclick='download(this.value,$town_id)'  value='$pef_comune_etc_2021' >
                                            <a href=#>".$pef_comune_etc_2021."&nbsp; <i class='bi bi-download'></i></a>
                                          </button>";
                                        }
                                  ?>
                    </small>
                  </form>
                </div>

                  <div class="col-sm-12 col-xl-6 border p-3 mb-5">
                    <form action="./upload_file.php" method = "post" enctype="multipart/form-data">

                    <label class="text-red font-weight-bold"><?php echo $index;$index++; ?>. Caricare contratto con il gestore sei servizi RU</label>
                    <div class="input-group">
                      <input id="contratto_gestore" name="contratto_gestore" type="file" class="form-control w-50" autofocus <?php if(!$contratto_gestore){echo "required";}?>>
                      <?php

                      if (!$contratto_gestore) {
                        echo "<button type='submit' class='btn bg-theme text-light' name='button'><i class='bi bi-upload'></i></button>";
                        }

                        if ($contratto_gestore)
                            {
                              echo "<button type='button' class='btn btn-danger' onclick='elimina(this.value,$town_id,$index-2);refreshPage()' value='$contratto_gestore' name='button'><i class='bi-trash'></i></button>";
                            }
                      ?>
                    </div>
                    <small class="float-right">
                                  <?php
                                   if(isset($contratto_gestore))
                                        {
                                          $town=$_SESSION['login_town'];
                                          echo "
                                          <button name='file1' class=hidden-button   onclick='download(this.value,$town_id)'  value='$contratto_gestore' >
                                            <a href=#>".$contratto_gestore."&nbsp; <i class='bi bi-download'></i></a>
                                          </button>";
                                        }
                                  ?>
                    </small>
                  </form>
                </div>

                  <div class="col-sm-12 col-xl-6 border p-3 p-3 mb-5">
                    <form action="./upload_file.php" method = "post" enctype="multipart/form-data">

                    <label class="text-red font-weight-bold"><?php echo $index;$index++; ?>. Caricare delibera di approvazione della TARI 2021</label>
                    <div class="input-group">
                      <input id="delibera_2021" name="delibera_2021" type="file" class="form-control w-50" autofocus <?php if(!$delibera_2021){echo "required";}?>>
                      <?php
                      if (!$delibera_2021) {
                        echo "<button type='submit' class='btn bg-theme text-light' name='button'><i class='bi bi-upload'></i></button>";
                        }

                        if ($delibera_2021)
                            {
                              echo "<button type='button' class='btn btn-danger' onclick='elimina(this.value,$town_id,$index-2);refreshPage()' value='$delibera_2021' name='button'><i class='bi-trash'></i></button>";
                            }
                      ?>
                    </div>
                    <small class="float-right">
                                  <?php
                                   if(isset($delibera_2021))
                                        {
                                          $town=$_SESSION['login_town'];
                                          echo "
                                          <button name='file1' class=hidden-button   onclick='download(this.value,$town_id)'  value='$delibera_2021' >
                                            <a href=>".$delibera_2021."&nbsp; <i class='bi bi-download'></i></a>
                                          </button>";
                                        }
                                  ?>
                    </small>
                  </form>
                </div>


                 </div>
               </div>


               <?php include 'modal.php';  ?>


     <script type="text/javascript" src="../js/bootstrap.min.js"></script>
     <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
     <script type="text/javascript" src="../js/scripts.js"></script>
     <script type="text/javascript" src="../js/download_file.js"></script>
     <script type="text/javascript" src="../js/delete_file.js"></script>

     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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
