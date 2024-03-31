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
    <h3 class="text-center text-success mx-5">All Payments</h3>
    <table class="table table-bordered mt-3 mx-5 m-auto">
        <thead class="text-center">
        <?php
            $get_payments = "SELECT * FROM `user_payments`";
            $result = $conn->query($get_payments);
            echo "
                <tr>
                <th>Sr. No.</th>
                <th>Order Id</th>
                <th>Payment Id</th>
                <th>Invoice No</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Payment date</th>
                <th>Delete</th>
                </tr>
                </thead>
                <tbody class='text-center'>
                ";
            if($result->num_rows>0)
            {
                $sr_no = 0;
                while($row = mysqli_fetch_assoc($result))
                {
                    $payment_id = $row['payment_id'];
                    $order_id = $row['order_id'];
                    $invoice_no = $row['invoice_no'];
                    $amount = $row['amount'];
                    $payment_mode = $row['payment_mode'];
                    $date = $row['date'];
                    $sr_no++;
                    echo "<tr class='text-center'>
                    <td>$sr_no</td>
                    <td>$order_id</td>
                    <td>$payment_id</td>
                    <td>$invoice_no</td>
                    <td>$amount</td>
                    <td>$payment_mode</td>
                    <td>$date</td>
                    <td><a href='admin_home.php?trash_all_payments = $payment_id'><i class='fa-solid fa-trash-can text-dark'></i></a></td>
                    </tr>
                    </tbody>
                    ";
                }
            }
            else
            {
                echo "<h3 class='text-danger mt-3'>No payments yet</h2>";
            }

        ?>
    </table>
</body>
</html>