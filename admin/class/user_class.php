<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/shop/admin/database.php";
?>

<?php
class user { 
    private $db;
    public function __construct(){
        $this -> db = new Database();
    }
    public function check_user($user_name, $user_password) {
        $query = "SELECT * FROM tbl_user WHERE user_name = '$user_name' AND user_password = '$user_password'";
        $result = $this->db->select($query);
        if ($result) {
            $user = $result->fetch_assoc();
            return $user['user_role'];
        }
        return false;
    }
    public function get_user($user_name, $user_password) {
        $query = "SELECT * FROM tbl_user WHERE user_name = '$user_name' AND user_password = '$user_password'";
        $result = $this->db->select($query);
        if ($result) return $result;
        return false;
    }
}
?>