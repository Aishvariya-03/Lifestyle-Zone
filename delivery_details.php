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
session_start();
$username = $_SESSION['username'];
if(isset($_POST['save'])){
    // Update first name, last name, gender, age, height, weight
    $update_house_no = isset($_POST['update_house_no']) ? mysqli_real_escape_string($conn, $_POST['update_house_no']) : '';
    $update_street = isset($_POST['update_street']) ? mysqli_real_escape_string($conn, $_POST['update_street']) : '';
    $update_city = isset($_POST['update_city']) ? mysqli_real_escape_string($conn, $_POST['update_city']) : '';
    $update_state = isset($_POST['update_state']) ? mysqli_real_escape_string($conn, $_POST['update_state']) : '';
    $update_zip = isset($_POST['update_zip']) ? mysqli_real_escape_string($conn, $_POST['update_zip']) : '';
    $update_contact = isset($_POST['update_contact']) ? mysqli_real_escape_string($conn, $_POST['update_contact']) : '';
    
    $update_query = "UPDATE `user` SET house_no = '$update_house_no', street = '$update_street', city = '$update_city', state = '$update_state', zip = '$update_zip', contact = '$update_contact' WHERE username = '$username'";
    $result_update = mysqli_query($conn, $update_query);
    if(!$result_update){
        die('Query failed: ' . mysqli_error($conn));
    }
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
</head>
<body>

<h4 class="text-center text-success mt-3"><strong>Update Delivery Details</strong></h4>
  <div class="update-profile">
    <?php
        $select = mysqli_query($conn, "SELECT * FROM `user` WHERE username = '$username'") or die('Query failed');
        if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
        }
    ?>
    <form action="profile.php?delivery_details" method="post" >
        <div class="prod-container">
            <div class="pro-container">
                <span>House No.</span>
                <input type="text" name="update_house_no" value="<?php echo isset($fetch['house_no']) ? $fetch['house_no'] : ''; ?>" class="box">
                <span>Street</span>
                <input type="text" name="update_street" value="<?php echo isset($fetch['street']) ? $fetch['street'] : ''; ?>" class="box">
                <span>City</span>
                <input type="text" name="update_city" value="<?php echo isset($fetch['city']) ? $fetch['city'] : ''; ?>" list="genders" class="box">
                <datalist id="genders">
                <option value="Virar">
                <option value="Nallasopara">
                <option value="Vasai">
                </datalist>
                <span>State</span>
                <input type="text" name="update_state" value="<?php echo isset($fetch['state']) ? $fetch['state'] : ''; ?>" list="states" class="box">
                <datalist id="states">
                <option value="Maharashtra">
                <option value="Nallasopara">
                <option value="Vasai">
                </datalist>
                <span>Zip</span>
                <input type="text" name="update_zip" value="<?php echo isset($fetch['zip']) ? $fetch['zip'] : ''; ?>" class="box">
                <span>Contact</span>
                <input type="tel" name="update_contact" value="<?php echo isset($fetch['contact']) ? $fetch['contact'] : ''; ?>" class="box">
            </div>
        </div>
        <input type="submit" value="Save" name="save" style="padding: 10px 20px; border: none; border-radius: 5px; background-color: seagreen; color: azure; cursor: pointer; text-decoration: none; font-size: 16px; background-color: seagreen;font-family:'Spartan',sans-serif;" onmouseover="this.style.backgroundColor=' rgb(20, 67, 41)'" onmouseout="this.style.backgroundColor='seagreen'">
        <?php
            if(isset($_POST['save']))
            {
                echo"<script>alert('Address Details updated successfuly')</script>";
                echo"<script>window.open('profile.php','_self')</script>";
            }
        ?>
        <a href="profile.php" class="delete-btn">Go Back</a>
    </form>
    </div>

</body>
</html>
