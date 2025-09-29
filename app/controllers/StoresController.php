<?php

class StoresController extends BaseController {
    
    public function index() {
        // Get all stores
        $stmt = $this->db->prepare("
            SELECT * FROM stores 
            ORDER BY name
        ");
        $stmt->execute();
        $stores = $stmt->fetchAll();
        
        $this->render('stores/index', [
            'stores' => $stores,
            'title' => 'Store Locator - Nike Clone'
        ]);
    }
    
    public function show($id) {
        // Get store details
        $stmt = $this->db->prepare("SELECT * FROM stores WHERE id = ?");
        $stmt->execute([$id]);
        $store = $stmt->fetch();
        
        if (!$store) {
            http_response_code(404);
            $this->render('layouts/404');
            return;
        }
        
        // Get store inventory
        $stmt = $this->db->prepare("
            SELECT sa.*, p.name as product_name, p.price, p.image_url,
                   c.name as category_name
            FROM store_availability sa
            LEFT JOIN products p ON sa.product_id = p.id
            LEFT JOIN categories c ON p.category_id = c.id
            WHERE sa.store_id = ? AND sa.stock > 0
            ORDER BY p.name
        ");
        $stmt->execute([$id]);
        $inventory = $stmt->fetchAll();
        
        $this->render('stores/show', [
            'store' => $store,
            'inventory' => $inventory,
            'title' => $store['name'] . ' - Store Details'
        ]);
    }
}