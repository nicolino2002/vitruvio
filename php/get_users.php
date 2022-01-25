<?php
  include("config.php");
  //Connect to MySQL Server

  // Retrieve data from Query String
  $town = mysqli_real_escape_string($db,$_POST['town']);

  //build query
  $sql = "SELECT count(`u`.`id`) `usersbytown` FROM `users` `u` INNER JOIN `towns` `t` ON `u`.`town_id`=`t`.`id` WHERE `t`.`town`= '$town' AND `u`.`valid`=1 AND `u`.`visible`=1;";

  /* Select queries return a resultset */
  if ($result = mysqli_query($db, $sql)) {

    foreach ($result as $rs) {
      ?>
        <a id="usersbytown" type="text" name="usersbytown" style="font-weight: bold; color: #044A92;" value="<?php echo $rs["usersbytown"]; ?>"><?php echo $rs["usersbytown"]; ?></a>
      <?php 
    }
  }
  /* free result set */
  mysqli_free_result($result);
?>