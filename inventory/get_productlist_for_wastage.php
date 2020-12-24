<?php
require('class/Inventory.php');
if(!isset($_SESSION['empID'])){
	echo "<script>window.location.assign('index.php')</script>";
}
$obj=new Controller('localhost','root','','round45_project');
if(isset($_GET['action'])){
	if($obj->logout()){
		echo "<script>window.location.assign('index.php')</script>";
	}
}
$order_id = $_POST['orderID'];

?>



		<?php $data = $obj->get_product_for_wastage($order_id); 
		while($row = $data->fetch_assoc()){ ?>
			<tr>
		<td><input type="checkbox" value="<?php echo $row['products']?>" name="product_name[]">&nbsp;&nbsp;<?php echo $row['products'].'  / '.$row['qty']?></td>
		
		<td><input type="text" class="form-control" placeholder="quantity" value="<?php echo $row['qty']?>" name="product_qty[]"></td>
		<td><input type="text" placeholder="Comments" name="comment[]"></td>
	</tr>
			<?php } ?>




		