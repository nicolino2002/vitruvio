<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infowaste Ver. 1.0.0</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" language="javascript" src="./js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="./js/login.js"></script>
    <script type="text/javascript" language="javascript" src="./js/scripts.js"></script>

    <!-- Custom styles for this template -->
    <link href="./css/index.css" rel="stylesheet">


  </head>

  <body>



  <?php include('./php/header.php'); ?>






    <!--<a href="new_user.html" class="link-primary">Nuovo Utente</a>-->
	<!--<a class="mt-5 mb-3 text-muted" href="mailto:nbellomo506@gmail.com">nbellomo506@gmail.com</a>-->

<div class="container pt-5">
 <form id="login" action="./php/login.php" method = "post" onsubmit="return accedi()">

    <div class="row">
     <div class="col-xl-4 offset-xl-4">
       <h1 class="text-color-1 text-center">Testo 1</h1>
       <h2 class="text-color-1 text-center">Accedi</h2>
     </div>
    </div>
    <div class="row">
      <div class="col-xl-4 offset-xl-4">
        <label class="form-label text-secondary">Email</label>
         <input type="email" class="form-control" id="inputEmail" name="username" >
        <div id="email_message"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-4 offset-xl-4">
        <label class="form-label text-secondary">Password</label>
         <input type="password" class="form-control" id="inputPassword" name="password">
        <div id="pwd_message"></div>
      </div>
    </div>


    <div class="row">
      <div class="col-xl-4 offset-xl-4 text-center pt-4 p-2">
          <button type="submit" id="Accedi"  class="btn btn-lg y bg-color-1 text-white w-75" >
            Accedi
          </button>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-4 offset-xl-4 text-center p-2">
        <button onclick="pwd_mail()" class="btn btn-lg bg-color-1 text-white w-75">
          Password Dimenticata
        </button>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-4 offset-xl-4 text-center p-2">
          <button onclick="window.location.href='new_user.html'" class="btn btn-lg bg-color-1 text-white w-75">
            Registrati
          </button>
      </div>
    </div>
  </form>
</div>

<div class="container">
  <div class="row">
    <div class="col-xl-4 offset-xl-4 text-center p-2">

      <hr>
      <p class="mt-5 mb-3 text-muted" style="text-align:center">
        ©Copyright, all rights reserved<br>
          - <b>MAGESTI srl unipersonale </b> -<br>
          Via C. Poerio, 40 - 70033 Corato (BA)<br>
          P.IVA / C.F. 08522010720<br>
          Capitale Sociale: 5.000,00 € i.v.<br>
          Tel +39 0808807359<br><br>
          Credits: Nicolas Bellomo
         </p>

    </div>
  </div>
</div>









  </body>
</html>
