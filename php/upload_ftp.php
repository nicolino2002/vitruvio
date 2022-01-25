<html>
  <body>
    <form enctype="multipart/form-data" action="upload.php" method="POST">
      <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
      Choose a file to upload: <input name="uploadedfile" type="file" /><br />
      <input type="submit" value="Upload File" />
    </form>
  </body>
</html>
    <?php
        //https://stackoverflow.com/questions/14280688/ftp-upload-via-php-form
        $ftp_server = "xxx";
        $ftp_username   = "xxx";
        $ftp_password   =  "xxx";

        // setup of connection
        $conn_id = ftp_connect($ftp_server) or die("could not connect to $ftp_server");

        // login
        if (@ftp_login($conn_id, $ftp_username, $ftp_password))
        {
          echo "conectd as $ftp_username@$ftp_server\n";
        }
        else
        {
          echo "could not connect as $ftp_username\n";
        }

        $file = $_FILES["file"]["name"];
        $remote_file_path = "/bintobit.com/infowaste/test/upload".$file;
        ftp_put($conn_id, $remote_file_path, $file, FTP_ASCII);
        ftp_close($conn_id);
        echo "\n\nconnection closed";
    ?>
