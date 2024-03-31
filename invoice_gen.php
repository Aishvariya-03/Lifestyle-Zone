<!doctype html>
<html lang="en">
<head>
<title>Bill Generation</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width" />
<!-- *Note: You must have internet connection on your laptop or pc other wise below code is not working -->
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- bootstrap css and js -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
<!-- JS for jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<div class="row">
<div class="col-lg-12" align="center">
<br>
<h5 align="center">Bill</h5>
<br>
<table class="table table-striped">
<thead>
 <tr>
<th>Order Id</th>
<th>Customer name</th>
<th>Invoice</th>
<th>Action</th>
 </tr>
</thead>
<tbody>
<?php                
$display_query = "SELECT T1.order_id, T1.user_id, T1.invoice_no, T2.fname, T2.contact FROM `user_order` T1 INNER JOIN `user` T2 ON T1.user_id = T2.user_id";            
$results = mysqli_query($conn,$display_query);  
$count = mysqli_num_rows($results);
if($count>0)
{
while($data_row = mysqli_fetch_array($results, MYSQLI_ASSOC))
{
?>
<tr>
                    <td><?php echo $data_row['order_id']; ?></td>
                    <td><?php echo $data_row['user_id']; ?></td>
<td><?php echo $data_row['invoice_no']; ?></td>
<td><?php echo $data_row['fname']; ?></td>
<td><?php echo $data_row['contact']; ?></td>
<td>
<a href="pdf_maker.php?user_id=<?php echo $data_row['user_id']; ?>&ACTION=VIEW" class="btn btn-success"><i class="fa fa-file-pdf-o"></i> View PDF</a> &nbsp;&nbsp;
<a href="pdf_maker.php?user_id=<?php echo $data_row['user_id']; ?>&ACTION=DOWNLOAD" class="btn btn-danger"><i class="fa fa-download"></i> Download PDF</a>
&nbsp;&nbsp;
<a href="pdf_maker.php?user_id=<?php echo $data_row['user_id']; ?>&ACTION=UPLOAD" class="btn btn-warning"><i class="fa fa-upload"></i> Upload PDF</a>
</td>
</tr>
<?php
}
}
?>
</tbody>
</table>
</div>
</div>
</div>
</body>
</html> 

Displaying tcpdf_6_3_2.zip.