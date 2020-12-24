
<?php
include_once 'header.php';
?>   
<?php
include_once 'left_menu.php';
?>
<?php 
    // if (isset($_POST['search'])){
    //  $result = $obj->search_order($_POST);
    //  while($sr_row= $result->fetch_assoc()){
    //   echo $sr_row['customer_name'].' - '.$sr_row['customer_phone'].' - '.$sr_row['total'].' - '.$sr_row['date'].' - '.$sr_row['priority'].' - '.$sr_row['delivery_address'];

    //  }
    // }
    if (isset($_GET['delete_order'])) {
      $obj->delete_order($_GET['delete_order']);
      echo "<script>window.location.assign('order_list.php')</script>";
    }

 ?>
  

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      
        <div class="col-md-12">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title" style="display: inline-block; padding-top: 5px; font-size: 22px;">Order List</h3>
              <!-- <form action="" method="post">
                <input autocomplete="off" placeholder="Name Or Phone" type="search" class="form-control col-md-2" style="display: inline-block; margin-left: 10px;" name="sr_customer_name">

                <input autocomplete="off" placeholder="Start Date" type="text"  id="date" class="form-control col-md-2" style="display: inline-block; margin-left: 10px;" name="sr_start_date">


              <input autocomplete="off" placeholder="End Date" type="text" id="date1" class="form-control col-md-2" style="display: inline-block; margin-left: 10px;" name="sr_end_date">


              <input autocomplete="off" type="submit" name="search" value="Search" class="btn btn-md btn-success" style="display: inline-block; margin-left: 10px;">
              </form> -->
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered" id="myTable">
                <thead>                  
                  <tr>
                   <th>#</th>
                   <th>Customer Name</th>
                   <th>Customer Phone</th>
                   <th>Date</th>
                   <th>Total</th>
                   <th>priority</th>
                   <th>deliv_Add</th>
                   <th>Status</th>
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody>
                <?php 
                $i=1;
                $rr = $obj->get_order_merchant_to_insert();
                while ($q = $rr['second']->fetch_assoc()) {?>
                  <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $q['customer_name'] ?></td>
                    <td><?php echo $q['customer_phone'] ?></td>
                    <td><?php echo $q['date'] ?></td>
                    <td><?php echo $q['total'] ?></td>
                    <td><?php echo $q['priority'] ?></td>
                    <td><?php echo $q['delivery_address'] ?></td>
                    <td><?php echo $q['status'] ?></td>
                    <td>
                      <a target="_blank" class="btn btn-success btn-xs" href="order_details.php?view_order=<?php echo $q['orderID'] ?>">View</a>
                      <a target="_blank" class="btn btn-primary btn-xs" href="edit_order.php?edit_order=<?php echo $q['orderID'] ?>">edit</a>
                      <a class="btn btn-danger btn-xs" href="<?php echo $_SERVER['PHP_SELF']?>?delete_order=<?php echo $q['orderID'] ?>" onclick="return confirm('Are You Sure Want To Delete')">Delete</a>
                    </td>
                  </tr>
                <?php $i+=1; } ?>
              </tbody>

            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php include_once 'footer.php'; ?>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>

<script>
  $(document).ready( function () {
    $('#myTable').DataTable();
    $( function() {
    $( "#date" ).datepicker({"dateFormat":"yy-mm-dd"});
    $( "#date1" ).datepicker({"dateFormat":"yy-mm-dd"});

  } );

 

});
</script>
 <!--  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
