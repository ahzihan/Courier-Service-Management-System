<?php
include_once 'header.php';
include_once 'left_menu.php';

if(!isset($_POST['update'])){
	if (isset($_POST["btn"])) {
		$obj->insert_area($_POST);
	}
	
}else{
	if (isset($_POST["update"])) {
		$obj->update_area($_POST);
	}
}



if (isset($_GET["area_delete"])) {
    $deleteID = $_GET["area_delete"];
    $obj->delete_area($deleteID);
}
?>

<div class="content-wrapper">
    <div class="content-header">
	<div class="container-fluid">
	    <div class="row mb-2">
		<div class="col-sm-6">
		    <h1 class="m-0 text-dark">Area Name</h1>
		</div>
		<div class="col-sm-6">

		</div>
	    </div>
	</div>
    </div>
    <section class="content">
	<div class="container-fluid">
	    <div class="row">
		<div class="col-md-12">
		    <div class="row">
			<?php if(isset($_GET['area_edit'])){?>
				<div class="col-md-12">
			    <div class="card">
				<div class="card-header bg-primary">
				    <h3 class="card-title">Update Area</h3>
				</div>
				<div class="card-body">
				    <?php
				    if (isset($_GET['area_edit'])) {
					$data = $obj->edit_area($_GET['area_edit']);
					?>
				    <form role="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
					<div class="card-body">
					<div class="form-row">
					    <input type="hidden" name="updateID" value="<?php echo $data['areaID']?>">
					    <div class="form-group col-md-6">
						<label>Area Name</label>
						<input name="area_name" class="form-control" value="<?php echo $data['area_name']?>">
					    </div>
					    <div class="form-group col-md-6">
						<label>Manager</label>
						<select type="text" name="manager" class="form-control">
						    <option>Select Manager</option>
						    <?php $result=$obj->get_area_manager();
						    while($row=$result->fetch_assoc()){
						    ?>
						    <option <?php if($data['manager']==$row['empID']){ echo "selected"; } ?> value="<?php echo $row['empID'];?>"><?php echo $row['emp_name'];?></option>
						    <?php }?>
						</select>
					    </div>
					    <div class="card-footer">
						<button type="submit" name="update" class="btn btn-primary">Update</button>
						<a href="area.php" class="btn btn-primary">ADD</a>
					    </div>
					</div>
					</div>
				    </form>
				    <?php }?>
				</div>
			    </div>
			</div>
			<?php }else{?>
				<div class="col-md-12">
			    <div class="card">
				<div class="card-header bg-primary">
				    <h3 class="card-title">Add Area</h3>
				</div>
				<div class="card-body">
				    <form role="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
					<div class="card-body">
					<div class="form-row">
					    <div class="form-group col-md-6">
						<label>Area Name</label>
						<input name="area_name" class="form-control">
					    </div>
					    <div class="form-group col-md-6">
						<label>Manager</label>
						<select type="text" name="manager" class="form-control">
						    <option>Select Manager</option>
						    <?php $result=$obj->get_area_manager();
						    while($row=$result->fetch_assoc()){
						    ?>
						    <option value="<?php echo $row['empID'];?>"><?php echo $row['emp_name'];?></option>
						    <?php }?>
						</select>
					    </div>
					    <div class="card-footer">
						<button type="submit" name="btn" class="btn btn-primary">Submit</button>
					    </div>
					</div>
					</div>
				    </form>
				</div>
			    </div>
			</div>
				<?php }?>
			
		    </div>
		</div>
	    </div>
	</div>


	<div class="row">
	    <div class="col-md-12">
		<div class="card">
		    <div class="card-header bg-primary">
			<h3 class="card-title">List</h3>
		    </div>
		    <div class="card-body">
			<table class="table table-bordered" id="myTable">
			    <thead>                  
				<tr>
				    <th>Area ID</th>
				    <th>Area Name</th>
				    <th>Manager</th>
				    <th>Designation</th>
				    <th>Action</th>
				</tr>
			    </thead>
			    <tbody>
				<?php
				$result = $obj->get_area();
				while ($row = $result->fetch_assoc()) {
				    ?>
    				<tr>
    				    <td><?php echo $row["areaID"] ?></td>
    				    <td><?php echo $row['area_name'] ?></td>
    				    <td><?php echo $row['emp_name'] ?></td>
    				    <td><?php echo $row['designation'] ?></td>
    				    <td>
    					<a href="<?php echo $_SERVER['PHP_SELF'] ?>?area_edit=<?php echo $row['areaID'] ?>" class="btn btn-xs btn-primary">Edit</a>
    					<a href="<?php echo $_SERVER['PHP_SELF'] ?>?area_delete=<?php echo $row['areaID'] ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
    				    </td>
    				</tr>
				<?php } ?>
			    </tbody>
			</table>
		    </div>
		</div>
	    </div>
	</div>
    </section>
</div>
<?php include_once 'footer.php'; ?>



