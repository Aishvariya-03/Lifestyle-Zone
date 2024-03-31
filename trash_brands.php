
    <?php
        if(isset($_GET['trash_brands']))
        {
            $trash_brands = $_GET['trash_brands'];
            //echo $trash_brands;
            $delete = "DELETE FROM `brand` WHERE brand_id = '$trash_brands'";
            $result_delete = $conn ->query($delete);
            if($result_delete)
            {
                echo "<script>alert('Brand deleted successfuly')</script>";
                echo "<script>window.open('admin_home.php?view_brand','_self')</script>";
            }
        }
    ?>