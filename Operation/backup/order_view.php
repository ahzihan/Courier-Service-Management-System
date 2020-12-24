
<?php
include_once 'header.php';
?>
<!-- Main Sidebar Container Starts here-->
<?php
include_once 'left_menu.php';
?>
<?php 
  if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
  
 ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Bill To </h3>
                </div>
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Bill To</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-md-8">
              <div class="card">
                <div class="card-header ">
                  <h3 class="card-title">INVOICE</h3>
                  <table class="table table-bordered">
                    <thead class="bg-info">
                      <tr>
                        <th>Order Id</th>
                        <th>Date</th>
                        <th>Order Type</th>
                        <th>Picked up Address</th>
                        <th>Delivery Address</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $view_data = $obj->product_details($order_id);
                        if (isset($view_data)) {
                        $data = $view_data->fetch_assoc();
                        $view = $obj->product_details($order_id);
                        $result = $view->fetch_assoc();
                       ?>
                      <tr>
                        <td><?php echo $data['orderID'] ?></td>
                        <td><?php echo $data['date']?></td>
                        <td> <?php echo $result['order_type'] ?></td>
                        <td> <?php echo $result['pickup_address'] ?></td>
                        <td> <?php echo $result['delivery_address'] ?></td>

                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
                <div class="card-body">

                </div>
              </div>
            </div>
            
          </div>


          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Bordered Table</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
              <table class="table table-bordered">
                <thead>                  
                  <tr>
                    <th style="width: 10px">Sl</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Weight</th>
                    <th>Fee</th>
                    <th>Extra Charge</th>
                    <th>Total Fee</th>
                    <th>Bar code no</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $i = 1;
                  $view_data = $obj->product_details($order_id);
                  while ($data = $view_data->fetch_assoc()) {

                   ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td> <?php echo $data['product'] ?></td>
                    <td> <?php echo $data['category_name'] ?></td>
                    <td> <?php echo $data['qty'] ?></td>
                    <td> <?php echo $data['wieght'] ?></td>
                    <td> <?php echo $data['fee'] ?></td>
                    <td> <?php echo $data['extra_charge'] ?></td>
                    <td> <?php echo $data['total_fee'] ?></td>
                    <td> <?php echo $data['code'] ?></td>
                    
                  </tr>
                  <?php 
                    }
                   ?>
                  
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="#">«</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">»</a></li>
              </ul>
            </div>
          </div>

        </div>
      </div>
      <!-- /.row -->

    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<?php } ?>
<!-- /.content-wrapper -->
<?php include_once 'footer.php'; ?>

<script>
  window.print()
</script>