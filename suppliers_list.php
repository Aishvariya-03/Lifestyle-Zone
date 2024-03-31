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
    </style>
    </head>
    <body>
        <?php
            $username = $_SESSION['username'];
            $get_suppliers = "SELECT * FROM `supplier`";
            $result = $conn->query($get_suppliers);
            if($result->num_rows>0)
            {
                echo "
                    <h3 class='text-success text-center mx-5'>All Products</h3>
                    <table class='table table-bordered mt-3 mx-5'>
                    <thead>
                        <tr>
                            <th>Supplier Id</th>
                            <th>Added By</th>
                            <th>Supplier name</th>
                            <th>Email</th>
                            <th>Added At</th>
                            <th>Updated At</th>
                            <th>Products</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    <tbody>";
            
            while($row=mysqli_fetch_assoc($result))
            {
                $supplier_id = $row['supplier_id'];
                $admin_id = $row['admin_id'];
                $supplier_name = $row['supplier_name'];
                $email = $row['email'];
                $added_at = $row['added_at'];
                $updated_at = $row['updated_at'];
                ?>
                <tr class='text-center'>
                <td><?php echo $supplier_id?></td>
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
                <td><?php echo $supplier_name?></td>
                <td><?php echo $email?></td>
                <td><?php echo $added_at?></td>
                <td><?php echo $updated_at?></td>
                <td><?php
                        $select = "SELECT * FROM `products` WHERE `supplier_id`=$supplier_id";
                        $result_select = $conn->query($select);
                        while($row_fetch = mysqli_fetch_assoc($result_select)) 
                        {
                            echo $row_fetch['pro_name']." "?> <br> <?php
                        }
                    ?></td>
                <td><a href='admin_home.php?edit_suppliers=<?php echo $supplier_id;?>'><i class='fa-solid fa-pen-to-square text-dark'></i></a></td>
                <td><a href='admin_home.php?trash_suppliers=<?php echo $supplier_id;?>'><i class='fa-solid fa-trash-can text-dark'></i></a></td>
            </tr>
            <?php
            }}
            else{
                echo "<h3 class='text-danger text-center'>No Suppliers Added Yet</h3>";
            }
            ?>
                </tbody>
            </thead>
        </table>
    </body>
    </html>