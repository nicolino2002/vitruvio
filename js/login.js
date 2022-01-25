$(document).ready(function(){




red="#ff0000";
redborder="1px solid red";

/*  $("#Accedi").click(function(){
    alert("ciao");
    accedi();

  });
*/

});

  function accedi()
  {
    pass=0;
    email=0;
    check1();
    check2();

    if (pass==0 || email==0)

          return false;

        else
          return true;

  }

  function check1()
  {
    if($("#inputEmail").val()=="" || $("#inputEmail").val()=="undefined" || $("#inputEmail").val()==0 || $("#inputEmail").val()==null)
    {

      $("#inputEmail").css("border", redborder);
      $("#email_message").css("color",red);
      $("#email_message").html("Inserisci un indirizzo email");
      email=0;
    }else {
      email=1;
      $("#email_message").html("");
    }

  }

  function check2()
  {
    if($("#inputPassword").val()=="" || $("#inputPassword").val()=="undefined" || $("#inputPassword").val()==0 || $("#inputPassword").val()==null)
    {
      $("#inputPassword").css("border", redborder);
      $("#pwd_message").css("color",red);
      $("#pwd_message").html("Inserisci una password");
      pass=0;
  }
  else {
    pass=1;
    $("#pwd_message").html("");


  }

  }
