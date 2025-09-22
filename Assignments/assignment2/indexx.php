<?php
// Generate even numbers from 1 to 50
$numbers = range(1, 50);
$evenNumbers = '<h2>Even Numbers:</h2><p>';
foreach ($numbers as $num) {
    if ($num % 2 === 0) {
        $evenNumbers .= $num . ' - ';
    }
}
$evenNumbers = rtrim($evenNumbers, ' - ') . '</p>';

// Create Bootstrap-styled form using heredoc
$form = <<<FORM
<form>
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email. Example: example@domain.com</div>
  </div>
  <div class="mb-3">
    <label for="exampleTextarea" class="form-label">Example textarea</label>
    <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
  </div>
</form>
FORM;

// Function to create Bootstrap-styled table
function createTable($rows, $columns) {
    $table = '<table class="table table-bordered">';
    for ($i = 0; $i < $rows; $i++) {
        $table .= '<tr>';
        for ($j = 0; $j < $columns; $j++) {
            $table .= '<td>Row ' . ($i + 1) . ', Col ' . ($j + 1) . '</td>';
        }
        $table .= '</tr>';
    }
    $table .= '</table>';
    return $table;
}
?>
