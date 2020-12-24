<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: Application/json");
require ('class/Controller.php');
$obj= new Controller('localhost', 'root', '', 'round45_project');
$result = $obj->get_employee();
$data=array();
while ($row=$result->fetch_assoc()) {
    array_push($data, $row);
}
echo json_encode($data);
