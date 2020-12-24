<?php
session_start();
class Controller
{
	private $conn;
	function __construct($host, $user, $password, $dbName)
	{
		$this->conn = new mysqli($host, $user, $password, $dbName);
	}
	function is_logged_in()
	{
		if (isset($_SESSION['userID'])) {
			return true;
		} else {
			return false;
		}
	}
	public function login($data)
	{
		$email = $data['email'];
		$password = $data['password'];
		$result = $this->conn->query("SELECT * FROM merchant WHERE m_email='$email' and m_password='$password'");
		$merchantUser = $result->fetch_assoc();
		if (isset($merchantUser['merchantID'])) {
			$_SESSION['merchantUser'] = $merchantUser['merchantID'];
			$_SESSION['merchantName'] = $merchantUser['m_name'];
			return true;
		} else {
			$_SESSION['error'] = 'Invalid email or password';
			return false;
		}
	}
	public function logout()
	{
		session_destroy();
		return true;
	}
	public function get_order_merchant_to_insert()
	{
		$arr = [];
		$first = $this->conn->query("SELECT * FROM orders JOIN merchant ON orders.merchantID = merchant.merchantID");


		$second = $this->conn->query("SELECT orders.orderID, orders.priority, orders.status, orders.delivery_address, orders.customer_name, orders.customer_phone, orders.date,orders.fee,SUM(order_details.qty*order_details.price) as total FROM `order_details` JOIN orders ON order_details.orderID=orders.orderID GROUP BY orderID");

		$arr = ['first' => $first, 'second' => $second];
		return $arr;
	}


	function product_details($order_id)
	{
		$query = $this->conn->query("SELECT * FROM `product_details` WHERE orderID =" . $order_id);
		return $query->fetch_assoc();
	}


	public function get_category()
	{

		$arr_order_insert = [];
		$query_cate = $this->conn->query("SELECT * FROM category");
		$query_area = $this->conn->query("SELECT * FROM area");
		$arr_order_insert = ['query_cate' => $query_cate, 'query_area' => $query_area];
		return $arr_order_insert;
	}

	public function new_order($new_order)
	{

		// $_SESSION['merchantUser']=$merchantUser['merchantID'];

		$date = date('Y-m-d');
		$cust_name = $new_order['cust_name'];
		$cust_phone = $new_order['cust_phone'];
		$priority = $new_order['priority'];
		$p_area = $new_order['p_area'];
		$p_add = $new_order['p_add'];
		$d_area = $new_order['d_area'];
		$d_add = $new_order['d_add'];
		$order_type = $new_order['order_type'];
		$merchantUser_id = $new_order['merchantUser_id'];

		$this->conn->query("INSERT INTO orders (merchantID,customer_name,customer_phone, date, priority, pickup_address, delivery_address, pickup_area, delivery_area, order_type) VALUES ($merchantUser_id,'$cust_name','$cust_phone','$date','$priority','$p_add','$d_add',$p_area,$d_area,'$order_type')");


		$orderID =  $this->conn->insert_id;

		foreach ($new_order['p_name'] as $i => $v) {
			$productName = $new_order['p_name'][$i];
			$cate_name = $new_order['cate_name'][$i];
			$weight = $new_order['weight'][$i];
			$price = $new_order['price'][$i];
			$quantity = $new_order['quantity'][$i];


			$this->conn->query("INSERT INTO order_details (orderID, product, qty, wieght, categoryID,price) VALUES ( $orderID, '$productName', '$quantity', '$weight','$cate_name', '$price')");
			// return "INSERT INTO order_details (orderID, product, qty, wieght, categoryID,price) VALUES ( $orderID, '$productName', '$quantity', '$weight','$cate_name', '$price')";
		}
	}
	public function get_order_details_sheet($orderID)
	{
		$arr = [];

		$query1 = $this->conn->query("SELECT `orderID`,`order_type`,`date`,`pickup_address`,`delivery_address`,`customer_name`,`customer_phone` FROM orders WHERE orderID =" . $orderID);

		$query2 = $this->conn->query("SELECT order_details.product as product_name,order_details.qty as qty,order_details.wieght as wieght,order_details.price as price,category.category_name as category_name,category.extra_charge as extra_charge ,orders.orderID as orderID,orders.fee as delivery_fee,((order_details.price*order_details.qty)+orders.fee+category.extra_charge) as total FROM order_details JOIN category ON order_details.categoryID = category.categoryID JOIN orders ON order_details.orderID=orders.orderID WHERE order_details.orderID=" . $orderID);

		$arr = ['first' => $query1, 'second' => $query2];
		return $arr;
	}
	public function delete_order($delete_id)
	{
		$this->conn->query("DELETE FROM orders WHERE orders.orderID =" . $delete_id);
	}

	public function search_order($sr_data)
	{
		$sr_customer_name = $sr_data['sr_customer_name'];
		$sr_start_date = $sr_data['sr_start_date'];
		$sr_end_date = $sr_data['sr_end_date'];

		if (!empty($sr_customer_name) && empty($sr_start_date && $sr_end_date)) {
			$sr_query = $this->conn->query("SELECT orders.orderID, orders.priority, orders.status, orders.delivery_address, orders.customer_name, orders.customer_phone, orders.date,orders.fee,SUM(order_details.qty*order_details.price) as total FROM `order_details` JOIN orders ON order_details.orderID=orders.orderID WHERE orders.customer_name='$sr_customer_name' GROUP BY orderID");
			return $sr_query;
		}
	}



	public function get_data_for_payment()
	{
		$data = $this->conn->query("SELECT orders.orderID as order_id, orders.date as date, SUM(order_details.price + orders.fee) as amount FROM `orders` JOIN order_details ON orders.orderID= order_details.orderID GROUP BY orders.orderID");
		return $data;
	}
	public function get_payment_method()
	{
		$id = $_SESSION['merchantUser'];
		$first = $this->conn->query("SELECT * FROM `merchant_payemt` WHERE merchantID= $id");
		$second = $this->conn->query("SELECT SUM(amount) as total FROM merchant_payemt WHERE  merchantID= " . $id);
		$result = array('first' => $first, 'second' => $second);
		return $result;
	}

	//for date between data 
	public function get_payment_method_for_date($date)
	{
		$id = $_SESSION['merchantUser'];
		$f_date = $date['f_date'];
		$l_date = $date['l_date'];
		$first = $this->conn->query("SELECT * FROM `merchant_payemt` WHERE  date BETWEEN '$f_date' AND '$l_date' and merchantID= $id");
		$second = $this->conn->query("SELECT SUM(amount) as total FROM merchant_payemt WHERE date BETWEEN '$f_date' AND '$l_date' and merchantID= $id");
		$arr = array('first' => $first, 'second' => $second);
		return $arr;
	}



	public function order_details_update($orderID)
	{
		$result = $this->conn->query("SELECT * FROM order_details where orderID=" . $orderID);
		return $result;
	}
	public function total_update_for_order($orderID)
	{
		$order_total = $this->conn->query("SELECT sum(price * qty) as order_total FROM order_details where orderID=" . $orderID);
		return $order_total->fetch_assoc();
	}

	public function get_order_update($orderID)
	{
		$order_update = $this->conn->query("SELECT customer_name, customer_phone, priority, pickup_area, pickup_address, delivery_area, delivery_address, order_type FROM orders WHERE orderID =" . $orderID);
		return $order_update->fetch_assoc();
	}

	public function update_order($update_order, $orderID)
	{
		$cust_name = $update_order['cust_name'];
		$cust_phone = $update_order['cust_phone'];
		$priority = $update_order['priority'];
		$p_area = $update_order['p_area'];
		$p_add = $update_order['p_add'];
		$d_area = $update_order['d_area'];
		$d_add = $update_order['d_add'];
		$order_type = $update_order['order_type'];

		$this->conn->query("UPDATE orders SET customer_name='$cust_name', customer_phone='$cust_phone', priority='$priority',pickup_address='$p_add',delivery_address='$d_add',pickup_area=$p_area,delivery_area=$d_area,order_type='$order_type' WHERE orderID=" . $orderID);

		// foreach ($update_order['p_name'] as $i => $v) {
		// 	$quantity    = $update_order['quantity'][$i];
		// 	$order_details_id   = $update_order['order_details_id'][$i];
			$this->conn->query("DELETE FROM order_details  WHERE  orderID=".$orderID);
		// }
		foreach ($update_order['p_name'] as $i => $v) {
			$productName = $update_order['p_name'][$i];
			$cate_name   = $update_order['cate_name'][$i];
			$weight      = $update_order['weight'][$i];
			$price       = $update_order['price'][$i];
			$quantity    = $update_order['quantity'][$i];
			$this->conn->query("INSERT INTO order_details (orderID, product, qty, wieght, categoryID,price) VALUES ( $orderID, '$productName', '$quantity', '$weight','$cate_name', '$price')");
		}
	}

}
