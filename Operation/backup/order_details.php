 
<?php
include_once 'header.php';
?>
<!-- Main Sidebar Container Starts here-->
<?php
include_once 'left_menu.php';
?>


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
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Order List</h3>
              <h2>
                <?php 
                    if (isset($_POST['submit'])) {

                    $call_fn = $obj->update_status_and_priority($_POST);
                      if (isset($result)) {
                        echo " jahan";
                      } 
                    }

                ?>
              </h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="" method="post">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">Sl</th>
                      <th>Merchant Name</th>
                      <th>Order Type</th>
                      <th>Pickup Man</th>
                      <th>Delivery Man</th>
                      <th>Recieved By</th>
                      <th>Status</th>
                      <th>Priority</th>
                      <th>Date</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- hidden id for order detail to select data from view>product details -->

                    <?php 
                    $result= $obj->get_orders();
                    $i=1;
                    while ($row=$result->fetch_assoc()) {
                     ?>
                     <tr>
                      <td><?php echo $i++; ?></td>
                      <td><?php echo $row['merchant_name'] ?></td>
                      <td><?php echo $row['order_type'] ?></td>

                      <td>
                        <select name="d_man[]" >
                          <?php 
                  $result_d = $obj->get_delevary_man();
                    
                      while ($data = $result_d->fetch_assoc()) {

                        
                   ?>
                          <option <?php if ($data['dID'] == $row['delivery_man']) {
                            echo "selected";
                          } ?> value="<?php echo $data['dID'] ?> "> <?php echo $data['d_name']; ?></option>

                        <?php } ?>
                        </select>
                      </td>
                      <td>
                        <select name="p_man[]">
                          <?php
                           $result_d = $obj->get_delevary_man();
                           while ($data = $result_d->fetch_assoc()) { ?>
                           <option <?php if ($data['dID'] == $row['pickup_man']) {
                            echo "selected";
                          } ?> value="<?php echo $data['dID'] ?> "> <?php echo $data['d_name']; ?></option>
                        <?php } ?>
                        </select>
                      </td>
                    
                      <td><?php echo $row['received_by'] ?></td>

                      <?php if (isset($row['orderID'])) { 

                        $id=$row['orderID'];

                        $order=$obj->get_status_for_update($id);
                        ?>
                        <td>
                          <input type="hidden" name="orderID[]" value="<?php echo $id ?>">
                          <select name="status[]">

                            <option <?php if ($order['status'] == 'pending') {
                              echo "selected";
                            } ?> value="pending">Pending</option>

                            <option <?php if ($order['status'] == 'received') {
                              echo "selected";
                            } ?> value="received">Received</option>

                            <option <?php if ($order['status'] == 'picked_up') {
                              echo "selected";
                            } ?> value="picked_up">Picked_up</option>

                            <option <?php if ($order['status'] == 'processing') {
                              echo "selected";
                            } ?> value="processing">Processing</option>

                            <option <?php if ($order['status'] == 'delivered') {
                              echo "selected";
                            } ?> value="delivered">Delivered</option>
                          </select>
                        </td>
                        <td>
                          <select name="priority[]">
                            <option <?php if ($order['priority']=="normal") {
                              echo "selected";
                            } ?> value="normal">Normal</option>
                            <option <?php if ($order['priority']=="medium") {
                              echo "selected";
                            } ?> value="medium">Medium</option>
                            <option <?php if ($order['priority']=="emergency") {
                              echo "selected";
                            } ?> value="emergency">Emergency</option>
                          </select>
                        </td>
                      <?php } ?>
                      <td><?php echo $row['date'] ?></td>

                      <td><a href="order_view.php?id=<?php echo $row['orderID'] ?>" class="btn btn-sm btn-info">View</a></td> 
                    </tr>
                  <?php }?>

                </tbody>
              </table>
              <div class="d-flex justify-content-center">
                
              
              <input type="submit" name="submit" class="btn btn-sm   btn-success " value="UPDATE">
              </div>
            </form>
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
<!-- /.content-wrapper -->
<?php include_once 'footer.php'; ?>