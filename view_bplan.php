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
    .prod_image{
        width:100px;
        object-fit:contain;
    }
</style>
</head>
<body>
    <table class="table table-bordered mt-3 mx-5">
        <?php
            $username = $_SESSION['username'];
            $sr_no=0;
            $get_plans = "SELECT * FROM `plan`";
            $result = $conn->query($get_plans);
            if($result->num_rows>0)
            {
                echo "<h3 class='text-success text-center'>All Basic Plans</h3>";
                echo "<thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Plan Id</th>
                            <th>Added By</th>
                            <th>Plan Name</th>
                            <th>Product 1 Name</th>
                            <th>Product 2 Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        <tbody>";
                while($row=mysqli_fetch_assoc($result))
                {
                    $plan_id = $row['plan_id'];
                    $admin_id = $row['admin_id'];
                    $plan_name = $row['plan_name'];
                    $pro1_id = $row['pro1_id'];
                    $pro2_id = $row['pro2_id'];
                    $select_pro1 = "SELECT * FROM `products` WHERE `pro_id` = '$pro1_id'";
                    $result_pro1 = $conn->query($select_pro1);
                    $row_pro1 = mysqli_fetch_assoc($result_pro1);
                    $prod_name= $row_pro1['pro_name'];

                    $select_pro2 = "SELECT * FROM `products` WHERE `pro_id` = '$pro2_id'";
                    $result_pro2 = $conn->query($select_pro2);
                    $row_pro2 = mysqli_fetch_assoc($result_pro2);
                    $product_name= $row_pro2['pro_name'];
                    $sr_no++;
                    ?>
                    <tr class='text-center'>
                    <td><?php echo $sr_no?></td>
                    <td><?php echo $plan_id?></td>
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
                    <td><?php echo $plan_name?></td>
                    <td><?php echo $prod_name?></td>
                    <td><?php echo $product_name?></td>
                    <td><a href='admin_home.php?edit_plans=<?php echo $plan_id;?>'><i class='fa-solid fa-pen-to-square text-dark'></i></a></td>
                    <td><a href='admin_home.php?trash_plans=<?php echo $plan_id;?>'><i class='fa-solid fa-trash-can text-dark'></i></a></td>
                </tr>
                <?php
                }
            }
            else
            {
                echo "<h3 class='text-center text-danger mt-5'>No plans added yet</h3>";
            }
        ?>
            </tbody>
        </thead>
    </table>
</body>
</html>