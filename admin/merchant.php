<?php
include_once 'header.php';
include_once 'left_menu.php';

if(!isset($_POST['update'])){
	if (isset($_POST["btn"])) {
		$obj->insert_marchent($_POST);
	}
}else{
	if (isset($_POST["update"])) {
		$obj->update_merchant($_POST);
	}
}


if (isset($_GET["delete_merchant"])) {
    $deleteID = $_GET["delete_merchant"];
    $obj->delete_merchant($deleteID);
}
?>

<div class="content-wrapper">
    <div class="content-header">
	<div class="container-fluid">
	    <div class="row mb-2">
		<div class="col-sm-6">
		    <h1 class="m-0 text-dark">Merchant Section</h1>
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
			<?php if(isset($_GET['edit_merchant'])){?>
				<div class="col-md-12">
			    <div class="card">
				<div class="card-header bg-primary">
				    <h3 class="card-title">Update Merchant Info</h3>
				</div>
				<div class="card-body">

				    <?php
				    if (isset($_GET['edit_merchant'])) {
					$data = $obj->edit_merchant($_GET['edit_merchant']);
					?> 

    				    <form role="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    					<div class="card-body">
						<div class="form-row">
    					    <input type="hidden" name="editID" value="<?php echo $data['merchantID'] ?>">
    					    <div class="form-group col-md-6">
    						<label>Name</label>
    						<input type="text" name="m_name" class="form-control" value="<?php echo $data['m_name'] ?>">
    					    </div>	

    					    <div class="form-group col-md-6">
    						<label>Address</label>
    						<input type="text" name="m_address" class="form-control" value="<?php echo $data['m_address'] ?>">
    					    </div>
    					    <div class="form-group col-md-6">
    						<label>Phone Number</label>
    						<input type="number" name="m_phone" class="form-control" value="<?php echo $data['m_phone'] ?>">
    					    </div>
    					    <div class="form-group col-md-6">
    						<label>Email Address</label>
    						<input type="email" name="m_email" class="form-control" value="<?php echo $data['m_email'] ?>">
    					    </div>
    					    <div class="form-group col-md-6">
    						<label>Password</label>
    						<input type="password" name="m_password" class="form-control" value="<?php echo $data['m_password'] ?>">
    					    </div>
    					    <div class="form-group col-md-6">
    						<label>Select Area</label>
    						<select name="areaID" class="form-control">
    						    <option>Select Area</option>
							<?php
							$result = $obj->get_area();
							while ($row = $result->fetch_assoc()) {
							    ?>
							    <option <?php if($row['areaID']==$data['areaID']){ echo 'selected'; } ?> value="<?php echo $row["areaID"] ?>"><?php echo $row['area_name'] ?></option>
							<?php } ?>
    						</select>
    					    </div>

    					    <div class="card-footer">
    						<button type="submit" name="update" class="btn btn-primary">Submit</button>
    					    </div>
    					</div>
    				    </form>
				    <?php } ?>
				</div>
			    </div>
				</div>
			 </div>
		    </div>
			<?php }else{?>
				<div class="col-md-12">
			    <div class="card">
				<div class="card-header bg-primary">
				    <h3 class="card-title">Add Merchant Info</h3>
				</div>
				<div class="card-body">
				    <form role="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
					<div class="card-body">
					<div class="form-row">
					    <div class="form-group col-md-6">
						<label>Name</label>
						<input type="text" name="m_name" class="form-control">
					    </div>
					    <div class="form-group col-md-6">
						<label>Address</label>
						<input type="text" name="m_address" class="form-control">
					    </div>
					    <div class="form-group col-md-6">
						<label>Phone Number</label>
						<input type="number" name="m_phone" class="form-control">
					    </div>
					    <div class="form-group col-md-6">
						<label>Email Address</label>
						<input type="email" name="m_email" class="form-control">
					    </div>
					    <div class="form-group col-md-6">
						<label>Password</label>
						<input type="password" name="m_password" class="form-control">
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
					    <div class="card-footer">
						<button type="submit" name="btn" class="btn btn-primary">Submit</button>
					    </div>
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
	<div class="col-md-12">
	    <div class="row">
		<div class="card-body">
		    <div class="table-responsive">
		    <table class="table table-bordered" id="myTable">
			<thead class="bg-primary">                  
			    <tr>
				<th>Merchant Id</th>
				<th>Merchant Name</th>
				<th>Merchant Address</th>
				<th>Merchant Phone</th>
				<th>Merchant Email</th>
				<th>Password</th>
				<th>Area Name</th>
				<th>Action</th>
			    </tr>
			</thead>
			<tbody>
			    <?php
			    $result = $obj->get_marchent();
			    while ($row = $result->fetch_assoc()) {
				?>
    			    <tr>
    				<td><?php echo $row["merchantID"] ?></td>
    				<td><?php echo $row["m_name"] ?></td>
    				<td><?php echo $row["m_address"] ?></td>
    				<td><?php echo $row["m_phone"] ?></td>
    				<td><?php echo $row["m_email"] ?></td>
    				<td><?php echo $row["m_password"] ?></td>
    				<td><?php echo $row["area"] ?></td>
    				<td>
    				    <a href="<?php echo $_SERVER['PHP_SELF'] ?>?edit_merchant=<?php echo $row['merchantID'] ?>" class="btn btn-xs btn-primary">Edit</a>
    				    <a href="<?php echo $_SERVER['PHP_SELF'] ?>?delete_merchant=<?php echo $row['merchantID'] ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')">Delete</a></td>
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

