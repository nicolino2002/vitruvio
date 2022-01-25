<?php
  include("config.php");
  //Connect to MySQL Server

  // Retrieve data from Query String
  $prov = mysqli_real_escape_string($db,$_GET['prov']);
  //$prov = 'BA';

  //build query
  $sql = "SELECT DISTINCT `t`.`town` FROM `towns` `t` INNER JOIN `users` `u` ON `t`.`id`=`u`.`town_id` WHERE `t`.`prov` = '$prov' AND `u`.`visible`=1 ORDER BY `t`.`town`";

  /* Select queries return a resultset */
  if ($result = mysqli_query($db, $sql)) {
  ?>
  <label style="font-weight: bold; color: red;">Comune: 
    <select id="town" class="select" name="town" onchange="get_next(this);">
      <option value="">Please Select</option>
      <?php foreach ($result as $rs) { ?>
        <option value="<?php echo $rs["town"]; ?>"><?php echo $rs["town"]; ?></option>
      <?php } ?>
    </select>
  </label>
  <?php
  }
  /* free result set */
  mysqli_free_result($result);
?>