<?php
session_start();

// if(!isset($_SESSION["user_id"]) || $_SESSION["user_type"] != "admin") {
//   header("Location: login.php");
//   exit();
// }

// Handle file upload
if(isset($_POST["upload_file"])) {
  // Check if file was uploaded successfully
  if($_FILES["file"]["error"] === UPLOAD_ERR_OK) {
    // Validate file type and size
    $allowed_types = array("image/jpeg", "image/png", "application/pdf");
    $max_size = 100000000000000000048576; // 1 MB
    if(in_array($_FILES["file"]["type"], $allowed_types) && $_FILES["file"]["size"] <= $max_size) {
      // Move uploaded file to uploads directory
      $filename = $_FILES["file"]["name"];
      $filepath = "Notices/" . $filename;
      if(move_uploaded_file($_FILES["file"]["tmp_name"], $filepath)) {
        // Add file info to database
        $conn = mysqli_connect("localhost", "root", "", "department");
        $sql = "INSERT INTO files (filename, filepath) VALUES ('$filename', '$filepath')";
        if(mysqli_query($conn, $sql)) {
          header("Location: add_notice.php");
          exit();
        } else {
          $error_message = "Error adding file to database.";
        }
        mysqli_close($conn);
      } else {
        $error_message = "Error uploading file.";
      }
    } else {
      $error_message = "Invalid file type or size. Only JPG, PNG, and PDF files up to 1 MB are allowed.";
    }
  } else {
    $error_message = "Error uploading file.";
  }
}

// Delete file if "Delete" button was clicked
if(isset($_POST["delete_file"])) {
  $id = $_POST["id"];
  $conn = mysqli_connect("localhost", "root", "", "department");
  $sql = "SELECT * FROM files WHERE id = '$id'";
  $result = mysqli_query($conn, $sql);
  $file = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  if(unlink($file["filepath"])) {
    $sql = "DELETE FROM files WHERE id = '$id'";
    if(mysqli_query($conn, $sql)) {
      header("Location: admin.php");
      exit();
    } else {
      $error_message = "Error deleting file from database.";
    }
  } else {
    $error_message = "Error deleting file from server.";
  }
  mysqli_close($conn);
}

// Fetch list of files from database
$conn = mysqli_connect("localhost", "root", "", "department");
$sql = "SELECT * FROM files";
$result = mysqli_query($conn, $sql);
$files = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>
  <style>      * {
              box-sizing: border-box;
              margin: 0;
              padding: 0;
          }

          body {
              font-family: Arial, sans-serif;
              background-color: #f1f1f1;
          }

          /* Sidebar */
          .sidebar {
              position: fixed;
              top: 0;
              left: 0;
              height: 100%;
              width: 250px;
              background-color: #111;
              padding: 30px 0;
          }

          .sidebar h2 {
              color: #fff;
              text-align: center;
              margin-bottom: 30px;
          }

          .sidebar a {
              display: block;
              padding: 15px 30px;
font-size: 1.1rem;
color: #fff;
text-decoration: none;
transition: 0.3s;
}

.sidebar a:hover {
background-color: #fff;
color: #111;
}

.sidebar a i {
margin-right: 10px;
}

.sidebar span {
margin-left: 10px;
}

/* Main Content */
.main-content {
margin-left: 250px;
padding: 20px;
}

header {
background-color: #fff;
padding: 10px;
display: flex;
justify-content: space-between;
align-items: center;
}

header h2 {
color: #111;
font-size: 1.5rem;
}

.user-wrapper {
display: flex;
align-items: center;
}

.user-wrapper h4 {
color: #111;
margin-right: 10px;
}

.user-wrapper small {
color: #999;
}

main {
padding: 20px;
}

.cards {
display: flex;
flex-wrap: wrap;
}

.card {
background-color: #fff;
box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
border-radius: 5px;
padding: 30px;
margin: 20px;
flex-basis: calc(33.33% - 40px);
}

.card i {
font-size: 2rem;
color: #111;
margin-bottom: 20px;
}

.card h3 {
color: #111;
font-size: 1.5rem;
margin-bottom: 10px;
}

.card span {
color: #999;
font-size: 1.2rem;
}

/* Navigation Toggle */
.nav-toggle {
position: absolute;
top: 30px;
right: 30px;
display: none;
z-index: 999;
}

.nav-toggle span {
display: block;
width: 30px;
height: 2px;
background-color: #111;
margin-bottom: 5px;
position: relative;
}

.nav-toggle span:before,
.nav-toggle span:after {
content: '';
position: absolute;
width: 30px;
height: 2px;
background-color: #111;
}

.nav-toggle span:before {
top: -10px;
}

.nav-toggle span:after {
bottom: -10px;
}

@media (max-width: 800px) {
.sidebar {
padding-top: 60px;
height: 100%;
width: 100%;
position: absolute;
top: 0;
left: -100%;
opacity: 0.9;
transition: 0.5s;
}.sidebar a {
	text-align: center;
	padding: 10px;
	width: 100%;
	display: table;
}

.sidebar a i {
	margin-right: 0;
}

.sidebar span {
	display: none;
}

.sidebar a:hover {
	background-color: transparent;
	color: #fff;
}

.main-content {
	margin-left: 0;
}

nav {
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	background-color: #111;
	padding: 10px 20px;
	display: flex;
	justify-content: space-between;
	align-items: center;
	z-index: 999;
}

nav h2 {
	color: #fff;
	font-size: 1.5rem;
}

nav .nav-toggle {
	display: block;
}

.main-content header {
	padding-top: 70px;
}

.sidebar.active {
	left:0;
opacity: 1;
}
/* Responsive cards */
.cards {
	flex-direction: column;
}

.card {
	flex-basis: 100%;
	margin: 20px 0;
}
}

/* Responsive Tables */
table {
border-collapse: collapse;
width: 100%;
margin-bottom: 20px;
}

table thead th {
background-color: #111;
color: #fff;
padding: 10px;
text-align: left;
}

table tbody td {
border: 1px solid #ddd;
padding: 10px;
}

@media (max-width: 800px) {
table {
display: block;
overflow-x: auto;
}
}

/* Forms */
form {
background-color: #eee;
border-radius: 5px;
box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
padding: 30px;
margin: 20px 0;
}

form label {
display: block;
font-size: 1.2rem;
margin-bottom: 10px;
}

form input[type="text"],
form input[type="email"],
form select,
form textarea {
padding: 10px;
border-radius: 5px;
border: 1px solid #ccc;
margin-bottom: 20px;
width: 100%;
font-size: 1.1rem;
}

form input[type="submit"] {
background-color: #111;
padding: 10px 30px;
border: none;
border-radius: 5px;
color: #fff;
font-size: 1.1rem;
cursor: pointer;
}

form input[type="submit"]:hover {
background-color: #222;
}

/* Error messages */
.error {
background-color: #ffdddd;
color: #dd0000;
padding: 10px;
margin-bottom: 20px;
border-radius: 5px;
}

/* Success messages */
.success {
background-color: #ddffdd;
color: #008000;
padding: 10px;
margin-bottom: 20px;
border-radius: 5px;
}

/* Responsive Images */
img {
max-width: 100%;
height: auto;
}

@media (max-width: 800px) {
img {
display: block;
margin: 0 auto;
}
}

/* Responsive Videos */
video {
max-width: 100%;
height: auto;
}

@media (max-width: 800px) {
video {
display: block;
margin: 0 auto;
}
}
</style>
</head>
<body>

 <!-- Sidebar -->
    <div class="sidebar">
      <h2>Dashboard</h2>
      <a href="index.php"></i><span>Home</span></a>
      <a href="add_notice.php"><i class=></i><span>Notice</span></a>
      <a href="feed.php"></i><span>Feedbacks</span></a>
      <a href="login.php"></i><span>Logout</span></a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <header>
        <h2>
          <label for="nav-toggle">
            <span class="fas fa-bars"></span>
          </label>
          Dashboard
        </h2>

        
  <?php
  if(isset($error_message)) {
    echo "<p>$error_message</p>";
  }
  ?>
  </header>
  <form method="post" enctype="multipart/form-data">
    <input type="file" name="file" required><br><br><br>
    <input type="submit" name="upload_file" value="Upload File">
  </form>
  <h2>Files</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>File Name</th>
      <th>Actions</th>
    </tr>
    <?php foreach($files as $file): ?>
      <tr>
        <td><?php echo $file["id"]; ?></td>
        <td><?php echo $file["filename"]; ?></td>
        <td>
          <form method="post">
            <input type="hidden" name="id" value="<?php echo $file["id"]; ?>">
            <input type="submit" name="delete_file" value="Delete">
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>

