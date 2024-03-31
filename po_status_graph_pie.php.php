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
$supp="SELECT * FROM supplier";
$res=$conn->query($supp);
$row_su=$res->fetch_assoc();

if($res){

$select = "SELECT * FROM supplier";
$result_select = $conn->query($select);

while($row = $result_select->fetch_assoc()){
    $supplier_id = $row['supplier_id'];
$sql = "SELECT COUNT(*) as NumberOfProducts FROM products WHERE supplier_id = $supplier_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $num = $row['NumberOfProducts'];
        $insert="INSERT INTO productsuppliers(supplier_id,total_products,created_at)values('$supplier_id','$num',NOW())";
        $result_insert = $conn->query($insert);
        if($result_insert)
        {
            echo "successful";
        }
    }
} else {
    echo "0 results";
}}}
?>