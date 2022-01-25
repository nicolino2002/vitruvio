$(document).ready(function() {





  $("#soggetto").change(function() {

      checkfields();

  });

  $("#tipologia").change(function() {

      checkfields();

  });

  $("#componente").change(function() {

      checkfields();

  });

  $("#quant").change(function() {

      checkfields();

  });


})

  function checkfields(){

    if($("#soggetto").val()==0 || $("#tipologia").val()==0 || $("#componente").val()==0 || $("#quant").val()==0)
    {
      $("#save_extra").prop('disabled', true);
    }else {
      $("#save_extra").prop('disabled', false);

    }

  }


      //   tipologia componente anno quant prezzo
