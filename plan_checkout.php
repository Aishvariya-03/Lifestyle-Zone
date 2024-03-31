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
    include('./functions.php/functions.php');

    session_start();

    //to access user id
    $user_ip=getClientIP();
    $get_user = "SELECT * FROM `user` WHERE user_ip = '$user_ip'";
    $result = $conn->query($get_user);
    $fetch = mysqli_fetch_array($result);//to fetch data
    $user_id = $fetch['user_id'];

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
    <style>
.payment_img{
width:90%;
margin:auto;
display: block;
}
</style>
</head>
<body>
<section id="header">
    <a href=""><img src="logo.png" alt="">
    <div>
      <ul id="navbar">
      <li ><a href="profile.php"><i class="far fa-user"></i></a></li>
        <li ><a href="index.php">Home</a></li>
        <li ><a href="product.php">Product</a></li>
        <li><a href="viewplan.php">Plans</a></li>
        <li ><a href="Workout.html">Sessions</a></li>
        <li ><a href="viewfeedback.php">Reviews</a></li>
        <li id="lg-bag"><a class="active" href="cart.php"><i class="fa-solid fa-cart-plus"></i><sup><?php cart_item();?></sup></a></li>
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


<section id="product1" class="section-p1">
    <h4 class="text-center text-success"><strong>Checkout </h4>
</section>
<div class="container">
    <h2 class="text-center">Payment options</h2><style>h2{color:grey;}</style>
    <div class="row d-flex justify-content-center align-items-center my-5">
        <div class="col-md-6">
            <a href="https://www.paypal.com" target="_blank"><img src="scan.png" alt="" class="payment_img"></a>
        </div>

        <div class="col-md-6">
            <a href="plan_order.php?user_id=<?php echo $user_id ?>"><h3 class="text-center">Pay offline</h3>
            <style>
                a{
                    text-decoration:none;
                    color:seagreen;
                }
                a:hover{
                    text-decoration:underline;
                }
            </style>
        </div>
    </div>
</div>
</body>
</html>
