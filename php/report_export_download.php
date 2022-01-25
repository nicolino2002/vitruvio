<?php


        include('session.php');
         /*
        echo $report_id;
        echo $town_id;
        echo $login_town;
        echo $login_user;*/


        $report_id=$_SESSION['export_town'];

        //Including PHPExcel library and creation of its object
        require('../php_excel/PHPExcel.php');
        $phpExcel = new PHPExcel;
        // Styling
        $phpExcel->getDefaultStyle()->getFont()->setName('Arial');
        $phpExcel->getDefaultStyle()->getFont()->setSize(12);

        //Setting description, creator and title
        $phpExcel ->getProperties()->setTitle("Report Comune di".$login_town);
        $phpExcel ->getProperties()->setCreator($login_user);
        $phpExcel ->getProperties()->setDescription("Report Comune di ".$login_town);

        // Creating PHPExcel spreadsheet writer object
        // We will create xlsx file (Excel 2007 and above)
        $writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
        // When creating the writer object, the first sheet is also created
        // We will get the already created sheet
        $count=0;
        $sheet[$count] = $phpExcel ->getActiveSheet();
        // Setting title of the sheet
        $sheet[$count]->setTitle("Form A");
        // Creating spreadsheet header
        $index=0;
        $sql = "SELECT * FROM `mtn` WHERE `report_id`= '$report_id' AND `valid`= 1  AND `visible`= 1";
        $ses_sql = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

        $columns = range('A', 'Z');
        $fields_name=  array(
                             'rag_soc',
                             'canone_mtn',
                             'contr_chk',
                             'conai_chk',
                             'cts_chk',
                             'ctr_chk',
                             'csl_chk',
                             'ru_chk',
                             'data_del',
                             'data_app',
                             'ces_chk',
                             'ces_desc',
                             'lav_chk',
                             'lav_desc',
                             'att_gest_chk',
                             'qual_chk',
                            );


        $fields_number=count($fields_name);

        for ($index=0; $index < $fields_number; $index++) {
          $fields_content[$index]=$row[$fields_name[$index]];
          //echo $fields_content[$index]."<br>";
        }

        $sheet[$count] ->getCell($columns[0].'1')->setValue('Campi');
        $sheet[$count]->getStyle('A1')->getFont()->setBold(true);

        //nomi dei campi
        for ($index=0; $index < $fields_number; $index++) {
        $sheet[$count] ->getCell($columns[$index+1].'1')->setValue($fields_name[$index]);
        }

        //contenuto campi
        for ($index=0; $index < $fields_number; $index++) {
        $sheet[$count] ->getCell($columns[$index+1].'2')->setValue($fields_content[$index]);
        }







                  //MTR
                  $count++;
                  $row_count=2;
                  $sheet[$count] = $phpExcel ->createSheet();
                  for ($y=2020; $y < 2022; $y++) {
                  // Setting title of the sheet
                  $sheet[$count]->setTitle('Form B');
                  // Creating spreadsheet header
                  $index=0;
                  $sql = "SELECT * FROM `mtr` WHERE `report_id`= '$report_id' AND `year`=$y AND `valid`= 1  AND `visible`= 1";
                  $ses_sql = mysqli_query($db,$sql);
                  $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

                  $columns = range('A', 'Z');
                  $fields_name=  array(
                                         'tari',
                                         'ricavi_mat',
                                         'ricavi_ener',
                                         'ricavi_inc_ener',
                                         'miur',
                                         'rec_evasione',
                                         'sanzioni',
                                         'ricavi_fp',
                                         'fp_fisse',
                                         'fp_var',
                                         'altre_entrate',
                                         'note',
                                         'fondi_admin',
                                         'fondi_qui',
                                         'fondi_oneri',
                                         'fondi_crediti',
                                         'fondi_tasse',
                                         'fondi_post_mortem',
                                         'fondi_terzi',);


                  $fields_number=count($fields_name);

                  for ($index=0; $index < $fields_number; $index++) {
                    $fields_content[$index]=$row[$fields_name[$index]];
                    //echo $fields_content[$index]."<br>";
                  }

                  $sheet[$count] ->getCell($columns[0].'1')->setValue('Campi');
                  $sheet[$count] ->getCell($columns[0].strval($row_count))->setValue('Anno '.strval($y));
                  $sheet[$count]->getStyle('A1')->getFont()->setBold(true);

                  //nomi dei campi
                  for ($index=0; $index < $fields_number; $index++) {
                  $sheet[$count] ->getCell($columns[$index+1].'1')->setValue($fields_name[$index]);
                  }

                  //contenuto campi
                  for ($index=0; $index < $fields_number; $index++) {
                  $sheet[$count] ->getCell($columns[$index+1].strval($row_count))->setValue($fields_content[$index]);
                  }
                  $row_count++;
                }


                //INVIO FILE
                $count++;
                $row_count=2;
                $sheet[$count] = $phpExcel ->createSheet();
                // Setting title of the sheet
                $sheet[$count]->setTitle('Form C');
                $sql = "SELECT * FROM `invio` WHERE `report_id`= '$report_id' AND `valid`= 1  AND `visible`= 1";
                $ses_sql = mysqli_query($db,$sql);
                $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

                $columns = range('A', 'Z');
                $fields_name=  array(

                                     'pef_comune_grezzo_2020',
                                     'relazione_pef_comune_2020',
                                     'pef_comune_grezzo_2021',
                                     'relazione_pef_comune_2021',
                                     'pef_comune_etc_2020',
                                     'pef_comune_etc_2021',
                                     'contratto_gestore',
                                     'delibera_2021',

                                    );


                $fields_number=count($fields_name);

                for ($index=0; $index < $fields_number; $index++) {
                  $fields_content[$index]=$row[$fields_name[$index]];
                  //echo $fields_content[$index]."<br>";
                }

                $sheet[$count] ->getCell($columns[0].'1')->setValue('Campi');
                $sheet[$count]->getStyle('A1')->getFont()->setBold(true);

                //nomi dei campi
                for ($index=0; $index < $fields_number; $index++) {
                $sheet[$count] ->getCell($columns[$index+1].'1')->setValue($fields_name[$index]);
                }

                //contenuto campi
                for ($index=0; $index < $fields_number; $index++) {
                $sheet[$count] ->getCell($columns[$index+1].'2')->setValue($fields_content[$index]);
                }

                //INPUT
                $count++;
                $row_count=2;
                $sheet[$count] = $phpExcel ->createSheet();
                for ($y=2020; $y < 2022; $y++) {
                // Setting title of the sheet
                $sheet[$count]->setTitle('Form D - E');
                // Creating spreadsheet header
                $index=0;
                $sql = "SELECT * FROM `input` WHERE `report_id`= '$report_id' AND `year`=$y AND `valid`= 1  AND `visible`= 1";
                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {


                $columns = range('A', 'Z');
                $fields_name=  array(
                                     'missione',
                                     'programma',
                                     'macroaggregato',
                                     'descrizione',
                                     'impegno',
                                     'ptari',
                                     'pef',
                                     'costo',
                                     'piva',
                                     'bilancio',
                                     'gestione',
                                     'netto',
                                     'iva',
                                     'note',
                            );


                $fields_number=count($fields_name);

                for ($index=0; $index < $fields_number; $index++) {
                  $fields_content[$index]=$row[$fields_name[$index]];
                  //echo $fields_content[$index]."<br>";
                }

                $sheet[$count] ->getCell($columns[0].'1')->setValue('Campi');
                $sheet[$count] ->getCell($columns[0].strval($row_count))->setValue('Anno '.strval($y));
                $sheet[$count]->getStyle('A1')->getFont()->setBold(true);

                //nomi dei campi
                for ($index=0; $index < $fields_number; $index++) {
                $sheet[$count] ->getCell($columns[$index+1].'1')->setValue($fields_name[$index]);
                }

                //contenuto campi
                for ($index=0; $index < $fields_number; $index++) {
                $sheet[$count] ->getCell($columns[$index+1].strval($row_count))->setValue($fields_content[$index]);
                }
                $row_count++;
              }
            }
          }

          //EXTRA
          $count++;
          $row_count=2;
          $sheet[$count] = $phpExcel ->createSheet();
          // Setting title of the sheet
          $sheet[$count]->setTitle('Form F');
          // Creating spreadsheet header
          $index=0;
          $sql = "SELECT * FROM `extra` WHERE `report_id`= '$report_id' AND `valid`= 1  AND `visible`= 1";
          $result = $db->query($sql);
          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {

          $columns = range('A', 'Z');
          $fields_name=  array(  'soggetto',
                                 'tipologia',
                                 'componente',
                                 'anno',
                                 'quant',
                                 'prezzo',
                                 'totale',);


          $fields_number=count($fields_name);

          for ($index=0; $index < $fields_number; $index++)
          {
            $fields_content[$index]=$row[$fields_name[$index]];
            //echo $fields_content[$index]."<br>";
          }

          $sheet[$count] ->getCell($columns[0].'1')->setValue('Campi');
          $sheet[$count]->getStyle('A1')->getFont()->setBold(true);

          //nomi dei campi
          for ($index=0; $index < $fields_number; $index++)
          {
            $sheet[$count] ->getCell($columns[$index+1].'1')->setValue($fields_name[$index]);
          }

          //contenuto campi
          for ($index=0; $index < $fields_number; $index++)
          {
            $sheet[$count] ->getCell($columns[$index+1].strval($row_count))->setValue($fields_content[$index]);
          }
              $row_count++;
            }
          }


        // Making headers text bold and larger
        //$sheet->getStyle('A1:D1')->getFont()->setBold(true)->setSize(14);
        // Save the spreadsheet
        $sql="SELECT `id`,`id_town` FROM `reports` WHERE `id`=$report_id AND `valid`=1 AND `visible`=1";
        $result = $db->query($sql);

        if ($result->num_rows == 1 ) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            $town_id=$row['id_town'] ;
          }
        } else {
          echo "0 results";
        }

        $sql="SELECT `id`,`town` FROM `towns` WHERE `id`=$town_id AND `valid`=1 AND `visible`=1";
        $result = $db->query($sql);

        if ($result->num_rows == 1 ) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            $towname=$row['town'] ;
          }
        } else {
          echo "0 results";
        }


        $writer->save('../excel_files/Report comune di '.$towname.'.xlsx');
        //Download the spreadsheet
        // Initialize a file URL to the variable

        $file_name='Report comune di '.$towname.'.xlsx';
        $file_to_download = '../excel_files/'.$file_name;
        $client_file = $file_name;

        $download_rate = 200; // 200Kb/s

        $f = null;

        try {
        	if (!file_exists($file_to_download)) {
        		throw new Exception('File ' . $file_to_download . ' does not exist');
        	}

        	if (!is_file($file_to_download)) {
        		throw new Exception('File ' . $file_to_download . ' is not valid');
        	}

        	header('Cache-control: private');
        	header('Content-Type: application/octet-stream');
        	header('Content-Length: ' . filesize($file_to_download));
        	header('Content-Disposition: filename=' . $client_file);

        	// flush the content to the web browser
        	flush();
        	$f = fopen($file_to_download, 'r');
        	while (!feof($f)) {
        		print fread($f, round($download_rate * 1024));
        		flush();
        		sleep(1);
        	}
        } catch (\Throwable $e) {
        	echo $e->getMessage();
        } finally {
        	if ($f) {
        		fclose($f);
        	}
        }



       ?>
