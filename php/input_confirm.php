<?php
  // Retrieve data from html
  $report_id = trim($_POST['report_id']); 
  $user_id = trim($_POST['user_id']); 
  $username = trim($_POST['username']); 
  $account = trim($_POST['account']); 
  $town = trim($_POST['town']); 
  $title = trim($_POST['title']); 
  $year = trim($_POST['year']); 
  $capitolo = trim($_POST['capitolo']); 
  $certificato = trim($_POST['certificato']); 
  $conto = trim($_POST['conto']); 
  $descrizione = trim($_POST['descrizione']); 
  $impegno = trim($_POST['impegno']); 
  $ptari = trim($_POST['ptari']); 
  $pef = trim($_POST['pef']); 
  $costo = trim($_POST['costo']); 
  $piva = trim($_POST['piva']); 
  $bilancio = trim($_POST['bilancio']); 
  $gestione = trim($_POST['gestione']); 
  $netto = trim($_POST['netto']); 
  $iva = trim($_POST['iva']); 
  $note = trim($_POST['note']); 
  //if($conto==''){$conto='0';}
  if(!$impegno){$impegno=0;}
  if(!$ptari){$ptari=0;}
  if(!$pef){$pef=0;}

echo '
<html>
<script type="text/javascript">
function input_confirm(){
    var r = confirm("Confermi Salvataggio Dati Tavola di Input '.$year.'");
    if(r){
          window.location.href = "input_save.php?report_id='.$report_id.
            '&user_id='.$user_id.
            '&username='.$username.
            '&account='.$account.
            '&town='.$town.
            '&title='.$title.
            '&year='.$year.
            '&capitolo='.$capitolo.
            '&certificato='.$certificato.
            '&conto='.$conto.
            '&descrizione='.$descrizione.
            '&impegno='.$impegno.
            '&ptari='.$ptari.
            '&pef='.$pef.
            '&costo='.$costo.
            '&piva='.$piva.
            '&bilancio='.$bilancio.
            '&gestione='.$gestione.
            '&netto='.$netto.
            '&iva='.$iva.
            '&note='.$note.
            '";
    } else {
      window.history.go(-1);
  }
}
</script>
<body onload="input_confirm()">
</body>
</html>
';
?>
