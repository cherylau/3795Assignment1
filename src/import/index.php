<?php
spl_autoload_register(function ($class_name) {
  include $_SERVER['DOCUMENT_ROOT'] . '/classes/' . $class_name . '.php';
});


if (isset($_POST["submit"])) {
  $file = $_FILES["fileToUpload"]["tmp_name"];
  $destination = $_SERVER['DOCUMENT_ROOT'] . '/' . basename($_FILES["fileToUpload"]["name"]);

  if (move_uploaded_file($file, $destination)) {
    echo "The file has been uploaded.";

    $insertedTransactions = Transaction::importFromCSV($destination);
    echo '<table border="1">';
    foreach ($insertedTransactions as $transaction) {
      echo '<tr>';
      foreach ($transaction as $cell) {
        echo '<td>' . htmlspecialchars($cell ?? '') . '</td>';
      }
      echo '</tr>';
    }
    echo '</table>';
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
