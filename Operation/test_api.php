<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: Application/json');
require('class/Controller.php');
$obj=new Controller('localhost','root','','round45_project');

$data = json_decode(file_get_contents('php://input'), true);
$result['status'] = $obj->test($data);
echo json_encode($result);
 ?>