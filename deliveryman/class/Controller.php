<?php

session_start();

class Controller {

    private $conn;

    function __construct($host, $user, $password, $dbName) {
	$this->conn = new mysqli($host, $user, $password, $dbName);
    }

    function is_logged_in() {
	if (isset($_SESSION['userID'])) {
	    return true;
	} else {
	    return false;
	}
    }

    public function login($data) {
	$email = $data['email'];
	$password = md5($data['password']);
	$result = $this->conn->query("SELECT * FROM `delivery_man` WHERE d_email='$email' and password='$password'");
	$user = $result->fetch_assoc();
	if (isset($user['dID'])) {
		$id=$user['dID'];
		$date=date("Y-m-d");
		$_SESSION['date']=date("Y-m-d");
	    $_SESSION['userID'] = $user['dID'];
		$_SESSION['userName'] = $user['d_name'];
		$check=$this->conn->query("SELECT * FROM delivery_man_attendance WHERE date='$date' and delivery_manID='$id'");
		$at=$check->fetch_assoc();
		if($at['id']==''){
		$this->conn->query("INSERT INTO `delivery_man_attendance` (`delivery_manID`, `date`, `status`) VALUES ('$id','$date', 'logged_in')");
		}else{
			$this->conn->query("UPDATE `delivery_man_attendance` SET `status`= 'logged_in'  WHERE `delivery_manID`= '$id' and '$date'");
		}
	    return true;
	}else {
	    $_SESSION['error'] = 'Invalid email or password';
	    return false;
	}
    }

    public function logout() {
	$date=date("Y/m/d");
	$id=$_SESSION['userID'];
	$this->conn->query("UPDATE `delivery_man_attendance` SET `status`= 'logged_out'  WHERE `delivery_manID`= '$id' and '$date'");
	session_destroy();
	return true;
    }

    public function get_category() {
	$result = $this->conn->query("SELECT * FROM `category`");
	return $result;
    }

    public function add_category($name) {
	if ($name != '') {
	    $this->conn->query("INSERT INTO `category` (`category_name`) VALUES ('$name')");
	}
    }

    public function get_delivery(){
	$id=$_SESSION['userID'];
	$result = $this->conn->query("SELECT orders.*,delivery_man.d_name, orders.delivery_man as delivery_man FROM orders join delivery_man on delivery_man.dID=orders.delivery_man WHERE delivery_man= $id");
	return $result;
	}
    public function get_delivery2(){
	$result = $this->conn->query("SELECT orders.*,delivery_man.d_name, orders.delivery_man as delivery_man FROM orders join delivery_man on delivery_man.dID=orders.delivery_man");
	return $result;
	}

	public function today_delivery(){
		$date=date("Y-m-d");
		$id=$_SESSION['userID'];
		$result=$this->conn->query("SELECT orders.*,delivery_man.d_name, orders.delivery_man as delivery_man FROM orders join delivery_man on delivery_man.dID=orders.delivery_man WHERE delivery_man=$id and date='$date'");
		return $result;
	}
	public function get_employee() {
        $result = $this->conn->query("SELECT * FROM employee ");
        return $result;
    }
		
}