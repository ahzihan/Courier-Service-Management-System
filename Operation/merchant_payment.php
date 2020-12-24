
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
      <div class="row">   <div class="col-md-12">
     
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Fee Collection Details</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="" method="post">

                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">Sl</th>
                      <th>Merchant Name</th>
                      <th>Total Fee</th>
                      <th>Paid</th>
                      <th>Due</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i=1;
                      $data=$obj->merchant_payment_collection();
                      while($result=$data->fetch_assoc()){
                      $merchant_payment_collect = $obj->merchant_payment($result['merchantID']);
                      $m_payment = $merchant_payment_collect->fetch_assoc();
                    ?>
                    <tr>
                      <td><?php echo $i++; ?></td>
                      <td><?php echo $result['m_name'] ?></td>
                      <td><?php echo $result['total_price'] ?></td>
                      <td><?php echo $m_payment['paid'] ?></td>
                      <td><?php echo $result['total_price'] - $m_payment['paid'] ?></td>
                      <td>
                        <a href="merchant_payment_view.php?id=<?php echo $result['merchantID']; ?>" class="btn btn-primary btn-sm">View</a>
                        <a href="merchant_payment_collection.php?id=<?php echo $result['merchantID']; ?>" class="btn btn-primary btn-sm">Collect</a>
                      </td>
                    </tr>
                    <?php    
                      } ?>
                  </tbody>
                </table>
              </form>
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