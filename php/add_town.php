
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>

  </body>
</html>
<?php

include('session.php');

  if ($login_role == 'Admin') {

          echo "
          <html lang='en' dir='ltr'>
            <head>
              <title>Aggiungi Comune</title>
            </head>
            <body>";
            if (isset($_POST['reg'])) {
            $reg=$_POST['reg'];
            $reg=trim($reg);
            }
            if (isset($_POST['prov'])) {
            $prov=$_POST['prov'];
            $prov=trim($prov);

            }
            if (isset($_POST['town'])) {
            $town=$_POST['town'];
            $town=trim($town);

            }



              if (!empty($town) && !empty($prov) && !empty($reg))
              {
                // code...
              $sql = "UPDATE `towns` SET `visible`='1' ,`valid`='1' WHERE `id`='$town'";
              if ($db->query($sql) === TRUE) {
                echo "New town added successfully";
              } else {
                echo "Error: " . $db . "<br>" . $dn->error;
              }
              echo $sql;
              $db->close();
              }

              echo "
            </body>
          </html>
          ";
          header('Location: ' . $_SERVER['HTTP_REFERER']);



      }else {
        echo "Accesso negato";
      }
 ?>
