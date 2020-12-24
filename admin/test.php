
<?php
include_once 'header.php';
if(isset($_POST['searchsubmit'])){
  $result=$obj->check_report($_POST);
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
          <h1 class="m-0 text-dark">Category</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Category</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header bg-primary">
                  <h3 class="card-title">Report</h3>
                </div>
                <div class="card-body">

                  <form action="" method="POST">
                    <div class="form-row">
                      <div class="form-group">
                        <input type="date" class="form-control" id="startdate" name="startdate">
                      </div>
                      <label> TO </label>
                      <div class="form-group ">
                        <input type="date" class="form-control" id="enddate" name="enddate">
                      </div>
                      <div class="form-group">
                        <select name="delivery_id" class="form-control">
                            <option value="">Select Delivery Man</option>
                            <?php
                            $result2=$obj->get_delivery();
                            while ($row1 = $result2->fetch_assoc()){
                            ?>
                            <option value="<?php echo $row1['delivery_man']; ?>"><?php echo $row1['d_name']; ?></option>
                            <?php }?>
                            </select>
                        </div>
                        
                      <div class="form-group">
                        <input type="submit" class="btn btn-secondary" name="searchsubmit" value="Search">
                      </div>
                    </div>
                  </form>
                  <?php 
                  if(isset($_POST['searchsubmit'])){
                    if($result->num_rows>0){
                     ?>

                     <table class="table table-bordered">
                       <thead>
                         <tr>
                           <th>Order ID</th>
                           <th>Order Type</th>
                         </tr>
                       </thead>

                       <tbody>
                         <?php while ($row=$result->fetch_assoc()){

                          ?>

                          <tr>
                           <td><?php echo$row['orderID'];?></td>
                           <td><?php echo$row['order_type'];?></td>
                         </tr> 

                         <?php 
                       }
                     }else{ ?>
                     </tbody>
                     <div class='alert alert-warning col-sm-6 ml-5 mt-2' role='alert'> No Records Found ! </div>
                     <?php 
                   }
                 }?>
               </table>

             </div>

           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
</section>
</div>
<?php include_once 'footer.php'; ?>