<?php
session_start();

// Check if product ID and price are set
if(isset($_POST['pro_id']) && isset($_POST['price'])) {
    // Get product ID and price from the form
    $pro_id = $_POST['pro_id'];
    $price = $_POST['price'];

    // Initialize the cart session variable if it's not already set
    if(!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Check if the product is already in the cart
    if(isset($_SESSION['cart'][$pro_id]) && is_array($_SESSION['cart'][$pro_id])) {
        // If the product is already in the cart, increment the quantity
        $_SESSION['cart'][$pro_id]['quantity'] = isset($_SESSION['cart'][$pro_id]['quantity']) ? $_SESSION['cart'][$pro_id]['quantity'] + 1 : 1;
        $_SESSION['cart'][$pro_id]['total'] = isset($_SESSION['cart'][$pro_id]['total']) ? $_SESSION['cart'][$pro_id]['total'] + $price : $price; // Add price to total
    } else {
        // If the product is not in the cart, add it with quantity 1
        $_SESSION['cart'][$pro_id] = array(
            'quantity' => 1,
            'total' => $price // Initialize total with the price of the product
        );
    }

    // Redirect to the cart page
    header('Location: cart.php');
    exit;
} else {
    // Redirect back to the previous page if product ID or price is not set
    if(isset($_SERVER['HTTP_REFERER'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        header('Location: product1.php'); // Redirect to the product page if referrer is undefined
    }
    exit;
}
?>
