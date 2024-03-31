<?php
$username = $_SESSION['username'];

include('po_status_graph_pie.php');
include('supplier_product_bar.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeStyle Zone</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="admin.css?v=<?= time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

    <style>
        @import url('http://fonts.googleapis.com/css2?family=Spartan:wght@100;200;300;400;500;600;700;800;900&display=swap');

        body {
            font-family: 'Spartan', sans-serif;
            margin: 0;
            padding: 0;
        }
        .col70{
            width:70%;
        }
        .dashboard_content_main{
            display:flex;
            flex-direction:row;
        }

        /* Add your CSS styles here */
        /* ... */
    </style>
</head>

<body>
    <div class="dashboard-content text-center m-auto">
        <div class="dashboard_content_main">
            <div class="col70 m-5 m-auto">
                <figure class="highcharts-figure">
                    <div id="container"></div>
                    <p class="highcharts-description text-center m-1">
                        Here is breackdown of Purchase Orders by Status
                    </p>
                </figure>
            </div>
            <div class="col70 m-5">
                <figure class="highcharts-figure">
                    <div id="container_bar"></div>
                    <p class="highcharts-description text-center">
                        Here is breackdown of Purchase Orders by Status
                    </p>
                </figure>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            var graphData = <?= json_encode($results)?>;
            //for pie chart
            Highcharts.chart('container', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Purchase Orders By Status'
                },
                tooltip:
                    {
                        format: function(){
                                var point=this,
                                series=point.series;
                                return `<b>${point.name}</b>:${$point.y}`
                            }},
                plotOptions: {
                    series: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: [{
                            enabled: true,
                            distance: 20
                        }, {
                            enabled: true,
                            distance: -40,
                            format: '{point.y}',
                            style: {
                                fontSize: '1.2em',
                                textOutline: 'none',
                                opacity: 0.7
                            },
                            filter: {
                                operator: '>',
                                property: 'percentage',
                                value: 10
                            }
                        }]
                    }
                },
                series: [{
                    name: 'Status',
                    colorByPoint: true,
                    data: graphData
                }]
            });


            var barGraphData = <?= json_encode($bar_chart_data)?>;
            var barGraphCategory = <?= json_encode($categories)?>;
            //for bar graph
            Highcharts.chart('container_bar', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Products Assigned To Supplier',
                },
                xAxis: {
                    categories: barGraphCategory,
                    crosshair: true,
                    accessibility: {
                        description: 'Suppliers'
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Number of Productss'
                    }
                },
                tooltip: {
                    format: function()
                    {
                        var point = this,
                        series = point.series;
                        return `<b>${point.category}</b>: ${$point.y}`
                    }
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [
                    {
                        name: 'Suppliers',
                        data: barGraphData
                    }
                ]
            });

        });
    </script>

    <style>
        @import url('http://fonts.googleapis.com/css2?family=Spartan:wght@100;200;300;400;500;600;700;800;900&display=swap');

        body {
            font-family: 'Spartan', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Add your CSS styles here */
        .dashboard_slidebar .logo {
            width: 50%;
            height: 50%;
            object-fit: contain;
            margin-top: 5px;
        }

        #dashboardContainer {
            display: flex;
            flex-direction: row;
        }

        .image {
            background-color: azure;
            margin-top: 5px;
        }

        .image span {
            font-size: 16px;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .dashboard_slidebar {
            width: 18%;
            height: auto;
        }

        .dashboard_content_container {
            width: 70%;
        }

        .dashboard_slidebar_menu {
            text-decoration: none;
        }

        ul.dashboard_list {
            padding: 10px;
            margin-top: 10px;
            margin-left: 0px;
            text-decoration: none;
            list-style: none;
            text-align: left;
        }

        ul.dashboard_list li {
            text-align: left;
        }

        ul.dashboard_list li a {
            text-decoration: none;
            color: azure;
            display: block;
            padding: 10px;
            font-size: 14px;
        }

        ul.dashboard_list li:hover {
            background: black;
            border-radius: 5px;
        }

        .dashboard_topnav a {
            color: #848383;
            font-size: 18px;
        }

        ul.dashboard_list li.list {
            background: black;
            border-radius: 5px;
        }

        .subMenus {
            display: none;
        }

        .angle {
            float: right;
            font-size: 10px;
            margin-top: 7px;
        }

        .nav-item {
            display: block;
        }
    </style>
</body>

</html>

