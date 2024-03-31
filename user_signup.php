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
include('./functions.php/functions.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = ($_POST["cpassword"]);
    $user_ip = getClientIp();
    // Check if the email is unique
    $checkEmailQuery = "SELECT * FROM user WHERE email='$email'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        // Email already exists, display an error message
        echo "<script>alert('Email already exists. Please use a different email.');</script>";
    }else if($password!=$cpassword)
    {
        echo "<script>alert('Password doesnot matches with Confirm Password')</script>";
    } else 
    {
        // Email is unique, proceed with insertion
        $sql = "INSERT INTO user(username, email, password,user_ip) VALUES ('$username', '$email', '$password','$user_ip')";
        $sql_execute = $conn->query($sql);
    }
}



?>

<?php getClientIP();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="usersignup.css">
</head>
<body>
<section>
      <style>
         section{
            background: url("Herbalife.jpg");
            background-position: center;
            background-size: cover;
            position:fixed;
         }
      </style>
<div class="form-box">
         <div class="form-value">
            <div class="popup">
            <form action="user_signup.php" method="post">
               <h2>Register</h2>
               <div class="inputbox"> <ion-icon name="user-outline"></ion-icon> 
                     <input type="text" name="username" onkeydown="return /[a-zA-Z0-9@.]/i.test(event.key)" required>
                     <label>Username</label>
               </div>
               <div class="inputbox"> <ion-icon name="mail-outline"></ion-icon> 
                     <input type="email" name="email" onkeydown="return /[a-zA-Z0-9@.]/i.test(event.key)" required>
                     <label>Email</label>
               </div>
               <div class="inputbox"> <ion-icon name="lock-closed-outline"></ion-icon>
                     <input type="password" name="password" minlength="8" maxlength="15" required><br> 
                     <label>Password</label>
               </div>
               <div class="inputbox"> <ion-icon name="lock-closed-outline"></ion-icon>
                     <input type="password" name="cpassword" minlength="8" maxlength="15" required><br> 
                     <label>Confirm Password</label>
               </div>
               <div class="form-outline">
                  <input type="submit" value="Create" name="submit" class="btn" >
                  <style>
                     input.btn{
                        font-weight:700;
                        margin-left:120px;
                        padding: 10px 20px; 
                        border: none; 
                        border-radius: 5px; 
                        background-color: seagreen; 
                        color: darkgreen; 
                        cursor: pointer; 
                        text-decoration: none; 
                        font-size: 16px; 
                        background-color: azure;
                     }
                     input.btn:hover{
                        background-color:rgb(20, 67, 41);
                        color:azure;
                     }
                     p{
                        font-weight:700;
                        margin-top:10px;
                        margin-left:40px;
                     }
                     a{
                        color:darkgreen;
                        margin-left:130px;
                        text-decoration:none;
                     }
                     a:hover{
                        color:darkblue;
                        text-decoration:underline;
                     }
                  </style>
                  <p>Already have an account ?</p>
               <a href="user.php">login</a>
               </div>
        </div>
    </section>
</form>
</body>
</html>