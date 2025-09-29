<?php

class ProductController extends BaseController {
    
    public function show($id) {
        // Get product details
        $stmt = $this->db->prepare("
            SELECT p.*, c.name as category_name, c.slug as category_slug
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            WHERE p.id = ?
        ");
        $stmt->execute([$id]);
        $product = $stmt->fetch();
        
        if (!$product) {
            http_response_code(404);
            $this->render('layouts/404');
            return;
        }
        
        // Get product images
        $stmt = $this->db->prepare("
            SELECT * FROM product_images 
            WHERE product_id = ? 
            ORDER BY sort_order
        ");
        $stmt->execute([$id]);
        $images = $stmt->fetchAll();
        
        // Get product sizes
        $stmt = $this->db->prepare("
            SELECT ps.*, s.name as size_name 
            FROM product_sizes ps
            LEFT JOIN sizes s ON ps.size_id = s.id
            WHERE ps.product_id = ? AND ps.stock > 0
            ORDER BY s.sort_order
        ");
        $stmt->execute([$id]);
        $sizes = $stmt->fetchAll();
        
        // Get store availability
        $stmt = $this->db->prepare("
            SELECT sa.*, s.name as store_name, s.address, s.latitude, s.longitude, s.phone
            FROM store_availability sa
            LEFT JOIN stores s ON sa.store_id = s.id
            WHERE sa.product_id = ? AND sa.stock > 0
            ORDER BY s.name
        ");
        $stmt->execute([$id]);
        $storeAvailability = $stmt->fetchAll();
        
        // Get related products
        $stmt = $this->db->prepare("
            SELECT p.*, c.name as category_name 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            WHERE p.category_id = ? AND p.id != ? 
            ORDER BY RAND() 
            LIMIT 4
        ");
        $stmt->execute([$product['category_id'], $id]);
        $relatedProducts = $stmt->fetchAll();
        
        $this->render('product/show', [
            'product' => $product,
            'images' => $images,
            'sizes' => $sizes,
            'storeAvailability' => $storeAvailability,
            'relatedProducts' => $relatedProducts,
            'title' => $product['name'] . ' - Nike Clone'
        ]);
    }
}