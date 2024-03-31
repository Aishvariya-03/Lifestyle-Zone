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
    <link rel="stylesheet" href="add_product.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
    @import url('http://fonts.googleapis.com/css2?family=Spartan:wght@100;200;300;400;500;600;700;800;900&display=swap');
    body
    {
        font-family: 'Spartan',sans-serif;
        margin: 0;
        padding: 0;
    }
    </style>
</head>
<body class="bg-light">
<section id="container">
        <div class="container text-center m-auto">
            <p>Add Products</p>
            <div class="popup text-center m-auto">
                <form action="add_product.php" method="post" enctype="multipart/form-data">
                  <div class="form-outline mb-4 w-80 m-auto">
                    <label for="pro_name" class="form-label text-left m-2 mt-2">Product Name</label><br><input type="text" placeholder="Enter Product Name" name="pro_name" onkeydown="return /[a-zA-Z -]/i.test(event.key)" required autocomplete="off"><br>
                    <label for="pro_image" class="form-label m-2 mt-2">Product Image</label><br><input type="file" name="pro_image" placeholder="Choose File" required><br>
                    <label for="pro_image2" class="form-label m-2 mt-2">Product Image 2</label><br><input type="file" name="pro_image2" placeholder="Choose File" required><br>
                    <label for="pro_image3" class="form-label m-2 mt-2">Product Image 3</label><br><input type="file" name="pro_image3" placeholder="Choose File" required><br>
                    <label for="pro_quantity" class="form-label m-2 mt-2">Quantity</label><br><input type="text" placeholder="Enter Quantity in gm" name="pro_quantity" onkeydown="return /[0-9]/i.test(event.key)" required autocomplete="off"><br>
                    <label for="pro_des" class="form-label m-2 mt-2">Product Description</label><br><input type="text" placeholder="Enter Description" name="pro_des" onkeydown="return /[a-zA-Z0-9 ]/i.test(event.key)" required autocomplete="off"><br>
                    <label for="pro_keyword" class="form-label m-2 mt-2">Product Keyword</label><br><input type="text" placeholder="Enter Keywords" name="pro_keyword" onkeydown="return /[a-zA-Z -]/i.test(event.key)" required><br>
                    <label for="pro_cost_price" class="form-label m-2 mt-2">Cost Price</label><br><input type="TEXT" placeholder="Enter Cost Price" name="pro_cost_price" onkeydown="return /[0-9]/i.test(event.key)" required autocomplete="off"><br>
                    <label for="pro_price" class="form-label m-2 mt-2">Price</label><br><input type="TEXT" placeholder="Enter Price" name="pro_price" onkeydown="return /[0-9]/i.test(event.key)" required autocomplete="off"><br>
                    <label for="pro_category" class="form-label text-left m-2 mt-2">Product category<select name="pro_category" id="" class="form-select m-2 mb-2 my-3 w-50">
                      <option value="">Select Category</option>
                      <?php
                        $select = "SELECT * FROM `category`";
                        $result = $conn->query($select);
                        if($result)
                        {
                          while($row=mysqli_fetch_assoc($result))
                          {
                            $category_title=$row['category_title'];
                            $category_id=$row['category_id'];
                            echo "<option value='$category_id'>$category_title</option>";
                          }
                        }
                      ?>
                    </select></label>

                    <label for="pro_brand" class="form-label text-left m-2 mt-2">Delivery Brands<select name="pro_brand" id="" class="form-select m-2 mb-2 my-3 w-50">
                      <option value="">Select brand</option>
                      <?php
                        $select = "SELECT * FROM `brand`";
                        $result = $conn->query($select);
                        if($result)
                        {
                          while($row=mysqli_fetch_assoc($result))
                          {
                            $brand_title=$row['brand_title'];
                            $brand_id=$row['brand_id'];
                            echo "<option value='$brand_id'>$brand_title</option>";
                          }
                        }
                      ?>
                    </select></label>

                    <label for="supplier" class="form-label text-left m-2 mt-2">Supplier<select name="supplier" id="supplier" class="form-select m-2 mb-2 my-3 w-50">
                      <option value="">Select Supplier</option>
                      <?php
                        $select = "SELECT * FROM `supplier`";
                        $result = $conn->query($select);
                        if($result)
                        {
                          while($row=mysqli_fetch_assoc($result))
                          {
                            $supplier_name=$row['supplier_name'];
                            $supplier_id=$row['supplier_id'];
                            echo "<option value='$supplier_id'>$supplier_name</option>";
                          }
                        }
                      ?>
                    </select></label>
                    <button type="submit" name="add_product" class="mb-2">Add Product</button>
                    <a href="admin_home.php?view_products" class="mb-2">View Products</a>
                  </div>
                </form>
            </div>
        </div>
</body>
</html>
