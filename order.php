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
    // Fetch product data from the database
    $sql = "SELECT * FROM plan";
    $result = $conn->query($sql);

   //accessing user id
   if(isset($_GET['user_id'])) //if this variable is set then access values
   {
        $user_id = $_GET['user_id'];
   }
   //getting total items and total price of all items
   $get_ip = getClientIp();
   $total_price = 0;
   $cart_query = "SELECT * FROM `cart` WHERE ip_address = '$get_ip'";
   $result_cart = $conn->query($cart_query);
   $invoive_no = mt_rand();
   $status = 'pending';
   $count_pro = mysqli_num_rows($result_cart); 
   while($row_price=mysqli_fetch_array($result_cart))
   {
        $pro_id = $row_price['pro_id'];
        $select_pro = "SELECT * FROM `products` WHERE pro_id = '$pro_id'";
        $run_price = $conn->query($select_pro);
        while($row_pro_price=mysqli_fetch_array($run_price))//fetching and adding in array
        {
            $pro_price = array($row_pro_price['pro_price']);
            $pro_values = array_sum($pro_price);//suming product price
            $total_price = $total_price + $pro_values;
            
        }
   }

   //getting quNTITY FROM CART
   $get_cart = "SELECT * FROM `cart`";
   $run_cart_qnty = $conn->query($get_cart);
   $row_qnty = mysqli_fetch_array($run_cart_qnty);
   $quantity = $row_qnty['quantity'];
   if($quantity==0)
   {
        $quantity = 1;
        $subtotal = $total_price;
   }
   else
   {
    $quantity = $quantity;
    $subtotal = $total_price * $quantity;//amount due is subtotal
   }
   $insert_order = "INSERT INTO `user_order`(`user_id`, `due_amount`, `invoice_no`, `total_products`, `order_date`, `order_status`) VALUES ('$user_id','$subtotal','$invoive_no','$count_pro',NOW(),'$status')";
   $result_query = $conn->query($insert_order);
   if($result_query)
   {
    echo "<script>alert('Orders submitted successfully')</script>";
    echo "<script>window.open('profile.php?my_orders','_self')</script>";
   }

   //orders pending
   $insert_pending_order = "INSERT INTO `pending_orders`(`user_id`,  `invoice_no`, `pro_id`, `quantity`, `order_status`) VALUES ('$user_id','$invoive_no','$pro_id','$quantity','$status')";
   $result_pending_query = $conn->query($insert_pending_order);
   
   //delete from cart // once data is entered in user_orders and pending_orders tables then delete from cart
   $empty_cart = "DELETE FROM `cart` WHERE ip_address = '$get_ip'";
   $result_delete = $conn->query($empty_cart);

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
        <li ><a href="index.php">Home</a></li>
        <li ><a href="product.php">Product</a></li>
        <li><a href="viewplan.php">Plans</a></li>
        <li ><a href="Workout.html">Sessions</a></li>
        <li ><a href="viewfeedback.php">Reviews</a></li>
        <li id="lg-bag"><a class="active" href="cart.php"><i class="fa-solid fa-cart-plus"></i><sup><?php cart_item();?></sup></a></li>
        <li ><a href="#">Total: <?php total();?> /-</a></li>
        <li><a href=""><i class="fa fa-sign-out"></i></a></li>
        <a href="#" id="close"><i class="far fa-times"></i></a>
      </ul>
    </div>
    <div id="mobile">
        <a href="profile.php"><i class="far fa-user"></i></a>
        <a href="cart.php"><i class="fa-solid fa-cart-plus"><sup><?php cart_item();?></sup></i></a>
        <i id="bar" class="fas fa-outdent"></i>
    </div>
  </section>
<!--calling cart function -->
<?php
cart();
?>

<section id="product1" class="section-p1">
    <h4 class="text-center text-success"><strong>-- My Orders --</h4>
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
