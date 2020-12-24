
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
                <div class="row justify-content-md-center">
                  <div><h3 style="color: gray">Merchant Ledger </h3></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-6">
                    <style>
                      .merchant_info{
                        font-size: 20px;
                        font-family: Arial, Helvetica, sans-serif;
                        color: gray;
                      }
                    </style>
                    <table>
                      <?php 
                      $merchant_info = $obj->get_merchant_info($_GET['id']);
                      $merchent_data = $merchant_info->fetch_assoc();
                       ?>
                      <tr>
                        <td class="merchant_info">Merchant Name : </td>
                        <td class="merchant_info"><?php echo $merchent_data['m_name'] ?></td>
                      </tr>
                      <tr>
                        <td class="merchant_info">Merchant Address : </td>
                        <td class="merchant_info"><?php echo $merchent_data['m_address'] ?></td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <table>
                      <tr>
                        <td class="merchant_info">Merchant Email :</td>
                        <td class="merchant_info"><?php echo $merchent_data['m_email'] ?></td>
                      </tr>
                      <tr>
                        <td class="merchant_info">Merchant Phone :</td>
                        <td class="merchant_info"><?php echo $merchent_data['m_phone'] ?></td>
                      </tr>
                    </table>
                  </div>
                </div>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <?php 
                  $id = $_GET['id'];
                  $sum_total = 0;
                  $data = $obj->get_merchant_ledger($id);
                  $rowcount=mysqli_num_rows($data); 
                  while ($result = $data->fetch_assoc()) {

                    $sum_total += $result['total_fee'];
                  }
                  ?>
                  <tr>
                    <td rowspan="<?php echo $rowcount+1 ?>" style ="vertical-align : middle;text-align:center;">Payable </td>
                    <td class="bg-info">Order Id</td>
                    <td class="bg-info">Date</td>
                    <td class="bg-info">Fee</td>
                    <td class="bg-info">Extra charge</td>
                    <td class="bg-info">Sub Total</td>
                    <td rowspan="<?php echo $rowcount+1 ?>" style ="vertical-align : middle;text-align:center;" >Total Fee:
                    <span class=""><?php echo $sum_total ?></span> 
                    </td>

                  </tr>
                  <?php 
                      $data = $obj->get_merchant_ledger($id);
                    while ($result = $data->fetch_assoc()) {
                   ?>
                  <tr>
                    
                    <td><?php echo $result['orderID']; ?></td>
                    <td><?php echo $result['date']; ?></td>
                    <td><?php echo $result['fee']; ?></td>
                    <td><?php echo $result['extra_charge']; ?></td>
                    <td><?php echo $result['total_fee']; ?></td>
                  </tr>
                  <?php 
                   }
                   ?>
<!-- paid secton in ledger section -->
                <?php 
                $data = $obj->get_merchant_paid($_GET['id']);
                $paid_row_count = mysqli_num_rows($data);
                $total_paid_amount = 0;
                while ($paid_data = $data->fetch_assoc()) {
                  $total_paid_amount += $paid_data['amount'];
                }
                 ?>
                  <tr>
                    <td rowspan="<?php echo $paid_row_count+1 ?>" style ="vertical-align : middle;text-align:center;">Paid</td>
                    <td class="bg-success" colspan="2">Date</td>
                    <td class="bg-success" colspan="2">Amount</td>
                    <td class="bg-success">Method</td>
                    <td rowspan="<?php echo $paid_row_count+1; ?>" style ="vertical-align : middle;text-align:center;">Total Paid : <?php echo $total_paid_amount; ?></td>
                  </tr>
                  <?php  
                  $data = $obj->get_merchant_paid($_GET['id']);

                  while ($paid_data = $data->fetch_assoc()) {
                    
                  
                  ?>
                  <tr>
                    <td colspan="2"><?php echo $paid_data['date']; ?></td>
                    <td colspan="2"><?php echo $paid_data['amount']; ?></td>
                    <td><?php echo $paid_data['method'];?></td>
                    
                  </tr>
                  <?php } ?>
                  <tr>
                    <td colspan="6" style="padding-left: 50px">Due</td>
                    <td style="text-align: center;"><?php echo ($sum_total - $total_paid_amount); ?></td>
                  </tr>

                </table>
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