<?php

include($_SERVER['DOCUMENT_ROOT'] . "/inc_header.php");


?>


<form action="import/index.php" method="post" enctype="multipart/form-data">
  Select CSV File to Upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload File" name="submit">
</form>

<button onclick="window.location.href='actions/display/display.php'">Display</button>
<button onclick="window.location.href='actions/register/register.php'">Register</button>
<button onclick="window.location.href='actions/login/login.php'">Login</button>





<?php
include($_SERVER['DOCUMENT_ROOT'] . "/inc_footer.php");

?>