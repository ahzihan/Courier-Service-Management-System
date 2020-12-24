<?php
include_once 'header.php';
include_once 'left_menu.php';
$result=$obj->get_data_for_payment();
?>


<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Payment Collection</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Payment Collection</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <div class="card-body">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th>Order ID</th>
                      <th>Date</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php while ($row=$result->fetch_assoc()) { ?>      
                 
                    <tr>
                      <td><?php echo $row['order_id'] ?></td>
                      <td><?php echo $row['date'] ?></td>
                      <td><?php echo $row['amount'] ?></td>
                           </tr>
                      <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
  </div>
 </div>















<?php include_once 'footer.php'; ?>




/* 	public function get_data_for_payment()
      {
	 $data=$this->conn->query("SELECT orders.orderID as order_id, orders.date as date, SUM(order_details.price + orders.fee) as amount FROM `orders` JOIN order_details ON orders.orderID= order_details.orderID GROUP BY orders.orderID");
	 return $data;
	 
     } */