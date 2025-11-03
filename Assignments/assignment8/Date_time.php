<?php
require_once __DIR__ . '/Db_conn.php';

class Date_time {
  private $pdo;

  public function __construct() {
    $db = new DatabaseConn();
    $this->pdo = $db->dbOpen();
  }

  public function checkSubmit() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['addNote'])) {
        $message = $this->addNote();
        return $message . $this->getAllNotes(); // show notes after adding
      } elseif (isset($_POST['getNotes'])) {
        return $this->getNotes();
      }
    }
    return $this->getAllNotes(); // show notes by default
  }

  private function addNote() {
    $dateTime = $_POST['dateTime'] ?? '';
    $note = trim($_POST['note'] ?? '');

    if (empty($dateTime) || empty($note)) {
      return '<div class="alert alert-danger">You must enter a date, time, and note.</div>';
    }

    $timestamp = strtotime($dateTime);
    $sql = "INSERT INTO note (date_time, note) VALUES (:date_time, :note)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':date_time' => $timestamp, ':note' => $note]);

    return '<div class="alert alert-success">Note added successfully.</div>';
  }

  private function getNotes() {
    $begDate = $_POST['begDate'] ?? '';
    $endDate = $_POST['endDate'] ?? '';

    if (empty($begDate) || empty($endDate)) {
      return '<div class="alert alert-danger">No notes found for the date range selected.</div>';
    }

    $begTimestamp = strtotime($begDate . ' 00:00:00');
    $endTimestamp = strtotime($endDate . ' 23:59:59');

    $sql = "SELECT date_time, note FROM note WHERE date_time BETWEEN :begDate AND :endDate ORDER BY date_time DESC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([':begDate' => $begTimestamp, ':endDate' => $endTimestamp]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$results) {
      return '<div class="alert alert-info">No notes found for the date range selected.</div>';
    }

    $output = '<table class="table table-bordered"><thead><tr><th>Date & Time</th><th>Note</th></tr></thead><tbody>';
    foreach ($results as $row) {
      $formattedDate = date('m/d/Y h:i A', $row['date_time']);
      $output .= "<tr><td>{$formattedDate}</td><td>{$row['note']}</td></tr>";
    }
    $output .= '</tbody></table>';
    return $output;
  }

  private function getAllNotes() {
    $sql = "SELECT date_time, note FROM note ORDER BY date_time DESC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$results) {
      return '<div class="alert alert-info">No notes found.</div>';
    }

    $output = '<table class="table table-bordered"><thead><tr><th>Date & Time</th><th>Note</th></tr></thead><tbody>';
    foreach ($results as $row) {
      $formattedDate = date('m/d/Y h:i A', $row['date_time']);
      $output .= "<tr><td>{$formattedDate}</td><td>{$row['note']}</td></tr>";
    }
    $output .= '</tbody></table>';
    return $output;
  }
}
