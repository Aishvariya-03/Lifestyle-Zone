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
    $username = $_SESSION['username'];
        $select_cat = "SELECT * FROM `category`";
        $result_cat = $conn->query($select_cat);
        if($result_cat)
        {
            echo "
                <h3 class='text-center text-success'>All Categories</h3>
                <table class='table table-bordered mt-5 mx-5'>
                    <thead class='bg-info text-center'>
                        <tr>
                            <th>Sr.No.</th>
                            <th>Added By</th>
                            <th>Category Id</th>
                            <th>Category Title</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    ";
                    if($result_cat->num_rows>0)
                    {
                        $sr_no = 0;
                        while($row = mysqli_fetch_assoc($result_cat))
                        {
                            $admin_id = $row['admin_id'];
                            $category_id = $row['category_id'];
                            $category_title = $row['category_title'];
                            $sr_no++;
                            $get_name = "SELECT * FROM `admin_signup` WHERE `admin_id` = '$admin_id'";
                            $result_name = $conn->query($get_name);
                            if($result_name)
                            {
                                $row_name = $result_name->fetch_assoc();
                                $admin_name =$row_name['username'];
                            }
                        
                        echo "
                            <tr class='text-center'>
                                <td>$sr_no</td>
                                <td>$admin_name</td>
                                <td>$category_id</td>
                                <td>$category_title</td>
                                <td><a href='admin_home.php?edit_category=$category_id'><i class='fa-solid fa-pen-to-square text-dark'></i></a></td>
                                <td><a href='admin_home.php?trash_category=$category_id'><i class='fa-solid fa-trash-can text-dark'></i></a></td>
                            </tr>";
                        }
                    }
                }
        
    ?>
        </tbody>
    </table>
</body>
</html>