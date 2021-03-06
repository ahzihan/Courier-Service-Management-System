<?php 
include_once 'header.php';

?>
<?php
include_once 'left_menu.php';
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Add stock</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Stock</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        
        <div class="col-md-7">
          <div class="card card-info">
            <div class="card-header">
          <h3 class="card-title">Stock Details</h3>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <th>#</th>
              <th>Product</th>
              <th>Stock-in-date</th>
              <th>Stock-out-date</th>
              <th>Approve By</th>
              
            </thead>
            <tbody>
              <?php 
              if (isset($_GET['id'])) {
                 $i=1;
                $data = $obj->get_stock_list_details($_GET['id']);
                while ($result=$data->fetch_assoc()) {?>
              <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $result['products']?></td>
                <td><?php echo $result['stock_in_date']?></td>
                <td><?php echo $result['stock_out_date']?></td>
                <td><?php echo $result['approved_by']?></td>
                
              </tr>
              <?php $i++; } } ?>
            </tbody>
          </table>
        </div>
          </div>
      </div> 
    </div>
  </div>
</section>
</div>



<?php include_once 'footer.php'; ?>
