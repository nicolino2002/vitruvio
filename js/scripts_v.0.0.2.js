// Select Initial Region
function get_reg(){
  var ajaxRequest;  // The variable that makes Ajax possible!
  try {
    // Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
    } catch (e) {
      // Internet Explorer Browsers
      try {
        ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
          try {
          ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
          } catch (e){
        // Something went wrong
        alert("Your browser broke!");
        return false;
        }
      }
    }
    // Create a function that will receive data sent from the server and will update div section in the same page.
    ajaxRequest.onreadystatechange = function(){
    if(ajaxRequest.readyState == 4){
      var ajaxDisplay = document.getElementById('reg');
      ajaxDisplay.innerHTML = ajaxRequest.responseText;
      }
    }
  // Now get the value from user and pass it to server script.
  ajaxRequest.open("GET", "./php/get_reg.php", true);
  ajaxRequest.send(null); 
  // Disable prov & town
  document.getElementById('prov').options.item(0).select;
  document.getElementById('town').options.item(0).select;
  document.getElementById('prov').disabled = true;
  document.getElementById('town').disabled = true;
}

// Select Initial Region
function get_reg_new(){
  var ajaxRequest;  // The variable that makes Ajax possible!
  try {
    // Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
    } catch (e) {
      // Internet Explorer Browsers
      try {
        ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
          try {
          ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
          } catch (e){
        // Something went wrong
        alert("Your browser broke!");
        return false;
        }
      }
    }
    // Create a function that will receive data sent from the server and will update div section in the same page.
    ajaxRequest.onreadystatechange = function(){
    if(ajaxRequest.readyState == 4){
      var ajaxDisplay = document.getElementById('reg');
      ajaxDisplay.innerHTML = ajaxRequest.responseText;
      }
    }
  // Now get the value from user and pass it to server script.
  ajaxRequest.open("GET", "./php/get_reg_new.php", true);
  ajaxRequest.send(null); 
  // Disable prov & town
  document.getElementById('prov').options.item(0).select;
  document.getElementById('town').options.item(0).select;
  document.getElementById('prov').disabled = true;
  document.getElementById('town').disabled = true;
}

// Select Initial Titles
function get_title(){
  var ajaxRequest;  // The variable that makes Ajax possible!
  try {
    // Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
    } catch (e) {
      // Internet Explorer Browsers
      try {
        ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
          try {
          ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
          } catch (e){
        // Something went wrong
        alert("Your browser broke!");
        return false;
        }
      }
    }
    // Create a function that will receive data sent from the server and will update div section in the same page.
    ajaxRequest.onreadystatechange = function(){
    if(ajaxRequest.readyState == 4){
      var ajaxDisplay = document.getElementById('new_title');
      ajaxDisplay.innerHTML = ajaxRequest.responseText;
      }
    }
  // Now get the value from user and pass it to server script.
  ajaxRequest.open("GET", "./php/get_title.php", true);
  ajaxRequest.send(null); 
}

// Select Initial Titles
function get_role(){
  var ajaxRequest;  // The variable that makes Ajax possible!
  try {
    // Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
    } catch (e) {
      // Internet Explorer Browsers
      try {
        ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
          try {
          ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
          } catch (e){
        // Something went wrong
        alert("Your browser broke!");
        return false;
        }
      }
    }
    // Create a function that will receive data sent from the server and will update div section in the same page.
    ajaxRequest.onreadystatechange = function(){
    if(ajaxRequest.readyState == 4){
      var ajaxDisplay1 = document.getElementById('aut_role');
      var ajaxDisplay2 = document.getElementById('new_role');
      ajaxDisplay1.innerHTML = ajaxRequest.responseText;
      ajaxDisplay2.innerHTML = ajaxRequest.responseText;
      }
    }
  // Now get the value from user and pass it to server script.
  ajaxRequest.open("GET", "./php/get_role.php", true);
  ajaxRequest.send(null); 
}

// Region Selected => Get Prov
function get_prov(sel){
  var selidx = sel.options[sel.selectedIndex].index;
  var selval = sel.options[sel.selectedIndex].value;
  if (selidx > 0) {
    var ajaxRequest;  // The variable that makes Ajax possible!
    try {
      // Opera 8.0+, Firefox, Safari
        ajaxRequest = new XMLHttpRequest();
      } catch (e) {
        // Internet Explorer Browsers
        try {
          ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
          } catch (e) {
            try {
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e){
          // Something went wrong
          alert("Your browser broke!");
          return false;
          }
        }
      }
      // Create a function that will receive data sent from the server and will update div section in the same page.
      ajaxRequest.onreadystatechange = function(){
      if(ajaxRequest.readyState == 4){
        var ajaxDisplay = document.getElementById('prov');
        ajaxDisplay.innerHTML = ajaxRequest.responseText;
        }
      }
    // Now get the value from user and pass it to server script.
    var reg = document.getElementById('reg').value;
    var queryString = "?reg=" + reg ;
    ajaxRequest.open("GET", "./php/get_prov.php" + queryString, true);
    ajaxRequest.send(null); 
    document.getElementById('prov').disabled = false;
  } else {
    document.getElementById('prov').options.item(0).select;
    document.getElementById('town').options.item(0).select;
    document.getElementById('prov').disabled = true;
    document.getElementById('town').disabled = true;
  }
}


// Region Selected => Get Prov
function get_prov_new(sel){
  var selidx = sel.options[sel.selectedIndex].index;
  var selval = sel.options[sel.selectedIndex].value;
  if (selidx > 0) {
    var ajaxRequest;  // The variable that makes Ajax possible!
    try {
      // Opera 8.0+, Firefox, Safari
        ajaxRequest = new XMLHttpRequest();
      } catch (e) {
        // Internet Explorer Browsers
        try {
          ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
          } catch (e) {
            try {
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e){
          // Something went wrong
          alert("Your browser broke!");
          return false;
          }
        }
      }
      // Create a function that will receive data sent from the server and will update div section in the same page.
      ajaxRequest.onreadystatechange = function(){
      if(ajaxRequest.readyState == 4){
        var ajaxDisplay = document.getElementById('prov');
        ajaxDisplay.innerHTML = ajaxRequest.responseText;
        }
      }
    // Now get the value from user and pass it to server script.
    var reg = document.getElementById('reg').value;
    var queryString = "?reg=" + reg ;
    ajaxRequest.open("GET", "./php/get_prov_new.php" + queryString, true);
    ajaxRequest.send(null); 
    document.getElementById('prov').disabled = false;
  } else {
    document.getElementById('prov').options.item(0).select;
    document.getElementById('town').options.item(0).select;
    document.getElementById('prov').disabled = true;
    document.getElementById('town').disabled = true;
  }
}

// Prov Selected => Get Town
function get_town(sel){
  var selidx = sel.options[sel.selectedIndex].index;
  var selval = sel.options[sel.selectedIndex].value;
  if (selidx > 0) {
    var ajaxRequest;  // The variable that makes Ajax possible!
    try {
      // Opera 8.0+, Firefox, Safari
        ajaxRequest = new XMLHttpRequest();
      } catch (e) {
        // Internet Explorer Browsers
        try {
          ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
          } catch (e) {
            try {
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e){
          // Something went wrong
          alert("Your browser broke!");
          return false;
          }
        }
      }
      // Create a function that will receive data sent from the server and will update div section in the same page.
      ajaxRequest.onreadystatechange = function(){
      if(ajaxRequest.readyState == 4){
        var ajaxDisplay = document.getElementById('town');
        ajaxDisplay.innerHTML = ajaxRequest.responseText;
        }
      }
    // Now get the value from user and pass it to server script.
    var prov = document.getElementById('prov').value;
    var queryString = "?prov=" + prov ;
    ajaxRequest.open("GET", "./php/get_town.php" + queryString, true);
    ajaxRequest.send(null); 
    document.getElementById('town').disabled = false;
  } else {
    document.getElementById('town').options.item(0).select;
    document.getElementById('town').disabled = true;
  }
}
// Prov Selected => Get Town
function get_town_new(sel){
  var selidx = sel.options[sel.selectedIndex].index;
  var selval = sel.options[sel.selectedIndex].value;
  if (selidx > 0) {
    var ajaxRequest;  // The variable that makes Ajax possible!
    try {
      // Opera 8.0+, Firefox, Safari
        ajaxRequest = new XMLHttpRequest();
      } catch (e) {
        // Internet Explorer Browsers
        try {
          ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
          } catch (e) {
            try {
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e){
          // Something went wrong
          alert("Your browser broke!");
          return false;
          }
        }
      }
      // Create a function that will receive data sent from the server and will update div section in the same page.
      ajaxRequest.onreadystatechange = function(){
      if(ajaxRequest.readyState == 4){
        var ajaxDisplay = document.getElementById('town');
        ajaxDisplay.innerHTML = ajaxRequest.responseText;
        }
      }
    // Now get the value from user and pass it to server script.
    var prov = document.getElementById('prov').value;
    var queryString = "?prov=" + prov ;
    ajaxRequest.open("GET", "./php/get_town_new.php" + queryString, true);
    ajaxRequest.send(null); 
    document.getElementById('town').disabled = false;
  } else {
    document.getElementById('town').options.item(0).select;
    document.getElementById('town').disabled = true;
  }
}
// Admin Page: Town Selected => Get Users
function get_users(sel){
  var selidx = sel.options[sel.selectedIndex].index;
  var selval = sel.options[sel.selectedIndex].value;
    $.ajax({
        url: './php/get_users.php',
        type: 'POST',
        data: "town=" + selval,
        dataType: "html",
        success: function(response){
          $("#usersbytown").replaceWith(response);
        }
    });
}
// Admin Page: Town Selected => Get Autorizable Users
function get_aut_users(sel){
  var selidx = sel.options[sel.selectedIndex].index;
  var selval = sel.options[sel.selectedIndex].value;
  if (selidx > 0) {
    var ajaxRequest;  // The variable that makes Ajax possible!
    try {
      // Opera 8.0+, Firefox, Safari
        ajaxRequest = new XMLHttpRequest();
      } catch (e) {
        // Internet Explorer Browsers
        try {
          ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
          } catch (e) {
            try {
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e){
          // Something went wrong
          alert("Your browser broke!");
          return false;
          }
        }
      }
      // Create a function that will receive data sent from the server and will update div section in the same page.
      ajaxRequest.onreadystatechange = function(){
      if(ajaxRequest.readyState == 4){
        var ajaxDisplay = document.getElementById('aut_users');
        ajaxDisplay.innerHTML = ajaxRequest.responseText;
        }
      }
    // Now get the value from user and pass it to server script.
    var town = document.getElementById('town').value;
    var queryString = "?town=" + town ;
    ajaxRequest.open("GET", "./php/get_aut_users.php" + queryString, true);
    ajaxRequest.send(null); 
  }
}
// Admin Page: Town Selected => Get Deletable Users
function get_del_users(sel){
  var selidx = sel.options[sel.selectedIndex].index;
  var selval = sel.options[sel.selectedIndex].value;
  if (selidx > 0) {
    var ajaxRequest;  // The variable that makes Ajax possible!
    try {
      // Opera 8.0+, Firefox, Safari
        ajaxRequest = new XMLHttpRequest();
      } catch (e) {
        // Internet Explorer Browsers
        try {
          ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
          } catch (e) {
            try {
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e){
          // Something went wrong
          alert("Your browser broke!");
          return false;
          }
        }
      }
      // Create a function that will receive data sent from the server and will update div section in the same page.
      ajaxRequest.onreadystatechange = function(){
      if(ajaxRequest.readyState == 4){
        var ajaxDisplay = document.getElementById('del_users');
        ajaxDisplay.innerHTML = ajaxRequest.responseText;
        }
      }
    // Now get the value from user and pass it to server script.
    var town = document.getElementById('town').value;
    var queryString = "?town=" + town ;
    ajaxRequest.open("GET", "./php/get_del_users.php" + queryString, true);
    ajaxRequest.send(null); 
  }
}

// Admin Page: Aut User Selected => Get Aut User Parameter
function get_aut_user(sel){
  var selidx = sel.options[sel.selectedIndex].index;
  var selval = sel.options[sel.selectedIndex].value;
    $.ajax({
        url: './php/get_aut_user.php',
        type: 'POST',
        data: "user=" + selval,
        dataType: 'JSON',
        success: function(response){
            var len = response.length;
            if(len == 1){
                $("#aut_name").replaceWith("<label class=\"text-capitalize\" id=\"aut_name\" name = \"aut_name\">" + response[0].name + "</label>");
                $("#aut_surname").replaceWith("<label class=\"text-capitalize\" id=\"aut_surname\" name = \"aut_surname\">" + response[0].surname + "</label>");
                $("#aut_req_date").replaceWith("<label class=\"text-capitalize\" id=\"aut_req_date\" name = \"aut_req_date\">" + response[0].ins_date + "</label>");
                //$("#aut_act_date").replaceWith("<label class=\"text-capitalize\" id=\"aut_act_date\" name = \"aut_act_date\">" + response[0].surname + "</label>");
                //$("#aut_role").replaceWith("<label class=\"text-capitalize\" id=\"aut_role\" name = \"aut_role\">" + response[0].role + "</label>");
                $("#aut_title").replaceWith("<label class=\"text-capitalize\" id=\"aut_title\" name = \"aut_title\">" + response[0].title + "</label>");
                $("#aut_mail2").replaceWith("<label class=\"text-capitalize\" id=\"aut_mail2\" name = \"aut_mail2\">" + response[0].mail2 + "</label>");
            }
        }
    });
}
// Admin Page: Del User Selected => Get Del User Parameter
function get_del_user(sel){
  var selidx = sel.options[sel.selectedIndex].index;
  var selval = sel.options[sel.selectedIndex].value;
    $.ajax({
        url: './php/get_del_user.php',
        type: 'POST',
        data: "user=" + selval,
        dataType: 'JSON',
        success: function(response){
            var len = response.length;
            if(len == 1){
                $("#del_name").replaceWith("<label class=\"text-capitalize\" id=\"del_name\" name = \"del_name\">" + response[0].name + "</label>");
                $("#del_surname").replaceWith("<label class=\"text-capitalize\" id=\"del_surname\" name = \"del_surname\">" + response[0].surname + "</label>");
                $("#del_req_date").replaceWith("<label class=\"text-capitalize\" id=\"del_req_date\" name = \"del_req_date\">" + response[0].ins_date + "</label>");
                $("#del_act_date").replaceWith("<label class=\"text-capitalize\" id=\"del_act_date\" name = \"del_act_date\">" + response[0].surname + "</label>");
                $("#del_role").replaceWith("<label class=\"text-capitalize\" id=\"del_role\" name = \"del_role\">" + response[0].role + "</label>");
                $("#del_title").replaceWith("<label class=\"text-capitalize\" id=\"del_title\" name = \"del_title\">" + response[0].title + "</label>");
                $("#del_mail2").replaceWith("<label class=\"text-capitalize\" id=\"del_mail2\" name = \"del_mail2\">" + response[0].mail2 + "</label>");
            }
        }
    });
}
// Town Selected => Get Next
function get_next(sel){
  var selidx = sel.options[sel.selectedIndex].index;
  var selval = sel.options[sel.selectedIndex].value;
  if (selidx > 0) {
  } else {
    document.getElementById('prov').disabled = true;
    document.getElementById('town').disabled = true;
  }
}

// Support Mail
function php_mail(subject, cc) {
  var message = prompt("Inserire il testo della mail");
  $.ajax({
      url: 'mail.php',
      type: 'POST',
      data: "subject=" + subject + "&to=" + "alfonso.piccarreta@gmail.com" + "&cc=" + cc + "&message=" + message,
      dataType: 'JSON',
      success: function(response){
        if(response == '1'){
          alert("mail inviata correttamente");
        } else {
          alert("si e` verificato un errore durante l'invio della mail");
        }
      }
  });
}
/*
function get_curr_date(tag){
  var d = new Date();
  //d+'';                  // "Sun Dec 08 2013 18:55:38 GMT+0100"
  //d.toDateString();      // "Sun Dec 08 2013"
  //d.toISOString();       // "2013-12-08T17:55:38.130Z"
  //d.toLocaleDateString() // "8/12/2013" on my system
  tag.value = d.toLocaleString()     // "8/12/2013 18.55.38" on my system
  //d.toUTCString()        // "Sun, 08 Dec 2013 17:55:38 GMT"
}*/
function new_user(){
  var d = new Date();
  var n = d.toLocaleDateString();
  document.getElementById("aut_btn").disabled = false;
  document.getElementById("del_btn").disabled = false;
  document.getElementById("new_btn").disabled = false;
  document.getElementById("aut_req_date").innerHTML = n;
  document.getElementById("aut_act_date").innerHTML = n;
  document.getElementById("new_town").value = document.getElementById("town").value;
  document.getElementById("new_req_date").innerHTML = n;
  document.getElementById("new_act_date").innerHTML = n;
}
function admin_form_reset(){
  //var d = new Date();
  //var n = d.toLocaleDateString();
  //document.getElementById("aut_btn").disabled = false;
  //document.getElementById("del_btn").disabled = false;
  //document.getElementById("new_btn").disabled = false;
  //document.getElementById("aut_req_date").innerHTML = n;
  //document.getElementById("aut_act_date").innerHTML = n;
  //document.getElementById("new_town").value = document.getElementById("town").value;
  //document.getElementById("new_req_date").innerHTML = n;
  //document.getElementById("new_act_date").innerHTML = n;
}


// MTN INPUT FUNCTIONS - START
function get_conai_val(sel){
  var selidx = sel.options[sel.selectedIndex].index;
  var selval = sel.options[sel.selectedIndex].value;
  if (selidx > 0) {
    document.getElementById('conai_val').disabled = false;
  } else {
    document.getElementById('conai_val').disabled = true;
    document.getElementById('conai_val').value = '';
  }
}
function get_miur_val(sel){
  var selidx = sel.options[sel.selectedIndex].index;
  var selval = sel.options[sel.selectedIndex].value;
  if (selidx > 0) {
    document.getElementById('miur_val').disabled = false;
  } else {
    document.getElementById('miur_val').disabled = true;
    document.getElementById('miur_val').value = '';
  }
}
// Verifica che tutti i campi obbligatori siano popolati correttamente e se tutto quadra sblocca il pulsante di submit save_mtn
function mtn_submit_chk(){
  var canone = document.getElementById('canone').value;
  var tari = document.getElementById('tari').value;
  var conai_chk = document.getElementById('conai_chk').value;
  var conai_val = document.getElementById('conai_val').value;
  var miur_chk = document.getElementById('miur_chk').value;
  var miur_val = document.getElementById('miur_val').value;
  var pef_file = document.getElementById('pef_file').value;
  var pef_len = pef_file.length;
  if(
    canone >= 100000 && //canone>=100000
    tari >= 100000 && //tari>=100000
    ((conai_chk == 1 && conai_val >=10000) || conai_chk == 0) && //conai>=100000
    ((miur_chk == 1 && miur_val >=1000) || miur_chk == 0) && // miur>=1000
    pef_len > 0
    ) {
      document.getElementById('save_mtn').disabled = false;
	  document.getElementById('save_mtn').style = 'width: 100%; color: green';
    } else {
      document.getElementById('save_mtn').disabled = true;
	  document.getElementById('save_mtn').style = 'width: 100%; color: red';
  }
}
// MTN INPUT FUNCTIONS - END

// MTR INPUT FUNCTIONS - START
function calcola_iva(fld,iva) {
  var fld_name = fld.name;
  var fld_val = fld.value;
  var fld_iva = fld_name + '_iva';
  var iva = fld_val*iva;
  document.getElementById(fld_iva).value = iva.toFixed(2);
}
function calc_carc_tot(){
  var c1 = parseInt(document.getElementById('carc_pers').value); 
  var c2 = parseInt(document.getElementById('carc_post').value); 
  var c3 = parseInt(document.getElementById('carc_risc').value); 
  var c4 = parseInt(document.getElementById('carc_cont').value); 
  var c5 = parseInt(document.getElementById('carc_soft').value); 
  var c6 = parseInt(document.getElementById('carc_gest').value);
  var ctot = c1+c2+c3+c4+c5+c6;
  document.getElementById('carc_tot').value = ctot;
  var i1 = parseFloat(document.getElementById('carc_pers_iva').value); 
  var i2 = parseFloat(document.getElementById('carc_post_iva').value); 
  var i3 = parseFloat(document.getElementById('carc_risc_iva').value); 
  var i4 = parseFloat(document.getElementById('carc_cont_iva').value); 
  var i5 = parseFloat(document.getElementById('carc_soft_iva').value); 
  var i6 = parseFloat(document.getElementById('carc_gest_iva').value);
  var itot = i1+i2+i3+i4+i5+i6;
  document.getElementById('carc_tot_iva').value = itot.toFixed(2);
}
function calc_carc_iva(){
  var i1 = parseFloat(document.getElementById('carc_pers_iva').value); 
  var i2 = parseFloat(document.getElementById('carc_post_iva').value); 
  var i3 = parseFloat(document.getElementById('carc_risc_iva').value); 
  var i4 = parseFloat(document.getElementById('carc_cont_iva').value); 
  var i5 = parseFloat(document.getElementById('carc_soft_iva').value); 
  var i6 = parseFloat(document.getElementById('carc_gest_iva').value);
  var itot = i1+i2+i3+i4+i5+i6;
  document.getElementById('carc_tot_iva').value = itot.toFixed(2);
}
function calc_cc_tot(){
  var c1 = parseInt(document.getElementById('cc_cgg').value); 
  var c2 = parseInt(document.getElementById('cc_ccd').value); 
  var c3 = parseInt(document.getElementById('cc_coal').value); 
  var ctot = c1+c2+c3;
  document.getElementById('cc_tot').value = ctot;
  var i1 = parseFloat(document.getElementById('cc_cgg_iva').value); 
  var i2 = parseFloat(document.getElementById('cc_ccd_iva').value); 
  var i3 = parseFloat(document.getElementById('cc_coal_iva').value); 
  var itot = i1+i2+i3;
  document.getElementById('cc_tot_iva').value = itot.toFixed(2);
}
function calc_cc_iva(){
  var i1 = parseFloat(document.getElementById('cc_cgg_iva').value); 
  var i2 = parseFloat(document.getElementById('cc_ccd_iva').value); 
  var i3 = parseFloat(document.getElementById('cc_coal_iva').value); 
  var itot = i1+i2+i3;
  document.getElementById('cc_tot_iva').value = itot.toFixed(2);
}
function calc_acc_tot(){
  var c1 = parseInt(document.getElementById('acc_disc').value); 
  var c2 = parseInt(document.getElementById('acc_cde').value); 
  var c3 = parseInt(document.getElementById('acc_risc').value); 
  var c4 = parseInt(document.getElementById('acc_nor_trib').value); 
  var ctot = c1+c2+c3+c4;
  document.getElementById('acc_tot').value = ctot;
}
function calc_det_tot(){
  var c1 = parseInt(document.getElementById('miur_eff').value); 
  var c2 = parseInt(document.getElementById('rec_eva_eff').value); 
  var c3 = parseInt(document.getElementById('proc_sanz').value); 
  var c4 = parseInt(document.getElementById('part_ent_comp').value); 
  var ctot = c1+c2+c3+c4;
  document.getElementById('det_tot').value = ctot;
}

// Verifica che tutti i campi obbligatori siano popolati correttamente e se tutto quadra sblocca il pulsante di submit save_mtn
function mtr_submit_chk(){
  var canone = document.getElementById('canone').value;
  var canone_ben = document.getElementById('canone_ben').value;
  var canone_len = canone_ben.length
  var cts_ben = document.getElementById('cts_ben').value;
  var ctr_ben = document.getElementById('ctr_ben').value;
  var csl_ben = document.getElementById('csl_ben').value;

  // canone_ben => len>0
  // cts_ben => value>1
  // ctr_ben => value>1
  // csl_ben => value>1

  if(
    canone >= 100000 && //canone>=100000
    canone_len > 0 && // lunghezza stringa ragione sociale > 0
    cts_ben > 1 &&  // beneficiario cts > 1
    ctr_ben > 1 &&  // beneficiario cts > 1
    csl_ben > 1  // beneficiario cts > 1
    //((miur_chk == 1 && miur_val >=1000) || miur_chk == 0) // miur>=1000
    ) {
	  document.getElementById('save_mtr').style = 'width: 100%; color: green';
      document.getElementById('save_mtr').disabled = false;
    } else {
      document.getElementById('save_mtr').disabled = true;
	  document.getElementById('save_mtr').style = 'width: 100%; color: red';
  }
}
// MTR INPUT FUNCTIONS - END

// INVIO FUNCTIONS - START
// Verifica che tutti i campi obbligatori siano popolati correttamente e se tutto quadra sblocca il pulsante di submit save_mtn
function invio_submit_chk(){
  var pef_file = document.getElementById('pef_file').value;
  var pef_len = pef_file.length;
  if(
    pef_len > 0
    ) {
      document.getElementById('save_invio').disabled = false;
	  document.getElementById('save_invio').style = 'width: 100%; color: green';
    } else {
      document.getElementById('save_invio').disabled = true;
	  document.getElementById('save_invio').style = 'width: 100%; color: red';
  }
}
// INVIO FUNCTIONS - END

// INPUT FUNCTIONS - START
// Verifica che tutti i campi obbligatori siano popolati correttamente e se tutto quadra sblocca il pulsante di submit save_mtn
function input_submit_chk(){
  var pef_year = document.getElementById('pef_year').value;
  var pef_comp = document.getElementById('pef_comp').value;
  var pef_comp_len = pef_comp.length
  var pef_ben = document.getElementById('pef_ben').value;
  var pef_ben_len = pef_ben.length
  if(
      pef_year > 0 &&
      pef_comp_len > 0 &&
      pef_ben_len > 0
    ) {
      document.getElementById('save_input').disabled = false;
	  document.getElementById('save_input').style = 'height:60px; padding:10px; v-align:middle; background-color: #044A92;width: 100%; color: green';
    } else {
      document.getElementById('save_input').disabled = true;
	  document.getElementById('save_input').style = 'height:60px; padding:10px; v-align:middle; background-color: #044A92;width: 100%; color: red';
  }
}

// INPUT FUNCTIONS - END

// WELCOME FUNCTIONS - START
function save() {
}
// WELCOME FUNCTIONS - END


