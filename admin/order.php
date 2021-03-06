
<?php
include_once 'header.php';
if (isset($_POST['searchsubmit'])) {
$result = $obj->check_report($_POST);
}

?>      
<?php
        include_once 'left_menu.php';
?>
<div class="content-wrapper">
<div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1 class="m-0 text-dark">Order Report</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Order Report</li>
</ol>
</div>
</div>
</div>
</div>
<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header bg-primary">
<h3 class="card-title">Report</h3>
</div>
<div class="card-body">
<form action="" method="POST" >
<table class="serch_form">
    <tr>
        <td>
            <div class="form-group">
                <select name="delivery_id" class="form-control">
                    <option value="">Select Delivery Man</option>
                    <?php
                    $result2=$obj->get_delivery();
                    while ($row1 = $result2->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row1['delivery_man']; ?>"><?php echo $row1['d_name']; ?></option>
                    <?php }?>
                </select>
            </div>
        </td>
        <td>
            <div class="form-group">
                <input type="date" class="form-control"id="startdate" name="startdate" placeholder="Start-date">
            </div>
        </td>
        <td>
           <label><span style="padding: 10px;"><strong>TO</strong></span></label> 
       </td>
       <td>
        <div class="form-group">
            <input type="date" class="form-control" id="enddate" name="enddate" placeholder="End-date">
        </div>
    </td>
    <td>
        <div class="form-group">
            <input type="submit" class="btn btn-secondary" name="searchsubmit" value="Search">
        </div>
    </td>
</tr>
</table>
</form>
<?php
if (isset($_POST['searchsubmit'])) {
if ($result->num_rows > 0) {
$t_order= mysqli_num_rows($result);

?>
<table id="myTable" class="table table-bordered">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Date</th>
            <th>FeedBack</th>
            <th>Delivery Address</th>
            <th>Fee</th>
        </tr>
    </thead>

    <tbody>
        <?php 
        $fee=0;
        while ($row = $result->fetch_assoc()) {
            $fee+=$row['fee'];
            ?>

            <tr>
                <td><?php echo $row['orderID']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['feedback']; ?></td>
                <td><?php echo $row['delivery_address']; ?></td>
                <td><?php echo $row['fee']; ?></td>
            </tr> 


        <?php } ?>
        <tr>
            <th colspan=3 rowspan=2></th>
            <th><?php 
            $d_name='';
            $result3=$obj->get_delivery();
            while ($row3 = $result3->fetch_assoc()) { 
                $d_name=$row3['d_name'] ;
                
            } 
            echo "Name : ".$d_name;
            ?> 

        </th>
        <th>
            <p>Total Orders: <?php echo $t_order?> </p>
        </th>
    </tr>
    <tr>
        <th>Total Fees</th>
        <th><?php echo $fee?></th>
        
    </tr>
    <tr>
        <td colspan="4"></td>
        <td>

            <form class="d-print-none"><input class="btn btn-danger" type="submit" value="Print" onClick="window.print()"></form>
        </td>
    </tr>
<?php } else {?>

</tbody>
<div class='alert alert-warning col-sm-6 ml-5 mt-2' role='alert'> No Records Found ! </div>
<?php
}
}
?>
</table>

</div>

</div>
</div>
</div>
</div>
</div>
</div>
</section>
</div>
<?php include_once 'footer.php'; ?>