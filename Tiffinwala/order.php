<?php
include("connection.php");

// Sanitize and validate input
$cust_id = isset($_GET['cust_id']) ? mysqli_real_escape_string($con, $_GET['cust_id']) : '';

if (!empty($cust_id)) {
    $query = mysqli_query($con, "SELECT food.food_id, food.foodname, food.mess_id, food.cost, food.image, cart.cart_id, cart.product_id, cart.customer_id FROM food INNER JOIN cart ON food.food_id=cart.product_id WHERE cart.customer_id='$cust_id'");
    $re = mysqli_num_rows($query);

    while ($row = mysqli_fetch_array($query)) {
        echo "<br>";
        $cart_id = $row['cart_id'];
        $ven_id = $row['mess_id'];
        $food_id = $row['food_id'];
        $cost = $row['cost'];
        $paid = "In Process";

        // Use backticks for reserved keyword 'order'
        if (mysqli_query($con, "INSERT INTO `order` (cart_id, mess_id, food_id, email_id, payment, status) VALUES ('$cart_id', '$ven_id', '$food_id', '$cust_id', '$cost', '$paid')")) {
            if (mysqli_query($con, "DELETE FROM cart WHERE cart_id='$cart_id'")) {
                header("location:customerupdate.php");
                exit; // Exit after redirection
            }
        } else {
            echo "Failed to insert order.";
        }
    }
} else {
    echo "Customer ID is empty.";
}
?>
