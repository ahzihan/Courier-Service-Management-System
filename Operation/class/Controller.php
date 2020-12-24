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
		$result=$this->conn->query("SELECT * from search_order");
		return $result;
	}


	public function get_delevary_man($id){
		$result_d_man = $this->conn->query("SELECT dID, d_name FROM delivery_man WHERE areaID=".$id );
		return $result_d_man;
	}
	//get area -->order_details.php
	// public function get_area(){
	// 	$result_area = $this->conn->query("SELECT areaID  FROM area" );
	// 	return $result_area;
	// }

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
      		
		$this->conn->query("UPDATE orders SET status = '$status[$i]', priority = '$priority[$i]', pickup_man = '$p_man[$i]'  ,delivery_man = '$d_man[$i]'  WHERE orderID=".$orderID[$i]);
   		
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
		$select_view = $this->conn->query("SELECT * FROM `product_details_invoice` WHERE orderID =" . $order_id);
		return $select_view;
	}

	// get merchant name
	public function get_merchant()
	{
		$select_m=$this->conn->query("SELECT DISTINCT m_name FROM merchant");
		return $select_m;
	}
	//get orders for search
	public function get_order_type()
	{
		$select_o=$this->conn->query("SELECT DISTINCT order_type FROM orders");
		return $select_o;
	}
	// search orders 
	public function search_order($data)
	{
		$m_name=$data['m_name'];
		$order_type=$data['order_type'];
		$start_date=$data['start_date'];
		$end_date=$data['end_date'];
		// if (!empty($m_name || $order_type || ($start_date && $end_date))) {
		// 	# code...
		// $select_o=$this->conn->query("SELECT * FROM search_order WHERE (merchant_name='$m_name' OR order_type='$order_type' OR `date` between '$start_date'AND'$end_date')");
		// return $select_o;
		// }
		// else

		if(!empty($m_name && $order_type && ($start_date && $end_date))){
			$select_o=$this->conn->query("SELECT * FROM search_order WHERE (merchant_name='$m_name' AND order_type='$order_type' AND `date` between '$start_date'AND'$end_date')");
		return $select_o;
			}
		elseif (!empty(($m_name && $order_type ) || ($order_type && ($start_date && $end_date)) || (($start_date && $end_date)&& $m_name))) {
			
			$select_o=$this->conn->query("SELECT * FROM search_order WHERE ((merchant_name='$m_name' AND order_type='$order_type') OR (order_type='$order_type' AND `date` between '$start_date'AND'$end_date') OR(merchant_name='$m_name' AND `date` between '$start_date'AND'$end_date') )");
		return $select_o;
		}elseif (!empty($m_name || $order_type  || ($start_date && $end_date))){
		
			$select_o=$this->conn->query("SELECT * FROM search_order WHERE ((merchant_name='$m_name') OR (order_type='$order_type') OR (`date` between '$start_date'AND'$end_date'))");
		return $select_o;

	}
	}

	/*Fee collection merchent ---> fee_collection*/
	public function fee_collection_merchent(){
		$select_fee=$this->conn->query("SELECT * FROM `fee_collection_merchant`");
		return $select_fee;
	}

	/* merchant payable on merchant ledger --> merchant_ledger.php*/
	public function  get_merchant_ledger($id){
		$merchant_ledger=$this->conn->query("SELECT orderID ,fee,date,sum(extra_charge) AS extra_charge,(fee+sum(extra_charge)) AS total_fee from product_details WHERE merchantID='$id' GROUP BY orderID");
		return $merchant_ledger;
	}


	/*merchant paid on merchant ledger --> merchant_ledger.php*/
	public function get_merchant_paid($id){
		$merchant_paid = $this->conn->query("SELECT merchant.merchantID, merchant.m_name, fee_collection.date, fee_collection.method, fee_collection.amount, fee_collection.collected_by FROM merchant JOIN fee_collection ON merchant.merchantID = fee_collection.merchantID WHERE merchant.merchantID =".$id);
		return $merchant_paid; 
	}

	/* Get merchant details info --> merchant ledger*/
	public function get_merchant_info($id){
		$merchant_info = $this->conn->query("select * from merchant where merchantID = ".$id);
		return $merchant_info;
	}
	/* get employee name for collected by  */
	public function get_emp_name()
	{
		$emp_name=$this->conn->query("select * from employee");
		return $emp_name;
	}
	public function insert_fee($data)
	{	
		$m_id = $data['mID'];
		$amount = $data['amount'];
		$date = date('Y-m-d');
		$collected_by = $data['collected_by'];
		$payment_method = $data['payment_method'];
		$this->conn->query("INSERT INTO `fee_collection` (merchantID, amount,method,collected_by,`date`) VALUES ($m_id, '$amount', '$payment_method','$collected_by','$date')");
	}
	// public function  get_merchant_ledger_n(){
	// 	$merchant_ledger=$this->conn->query("SELECT orderID ,fee,date,sum(extra_charge) AS extra_charge,(fee+sum(extra_charge)) AS total_fee from product_details GROUP BY merchantID");
	// 	return $merchant_ledger;
	// }

	/*get_cod_collection ->cod_collection.php */
	public function get_cod_collection(){
		$cod_collection = $this->conn->query("select * from cod_collection");
		return $cod_collection;
	}

	/*for payment status data fatch*/ 
	public function get_payment_status($id){
		$amount_fetch = $this->conn->query("select * from payment_collection WHERE orderID = ".$id);
		return $amount_fetch;
	}
	public function get_cod_collection_by_orderID($id)
	{
		$cod_collection_orderID = $this->conn->query("select * from cod_collection WHERE orderID=".$id);
		return $cod_collection_orderID;
	}
	public function insert_payment_collection($data)
	{
		$orderID=$data['order_id'];
		$date = date('Y-m-d');
		$amount=$data['total_amount'];
		$paymentBy=$data['paymentBy'];
		$this->conn->query("INSERT INTO `payment_collection` (orderID,`date`,amount,payment_by) VALUES ($orderID, '$date','$amount','$paymentBy')");
	}
	//merchant_payment_collection -->merchant_payment.php
	public function merchant_payment_collection(){
		$m_payment_collection = $this->conn->query("SELECT * FROM `merchant_payment_collection`");
		return $m_payment_collection;
	}
	/*for merchant total payment--> merchant_payment.php*/
	public function merchant_payment($id){
		$payment_merchant = $this->conn->query("SELECT SUM(amount) as paid FROM `merchant_payemt` WHERE merchantID = ".$id);
		return $payment_merchant;
	}

	/* get metchant name for payment*/
	function get_merchent_name_for_payment_by_id($id){
		$merchant_name = $this->conn->query("SELECT * FROM `merchant_payment_collection` WHERE merchantID = ".$id);
		return $merchant_name;
	}

	/*insert_merchant_payment ---> merchant_payment_collection.php*/
	function insert_merchant_payment($data){
		$merchantId = $data['merchantId'];
		$method = $data['method'];
		$paid_emp = $data['paid_emp'];
		$total_amount = $data['total_amount'];
		$date = date('Y-m-d');
		$this->conn->query("INSERT INTO `merchant_payemt` (`merchantID`, `date`, `method`, `amount`, `payment_by`) VALUES ($merchantId, '$date', '$method', '$total_amount', '$paid_emp')");
	}
	public function merchant_payment_collection_ledger($id)
	{
		$merchant_payment_r=$this->conn->query("select `round45_project`.`orders`.`delivery_man` AS `paymnentBy`,`round45_project`.`merchant`.`merchantID` AS `merchantID`,`round45_project`.`merchant`.`m_name` AS `m_name`,`round45_project`.`orders`.`orderID` AS `orderID`,`round45_project`.`orders`.`order_type` AS `order_type`,(select `round45_project`.`delivery_man`.`d_name` from `round45_project`.`delivery_man` where `round45_project`.`delivery_man`.`dID` = `round45_project`.`orders`.`delivery_man`) AS `delivery_man`,(select sum(`round45_project`.`order_details`.`price`) from `round45_project`.`order_details` where `round45_project`.`order_details`.`orderID` = `round45_project`.`orders`.`orderID` group by `round45_project`.`order_details`.`orderID`) AS `total_price` from (`round45_project`.`merchant` join `round45_project`.`orders` on(`round45_project`.`merchant`.`merchantID` = `round45_project`.`orders`.`merchantID`)) where `round45_project`.`orders`.`order_type` = 'cash on delivery' AND `round45_project`.`orders`.`merchantID`=".$id);
		return $merchant_payment_r;
	}
	public function merchant_payment_ledger($id){
		$payment_merchant = $this->conn->query("SELECT * FROM `merchant_payemt` WHERE merchantID = ".$id);
		return $payment_merchant;
	}
	
	public function get_total_orders()
	{
		$total_orders = $this->conn->query("SELECT * FROM orders order by date asc");
		return $total_orders;
	}
	public function get_total_merchant()
	{
		$total_orders = $this->conn->query("SELECT * FROM merchant");
		return $total_orders;
	}
	public function get_order_count($date)
	{
		$total_orders = $this->conn->query("SELECT count(*) as c FROM orders where date='$date'");
		return $total_orders->fetch_assoc();
	}

	/*API DATA CALL*/

	public function test($data){

		$merchant_payment = $this->conn->query("INSERT INTO `test` (`id`, `name`, `msg`) VALUES (NULL, '".$data['name']."', '".$data['msg']."')");
		return $merchant_payment;
	}

	//get_general_info

	public function general(){

		$general = $this->conn->query("SELECT * FROM general");
		return $general;
	}


}