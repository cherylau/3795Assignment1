<?php
spl_autoload_register(function ($class_name) {
  include $_SERVER['DOCUMENT_ROOT'] . '/classes/' . $class_name . '.php';
});


if (isset($_POST["submit"])) {
  $file = $_FILES["fileToUpload"]["tmp_name"];
  $destination = $_SERVER['DOCUMENT_ROOT'] . '/' . basename($_FILES["fileToUpload"]["name"]);
  if (move_uploaded_file($file, $destination)) {
    $insertedTransactions = Transaction::importFromCSV($destination);
    header('Location: /actions/display/display.php');
    exit;
} else {
    echo "Sorry, there was an error uploading your file.";
}
}
