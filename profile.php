<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "life";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

include('./functions.php/functions.php');
session_start();

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeStyle Zone</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        @import url('http://fonts.googleapis.com/css2?family=Spartan:wght@100;200;300;400;500;600;700;800;900&display=swap');

        body {
            font-family: 'Spartan', sans-serif;
            margin: 0;
            padding: 0;
        }
        </style>
</head>
<body>
  <section id="header">
    <a href=""><img src="logo.png" alt="">
    <div>
      <ul id="navbar">
      <li ><a class ="active" href="profile.php"><i class="far fa-user"></i></a></li>
        <li ><a href="index.php">Home</a></li>
        <li ><a href="product.php">Product</a></li>
        <li><a href="viewplan.php">Plans</a></li>
        <li ><a href="Workout.html">Sessions</a></li>
        <li ><a href="contact.html">Contact</a></li>
        <li id="lg-bag"><a href="cart.php"><i class="fa-solid fa-cart-plus"></i><sup><?php cart_item();?></sup></a></li>
        <li ><a href="#">Total: <?php total();?> /-</a></li>
        <li><a href="login.html"><i class="fa fa-sign-out"></i></a></li>
        <a href="#" id="close"><i class="far fa-times"></i></a>
      </ul>
    </div>
    <div id="mobile">
        <a href="profile.php"><i class="far fa-user"></i></a>
        <a href="cart.php"><i class="far fa-cart-plus"></i></a>
        <li><a href="login.html"><i class="fa fa-sign-out"></i></a></li>
        <i id="bar" class="fas fa-outdent"></i>
    </div>
  </section>
  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary"><style>nav.navbar a{color:azure;font-weight:700;}</style>
    <ul class="navbar-nav me-auto">
    <?php
            if(!isset($_SESSION['username']))
            {
                echo "<li class='nav-item'>
                    <a href='#' class='nav-link'>Welcome Guest</a>
                </li>";
            }
            else
            {
                echo "<li class='nav-item'>
                    <a href='#' class='nav-link'>Wecome ".$_SESSION['username']."</a>
                </li>";
            }
        ?>
        <?php
            if(!isset($_SESSION['username']))
            {
                echo "<li class='nav-item'>
                    <a href='user.php' class='nav-link'>Login</a>
                </li>";
            }
            else
            {
                echo "<li class='nav-item'>
                    <a href='logout.php' class='nav-link'>Logout</a>
                </li>";
            }
        ?>
    </ul>
</nav>


<div class="row m-auto mt-3">
    <div class="col-md-2">
        <ul class="navbar-nav bg-secondary text-center" style="height:auto">
            <li class="nav-item bg-info">
                <a href="#" class="nav-link text-light"><h4>My Profile</h4></a>
            </li>
            <li class="nav-item">
                <a href="profile.php" class="nav-link text-light">Pending Orders</a>
            </li>
            <li class="nav-item">
                <a href="profile.php?edit_profile" class="nav-link text-light">Edit Profile</a>
            </li>
            <li class="nav-item">
                <a href="profile.php?my_orders" class="nav-link text-light">My Orders</a>
            </li>
            <li class="nav-item">
                <a href="profile.php?delete_account" class="nav-link text-light">Delete Account</a>
            </li>
            <li class="nav-item">
                <a href="logout.php" class="nav-link text-light">Logout</a>
            </li>
        </ul>
    </div>
    <div class="col-md-10">
        <?php
            get_user_order_details();

            if(isset($_GET['edit_profile']))
            {
                include('edit_profile.php');
            }
            if(isset($_GET['my_orders']))
            {
                include('my_orders.php');
            }
            if(isset($_GET['delete_account']))
            {
                include('delete_account.php');
            }
            if(isset($_GET['delivery']))
            {
                include('delivery.php');
            }
            
        ?>
    </div>
</div>
</body>
</html>
