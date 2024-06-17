<?php
session_start();

// Check if the user is logged in
// if (!isset($_SESSION['username'])) {
//     header('Location: index.php');
//     exit();
// }

// Check if the logout button was clicked
// if (isset($_POST['logout'])) {
//     session_destroy();
//     header('Location: login.html');
//     exit();
// }

// Check if the add teacher form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add-teacher'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = mysqli_connect('localhost', 'root', '', 'department');
    $query = "INSERT INTO teacher (username, password) VALUES ('$username', '$password')";
    mysqli_query($conn, $query);
}

// Check if the remove teacher form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove-teacher'])) {
    $id = $_POST['id'];

    $conn = mysqli_connect('localhost', 'root', '', 'department');
    $query = "DELETE FROM teacher WHERE id=$id";
    mysqli_query($conn, $query);
}

// Get the list of teachers from the database
$conn = mysqli_connect('localhost', 'root', '', 'department');
$query = "SELECT *FROM teacher";
$result = mysqli_query($conn, $query);
$teachers = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Page</title>
    <style>* {
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
form input[type="password"],
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
/* .button {
  background-color: #000; 
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
} */

</style>
</head>
<body>
     <!-- Sidebar -->
     <div class="sidebar">
      <h2>Dashboard</h2>
      <a href="index.php"></i><span>Home</span></a>
      <a href="Staffupload.php"></i><span>Staff</span></a>     
      <a href="adduser.php"></i><span>User Mange</span></a>
      <a href="Add_gallery.php"></i><span>Gallery</span></a>
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
</header>
    <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
    <form action="admin.php" method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
    <h2>Add Teacher</h2>
    <form action="adduser.php" method="post">
        <label>Username:</label>
        <input type="text" name="username">
        <label>Password:</label>
        <input type="password" name="password">
        <button type="submit" name="add-teacher">Add Teacher</button>
    </form>
    <h2>Teachers</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teachers as $teacher): ?>
            <tr>
                <td><?php echo $teacher['id']; ?></td>
                <td><?php echo $teacher['username']; ?></td>
                <td><?php echo $teacher['password']; ?></td>
                <td>
                    <form action="adduser.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $teacher['id']; ?>">
                        <button type="submit" name="remove-teacher">Remove</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
