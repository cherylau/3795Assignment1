<?php
if (isset($_POST["submit"])) {
  $file = $_FILES["fileToUpload"]["tmp_name"];
  $destination = $_SERVER['DOCUMENT_ROOT'] . '/' . basename($_FILES["fileToUpload"]["name"]);

  $handle = fopen($file, "r");
  if ($handle !== FALSE) {
    echo '<table border="1">';
    echo '</table>';
    fclose($handle);
  }



  if (move_uploaded_file($file, $destination)) {
    echo "The file has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
