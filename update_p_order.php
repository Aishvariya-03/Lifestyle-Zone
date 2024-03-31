<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "life";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET['update_p_order'])) {
    $edit_id = $_GET['update_p_order'];
    $get_data = "SELECT * FROM `product_orders` WHERE batch = $edit_id";
    $result_edit = $conn->query($get_data);
}

if(isset($_POST['edit_product'])) {
    foreach($_POST['quantity_received'] as $index => $received_quantity) {
        $status = $_POST['status'][$index];
        $p_s_id = $_POST['p_s_id'][$index];
        
        $select = "SELECT * FROM product_orders WHERE batch = $edit_id AND p_s_id = '$p_s_id'";
        $result_select = $conn->query($select);
        $row_select = $result_select->fetch_assoc();
        
        if($result_select && $row_select) {
            $p_id = $row_select['p_s_id'];
            $quantity_ordered = $row_select['quantity_ordered'];
            $quantity_remaining = $quantity_ordered - $received_quantity;
            
            // Update quantity_remaining in product_orders table
            $update = "UPDATE `product_orders` SET `quantity_remaining`='$quantity_remaining' WHERE p_s_id='$p_id'";
            $conn->query($update);
            
            // Update stock in products table
            $stock_query = "SELECT `stock` FROM `products` WHERE `pro_id` = '$p_id'";
            $stock_result = $conn->query($stock_query);
            $row_stock = $stock_result->fetch_assoc();
            
            if($row_stock) {
                $current_stock = $row_stock['stock'];
                $updated_stock = $current_stock + $received_quantity;

                $stock_update_query = "UPDATE `products` SET `stock` = $updated_stock WHERE `pro_id` = '$p_id'";
                $conn->query($stock_update_query);
            }

            // Update each product in the batch
            $update_query = "UPDATE `product_orders` SET quantity_recieved='$received_quantity', quantity_remaining='$quantity_remaining', status='$status', created_at = NOW() WHERE p_s_id='$p_s_id'";
            $conn->query($update_query);

            echo "<script>alert('Successfully updated Purchase info')</script>";
            echo "<script>alert('Quantity Remaining Updated')</script>";
            echo "<script>window.open('admin_home.php?view_order_from_supplier','_self')</script>";
        }
    }
}


?>

<!-- Rest of your HTML code remains unchanged -->


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeStyle Zone</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="profile.css">
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
        .btn{
            border:none;
            background:rgb(20, 67, 41);
            font-weight:700;
            color:azure;
        }
        .btn:hover{
            background-color:skyblue;
            color:rgb(18, 18, 46);
        }
        .status{
            padding:4px 6px;
            border : 2px solid;
        }
        .status-ORDERED{
            background:#ff7c76;
            border-color:red;
        }
        .status-ARRIVED{
            background:#b5ebb5;
            border-color:darkgreen;
        }
        .status-INCOMPLETE {
            background: #ffd966; /* Changed background color to a shade of yellow */
            border-color: darkorange; /* Changed border color to a shade of orange */
        }
    </style>
</head>
<body>
    <h3 class="text-success text-center">Update Purchase Order</h3>
    <div class="container mt-5">
        <form action="" method="post" enctype="multipart/form-data">
            
            <?php
            if($result_edit->num_rows > 0) {
                echo '<table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>P_ID</th>
                                <th>Pro_ID</th>
                                <th>Product Name</th>
                                <th>Quantity Ordered</th>
                                <th>Quantity Received</th>
                                <th>Supplier Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>';

                while($row = mysqli_fetch_assoc($result_edit)) {
                    $p_id = $row['p_s_id'];
                    $pro_id = $row['pro_id'];
                    $quantity_ordered = $row['quantity_ordered'];
                    $quantity_received = $row['quantity_recieved'];
                    $supplier_id = $row['supplier_id'];

                    // Fetch supplier name
                    $select_supplier = "SELECT * FROM `supplier` WHERE `supplier_id` = '$supplier_id'";
                    $result_supplier = $conn->query($select_supplier);
                    $row_supplier = mysqli_fetch_assoc($result_supplier);
                    $supplier_name = $row_supplier['supplier_name'];

                    // Fetch product name
                    $select_products = "SELECT * FROM `products` WHERE `pro_id` = '$pro_id'";
                    $result_products = $conn->query($select_products);
                    $row_products = mysqli_fetch_assoc($result_products);
                    $pro_name = $row_products['pro_name'];

                    echo "<tr>";
                    echo "<td>" . $p_id . "</td>";
                    echo "<td>" . $pro_id . "</td>";
                    echo "<td>" . $pro_name . "</td>";
                    echo "<td>" . $quantity_ordered . "</td>";
                    echo "<td><input type='number' name='quantity_received[]' id='quantity_received' value='$quantity_received'></td>";
                    echo "<td>" . $supplier_name . "</td>";
                    echo "<td>
                            <select name='status[]' id='status' class='p-2'>
                                <option value='ORDERED' " . ($row['status'] == 'ORDERED' ? 'selected' : '') . ">ORDERED</option>
                                <option value='ARRIVED' " . ($row['status'] == 'ARRIVED' ? 'selected' : '') . ">ARRIVED</option>
                                <option value='INCOMPLETE' " . ($row['status'] == 'INCOMPLETE' ? 'selected' : '') . ">INCOMPLETE</option>
                            </select></td>";
                    echo "<input type='hidden' name='p_s_id[]' value='" . $p_id . "'>";
                    echo "</tr>";
                }

                echo '</tbody>
                    </table>';
            } else {
                echo "No matching records found.";
            }
            ?>

            <div class="text-center">
                <input type="submit" name="edit_product" value="Update" class="btn px-3 mt-3">
            </div>
        </form>
    </div>
</body>
</html>
