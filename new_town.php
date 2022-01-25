<html>

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attivazione Comune</title>

    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/colors.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <style>
      table
      {
        width: 100%;
        margin: 0%;
      }


      td
      {
        vertical-align: middle;
        padding: 10px 15px ;
        height: 5%


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


      .cont-page
      {
        margin-left: 10%;
        margin-right: 10%;
        margin-top: 5%;
        margin: 5% auto;
        width: 1600px;
        background-color: white;

      }

      .campo
      {
        height: 100%;
      }



    </style>

  </head>
<!--https://getbootstrap.com/docs/5.0/getting-started/introduction/#starter-template-->
<!--https://getbootstrap.com/docs/5.0/forms/overview/-->
<!--https://getbootstrap.com/docs/5.0/forms/validation/#server-side-->

  <body>

    <div class="container mt-5">
      <div class='row mb-5'>
      <div class='col-xl-7 col-sm-6'>
        <h1 class='text-theme'>Attivazione Comune</h1>
      </div>
      <div class='col-xl-4 offset-xl-1 col-sm-6 text-right'>
        <button type='button' class='btn btn-primary mr-2' id='logout' data-toggle='modal' data-target='#exampleModalCenter'>
          Esci
        </button>
        <a href='./php/welcome.php'><button class='btn btn-primary mr-2' id='back' >Indietro</button></a>
      </div>
    </div>
  </div>




    <!--<table class="table" width="100%">-->
    <?php
    session_start();
      if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {


    echo "                  <hr class='mt-5'>
    <form action='./php/add_town.php'  method = 'post'>
      <div class='container'>

      </div>
        <div class='row'>
          <div class='col-xl-4 offset-xl-4 col-sm-12'>
            <div class='row'>
              <div class='col-12'>
              Regione:
                <select id='reg' class='form-select' name='reg' onchange='get_prov_add(this);' autofocus>
                  <option value=''>Please Select</option>
                </select>
              </div>
            </div>

            <div class='row'>
              <div class='col-12'>
              Provincia:
              <select id='prov' class='form-select' name='prov' onchange='get_town_add(this);' autofocus>
                <option value=''>Please Select</option>
              </select>
              </div>
            </div>

            <div class='row'>
              <div class='col-12'>
              Town:
              <select id='town' class='form-select' name='town'  autofocus>
                <option value=''>Please Select</option>
              </select>
              </div>
              <div class='col-12'>

              <button type='submit' class='btn w-100 rounded font-weight-bold bg-theme text-light mt-4' name='button'>Aggiungi</button>

              </div>
            </div>
          </div>
        </div>
      </div>
      </form>
       ";

     }else {
       echo "<div class=container><div class=row><div class=offset-4 col-8><h2>Non hai accesso a questa pagina</h2></div></div></div>";
     }
     ?>
      <hr>

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
              <form  action="./php/logout.php" method="post">
                <button style="width:70px" type="submit" id="back" class="btn">Si</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <script type="text/javascript" language="javascript" src="./js/jquery.js"></script>
      <script type="text/javascript" language="javascript" src="./js/validità_campi.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <script type="text/javascript" src="./js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="./js/scripts.js"></script>

      <script type="text/javascript">window.onload = get_reg_add();</script>
   </body>

   </main>

</html>
