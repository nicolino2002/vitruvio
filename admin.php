<?php
   include('./php/config.php');
   session_start();
?>

<!doctype html>
<html lang='en'>
  <head>
    <!-- Required meta tags -->
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- Bootstrap CSS -->
    <link href='./css/bootstrap.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
    <link href='./css/colors.css' rel='stylesheet'>
    <link href='./js/bootstrap.bundle.min.js'>
    <!--<link href='./css/signin.css' rel='stylesheet'>-->
    <title>InfoWaste Admin Page (ver. 1.0)</title>


    <style media='screen'>
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
      .mainform
          {
            width:90%;
            height:20%;
            margin-left:5%;
            border-color: #044A92;
          }
      .form1 {
              width:30%;
              height: 300px;
              padding:2px 5px;
              border: 3px solid #044A92;
              display: inline-block;
              float: left
              text-align:center;
              margin:8px;
              margin-right:30px;
          }
      .form2 {
              width:30%;
              height: 320px;
              padding:2px 5px;
              border: 3px solid #044A92;
              display: inline-block;
              float: left
              text-align:center;
              margin:8px;
              margin-right:30px;
            }
    </style>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>

  </head>
  <body>



    <div class='modal fade' id='exampleModalCenter' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
      <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h5 class='modal-title' id='exampleModalLongTitle'>Conferma</h5>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
          <div class='modal-body'>
            Sei sicuro di voler uscire?
          </div>
          <div class='modal-footer'>
            <button style='width:100px' type='button' id='back' class='btn' data-dismiss='modal'>Annulla</button>
            <form  action='./php/logout.php' method='post'>
              <button style='width:70px' type='submit' id='back' class='btn'>Si</button>
            </form>
          </div>
        </div>
      </div>
    </div>


    <!--<p style='font-size: x-large; color: #044A92'>
     <img src='./img/iw.jpg' width='50' height='50' style='margin-left: 5%'> InfoWaste
   </p>-->

   <?php
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin')
    {
    echo "
    <div class='container mt-5'>
      <div class='row mb-5'>
        <div class='col-xl-7 col-sm-6'>
          <h1 class='text-theme'>ADMIN</h1>
        </div>
        <div class='col-xl-4 offset-xl-1 col-sm-6 text-right'>
          <button type='button' class='btn btn-primary mr-2' id='logout' data-toggle='modal' data-target='#exampleModalCenter'>
            Esci
          </button>
          <a href='./php/welcome.php'><button class='btn btn-primary mr-2' id='back'  type='submit'>Indietro</button></a>
        </div>
      </div>

      <div class='form-group row p-2'>
        <div class='col-xl-3 offset-xl-4 offset-sm-1 col-sm-10 text-center p-0'>
          <h5 class='b-0 p-0 m-0 text-theme'>Seleziona Comune:</h5>
        </div>
      </div>

        <div class='form-group row p-2'>
          <div class='col-xl-3 offset-xl-4 offset-sm-1 col-sm-10'>
            <label class='col-form-label b-0 p-0 m-0'>Regione:</label>
            <select id='reg' class='form-control' name='reg' onchange='get_prov(this); ' required autofocus>
              <option value=''>Please Select</option>
            </select>
          </div>
        </div>

      <div class='form-group row p-2'>
        <div class='col-xl-3 offset-xl-4 offset-sm-1 col-sm-10'>
          <label class='col-form-label b-0 p-0 m-0'>Provincia:</label>
          <select id='prov' class='form-control w-100' name='prov' onchange='get_town(this); ' required autofocus>
            <option value=''>Please Select</option>
          </select>
        </div>
      </div>

      <div class='form-group row p-2'>
        <div class='col-xl-3 offset-xl-4 offset-sm-1 col-sm-10'>
          <label class='col-form-label b-0 p-0 m-0'>Comune:</label>
          <select id='town' class='form-control' name='town' onchange='get_users(this);get_aut_users(this);get_del_users(this);new_user();' required autofocus>
            <option value=''>Please Select</option>
          </select>
        </div>
      </div>

      <div class='container mt-5'>
        <div class='row'>
          <div class='col-xl-5 col-sm-12'>
            <form  action='./php/upd_aut_user.php' method = 'post'>
            <h5 class='b-0 p-0 m-0 text-left'>Autorizza Utente</h5>
              <div class='row'>
                <div class='col-6'>
                  <p class='font-weight-normal'>Account</p>
                </div>
                <div class='col-4'>
                  <select id='aut_users' class='form-select' name='aut_users' onchange='get_aut_user(this)' required autofocus>
                    <option value=''>Please Select</option>
                  </select>
                </div>
              </div>

                  <div class='row'>
                    <div class='col-6'>
                      <p class='font-weight-normal'>Nome</p>
                    </div>
                    <div class='col-6'>
                      <label class='text-capitalize' id='aut_name' name = 'aut_name'>NULL</label>
                    </div>
                  </div>

                  <div class='row'>
                    <div class='col-6'>
                      <p class='font-weight-normal'>Cognome</p>
                    </div>
                    <div class='col-6'>
                      <label class='text-capitalize' id='aut_surname' name = 'aut_surname'>NULL</label>
                    </div>
                  </div>

                  <div class='row'>
                    <div class='col-6'>
                      <p class='font-weight-normal'>Data Richiesta</p>
                    </div>
                    <div class='col-6'>
                      <label id='aut_req_date' name = 'aut_req_date'>NULL</label>
                    </div>
                  </div>

                  <div class='row'>
                    <div class='col-6'>
                      <p class='font-weight-normal'>Tipo di Account</p>
                    </div>
                    <div class='col-4'>
                      <select class='form-select' id='aut_role' name='aut_role' required autofocus>
                        <option value=''>Please Select</option>
                      </select>
                    </div>
                  </div>

                  <div class='row'>
                    <div class='col-6'>
                      <p class='font-weight-normal'>Ruolo</p>
                    </div>
                    <div class='col-6'>
                      <label id='aut_title' name='aut_title'>NULL</label>
                    </div>
                  </div>

                  <div class='row'>
                    <div class='col-6'>
                      <p class='font-weight-normal'>Seconda eMail (opzionale)</p>
                    </div>
                    <div class='col-6'>
                      <label class='text-capitalize' id='aut_mail2' name='aut_mail2'>NULL</label>
                    </div>
                  </div>

                  <div class='row'>
                    <div class='col-6'>
                      <p class='font-weight-normal'>Invio eMail Attivazione</p>
                    </div>
                    <div class='col-6'>
                      <input class='form-check-input' type='checkbox' value='1' name = 'aut_receipt' id='aut_receipt' checked='true'>
                    </div>
                  </div>

                  <div class='row'>
                    <div class='col-12'>
                      <input class='btn btn-primary bg-theme w-100' id='aut_btn' name='aut_btn' style='background-color: #044A92' type='submit' value='Autorizza Utente' disabled>
                    </div>
                  </div>

                </form>
              </div>


          <div class='col-xl-5 offset-xl-1 col-sm-12'>
          <form  action='./php/upd_del_user.php' method='post'>
            <h5 class='b-0 p-0 m-0 text-left'>Cancella Utente</h5>
            <div class='row'>
              <div class='col-6'>
                <p class='font-weight-normal'>Account</p>
              </div>
              <div class='col-6'>
                <select id='del_users' class='select' name='del_users' onchange='get_del_user(this)' required autofocus>
                  <option value=''>Please Select</option>
                </select>
              </div>
            </div>

            <div class='row'>
              <div class='col-6'>
                <p class='font-weight-normal'>Nome</p>
              </div>

              <div class='col-6'>
                <label class='text-capitalize' id='del_name' name = 'del_name'>NULL</label>
              </div>
            </div>

            <div class='row'>
              <div class='col-6'>
                <p class='font-weight-normal'>Cognome</p>
              </div>

              <div class='col-6'>
                <label class='text-capitalize' id='del_surname' name = 'del_surname'>NULL</label>

              </div>
            </div>

            <div class='row'>
              <div class='col-6'>
                <p class='font-weight-normal'>Data Richiesta</p>
              </div>
              <div class='col-6'>
                <label id='del_req_date' name = 'del_req_date'>NULL</label>

              </div>
            </div>

            <div class='row'>
              <div class='col-6'>
                <p class='font-weight-normal'>Data Attivazione</p>
              </div>
              <div class='col-6'>
                <label id='del_act_date' name = 'del_act_date'>NULL</label>
              </div>
            </div>

            <div class='row'>
              <div class='col-6'>
                <p class='font-weight-normal'>Tipo di Account</p>
              </div>
              <div class='col-6'>
                <label id='del_role' name = 'del_role'>NULL</label>
              </div>
            </div>

            <div class='row'>
              <div class='col-6'>
                <p class='font-weight-normal'>Ruolo</p>
              </div>
              <div class='col-6'>
                <label id='del_title' name='del_title'>NULL</label>
              </div>
            </div>

            <div class='row'>
              <div class='col-6'>
                <p class='font-weight-normal'>Seconda eMail (opzionale)</p>
              </div>
              <div class='col-6'>
                <label class='text-capitalize' id='del_mail2' name='del_mail2'>NULL</label>

              </div>
            </div>

            <div class='row'>
              <div class='col-6'>
                <p class='font-weight-normal'>Invia eMail Attivazione</p>
              </div>
              <div class='col-6'>
                <input class='form-check-input' type='checkbox' value='1' name = 'del_receipt' id='del_receipt' checked='true'>
              </div>
            </div>

            <div class='row'>
              <div class='col-12'>
                <input class='btn btn-primary bg-theme w-100' id='del_btn' name='del_btn' style='background-color: #044A92' type='submit' value='Cancella Utente' disabled>
              </div>
            </div>
          </div>
          </form>

          <div class='col-4'>
            <h5 class='b-0 p-0 m-0 text-left'>Aggiungi Utente</h5>
              <div class='row'>
                <div class='col-6'>
                  Building
                </div>
                <div class='col-6'>
                  Building
                </div>
              </div>
            </div>
          </div>
        </div>
      <br>
    </div>";
    } else {
          echo '<div class=container><div class=row><div class=offset-4 col-8><h2>Non hai accesso a questa pagina</h2></div></div></div>';

        }?>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js' integrity='sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl' crossorigin='anonymous'></script>
        <script src='./js/bootstrap.bundle.min.js'></script>
        <script type='text/javascript' src='./js/jquery-3.5.1.min.js'></script>
        <script src='./js/scripts.js'></script>
        <script type='text/javascript'>window.onload = get_reg();get_title();get_role();admin_form_reset();</script>
      </body>
    </html>
