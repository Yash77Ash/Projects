<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Check for idle timeout (30 minutes)
$idle_timeout = 30 * 60; // 30 minutes in seconds
if (isset($_SESSION["last_activity"]) && (time() - $_SESSION["last_activity"] > $idle_timeout)) {
    session_unset();
    session_destroy();
    header("Location: login.php?timeout=1");
    exit();
}

// Update the last activity time stamp
$_SESSION["last_activity"] = time();

// Retrieve the user information from the session variable
$user_id = $_SESSION["user_id"];

// Connect to MySQL database
$mysqli = new mysqli("localhost", "root", "", "department");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Query the database to retrieve user information
$stmt = $mysqli->prepare("SELECT * FROM adminlogin WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
}

?>




<!DOCTYPE html>
<html>
<head>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<link href="/your-path-to-uicons/css/uicons-[your-style].css" rel="stylesheet"> <!--load all styles -->
  <title>Upload Images</title>
  <style> 
      * {
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
@media only screen and (max-width: 600px) {
  table {
    font-size: 12px;
  }
  th, td {
    width: 50%;
  }
  img {
    width: 100%;
    height: auto;
  }
}
.table-responsive {
  overflow-x: auto;
}


tbody {
  /* display: block; */
  width: 100%;
}
tr {
  
  flex-wrap: wrap;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid #ccc;
}
th,
td {
  padding: 1rem;
  text-align: left;
  width: 33.3333%;
  flex-basis: 33.3333%;
  box-sizing: border-box;
}
img {
  max-width: 100%;
  height: auto;
  display: block;
  margin: 0 auto;
}
button {
  margin-top: 1rem;
}table {
  width: 70%;
  margin: 0 auto;
}

@media screen and (min-width: 768px) {
  table {
    
    width: 30%;
  }
}



    </style>
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
        <div class="user-wrapper">
        
        <b><p>Welcome, <?php echo $user['username']; ?>!</p></b>
 
        </div>
      </header>
</div>
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Address</th>
      <th>Feedback</th>
      <th>Date</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // Connect to MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "department";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    // Query to fetch feedback data from the "feedback" table
    $sql = "SELECT * FROM feedback ORDER BY date DESC";
    $result = mysqli_query($conn, $sql);

    // Check if there are any feedback entries
    if (mysqli_num_rows($result) > 0) {
      // Output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["name"]."</td>";
        echo "<td>".$row["email"]."</td>";
        echo "<td>".$row["phone"]."</td>";
        echo "<td>".$row["address"]."</td>";
        echo "<td>".$row["feedback"]."</td>";
        echo "<td>".$row["date"]."</td>";
        echo "<td><a href='delete_feedback.php?id=".$row["id"]."'>Delete</a></td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='8'>No feedback entries found.</td></tr>";
    }

    // Close MySQL connection
    mysqli_close($conn);
    ?>
  </tbody>
</table>

</body>
</html>
