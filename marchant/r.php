<?php
require('class/Merchant.php');
if(!isset($_SESSION['merchantUser'])){
  echo "<script>window.location.assign('index.php')</script>";
}
$obj=new Controller('localhost','root','','round45_project');
$result = $obj->new_order();

echo $result;

// if(isset($_GET['action'])){
//  if($obj->logout()){
//   echo "<script>window.location.assign('index.php')</script>";
//  }
// }
?>
