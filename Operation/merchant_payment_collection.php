
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
 $obj->insert_merchant_payment($_POST);
  echo "<script>window.location.assign('merchant_payment.php')</script>";
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
            <input type="hidden" name="merchantId" value="<?php echo $_GET['id'] ?>">
            <div class="col-md-6">
              <div class="form-group">
                
                <label>Merchant Name</label>
                <?php 
                if (isset($_GET['id'])) {
                  $merchant_name_by_id = $obj->get_merchent_name_for_payment_by_id($_GET['id']);
                  $m_name_by_id = $merchant_name_by_id->fetch_assoc();
                  }
                 ?>
                <input type="text" name="merchant_name" readonly="" value="<?php echo $m_name_by_id['m_name']; ?>" class="form-control" style="width: 50%">
              </div>
              <div class="form-group">
                <label>Method</label>
               <select name="method" class="form-control" style="width: 50%">
                 <option value="">--Select One--</option>
                 <option value="cash">Cash</option>
                 <option value="bank">Bank</option>
               </select>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-6">

              <!-- /.form-group -->
              <div class="form-group">
                <label>Paid By</label>
                <select name="paid_emp" class="form-control" style="width: 50%">
                  <option value="">--Select One--</option>
                  <?php 
                    $data = $obj->get_emp_name();
                    if (isset($data)) {
                     
                    while ($result = $data->fetch_assoc()) {

                   ?>
                  <option value="<?php echo $result['empID'] ?>"><?php echo $result['emp_name'] ?></option>
                  <?php   
                    }
                     
                    }
                     ?>
                </select>
                
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Ammount</label>
                <input type="text" name="total_amount" value="" class="form-control" style="width: 50%">

              </div>
            </div>

          <?php  ?>

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