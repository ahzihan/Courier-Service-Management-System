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
;
?>
<?php $data = $obj->get_productlist_for_stock($order_id); 
while($row = $data->fetch_assoc()){ ?>

	
	<tr>
		<td><input type="checkbox" value="<?php echo $row['product']?>" name="product_name[]">&nbsp;&nbsp;<?php echo $row['product'].'  / '.$row['qty']?></td>
		
		<td><input type="text" class="form-control" placeholder="quantity" value="<?php echo $row['qty']?>" name="product_qty[]"></td>
	</tr>

	
	<?php } ?>