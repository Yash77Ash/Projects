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
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
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

table {
  width: 100%;
  border-collapse: collapse;
  margin: 20px 0;
}

th {
  background-color: #4CAF50;
  color: white;
  font-weight: bold;
}

td, th {
  padding: 8px;
  text-align: left;
  border: 1px solid #ddd;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

@media screen and (max-width: 600px) {
  table {
    border: 0;
  }

  table caption {
    font-size: 1.3em;
  }

  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }

  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }

  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }

  table td::before {
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }

  table td:last-child {
    border-bottom: 0;
  }
}

</style>


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
        <div class="user-wrapper">
        
        <b><p>Welcome, <?php echo $user['username']; ?>!</p></b>
        
            
            
         
        </div>
      </header>
      <main>
        <div class="cards">
          <div class="card">
            <i class="fas fa-users"></i>
            <div>
              <h3>Total Users</h3>
              <span>50</span>
            </div>
          </div>
          <div class="card">
            <i class="fas fa-file-alt"></i>
            <div>
              <h3>Total Pages</h3>
              <span>20</span>
            </div>
          </div>
          <div class="card">
            <i class="fas fa-comments"></i>
            <div>
              <h3>Total Comments</h3>
              <span>100</span>
            </div>
          </div>
          
        </div>
      </main>
    </div>

    <!-- Navigation Toggle -->
    <input type="checkbox" id="nav-toggle" hidden />
    <label for="nav-toggle" class="nav-toggle">
      <span></span>
    </label>

    <script src="script.js"></script>
  </body>

</html>
