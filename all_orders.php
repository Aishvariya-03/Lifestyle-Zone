<?php
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
    </style>
</head>
<body>
    
        <?php
            $get_orders = "SELECT * FROM `user_order`";
            $result = $conn->query($get_orders);
            if($result)
            {
                echo "
                    <h3 class='text-center text-success mt-3 mb-3 mx-5 m-auto'>All Orders</h3>
                    <table class='table table-bordered mt-3 mb-3 mx-5 m-auto'>
                        <thead class='text-center'>
                        <tr>
                        <th>Sr. No.</th>
                        <th>User Id</th>
                        <th>Due Amount</th>
                        <th>Invoice No</th>
                        <th>Total Products</th>
                        <th>Order date</th>
                        <th>Order Status</th>
                        <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody class='text-center'>
                        ";
            }
                
            if($result->num_rows>0)
            {
                $sr_no = 0;
                while($row = mysqli_fetch_assoc($result))
                {
                    $order_id = $row['order_id'];
                    $user_id = $row['user_id'];
                    $due_amount = $row['due_amount'];
                    $invoice_no = $row['invoice_no'];
                    $total_products = $row['total_products'];
                    $order_date = $row['order_date'];
                    $order_status = $row['order_status'];
                    $sr_no++;
                    echo "<tr class='text-center'>
                    <td>$sr_no</td>
                    <td>$user_id</td>
                    <td>$due_amount</td>
                    <td>$invoice_no</td>
                    <td>$total_products</td>
                    <td>$order_date</td>
                    <td>$order_status</td>
                    <td><a href='admin_home.php?trash_all_orders = $order_id'><i class='fa-solid fa-trash-can text-dark'></i></a></td>
                    </tr>
                    </tbody>
                    ";
                }
            }
            else
            {
                echo "<h3 class='text-danger mt-3'>No orders yet</h2>";
            }

        ?>
    </table>
</body>
</html>