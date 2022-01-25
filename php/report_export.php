<?php
  include('session.php');
  // Retrieve data from html


  $report_id=$_SESSION['report_id'];
  $town=$_SESSION['login_town'];
  $town_id=$_SESSION['town_id'];
  $account=$_SESSION['account'];
  $fy = date('Y');

  // Retrieve data from table
  //include('config.php');
  // get user id
  $sql = "SELECT `id` FROM `users` WHERE `email`= '$account'";
  $ses_sql = mysqli_query($db,$sql);
  $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
  $user_id = $row['id'];


  //close connection
?>

<html>
   <head>
      <title>Excel Export</title>

      <link href="../css/bootstrap.min.css" rel="stylesheet">
      <link href="../css/index.css" rel="stylesheet">
      <link href="../js/bootstrap.bundle.min.js">

      <?php include('cdn.php'); ?>


      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <script type="text/javascript">
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
     <?php if (!isset($_SESSION['export_town'])) {
       $_SESSION['export_town']=0;
     } ?>

    <script type="text/javascript">
     function change_town(str) {
        if (str.length == 0) {
          return;
        } else {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {

          };
          xmlhttp.open("GET", "change_export_town.php?town=" + str, true);
          xmlhttp.send();
          window.location.reload();
          }
        }
     </script>
     <?php
      $export_town=$_SESSION['export_town']
     ?>
       <div class="container pt-5 mb-3">
         <div class="row">
           <div class="col-4">
             <h1>FILE EXPORT</h1>
           </div>
             <div class="col-4 offset-4 text-right">
               <button type="button" class="btn" id="logout" data-toggle="modal" data-target="#exampleModalCenter">
                 Esci
               </button>
               <a href="./welcome.php"><button class="btn mr-2" id="back"  type="submit">Indietro</button></a>
             </div>
           </div>

             <div class="row">
               <div class="col-12 bg-theme rounded">
                 <h3 class="text-light m-4">Esportazione report in excel:</h3>
               </div>
             </div>
             <div class="row p-0 pt-4 m-0">
               <div class="col-xl-6 text-center m-0">
                 <h5>Comune:</h5>
               </div>
               <div class="col-xl-6 text-center m-0">
                 <h5><?php
                 $sql = "SELECT `id_town` FROM `reports` WHERE `valid`='1' AND `visible`='1' AND `id`='$export_town'";
                  $result = $db->query($sql);

                  if ($result->num_rows == 1) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $town_id=$row['id_town'];
                    }
                  }

                  $sql = "SELECT `town` FROM `towns` WHERE `valid`='1' AND `visible`='1' AND `id`='$town_id'";
                   $result = $db->query($sql);

                   if ($result->num_rows == 1) {
                     // output data of each row
                     while($row = $result->fetch_assoc()) {
                         $town=$row['town'];
                         if (isset($_SESSION['export_town']) && $_SESSION['export_town']!=0) {
                           echo $town;
                          }
                     }
                   }                     echo " <input type='text' id='town' value= \"".$town."\"; hidden>";
                    ?>

                  </h5>
               </div>
             </div>
             <div class="row p-4 pt-0 pb-5  m-0">
               <div class="col-xl-6 text-center m-0">
                 <form  action="report_export_download.php" method = "post">
                 <select class="form-select w-100" onchange="change_town(this.value)" name="town">
                    <?php

                          $sql = "SELECT DISTINCT A.`town`,A.`id`,A.`visible`,A.`valid`,
	                         B.`visible`,B.`valid`,B.`id`,B.`id_town`
                           FROM `towns` A,`reports` B WHERE 	A.`id`=B.`id_town`
                           AND A.`valid`=1 AND A.`visible`=1
                           AND B.`valid`=1 AND B.`visible`=1";
                           $result = $db->query($sql);
                           echo $db->error;
                           if ($result->num_rows > 0) {
                           // output data of each row
                           echo "<option value=0 selected>Please Select</option>";
                            while($row = $result->fetch_assoc()) {
                                    echo "<option class=text-success ";

                                     if ($row['town']==$town && !empty($town) && $_SESSION['export_town']!=0)
                                      echo "selected";

                                    echo" value=".$row['id'].">".$row['town']."</option>";

                            }
                            }

                            $sql = "SELECT DISTINCT A.`town`,A.`id`,A.`visible`,A.`valid`,
                             B.`visible`,B.`valid`
                             FROM `towns` A,`reports` B WHERE A.`id` NOT IN (SELECT B.`id_town`)
                             AND A.`valid`=1 AND A.`visible`=1
                             AND B.`valid`=1 AND B.`visible`=1";
                            $result = $db->query($sql);
                            echo $db->error;
                            if ($result->num_rows > 0) {
                            // output data of each row
                              while($row = $result->fetch_assoc()) {
                                      echo "<option class=text-red value=0 disabled=true>".$row['town']."</option>";

                              }
                              }




                     ?>

                 </select>


              </div>
              <div class="col-xl-6 col-sm-12 text-left m-0">
                <button type="submit" class="btn bg-theme text-light w-100" name="button">Scarica <i class="bi-download"></i></button>
              </div>
            </form>
             </div>

             <div class="row text-center">
               <div class="col-12">
                 <?php
                 if (isset($_SESSION['export_town']) && !empty($export_town) && $export_town!=0) {

                   $sql="SELECT `sent_times` FROM `reports` WHERE `id`=$export_town AND `valid`=1 AND `visible`=1;";
                   $res = $db->query($sql);
                   $row = $res->fetch_assoc();
                   $sent_times=$row['sent_times'];
                   if (($sent_times)!=NULL) {
                     echo "<h3>Il comune di ".$town." ha inviato il report ".$sent_times." volte </h3>";
                   }
                }
                  ?>
               </div>
             </div>

             <!-- MTN -->
             <div class="row text-center">
               <div class="col-12">
                 <h1 class="text-theme">MTN</h1>
               </div>
                <div class="col-12">
                  <div class="container">


                    <table>

                    <?php
                    $fields_name=array(
                                         'rag_soc',
                                         'canone_mtn',
                                         'contr_chk',
                                         'conai_chk',
                                         'cts_chk',
                                         'ctr_chk',
                                         'csl_chk',
                                         'ru_chk',
                                         'data_del',
                                         'data_app',
                                         'ces_chk',
                                         'ces_desc',
                                         'lav_chk',
                                         'lav_desc',
                                         'att_gest_chk',
                                         'qual_chk'
                                      );

                  echo "<tr class='p-3 pl-2 pr-2'>";
                    for ($i=0; $i < count($fields_name); $i++) {
                      echo "

                        <td class='border text-center p-2 pl-3 pr-3'>
                          ".$fields_name[$i]."
                        </td>";
                    }
                    echo "<td class='border pr-2 pl-2'>Invio n.</td>";


                     ?>

                  </div>
                </div>

                <div class="col-6">
                  <div class="container">

                    <?php
                    $sql = "SELECT `id`,`valid`,`visible` FROM `reports` WHERE `id_town`=$town_id";
                    $result = $db->query($sql);
                    echo $db->error;
                    $cont=0;

                    if ($result->num_rows > 0) {

                      while($row = $result->fetch_assoc()) {
                        $tmp=$row['id'];
                        $cont++;

                        $sql = "SELECT * FROM `mtn` WHERE  `report_id`='$tmp'";
                        $result2 = $db->query($sql);
                        echo $db->error;
                        if ($result2->num_rows > 0) {
                          while($row2 = $result2->fetch_assoc()) {
                            echo "<tr>";

                        for ($i=0; $i < count($fields_name); $i++) {

                          if ($row['valid']==1 && $row['visible']==1) {
                            // code...

                          echo "
                          <td class=' text-center bg-theme text-light'>";
                        }else {
                          echo "
                          <td class=' text-center '>";
                        }

                               if ($row2[$fields_name[$i]]) {
                                 echo $row2[$fields_name[$i]];
                               }
                               else {
                                 echo "NULL";
                               }

                             echo "
                            </td>";
                          }
                          echo "<td>".$cont."</td>";

                          echo "</tr>";
                        }
                      }
                    }
                  }


                  echo "</table>";


                     ?>

                  </div>
                </div>
              </div>

              <!-- MTN -->
              <div class="row text-center pt-5">
                <div class="col-12">
                  <h1 class="text-theme">MTR</h1>
                </div>
                 <div class="col-12">
                   <div class="container">


                     <table>

                     <?php
                     $fields_name=array(
                                             'year',
                                             'tari',
                                             'ricavi_mat',
                                             'ricavi_ener',
                                             'ricavi_inc_ener',
                                             'miur',
                                             'rec_evasione',
                                             'sanzioni',
                                             'ricavi_fp',
                                             'fp_fisse',
                                             'fp_var',
                                             'altre_entrate',
                                             'note',
                                             'fondi_admin',
                                             'fondi_qui',
                                             'fondi_oneri',
                                             'fondi_crediti',
                                             'fondi_tasse',
                                             'fondi_post_mortem',
                                             'fondi_terzi'
                                       );

                   echo "<tr class='p-3'>";
                     for ($i=0; $i < count($fields_name); $i++) {

                       echo "<td class='border text-center p-2'>".$fields_name[$i]."</td>";

                     }
                     echo "<td class='border pr-2 pl-2'>Invio n.</td>";


                      ?>

                   </div>
                 </div>

                 <div class="col-6">
                   <div class="container">

                     <?php
                     $sql = "SELECT `id`,`valid`,`visible` FROM `reports` WHERE `id_town`=$town_id";
                     $result = $db->query($sql);
                     echo $db->error;
                     $cont=0;

                     if ($result->num_rows > 0) {

                       while($row = $result->fetch_assoc()) {
                         $tmp=$row['id'];
                         $cont++;

                         $sql = "SELECT * FROM `mtr` WHERE  `report_id`='$tmp'";
                         $result2 = $db->query($sql);
                         echo $db->error;
                         if ($result2->num_rows > 0) {
                           while($row2 = $result2->fetch_assoc()) {
                             echo "<tr>";

                         for ($i=0; $i < count($fields_name); $i++) {

                           if ($row['valid']==1 && $row['visible']==1) {
                             // code...

                           echo "
                           <td class=' text-center bg-theme text-light'>";
                         }else {
                           echo "
                           <td class=' text-center p-1'>";
                         }

                                if ($row2[$fields_name[$i]]) {
                                  echo $row2[$fields_name[$i]];
                                }
                                else {
                                  echo "NULL";
                                }

                              echo "
                             </td>";
                           }
                           echo "<td>".$cont."</td>";

                           echo "</tr>";
                         }
                       }
                     }
                   }


                   echo "</table>";


                      ?>

                   </div>
                 </div>
               </div>

              <!-- MTR -->
              <div class="row text-center pt-5">

                 <div class="col-12">
                   <h1 class="text-theme">FILE DATI</h1>
                 </div>

                 <div class="col-6">
                   <div class="container">


                     <table>

                     <?php





                     $fields_name=array(
                       'pef_comune_grezzo_2020',
                       'relazione_pef_comune_2020',
                       'pef_comune_grezzo_2021',
                       'relazione_pef_comune_2021',
                       'pef_comune_etc_2020',
                       'pef_comune_etc_2021',
                       'contratto_gestore',
                       'delibera_2021',
                                       );


                     for ($i=0; $i < count($fields_name); $i++) {

                       echo "<tr class='p-3'>";
                         for ($i=0; $i < count($fields_name); $i++) {

                           echo "<td class='border text-center p-3'>".$fields_name[$i]."</td>";

                         }
                         echo "<td class='border pr-2 pl-2'>Invio n.</td>";

                     }
                      ?>

                   </div>
                 </div>
               </div>

                 <div class="col-6">
                   <div class="container">

                     <?php



                                          $sql = "SELECT `id`,`valid`,`visible` FROM `reports` WHERE `id_town`=$town_id";
                                          $result = $db->query($sql);
                                          echo $db->error;
                                          $cont=0;

                                          if ($result->num_rows > 0) {

                                            while($row = $result->fetch_assoc()) {
                                              $tmp=$row['id'];
                                              $cont++;

                                              $sql = "SELECT * FROM `invio` WHERE  `report_id`='$tmp'";
                                              $result2 = $db->query($sql);
                                              echo $db->error;
                                              if ($result2->num_rows > 0) {
                                                while($row2 = $result2->fetch_assoc()) {
                                                  echo "<tr>";

                                              for ($i=0; $i < count($fields_name); $i++) {

                                                if ($row['valid']==1 && $row['visible']==1) {
                                                  // code...

                                                echo "
                                                <td class=' text-center bg-theme text-light'>";
                                              }else {
                                                echo "
                                                <td class=' text-center p-1'>";
                                              }

                                                     if ($row2[$fields_name[$i]]) {
                                                       echo $row2[$fields_name[$i]];
                                                       $content=$row2[$fields_name[$i]];


                                                       if ($row['valid']==1 && $row['visible']==1) {

                                                           echo "
                                                        <button name='file1' class='btn bg-light text-theme'  onclick='download(\"".$content."\",$town_id)'  value='$content'>
                                                         <i class='bi bi-download'></i>
                                                        </button>";
                                                     }





                                                     }
                                                     else {
                                                       echo "NULL";
                                                     }

                                                   echo "
                                                  </td>";
                                                }
                                               echo "<td>".$cont."</td>";
                                                echo "</tr>";
                                              }
                                            }
                                          }
                                        }


                                        echo "</table>";


                                           ?>


                   </div>
                 </div>

                 <div class="row text-center pt-5">

                 <div class="col-12 pt-5">
                   <h1 class="text-theme">INPUT</h1>
                 </div>

                 <div class="col-12">
                   <div class="container">


                  <table>
                      <?php
                      $fields_name=array(
                                      'year',
                                      'missione',
                                      'programma',
                                      'macroaggregato',
                                      'descrizione',
                                      'impegno',
                                      'ptari',
                                      'pef',
                                      'costo',
                                      'piva',
                                      'bilancio',
                                      'gestione',
                                      'netto',
                                      'iva',
                                      'note',
                                        );

                    echo "<tr class='p-3'>";
                    for ($i=0; $i < count($fields_name); $i++) {

                        echo "<td class='border p-3'>".$fields_name[$i]."</td>";

                      }
                      echo "<td class='border pr-2 pl-2'>Invio n.</td>";

                    echo "</tr>";




                                                              $sql = "SELECT `id`,`valid`,`visible` FROM `reports` WHERE `id_town`=$town_id";
                                                              $result = $db->query($sql);
                                                              echo $db->error;
                                                              $cont=0;
                                                              if ($result->num_rows > 0) {

                                                                while($row = $result->fetch_assoc()) {
                                                                  $tmp=$row['id'];
                                                                  $cont++;

                                                                  $sql = "SELECT * FROM `input` WHERE  `report_id`='$tmp'";
                                                                  $result2 = $db->query($sql);
                                                                  echo $db->error;
                                                                  if ($result2->num_rows > 0) {
                                                                    while($row2 = $result2->fetch_assoc()) {
                                                                      echo "<tr>";

                                                                  for ($i=0; $i < count($fields_name); $i++) {

                                                                    if ($row['valid']==1 && $row['visible']==1) {
                                                                      // code...

                                                                    echo "
                                                                    <td class=' text-center bg-theme text-light'>";
                                                                  }else {
                                                                    echo "
                                                                    <td class=' text-center '>";
                                                                  }

                                                                         if ($row2[$fields_name[$i]]) {
                                                                           echo $row2[$fields_name[$i]];
                                                                         }
                                                                         else {
                                                                           echo "NULL";
                                                                         }

                                                                       echo "
                                                                      </td>";
                                                                    }
                                                                  echo "<td>".$cont."</td>";

                                                                    echo "</tr>";
                                                                  }
                                                                }
                                                              }
                                                            }



                     ?>
                  </table>
                  </div>

                  <div class="col-12 pt-5">
                    <h1 class="text-theme">EXTRA</h1>
                  </div>


                  <table width="1000px">
                      <?php
                      $fields_name=array(
                        'soggetto',
                        'tipologia',
                        'componente',
                        'anno',
                        'quant',
                        'prezzo',
                        'totale'
                                        );

                    echo "<tr class='p-3'>";
                    for ($i=0; $i < count($fields_name); $i++) {

                        echo "<td class='border pr-2 pl-2'>".$fields_name[$i]."</td>";

                      }
                      echo "<td class='border pr-2 pl-2'>Invio n.</td>";

                    echo "</tr>";




                                                              $sql = "SELECT `id`,`valid`,`visible` FROM `reports` WHERE `id_town`=$town_id";
                                                              $result = $db->query($sql);
                                                              echo $db->error;
                                                              $cont=0;
                                                              if ($result->num_rows > 0) {

                                                                while($row = $result->fetch_assoc()) {

                                                                  $tmp=$row['id'];
                                                                  $cont++;


                                                                  $sql = "SELECT * FROM `extra` WHERE  `report_id`='$tmp'";
                                                                  $result2 = $db->query($sql);
                                                                  echo $db->error;
                                                                  if ($result2->num_rows > 0) {
                                                                    while($row2 = $result2->fetch_assoc()) {
                                                                      echo "<tr class='p-2 text-center'>";
                                                                  for ($i=0; $i < count($fields_name); $i++) {

                                                                    if ($row['valid']==1 && $row['visible']==1) {
                                                                      // code...

                                                                    echo "
                                                                    <td class=' text-center bg-theme text-light p-2'>";
                                                                  }else {
                                                                    echo "
                                                                    <td class=' text-center pl-2 pr-2'>";
                                                                  }

                                                                         if ($row2[$fields_name[$i]]) {
                                                                           echo $row2[$fields_name[$i]];
                                                                         }
                                                                         else {
                                                                           echo "NULL";
                                                                         }
                                                                       echo "
                                                                      </td>";
                                                                    }
                                                                    echo "<td>".$cont."</td>";
                                                                    echo "</tr>";
                                                                  }

                                                                }
                                                              }
                                                            }



                     ?>
                  </table>



              </div>
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

     <script type="text/javascript" src="../js/bootstrap.min.js"></script>
     <script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
     <script type="text/javascript" src="../js/scripts.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


  </body>
</html>
