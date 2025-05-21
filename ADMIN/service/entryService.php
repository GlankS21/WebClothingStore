<?php 
class entryService {
    private $db;
    public function __construct($conn) {
        $this->db = $conn;
    }
    public function login($user_name, $user_password) {
        try{
            $sql = "SELECT * FROM tbl_user WHERE user_name = :username";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['username' => $user_name]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if($user && $user_password == $user['user_password']){
                return $user;
            }
            return false;
        } catch(PDOException $e){
            return false;
        }
    }
    public function register($lastname, $firstname, $email, $username, $birthday, $gender, $address, $password) {
        try {
            $sql = "SELECT COUNT(*) FROM tbl_user WHERE user_name = :username";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':username' => $username]);
            $count = $stmt->fetchColumn();
            if($count > 0){
                return false;
            }
            $sql = "INSERT INTO tbl_user (firstname, lastname, email, user_name, birthday, gender, address, user_password, user_role)
                    VALUES (:firstname, :lastname, :email, :username, :birthday, :gender, :address, :password, :role)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                    'firstname' => $firstname,
                    'lastname'  => $lastname,
                    'email'     => $email,
                    'username'  => $username,
                    'birthday'  => $birthday,
                    'gender'    => $gender,
                    'address'   => $address,
                    'password'  => $password,
                    'role'      => 0 
                ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}
?>