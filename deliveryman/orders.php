<?
    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json');

    require('class.Controller.php');
    $obj=new Controller('location','root','','round45_project');
    $result=$obj->get_delivery();
    $data=array();
    while($d=$result->fetch_assoc()){
        array_push($data,$d);
    }
    echo json_decode($data);
    
?>