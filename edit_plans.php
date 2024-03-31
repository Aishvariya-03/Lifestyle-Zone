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

if(isset($_GET['edit_plans']))
{
    $edit_id = $_GET['edit_plans'];//this will display id in the url
    $get_data = "SELECT * FROM `plan` WHERE plan_id = $edit_id";
    $result_edit = $conn->query($get_data);
    $row = mysqli_fetch_assoc($result_edit);
    $plan_name = $row['plan_name'];
    $pro1_id = $row['pro1_id'];
    $pro2_id = $row['pro2_id'];

    //fetching category name
    $select_pro1 = "SELECT * FROM `products` WHERE `pro_id` = '$pro1_id'";
    $result_pro1 = $conn->query($select_pro1);
    $row_pro1 = mysqli_fetch_assoc($result_pro1);
    $prod1_name = $row_pro1['pro_name'];

    //fetching brand name
    $select_pro2 = "SELECT * FROM `products` WHERE `pro_id` = '$pro2_id'";
    $result_pro2 = $conn->query($select_pro2);
    $row_pro2 = mysqli_fetch_assoc($result_pro2);
    $prod2_name = $row_pro2['pro_name'];
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
        width:150px;
        object-fit:contain;
    }
    input.btn{
        background-color:rgb(6, 72, 72);
        color:azure;
        font-weight:700;
    }
    </style>
    </head>
<body>
    <h3 class="text-success text-center mt-3"><strong>Edit Plan Details</strong></h3>
    <div class="container mt-5">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline w-50 m-auto">
                <label for="plan_id" class="form-label mt-3">Plan Id</label>
                <input class="form-control" id="plan_id" name="plan_id" value="<?php echo $edit_id;?>" required>
            </div>
            <div class="form-outline w-50 m-auto">
                <label for="plan_name" class="form-label mt-3">Plan Name</label>
                <input type="text" class="form-control" id="plan_name" name="plan_name" value="<?php echo $plan_name;?>" required>
            </div>
            <div class="form-outline w-50 m-auto">
            <label for="pro_category" class="form-label mt-3">Product 1 Name</label>
            <select name="pro_category" class="form-select" value="<?php echo $pro1_id;?>">
                <option value="<?php echo $prod1_name ;?>"><?php echo $prod1_name;?></option>
                    <?php 
                        $select_proall = "SELECT * FROM `products`";
                        $result_proall  = $conn->query($select_proall );
                        while($row_proall  = mysqli_fetch_assoc($result_proall ))
                        {
                            $prod1_name = $row_proall ['pro_name']; 
                            $prod1_id = $row_proall ['pro_id'];  
                            echo "<option value='$prod1_id'>$prod1_name</option>";          
                        };
                        
                    ?>
                </select>
            </div>
            <div class="form-outline w-50 m-auto">
            <label for="pro_brands" class="form-label mt-3">Product 2 Name</label>
            <select name="pro_brands" class="form-select" value="<?php echo $pro2_id;?>">
                <option value="<?php echo $prod2_name ;?>"><?php echo $prod2_name;?></option>
                    <?php 
                        $select_prodall = "SELECT * FROM `products`";
                        $result_prodall  = $conn->query($select_prodall );
                        while($row_prodall  = mysqli_fetch_assoc($result_prodall ))
                        {
                            $prod2_name = $row_prodall ['pro_name']; 
                            $prod2_id = $row_prodall ['pro_id'];  
                            echo "<option value='$prod2_id'>$prod2_name</option>";          
                        };
                        
                    ?>
                </select>
            </div>
            
            <div class="text-center">
                <input type="submit" name="edit_plan" value="Update" class="btn px-3 mt-3">
                <?php
                    //edit products
                    if(isset($_POST['edit_plan']))
                    {
                        $plan_name = $_POST['plan_name'];//taking data from page and saving in variable with any name
                        $pro1name = $_POST['pro_category'];
                        $pro2name = $_POST['pro_brands'];

                        //checking for fields empty 
                        if($plan_name=='' or $pro1name=='' or $pro2name=='')
                        {
                            echo "<script>alert('Please fill all the fields')</script>";
                        }
                        else
                        {
                           
                            $update_query = "UPDATE `plan` SET plan_name = '$plan_name',pro1_id = '$pro1name',pro2_id = '$pro2name' WHERE plan_id='$edit_id'";//otherwise all the data will get updated
                            $result_update = $conn->query($update_query);
                            if($result_update)
                            {
                                echo "<script>alert('Successfuly updated product info')</script>";
                                echo "<script>window.open('admin_home.php?view_bplan','_self')</script>";
                            }
                        }
                    }
                ?>
            </div>
        </form>
    </div>
</body>
</html>