<?php

class LaunchesController extends BaseController {
    
    public function index() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 6;
        $offset = ($page - 1) * $limit;
        
        // Get total count
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM launches");
        $stmt->execute();
        $total = $stmt->fetch()['total'];
        
        // Get launches
        $stmt = $this->db->prepare("
            SELECT l.*, p.name as product_name, p.price, p.image_url 
            FROM launches l
            LEFT JOIN products p ON l.product_id = p.id
            ORDER BY l.launch_date DESC
            LIMIT {$limit} OFFSET {$offset}
        ");
        $stmt->execute();
        $launches = $stmt->fetchAll();
        
        $totalPages = ceil($total / $limit);
        
        $this->render('launches/index', [
            'launches' => $launches,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'total' => $total,
            'title' => 'SNKRS Launches - Nike Clone'
        ]);
    }
    
    public function show($id) {
        // Get launch details
        $stmt = $this->db->prepare("
            SELECT l.*, p.name as product_name, p.description, p.price, p.image_url,
                   c.name as category_name
            FROM launches l
            LEFT JOIN products p ON l.product_id = p.id
            LEFT JOIN categories c ON p.category_id = c.id
            WHERE l.id = ?
        ");
        $stmt->execute([$id]);
        $launch = $stmt->fetch();
        
        if (!$launch) {
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
        $stmt->execute([$launch['product_id']]);
        $images = $stmt->fetchAll();
        
        // Check if user has signed up for notifications
        $hasNotification = false;
        if ($this->isAuthenticated()) {
            $stmt = $this->db->prepare("
                SELECT id FROM launch_notifications 
                WHERE launch_id = ? AND user_id = ?
            ");
            $stmt->execute([$id, $_SESSION['user_id']]);
            $hasNotification = $stmt->fetch() !== false;
        }
        
        $this->render('launches/show', [
            'launch' => $launch,
            'images' => $images,
            'hasNotification' => $hasNotification,
            'title' => $launch['title'] . ' - SNKRS Launch'
        ]);
    }
}