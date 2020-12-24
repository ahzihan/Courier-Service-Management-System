<?php
include 'header.php';
?>

<div class="content-wrapper">
    <div class="content-header">
	<div class="container-fluid">
	    <div class="row mb-2">
		<div class="col-sm-6">
		    <h1 class="m-0 text-dark">Delivery Man</h1>
		</div>
		<div class="col-sm-6">
		    <ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active">Delivary </li>
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
			<div class="col-md-6">
			    <div class="card">
				<div class="card-header">
				    <h3 class="card-title">Delivery Man </h3>
				</div>
				<div class="card-body">

				    <form role="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
					<div class="card-body">
					    <div class="form-group">
						<label>Delivery ID</label>
						<input type="text" name="dID" class="form-control">
					    </div>
					    <div class="form-group">
						<label>Name</label>
						<input type="text" name="d_name" class="form-control">
					    </div>
					    <div class="form-group">
						<label>Phone Number</label>
						<input type="number" name="d_phone" class="form-control">
					    </div>
					    <div class="form-group">
						<label>Email Address</label>
						<input type="email" name="d_email" class="form-control">
					    </div>
					    <div class="form-group">
						<label>Address</label>
						<textarea name="d_address" class="form-control"></textarea>
					    </div>
					    <div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control">
					    </div>
					    <div class="form-group">
						<label>Area ID</label>
						<input type="text" name="areaID" class="form-control">
					    </div>
					    <div class="form-group">

					    </div>
					    <div class="form-group">

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
		</div>
	    </div>
	</div>
    </section>
</div>
<?php include_once 'footer.php'; ?>

