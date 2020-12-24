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
        $result = $this->conn->query("SELECT * FROM `admin` WHERE email='$email' and password='$password'");
        $user = $result->fetch_assoc();
        if (isset($user['id'])) {
            $_SESSION['userID'] = $user['id'];
            $_SESSION['userName'] = $user['name'];
            return true;
        } else {
            $_SESSION['error'] = 'Invalid email or password';
            return false;
        }
    }

    public function logout() {
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

    public function get_category_for_update($id) {
        $result = $this->conn->query("SELECT * FROM `category` WHERE categoryID=" . $id);
        return $result->fetch_assoc();
    }

    public function submit_updated_category($data) {
        $name = $data['name'];
        $categoryID = $data['categoryID'];
        $this->conn->query("UPDATE `category` SET `category_name` = '$name' WHERE `categoryID` = $categoryID");
    }

    function delete_category($id) {
        if ($this->is_logged_in()) {
            $this->conn->query('delete from category WHERE categoryID=' . $id);
        }
    }

    public function insert_delivery_man($data) {
        $d_name = $data['d_name'];
        $d_phone = $data['d_phone'];
        $d_email = $data['d_email'];
        $d_address = $data['d_address'];
        $password = $data['password'];
        $areaID = $data['areaID'];
        $this->conn->query("INSERT INTO `delivery_man` (`d_name`, `d_phone`, `d_email`, `d_address`, `password`, `areaID`) VALUES ('$d_name', '$d_phone', '$d_email', '$d_address', '$password', '$areaID');");
    }

    public function get_delivery_man() {

        $result = $this->conn->query("SELECT delivery_man.*, area.area_name as area FROM delivery_man join area on delivery_man.areaID=area.areaID");
        return $result;
    }

    public function edit_delivery_man($id) {
        $result = $this->conn->query("SELECT * FROM delivery_man WHERE dID=" . $id);
        $row = $result->fetch_assoc();
        return $row;
    }

    public function update_delivery_man($data) {
        $id = $data['newID'];
        $name = $data['d_name'];
        $phone = $data['d_phone'];
        $email = $data['d_email'];
        $address = $data['d_address'];
        $password = $data['password'];
        $areaID = $data['areaID'];
        $sql = $this->conn->query("UPDATE delivery_man SET d_name='$name', d_phone='$phone', d_email='$email', d_address='$address', password='$password', areaID='$areaID'  WHERE  dID=$id");
    }

    public function delete_delivery_man($deleteID) {
        if ($deleteID != "") {
            return $this->conn->query("DELETE FROM delivery_man WHERE dID=$deleteID");
        }
    }

    public function insert_marchent($marcent) {
        $marcentName = $marcent['m_name'];
        $marcentAddress = $marcent['m_address'];
        $marcentPhone = $marcent['m_phone'];
        $marcentEmail = $marcent['m_email'];
        $password = $marcent['m_password'];
        $areaID = $marcent['areaID'];

        $this->conn->query("INSERT INTO `merchant` (`m_name`, `m_address`, `m_phone`, `m_email`, `m_password`, areaID) VALUES ('$marcentName', '$marcentAddress', '$marcentPhone', '$marcentEmail', '$password',$areaID)");
    }

    public function get_marchent() {
        $result = $this->conn->query("SELECT merchant.*, area.area_name as area FROM merchant join area on merchant.areaID=area.areaID");
        return $result;
    }

    public function edit_merchant($id) {
        $result = $this->conn->query("SELECT * FROM merchant WHERE merchantID=$id");
        $row = $result->fetch_assoc();
        return $row;
    }

    public function update_merchant($data) {
        $marcentName = $data['m_name'];
        $marcentAddress = $data['m_address'];
        $marcentPhone = $data['m_phone'];
        $marcentEmail = $data['m_email'];
        $password = $data['m_password'];
        $areaID = $data['areaID'];
        $id = $data['editID'];

        $this->conn->query("UPDATE merchant SET m_name='$marcentName', m_address='$marcentAddress', m_phone='$marcentPhone', m_email='$marcentEmail', m_password='$password', areaID ='$areaID' WHERE  merchantID=$id");
    }

    public function delete_merchant($deleteID) {
        if ($deleteID != "") {
            return $this->conn->query("DELETE FROM merchant WHERE merchantID=$deleteID");
        }
    }

    public function insert_area($area) {
        $areaName = $area['area_name'];
        $manager = $area['manager'];
        $this->conn->query("INSERT INTO area(area_name,manager) VALUES ('$areaName','$manager')");
    }

    public function get_area() {
        $result = $this->conn->query("SELECT area.*,employee.emp_name,employee.designation,employee.empID FROM area join employee on area.manager=employee.empID");
        return $result;
    }

    function get_area_manager() {
        $data = $this->conn->query("SELECT * FROM employee WHERE designation='area_manager'");
        return $data;
    }

    public function edit_area($id) {
        $result = $this->conn->query("SELECT * FROM area WHERE areaID=$id");
        $row = $result->fetch_assoc();
        return $row;
    }

    public function update_area($data) {
        $areaName = $data['area_name'];
        $manager = $data['manager'];
        $id = $data['updateID'];

        $this->conn->query("UPDATE area SET area_name='$areaName', manager='$manager' WHERE  areaID=$id");
    }

    public function delete_area($deleteID) {
        if ($deleteID != "") {
            return $this->conn->query("DELETE FROM area WHERE areaID=$deleteID");
        }
    }

    //all employee functions
    //get employee
    public function get_employee() {
        $result = $this->conn->query("SELECT * FROM employee ");
        return $result;
    }

    //add_employee function
    public function add_employee($data) {
        $empName = $data['empName'];
        $designation = $data['designation'];
        $empPhone = $data['empPhone'];
        $empEmail = $data['empEmail'];
        $empAddress = $data['empAddress'];
        $empPassword = $data['empPassword'];
        $this->conn->query("INSERT INTO `employee` (`emp_name`, `designation`, `emp_phone`, `emp_email`, `emp_address`, `password`) VALUES ('$empName','$designation','$empPhone','$empEmail','$empAddress','$empPassword')");
    }

    public function get_employee_for_update($id) {
        $result = $this->conn->query("SELECT * FROM `employee` WHERE empID=" . $id);
        return $result->fetch_assoc();
    }

    //update employee
    public function update_employee($d) {
        $empName = $d['empName'];
        $designation = $d['designation'];
        $empPhone = $d['empPhone'];
        $empEmail = $d['empEmail'];
        $empAddress = $d['empAddress'];
        $empPassword = $d['empPassword'];
        $empId = $d['empId'];
        $this->conn->query(" UPDATE `employee` SET `emp_name` = '$empName', `designation` = '$designation', `emp_phone` = '$empPhone', `emp_email` = '$empEmail', `emp_address`='$empAddress',`password` = '$empPassword' WHERE `empID` = $empId ");
    }

    //delete employee
    public function delete_employee($id) {
        if (isset($id)) {
            $this->conn->query('delete from employee Where empID=' . $id);
        }
    }

    public function check_report($c) {
        $startdate = $c['startdate'];
        $enddate = $c['enddate'];
        $ID = $c['delivery_id'];
        $result = $this->conn->query("SELECT delivery_man.d_name,orders.delivery_man,orders.orderID,orders.date,orders.feedback,orders.delivery_address,orders.fee FROM orders JOIN  delivery_man on delivery_man.dID=orders.delivery_man  WHERE( delivery_man='$ID' AND status='delivered' AND date BETWEEN '$startdate' AND '$enddate')");
        return $result;
    }

    public function check_pickup_report($c) {
        $startdate = $c['startdate'];
        $enddate = $c['enddate'];
        $ID = $c['delivery_id'];
        $result = $this->conn->query("SELECT delivery_man.d_name,orders.delivery_man,orders.orderID,orders.date,orders.feedback,orders.delivery_address,orders.fee FROM orders JOIN  delivery_man on delivery_man.dID=orders.delivery_man  WHERE( delivery_man='$ID' AND status='picked_up' AND date BETWEEN '$startdate' AND '$enddate')");
        return $result;
    }
    public function check_delivery_report($c) {
        $startdate = $c['startdate'];
        $enddate = $c['enddate'];
        $ID = $c['delivery_id'];
        $result = $this->conn->query("SELECT delivery_man.d_name,orders.delivery_man,orders.orderID,orders.date,orders.feedback,orders.delivery_address,orders.fee FROM orders JOIN  delivery_man on delivery_man.dID=orders.delivery_man  WHERE( delivery_man='$ID' AND status='delivered' AND date BETWEEN '$startdate' AND '$enddate')");
        return $result;
    }

    public function get_delivery() {
        $result = $this->conn->query("SELECT delivery_man.d_name, orders.delivery_man as delivery_man FROM orders join delivery_man on delivery_man.dID=orders.delivery_man");
        return $result;
    }

    public function get_all_pickup() {
        $data = $this->conn->query("SELECT delivery_man.dID, delivery_man.d_name,COUNT(orderID) AS total FROM orders JOIN delivery_man ON delivery_man.dID=delivery_man WHERE status='picked_up'");
        return $data;
    }
    public function get_all_delivered() {
        $data = $this->conn->query("SELECT delivery_man.dID, delivery_man.d_name,COUNT(orderID) AS total FROM orders JOIN delivery_man ON delivery_man.dID=delivery_man WHERE status='delivered'");
        return $data;
    }

    public function get_pickman_details($data) {
        $id = $data['id'];
        $d = $this->conn->query("SELECT delivery_man.d_name,COUNT(orderID) AS total,orders.fee,(COUNT(orderID)*orders.fee) as total_fee,orders.date,orders.orderID,delivery_man.d_phone,delivery_man.d_address,orders.merchantID,orders.pickup_address,merchant.m_address FROM delivery_man JOIN orders ON delivery_man.dID=orders.delivery_man JOIN merchant ON orders.merchantID=merchant.merchantID WHERE status='picked_up' OR delivery_man=$id");
        return $d;
    }
    public function get_delivery_details($data) {
        $id = $data['id'];
        $d = $this->conn->query("SELECT delivery_man.d_name,COUNT(orderID) AS total,orders.fee,(COUNT(orderID)*orders.fee) as total_fee,orders.date,orders.orderID,delivery_man.d_phone,delivery_man.d_address,orders.merchantID,orders.delivery_address,merchant.m_address FROM delivery_man JOIN orders ON delivery_man.dID=orders.delivery_man JOIN merchant ON orders.merchantID=merchant.merchantID WHERE status='delivered' OR delivery_man=$id");
        return $d;
    }

}
