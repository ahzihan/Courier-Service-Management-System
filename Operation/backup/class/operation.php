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
	public function get_category()
	{
		$result=$this->conn->query("SELECT * FROM `category`");
		return $result;
	}
	public function add_category($name)
	{
		if($name!=''){
			$this->conn->query("INSERT INTO `category` (`category_name`) VALUES ('$name')");
		}
	}
	public function get_category_for_update($id)
	{
		$result=$this->conn->query("SELECT * FROM `category` WHERE categoryID=".$id);
		return $result->fetch_assoc();
	}
	public function submit_updated_category($data)
	{
		$name=$data['name'];
		$categoryID=$data['categoryID'];
		$this->conn->query("UPDATE `category` SET `category_name` = '$name' WHERE `categoryID` = $categoryID");
	}
	function delete_category($id)
	{
		if($this->is_logged_in()){
			$this->conn->query('delete from category WHERE categoryID='.$id);
		}
	}

	// get order list

	public function get_orders()
	{
		$result=$this->conn->query("SELECT orders.orderID,orders.date,orders.priority,orders.status,orders.`order_type`,(SELECT emp_name FROM employee WHERE empID=orders.received_by) as received_by,orders.pickup_man,orders.delivery_man, merchant.m_name as merchant_name FROM `orders` JOIN merchant on orders.merchantID=merchant.merchantID");
		return $result;
	}


	public function get_delevary_man(){
		$result_d_man = $this->conn->query("SELECT dID, d_name FROM delivery_man " );
		return $result_d_man;
	}

	// get status & priority for update

	public function get_status_for_update($id)
	{
		$result=$this->conn->query("SELECT `status`,`priority` FROM `orders` WHERE `orderID`=".$id);
		return $result->fetch_assoc();
	}

	// update status and priority
	public function update_status_and_priority($data){
		$orderID = $data['orderID'];
		$priority = $data['priority'];
      	$status = $data['status'];
      	$d_man = $data['d_man'];
      	$p_man = $data['p_man'];
      	$select_que = $this->conn->query("SELECT * FROM orders");
      	
      	$count = mysqli_num_rows($select_que);
      	for ($i=0; $i <$count ; $i++) { 
      		
$result=$this->conn->query("UPDATE orders SET status = '$status[$i]', priority = '$priority[$i]', pickup_man = '$p_man[$i]'  ,delivery_man = '$d_man[$i]'  WHERE orderID=".$orderID[$i]);
return $result;
      	}
      	
      	//mail send function
      	
   //    	while ($all_data = $select_que->fetch_assoc()) {
   //    		$result = $this->conn->query("SELECT m_email FROM merchant WHERE merchantID = " . $all_data['merchantID']);
   //    		$result_marchant = $result->fetch_assoc();

   //    		$result_e = $this->conn->query("SELECT emp_email FROM employee WHERE 	empID = " . $all_data['received_by']);
   //    		$result_emp = $result_e->fetch_assoc();

   //    		$to_mail = $result_marchant['m_email'];
   //    		$subject = "Order updated";
   //    		$body = "Your Order has been successfully updated";
   //    		$headers = "From: " . $result_emp['emp_email'];

   //    		// mail function
   //    		if (mail('$to_mail', $subject, $body, $headers)) {
			// //     echo "Email successfully sent to to_email...";
			// } else {
			// //     echo "Email sending failed...";
			// }	



   //    	}
	}

	/* Select and Recive data from product details view*/
	function product_details($order_id){
		$select_view = $this->conn->query("SELECT * FROM `product_details` WHERE orderID =" . $order_id);
		return $select_view;
	}

}