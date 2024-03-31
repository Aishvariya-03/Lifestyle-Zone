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
    if (isset($_SESSION['username']))
    {
        $username = $_SESSION['username'];

        // Retrieve admin_id based on username
        $get_admin = "SELECT * FROM `admin_signup` WHERE username = '$username'";
        $result = $conn->query($get_admin);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $admin_id = $row['admin_id'];
            
            if(isset($_POST['add_brand']))
            {
                $brand_title = $_POST['brand_title'];

                // Sanitize input to prevent SQL injection
                $brand_title = $conn->real_escape_string($brand_title);

                // Execute SQL query
                $sql = "SELECT * FROM `brand` WHERE brand_title='$brand_title'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<script>alert('Brand already present')</script>";
                } else {
                    // Execute SQL query to insert new brand
                    $sql_insert = "INSERT INTO `brand`(`admin_id`,`brand_title`) VALUES ('$admin_id','$brand_title')";
                    if ($conn->query($sql_insert) === TRUE) {
                        echo "<script>alert('Brand added successfully')</script>";
                        exit();
                    } else {
                        echo "Error: " . $sql_insert . "<br>" . $conn->error;
                    }
                }
            }
        }
    }
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
    <link rel="stylesheet" href="admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
        <h3 class="text-center text-success mt-3 mb-3 m-auto">Insert Delivery Brand</h3>
        <form action="" method="post" class="mb-2">
    <div class="input-group w-60 mb-2">
    <span class="input-group-text bg-light" id="basic-addon1"><i class="fa-solid fa-table"></i></span>
        <input type="text" class="form-control" placeholder="Insert Brands" name="brand_title" aria-describedby="basic-addon1" required>
    </div>
    
    <div class="input-group w-10 mb-2 m-auto">
        <button type="submit" class="p-2 my-2" name="add_brand">Submit</button>
    </div>
</form>