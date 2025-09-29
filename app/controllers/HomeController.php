<?php

class HomeController extends BaseController {
    
    public function index() {
        // Get featured products
        $stmt = $this->db->prepare("
            SELECT p.*, c.name as category_name 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            WHERE p.featured = 1 
            ORDER BY p.created_at DESC 
            LIMIT 8
        ");
        $stmt->execute();
        $featuredProducts = $stmt->fetchAll();
        
        // Get upcoming launches
        $stmt = $this->db->prepare("
            SELECT * FROM launches 
            WHERE launch_date > NOW() 
            ORDER BY launch_date ASC 
            LIMIT 3
        ");
        $stmt->execute();
        $upcomingLaunches = $stmt->fetchAll();
        
        $this->render('home/index', [
            'featuredProducts' => $featuredProducts,
            'upcomingLaunches' => $upcomingLaunches,
            'title' => 'Nike Clone - Just Do It'
        ]);
    }
}