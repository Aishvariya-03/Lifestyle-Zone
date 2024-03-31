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

$statuses = ['ORDERED','INCOMPLETE','ARRIVED'];
$results=[];

foreach($statuses as $status){
    $stm = "SELECT COUNT(*) as status_count FROM product_orders where status = '$status'";
    $result=$conn->query($stm);
    $row=$result->fetch_assoc();
    $count = $row['status_count'];

    $results[] = [
        'name'=> strtoupper($status),
        'y'=> (int) $count,
    ];
}

?>