
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
  $obj->insert_fee($_POST);
}
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 style="color: gray">Payment Collection</h1>
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
          <h3 class="card-title" style="color: gray; display: inline-block">Merchant Name : 
            <?php
            $m_name=$obj->get_merchant_info($_GET['id']);
            $m_name_result=$m_name->fetch_assoc();
            ?>
            <span><?php echo $m_name_result['m_name']?></span>
          </h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form action="" method="post">
            <input type="hidden" name="mID" value="<?php echo $_GET['id']; ?>">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Payment Method</label>
                <select class="form-control select2" style="width: 50%;" name="payment_method">
                  <option>--Select One--</option>
                  <option value="Bank">Bank </option>
                  <option value="Cash">Cash</option>
                  
                </select>
              </div>
              <div class="form-group">
                <label>Due</label>
                <?php
                  $id = $_GET['id'];
                  $sum_total = 0;
                  $total_paid_amount = 0;
                  $data = $obj->get_merchant_ledger($id);

                  while ($result = $data->fetch_assoc()) {

                    $sum_total += $result['total_fee'];
                  }
                  $data1 = $obj->get_merchant_paid($id);
                  while ($paid_data = $data1->fetch_assoc()) {
                  $total_paid_amount += $paid_data['amount'];
                }
                  $due=$sum_total-$total_paid_amount;

                ?>
                <input type="text" name="due" readonly="" value="<?php echo $due;  ?>" class="form-control" style="width: 50%">
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-6">

              <!-- /.form-group -->
              <div class="form-group">
                <label>Collected By</label>
                <select class="form-control select2" style="width: 50%;" name="collected_by">
                  <option>--Select One--</option>
                  <?php
                  $emp_name=$obj->get_emp_name();
                  while ($result_emp_name=$emp_name->fetch_assoc()) {
                  ?>
                  <option value="<?php echo $result_emp_name['empID'] ?>"><?php echo $result_emp_name['emp_name'] ?></option>
                <?php  } ?>
                </select>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Ammount</label>
                <input type="text" name="amount" class="form-control" style="width: 50%">
              </div>
            </div>
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