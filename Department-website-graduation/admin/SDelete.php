<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $filename = $_POST["filename"];
  $filepath = "teachers/" . $filename;
  if (file_exists($filepath)) {
    unlink($filepath);
    header("Location: Staffupload.php");
  }
}
?>
