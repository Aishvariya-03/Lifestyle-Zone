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
    body {
        font-family: 'Spartan',sans-serif;
        margin: 0;
        padding: 0;
    }
    .prod_image {
        width: 100px;
        object-fit: contain;
    }
</style>
</head>
<body>
    <?php
        $username = $_SESSION['username'];
        $get_products = "SELECT * FROM `products`";
        $result = $conn->query($get_products);
        if($result->num_rows > 0) {
            echo "
                <h3 class='text-success text-center mx-5'>All Products</h3>
                <table class='table table-bordered mt-3 mx-5'>
                <thead>
                    <tr>
                        <th>Product Id</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Quantity</th>
                        <th>Product Cost Price</th>
                        <th>Product Price</th>
                        <th>Supplier</th>
                        <th>Stock</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>";
        
        while($row = mysqli_fetch_assoc($result)) {
            $s_id = $row['supplier_id'];
            $pro_id = $row['pro_id'];
            $admin_id = $row['admin_id'];
            $pro_name = $row['pro_name'];
            $pro_image = $row['pro_image'];
            $pro_quantity = $row['pro_quantity'];
            $pro_cost_price = $row['pro_cost_price'];
            $pro_price = $row['pro_price'];
            $stock = $row['stock'];
            ?>
            <tr class='text-center'>
            <td><?php echo $pro_id ?></td>
            <td><?php echo $pro_name ?></td>
            <td><img src='<?php echo $pro_image ?>' class='prod_image' alt='<?php echo $pro_name ?>'></td> <!-- Displaying the product image -->
            <td><?php echo $pro_quantity ?></td>
            <td><?php echo $pro_cost_price ?></td>
            <td><?php echo $pro_price ?></td>
            
            <td>
                <?php 
                    $get_supplier = "SELECT * FROM `supplier` WHERE `supplier_id` = '$s_id'";
                    $result_supplier = $conn->query($get_supplier);
                    if($result_supplier) {
                        $row_supplier = $result_supplier->fetch_assoc();
                        echo $row_supplier['supplier_name'];
                    }
                ?>
            </td>
            <td><?php echo $stock ?></td>
            <td><a href='admin_home.php?edit_products=<?php echo $pro_id; ?>'><i class='fa-solid fa-pen-to-square text-dark'></i></a></td>
            <td><a href='admin_home.php?trash_products=<?php echo $pro_id; ?>'><i class='fa-solid fa-trash-can text-dark'></i></a></td>
        </tr>
        <?php
        }}
        else {
            echo "<h3 class='text-danger text-center'>No Suppliers Added Yet</h3>";
        }
        ?>
            </tbody>
        </table>
</body>
</html>
