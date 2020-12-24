<?php 
include_once 'header.php';
if (isset($_POST['product_name'])) {
  $obj->insert_stock($_POST);
}
$result=$obj->data_for_stock_report();
?>
<?php
include_once 'left_menu.php';
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Stock Report</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Stock</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form action="" method="post"> 

            <div class="card card-primary">

              <div class="card-header">
                <h3 class="card-title">Stock Report</h3>
              </div>
              <div class="card-body">
              <table class="table table-bordered table-striped">
              <tr>
              <td>Order ID</td>
              <td>Stock In Date</td>
              <td>Stock Out Date</td>
              <td>Total Stock</td>
              <td>Wastage</td>
              <td>Replacement</td>
              <td>Action</td>
              </tr>
<?php while ($data=$result->fetch_assoc()) { ?>
              <tr>
                <td><?php echo $data['orderID']?></td>
                <td><?php echo $data['stock_in_date']?></td>
                <td><?php echo $data['stock_out_date']?></td>
                <td><?php echo $data['total_stock']?></td>
                <?php if ($data['wastage']==NULL) { ?>
                <td><?php echo 0 ?></td>
                <?php } else { ?>
                <td><?php echo $data['wastage']?></td> 
                <?php } ?>

                <?php if ($data['replacement']==NULL) { ?>
                <td><?php echo 0 ?></td>
                <?php } else { ?>
                <td><?php echo $data['replacement']?></td> 
                <?php } ?>
                <td class="btn btn-info btn-xs"><a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=view"></a>View</td>
               
              </tr>
<?php } ?>
              </table>
              </div>
              
              <!--  <hr> -->


            </div>
            <!-- </div> -->
          </form>
        </div>


        
      </div>
    </div>
  </section>
</div>



<?php include_once 'footer.php'; ?>
<script>



  
</script>