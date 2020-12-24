<?php
$obj->update_delivery_man($_POST);
if (isset($_GET['delivery_man_edit']))
    $d = $obj->edit_delivery_man($_GET['delivery_man_edit']);
?> 
<form role="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="card-body">
	<div class="form-group">
	    <label>Delivery ID</label>
	    <input type="text" name="dID" class="form-control" value="<?php echo $d["dID"] ?>">
	    <input type="hidden" name="dID" value="<?php echo $d["dID"] ?>">
	</div>
	<div class="form-group">
	    <label>Name</label>
	    <input type="text" name="d_name" class="form-control" value="<?php echo $d["d_name"] ?>">
	</div>
	<div class="form-group">
	    <label>Phone Number</label>
	    <input type="number" name="d_phone" class="form-control" value="<?php echo $d["d_phone"] ?>">
	</div>
	<div class="form-group">
	    <label>Email Address</label>
	    <input type="email" name="d_email" class="form-control" value="<?php echo $d["d_email"] ?>">
	</div>
	<div class="form-group">
	    <label>Address</label>
	    <textarea name="d_address" class="form-control"><?php echo $d["d_address"] ?></textarea>
	</div>
	<div class="form-group">
	    <label>Password</label>
	    <input type="password" name="password" class="form-control" value="<?php echo $d["password"] ?>">
	</div>
	<div class="form-group">
	    <label>Area ID</label>
	    <input type="text" name="areaID" class="form-control" value="<?php echo $d["areaID"] ?>">
	</div>
    </div>
    <div class="card-footer">
	<button type="submit" name="btn" class="btn btn-primary">Submit</button>
    </div>
</form>
