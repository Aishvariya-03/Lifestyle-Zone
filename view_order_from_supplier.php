
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
        .prod_image{
            width:100px;
            object-fit:contain;
        }
        .polist{
            margin-bottom:20px;
            padding:15px;
            border-bottom : 1px solid #d1d1d1;
            border-radius: 5px;
            background: #fbfbfb;
            width:100%;
        }
        button.btn{
            float:right;
            border:none;
            background:grey;
            font-weight:700;
        }
        button.btn:hover{
            background-color:darkgreen;
            color:azure;
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
    </style>
</head>
<body>
<h3 class="text-success text-center">Purchased Products</h3>
<?php
$username = $_SESSION['username'];
$get_batches = "SELECT DISTINCT `batch` FROM `product_orders`";
$result_batches = $conn->query($get_batches);
if($result_batches->num_rows > 0) {
    while($row_batch = $result_batches->fetch_assoc()) {
        $batch_number = $row_batch['batch'];
        $get_orders = "SELECT * FROM `product_orders` WHERE `batch` = '$batch_number'";
        $result = $conn->query($get_orders);

        if($result->num_rows > 0) {
            echo "<div class='polist mx-5' id='$batch_number'>
                    <p class='text-danger'>Batch # : $batch_number</p>
                    <a href='admin_home.php?update_p_order=$batch_number'><i class='fa-solid fa-pen text-dark float-end mb-2'></i></a>
                    <table class='table table-bordered mt-3'>
                        <thead>
                            <tr>
                                <th>P_Id</th>
                                <th>Product</th>
                                <th>Qnty Ordered</th>
                                <th>Qnty Recieved</th>
                                <th>Supplier</th>
                                <th>Status</th>
                                <th>Ordered By</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>";

            while($row = $result->fetch_assoc()) {
                $purchase_id = $row['p_s_id'];
                $supplier_id = $row['supplier_id'];
                $admin_id = $row['admin_id'];
                $pro_id = $row['pro_id'];
                $qnty_ordered = $row['quantity_ordered'];
                $qnty_recieved = $row['quantity_recieved'];
                $status = $row['status'];
                $date = $row['created_at'];
                ?>
                <tr class='text-center'>
                    <td><?php echo $purchase_id?></td>
                    <td>
                        <?php 
                            $get_product = "SELECT * FROM `products` WHERE `pro_id` = '$pro_id'";
                            $result_product = $conn->query($get_product);
                            if($result_product)
                            {
                                $row_product = $result_product->fetch_assoc();
                                echo $row_product['pro_name'];
                            }
                        ?>
                    </td>
                    <td><?php echo $qnty_ordered?></td>
                    <td><?php echo $qnty_recieved?></td>
                    <td><?php 
                            $get_supplier = "SELECT * FROM `supplier` WHERE `supplier_id` = '$supplier_id'";
                            $result_supplier = $conn->query($get_supplier);
                            if($result_supplier)
                            {
                                $row_supplier = $result_supplier->fetch_assoc();
                                echo $row_supplier['supplier_name'];
                            }
                        ?></td>
                    <td><span class="status status-<?= $status ?>"><?php echo $status?></span></td>
                    <td>
                        <?php 
                            $get_name = "SELECT * FROM `admin_signup` WHERE `admin_id` = '$admin_id'";
                            $result_name = $conn->query($get_name);
                            if($result_name)
                            {
                                $row_name = $result_name->fetch_assoc();
                                echo $row_name['username'];
                            }
                        ?>
                    </td>
                    <td>
                        <?php echo $date?>
                        <input type="hidden" class="purchase_id" value="<?php $purchase_id ?>">
                        <input type="hidden" class="pro_id" value="<?php $pro_id ?>">
                    </td>
                    
                </tr>
                <?php
            }

            echo "</tbody>
                </table>
                </div>";
        } else {
            echo "<h3 class='text-danger text-center'>No Products Found for Batch # $batch_number</h3>";
        }
    }
} else {
    echo "<h3 class='text-danger text-center'>No Batches Found</h3>";
}
?>
</body>
</html>