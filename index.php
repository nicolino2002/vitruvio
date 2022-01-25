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



<div class="form-signin"  style=" margin-top: 150px;max-width:400px">

  <form id="login" action="./php/login.php" method = "post" onsubmit="return accedi()">
    <table style="width: 100%">

    <h1 class="h1" style="text-align:center;color:#004993;font-weight: bold;">SUPPORTO PEF 2022-2025</h1><br>
    <h1 class="h3" style="text-align:center;color:#004993;font-weight: bold;">Accedi</h1><br>
    <tr>
      <td>
      <label for="inputEmail" class="visually" style="color:grey">Email</label>
      <input form="login" type="text" id="inputEmail" name = "username" class="form-control" >
      <small id="email_message"></small>
      </td>
    </tr>

  <tr>
    <td>
      <label for="inputPassword" class="visually" style="color:grey">Password</label>
      <input  form="login" type="password" id="inputPassword" name = "password" class="form-control" style="margin-bottom:0%;" >
      <small id="pwd_message"></small>
    </td>
    </tr>


    <tr>
      <td>
        <button type="submit" id="Accedi"  class="w-100 btn btn-lg btn-primary" style="background-color: #004993;margin-top:30px;border-radius: 15px;" >Accedi</button>
      </td>
    </tr>
    <tr>
      <td>
        <button onclick="pwd_mail()" class="w-100 btn btn-lg btn-primary" style="border-radius: 15px;background-color: #004993;margin-top:5px;" type="button">Password Dimenticata</button>
      </td>
    </tr>
    <tr>
      <td>
        <button onclick="window.location.href='new_user.html'" class="w-100 btn btn-lg btn-primary" style="border-radius: 15px;background-color: #004993;margin-top:5px;" type="button">Registrati</button>
      </td>
    </tr>


    <tr>
      <td>
      </td>
    </tr>

    <tr>
          <td>
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
             </td>
         </tr>

  </table>
  </form>



    <!--<a href="new_user.html" class="link-primary">Nuovo Utente</a>-->
	<!--<a class="mt-5 mb-3 text-muted" href="mailto:nbellomo506@gmail.com">nbellomo506@gmail.com</a>-->
</div>

<div class="container">
  <div class="row">
   <div class="col-xl-4 offset-xl-4">
     <h1 class="text-color-1 text-center">Testo 1</h1>
     <h2 class="text-color-1 text-center">Accedi</h2>
   </div>
  </div>
  <div class="row">
    <div class="col-xl-4 offset-xl-4">
      <label for="exampleInputEmail1" class="form-label text-secondary">Email</label>
       <input type="email" class="form-control" id="username" aria-describedby="emailHelp">
      <div id="email_message"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-4 offset-xl-4">
      <label for="exampleInputEmail1" class="form-label text-secondary">Password</label>
       <input type="email" class="form-control" id="password" aria-describedby="emailHelp">
      <div id="pwd_message"></div>
    </div>
  </div>

  <div class="row">
    <div class="col-xl-4 offest-xl-4">
        <button type="submit" id="Accedi"  class="w-100 btn btn-lg btn-primary" >
          Accedi
        </button>
    </div>
  </div>

  <div class="row">
    <div class="col-xl-4 offest-xl-4">
        <button onclick="pwd_mail()" class="w-100 btn btn-lg btn-primary">
          Password Dimenticata
        </button>
    </div>
  </div>

  <div class="row">
    <div class="col-xl-4 offest-xl-4">
        <button onclick="window.location.href='new_user.html'" class="w-100 btn btn-lg btn-primary">
          Registrati
        </button>
    </div>
  </div>
</div>



        <button type="submit" id="Accedi"  class="w-100 btn btn-lg btn-primary" style="background-color: #004993;margin-top:30px;border-radius: 15px;" >Accedi</button>
        <button onclick="pwd_mail()" class="w-100 btn btn-lg btn-primary" style="border-radius: 15px;background-color: #004993;margin-top:5px;" type="button">Password Dimenticata</button>
        <button onclick="window.location.href='new_user.html'" class="w-100 btn btn-lg btn-primary" style="border-radius: 15px;background-color: #004993;margin-top:5px;" type="button">Registrati</button>










  </body>
</html>
