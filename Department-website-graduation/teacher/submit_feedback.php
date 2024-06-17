<?php
  // get the form data
  $name = $_POST["name"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $address = $_POST["address"];
  $feedback = $_POST["feedback"];
  $date = date("Y-m-d H:i:s");

  // connect to the database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "department";
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // insert the feedback data into the database
  $sql = "INSERT INTO feedback (name, email, phone, address, feedback, date)
          VALUES ('$name', '$email', '$phone', '$address', '$feedback', '$date')";
  if ($conn->query($sql) === TRUE) {
    echo "Feedback submitted successfully.";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  // close the database connection
  $conn->close();
?>
