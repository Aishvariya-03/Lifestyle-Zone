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
$username = $_SESSION['username'];
$get_user = "SELECT * FROM `user` WHERE username = '$username'";
$result = $conn->query($get_user);
$row = mysqli_fetch_assoc($result);
$user_id = $row['user_id'];
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
</head>
<body>

    <h3 class="text-success text-center"><strong>-- My Orders --</strong></h3>
    <table class="table table-bordered mt-3 m-auto">
        <thead class="bg-info">
            <?php
                $get_order_details = "SELECT * FROM `user_order` WHERE user_id = '$user_id'";
                $result_orders = $conn->query($get_order_details);
                echo "<tr>
                <th>Sr. no.</th>
                <th>Order Number</th>
                <th>Due Amount</th>
                <th>Total products</th>
                <th>Invoice Number</th>
                <th>Date</th>
                <th>Complete/Incomplete</th>
                <th>Status</th>
                </tr>
                </thead>
                <tbody>
                ";

                if($result_orders->num_rows>0)
                {
                    $sr_no = 1;
                
                    while($row = mysqli_fetch_assoc($result_orders))
                    {
                        $order_id = $row['order_id'];
                        $due_amount = $row['due_amount'];
                        $total_products = $row['total_products'];
                        $invoice_no = $row['invoice_no'];
                        $order_date = $row['order_date'];
                        $order_status = $row['order_status'];
                        $sr_no++;
                        if($order_status=='pending')
                        {
                            $order_status ='incomplete';
                        }
                        else
                        {
                            $order_status ='complete';
                        }
                        echo "<tr>
                            <td>$sr_no</td>
                            <td>$order_id</td>
                            <td>$due_amount</td>
                            <td>$total_products</td>
                            <td>$invoice_no</td>
                            <td>$order_date</td>
                            <td>$order_status</td>
                            ";
                            
                            if($order_status=='complete')
                            {
                                echo "<td>Paid</td>";
                            }
                            else
                            {
                                echo "<td><a href='confirm_payment.php?order_id=$order_id' class='text-dark'>Confirm</a></td>
                                </tr>";
                            }
                    }  
                }
                else
                {
                    echo "<h3 class='text-danger mt-3'>No orders yet</h2>";
                }
            ?>
        </tbody>
    </table>

</body>
</html>

