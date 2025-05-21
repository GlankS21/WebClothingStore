<?php
class ProductService {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }
    public function show_category() {
        $query = "SELECT * FROM tbl_category ORDER BY category_id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function show_brand($category_id) {
        $query = "SELECT * FROM tbl_brand WHERE category_id = :category_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':category_id' => $category_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get_category_by_id($id) {
        $stmt = $this->db->prepare("SELECT * FROM tbl_category WHERE category_id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function get_brand_by_id($id) {
        $stmt = $this->db->prepare("SELECT * FROM tbl_brand WHERE brand_id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function show_size(){
        $query = "SELECT * FROM product_size";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function show_color(){
        $query = "SELECT * FROM product_color";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function show_product() {
        $query = "SELECT tbl_product.*, tbl_category.category_name, tbl_brand.brand_name 
                  FROM tbl_product 
                  INNER JOIN tbl_category ON tbl_product.category_id = tbl_category.category_id 
                  INNER JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id 
                  ORDER BY tbl_product.product_id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function show_product_by_brand($category, $brand) {
        $query = "SELECT tbl_product.*, tbl_category.category_name, tbl_brand.brand_name 
                    FROM tbl_product 
                    INNER JOIN tbl_category ON tbl_product.category_id = tbl_category.category_id 
                    INNER JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id 
                    WHERE tbl_product.category_id = ? AND tbl_product.brand_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$category, $brand]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function show_product_by_id($id) {
        $query = "SELECT * FROM tbl_product WHERE product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function show_product_img($id){
        $query = "SELECT * FROM tbl_product_img_desc WHERE product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function show_product_color($id) {
        $query = "SELECT pc.* 
                FROM product_color pc
                INNER JOIN product_variants_color pvc ON pc.id = pvc.color_id
                WHERE pvc.product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
    public function show_product_size($id){
        $query = "SELECT ps.* 
                FROM product_size ps
                INNER JOIN product_variants_size pvs ON ps.id = pvs.size_id
                WHERE pvs.product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
    public function get_random_products() {
        $query = "SELECT * FROM tbl_product ORDER BY RAND() LIMIT 5";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function sort_product_by_size_color($size, $color, $category, $brand) {
        $query = "SELECT tbl_product.*, tbl_category.category_name, tbl_brand.brand_name 
                FROM tbl_product 
                INNER JOIN tbl_category ON tbl_product.category_id = tbl_category.category_id 
                INNER JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id 
                WHERE tbl_product.category_id = :category AND tbl_product.brand_id = :brand";

        if ($size) {
            $query .= " AND tbl_product.product_id IN (SELECT product_id FROM product_variants_size WHERE size_id = :size)";
        }

        if ($color) {
            $query .= " AND tbl_product.product_id IN (SELECT product_id FROM product_variants_color WHERE color_id = :color)";
        }

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':brand', $brand);
        if ($size) $stmt->bindParam(':size', $size);
        if ($color) $stmt->bindParam(':color', $color);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insert_product() {
        $product_name = $_POST['name'];
        $category_id = $_POST['category_id'];
        $brand_id = $_POST['brand_id'];
        $product_price = $_POST['price'];
        $product_desc = $_POST['description'];
        $product_img = $_FILES['product_img']['name'];
        $tmp_img = $_FILES['product_img']['tmp_name'];
        $upload_dir = "../uploads/";
        $img_path = $upload_dir . basename($product_img);
        $product_size = $_POST['size'];
        $product_color = $_POST['color'];

        if ($product_img) {
            if (!move_uploaded_file($tmp_img, $img_path)) {return false;}
        }
        $query = "INSERT INTO tbl_product (name, category_id, brand_id, price, description, image, created_at)
                VALUES (:name, :category_id, :brand_id, :price, :description, :image, NOW())";
        $stmt = $this->db->prepare($query);
        $result = $stmt->execute([
            ':name' => $product_name,
            ':category_id' => $category_id,
            ':brand_id' => $brand_id,
            ':price' => $product_price,
            ':description' => $product_desc,
            ':image' => $product_img
        ]);

        if ($result) {
            $product_id = $this->db->lastInsertId();
            // Add size 
            foreach ($product_size as $size_id) {
                $variant_query = "INSERT INTO product_variants_size (product_id, size_id) VALUES (:product_id, :size_id)";
                $variant_stmt = $this->db->prepare($variant_query);
                $variant_stmt->execute([
                    ':product_id' => $product_id,
                    ':size_id' => $size_id
                ]);
            }
            // Add colors
            foreach ($product_color as $color_id) {
                $variant_query = "INSERT INTO product_variants_color (product_id, color_id)
                                VALUES (:product_id, :color_id)";
                $variant_stmt = $this->db->prepare($variant_query);
                $variant_stmt->execute([
                    ':product_id' => $product_id,
                    ':color_id' => $color_id
                ]);
            }
            // Add images 
            if (isset($_FILES['product_img_desc']) && is_array($_FILES['product_img_desc']['name'])) {
                $filenames = $_FILES['product_img_desc']['name'];
                $tmp_files = $_FILES['product_img_desc']['tmp_name'];
                foreach ($filenames as $key => $filename) {
                    $target_path = "../uploads/" . basename($filename);
                    if (move_uploaded_file($tmp_files[$key], $target_path)) {
                        $stmt = $this->db->prepare("INSERT INTO tbl_product_img_desc(product_id, product_img_desc) VALUES (:product_id, :desc_img)");
                        $stmt->execute([
                            ':product_id' => $product_id,
                            ':desc_img' => $filename
                        ]);
                    }
                }
            }
        }

        return $result;
    }
    public function delete_product($product_id) {
        $query = "SELECT product_img_desc FROM tbl_product_img_desc WHERE product_id = :product_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':product_id' => $product_id]);
        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($images as $image) {
            $img_path = "uploads/" . $image['product_img_desc'];
            if (file_exists($img_path)) {
                unlink($img_path);
            }
        }

        $delete_desc_query = "DELETE FROM tbl_product_img_desc WHERE product_id = :product_id";
        $stmt = $this->db->prepare($delete_desc_query);
        $stmt->execute([':product_id' => $product_id]);

        $delete_product_query = "DELETE FROM tbl_product WHERE product_id = :product_id";
        $stmt = $this->db->prepare($delete_product_query);
        return $stmt->execute([':product_id' => $product_id]);
    }
    public function get_size_name_by_id($id) {
        $query = "SELECT name FROM product_size WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['name'] : null;
    }
    public function get_color_id_by_hex_code($hex_code){
        $query = "SELECT id FROM product_color WHERE hex_code = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$hex_code]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['id'] : null;
    }
}
