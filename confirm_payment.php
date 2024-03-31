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

include('./functions.php/functions.php');
session_start();


if(isset($_GET['order_id']))
{
    $order_id = $_GET['order_id'];
    $select_data = "SELECT * FROM `user_order` WHERE order_id = '$order_id'";
    $result = $conn->query($select_data);
    
    // Check if the query executed successfully
    if ($result && $result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $invoice_no = $row['invoice_no'];
        $due_amount = $row['due_amount'];
    } else {
        // Handle the case where no data is found for the given order_id
        echo "No data found for the given order ID.";
    }
}

if(isset($_POST['confirm_payment']))
{
    $invoice_no = $_POST['invoice_no'];
    $amount = $_POST['amount'];
    $payment_mode = $_POST['payment_mode'];

    $insert = "INSERT INTO `user_payments` (`order_id`, `invoice_no`, `amount`, `payment_mode`, `date`) VALUES  ('$order_id', '$invoice_no', '$amount', '$payment_mode', NOW())";
    $result_insert = $conn->query($insert);
    if($result_insert)
    {
        echo "<script>alert('Successfuly Completed Payment')</script>";
        echo "<script>window.open('profile.php?my_orders','_self')</script>";
    }
    $update_orders = "UPDATE `user_order` SET `order_status`='complete' WHERE order_id = '$order_id'";
    $result_update = $conn->query($update_orders);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <style>
        @import url('http://fonts.googleapis.com/css2?family=Spartan:wght@100;200;300;400;500;600;700;800;900&display=swap');
        body
        {
            background-color:azure;
            font-family:'Sparten',sans-serif;
        }
    </style>


    
    <div class="container">
    <h3 class="text-success text-center m-5"><strong>-- Payment --</strong></h3>
        <form action="" method="post">
            <div class="form-outline d-flex">
                <style>
                    .container{
                        margin-top:250px;
                    }
                    .container .form-outline{
                        margin-left:300px;
                        margin-top:10px
                    }
                    .container .form-outline input,select{
                        margin-left:10px;
                        width:50%;
                        border-radius:5px;
                        border:1px solid lightgrey;
                        color:grey;
                    }
                    .container .form-outline input.btn{
                        background-color:#b2d4b8;
                        color:rgb(32, 60, 44);
                        width:130px;
                        font-weight:700;
                        font-size:20px;
                        margin-left:300px;
                    }
                    .container .form-outline input.btn:hover{
                        background-color:rgb(32, 60, 44);
                        color:azure;
                        width:130px;
                        font-weight:700;
                        font-size:20px;
                    }
                </style>
                <h4>Invoice no. :</h4>
                <input type="text" class="form-control" name="invoice_no" value="<?php echo $invoice_no; ?>">
            </div>
            <div class="form-outline d-flex">
                <h4>Amount :</h4>
                <input type="text" class="form-control" name="amount" value="<?php echo $due_amount; ?>">
            </div>
            <div class="form-outline d-flex">
                <h4>Payment Mode :</h4>
                <select name="payment_mode" class="w-50">
                    <option>Select Payment Mode</option>
                    <option>UPI</option>
                    <option>Netbanking</option>
                    <option>Paypal</option>
                    <option>Cash on delivery</option>
                    <option>Pay Offline</option>
                </select>
            </div>
            <div class="form-outline">
                <input type="submit" class="btn" value="Confirm" name="confirm_payment">                
            </div>
        </form>
    </div>
</body>
</html>