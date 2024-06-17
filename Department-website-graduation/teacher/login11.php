<?php
session_start();

// Connect to MySQL database
$mysqli = new mysqli("localhost", "root", "", "department");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query the database to check if the user exists
    $stmt = $mysqli->prepare("SELECT * FROM adminlogin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User exists, store user information in session variable
        $user = $result->fetch_assoc();
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_username"] = $user["username"];

        // Redirect to dashboard page
        header("Location: index.php");
        exit();
    } else {
        // User does not exist, display error message
        $error = "Invalid username or password.";
    }
}
?>
