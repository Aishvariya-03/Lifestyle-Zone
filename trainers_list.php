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
                <?php
                    
                    $username = $_SESSION['username'];
                    
                    $get_trainers = "SELECT * FROM `trainer_details`";
                    $result_trainers = $conn->query($get_trainers);
                    $sr_no = 0;
                    if($result_trainers->num_rows>0)
                    {
                        echo "<h3 class='text-success text-center mb-2'>Trainers List</h3>
                        <table class='table table-bordered mt-3 mx-5'>
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Added By</th>
                                    <th>Trainer Id</th>
                                    <th>First name</th>
                                    <th>Last Name</th>
                                    <th>Trainer Contact</th>
                                    <th>Qualification</th>
                                    <th>Work</th>
                                    <th>Joining Date</th>
                                    <th>Delete</th>
                                </tr>
                                <tbody>";

                        while($row=mysqli_fetch_assoc($result_trainers))
                        {
                            $trainer_id = $row['trainer_id'];
                            $admin_id = $row['admin_id'];
                            $trainer_fname = $row['trainer_fname'];
                            $trainer_lname = $row['trainer_lname'];
                            $trainer_contact = $row['trainer_contact'];
                            $trainer_qual = $row['trainer_qual'];
                            $trainer_work = $row['trainer_work'];
                            $join_date = $row['join_date'];
                            $sr_no++;
                            ?>
                            <tr class='text-center'>
                            <td><?php echo $sr_no?></td>
                            <td><?php 
                                $get_name = "SELECT * FROM `admin_signup` WHERE `admin_id` = '$admin_id'";
                                $result_name = $conn->query($get_name);
                                if($result_name)
                                {
                                    $row_name = $result_name->fetch_assoc();
                                    echo $row_name['username'];
                                }
                            ?></td>
                            <td><?php echo $trainer_id?></td>
                            <td><?php echo $trainer_fname?></td>
                            <td><?php echo $trainer_lname?></td>
                            <td><?php echo $trainer_contact?></td>
                            <td><?php echo $trainer_qual?></td>
                            <td><?php echo $trainer_work?></td>
                            <td><?php echo $join_date?></td>
                            <td><a href='admin_home.php?trash_trainer=<?php echo $trainer_id;?>'><i class='fa-solid fa-trash-can text-dark'></i></a></td>
                        </tr>
                        <?php
                        }
                    
                    }
                    else
                    {
                        echo "<h3 class='text-center text-danger'>No Trainers yet</h3>";
                    }
                ?>
            </tbody>
        </thead>
    </table>
</body>
</html>