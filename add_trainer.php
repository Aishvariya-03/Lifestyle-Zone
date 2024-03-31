<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "life";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) 
{
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

        if (isset($_POST['add_trainer'])) {
            $trainer_id = $_POST['trainer_id'];
            $trainer_fname = $_POST['trainer_fname'];
            $trainer_lname = $_POST['trainer_lname'];
            $trainer_contact = $_POST['trainer_contact'];
            $trainer_qual = $_POST['trainer_qual'];
            $trainer_work = $_POST['trainer_work'];

            $check = "SELECT * FROM `trainer_details` WHERE trainer_id = '$trainer_id'";
            $result_check = $conn->query($check);

            if ($result_check->num_rows > 0) {
                echo "<script>alert('Trainer already present')</script>";
            } else {
                // Inserting trainer details along with admin_id
                $insert = "INSERT INTO `trainer_details` (trainer_id, admin_id, trainer_fname, trainer_lname, trainer_contact, trainer_qual, trainer_work, join_date) 
                           VALUES ('$trainer_id', '$admin_id', '$trainer_fname', '$trainer_lname', '$trainer_contact', '$trainer_qual', '$trainer_work', NOW())";
                $result_insert = $conn->query($insert);

                if ($result_insert) 
                {
                    echo "<script>alert('Trainer added successfully')</script>";
                    echo "<script>window.open('admin_home.php?trainers_list','_self')</script>";
                } 
                else 
                {
                    echo "Error: " . $sql_insert . "<br>" . $conn->error;
                }
            }
        }
    } 
    else {
        echo "<script>alert('Admin not found')</script>";
    }
}
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
    button:hover{
        background-color:black;
        color:azure;
    }
</style>
</head>
<body>
    <h3 class="text-center text-success mt-0">Add New Trainers</h3>
        <form action="" method="post" class="mb-2">
        <div class="input-group w-50 mb-2 m-auto">
                <span class="input-group-text bg-light" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                <input type="text" class="form-control" placeholder="Trainer Id" name="trainer_id" aria-describedby="basic-addon1" onkeydown="return /[a-zA-Z0-9 ]/i.test(event.key)" autocomplete="off" required>
            </div>


            <div class="input-group w-50 mb-2 m-auto">
                <span class="input-group-text bg-light" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                <input type="text" class="form-control" placeholder="First Name" name="trainer_fname" aria-describedby="basic-addon1" onkeydown="return /[a-zA-Z0-9 ]/i.test(event.key)" autocomplete="off" required>
            </div>

            <div class="input-group w-50 mb-2 m-auto">
                <span class="input-group-text bg-light" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                <input type="text" class="form-control" placeholder="Last Name" name="trainer_lname" aria-describedby="basic-addon1" onkeydown="return /[a-zA-Z0-9 ]/i.test(event.key)" autocomplete="off" required>
            </div>

            <div class="input-group w-50 mb-2 m-auto">
                <span class="input-group-text bg-light" id="basic-addon1"><i class="fa-solid fa-phone"></i></span>
                <input type="tel" class="form-control" placeholder="Contact" name="trainer_contact" aria-describedby="basic-addon1" onkeydown="return /[0-9]/i.test(event.key)" autocomplete="off" maxlength="10" required>
            </div>

            <div class="input-group w-50 mb-2 m-auto">
                <span class="input-group-text bg-light" id="basic-addon1"><i class="fa-solid fa-building-columns"></i></i></span>
                <input type="text" class="form-control" placeholder="Qualification" name="trainer_qual" aria-describedby="basic-addon1" onkeydown="return /[a-zA-Z0-9 -,.]/i.test(event.key)" autocomplete="off" required></textarea>
            </div>

            <div class="input-group w-50 mb-2 m-auto">
                <span class="input-group-text bg-light" id="basic-addon1"><i class="fa-solid fa-book-journal-whills"></i></span>
                <textarea type="text" class="form-control" placeholder="Work Experience" name="trainer_work" aria-describedby="basic-addon1" onkeydown="return /[a-zA-Z0-9 -,.]/i.test(event.key)" autocomplete="off" required></textarea>
            
            
            <div class="input-group text-center w-10 mb-2 m-auto">
                <button type="submit" class="p-2 my-2" name="add_trainer">Submit</button>
            </div></div>
            </div>
        </form>
</body>
</html>