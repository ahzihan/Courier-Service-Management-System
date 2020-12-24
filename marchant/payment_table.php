
  <?php
include_once 'header.php';
//for all data view of cod
if (!isset($_GET['date'])) {
$data=$obj->get_payment_method();
}else{
  //for between date
  if (isset($_POST['f_date']) && isset($_POST['l_date'])) {
    $for_date=$obj->get_payment_method_for_date($_POST);
  }
}
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
               <form action="<?php echo $_SERVER['PHP_SELF']?>?date" method="post">
               <input type="text" placeholder="Enter First Date" name="f_date" > To
               <input type="text" placeholder="Enter Second Date" name="l_date" >
              <button class="btn btn-default">Search</button>
               </form>
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

    <style>
    .pending{
      color:tomato;
    }
    .success{
      color:green;
    }
    </style>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Cash On Delivary</h3>
              </div>
              <!-- /.card-header -->


   <?php if (!isset($_GET['date'])) { ?>

    <!-- for all data -->
                <div class="card-body">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th>Date</th>
                      <th>Amount</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
<?php while ($value=$data['first']->fetch_assoc()) { ?>
                    <tr>
                      <td><?php echo $value['date'] ?></td>
                      <td><?php echo $value['amount'] ?></td>
                     <?php if ($value['status']=='pending') { ?>
                       <td class="pending"> <?php echo $value['status'] ?></td></td>
                    <?php  } else { ?>
                      <td class="success"> <?php echo $value['status'] ?></td></td>
                      <?php  } ?>        
                    </tr>
<?php } ?>
                  </tbody>
                  <tfoot>
         <?php $r=$data['second']->fetch_assoc()?>  
                  <tr><td colspan="1">Total =</td>
                  <td colspan="2"><?php echo $r['total']?> </td>
                  </tr>
                  </tfoot>
                </table>
              </div>
  <?php } else { ?>
      
  <!-- for date between -->
     <div class="col-md-2">
     <a href="payment_table.php" class="btn btn-success" >See All</a>
     </div>
    <div class="card-body">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th>Date</th>
                      <th>Amount</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
 while ($result=$for_date['first']->fetch_assoc())
{
   ?>
                    <tr>
                      <td><?php echo $result['date'] ?></td>
                      <td><?php echo $result['amount'] ?></td>
                     <?php if ($result['status']=='pending') { ?>
                       <td class="pending"> <?php echo $result['status'] ?></td></td>
                    <?php  } else { ?>
                      <td class="success"> <?php echo $result['status'] ?></td></td>
                      <?php  } ?>        
                    </tr>
<?php } ?>
                  </tbody>
                  <tfoot>
         <?php $r=$for_date['second']->fetch_assoc()?>  
                  <tr><td colspan="1">Total =</td>
                  <td colspan="2"><?php echo $r['total']?> </td>
                  </tr>
                  </tfoot>
                </table>
              </div>

  <?php } ?>


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