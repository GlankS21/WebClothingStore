<?php
class CartService {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }
    public function search_by_id($user_id){
        $query = "SELECT * FROM tbl_cart WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':user_id' => (int)$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function add_product($user_id, $product_id, $hex_code, $size_id, $quantity) {
        $user_id = (int)$user_id;
        $product_id = (int)$product_id;
        $size_id = (int)$size_id;
        $quantity = (int)$quantity;
        $checkQuery = "SELECT quantity FROM tbl_cart WHERE user_id = :user_id 
                        AND product_id = :product_id AND hex_code = :hex_code AND size_id = :size_id";
        $stmt = $this->conn->prepare($checkQuery);
        $stmt->execute([
            ':user_id' => $user_id, ':product_id' => $product_id,
            ':hex_code' => $hex_code, ':size_id' => $size_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $updateQuery = "UPDATE tbl_cart SET quantity = quantity + :quantity WHERE user_id = :user_id AND product_id = :product_id 
                            AND hex_code = :hex_code AND size_id = :size_id";
            $updateStmt = $this->conn->prepare($updateQuery);
            return $updateStmt->execute([
                ':quantity' => $quantity, ':user_id' => $user_id,
                ':product_id' => $product_id, ':hex_code' => $hex_code,
                ':size_id' => $size_id]);
        } else {
            $insertQuery = "INSERT INTO tbl_cart (user_id, product_id, hex_code, size_id, quantity) 
                            VALUES (:user_id, :product_id, :hex_code, :size_id, :quantity)";
            $insertStmt = $this->conn->prepare($insertQuery);
            return $insertStmt->execute([
                ':user_id' => $user_id, ':product_id' => $product_id,
                ':hex_code' => $hex_code,':size_id' => $size_id,':quantity' => $quantity
            ]);
        }
    }
    public function delete_product($user_id, $product_id, $hex_code, $size_name) {
        $size_id = $this->get_size_id_by_name($size_name);
        if (!$size_id) return false;
        $sql = "DELETE FROM tbl_cart WHERE user_id = :user_id AND product_id = :product_id AND hex_code = :hex_code AND size_id = :size_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':user_id' => $user_id, ':product_id' => $product_id,
            ':hex_code' => $hex_code, ':size_id' => $size_id
        ]);
    }
    public function get_size_id_by_name($size_name) {
        $sql = "SELECT id FROM product_size WHERE name = :name LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':name' => $size_name]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['id'] : null;
    }
    public function get_cart_item($user_id, $product_id, $color, $size_name) {
        $size_id = $this->get_size_id_by_name($size_name);
        $sql = "SELECT * FROM tbl_cart WHERE user_id = :user_id AND product_id = :product_id AND hex_code = :hex_code AND size_id = :size_id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':user_id' => (int)$user_id,
            ':product_id' => (int)$product_id,
            ':hex_code' => $color,
            ':size_id' => $size_id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function update_quantity($user_id, $product_id, $color, $size_name, $newQuantity) {
        $size_id = $this->get_size_id_by_name($size_name);
        $sql = "UPDATE tbl_cart SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id AND hex_code = :hex_code AND size_id = :size_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':quantity' => (int)$newQuantity,
            ':user_id' => (int)$user_id,
            ':product_id' => (int)$product_id,
            ':hex_code' => $color,
            ':size_id' => $size_id
        ]);
    }
}
