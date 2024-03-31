<!DOCTYPE html>
<html>
<head>
    <title>Add Products</title>
</head>
<body>

<form method="post" action="add_products.php">
    <div id="products-container">
        <div class="product">
            <input type="text" name="product_ids[]" placeholder="Product ID">
            <button type="button" onclick="addProduct()">+</button>
        </div>
    </div>
    <br>
    <input type="submit" value="Submit">
</form>

<div id="display-products">
    <?php
    // PHP code to display products from database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "aju";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT product_id FROM plan";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='product'>" . $row["product_id"] . "</div>";
        }
    } else {
        echo "0 results";
    }
    ?>
</div>

<script>
    function addProduct() {
        var container = document.getElementById('products-container');
        var productDiv = document.createElement('div');
        productDiv.className = 'product';
        productDiv.innerHTML = '<input type="text" name="product_ids[]" placeholder="Product ID"><button type="button" onclick="removeProduct(this)">-</button>';
        container.appendChild(productDiv);
    }

    function removeProduct(button) {
        button.parentNode.remove();
    }
</script>

</body>
</html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aju";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement to insert product IDs
$stmt = $conn->prepare("INSERT INTO plan (product_id) VALUES (?)");

// Bind parameters and execute for each product ID
foreach ($_POST['product_ids'] as $product_id) {
    $stmt->bind_param("s", $product_id);
    if (!$stmt->execute()) {
        echo "Error: " . $stmt->error;
    }
    else{
        header("Location: index.php");
    }
}

// Redirect back to the page

?>


