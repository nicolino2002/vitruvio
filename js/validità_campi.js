$(document).ready(function(){

$("#privacy").attr("disabled", true);
$("#service").attr("disabled", true);
privacy=0;
service=0;
  espressione=/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
  green="#119111"; //corretto  #28c949
  red="#ff0000"; //sbagliato   #e60000
  redborder="2px solid #ff0000";
  greenborder="2px solid #119111";


  reg=0;
  prov=0;
  town=0;
  name=0;
  surname=0;
  title=0;
  tel=0;
  email=0;
  email2=0;
  pass_field=0;//controllo per verifica password



$("#reg").change(function(){
    checkreg();
   });

   $("#prov").change(function(){
          checkprov();
      });

      $("#town").change(function(){
            checktown();
         });

         $("#title").change(function(){
                checktitle();
            });

                $("#password").keyup(function(){
                  checkpassword();

                    });


                    $("#confpassword").keyup(function(){

                      confpassword();


                        });



                        $("#service").click(function(){
                              if($(this).prop("checked") == true){

                                service=1;

                               }
                              else if($(this).prop("checked") == false){
                                service=0;
                              }
                          });

                          $("#privacy").click(function(){

                                if($(this).prop("checked") == true){
                                    privacy=1;

                                }
                                else if($(this).prop("checked") == false){
                                  privacy=0;
                                }
                            });

                            $("#p_check").click(function(){

                                  $("#privacy").attr("disabled", false);

                                });

                                $("#s_check").click(function(){

                                  $("#service").attr("disabled", false);

                                    });


                        $("#inviorichiesta").click(function(){

                                checkreg();
                                checkprov();
                                checktown();
                               vername();
                               versurname();
                               checktitle();
                               checkemail();
                               checkemail2();
                               checkpassword();
                               confpassword();
                               checktel();



                               if(pass_field==0)
                               {
                                 $("#password").css("border", redborder);
                                 $("#password_error_message").css("color",red);
                                 $("#password_error_message").html(" ✘ Errore nella password");

                                 $("#password").html("&nbsp;");
                                 $("#conf_password").html("&nbsp;");

                               }

                               if(title==1)
                               {
                                  $("#title_error_message").html("&nbsp;");

                               }
                               else {

                                 $("#title_password_error_message").css("color",red);
                                 $("#title_password_error_message").html(" ✘ Titolo non selezionato");
                               }

                               if (service==0) {

                                 $("#service_error").css("color",red);
                                 $("#service_error").html(" ✘	Deve leggere e accettare le condizioni di servizio per potersi registrare ");

                               }
                               else if(service==1){
                                 $("#service_error").html("&nbsp;");
                               }


                               if (privacy==0) {

                                 $("#privacy_error").css("color",red);
                                 $("#privacy_error").html(" ✘	Deve leggere e accettare l'informativa sulla privacy per potersi registrare");

                               }else if(privacy==1) {
                                 $("#privacy_error").html("&nbsp;");
                               }
                           });




                      });



                      function extra_totale() {
                        alert("CIAO");
                      }
          //verifico l'uguaglianza delle due password
            function confronto(){
              pass_field=0;

              if ($("#confpassword").val()!=0 && $("#confpassword").val()!="undefined" && $("#confpassword").val()!="" && $("#confpassword").val()!=null) {


                      if (valida==1) {


                  if($("#password").val()==$("#confpassword").val())
                  {
                      $("#conf_password_error_message").css("color",green);
                      $("#conf_password_error_message").html(" ✓ Le password coincidono");
                      $("#password").css("border",greenborder);
                      $("#confpassword").css("border",greenborder);

                      pass_field=1;
                  }
                  else  {
                            $("#conf_password_error_message").css("color",red);
                            $("#conf_password_error_message").html(" ✘ Le password non coincidono");
                            $("#confpassword").css("border",redborder);
                            pass_field=0;


                        }
                  }


                  else
                    $("#conf_password_error_message").html("&nbsp;");


                }
              }

                //funzione per il controllo dell'email
              function validateEmail(email) {
                var emailReg =espressione;

                       return emailReg.test( email );

                      }


                    //funzione verifica nome
                  function vername(){
                      if ($("#name").val()=="" || $("#name").val()=="undefined" || $("#name").val()==0 || $("#name").val()==null)

                      {
                            $("#name_error_message").css("color",red);
                            $("#name_error_message").html(" ✘	Campo obbligatorio");
                            $("#name").css("border", redborder);
                            name=0;

                      }

                                else {

                                        $("#name_error_message").css("color",green);
                                        $("#name_error_message").html(" ✓ Campo corretto");
                                        $("#name").css("border",greenborder);
                                        name=1;
                                      }
                              }


                              //funzione verifica cognome
                              function versurname(){
                              if ($("#surname").val()=="" || $("#surname").val()=="undefined" || $("#surname").val()==0 || $("#surname").val()==null)

                              {
                                    $("#surname_error_message").css("color",red);
                                    $("#surname_error_message").html(" ✘	Campo obbligatorio");
                                    $("#surname").css("border", redborder);
                                    surname=0;
                              }

                                    else {
                                              $("#surname_error_message").css("color",green);
                                              $("#surname_error_message").html(" ✓ Campo corretto");
                                              $("#surname").css("border",greenborder);
                                              surname=1;
                                    }
                                  }

                                    //controllo titolo
                                  function checktitle()
                                  {
                                    title=0;
                                    var selectedtitle = $("#title").children("option:selected").val();
                                                  if(selectedtitle==null || selectedtitle==""  || selectedtitle==undefined || selectedtitle==0)
                                                  {
                                                    $("#title").css("border", redborder);
                                                    $("#title_error_message").css("color",red);
                                                    $("#title_error_message").html(" ✘	Titolo obbligatorio");
                                                    title=0;

                                                  }else {
                                                    $("#title_error_message").html("&nbsp;");
                                                    $("#title").css("border", greenborder);
                                                    title=1;
                                                    }
                                                }
                                                        function checkreg()
                                                        {

                                                          reg=0;
                                                               var selectedreg = $("#reg").children("option:selected").val();
                                                               if(selectedreg==null || selectedreg=="" || selectedreg==undefined || selectedreg==0)
                                                               {

                                                                 $("#reg_error_message").css("color",red);
                                                                 $("#reg_error_message").html(" ✘	Regione obbligatoria");
                                                                 $("#reg").css("border",redborder);

                                                                 reg=0;

                                                               }else {

                                                                 $("#reg_error_message").html("&nbsp;");
                                                                 $("#reg").css("border", greenborder);


                                                                 reg=1;

                                                               }
                                                        }

                                                        function checkprov()
                                                        {
                                                          prov=0;
                                                               var selectedprov = $("#prov").children("option:selected").val();
                                                               if(selectedprov==null || selectedprov=="" || selectedprov==undefined || selectedprov==0)
                                                               {

                                                                 $("#prov_error_message").css("color",red);
                                                                 $("#prov_error_message").html(" ✘	Provincia obbligatoria");
                                                                 $("#prov").css("border",redborder);


                                                                 prov=0;

                                                               }else {

                                                                 $("#prov_error_message").html("&nbsp;");
                                                                 $("#prov").css("border",greenborder);

                                                                 prov=1;

                                                               }
                                                        }

                                                        function checktown()
                                                        {
                                                          town=0;
                                                               var selectedtown = $("#town").children("option:selected").val();
                                                               if(selectedtown==null || selectedtown=="" || selectedtown==undefined || selectedtown==0)
                                                               {

                                                                 $("#town_error_message").css("color",red);
                                                                 $("#town_error_message").html(" ✘	Comune obbligatorio");
                                                                 $("#town").css("border",redborder);

                                                                 town=0;

                                                               }else {

                                                                 $("#town_error_message").html("&nbsp;");
                                                                 $("#town").css("border",greenborder);

                                                                 town=1;

                                                               }
                                                        }

                                                function checkemail()
                                                {

                                                    indirizzo=$("#email").val()

                                                  email=0;
                                                  if($("#email").val()!="" && $("#email").val()!="undefined" && $("#email").val()!=0 && $("#email").val()!=null)
                                                  {
                                                    var emailReg =espressione;

                                                    var check6= emailReg.test( indirizzo );

                                                  if (check6) {


                                                    if($("#email2").val()==$("#email").val())
                                                    {
                                                      $("#email_error_message").css("color",red);
                                                      $("#email_error_message").html(" ✘	Inserire due Email diverse");
                                                      $("#email2_error_message").html("&nbsp;");
                                                      $("#email2").css("border",redborder);

                                                      email=0;
                                                    }else {
                                                      $("#email_error_message").css("color",green);
                                                      $("#email_error_message").html(" ✓	Email valida");
                                                      $("#email").css("border",greenborder);
                                                      email=1;
                                                    }

                                                  }else {
                                                    $("#email_error_message").css("color",red);
                                                    $("#email_error_message").html(" ✘	Email non valida");
                                                    $("#email").css("border",redborder);
                                                    email=0;



                                                  }
                                                }
                                                else {
                                                        $("#email_error_message").css("color",red);
                                                        $("#email_error_message").html(" ✘	Campo obbligatorio");
                                                        $("#email").css("border",redborder);

                                                      }
                                              }

                                              function send(){


                                              if(reg==1 && prov==1 && town==1 &&
                                                 name==1 && surname==1 && title==1 && email==1 &&
                                                  email2==1 && pass_field==1 && service==1 && tel==1 && privacy==1)

                                                  return true;

                                              else
                                           return false;


                                            }

                                            function checkemail2() {
                                              checkemail();

                                            if($("#email2").val()!="" && $("#email2").val()!="undefined" && $("#email2").val()!=0 && $("#email2").val()!=null)
                                            {
                                              indirizzo2=$("#email2").val();
                                              var emailReg2 =espressione;

                                              var check7= emailReg2.test( indirizzo2 );

                                              if (check7) {

                                                if($("#email2").val()==$("#email").val())
                                                {
                                                  $("#email_error_message").css("color",red);
                                                  $("#email_error_message").html(" ✘	Inserire due Email diverse");
                                                  $("#email2_error_message").html("&nbsp;");
                                                  $("#email2").css("border",redborder);

                                                  email=0;
                                                }else {
                                                  $("#email2_error_message").css("color",green);
                                                  $("#email2_error_message").html(" ✓	Email valida");
                                                  $("#email2").css("border",greenborder);

                                                  email2=1;
                                                }

                                              }else {
                                                $("#email2_error_message").css("color",red);
                                                $("#email2_error_message").html(" ✘	Email non valida");
                                                $("#email2").css("border",redborder);

                                                email2=0;
                                              }


                                          }else {
                                                  $("#email2_error_message").html("&nbsp;");
                                                  email2=1;
                                          }

                                        }

                                        function checkpassword()
                                        {
                                          $("#password").css("border", redborder);
                                          valida=0;
                                          poiRx=/[.:;,!\"£$%\&\/\(\)\=\?\^\'\ì\[\]@#]/; // espressione regolare per i simboli
                                          var check=/\s\S/;
                                          var pass=$("#password").val();

                                          if ($("#password").val()=="" || $("#password").val()=="undefined" || $("#password").val()==0 || $("#password").val()==null)

                                          {
                                                $("#confpassword").css("border",redborder);
                                                $("#password").css("border",redborder);
                                                $("#password_error_message").css("color",red);
                                                $("#password_error_message").html(" ✘	Password obbligatoria");
                                          }

                                                else {

                                                                    /*length 8 characters or more*/
                                                                    if(pass.length < 8) {
                                                                      $("#password").css("border",redborder);
                                                                      $("#confpassword").css("border",redborder);
                                                                      $("#password_error_message").css("color",red);
                                                                      $("#password_error_message").html(" ✘	La password deve contenere minimo 8 caratteri");
                                                                      confronto();

                                                                    }else {

                                                                      if(!(pass.match(/[a-z]+/))) {
                                                                        $("#password").css("border",redborder);
                                                                        $("#confpassword").css("border",redborder);
                                                                        $("#password_error_message").css("color",red);
                                                                        $("#password_error_message").html(" ✘	La password deve contenere almeno una minuscola [a-z]");
                                                                        confronto();

                                                                      }else {

                                                                        if(!(pass.match(/[A-Z]+/))) {
                                                                          $("#password").css("border",redborder);
                                                                          $("#confpassword").css("border",redborder);
                                                                          $("#password_error_message").css("color",red);
                                                                          $("#password_error_message").html(" ✘	La password deve contenere almeno una maiuscola [A-Z]");
                                                                          confronto();


                                                                        }else {

                                                                              /*contains digits*/
                                                                              if(!(pass.match(/[0-9]+/))) {
                                                                                $("#password").css("border",redborder);
                                                                                $("#confpassword").css("border",redborder);
                                                                                $("#password_error_message").css("color",red);
                                                                                $("#password_error_message").html(" ✘	La password deve contenere almeno un numero [0-9]");
                                                                                confronto();

                                                                              }else {

                                                                                        if(!(poiRx.test($("#password").val()))){
                                                                                          $("#password").css("border",redborder);
                                                                                          $("#confpassword") .css("border",redborder);
                                                                                          $("#password_error_message").css("color",red);
                                                                                          $("#password_error_message").html(" ✘	La password deve contenere almeno un carattere speciale (?$%^...)");
                                                                                          confronto();

                                                                                        }else {

                                                                                               if((check.test( $ ( "#password").val()  ))){
                                                                                                 $("#password").css("border",redborder);
                                                                                                 $("#confpassword").css("border",redborder);
                                                                                                 $("#password_error_message").css("color",red);
                                                                                                 $("#password_error_message").html(" ✘	La password non ammette spazi");
                                                                                                 confronto();


                                                                                               }else{
                                                                          $("#password").css("border",greenborder);
                                                                          $("#password_error_message").css("color",green);
                                                                          $("#password_error_message").html("✓ Formato password corretto");
                                                                          valida=1;


                                                                          confronto();



                                                                    }
                                                                  }
                                                                }
                                                              }
                                                            }
                                                          }
                                                         }


                                        }

                                        function confpassword()
                                        {
                                          if ($("#confpassword").val()=="" || $("#confpassword").val()=="undefined" || $("#confpassword").val()==0 || $("#confpassword").val()==null)

                                          {
                                               $("#confpassword").css("border",redborder);
                                                $("#conf_password_error_message").css("color",red);
                                                $("#conf_password_error_message").html(" ✘	Campo obbligatorio");
                                                confronto();
                                          }

                                                else confronto();
                                        }


                                        function checktel()
                                        {
                                          tel=$("#tel").val();

                                          if (tel=="" || tel=="undefined" || tel==0 || tel==null)

                                          {
                                               $("#tel").css("border",redborder);
                                                $("#tel_error_message").css("color",red);
                                                $("#tel_error_message").html(" ✘	Campo obbligatorio");
                                                tel=0;
                                          }

                                          if (tel.length==10) {

                                            $("#tel").css("border",greenborder);
                                            $("#tel_error_message").css("color",green);
                                            $("#tel_error_message").html(" ✓	Numero valido");
                                            tel=1;


                                          }else {

                                             $("#tel").css("border",redborder);
                                             $("#tel_error_message").css("color",red);
                                             $("#tel_error_message").html(" ✘	Formato numero non valido");
                                             tel=0;

                                          }



                                        }




              //@Nicolas
