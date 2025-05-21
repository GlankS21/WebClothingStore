<?php
class BrandService {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }
    public function insert_brand($category_id, $brand_name){
        $query = "INSERT INTO tbl_brand (category_id, brand_name) VALUES (:category_id, :brand_name)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':category_id' => (int)$category_id,
            ':brand_name' => $brand_name
        ]);
    }

    public function show_category(){
        $query = "SELECT * FROM tbl_category ORDER BY category_id DESC";
        return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function show_brand(){
        $query = "SELECT tbl_brand.*, tbl_category.category_name 
                  FROM tbl_brand 
                  INNER JOIN tbl_category ON tbl_brand.category_id = tbl_category.category_id
                  ORDER BY tbl_brand.brand_name DESC";
        return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_brand($brand_id){
        $query = "SELECT * FROM tbl_brand WHERE brand_id = :brand_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':brand_id' => (int)$brand_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update_brand($category_id, $brand_name, $brand_id){
        $query = "UPDATE tbl_brand 
                  SET category_id = :category_id, brand_name = :brand_name 
                  WHERE brand_id = :brand_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':category_id' => (int)$category_id,
            ':brand_name' => $brand_name,
            ':brand_id' => (int)$brand_id
        ]);
    }

    public function delete_brand($brand_id){
        $query = "DELETE FROM tbl_brand WHERE brand_id = :brand_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':brand_id' => (int)$brand_id]);
    }

    public function search_by_category_id($category_id){
        $query = "SELECT * FROM tbl_brand WHERE category_id = :category_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':category_id' => (int)$category_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
