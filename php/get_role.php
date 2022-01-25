<?php
  include("config.php");
  //Connect to MySQL Server

  //build query
  $sql = "SELECT DISTINCT `id`,`role` FROM `roles` WHERE `valid`=1 AND `visible`=1 ORDER BY `role`";

  /* Select queries return a resultset */
  if ($result = mysqli_query($db, $sql)) {
  ?>
    <select id="role" class="select" name="role" onchange="get_next(this);" required autofocus;>
      <option value="">Please Select</option>
      <?php foreach ($result as $rs) { ?>
        <option value="<?php echo $rs["id"]; ?>"><?php echo $rs["role"]; ?></option>
      <?php } ?>
    </select>
  <?php
  }
  /* free result set */
  mysqli_free_result($result);
?>