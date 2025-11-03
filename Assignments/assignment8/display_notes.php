<?php
require_once 'classes/Date_time.php';
$dt = new Date_time();
$notes = $dt->checkSubmit();
?>

<form method="post">
  <label for="begDate">Beginning Date</label>
  <input type="date" class="form-control" id="begDate" name="begDate">
  
  <label for="endDate">Ending Date</label>
  <input type="date" class="form-control" id="endDate" name="endDate">
  
  <button type="submit" name="getNotes" class="btn btn-primary">Get Notes</button>
</form>

<div>
  <?= $notes ?>
</div>
