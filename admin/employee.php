
<?php
include_once 'header.php';
?>
<?php 
  if(!isset($_POST['update'])){
    if(isset($_POST['empName'])){
       $obj->add_employee($_POST);
    }
  }else{

    $obj->update_employee($_POST);
  }
  if(isset($_GET['employee_delete'])){
    $obj->delete_employee($_GET['employee_delete']);
    echo "<script>window.location.assign('".$_SERVER['PHP_SELF']."')</script>";
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
          <h1 class="m-0 text-dark">Employee</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Employee</li>
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
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Employee</h3>
                </div>
                <?php 
                  if(isset($_GET['employee_edit'])){
                    $employee=$obj->get_employee_for_update($_GET['employee_edit']);
                  ?>
                  <form role="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="card-body ">
                    <div class="form-row">
                      <div class="form-group col-md-6" >
                        <label for="employee name">Name</label>
                        <input type="text" name="empName" class="form-control" placeholder="Enter Employee Name" value="<?php echo $employee['emp_name'] ?>">
                        
                        <input type="hidden" name="empId" class="form-control" placeholder="Enter Employee Name" value="<?php echo  $employee['empID']?>">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="designation">Designation</label>
                        <select name="designation" class="form-control">
                            <option>Select</option>
                            <?php $result=$obj->get_employee();
                            while($row=$result->fetch_assoc()){
                            ?>
                            <option <?php if($row['empID']==$employee['empID']){ echo 'selected';}?> value="<?php echo $row['designation'];?>"><?php echo $row['designation'];?></option>
                            <?php }?>
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="employee phone">Phone</label>
                        <input type="text" name="empPhone" class="form-control" placeholder="Enter Employee Phone" value="<?php echo $employee['emp_phone'] ?>">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="employee email">Email</label>
                        <input type="email" name="empEmail" class="form-control" placeholder="Enter Employee Email" value="<?php echo $employee['emp_email'] ?>">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="employe password">Password</label>
                        <input type="password" name="empPassword" class="form-control" placeholder="Enter Employee Password" value="<?php echo $employee['password'] ?>">
                      </div>
                      
                      <div class="form-group col-md-6">
                        <label for="employee address">Address</label>
                        <textarea name="empAddress"  class="form-control" placeholder="Enter Employee Address"><?php echo $employee['emp_address'] ?></textarea>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" name="update"class="btn btn-primary btn-block">Update</button>
                    </div>
                    </div>
                  </form>
                <?php
                  }
                  else{ 
                ?>
                  <form role="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="card-body">
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="employee name">Name</label>
                        <input type="text" name="empName" class="form-control" placeholder="Enter Employee Name" value="">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="employee designation">Designation</label>
                        <select name="designation" class="form-control">
                            <option>Select</option>
                            <option value="area_manager">Area Manager</option>
                            <option value="HRM">HRM</option>
                            <option value="delivery_man">Delivery Man</option>
                            <option value="other">Other</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="employee phone">Phone</label>
                        <input type="text" name="empPhone" class="form-control" placeholder="Enter Employee Phone" value="">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="employee email">Email</label>
                        <input type="email" name="empEmail" class="form-control" placeholder="Enter Employee Email" value="">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="employe password">Password</label>
                        <input type="password" name="empPassword" class="form-control" placeholder="Enter Employee Password" value="">
                      </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="employee address">Address</label>
                        <textarea name="empAddress" class="form-control" placeholder="Enter Employee Address"></textarea>
                      </div>
                    <div class="card-footer">
                      <button type="submit" name="add"class="btn btn-primary btn-block">ADD</button>
                    </div>
                    </div>
                  </form>
                <?php } ?>
              </div>
            </div>
            <div class="col-md-12">
              <div class="card">
                <div class="card-header bg-primary">
                  <h3 class="card-title">Employee List</h3>
                </div>
                <div class="card-body">
		          <div class="table-responsive">
                  <table class="table table-bordered" id="myTable">
                    <thead>                  
                      <tr>
                        <th style="width: 10px">SL</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Password</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    //get employee data from database
                    $list=$obj->get_employee();
                    $i=1;
                    while($row=$list->fetch_assoc()){
                    ?>
                        <tr>
                          <td><?php echo $i++; ?></td>
                          <td><?php echo $row['emp_name'] ?></td>
                          <td><?php echo $row['designation'] ?></td>
                          <td><?php echo $row['emp_phone'] ?></td>
                          <td><?php echo $row['emp_email'] ?></td>
                          <td><?php echo $row['emp_address'] ?></td>
                          <td><?php echo $row['password'] ?></td>
                          <td>
                            <a href="<?php echo $_SERVER['PHP_SELF']?>?employee_edit=<?php echo $row['empID']?>" class="btn btn-xs btn-primary">Edit</a>
                            <a href="<?php echo $_SERVER['PHP_SELF']?>?employee_delete=<?php echo $row['empID']?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                          </td>
                        </tr>
                    <?php  }?>
                      </tbody>
                    </table>
		   </div>
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