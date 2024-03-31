<?php
    $select = "SELECT supplier_id, supplier_name FROM supplier";
    $result_select = $conn->query($select);

    $categories = [];
    $bar_chart_data = [];

    while($row = $result_select->fetch_assoc()) // Loop through each row of the result set
    {
        $supplier_id = $row['supplier_id'];
        $categories[] = $row['supplier_name'];

        $stmt = "SELECT COUNT(*) AS pro_count FROM productsuppliers WHERE supplier_id = '$supplier_id'";
        $result = $conn->query($stmt);
        $row_count = $result->fetch_assoc(); // Fetch the count for the current supplier
        $count = $row_count['pro_count'] ?? 0; // Use null coalescing to handle potential null values
        $bar_chart_data[] = (int) $count;
    }
?>
