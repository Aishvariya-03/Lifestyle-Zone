<?php
    // Connect to your MySQL database (replace placeholders with actual values)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "life";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    session_start();
    include('./functions.php/functions.php')
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
    <link rel="stylesheet" href="style1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<section id="header">
    <a href=""><img src="logo.png" alt="">
    <div>
      <ul id="navbar">
      <li ><a href="profile.php"><i class="far fa-user"></i></a></li>
        <li ><a class="active" href="index.php">Home</a></li>
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
        <i id="bar" class="fas fa-outdent"></i>
    </div>
  </section>
<!--calling cart function -->
<?php
cart();
?>
    <section id="hero">
    <nav class="navbar navbar-expand-lg navbar-dark"><style>nav.navbar a{color:azure;font-weight:700; background-color:transparent; color:darkblue;}nav.navbar a:hover{color:blue;text-decoration:underline;}</style>
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
      <h4>Offer ON</h4>
      <h2>Super value deals</h2>
      <h1>On all products</h1>
      <button>Order Now</button>
    </section>
    <footer class="section-p1">
      <div class="col">
        <h4><strong>Contact</strong></h4>
        <h4>Address:</h4>1st Floor,Jhanvi Plaza, Vasai(E)
        <h4>Phone:</h4>7972431956
        <h4>Open:</h4>5am - 5pm
        <div class="follow">
          <h4><strong>Follow Us</strong></h4>
          <div class="icon">
            <i class="fab fa-facebook-f"></i>
            <i class="fab fa-instagram"></i>
          </div>
        </div>
      </div>

      <div class="col">
        <h4><strong>About</strong></h4>
        <a href="#">About Us</a>
        <a href="#">Delivery Information</a>
        <a href="#">Terms & Conditions</a>
        <a href="#">Contact Us</a>
      </div>
      
      <div class="col">
        <h4><strong>My Account</strong></h4>
        <a href="#">Sign In</a>
        <a href="#">View Cart</a>
      </div>

      <div class="col install">
        <h4><strong>Install App</strong></h4>
        <h6> From App Store or Google Play</6>
        <div class="row m-2">
          <img src="app.png" alt="" class="m-2">
          <img src="play.png.png" alt="" class="m-2">
        <h6 class="d-flex mt-5"><strong>Payment</strong></h6>
        <img src="card1.png" alt=""class="m-1">
        <img src="card2.png" alt=""class="m-1">
        <img src="scan.png" alt=""class="m-1">
      </div>
      
    </footer>
    <center><div class="p">
      <p>All rights reserved &copy; - Designed by LifeStyle Zone</p>
      <style>
        .p p{
          background-color:rgb(41, 82, 59);
          color:azure;
          padding:10px;
        }
      </style>
    </div></center>
  </body>
  <script src="script.js"></script>
  </body>
  </html>