<?php
class CategoryService {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }
    public function categoryAdd($category_name) {
        $sql = "INSERT INTO tbl_category (category_name) VALUES (:name)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['name' => $category_name]);
    }

    public function categoryDelete($category_id) {
        $sql = "DELETE FROM tbl_category WHERE category_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $category_id]);
        return $stmt->rowCount() > 0;
    }

    public function getCategories() {
        $sql = "SELECT * FROM tbl_category";
        $stmt = $this->conn->query($sql);
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }
}
?>
