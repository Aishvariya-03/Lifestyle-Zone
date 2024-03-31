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
if(isset($_POST['delete']))
    {
        if(isset($_GET['trash_plans'])){
        $delete_id = $_GET['trash_plans'];
        //delete query
        $delete_query = "DELETE FROM `plan` WHERE plan_id = '$delete_id'";
        $result_delete = $conn->query($delete_query);
        if($result_delete)
        {
            echo"<script>alert('Plan with id = $delete_id deleted successfuly')</script>";
            echo"<script>window.open('admin_home.php?view_bplan','_self')</script>";
        }}
    }
if(isset($_POST['cancel']))
{
    echo"<script>window.open('admin_home.php?view_bplan','_self')</script>";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <form action="" method="post">
        <div id="confirmationPopup" class="confirmation-popup text-center">
            <div class="confirmation-content">
            <h3 class="text-danger m-5">Are you sure you want to delete this plan ?</h3>
            <input type="submit" class="btn m-auto" value="Yes" name="delete">
            <input type="submit" class="btn m-auto" value="No" name="cancel">
            </div>
        </div>
    </form>

    <style>
        @import url('http://fonts.googleapis.com/css2?family=Spartan:wght@100;200;300;400;500;600;700;800;900&display=swap');

        *{
            padding: 0;
            box-sizing: border-box;
            font-family: 'Spartan',sans-serif;
        }
        .confirmation-popup input.btn
        {
            background:darkseagreen;
            color:black;
            width:130px;
            font-weight:700;
            font-size:20px;
        }
        .confirmation-popup input.btn:hover
        {
            background-color:rgb(32, 60, 44);
            color:azure;
            width:130px;
            font-weight:700;
            font-size:20px;
        }
    </style>
</body>
</html>