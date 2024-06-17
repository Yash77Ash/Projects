<?php
// Start the session
session_start();

// Include your connection file
include("connection.php");

// Check if the total amount is passed as a query parameter
if(isset($_GET['total'])) {
    $totalAmount = $_GET['total'];

    // You can use $totalAmount to display the total amount to the user
} else {
    // If total amount is not passed, handle the error or redirect back to the cart page
    header("Location: cart.php");
    exit(); // Ensure that script execution stops after redirecting
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Processing</title>
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
    <h2 class="text-center">Payment Processing</h2>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <p class="card-text">Total Amount: ₹<?php echo $totalAmount; ?></p>
            <!-- Payment form -->
            <form id="paymentForm">

              <div class="form-group">
                <label for="cardNumber">Card Number</label>
                <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="Enter card number" required>
              </div>
              <div class="form-group">
                <label for="expDate">Expiration Date</label>
                <input type="text" class="form-control" id="expDate" name="expDate" placeholder="MM/YY" required>
              </div>
              <div class="form-group">
                <label for="cvv" >CVV</label>
                <input type="text" class="form-control" id="cvv" name="cvv" placeholder="CVV" required>
              </div>
              <button type="button" id="payNowBtn" class="btn btn-primary">Pay Now</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS (optional) -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <!-- JavaScript for handling form submission -->
  <script>
    document.getElementById('payNowBtn').addEventListener('click', function() {
      var form = document.getElementById('paymentForm');
      var formData = new FormData(form);

      fetch('payment_process.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.text())
      .then(data => {
        // Redirect to receipt page
        window.location.href = 'receipt.php';
      })
      .catch(error => {
        console.error('Error:', error);
      });
    });
  </script>
</body>
</html>
