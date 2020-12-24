<?php
session_start();
class Controller{
	private $conn;
	function __construct($host,$user,$password,$dbName)
	{
		$this->conn=new mysqli($host,$user,$password,$dbName);
	}
	function is_logged_in()
	{
		if(isset($_SESSION['empID'])){
			return true;
		}else{
			return false;
		}
	}
	public function login($data)
	{
		$email=$data['email'];
		$password=md5($data['password']);
		$result=$this->conn->query("SELECT * FROM `employee` WHERE emp_email='$email' and password='$password'");
		$user=$result->fetch_assoc();
		if(isset($user['empID'])){
			$_SESSION['empID']=$user['empID'];
			$_SESSION['empName']=$user['emp_name'];
			return true;
		}else{
			$_SESSION['error']='Invalid email or password';
			return false;
		}
	}
	public function logout()
	{
		session_destroy();
		return true;
	}

	public function get_orders_id(){

		$orderID = $this->conn->query("SELECT orderID,code FROM orders");
		return $orderID;

	}
	public function get_productlist_for_stock($orderID){
		$product = $this->conn->query("SELECT product, qty from order_details where orderID=".$orderID);
		return $product;
	}
	public function insert_stock($data){
		$empID 		   = $data['empID'];
		$order_id      = $data['order_id'];
		$stockin_date  = date('Y-m-d');
		for ($i = 0; $i < count($data['product_name']); $i++) {
			$product_name  = $data['product_name'][$i];
			$product_qty   = $data['product_qty'][$i];
			$insert = $this->conn->query("INSERT INTO `stock` (orderID,products,qty,stock_in_date, approved_by) VALUES ($order_id, '$product_name', '$product_qty', '$stockin_date', '$empID')");
			if ($insert) {
				$_SESSION['success']='Inserted Successfully';
			}
		}

	}
	public function get_stock_list(){
		$stock = $this->conn->query("SELECT stock.orderID,stock.stock_in_date, stock.stock_out_date,employee.emp_name FROM `stock` JOIN employee ON stock.approved_by = employee.empID group by orderID");
		return $stock;
	}
	public function get_stock_list_details($id){
		$d = $this->conn->query("SELECT * FROM stock WHERE orderID =".$id);
		// $q =$d->fetch_assoc();
		    return $d;
		
	}
	public function get_product_for_wastage($id){
		$wastage_pr = $this->conn->query("SELECT products,qty FROM stock WHERE orderID=".$id);
		return $wastage_pr;
	}
	public function insert_wastagae($wastage){
		$empID 		   = $wastage['empID'];
		$order_id      = $wastage['order_id'];
		$date          = date('Y-m-d');

		for ($i = 0; $i <count($wastage['product_name']); $i++) {
		
		$product_name= $wastage['product_name'][$i];
		$product_qty= $wastage['product_qty'][$i];
		$comment= $wastage['comment'][$i];
		$insert_waste = $this->conn->query("INSERT INTO `wastage` ( `orderID`, `product`, `qty`, `date`, `approved_by`, `comments`) VALUES ('$order_id', '$product_name', '$product_qty', '$date', '$empID', '$comment')");
	}
	}
	public function get_wastage(){
		$q = $this->conn->query("SELECT * FROM wastage Group BY orderID");
		return $q;
	}
	public function get_wastage_list_details($id){
		$d = $this->conn->query("SELECT * FROM wastage WHERE orderID =".$id);
		
		    return $d;
	}
	public function get_wastage_for_replacement($id){
		$q = $this->conn->query("SELECT * FROM wastage WHERE orderID=".$id);
		return $q;
	}
	public function insert_replacement($rep){
		$empID 		   = $rep['empID'];
		$order_id      = $rep['order_id'];
		$date          = date('Y-m-d');

		for ($i = 0; $i <count($rep['product_name']); $i++) {
		
		$product_name= $rep['product_name'][$i];
		$product_qty= $rep['product_qty'][$i];
		$comment= $rep['comment'][$i];
		  $this->conn->query("INSERT INTO `replacement` ( `orderID`, `product`, `qty`, `date`, `approved_by`, `comments`) VALUES ('$order_id', '$product_name', '$product_qty', '$date', '$empID', '$comment')");
	}
	}
	public function get_replacement(){
		$d = $this->conn->query("SELECT * FROM replacement group by orderID");
		return $d;
	}
	public function get_replace_list_details($id){
		$r= $this->conn->query("SELECT * FROM replacement WHERE orderID =".$id);
		return $r;
	}

	function data_for_stock_report()
	{
		$result=$this->conn->query("SELECT stock.orderID AS orderID, SUM(stock.qty) AS total_stock, stock.stock_in_date AS stock_in_date,stock.stock_out_date AS stock_out_date,(SELECT SUM(wastage.qty)FROM wastage WHERE wastage.orderID=stock.orderID) AS wastage ,(SELECT SUM(replacement.qty)FROM replacement WHERE replacement.orderID=stock.orderID) AS replacement  FROM `stock`GROUP BY orderID");
		return $result;
	}

}