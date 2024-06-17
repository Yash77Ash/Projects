<?php
// Start the session
session_start();

// Include your connection file
include("connection.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming $customerName and $customerEmail are set somewhere in your code
    $customerName = $_SESSION['customer_name'];
    $customerEmail = $_SESSION['customer_email'];
    $totalAmount = $_SESSION['total_amount'];

    // Perform payment processing logic here

    // No need to redirect here, just return a response indicating success
    echo "Payment processed successfully.";
} else {
    // If the form is not submitted via POST method, return an error response
    echo "Form submission failed.";
}
?>
