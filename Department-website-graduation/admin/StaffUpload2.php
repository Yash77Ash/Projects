
<?php
// Retrieve the uploaded files and other form data
$teacher_photo = $_FILES["teacher_photo"]["name"];
$teacher_name = $_POST["teacher_name"];
$teacher_subject = $_POST["teacher_subject"];
$teacher_file = $_FILES["teacher_file"]["name"];

// Upload the files to a directory on the server (optional)

// Connect to the MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "department";

$conn = new mysqli($servername, $username, $password, $dbname);

// Insert the teacher info into the database
// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO teachersinfo  (teacher_photo, teacher_name, teacher_subject, teacher_file) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $teacher_photo, $teacher_name, $teacher_subject, $teacher_file);

// Upload the files to a directory on the server (optional)
$target_dir = "teachers/";
$target_file1 = $target_dir . basename($_FILES["teacher_photo"]["name"]);
$target_file2 = $target_dir . basename($_FILES["teacher_file"]["name"]);
move_uploaded_file($_FILES["teacher_photo"]["tmp_name"], $target_file1);
move_uploaded_file($_FILES["teacher_file"]["tmp_name"], $target_file2);

// Execute the SQL statement and redirect to the teacher info page
if ($stmt->execute()) {
header("Location: Staffupload.php");
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>


?>