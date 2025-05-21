<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../service/productService.php';

if (isset($_GET['category_id']) && is_numeric($_GET['category_id'])) {
    $service = new ProductService($conn);
    $brands = $service->show_brand((int)$_GET['category_id']);

    foreach ($brands as $brand) {
        echo '<option value="' . $brand['brand_id'] . '">' . htmlspecialchars($brand['brand_name']) . '</option>';
    }
}