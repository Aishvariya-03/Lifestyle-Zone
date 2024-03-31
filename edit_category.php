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
    input.btn{
        background-color:lightblue;
        color:rgb(6, 72, 72);
        font-weight:700;
    }
    input.btn:hover{
        background-color:rgb(6, 72, 72);
        color:azure;
        font-weight:700;
    }
    </style>
</head>
<body>
    <div class="container mt-3">
        <h3 class="text-center text-success mt-3">Edit Category</h3>
        <form action="" method="post" >
            <?php
                //for categories from database
                if(isset($_GET['edit_category']))
                {
                    $edit_category = $_GET['edit_category'];
                    //echo $edit_category;
                    $get_category = "SELECT * FROM `category` WHERE category_id = '$edit_category'";
                    $result = $conn->query($get_category);
                    $row = mysqli_fetch_assoc($result);
                    $category_title = $row['category_title'];
                    //echo $category_title;
                    
                    //
                    if(isset($_POST['edit_cat']))
                    {
                        $cat_title = $_POST['category_title'];

                        $update_query = "UPDATE `category` SET category_title = '$cat_title' where category_id = '$edit_category'";
                        $result_update = $conn->query($update_query);
                        if($result_update){
                            echo "<script>alert('Category updated successfuly')</script>";
                            echo "<script>window.open('admin_home.php?view_category','_self')</script>";
                        }
                    }
                }
            ?>
            <div class="form-outline mb-3 w-50 m-auto">
                <label for="category_title" class="form-label">Category Title</label>
                <input type="text" name="category_title" id="category_title" class="form-control" value = '<?php echo $category_title;?>' required>
            </div>
            <div class="form-outline mb-3 w-50 m-auto">
                <input type="submit" value="Update Category" class="btn p-3 text-center m-auto" name="edit_cat">
            </div>
        </form>
    </div>
</body>