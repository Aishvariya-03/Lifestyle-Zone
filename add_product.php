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

if(isset($_POST['add_product']))
{
    //accessing all the values and storing in variables
    $pro_name = $_POST['pro_name'];
    $pro_quantity = $_POST['pro_quantity'];
    $pro_des = $_POST['pro_des'];
    $pro_keyword = $_POST['pro_keyword'];
    $pro_price = $_POST['pro_price'];
    $pro_cost_price = $_POST['pro_cost_price'];
    $pro_category = $_POST['pro_category'];
    $pro_brand = $_POST['pro_brand'];
    $supplier = $_POST['supplier'];
    $status = 'TRUE';

    //accessing images
    $pro_image = $_FILES['pro_image']['name'];
    $pro_image2 = $_FILES['pro_image2']['name'];
    $pro_image3 = $_FILES['pro_image3']['name'];
    //accessing image temp name
    $temp_image = $_FILES['pro_image']['tmp_name'];
    $temp_image2 = $_FILES['pro_image2']['tmp_name'];
    $temp_image3 = $_FILES['pro_image3']['tmp_name'];

    //checking empty conditions
    if($pro_name=='' or $pro_quantity=='' or $pro_des=='' or $pro_keyword=='' or $pro_price=='' or $pro_cost_price=='' or $pro_category=='' or $pro_brand=='' or $pro_image=='' or $supplier=='')
    {
        echo"<script>alert('Please fill all fields')</script>";
    }
    else
    {
        //add images in this folder
        move_uploaded_file($temp_image,"./product_images/$pro_image");
        //insert products
        $sql = "INSERT INTO `products`(`pro_name`, `pro_quantity`, `pro_des`, `pro_keyword`, `pro_price`, `pro_cost_price`, `category_id`, `brand_id`, `pro_image`, `pro_image2`,`pro_image3`,`date`, `status`,supplier_id) VALUES('$pro_name', '$pro_quantity', '$pro_des', '$pro_keyword', '$pro_price', '$pro_cost_price', '$pro_category', '$pro_brand', '$pro_image', '$pro_image2', '$pro_image3', NOW(), '$status','$supplier')";
        $result = mysqli_query($conn,$sql);
        if($result)
        {
            echo"<script>alert('Added products successfuly')</script>";

            // Retrieve the last inserted product ID
            $pro_id = $conn->insert_id;

            // Calculate the margin
            $margin = $pro_price - $pro_cost_price;

            // Update the margin in the database
            $update_query = "UPDATE products SET margin = $margin WHERE pro_id = $pro_id";
            $result_update = $conn->query($update_query);
            if($result_update) {
                echo "<script>alert('Margin calculated and updated successfully.')</script>";
                echo "<script>window.open('admin_home.php?view_products','_self')</script>";
            } else {
                echo "<script>alert('Failed to update margin.')</script>";
            }
        }
    }
}

$conn->close();
?>
