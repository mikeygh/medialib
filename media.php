<!DOCTYPE html>
<html>
  <head>
    <title>Simple Media Library</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="media.css">
    <!-- <script src="media.js"></script> -->
  </head>
  <body>
    <?php
    // (A) ADD/UPDATE/DELETE TASK IF FORM SUBMITTED
    require "media-lib.php";
    if (isset($_POST["action"])) {
      // (A1) SAVE TASK
      if ($_POST["action"]=="save") {
        $pass = $TODO->save($_POST["name"], $_POST["type"], (isset($_POST["id"])?$_POST["id"]:null));
      }

      // (A2) DELETE TASK
      else { $pass = $TODO->del($_POST["id"]); }

      // (A3) SHOW RESULT
      echo "<div class='notify'>";
      echo $pass ? "OK" : $TODO->error ;
      echo "</div>";
    }
    ?>

    <!-- (B) NINJA DELETE FORM -->
    <form id="ninForm" method="post">
      <input type="hidden" name="action" value="del">
      <input type="hidden" name="id" id="ninID">
    </form>

    <div id="tasks">
      <!-- (C) ADD NEW TASK -->
      <form method="post">
        <input type="hidden" name="action" value="save">
        <input type="text" id="taskadd" name="task" placeholder="Task" required>
        <select name="status">
          <option value="0">Pending</option>
          <option value="1">Done</option>
          <option value="2">Canceled</option>
        </select>
        <input type="submit" value="Add">
      </form>

      <!-- (D) LIST TASKS -->
      <?php
      $tasks = $TODO->getAll();
      if (count($tasks)!=0) { foreach ($tasks as $t) { ?>
      <form method="post">
        <!-- <input type="button" value="X" onclick="deltask(<?=$t["todo_id"]?>)"> -->
        <input type="hidden" name="action" value="save">
        <input type="hidden" name="id" value="<?=$t["todo_id"]?>">
        <input type="text" name="name" placeholder="Name" value="<?=$t["media_title"]?>">
        <select name="type">
          <option value="0"<?=$t["media_type"]==0?" selected":""?>>DVD</option>
          <option value="1"<?=$t["media_type"]==1?" selected":""?>>Nintendo Switch</option>
          <option value="2"<?=$t["media_type"]==2?" selected":""?>>Playstation 5</option>
          <option value="3"<?=$t["media_type"]==3?" selected":""?>>Blu-Ray</option>

        </select>
        <input type="submit" value="Save">
      </form>
      <?php }} ?>
    </div>
  </body>
</html>