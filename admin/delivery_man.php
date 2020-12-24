<?php
include_once 'header.php';
include_once 'left_menu.php';

if(!isset($_POST['update'])){
    if (isset($_POST["btn"])) {
		$obj->insert_delivery_man($_POST);
	}
}else{
	if (isset($_POST["update"])) {
		$obj->update_delivery_man($_POST);
	}
}


if (isset($_GET["delivery_man_delete"])) {
    $deleteID = $_GET["delivery_man_delete"];
    $obj->delete_delivery_man($deleteID);
}
?>

<div class="content-wrapper">
    <div class="content-header">
	<div class="container-fluid">
	    <div class="row mb-2">
		<div class="col-sm-6">
		    <h1 class="m-0 text-dark">Delivery Man</h1>
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
			<?php if(isset($_GET['delivery_man_edit'])){?>
				<div class="col-md-12">
			    <div class="card">
				<div class="card-header bg-primary">
				    <h3 class="card-title">Update Delivery Man </h3>
				</div>
				<div class="card-body">

				    <?php
				    if (isset($_GET['delivery_man_edit'])) {
					$data = $obj->edit_delivery_man($_GET['delivery_man_edit']);
					?> 
    				    <form role="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    					<div class="card-body">
						<div class="form-row">
    					    <input type="hidden" name="newID" value="<?php echo $data["dID"] ?>">
    					    <div class="form-group col-md-6">
    						<label>Name</label>
    						<input type="text" name="d_name" class="form-control" value="<?php echo $data["d_name"] ?>">
    					    </div>
    					    <div class="form-group col-md-6">
    						<label>Phone Number</label>
    						<input type="number" name="d_phone" class="form-control" value="<?php echo $data["d_phone"] ?>">
    					    </div>
    					    <div class="form-group col-md-6">
    						<label>Email Address</label>
    						<input type="email" name="d_email" class="form-control" value="<?php echo $data["d_email"] ?>">
    					    </div>
    					    <div class="form-group col-md-6">
    						<label>Password</label>
    						<input type="password" name="password" class="form-control" value="<?php echo $data["password"] ?>">
    					    </div>
    					    <div class="form-group col-md-6">
							<label>Select Area</label>
							<select name="areaID" class="form-control">
						    <option>Select Area</option>
						    <?php
						    $result = $obj->get_area();
						    while ($row = $result->fetch_assoc()) {
							?>
						    <option <?php if($row['areaID']==$data['areaID']){ echo "selected"; } ?> value="<?php echo $row["areaID"] ?>"><?php echo $row['area_name'] ?></option>
						    <?php } ?>
						</select>
					    </div>
						<div class="form-group col-md-6">
    						<label>Address</label>
    						<textarea name="d_address" class="form-control"><?php echo $data["d_address"] ?></textarea>
    					</div>
    					</div>
    					<div class="card-footer">
    					    <button type="submit" name="update" class="btn btn-primary">Submit</button>
    					</div>
    				    </form>
				    <?php } ?>
					</div>
			    </div>
				</div>
			</div>	
				<?php }else{?>

				<div class="col-md-12">
			    <div class="card">
				<div class="card-header bg-primary">
				    <h3 class="card-title">Add Delivery Man </h3>
				</div>
				<div class="card-body">
				    <form role="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
					<div class="card-body">
					<div class="form-row">
					    <div class="form-group col-md-6">
						<label>Name</label>
						<input type="text" name="d_name" class="form-control">
					    </div>
					    <div class="form-group col-md-6">
						<label>Phone Number</label>
						<input type="number" name="d_phone" class="form-control">
					    </div>
					    <div class="form-group col-md-6">
						<label>Email Address</label>
						<input type="email" name="d_email" class="form-control">
					    </div>
					    <div class="form-group col-md-6">
						<label>Password</label>
						<input type="password" name="password" class="form-control">
					    </div>
					    <div class="form-group col-md-6">
						<label>Select Area</label>
						<select name="areaID" class="form-control">
						    <option>Select Area</option>
						    <?php
						    $result = $obj->get_area();
						    while ($row = $result->fetch_assoc()) {
							?>
						    <option value="<?php echo $row["areaID"] ?>"><?php echo $row['area_name'] ?></option>
						    <?php } ?>
						</select>
					    </div>
						<div class="form-group col-md-6">
						<label>Address</label>
						<textarea name="d_address" class="form-control"></textarea>
					    </div>
					</div>
					<div class="card-footer">
					    <button type="submit" name="btn" class="btn btn-primary">Submit</button>
					</div>
				    </form>
				</div>
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
			<div class="table-responsive">
			<table class="table table-bordered" id="myTable">
			    <thead>                  
				<tr>
				    <th>Delivery ID</th>
				    <th>Name</th>
				    <th>Phone</th>
				    <th>Email</th>
				    <th>Address</th>
				    <th>Password</th>
				    <th>Area</th>
				    <th>Action</th>
				</tr>
			    </thead>
			    <tbody>
				<?php
				$result = $obj->get_delivery_man();
				while ($row = $result->fetch_assoc()) {
				    ?>
    				<tr>
    				    <td><?php echo $row["dID"] ?></td>
    				    <td><?php echo $row['d_name'] ?></td>
    				    <td><?php echo $row['d_phone'] ?></td>
    				    <td><?php echo $row['d_email'] ?></td>
    				    <td><?php echo $row['d_address'] ?></td>
    				    <td><?php echo $row['password'] ?></td>
    				    <td><?php echo $row['area'] ?></td>
    				    <td>
    					<a href="<?php echo $_SERVER['PHP_SELF'] ?>?delivery_man_edit=<?php echo $row['dID'] ?>" class="btn btn-xs btn-primary">Edit</a>
    					<a href="<?php echo $_SERVER['PHP_SELF'] ?>?delivery_man_delete=<?php echo $row['dID'] ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
    				    </td>
    				</tr>
				<?php } ?>
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

