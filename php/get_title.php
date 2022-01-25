<?php
  include("config.php");
  //Connect to MySQL Server

  //build query
  $sql = "SELECT DISTINCT `id`,`title` FROM `titles` WHERE `valid`=1 AND `visible`=1 ORDER BY `title`";

  /* Select queries return a resultset */
  if ($result = mysqli_query($db, $sql)) {
  ?>
    <select id="new_title" class="select" name="new_title" required autofocus;>
      <option value="">Please Select</option>
      <?php foreach ($result as $rs) { ?>
        <option value="<?php echo $rs["id"]; ?>"><?php echo $rs["title"]; ?></option>
      <?php } ?>
    </select>
  <?php
  }
  /* free result set */
  mysqli_free_result($result);
?>