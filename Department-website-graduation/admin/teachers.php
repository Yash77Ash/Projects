<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Check if the logout button was clicked
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}

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
</head>
<body>
    <h1>Admin Page</h1>
    <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
    <form action="admin.php" method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
    <h2>Add Teacher</h2>
    <form action="admin.php" method="post">
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
                    <form action="admin.php" method="post">
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
