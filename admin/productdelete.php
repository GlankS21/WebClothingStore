<?php
include "class/product_class.php";
$product = new product();
if(!isset($_GET['product_id']) || $_GET['product_id'] == NULL){
    echo "<script>window.location = 'productlist.php'</script>";
}
else{
    $product_id = $_GET['product_id'];
}
$delete_product = $product ->delete_product($product_id); 
?>