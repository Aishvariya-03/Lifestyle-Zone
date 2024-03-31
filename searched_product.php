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

    include('./functions.php/functions.php');
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
        <li><a class="active" href="viewplan.php">Plans</a></li>
        <li ><a href="Workout.html">Sessions</a></li>
        <li ><a href="viewfeedback.php">Reviews</a></li>
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
  
  
  <section id="page-header">
        <h2>#health_is_here</h2>
        <h5>Maintain your health with Herbalife products</h5>
    </section>

    <section id="product1" class="section-p1">
        <h4>Products</h4>
        <h5>Which can change your Life</h5>
        <form class="d-flex">
            <input type="search" class="form-control me-2" placeholder="search" aria-label="search" name="search_data">
            <input type="submit" value="search" class="btn-outline-light p-2 bg-info" name="search_data_product">
            </form>
        <div class="pro-container">
        <?php
        $sql = "SELECT * FROM products";
        
        // Check if a specific category is selected
        if(isset($_GET['category'])) {
            $category_id = $_GET['category'];
            $sql = "SELECT * FROM products WHERE category_id=$category_id";
        }
        
        // Check if a specific brand is selected
        if(isset($_GET['brand'])) {
            $brand_id = $_GET['brand'];
            $sql = "SELECT * FROM products WHERE brand_id=$brand_id";
        }
        
        // Execute the SQL query
        $result = $conn->query($sql);
        
        // Check if there are any products
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Display product information
                echo "<div class='pro'>";
                echo "<img src='" . $row["pro_image"] . "' alt='" . $row["pro_name"] . "'>";
                echo "<div class='des'>";
                echo "<h5> Product Id: " . $row["pro_id"] . "</h5>";
                echo "<h5>" . $row["pro_name"] . " : " . $row["pro_quantity"] . " gm</h5>";
                echo "<h5>" . $row["pro_des"] ."</h5>";
                echo "<div class='star'>";
                echo "<i class='fas fa-star'></i>";
                echo "<i class='fas fa-star'></i>";
                echo "<i class='fas fa-star'></i>";
                echo "<i class='fas fa-star'></i>";
                echo "</div>";
                echo "<h4>Rs. " . $row["pro_price"] . "/-</h4>";
                // Form to add product to cart
                echo "<form method='post' action='add_to_cart.php'>";
                echo "<input type='hidden' name='pro_id' value='" . $row["pro_id"] . "'>";
                echo "<input type='hidden' name='price' value='" . $row["pro_price"] . "'>"; // Add price input field
                echo "<input type='submit' value='Add to Cart'>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<h4 class='m-2 text-danger'>No Products found</h4>";
        }
        ?>
        
        
    
    <!--delivery brands-->
    <div class="col-md-2 bg-secondary p-0">
            <ul class="navbar-nav me-auto text-center">
                <li class="nav-item bg-info">
                    <a href="#" class="nav-link text-light"><h5>Delivery Brands</h5></a>
                </li>
                <?php
                //select brands
                $select = "SELECT * FROM `brand`";
                $result_select = $conn->query($select);
                while($row = mysqli_fetch_assoc($result_select))
                {
                    $brand_title = $row['brand_title'];
                    $brand_id = $row['brand_id'];
                    echo "<li class='nav-item '>
                    <a href='product.php?brand=$brand_id' class='nav-link text-light'>".$row['brand_title']."</a>
                </li>";
                }
                ?>
            </ul>
            <!--categories-->
            <ul class="navbar-nav me-auto text-center">
                <li class="nav-item bg-info">
                    <a href="#" class="nav-link text-light"><h5>Categories</h5></a>
                </li>
                <?php
                //select category
                $select = "SELECT * FROM `category`";
                $result_select = $conn->query($select);
                while($row = mysqli_fetch_assoc($result_select))
                {
                    $category_title = $row['category_title'];
                    $category_id = $row['category_id'];
                    echo "<li class='nav-item '>
                    <a href='product.php?category=$category_id' class='nav-link text-light'>".$row['category_title']."</a>
                </li>";
                }
                ?>
            </ul>
    </div>
    </div>
        
    </section>

</body>
</html>