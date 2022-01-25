<?php


   include('config.php');
   $id_user = mysqli_real_escape_string($db,$_POST['id_user']);
   $id_report = mysqli_real_escape_string($db,$_POST['id_report']);
   $fy = date('Y');




     // Close Old Report
     $sql = "UPDATE `reports` SET `id_status`=9,`visible`=0,`valid`=0,`last_modified_id`=$id_user,`last_modified_date`=now() WHERE `id`=$id_report";
     // echo $sql;
     mysqli_query($db, $sql);
     echo $db->error;

    $sql = "INSERT INTO `reports` (`id_status`,`fy`, `id_town`, `user_creator_id`,`sent_times`, `last_modified_id`, `last_modified_date`) SELECT 2,`fy`, `id_town`, `user_creator_id`,`sent_times`, `last_modified_id`, now() FROM `reports` `a` WHERE `a`.`id`=$id_report";
    // echo $sql;
    mysqli_query($db, $sql);
    $id_report_new = mysqli_insert_id($db);
    echo $db->error;

    //MTN UPDATE
    $sql = "UPDATE `mtn` SET `visible`=0,`valid`=0,`last_modified_id`=$id_user,`last_modified_date`=now() WHERE `report_id`=$id_report";
    // echo $sql;
    mysqli_query($db, $sql);
    echo $db->error;

    //MTN INSERT
    $sql = "INSERT INTO `mtn`
    (`report_id`, `completed`, `year`, `user_creator_id`, `last_modified_id`, `last_modified_date`, `rag_soc`, `canone_mtn`, `contr_chk`, `conai_chk`, `cts_chk`, `ctr_chk`, `csl_chk`, `ru_chk`, `data_del`, `data_app`, `ces_chk`, `ces_desc`, `lav_chk`, `lav_desc`, `att_gest_chk`, `qual_chk`, `pef_file`)
    SELECT
    $id_report_new, `completed`, `year`, $id_user, $id_user, now(),                                  `rag_soc`, `canone_mtn`, `contr_chk`, `conai_chk`, `cts_chk`, `ctr_chk`, `csl_chk`, `ru_chk`, `data_del`, `data_app`, `ces_chk`, `ces_desc`, `lav_chk`, `lav_desc`, `att_gest_chk`, `qual_chk`, `pef_file`
    FROM `mtn` `a` WHERE `a`.`report_id`=$id_report";
    mysqli_query($db, $sql);
    // mtr
    echo $db->error;

    //MTR UPDATE
    $sql = "UPDATE `mtr` SET `visible`=0,`valid`=0,`last_modified_id`=$id_user,`last_modified_date`=now() WHERE `report_id`=$id_report AND `year`='2020'";
    mysqli_query($db, $sql);
    echo $db->error;

    $sql = "UPDATE `mtr` SET `visible`=0,`valid`=0,`last_modified_id`=$id_user,`last_modified_date`=now() WHERE `report_id`=$id_report AND `year`='2021'";
    mysqli_query($db, $sql);
    echo $db->error;

    //MTR INSERT
    $sql = "INSERT INTO `mtr`
    (`report_id`, `completed`, `year`, `user_creator_id`, `last_modified_id`, `last_modified_date`,`tari`, `ricavi_mat`, `ricavi_ener`, `ricavi_inc_ener`, `miur`, `rec_evasione`, `sanzioni`, `ricavi_fp`, `fp_fisse`, `fp_var`, `altre_entrate`, `note`, `fondi_admin`, `fondi_qui`, `fondi_oneri`, `fondi_crediti`, `fondi_tasse`, `fondi_post_mortem`, `fondi_terzi`) SELECT
    $id_report_new, `completed`, `year`, $id_user, $id_user, now(), `tari`, `ricavi_mat`, `ricavi_ener`, `ricavi_inc_ener`, `miur`, `rec_evasione`, `sanzioni`, `ricavi_fp`, `fp_fisse`, `fp_var`, `altre_entrate`, `note`, `fondi_admin`, `fondi_qui`, `fondi_oneri`, `fondi_crediti`, `fondi_tasse`, `fondi_post_mortem`, `fondi_terzi`
    FROM `mtr` `a` WHERE `a`.`report_id`=$id_report AND `year`=2020";
    mysqli_query($db, $sql);
    $sql = "INSERT INTO `mtr`
    (`report_id`, `completed`, `year`, `user_creator_id`, `last_modified_id`, `last_modified_date`,`tari`, `ricavi_mat`, `ricavi_ener`, `ricavi_inc_ener`, `miur`, `rec_evasione`, `sanzioni`, `ricavi_fp`, `fp_fisse`, `fp_var`, `altre_entrate`, `note`, `fondi_admin`, `fondi_qui`, `fondi_oneri`, `fondi_crediti`, `fondi_tasse`, `fondi_post_mortem`, `fondi_terzi`) SELECT
    $id_report_new, `completed`, `year`, $id_user, $id_user, now(), `tari`, `ricavi_mat`, `ricavi_ener`, `ricavi_inc_ener`, `miur`, `rec_evasione`, `sanzioni`, `ricavi_fp`, `fp_fisse`, `fp_var`, `altre_entrate`, `note`, `fondi_admin`, `fondi_qui`, `fondi_oneri`, `fondi_crediti`, `fondi_tasse`, `fondi_post_mortem`, `fondi_terzi`
    FROM `mtr` `a` WHERE `a`.`report_id`=$id_report AND `year`=2021";
    mysqli_query($db, $sql);

    //INVIO UPDATE
    //  `pef_comune_grezzo_2020`, `relazione_pef_comune_2020`, `pef_comune_grezzo_2021`, `relazione_pef_comune_2021`, `pef_comune_etc_2020`, `pef_comune_etc_2021`, `contratto_gestore`, `delibera_2021`
    $sql = "UPDATE `invio` SET `visible`=0,`valid`=0,`last_modified_id`=$id_user,`last_modified_date`=now() WHERE `report_id`=$id_report";
    mysqli_query($db, $sql);
    echo $db->error;

    $sql = "INSERT INTO `invio`
    (`report_id`, `completed`, `user_creator_id`, `last_modified_id`, `last_modified_date`, `pef_comune_grezzo_2020`, `relazione_pef_comune_2020`, `pef_comune_grezzo_2021`, `relazione_pef_comune_2021`, `pef_comune_etc_2020`, `pef_comune_etc_2021`, `contratto_gestore`, `delibera_2021`) SELECT
    $id_report_new, `completed`, $id_user, $id_user, now(), `pef_comune_grezzo_2020`, `relazione_pef_comune_2020`, `pef_comune_grezzo_2021`, `relazione_pef_comune_2021`, `pef_comune_etc_2020`, `pef_comune_etc_2021`, `contratto_gestore`, `delibera_2021`
    FROM `invio` `a` WHERE `a`.`report_id`=$id_report";
    mysqli_query($db, $sql);
    echo $db->error;

    //INPUT
    $sql = "UPDATE `input` SET `visible`=0,`valid`=0,`last_modified_id`=$id_user,`last_modified_date`=now() WHERE `report_id`=$id_report ";
    mysqli_query($db, $sql);
    echo $db->error;

    $sql = "INSERT INTO `input`
    (`report_id`, `completed`, `year`, `user_creator_id`, `last_modified_id`, `last_modified_date`,`missione`, `programma`, `macroaggregato`, `descrizione`, `impegno`, `ptari`, `pef`, `costo`, `piva`, `bilancio`, `gestione`, `netto`, `iva`, `note` ) SELECT
    $id_report_new, `completed`, `year`, `user_creator_id`, $id_user, now(), `missione`, `programma`, `macroaggregato`, `descrizione`, `impegno`, `ptari`, `pef`, `costo`, `piva`, `bilancio`, `gestione`, `netto`, `iva`, `note`
    FROM `input` `a` WHERE `a`.`report_id`=$id_report";
    mysqli_query($db, $sql);
    echo $db->error;

    //EXTRA
    $sql = "UPDATE `extra` SET `visible`=0,`valid`=0,`last_modified_id`=$id_user,`last_modified_date`=now() WHERE `report_id`=$id_report ";
    mysqli_query($db, $sql);
    echo $db->error;

    $sql = "INSERT INTO `extra`
    (`report_id`, `completed`, `user_creator_id`, `last_modified_id`, `last_modified_date`,`soggetto`, `tipologia`, `componente`, `anno`, `quant`, `prezzo`, `totale` ) SELECT
    $id_report_new, `completed`, `user_creator_id`, $id_user, now(), `soggetto`, `tipologia`, `componente`, `anno`, `quant`, `prezzo`, `totale`
    FROM `extra` `a` WHERE `a`.`report_id`=$id_report";
    mysqli_query($db, $sql);
    echo $db->error;


   // Create New Report
   /* close connection */
   mysqli_close($db);
   header("Location: ./welcome.php");

?>
