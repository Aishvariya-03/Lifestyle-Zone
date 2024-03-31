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
session_start();//starting session

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
    <link rel="stylesheet" href="admin.css?v=<?= time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    
    <style>
    @import url('http://fonts.googleapis.com/css2?family=Spartan:wght@100;200;300;400;500;600;700;800;900&display=swap');
    body
    {
        font-family: 'Spartan',sans-serif;
        margin: 0;
        padding: 0;
    }
    .dashboard_slidebar .logo{
        width:50%;
        height:50%;
        object-fit:contain;
        margin-top: 5px;
    }
    #dashboardContainer{
        display:flex;
        flex-direction:row;
    }
    .image{
        background-color:azure;
        margin-top:5px;
    }
    .image span{
        font-size: 16px;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        font-weight: 700;
    }
    .dashboard_slidebar{
        width:18%;
        height:auto;
    }
    .dashboard_content_container{
        width:70%;
    }
    .dashboard_slidebar_menu{
        text-decoration:none;
    }
    ul.dashboard_list{
        padding:10px;
        margin-top:10px;
        margin-left:0px;
        text-decoration:none;
        list-style: none;
        text-align: left;
    }
    ul.dashboard_list li{
        text-align: left;
    }
    ul.dashboard_list li a{
        text-decoration: none;
        color: azure;
        display: block; /* Make anchor elements behave like blocks for full width */
        padding: 10px;
        font-size: 14px;
    }
    ul.dashboard_list li:hover{
        background:black;
        border-radius:5px;
    }
    .dashboard_topnav a{
        color:#848383;
        font-size:18px;
    }
    ul.dashboard_list li.list{
        background:black;
        border-radius:5px;

    }
    .subMenus{
        display:none;
    }
    .angle{
        float:right;
        font-size:10px;
        margin-top:7px;
    }
    .nav-item{
        display:block;
    }
    </style>
</head>
<body>
    <div class="bg-light">
        <h3 class="text-center p-2">Manage Details</h3>
    </div>
    <div id="dashboardContainer">
        <div class="dashboard_slidebar bg-secondary mt-0" id="dashboard_slidebar">
            <div class="image text-center mt-2 m-auto">
                <h3 class="dashboard_logo" id="dashboard_logo"><img src="logo.png" alt="" class="logo text-center mt-0"/></h3>
                <span class="dashboard_text text-center text-success" id ="dashboard_text"><?php if(!isset($_SESSION['username']))
    {
        echo "<li class='nav-item'>
            <a href='#' class='nav-link'>Welcome Guest</a>
        </li>";
    }
    else
    {
        echo "<li class='nav-item'>
            <a href='#' class='nav-link'>Welcome ".$_SESSION['username']."</a>
        </li>";
    }?>
    </span>
    </div>
    <div class="dashboard_slidebar_menu">
        <ul class="dashboard_list text-light text-decoration-none">
            <li class="li_menu show_hidden_submenu">
                <a href="admin_home.php?dashboard" class="show_hidden_submenu text-decoration-none">
                    <i class="fa fa-dashboard text-light mx-2 menuIcons show_hidden_submenu"></i>
                    <span class="menuText show_hidden_submenu">Dashboard</span>
                </a>
            </li>
            <li class="li_menu show_hidden_submenu">
                <a href="javascript:void(0);" class="show_hidden_submenu text-decoration-none">
                    <i class="fa fa-user-tie text-light mx-2 menuIcons show_hidden_submenu"></i>
                    <span class="menuText show_hidden_submenu">Trainer</span>
                    <i class="fa-solid fa-angle-down angle show_hidden_submenu"></i>
                </a>
                <ul class="subMenus">
                    <a href="admin_home.php?add_trainer"><i class="fa-solid fa-toggle-on mx-2 menuIcons"></i><span class="menuText">Add Trainer</span></a>
                    <a href="admin_home.php?trainers_list"><i class="fa-solid fa-toggle-on mx-2 menuIcons"></i><span class="menuText">View Trainer</span></a>
                </ul>
            </li>
            <li class="li_menu show_hidden_submenu">
                <a href="javascript:void(0);" class="show_hidden_submenu text-decoration-none">
                    <i class="fa-solid fa-layer-group mx-2 menuIcons show_hidden_submenu"></i>
                    <span class="menuText show_hidden_submenu">Plans</span>
                    <i class="fa-solid fa-angle-down angle show_hidden_submenu"></i>
                </a>
                <ul class="subMenus">
                    <a href="admin_home.php?add_bplan"><i class="fa-solid fa-toggle-on mx-2 menuIcons"></i><span class="menuText">Add Basic Plan</span></a>
                    <a href="admin_home.php?view_bplan"><i class="fa-solid fa-toggle-on mx-2 menuIcons"></i><span class="menuText">View Basic Plans</span></a>
                    <a href="admin_home.php?add_cplan"><i class="fa-solid fa-toggle-on mx-2 menuIcons"></i><span class="menuText">Customize your Plan</span></a>
                    <a href="admin_home.php?view_cplan"><i class="fa-solid fa-toggle-on mx-2 menuIcons"></i><span class="menuText">View Customized Plans</span></a>
                </ul>
            </li>
            <li class="li_menu show_hidden_submenu">
                <a href="javascript:void(0);" class="show_hidden_submenu text-decoration-none">
                    <i class="fa-brands fa-product-hunt mx-2 menuIcons show_hidden_submenu"></i>
                    <span class="menuText show_hidden_submenu">Products</span>
                    <i class="fa-solid fa-angle-down angle show_hidden_submenu"></i>
                </a>
                <ul class="subMenus">
                    <a href="admin_home.php?add_products"><i class="fa-solid fa-toggle-on mx-2 menuIcons"></i><span class="menuText">Add Products</span></a>
                    <a href="admin_home.php?view_products"><i class="fa-solid fa-toggle-on mx-2 menuIcons"></i><span class="menuText">View Products</span></a>
                </ul>
            </li>
            <li class="li_menu show_hidden_submenu">
                <a href="javascript:void(0);" class="show_hidden_submenu text-decoration-none">
                    <i class="fa-solid fa-truck mx-2 menuIcons show_hidden_submenu"></i>
                    <span class="menuText show_hidden_submenu">Supplier</span>
                    <i class="fa-solid fa-angle-down angle show_hidden_submenu"></i>
                </a>
                <ul class="subMenus">
                    <a href="admin_home.php?add_supplier"><i class="fa-solid fa-toggle-on mx-2 menuIcons"></i><span class="menuText">Add Supplier</span></a>
                    <a href="admin_home.php?suppliers_list"><i class="fa-solid fa-toggle-on mx-2 menuIcons"></i><span class="menuText">View Suppliers</span></a>
                </ul>
            </li>
            <li class="li_menu show_hidden_submenu">
                <a href="javascript:void(0);" class="show_hidden_submenu text-decoration-none">
                    <i class="fa-solid fa-user mx-2 menuIcons show_hidden_submenu"></i>
                    <span class="menuText show_hidden_submenu">User</span>
                    <i class="fa-solid fa-angle-down angle show_hidden_submenu show_hidden_submenu"></i>
                </a>
                <ul class="subMenus">                                    
                    <a href="admin_home.php?all_users"><i class="fa-solid fa-toggle-on mx-2 menuIcons"></i><span class="menuText">User List</span></a>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);">
                    <i class="fa-solid fa-layer-group mx-2 menuIcons show_hidden_submenu"></i>
                    <span class="menuText show_hidden_submenu">Category</span>
                    <i class="fa-solid fa-angle-down angle show_hidden_submenu"></i>
                </a>
                <ul class="subMenus">
                    <a href="admin_home.php?add_category"><i class="fa-solid fa-toggle-on mx-2 menuIcons"></i><span class="menuText">Add Category</span></a>
                    <a href="admin_home.php?view_category"><i class="fa-solid fa-toggle-on mx-2 menuIcons"></i><span class="menuText">View Categories</span></a>
                </ul>
            </li>
            <li class="li_menu show_hidden_submenu">
                <a href="javascript:void(0);" class="show_hidden_submenu text-decoration-none">
                    <i class="fa-solid fa-layer-group mx-2 menuIcons show_hidden_submenu"></i>
                    <span class="menuText show_hidden_submenu">Delivery Brands</span>
                    <i class="fa-solid fa-angle-down angle show_hidden_submenu"></i>
                </a>
                <ul class="subMenus">
                    <a href="admin_home.php?add_brand"><i class="fa-solid fa-toggle-on mx-2 menuIcons"></i><span class="menuText">Add Delivery Brand</span></a>
                    <a href="admin_home.php?view_brand"><i class="fa-solid fa-toggle-on mx-2 menuIcons"></i><span class="menuText">View Delivery Brand</span></a>
                </ul>
            </li>
            <li class="li_menu show_hidden_submenu">
                <a href="javascript:void(0);" class="show_hidden_submenu text-decoration-none">
                    <i class="fa-solid fa-bag-shopping mx-2 menuIcons show_hidden_submenu"></i>
                    <span class="menuText show_hidden_submenu">Order</span>
                    <i class="fa-solid fa-angle-down angle show_hidden_submenu"></i>
                </a>
                <ul class="subMenus">
                    <a href="admin_home.php?all_orders"><i class="fa-solid fa-toggle-on mx-2 menuIcons"></i><span class="menuText">View All Orders</span></a>
                </ul>
            </li>
            <li class="li_menu show_hidden_submenu">
                <a href="javascript:void(0);" class="show_hidden_submenu text-decoration-none">
                    <i class="fa-solid fa-store mx-2 menuIcons show_hidden_submenu"></i>
                    <span class="menuText show_hidden_submenu">Purchase Order</span>
                    <i class="fa-solid fa-angle-down angle show_hidden_submenu"></i>
                </a>
                <ul class="subMenus">
                    <a href="admin_home.php?order_from_supplier"><i class="fa-solid fa-toggle-on mx-2 menuIcons"></i><span class="menuText">Create Order</span></a>
                    <a href="admin_home.php?view_order_from_supplier"><i class="fa-solid fa-toggle-on mx-2 menuIcons"></i><span class="menuText">View Orders</span></a>
                </ul>
            </li>
            <li class="li_menu show_hidden_submenu">
                <a href="javascript:void(0);" class="show_hidden_submenu text-decoration-none">
                    <i class="fa-solid fa-money-bill mx-2 menuIcons show_hidden_submenu"></i>
                    <span class="menuText show_hidden_submenu">Payments</span>
                    <i class="fa-solid fa-angle-down angle show_hidden_submenu"></i>
                </a>
                <ul class="subMenus">
                    <a href="admin_home.php?all_payments"><i class="fa-solid fa-toggle-on mx-2 menuIcons"></i><span class="menuText">All Payment Details</span></a>
                </ul>
            </li>
            <li class="li_menu show_hidden_submenu">
                <a href="admin_home.php?invoice_gen" class="show_hidden_submenu text-decoration-none">
                    <i class="fa fa-dashboard text-light mx-2 menuIcons show_hidden_submenu"></i>
                    <span class="menuText show_hidden_submenu">Invoice</span>
                </a>
            </li>
        </ul>
    </div>
    </div>
        <div class="dashboard_content_container" id="dashboard_content_container">
            <div class="dashboard_topnav">
                <a href="" class="text-decoration-none" id="toggleBtn"><i class="fa-solid fa-bars mx-3 "></i></a>
            </div>
            <div class="dashboard_content">
                <div class="dashboard_content_main">
                    <?php
                    if(isset($_GET['add_category'])) 
                    {
                    include('add_category.php');
                    } 
                    if(isset($_GET['add_brand'])) 
                    {
                    include('add_brand.php');
                    } 
                    if(isset($_GET['add_products'])) 
                    {
                    include('add_products.php');
                    }
                    if(isset($_GET['view_products'])) 
                    {
                    include('view_products.php');
                    }  
                    if(isset($_GET['edit_products'])) 
                    {
                    include('edit_products.php');
                    }
                    if(isset($_GET['trash_products'])) 
                    {
                    include('trash_products.php');
                    }
                    if(isset($_GET['trash_category'])) 
                    {
                    include('trash_category.php');
                    }
                    if(isset($_GET['trash_trainer'])) 
                    {
                    include('trash_trainer.php');
                    }
                    if(isset($_GET['trash_brands'])) 
                    {
                    include('trash_brands.php');
                    }   
                    if(isset($_GET['trash_orders'])) 
                    {
                    include('trash_orders.php');
                    } 
                    if(isset($_GET['view_category'])) 
                    {
                    include('view_category.php');
                    } 
                    if(isset($_GET['view_brand'])) 
                    {
                    include('view_brand.php');
                    }  
                    if(isset($_GET['edit_category'])) 
                    {
                    include('edit_category.php');
                    }  
                    if(isset($_GET['edit_brands'])) 
                    {
                    include('edit_brands.php');
                    }
                    if(isset($_GET['all_orders'])) 
                    {
                    include('all_orders.php');
                    } 
                    if(isset($_GET['all_payments'])) 
                    {
                    include('all_payments.php');
                    } 
                    if(isset($_GET['all_users'])) 
                    {
                    include('all_users.php');
                    }
                    if(isset($_GET['add_trainer'])) 
                    {
                    include('add_trainer.php');
                    }
                    if(isset($_GET['trainers_list'])) 
                    {
                    include('trainers_list.php');
                    }
                    if(isset($_GET['add_bplan'])) 
                    {
                    include('add_bplan.php');
                    }
                    if(isset($_GET['view_bplan'])) 
                    {
                    include('view_bplan.php');
                    }
                    if(isset($_GET['edit_plans'])) 
                    {
                    include('edit_plans.php');
                    }
                    if(isset($_GET['trash_plans'])) 
                    {
                    include('trash_plans.php');
                    }
                    if(isset($_GET['suppliers_list']))
                    {
                        include('suppliers_list.php');
                    }
                    if(isset($_GET['edit_suppliers']))
                    {
                        include('edit_suppliers.php');
                    }
                    if(isset($_GET['trash_suppliers']))
                    {
                        include('trash_suppliers.php');
                    }
                    if(isset($_GET['order_from_supplier']))
                    {
                        include('order_from_supplier.php');
                    }
                    if(isset($_GET['view_order_from_supplier']))
                    {
                        include('view_order_from_supplier.php');
                    }
                    if(isset($_GET['update_p_order']))
                    {
                        include('update_p_order.php');
                    }
                    if(isset($_GET['dashboard']))
                    {
                        include('dashboard.php');
                    }
                    if(isset($_GET['invoice_gen']))
                    {
                        include('invoice_gen.php');
                    }
                ?>
                </div>
            </div>
        </div>
            </div> 

<script>

var sideBarIsOpen = true;

toggleBtn.addEventListener('click',(event)=>{
    event.preventDefault();
    if(sideBarIsOpen)
    {
        dashboard_slidebar.style.width = '8%';
        dashboard_slidebar.style.transition = '0.8s all';
        dashboard_content_container.style.width = '90%';
        dashboard_logo.fontSize = '30%';
        dashboard_text.fontSize = '10px';

        menuIcons = document.getElementsByClassName('menuText');
        for(var i=0; i<menuIcons.length; i++)
        {
            menuIcons[i].style.display='none';
        }
        document.getElementsByClassName('dashboard_list')[0].style.textAlign = 'center';
        sideBarIsOpen = false;
    }
            else
            {
                dashboard_slidebar.style.width = '20%';
                dashboard_content_container.style.width = '80%';
                dashboard_logo.fontSize = '50%';

                menuIcons = document.getElementsByClassName('menuText');
                for(var i=0; i<menuIcons.length; i++)
                {
                    menuIcons[i].style.display='inline-block';
                }
                document.getElementsByClassName('dashboard_list')[0].style.textAlign = 'left';
                sideBarIsOpen = true;
            }
            
            
        });

        //add event to show sub menus
        document.addEventListener('click',function(e){
            
            let clickedE1 = e.target;
            if(clickedE1.classList.contains('show_hidden_submenu'))
            {
                let subMenu = clickedE1.closest('li').querySelector('.subMenus');
                let menuIcons = clickedE1.closest('li').querySelector('.angle');

                //close opened submenu if selects another submenu
                let subMenus = document.querySelectorAll('.subMenus');
                subMenus.forEach((sub)=>{
                    if(subMenu !== sub){
                        sub.style.display='none';
                    }
                });

                
            show_hidden_submenu(subMenu,menuIcons);
            }
        });

        //function for show_hidden_submenu
        function show_hidden_submenu(subMenu,menuIcons)
        {
            
            if(subMenu!=null)
                {
                    if(subMenu.style.display === 'block' )
                    {
                        subMenu.style.display='none';
                        menuIcons.classList.remove('fa-angle-up');
                        menuIcons.classList.add('fa-angle-down');
                        
                    }
                    else
                    {
                        subMenu.style.display='block';
                        menuIcons.classList.remove('fa-angle-down');
                        menuIcons.classList.add('fa-angle-up');
                    } 
                }
        }
</script>
</body>
</html>