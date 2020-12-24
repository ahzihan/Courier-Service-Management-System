<?php 
include_once 'header.php';
if (isset($_POST['product_name'])) {
   $obj->insert_replacement($_POST);
  
}
?>
<?php
include_once 'left_menu.php';
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Product Replacement</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"></li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <form action="" method="post"> 

            <div class="card card-primary">

              <div class="card-header">
                <h3 class="card-title">OrderID</h3>
              </div>
              <input type="hidden" value="<?php echo $_SESSION['empID'] ?>" name="empID">
              <div class="form-group">

                <label for=""></label>
                <select class="form-control" name="order_id" id="order_id">
                  <option>--select order--</option>
                  <?php 
                  $data = $obj->get_wastage();
                  while ($row = $data->fetch_assoc()) {?>
                    <option value="<?php echo $row['orderID'] ?>"><?php echo $row['orderID'] ?></option>
                  <?php } ?>
                </select>
              </div>
             <table class="table table-bordered">
               <th>Product</th>
               <th width="100px">qty</th>
               <th>Comments</th>
               <tbody id="product_id"></tbody>
             </table>
             <div class="card-footer">
                      <button type="submit" class="btn btn-primary" name="wastage_submit">Submit</button>
                    </div>
            </div>

            <!-- </div> -->
          </form>
        </div>


        <div class="col-md-6">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Replacement Product List</h3>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <th>#</th>
                  <th>orderID</th>
                  <th>day</th>
                  <th>Comments</th>
                  <th>Action</th>
                </thead>
                <tbody>
                	<?php $i=1; $result = $obj->get_replacement(); while($row=$result->fetch_assoc()){ ?>
                 <tr>
                 	<td><?php echo $i ?></td>
                 	<td><?php echo $row['orderID'] ?></td>
                 	<td><?php echo $row['date'] ?></td>
                 	<td><?php echo $row['comments'] ?></td>
                 	<td>
                 		<a class="btn btn-xs btn-primary" href="rep_details.php?id=<?php echo $row['orderID']?>">View</a>
                 	</td>
                 </tr>
                  <?php $i++; } ?>
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
<script>
  $(document).ready(function(){
    $('#order_id').on('change',function(){
      var orderID_data = $(this).val();
      // console.log(orderID_data);
      $.ajax({
        url: 'get_productlist_for_replacement.php',
        method: 'post',
        data :{'orderID': orderID_data},
        dataType: 'html',
        success:function(d){
          $('#product_id').html(d)
        }
      });
    })


  })


  
</script>