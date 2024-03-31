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


    //get ip address function
 
function getClientIP(){
    $ipaddress = '';

    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
}

// cart function
function cart(){
    global $conn;
    if(isset($_GET['add_to_cart'])){
        $get_ip = getClientIP();
        $get_pro_id = $_GET['add_to_cart'];
        $sql = "SELECT * FROM `cart` WHERE ip_address='$get_ip' AND pro_id=$get_pro_id";
        if($result = $conn->query($sql)){
            if ($result->num_rows > 0){
               echo "<script>alert('Added is already present in cart')</script>"; 
               echo "<script>window.open('product.php','_self')</script>";
            }
            else{
                $sql = "INSERT INTO `cart` (pro_id,ip_address,quantity) VALUES('$get_pro_id','$get_ip',0) ";
                $result = $conn->query($sql);
                echo "<script>alert('Added product in cart')</script>"; 
                echo "<script>window.open('product.php','_self')</script>";
            }
        }
    }
}

//get cart items number
function cart_item(){
    global $conn;
    if(isset($_GET['add_to_cart'])){
        $get_ip = getClientIP();
        $sql = "SELECT * FROM `cart` WHERE ip_address='$get_ip'";
        $result = $conn->query($sql);
        $count_rows = mysqli_num_rows($result);}
    else{
        $get_ip = getClientIP();
        $sql = "SELECT * FROM `cart` WHERE ip_address='$get_ip'";
        $result = $conn->query($sql);
        $count_rows = mysqli_num_rows($result);
    }
    echo $count_rows;
}

//totla price function
function total(){
    global $conn;
    $get_ip = getClientIP();
    $total = 0;
    $sql = "SELECT * FROM `cart` WHERE ip_address='$get_ip'";
    $result = $conn->query($sql);
    while($row =mysqli_fetch_array($result)) 
    {
        $pro_id = $row['pro_id'];
        $get_price = "SELECT * FROM `products` WHERE pro_id='$pro_id'";
        $result_products = $conn->query($get_price);
        while($row =mysqli_fetch_array($result_products))
        {
            $pro_price=array($row['pro_price']);
            $pro_price_sum=array_sum($pro_price);
            $total=$total+$pro_price_sum;
        }
    }
    echo $total;
}

//remove item function

function remove_cart_item(){
    global $conn;
    if(isset($_POST['remove_cart']))
    {
        foreach($_POST['remove_item'] as $remove_id)
        {
            echo $remove_id;
            $delete = "DELETE FROM `cart` WHERE pro_id=$remove_id";
            $result_delete = $conn->query($delete);
            if($result_delete)
            {
                echo "<script>window.open('cart.php','_self')</script>";
            }
        }
    }
}
            
//get user order details
function get_user_order_details()
{
    global $conn;
    $username = $_SESSION['username'];
    $get_details = "SELECT * FROM `user` WhERE username = '$username'";
    $result = $conn->query($get_details);
    while($row = mysqli_fetch_array($result))
    {
        $user_id = $row['user_id'];
        if(!isset($_GET['edit_profile']))
        {
            if(!isset($_GET['my_orders']))
            {
                if(!isset($_GET['delete_account']))
                {
                    $get_orders = "SELECT * FROM `user_order` WHERE user_id = '$user_id' and order_status='pending'";
                    $result_orders = $conn->query($get_orders);
                    $row_count = mysqli_num_rows($result_orders);
                    if($row_count>0)
                    {
                        echo "<h2> You have <span class='text-danger'>$row_count</span> pending orders</h2>";
                        echo "<a href='profile.php?my_orders'><h5 class='m-auto'><strong>Order Details</strong></h5></a>
                            <style>a{color:darkblue;text-decoration:none;font-size:16px;}a:hover{color:blue;text-decoration:underline;}";
                    }
                    else
                    {
                        echo "<h2> You have <span class='text-danger'>0</span> pending orders</h2>";
                        echo "<a href='product.php'><h5 class='m-auto'><strong>Explore Products</strong></h5></a>
                            <style>a{color:darkblue;text-decoration:none;font-size:16px;}a:hover{color:blue;text-decoration:underline;}";
                    }
                }
            }
        }
    }
}

?>