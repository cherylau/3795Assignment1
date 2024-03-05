<?php
if (isset($_POST["submit"])) {
  $file = $_FILES["fileToUpload"]["tmp_name"];
  $destination = $_SERVER['DOCUMENT_ROOT'] . '/' . basename($_FILES["fileToUpload"]["name"]);

  $handle = fopen($file, "r");
  if ($handle !== FALSE) {
    echo '<table border="1">';
    echo '<tr><th>Date</th><th>Location</th><th>Credit</th><th>Debit</th><th>Total</th></tr>';
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      echo '<tr>';
      $num = count($data);
      for ($c = 0; $c < $num; $c++) {
        echo '<td>' . htmlspecialchars($data[$c]) . '</td>';
      }
      echo '</tr>';
    }
    echo '</table>';
    fclose($handle);
  }

  if (move_uploaded_file($file, $destination)) {
    echo "The file has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
