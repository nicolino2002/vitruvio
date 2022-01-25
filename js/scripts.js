var savebutton="background-color: #044e8f;";

// NEW USER START
function privacy_chk(){
  document.getElementById('privacy').disabled = false;
  document.getElementById('privacy').value = 1;
  }
function service_chk(){
  document.getElementById('service').disabled = false;
  document.getElementById('service').value = 1;
  }
function invio_chk(){
  var service = document.getElementById('service').value;
  var privacy = document.getElementById('privacy').value;
  if(
    service=1 &&
    privacy==1
    ) {
      document.getElementById('invio').disabled = false;
	}
  }
// NEW USER END

// Select Initial Region
function get_reg(){
  var ajaxRequest;  // The variable that makes Ajax possibleg
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
      var ajaxDisplay = document.getElementById('title');
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

// Select Initial Region
function get_reg_new(action){
  console.log(action);
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
// Region Selected => Get Prov
function get_prov_new(sel,action){
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
function get_town_new(sel,action){
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

// Select Initial Region
function get_reg_add(){
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
  ajaxRequest.open("GET", "./php/get_reg_add.php", true);
  ajaxRequest.send(null);
  // Disable prov & town
  document.getElementById('prov').options.item(0).select;
  document.getElementById('town').options.item(0).select;
  document.getElementById('prov').disabled = true;
  document.getElementById('town').disabled = true;
}
// Region Selected => Get Prov
function get_prov_add(sel){
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
    ajaxRequest.open("GET", "./php/get_prov_add.php" + queryString, true);
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
function get_town_add(sel){
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
    ajaxRequest.open("GET", "./php/get_town_add.php" + queryString, true);
    ajaxRequest.send(null);
    document.getElementById('town').disabled = false;
  } else {
    document.getElementById('town').options.item(0).select;
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
                //$("#aut_act_date").replaceWith("<label class=\"text-capitalize\" id=\"aut_act_date\" name = \"aut_act_date\">" + response[0].act_date + "</label>");
                $("#aut_role").replaceWith("<label class=\"text-capitalize\" id=\"aut_role\" name = \"aut_role\">" + response[0].role + "</label>");
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
                $("#del_act_date").replaceWith("<label class=\"text-capitalize\" id=\"del_act_date\" name = \"del_act_date\">" + response[0].act_date + "</label>");
                $("#del_role").replaceWith("<label class=\"text-capitalize\" id=\"del_role\" name = \"del_role\">" + response[0].role + "</label>");
                $("#del_title").replaceWith("<label class=\"text-capitalize\" id=\"del_title\" name = \"del_title\">" + response[0].title + "</label>");
                $("#del_mail2").replaceWith("<label class=\"text-capitalize\" id=\"del_mail2\" name = \"del_mail2\">" + response[0].mail2 + "</label>");
            }
        }
    });
}
// Town Selected => Get Next
function get_report_id(sel){
  var selidx = sel.options[sel.selectedIndex].index;
  var selval = sel.options[sel.selectedIndex].value;
  if (selidx > 0) {
  } else {
    document.getElementById('town').value = true;
  }
}

// Support Mail
function php_mail(subject, cc) {
  var message = prompt("Inserire una descrizione della richiesta di supporto");
  $.ajax({
      url: 'mail.php',
      type: 'POST',
      data: "subject=" + subject + "&to=" + "assistenza@bintobit.com" + "&cc=" + cc + "&message=" + message,
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
// Support Mail
function supp_mail(subject) {
  var message = prompt("Inserire una descrizione della richiesta di supporto");
  var cc = document.getElementById('email').value;
  $.ajax({
      url: './php/mail.php',
      type: 'POST',
      data: "subject=" + subject + "&to=" + "assistenza@bintobit.com" + "&cc=" + cc + "&message=" + message,
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

// Password Forgotten Mail START
function pwd_mail() {
  var subject = 'Richiesta Password Dimenticata';
  var to = "assistenza@bintobit.com";
  var message = prompt("Inserire l'account (email) con cui si vuole accedere");
  if (!validateEmail(message)) {
    message = prompt("Inserire un account CORRETTO (email) con cui si vuole accedere");
    if (validateEmail(message)) {
      var cc = message;
      message = "Account: "+ cc;
      mail_req(subject,to,cc,message);
    }
  } else {
    var cc = message;
    message = "Account: "+ cc;
    mail_req(subject,to,cc,message);
  }
}
// Check email format (regular expression)
function validateEmail(email) {
  var regexp = /^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,4}$/;
  //var regexp = /^(([^<>;()[].,;:s@"]+(.[^<>()[].,;:s@"]+)*)|(".+"))@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}])|(([a-zA-Z-0-9]+.)+[a-zA-Z]{2,}))$/;
  return regexp.test(email);
}
// Mail Ajax Request
function mail_req(subject,to,cc,message) {
  $.ajax({
      url: './php/mail.php',
      type: 'POST',
      data: "subject=" + subject + "&to=" + to + "&cc=" + cc + "&message=" + message,
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
// Password Forgotten Mail END

// Salva nel DB - Click su pulsante Salva nella pagina welcome.php
function save() {
}

/*
function get_curr_date(tag){
  var d = new Date();
  //d+'';                  // "Sun Dec 08 2013 18:55:38 GMT+0100"
  //d.toDateString();      // "Sun Dec 08 2013"
  //d.toISOString();       // "2013-12-08T17:55:38.130Z"
  //d.toLocaleDateString() // "8/12/2013" on my systemaut
  tag.value = d.toLocaleString()     // "8/12/2013 18.55.38" on my system
  //d.toUTCString()        // "Sun, 08 Dec 2013 17:55:38 GMT"
}*/
function new_user(){
  var d = new Date();
  var n = d.toLocaleDateString();
  document.getElementById("aut_btn").disabled = false;
  document.getElementById("del_btn").disabled = false;
  document.getElementById("new_btn").disabled = false;
  //document.getElementById("aut_req_date").innerHTML = n;
  //document.getElementById("aut_act_date").innerHTML = n;
  document.getElementById("new_town").value = document.getElementById("town").value;
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
  var canone_mtn = document.getElementById('canone_mtn').value;
  var conai_chk = document.getElementById('conai_chk').value;

  if(canone_mtn >= 100000 )
  {
      document.getElementById('save_mtn').disabled = false;
      document.getElementById('save_mtn').style = savebutton + '; color: white';
    } else {
      document.getElementById('save_mtn').disabled = true;
	  document.getElementById('save_mtn').style = savebutton + '; color: red';
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
function get_cts_val(sel){
  var selidx = sel.options[sel.selectedIndex].index;
  var selval = sel.options[sel.selectedIndex].value;
  if (selidx > 0) {
    document.getElementById('cts').disabled = false;
    document.getElementById('cts_ben').disabled = false;
    document.getElementById('cts_iva').disabled = false;
  } else {
    document.getElementById('cts').disabled = true;
    document.getElementById('cts_ben').disabled = true;
    document.getElementById('cts_iva').disabled = true;
    document.getElementById('cts').value = '';
    document.getElementById('cts_ben').value = 1;
    document.getElementById('cts_iva').value = '';
  }
}
function get_ctr_val(sel){
  var selidx = sel.options[sel.selectedIndex].index;
  var selval = sel.options[sel.selectedIndex].value;
  if (selidx > 0) {
    document.getElementById('ctr').disabled = false;
    document.getElementById('ctr_ben').disabled = false;
    document.getElementById('ctr_iva').disabled = false;
  } else {
    document.getElementById('ctr').disabled = true;
    document.getElementById('ctr_ben').disabled = true;
    document.getElementById('ctr_iva').disabled = true;
    document.getElementById('ctr').value = '';
    document.getElementById('ctr_ben').value = 1;
    document.getElementById('ctr_iva').value = '';
  }
}
function get_csl_val(sel){
  var selidx = sel.options[sel.selectedIndex].index;
  var selval = sel.options[sel.selectedIndex].value;
  if (selidx > 0) {
    document.getElementById('csl').disabled = false;
    document.getElementById('csl_ben').disabled = false;
    document.getElementById('csl_iva').disabled = false;
  } else {
    document.getElementById('csl').disabled = true;
    document.getElementById('csl_ben').disabled = true;
    document.getElementById('csl_iva').disabled = true;
    document.getElementById('csl').value = '';
    document.getElementById('csl_ben').value = 1;
    document.getElementById('csl_iva').value = '';
  }
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
  var miur = document.getElementById('miur').value;
  var rec_eva = document.getElementById('rec_eva').value;
  var proc_sanz = document.getElementById('proc_sanz').value;
  var part_ent_comp = document.getElementById('part_ent_comp').value;

  // canone_ben => len>0
  // cts_ben => value>1
  // ctr_ben => value>1
  // csl_ben => value>1

  if(
    miur >= 0 &&
    rec_eva >= 0 &&
    proc_sanz >= 0 &&
    part_ent_comp >= 0
    ) {
	  document.getElementById('save_mtr').style = savebutton+';color: white';
      document.getElementById('save_mtr').disabled = false;
    } else {
      document.getElementById('save_mtr').disabled = true;
	  document.getElementById('save_mtr').style = savebutton+';color: red';
  }
}
// MTR INPUT FUNCTIONS - END


function changeContent() {
  if (pef2020_appr_chk){document.getElementById('pef2020_appr_file').disabled = false;}else{document.getElementById('pef2020_appr_file').disabled = true;}
}

// INVIO FUNCTIONS - START
// Verifica che tutti i campi obbligatori siano popolati correttamente e se tutto quadra sblocca il pulsante di submit save_mtn
function invio_submit_chk(){
  var pef2020_appr_chk = document.getElementById('pef2020_appr_chk').checked;
  var pef2018_comune_chk = document.getElementById('pef2018_comune_chk').checked;
  var pef2019_comune_chk = document.getElementById('pef2019_comune_chk').checked;
  var pef2020_comune_chk = document.getElementById('pef2020_comune_chk').checked;
  var pef2018_gestore_chk = document.getElementById('pef2018_gestore_chk').checked;
  var pef2019_gestore_chk = document.getElementById('pef2019_gestore_chk').checked;
  var pef2020_gestore_chk = document.getElementById('pef2020_gestore_chk').checked;
  var pef2020_appr_file = document.getElementById('pef2020_appr_file').value;
  var pef2018_comune_file = document.getElementById('pef2018_comune_file').value;
  var pef2019_comune_file = document.getElementById('pef2019_comune_file').value;
  var pef2020_comune_file = document.getElementById('pef2020_comune_file').value;
  var pef2018_gestore_file = document.getElementById('pef2018_gestore_file').value;
  var pef2019_gestore_file = document.getElementById('pef2019_gestore_file').value;
  var pef2020_gestore_file = document.getElementById('pef2020_gestore_file').value;
  var tar2020_date = document.getElementById('tar2020_date').value;
  var appalto_date = document.getElementById('appalto_date').value;
  var pef2020_appr_len = pef2020_appr_file.length;
  var pef2018_comune_len = pef2018_comune_file.length;
  var pef2019_comune_len = pef2019_comune_file.length;
  var pef2020_comune_len = pef2020_comune_file.length;
  var pef2018_gestore_len = pef2018_gestore_file.length;
  var pef2019_gestore_len = pef2019_gestore_file.length;
  var pef2020_gestore_len = pef2020_gestore_file.length;
  var pef2019_gestore_len = pef2019_gestore_file.length;
  var tar2020_date_len = tar2020_date.length;
  var appalto_date_len = appalto_date.length;
  if (pef2020_appr_chk){document.getElementById('pef2020_appr_file').disabled = false;}else{document.getElementById('pef2020_appr_file').disabled = true;}
  if (pef2018_comune_chk){document.getElementById('pef2018_comune_file').disabled = false;}else{document.getElementById('pef2018_comune_file').disabled = true;}
  if (pef2019_comune_chk){document.getElementById('pef2019_comune_file').disabled = false;}else{document.getElementById('pef2019_comune_file').disabled = true;}
  if (pef2020_comune_chk){document.getElementById('pef2020_comune_file').disabled = false;}else{document.getElementById('pef2020_comune_file').disabled = true;}
  if (pef2018_gestore_chk){document.getElementById('pef2018_gestore_file').disabled = false;}else{document.getElementById('pef2018_gestore_file').disabled = true;}
  if (pef2019_gestore_chk){document.getElementById('pef2019_gestore_file').disabled = false;}else{document.getElementById('pef2019_gestore_file').disabled = true;}
  if (pef2020_gestore_chk){document.getElementById('pef2020_gestore_file').disabled = false;}else{document.getElementById('pef2020_gestore_file').disabled = true;}
  if(
    (pef2020_appr_chk==false || (pef2020_appr_chk && pef2020_appr_len > 0)) &&
    (pef2018_comune_chk==false || (pef2018_comune_chk && pef2018_comune_len > 0)) &&
    (pef2019_comune_chk==false || (pef2019_comune_chk && pef2019_comune_len > 0)) &&
    (pef2020_comune_chk==false || (pef2020_comune_chk && pef2020_comune_len > 0)) &&
    (pef2018_gestore_chk==false || (pef2018_gestore_chk && pef2018_gestore_len > 0)) &&
    (pef2019_gestore_chk==false || (pef2019_gestore_chk && pef2019_gestore_len > 0)) &&
    (pef2020_gestore_chk==false || (pef2020_gestore_chk && pef2020_gestore_len > 0)) &&
    tar2020_date_len > 0 &&
    appalto_date_len > 0
    ) {
      document.getElementById('save_invio').disabled = false;
	  document.getElementById('save_invio').style = savebutton+'; color: white';
    } else {
      document.getElementById('save_invio').disabled = true;
	  document.getElementById('save_invio').style = savebutton+'; color: red';
  }
}
// INVIO FUNCTIONS - END

// INPUT FUNCTIONS - START
// Verifica che tutti i campi obbligatori siano popolati correttamente e se tutto quadra sblocca il pulsante di submit save_mtn
function input_submit_chk(){
  var year = document.getElementById('year').value;
  var costo = document.getElementById('costo').value;
  var bilancio = document.getElementById('bilancio').value;
  var gestione = document.getElementById('gestione').value;
  var piva = document.getElementById('piva').value;
  var costo_len = costo.length;
  var bilancio_len = bilancio.length;
  var gestione_len = gestione.length;
  var piva_len = piva.length;
  if(
      year > 0 &&
      costo_len > 0 &&
      bilancio_len > 0 &&
      gestione_len > 0 &&
      piva_len > 0
    ) {

      document.getElementById('save_input').disabled = false;
    document.getElementById('save_input').style = 'background-color:#044A92;color:white';

    } else {
      document.getElementById('save_input').disabled = true;
      document.getElementById('save_input').style = 'background-color:#044A92;color:red';


  }
}
function calcola_pef(){
  var impegno = document.getElementById('impegno').value;
  var ptari = document.getElementById('ptari').value;
  pef = impegno*ptari/100.0;
  document.getElementById('pef').value = pef.toFixed(2);
}
function calcola_netto(){
  var pef = document.getElementById('pef').value;
  var piva = document.getElementById('piva').value;
  netto = pef/(1.0+piva/100.0);
  iva = pef-netto;
  document.getElementById('iva').value = iva.toFixed(2);
  document.getElementById('netto').value = netto.toFixed(2);
}

// INPUT FUNCTIONS - END

// EXTRA FUNCTIONS - START
// Verifica che tutti i campi obbligatori siano popolati correttamente e se tutto quadra sblocca il pulsante di submit save_mtn
/*
function extra_submit_chk(){
  var tipologia = document.getElementById('tipologia').value;
  var codice = document.getElementById('codice').value;
  var tipologia_len = codice.length
  var codice_len = codice.length
  var check = document.getElementById('check').checked;
  if(
      tipologia_len > 0 &&
      codice_len > 0 &&
      check
    ) {
      document.getElementById('save_extra').disabled = false;
	  document.getElementById('save_extra').style = savebutton+'; color: white';
    } else {
      document.getElementById('save_extra').disabled = true;
	  document.getElementById('save_extra').style = savebutton+'; color: red';
  }
}
*/

// EXTRA FUNCTIONS - END

// WELCOME FUNCTIONS - START

// WELCOME FUNCTIONS - END
