<?php
// Connect to your MySQL database (replace placeholders with actual values)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "life";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['username']))
{
    $username = $_SESSION['username'];

    // Retrieve admin_id based on username
    $get_admin = "SELECT * FROM `admin_signup` WHERE username = '$username'";
    $result = $conn->query($get_admin);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $admin_id = $row['admin_id'];
if(isset($_POST['add_plan']))
{
    //accessing all the values and storing in variables
    $plan_name = $_POST['plan_name'];
    $pro_category = $_POST['pro_name'];
    $pro_brand = $_POST['pro_names'];

    //insert plan details
    $sql = "INSERT INTO `plan`(`admin_id`,`plan_name`, `pro1_id`, `pro2_id`) VALUES('$admin_id','$plan_name', '$pro_category', '$pro_brand')";
    $result = mysqli_query($conn,$sql);
    if($result)
    {
        echo"<script>alert('Added plan successfully')</script>";
    }
    else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }        
}
} 
else {
    echo "<script>alert('Admin not found')</script>";
}}
else {
    echo "<script>alert('Session not set')</script>";
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
    .input-group{
        width:50%;
    }

</style>
</head>
<body>
    <h3 class="text-center text-success">Add Basic Plans</h3>
    <form action="" method="post" class="mb-2" enctype="multipart/form-data">
        <div class="container text-center m-auto">
            <div class="input-group mb-2 m-auto">
                <span class="input-group-text bg-light mx-3" id="basic-addon1">
                    <i class="fa-solid fa-id-card-clip"></i>
                    <label for="plan_name" class="form-label m-auto mx-2">Plan Name</label>
                </span>                
                <input type="text" class="form-control" placeholder="Plan Name" name="plan_name" aria-describedby="basic-addon1" onkeydown="return /[a-zA-Z0-9 ]/i.test(event.key)" autocomplete="off" required>
            </div>
            <div class="input-group mb-2 m-auto">
                <select name="pro_name" id="" class="form-select m-2 mb-2 my-3 w-50">
                    <option value="">Select Products</option>
                    <?php
                        $select = "SELECT * FROM `products`";
                        $result = $conn->query($select);
                        if($result)
                        {
                            while($row=mysqli_fetch_assoc($result))
                            {
                                $pro_name=$row['pro_name'];
                                $pro_id=$row['pro_id'];
                                echo "<option value='$pro_id'>$pro_name</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="input-group mb-2 m-auto">
                <select name="pro_names" id="" class="form-select m-2 mb-2 my-3 w-50">
                    <option value="">Select Products</option>
                    <?php
                        $query = "SELECT * FROM `products`";
                        $result_query = $conn->query($query);
                        if($result_query)
                        {
                            while($row=mysqli_fetch_assoc($result_query))
                            {
                                $pro_name=$row['pro_name'];
                                $pro_id=$row['pro_id'];
                                echo "<option value='$pro_id'>$pro_name</option>";
                            }
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="input-group mb-2 m-auto">
            <center><input type="submit" value="Add Plan" name="add_plan"><br></center>
        </div>
    </form>
</body>
</html>
