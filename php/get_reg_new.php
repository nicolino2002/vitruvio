<?php
  include("config.php");
  //Connect to MySQL Server

  //build query
  $sql = "SELECT DISTINCT `t`.`reg` FROM `towns` `t` WHERE `t`.`visible`=1 ORDER BY `t`.`reg`";

  /* Select queries return a resultset */
  if ($result = mysqli_query($db, $sql)) {
  ?>
    <select id="reg" class="select" name="reg" onchange="get_prov(this);" required autofocus;>
      <option value="">Please Select</option>
      <?php foreach ($result as $rs) { ?>
        <option value="<?php echo $rs["reg"]; ?>"><?php echo $rs["reg"]; ?></option>
      <?php } ?>
    </select>
  <?php
  }
  /* free result set */
  mysqli_free_result($result);
?>