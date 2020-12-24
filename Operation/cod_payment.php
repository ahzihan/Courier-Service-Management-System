
<?php
include_once 'header.php';
?>
<!-- Main Sidebar Container Starts here-->
<?php
include_once 'left_menu.php';
?>
<!-- Main Sidebar Container Ends here-->
<?php

if (isset($_POST['submit'])) {
  $obj->insert_payment_collection($_POST);
  echo "<script>window.location.assign('cod_collection.php')</script>";
}


?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 style="color: gray">Cash on Delivery Collection</h1>
        </div>
        <div class="col-sm-6">
          
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- SELECT2 EXAMPLE -->
      <div class="card card-default">
        <div class="card-header">
          

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form action="" method="post">
            
          <div class="row">
            <?php 
                $data = $obj->get_cod_collection_by_orderID($_GET['id']);
                while ($result =$data->fetch_assoc()) {

                 ?>
            <div class="col-md-6">
              <div class="form-group">
                <label>Merchant Name</label>
                <input type="text" name="merchant_name" readonly="" value="<?php echo($result['m_name'])  ?>" class="form-control" style="width: 50%">
              </div>
              <div class="form-group">
                <label>OrderId</label>
               
                <input type="text" name="order_id" readonly="" value="<?php echo $result['orderID'] ?>" class="form-control" style="width: 50%">
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-6">

              <!-- /.form-group -->
              <div class="form-group">
                <label>Paid By</label>
                <input type="text" name="paid_d_name" readonly="" value="<?php echo $result['delivery_man'] ?>" class="form-control" style="width: 50%">
                <input type="hidden" name="paymentBy" value="<?php echo $result['paymnentBy'] ?>">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Ammount</label>
                <input type="text" name="total_amount" readonly="" value="<?php echo $result['total_price'] ?>" class="form-control" style="width: 50%">

              </div>
            </div>
          <?php } ?>
          </div>
          <div class="row justify-content-md-center">
            <input type="submit" name="submit" value="Submit" class="btn btn-success btn-md" >
          </div>
        </form>
        </div>

      </div>

    </div>
  </section>
  
</div>

<?php include_once 'footer.php'; ?>