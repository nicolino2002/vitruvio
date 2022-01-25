<?php
  include("config.php");
  //Connect to MySQL Server

  // Retrieve data from Query String
  $town = mysqli_real_escape_string($db,$_GET['town']);

  //build query
  $sql = "SELECT `u`.`id`,`u`.`email` FROM `users` `u` INNER JOIN `towns` `t` ON `u`.`town_id`=`t`.`id` WHERE `t`.`town`= '$town' AND `u`.`del`=0 AND `u`.`valid` = 1 AND `u`.`visible` = 1;";

  /* Select queries return a resultset */
  if ($result = mysqli_query($db, $sql)) {
  ?>
    <select id="del_users" class="select" name="del_users" onchange="get_del_user(this);" required autofocus;>
      <option value="">Please Select</option>
      <?php foreach ($result as $rs) { ?>
        <option value="<?php echo $rs["id"]; ?>"><?php echo $rs["email"]; ?></option>
      <?php } ?>
    </select>
  <?php
  }
  /* free result set */
  mysqli_free_result($result);
?>