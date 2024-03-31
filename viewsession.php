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
        <li ><a class="active" href="product.php">Product</a></li>
        <li><a href="viewplan.php">Plans</a></li>
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

  <section id="header text-center">
        <h2 class="text-success text-center m-4">Basic Plans</h2>
    </section>
    <section id="product1" class="section-p1">
        <div class="pro-container">
        <?php
        $sql = "SELECT * FROM session";
        // Execute the SQL query
        $result = $conn->query($sql);

        // Check if there are any sessions
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Display session information
                echo "<div class='pro'>";
                echo "<div class='des'>";
                echo "<h5> Session Id: " . $row["sess_id"] . "</h5>";
                echo "<h5>Name: " . $row["sess_name"] . "</h5>";
                echo "<h5>Time: " . $row["start_sess"] . " to " . $row["end_sess"] . "</h5>";
                echo "<h5>Description: " . $row["des"] . "</h5>";
                echo "<a href='" . $row['url'] . "' class='btn'>JOIN</a>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<h4 class='m-2 text-danger'>No Sessions found</h4>";
        }
        ?>
        </div>
    </section>
</body>
</html>
