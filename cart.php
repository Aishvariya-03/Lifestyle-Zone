<?php
    // Connect to your MySQL database (replace placeholders with actual values)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "life";

    $conn = new mysqli($servername, $username, $password, $dbname);
session_start();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
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
        <li ><a href="index.html">Home</a></li>
        <li ><a href="product.php">Product</a></li>
        <li><a href="viewplan.php">Plans</a></li>
        <li ><a href="Workout.html">Sessions</a></li>
        <li ><a href="viewfeedback.php">Reviews</a></li>
        <li id="lg-bag"><a class="active" href="cart.php"><i class="far fa-cart-plus" name='cart'></i><sup><?php cart_item();?></sup></a></li>
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
remove_cart_item();
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

    <section id="page">
        <h2>My Cart</h2>
    </section>

    <section id="product1" class="section-p1">
        
        <div class="container">
            <div class="row">
                <form action="" method="post">
                <table class="table table-bordered">
                
                        <?php
                            $get_ip = getClientIP();
                            $total = 0;
                            $sql = "SELECT * FROM `cart` WHERE ip_address='$get_ip'";
                            $result = $conn->query($sql);
                            $result_count = mysqli_num_rows($result);
                            if($result_count>0)
                                {
                                    echo "<h4>Products</h4>
                                    <h5>which you choosed</h5>
                                    <thead>
                                    <tr>
                                        <th>Product Id</th>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Product Quantity</th>
                                        <th>Product Price</th>
                                        <th>Remove</th>
                                        <th colspan='2'>Operations</th>
                                    </tr>
                                </thead>
                                <tbody>";
                            while($row =mysqli_fetch_array($result)) 
                            {
                                $pro_id = $row['pro_id'];
                                $get_price = "SELECT * FROM `products` WHERE pro_id='$pro_id'";
                                $result_products = $conn->query($get_price);
                                
                                
                                while($row = mysqli_fetch_array($result_products))
                                {
                                    $pro_price=array($row['pro_price']);
                                    $pro_name = $row['pro_name'];
                                    $pro_image = $row['pro_image'];
                                    $pro_price_sum=array_sum($pro_price);
                                    $total=$total+$pro_price_sum;
                              
                        ?>
                        <tr>
                            <td><?php echo $pro_id?></td>
                            <td><img src="./product_images/<?php echo $pro_image?> " alt="" class="cart_img"></td>
                            <td><?php echo $pro_name?></td>
                            <td><input type="text" name="qty" value="<?php $get_quantity = "SELECT * FROM `cart` WHERE pro_id='$pro_id'";
                                $result_qty = $conn->query($get_quantity); $row_qty=mysqli_fetch_array($result_qty); echo $row_qty['quantity'];?>"></td><style>input{width:30%;}</style>
                            <?php
                                $get_ip = getClientIP();
                                if(isset($_POST['update_cart']))
                                {
                                    $quantities = $_POST['qty'];
                                    $update_cart = "update `cart` set quantity=$quantities where ip_address='$get_ip'";
                                    $result_update = $conn->query($update_cart);
                                    $total = $total * $quantities;
                                }
                            ?>
                            <td><?php echo $row['pro_price']?></td>
                            <td><input type="checkbox" name="remove_item[]" id="" value="<?php echo $pro_id ?>"></td><!--using remove_item[] array to remove multiple items-->
                            <td>
                                <!--<button type="submit" class='btn' name="update"><strong>Update</strong></button> -->
                                <input type="submit" value="Update" class="btn" name="update_cart">
                                <input type="submit" value="Delete" class="btn" name="remove_cart">
                                <!--<button class='btn'>Delete</button>-->
                                <style>input.btn{margin-left: 10px;font-size: 20px;background-color:#6aa6a2; padding:5px; border-radius: 5px; border: none; font-weight:700; width:auto;} button.btn:hover{background-color:azure;}</style>
                            </td>
                        </tr>
                        <style>img.cart_img{width:80px;height:80px}</style>
                        <?php
                          }
                        }
                    }else{
                        echo "<h4 class='text-center text-danger'>No products in Cart</h4>";
                    }
                    
                        ?>
                    </tbody>
                </table>
                <?php
                $get_ip = getClientIP();
                $cart_query = "SELECT * FROM `cart` WHERE ip_address='$get_ip'";
                $result_query = $conn->query($cart_query);
                $result_counts = mysqli_num_rows($result_query);
                if($result_counts>0){
                    echo "<div class='total d-flex'>
                    <h4>Total: $total /- </h4>
                    <input type='submit' value='Continue Shopping' class='btn' name='continue_shopping'>
        
                    <button class='btn'><a href='checkout.php'>Checkout</a></button>";
                   
                }
                else{
                    echo "<div class='total d-flex'>
                    <input type='submit' value='Continue Shopping' class='btn' name='continue_shopping'><style>input.btn{margin-left: 10px;font-size: 20px;background-color:#6aa6a2; padding:5px; border-radius: 5px; border: none; font-weight:700; width:auto;} button.btn:hover{background-color:azure;}</style>
                </div>";
                }
                if(isset($_POST['continue_shopping']))
                {
                    echo "<script>window.open('product.php','_self')</script>";
                }
                ?>
            
            </form>
            </div>
            
        </div>
    </section>

</body>
</html>