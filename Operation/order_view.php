
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

<style>
 @media only print {
        footer,header,#print_btn,#back_btn {
            display:none;
        }
    } 
</style>
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
<?php 
  $view_data = $obj->product_details($order_id);
     if (isset($view_data)) {
    $view = $obj->product_details($order_id);
    $result = $view->fetch_assoc();
    if ($result['order_type'] == 'Cash on Delivery') {
    
 ?>
          
<div class="invoice container" id="print_area">
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-10 offset-md-1">
          <div class="company_info">
            <div class="card">
              <div class="card-header ">
                <div class="row">
                  <div class="col-md-3">
                    <img src="../img/logo.png" style="max-height:100px; min-width: 100px">
                  </div>
                  <div class="col-md-6">
                    <div class="company_info">
                      <?php
                        $general=$obj->general();
                        $general_info=$general->fetch_assoc();
                      ?>
                      <div>
                        <h3><?php echo $general_info['company_name'] ?></h3>
                      </div>
                      <div>
                        <span><?php echo $general_info['address'] ?></span>
                      </div>
                      <div>
                        <span><?php echo $general_info['phone'] ?></span>
                      </div>
                      <div>
                        <span><?php echo $general_info['email'] ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                      <?php
                     $view = $obj->product_details($order_id);
                     $result = $view->fetch_assoc();
                     $barcodeTest=trim($result['orderID']);
                     $printText=true;
                     echo '<img style="padding-top:20px; display:flex" class="barcode" alt="'.$barcodeTest.'" src="barcode.php?text='.$barcodeTest.'&print='.$printText.'"/>  ';
                     echo '<span style="padding-left:20px; display:flex; font-size:12px;">'.$_GET['id'].'</span>';
                    ?>
                  </div>
                </div>
                

              </div>
              <div class="card-body">
                <table class="table">
                  
                  <tbody>
                      <?php 
                        $view_data = $obj->product_details($order_id);
                        if (isset($view_data)) {
                        
                        $view = $obj->product_details($order_id);
                        $result = $view->fetch_assoc();
                        ?> 
                        <tr>
                          <td>Order Id : <?php echo $result['orderID'] ?></td>
                          <td>Date : <?php echo $result['date'] ?></td>
                          <td>Order Type : <?php echo $result['order_type'] ?></td>

                        </tr>
                        
                    </tbody>
                </table>
                <div class="row">
                  <div class="col-md-6">
                    <h4>Pick Up Address</h4>
                    <div><?php echo $result['pickup_address'] ?></div>
                  </div>
                  <div class="col-md-6">
                    <h4>Delivery Address</h4>
                    <div><?php echo $result['delivery_address'] ?></div>
                  </div>

                </div>
                <?php } ?>
                <hr>
                  <span style="margin: 5px 0px; font-size: 18px; font-weight: 700; display: block;">Product Details</span>
                <table class="table table-bordered">
                <thead>                  
                  <tr>
                    <th style="width: 10px">Sl</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Weight</th>
                    <th>Extra Charge</th>
                    <th>Price</th>
                  </tr> 

                </thead>
                <tbody>
                  <?php 
                  $i = 1;
                  $fee_sum = 0;
                  $price_sum = 0;
                  $extra_charge = 0;
                  $view_data = $obj->product_details($order_id);
                  while ($data = $view_data->fetch_assoc()) {

                   ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td> <?php echo $data['product'] ?></td>
                    <td> <?php echo $data['category_name'] ?></td>
                    <td> <?php echo $data['qty'] ?></td>
                    <td> <?php echo $data['wieght'] ?></td>
                    <td> <?php echo $data['extra_charge'] ?></td>
                    <td> <?php echo $data['price'] ?></td>
                    
                  </tr>
                  
                  <?php 
                  $fee_sum  = floatval($data['fee']);
                  $price_sum += floatval($data['price']);
                  $extra_charge += floatval($data['extra_charge']);


                    }
                  $grand_total_for_delivery = $fee_sum  + $extra_charge;

                   ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="6" style="padding-right: 15px; font-weight: 700; text-align: right">Sub Total</td>
                    <td><?php echo $price_sum ?></td>
                  </tr>
                  <tr>
                    <td colspan="6" style="padding-right: 15px; font-weight: 700; text-align: right">Delivary Charge</td>
                    <td><?php echo $fee_sum ?></td>
                  </tr>
                  <tr>
                    <td colspan="6" style="padding-right: 15px; font-weight: 700; text-align: right">Extra charge</td>
                    <td><?php echo $extra_charge ?></td>
                  </tr>
                  <tr>
                    <td colspan="6" style="padding-right: 15px; font-weight: 700; text-align: right">Grand Total</td>
                    <td colspan="1" style="padding-right: 15px; font-weight: 700; text-align: center"><?php echo $grand_total_for_delivery ?></td>
                  </tr>
                </tfoot>
              </table>
            </div>
        </div>
      <div class="text-center mt-2">
        <a href="javascript:history.go(-1)" class="btn btn-primary" id="back_btn" >Back</a>
        <a href="" class="btn btn-success" id="print_btn" onclick="window.print()">Print</a>
                        

        </div>
      </div>

 
        </div>
</div>
</div>
</div>


<?php
 }
   else{ ?>

  <!--start code for only deleivery -->

<div class="invoice container" id="print_area">
    <div class="row">
      <div class="container-fluid">
        <div class="col-md-10 offset-md-1">
          <div class="company_info">
            <div class="card">
              <div class="card-header ">
                <div class="row">
                  <div class="col-md-3">
                    <img src="../img/logo.png" style="max-height:100px; min-width: 100px">
                  </div>
                  <div class="col-md-6">
                    <div class="company_info">
                      <?php
                        $general=$obj->general();
                        $general_info=$general->fetch_assoc();
                      ?>
                      <div>
                        <h3><?php echo $general_info['company_name'] ?></h3>
                      </div>
                      <div>
                        <span><?php echo $general_info['address'] ?></span>
                      </div>
                      <div>
                        <span><?php echo $general_info['phone'] ?></span>
                      </div>
                      <div>
                        <span><?php echo $general_info['email'] ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                      <?php
                     $view = $obj->product_details($order_id);
                     $result = $view->fetch_assoc();
                     $barcodeTest=trim($result['orderID']);
                     $printText=true;
                     echo '<img style="padding-top:20px; display:flex" class="barcode" alt="'.$barcodeTest.'" src="barcode.php?text='.$barcodeTest.'&print='.$printText.'"/>  ';
                     echo '<span style="padding-left:20px; display:flex; font-size:12px;">'.$_GET['id'].'</span>';
                    ?>
                  </div>
                </div>
                

              </div>
              <div class="card-body">
                <table class="table">
                  
                  <tbody>
                      <?php 
                        $view_data = $obj->product_details($order_id);
                        if (isset($view_data)) {
                        
                        $view = $obj->product_details($order_id);
                        $result = $view->fetch_assoc();
                        ?> 
                        <tr>
                          <td>Order Id : <?php echo $result['orderID'] ?></td>
                          <td>Date : <?php echo $result['date'] ?></td>
                          <td>Order Type : <?php echo $result['order_type'] ?></td>

                        </tr>
                        
                    </tbody>
                </table>
                <div class="row">
                  <div class="col-md-6">
                    <h4>Pick Up Address</h4>
                    <div><?php echo $result['pickup_address'] ?></div>
                  </div>
                  <div class="col-md-6">
                    <h4>Delivery Address</h4>
                    <div><?php echo $result['delivery_address'] ?></div>
                  </div>

                </div>
                <?php } ?>
                <hr>
                  <span style="margin: 5px 0px; font-size: 18px; font-weight: 700; display: block;">Product Details</span>
                <table class="table table-bordered">
                <thead>                  
                  <tr>
                    <th style="width: 10px">Sl</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Weight</th>
                    <th>Extra Charge</th>
                  </tr> 

                </thead>
                <tbody>
                  <?php 
                  $i = 1;
                  $fee_sum = 0;
                  $price_sum = 0;
                  $extra_charge = 0;
                  $view_data = $obj->product_details($order_id);
                  while ($data = $view_data->fetch_assoc()) {

                   ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td> <?php echo $data['product'] ?></td>
                    <td> <?php echo $data['category_name'] ?></td>
                    <td> <?php echo $data['qty'] ?></td>
                    <td> <?php echo $data['wieght'] ?></td>
                    <td> <?php echo $data['extra_charge'] ?></td>
                    
                  </tr>
                  
                  <?php 
                  $fee_sum  = floatval($data['fee']);
                  $price_sum = floatval($data['price']);
                  $extra_charge += floatval($data['extra_charge']);


                    }
                  $grand_total_for_delivery = $fee_sum  + $extra_charge;

                   ?>
                </tbody>
                <tfoot>
                  
                  <tr>
                    <td colspan="5" style="padding-right: 15px; font-weight: 700; text-align: right">Delivary Charge</td>
                    <td><?php echo $fee_sum ?></td>
                  </tr>
                  <tr>
                    <td colspan="5" style="padding-right: 15px; font-weight: 700; text-align: right">Extra charge</td>
                    <td><?php echo $extra_charge ?></td>
                  </tr>
                  <tr>
                    <td colspan="5" style="padding-right: 15px; font-weight: 700; text-align: right">Grand Total</td>
                    <td colspan="1" style="padding-right: 15px; font-weight: 700; text-align: center"><?php echo $grand_total_for_delivery ?></td>
                  </tr>
                </tfoot>
              </table>
            </div>
        </div>
      <div class="text-center mt-2">
        <a href="javascript:history.go(-1)" class="btn btn-primary" id="back_btn" >Back</a>
        <a href="" class="btn btn-success" id="print_btn" onclick="window.print()">Print</a>
       
                        

        </div>
      </div>

 
        </div>
</div>
</div>
</div>
<!-- end code for only delevary -->
<?php }
  }
 ?>
      </div>
      <!-- /.row -->

    </div><!-- /.container-fluid -->
  </section>

  <!-- /.content -->
</div>

<?php } ?>

<!-- /.content-wrapper -->
<?php include_once 'footer.php'; ?>
