<?php
    if(isset($_GET['trash_products']))
    {
        $delete_id = $_GET['trash_products'];
        //delete query
        $delete_query = "DELETE FROM `products` WHERE pro_id = '$delete_id'";
        $result_delete = $conn->query($delete_query);
        if($result_delete)
        {
            echo"<script>alert('Product deleted successfuly')</script>";
            echo"<script>window.open('admin_home.php?view_products.php','_self')</script>";
        }
    }
?>