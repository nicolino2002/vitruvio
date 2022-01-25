<?php
  include("config.php");
  //Connect to MySQL Server

  // Retrieve data from Query String
  $reg = mysqli_real_escape_string($db,$_GET['reg']);
  //$reg = 'PUGLIA';

  //build query
  $sql = "SELECT DISTINCT `t`.`prov` FROM `users` `u` INNER JOIN `towns` `t` ON `u`.`town_id`=`t`.`id` WHERE `t`.`reg` = '$reg' AND `u`.`visible`=1 ORDER BY `t`.`prov`";

  /* Select queries return a resultset */
  if ($result = mysqli_query($db, $sql)) {
  ?>
  <label style="font-weight: bold; color: red;">Provincia: 
    <select id="prov" class="select" name="prov" onchange="get_town(this);">
      <option value="">Please Select</option>
      <?php foreach ($result as $rs) { ?>
        <option value="<?php echo $rs["prov"]; ?>"><?php echo $rs["prov"]; ?></option>
      <?php } ?>
    </select>
  </label>
  <?php
  }
  /* free result set */
  mysqli_free_result($result);
?>