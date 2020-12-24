<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: Application/json');
require('class/Controller.php');
$obj=new Controller('localhost','root','','round45_project');
$result = $obj->get_orders();
$data = array();
while ($d = $result->fetch_assoc()) {
	array_push($data,$d);

}
echo json_encode($data);
 ?>