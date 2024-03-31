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

// Handle POST data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $image = mysqli_real_escape_string($conn, $_POST["image"]);
    $des = mysqli_real_escape_string($conn, $_POST["des"]);
    $price = floatval($_POST["price"]);

    // Insert data into the database
    $sql = "INSERT INTO plan (name, image, des, price) VALUES ('$name', '$image', '$des', '$price')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Added Plan successfully')</script>";
        header("Location: viewplan.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Plan</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="plan.css">
    <style>
        nav ul {
          list-style-type: none;
          margin: 0;
          padding: 0;
        }
    
        nav ul li {
          display: inline;
          margin-right: 16px;
        }
    
        nav ul li:last-child {
          margin-right: 0;
        }
    
        nav ul li a {
          color: white;
          text-decoration: none;
        }
    
       
        .dropdown {
          position: relative;
          display: inline-block;
        }
    
        .dropdown-content {
          display: none;
          position: absolute;
          background-color: rgb(215, 230, 230);
          min-width: 120px;
          z-index: 1;
        }
    
        .dropdown-content a {
          color: white;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
        }
    
        .dropdown:hover .dropdown-content {
          display: block;
        }
        </style>
</head>
<body>
    <section id="header">
        <a href=""><img src="logo.png" alt="">
        <div>
            <nav>
          <ul id="navbar">
            <li class="dropdown">
              <a class="active" href="product1.php">Product</a>
              <div class="dropdown-content">
                <a href="add_products.html">Add Product</a>
                <a href="product1.php">View Products</a>
              </div>
            </li>
            <li class="dropdown">
              <a href="viewplan.php">Plans</a>
              <div class="dropdown-content">
                <a href="addplan.php">Add Plan</a>
                <a href="viewplan.php">View Plans</a>
              </div>
            </li>
            <li class="dropdown">
              <a href="viewsession.html">Sessions</a>
              <div class="dropdown-content">
                <a href="addsession.html">Add Sessions</a>
                <a href="viewsession.html">View Sessions</a>
              </div>
            </li>
            <li class="dropdown">
              <a href="#">Report</a>
              <div class="dropdown-content">
                <a href="report_att">Attendance</a>
                <a href="report_rev">Revenue</a>
                <a href="report_cus">Customer List</a>
              </div>
            </li>
            <li id="lg-bag"><a href="cart.html"><i class="far fa-cart-plus"></i></a></li>
            <li><a href="login.html"><i class="fa fa-sign-out"></i></a></li>
            <a href="#" id="close"><i class="far fa-times"></i></a>
          </ul></nav>
        </div>
        <div id="mobile">
            <a href="profile.php"><i class="far fa-user"></i></a>
            <a href="cart.html"><i class="far fa-cart-plus"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
      </section>

        <div class="container">
            <h1>Add Plan</h1>
            <div class="popup">
                <form action="addplan.php" method="post">
                        <input type="file" name="image" placeholder="Choose File" required><br>
                        <input type="text" placeholder="Enter Plan Name" name="name" onkeydown="return /[a-zA-Z -]/i.test(event.key)" required><br>
                        <input type="text" placeholder="Enter Description" name="des" onkeydown="return /[a-zA-Z0-9 ]/i.test(event.key)" required><br>
                        <input type="text" placeholder="Enter Price" name="price" onkeydown="return /[0-9]/i.test(event.key)" required><br>
                        <button type="submit" class="add-pro">Add Plan</button>
                </form>
            </div>
        </div>
     
    </form>
  </div>
</body>
</html>