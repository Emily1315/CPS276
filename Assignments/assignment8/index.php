<?php
require_once 'classes/Date_time.php';
$dt = new Date_time();
$notes = $dt->checkSubmit();
?>

<form method="post">
  <label for="dateTime">Date and Time</label>
  <input type="datetime-local" class="form-control" id="dateTime" name="dateTime">
  
  <label for="note">Note</label>
  <textarea class="form-control" id="note" name="note"></textarea>
  
  <button type="submit" name="addNote" class="btn btn-primary">Add Note</button>
</form>

<div>
  <?= $notes ?>
</div>
