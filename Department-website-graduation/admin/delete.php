<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $filename = $_POST["filename"];
  $filepath = "uploads/" . $filename;
  if (file_exists($filepath)) {
    unlink($filepath);
    header("Location: Add_gallery.php");
  }
}
?>
