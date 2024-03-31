<?php
if (isset($_SESSION['username']))
{
    $username = $_SESSION['username'];

    // Retrieve admin_id based on username
    $get_admin = "SELECT * FROM `admin_signup` WHERE username = '$username'";
    $result = $conn->query($get_admin);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $admin_id = $row['admin_id'];
    if(isset($_POST['order']))
    {
        $pro_name = $_POST['pro_name'];
        $quantity = array_values($_POST['quantity']);
        $batch = time();

        foreach($pro_name as $key =>$pro_names)
        {
            $names = $pro_names;
            $qnty = $quantity[$key];
            $select_q = "select * from `products` where pro_name = '$names'";
            $result_q = $conn->query($select_q);
            $row_fetch = $result_q->fetch_assoc();
            $pro_id = $row_fetch['pro_id'];
            $supplier_id = $row_fetch['supplier_id'];
            $quantity_ordered = $qnty;
            $status = 'ORDERED';
            $created_by = $_SESSION['username'];
            $insert = "INSERT INTO `product_orders`(`supplier_id`, `pro_id`, `quantity_ordered`, `status`, `batch`, `created_at`, `admin_id`) VALUES ('$supplier_id', '$pro_id', '$quantity_ordered', '$status', '$batch', NOW(), '$admin_id')";
            $result_insert = $conn->query($insert);     
        }
        if($result_insert)
                {
                    echo "<script>alert('Successfully Added products In Stock')</script>";
                    echo "<script>window_open('admin_home.php?view_order_from_supplier','_self')</script>";
                }
                else{
                    echo "<script>alert('Failed to add products In Stock')</script>";
                }
    }}}
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
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<style>
    @import url('http://fonts.googleapis.com/css2?family=Spartan:wght@100;200;300;400;500;600;700;800;900&display=swap');
    body
    {
        font-family: 'Spartan',sans-serif;
        margin: 0;
        padding: 0;
    }
    button.btn{
        margin-left:850px;
        background-color:seagreen;
        color:azure;
        font-weight:770;
        width:20%;
    }
    button.btn:hover{
        background-color:rgb(21, 21, 42);
        color:azure;
    }
    button.add-more-form{
        margin-left:800px;
        background-color:seagreen;
        color:azure;
        font-weight:700;
        width:30%;
        padding:10px;
    }
    button.add-more-form:hover{
        background-color:rgb(103, 31, 31);
        color:azure;
    }
    .inputs{
        width :30%;
    }
    .inputs i.i{
        font-size:20px;
    }
    label{
        color:grey;
        font-weight:700;
    }
</style>
</head>
<body>   
<h3 class="text-success mt-5 mx-2" style="padding:2px; border-left:6px solid #e0e0e0; border-bottom:2px solid #e0e0e0; padding-bottom:20px;"><i class="fa-solid fa-plus mx-4"></i>Order Products</h3>
<div>
    <div class="input-group">
        <button class="add-more-form mt-2" id="add-more-form float-end">Add Another Product</button>
    </div>
</div>
    <form action="" method="post" class="mb-2">
        <div class="main-form mt-5" id="order_product_list">
            <div class="row" style="padding:6px; border-bottom:2px solid #e0e0e0; padding-bottom:20px;">
                <div class="inputs input-group mb-3">
                    <span class="input-group-text bg-light" id="basic-addon1"><i class="fa-solid fa-tag"></i></span>
                    <select name="pro_name[]" id="pro_name[]" class="form-select">
                        <option value="">Select Product Name</option>
                        <?php
                            $select = "SELECT * FROM `products`";
                            $result = $conn->query($select);
                            if($result)
                            {
                                while($row=mysqli_fetch_assoc($result))
                                {
                                    $pro_name=$row['pro_name'];
                                    $pro_id=$row['pro_id'];
                                    echo "<option value='$pro_name'>$pro_name</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="inputs input-group mb-3">
                    <span class="input-group-text bg-light" id="basic-addon1"><i class="fa-solid fa-truck"></i></span>
                        <select name="supplier[]" id="supplier[]" class="form-select">
                            <option value="">Select Supplier</option>
                            <?php
                                $select = "SELECT * FROM `supplier`";
                                $result = $conn->query($select);
                                if($result)
                                {
                                    while($row=mysqli_fetch_assoc($result))
                                    {
                                        $supplier_name=$row['supplier_name'];
                                        $supplier_id=$row['supplier_id'];
                                        echo "<option value='$supplier_name'>$supplier_name</option>";
                                    }
                                }
                            ?>
                        </select>
                </div>
                <div class=" inputs input-group mb-3 m-auto">
                    <span class="input-group-text bg-light" id="basic-addon1"><i class="fa-solid fa-weight-scale"></i></span>                
                    <input type="number" class="form-control row" placeholder="Quantity" name="quantity[]" aria-describedby="basic-addon1" onkeydown="return /[0-9]/i.test(event.key)" autocomplete="off" min="0" required>
                </div>  
            </div>      
        </div>
            <div class="paste-new-form">

            </div>
            <div class="input-group text-center mb-2 m-auto">
                <button type="submit" class="btn p-2 mt-2" name="order">Submit Order</button>
            </div>
            </div>
        </form>
    </div></div>

    <script>
    $(document).ready(function(){
        $(document).on('click','.i', function(){
            $(this).closest('.main-form').remove();
        })

        $(document).on('click', '.add-more-form', function(){
            $('.paste-new-form').append('<div class="main-form mt-5" id="order_product_list"><div class="row" style="padding:6px; border-bottom:2px solid #e0e0e0; padding-bottom:20px;"><div class="inputs input-group mb-3"><span class="input-group-text bg-light" id="basic-addon1"><i class="fa-solid fa-tag"></i></span><select name="pro_name[]" id="pro_name[]" class="form-select"><option value="">Select Product Name</option><?php $select = "SELECT * FROM `products`";$result = $conn->query($select);if($result){while($row=mysqli_fetch_assoc($result)){$pro_name=$row['pro_name'];$pro_id=$row['pro_id'];echo "<option value=\"$pro_name\">$pro_name</option>";}}?></select></div><div class="inputs input-group mb-3"><span class="input-group-text bg-light" id="basic-addon1"><i class="fa-solid fa-truck"></i></span><select name="supplier[]" id="supplier[]" class="form-select"><option value="">Select Supplier</option><?php $select = "SELECT * FROM `supplier`";$result = $conn->query($select);if($result){while($row=mysqli_fetch_assoc($result)){$supplier_name=$row['supplier_name'];$supplier_id=$row['supplier_id'];echo "<option value=\"$supplier_name\">$supplier_name</option>";}}?></select></div><div class="inputs input-group mb-3 m-auto"><span class="input-group-text bg-light" id="basic-addon1"><i class="fa-solid fa-weight-scale"></i></span><input type="number" class="form-control row" placeholder="Quantity" name="quantity[]" aria-describedby="basic-addon1" onkeydown="return /[0-9]/i.test(event.key)" autocomplete="off" min="0" required></div><div class="inputs input-group mb-3 m-auto"><i class="fa-solid fa-trash text-danger i"></i></div></div></div>');
        });
    });
</script>

</body>
</html> 