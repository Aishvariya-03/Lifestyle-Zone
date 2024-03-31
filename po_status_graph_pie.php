<?php
    $statuses = ['ORDERED','INCOMPLETE','ARRIVED'];
    $reults = [];

    foreach($statuses as $status)
    {
        $stmt = "SELECT COUNT(*) AS status_count FROM product_orders WHERE status = '$status'";
        $result = $conn->query($stmt);
        $row = $result->fetch_assoc();
        $count = $row['status_count'];
        $results[] = [
            'name'=> strtoupper($status),
            'y' => (int) $count,
        ];
    }
?>