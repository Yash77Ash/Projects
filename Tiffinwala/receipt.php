<?php
// Start the session
session_start();

// Check if the session variables are set
if(isset($_SESSION['customer_name']) && isset($_SESSION['customer_email']) && isset($_SESSION['total_amount'])) {
    // Retrieve session variables
    $customerName = $_SESSION['customer_name'];
    $customerEmail = $_SESSION['customer_email'];
    $totalAmount = $_SESSION['total_amount'];
} else {
    // If session variables are not set, redirect back to the payment page
    header("Location: payment.php");
    exit(); // Ensure that script execution stops after redirecting
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        /* Add your custom styles here */
        .container {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Receipt</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <p><strong>Customer Name:</strong> <?php echo $customerName; ?></p>
                        <p><strong>Email:</strong> <?php echo $customerEmail; ?></p>
                        <p><strong>Total Amount:</strong> ₹<?php echo $totalAmount; ?></p>
                        <p>Thank you for your purchase!</p>
                        <!-- Add any additional receipt details here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
