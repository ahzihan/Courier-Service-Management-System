<?php
include_once 'header.php';
  ?>
  <!-- Main Sidebar Container Starts here-->
  <?php
include_once 'left_menu.php';
  ?>
  <!-- Main Sidebar Container Ends here-->


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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Bordered Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th>Sl</th>
                      <th>Merchant Name</th>
                      <th>OrderId</th>
                      <th>Total Price</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $i = 1;
                    $data = $obj->get_cod_collection();
                    while ($result =$data->fetch_assoc()) {

                     ?>
                    <tr>
                      <td><?php echo $i++; ?></td>
                      <td><?php echo $result['m_name'] ?></td>
                      <td><?php echo $result['orderID'] ?></td>
                      <td><?php echo $result['total_price'] ?></td>
                      <td><?php 
                    /*for payment status data fatch*/
                      $data_fetch_for_status = $obj->get_payment_status($result['orderID']);
                      $amount_status = $data_fetch_for_status->fetch_assoc();
                      if (isset($amount_status['amount'])) {
                        echo "paid";
                      }else{
                        echo "due";
                      }

                       ?></td>
                      <td>
                        <a href="cod_payment.php?id=<?php echo $result['orderID']?>" class="btn btn-sm btn-primary <?php if (isset($amount_status['amount']))  echo "disabled"  ?>">Collect</a>
                      </td>
                      
                    </tr>
                    <?php 
                  }
                     ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                
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