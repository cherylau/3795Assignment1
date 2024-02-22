<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>


  <form action="import/index.php" method="post" enctype="multipart/form-data">
    Select CSV File to Upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload File" name="submit">
  </form>



  <?php
  // include './import/index.php';
  // include './read/index.php';


  ?>


</body>

</html>