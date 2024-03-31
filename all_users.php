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
            $get_user = "SELECT * FROM `user`";
            $result = $conn->query($get_user);
            if($result)
            {
                echo "
                    <h3 class='text-center text-success mx-5'>Users List</h3>
                    <table class='table table-bordered mt-3 mx-5'>
                    <thead class='text-center'>
                    <tr>
                    <th>Sr. No.</th>
                    <th>User Id</th>
                    <th>User IP Address</th>
                    <th>Username</th>
                    <th>User Email</th>
                    <th>User Contact</th>
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
                            $user_id = $row['user_id'];
                            $user_ip = getClientIp();
                            $username = $row['username'];
                            $email = $row['email'];
                            $contact = $row['contact'];
                            $sr_no++;
                            echo "<tr class='text-center'>
                            <td>$sr_no</td>
                            <td>$user_id</td>
                            <td>$user_ip</td>
                            <td>$username</td>
                            <td>$email</td>
                            <td>$contact</td>
                            <td><a href='admin_home.php?trash_all_users = $user_id'><i class='fa-solid fa-trash-can text-dark'></i></a></td>
                            </tr>
                            </tbody>
                            ";
                        }
                    }
                    else
                    {
                        echo "<h3 class='text-danger mt-3'>No payments yet</h2>";
                    }
                }
                else{
                    echo "<h3 class='text-center text-danger mt-5 mx-5'>No User Yet</h3>";
                }

        ?>
    </table>
</body>
</html>