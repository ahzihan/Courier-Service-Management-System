
<?php
include_once 'header.php';
?>
<!-- Main Sidebar Container Starts here-->
<?php
include_once 'left_menu.php';
?>
<?php 
  if (isset($_GET['view_order'])) {
    $order_id = $_GET['view_order'];
  
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
<?php 
  $view_data = $obj->get_order_details_sheet($order_id);
     if (isset($view_data)) {
    $view = $obj->get_order_details_sheet($order_id);
    $result = $view['first']->fetch_assoc();
    if ($result['order_type'] == 'Cash on Delivery') {
    
 ?>
          
<div class="invoice container">
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
                      <div>
                        <h5>Customer Name: <?php echo $result['customer_name'] ?></h5>
                      </div>
                      <div>
                        <span>phone:<?php echo $result['customer_phone'] ?></span>
                      </div>
                      
                    </div>
                  </div>
                  <div class="col-md-3">
                    <img src="../img/barcode.png" style="max-height: 100px; min-width: 100px">
                  </div>
                </div>
                

              </div>
              <div class="card-body">
                <table class="table">
                  
                  <tbody>
                     <?php 
                         $result= $obj->get_order_details_sheet($order_id);
                         $row = $result['first']->fetch_assoc();
                       ?>
                        <tr>
                          <td>Order Id :<?php echo $order_id ?></td>
                          <td>Date : <?php echo $row['date'] ?></td>
                          <td>Order Type : <?php echo $row['order_type'] ?></td>

                        </tr>
                        
                    </tbody>
                </table>
                <div class="row">
                  <div class="col-md-6">
                    <h4>Pick Up Address: <?php echo $row['pickup_address'] ?></h4>
                    <div></div>
                  </div>
                  <div class="col-md-6">
                    <h4>Delivery Address: <?php echo $row['delivery_address'] ?></h4>
                    <div></div>
                  </div>

                </div>
               
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
                    <th>Unit Price</th>
                  </tr> 

                </thead>
                <tbody>
                  
                  <?php 
                  $i = 1;
                  $fee_sum = 0;
                  $price_sum = 0;
                  $extra_charge = 0;
                  $view_data = $obj->get_order_details_sheet($order_id);
                  while ($data = $view_data['second']->fetch_assoc()) {

                   ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td> <?php echo $data['product_name'] ?></td>
                    <td> <?php echo $data['category_name'] ?></td>
                    <td> <?php echo $data['qty'] ?></td>
                    <td> <?php echo $data['wieght'] ?></td>
                    <td> <?php echo $data['extra_charge'] ?></td>
                    <td> <?php echo $data['price'] ?></td>
                    
                  </tr>
                  
                  <?php 
                  $fee_sum  = floatval($data['delivery_fee']);
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
                    <td colspan="6" style="padding-right: 15px; font-weight: 700; text-align: right">Total Delivery Charge</td>
                    <td colspan="1" style="padding-right: 15px; font-weight: 700; text-align: center"><?php echo $grand_total_for_delivery ?></td>
                  </tr>
                </tfoot>
              </table>
            </div>
        </div>
      <div class="text-center mt-2"><a href="" class="btn btn-success" id="print_btn" onclick="window.print()">Print</a>
                        <!-- <script type="text/javascript">window.print()</script> -->

        </div>
      </div>
        </div>
</div>
</div>
</div>


<?php
 }
   else { ?>

 

<div class="invoice container">
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
                      <div>
                        <h5>Customer Name: <?php echo $result['customer_name'] ?></h5>
                      </div>
                      <div>
                        <span>phone:<?php echo $result['customer_phone'] ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <img src="../img/barcode.png" style="max-height: 100px; min-width: 100px">
                  </div>
                </div>
                

              </div>
              <div class="card-body">
                <table class="table">
                  
                  <tbody>
                     
                         <?php 
                         $result= $obj->get_order_details_sheet($order_id);
                         $row = $result['first']->fetch_assoc();
                       ?>
                        <tr>
                          <td>Order Id :<?php echo $order_id ?></td>
                          <td>Date : <?php echo $row['date'] ?></td>
                          <td>Order Type : <?php echo $row['order_type'] ?></td>

                        </tr>
                        
                    </tbody>
                </table>
                <div class="row">
                  <div class="col-md-6">
                    <h6>Pick Up Address</h6>
                    <div><p><strong><?php echo $row['pickup_address'] ?></strong></p></div>
                  </div>
                  <div class="col-md-6">
                    <h6>Delivery Address</h6>
                    <div><p><strong><?php echo $row['delivery_address'] ?></strong></p></div>
                  </div>

                </div>
               
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
                  $view_data = $obj->get_order_details_sheet($order_id);
                  while ($data = $view_data['second']->fetch_assoc()) {

                   ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td> <?php echo $data['product_name'] ?></td>
                    <td> <?php echo $data['category_name'] ?></td>
                    <td> <?php echo $data['qty'] ?></td>
                    <td> <?php echo $data['wieght'] ?></td>
                    <td> <?php echo $data['extra_charge'] ?></td>
                    
                  </tr>
                  
                  <?php 
                  $fee_sum  = floatval($data['delivery_fee']);
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
                    <td colspan="5" style="padding-right: 15px; font-weight: 700; text-align: right">Total Delivery Fee</td>
                    <td colspan="1" style="padding-right: 15px; font-weight: 700; text-align: center"><?php echo $grand_total_for_delivery ?></td>
                  </tr>
                </tfoot>
              </table>
            </div>
        </div>
      <div class="text-center mt-2"><a href="" class="btn btn-success" id="print_btn" onclick="window.print()">Print</a>
                        <!-- <script type="text/javascript">window.print()</script> -->

        </div>
      </div>

 
        </div>
</div>
</div>
</div>

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

