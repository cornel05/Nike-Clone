<?php

class ApiController extends BaseController {
    
    public function searchProducts() {
        $query = $_GET['q'] ?? '';
        $limit = min(10, (int)($_GET['limit'] ?? 10));
        
        if (!$query) {
            $this->json(['products' => []]);
            return;
        }
        
        $searchTerm = "%{$query}%";
        $stmt = $this->db->prepare("
            SELECT p.id, p.name, p.price, p.image_url, c.name as category_name
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            WHERE p.name LIKE ? OR p.description LIKE ?
            ORDER BY p.name ASC
            LIMIT {$limit}
        ");
        $stmt->execute([$searchTerm, $searchTerm]);
        $products = $stmt->fetchAll();
        
        $this->json(['products' => $products]);
    }
    
    public function nearbyStores() {
        $lat = (float)($_GET['lat'] ?? 0);
        $lng = (float)($_GET['lng'] ?? 0);
        $radius = min(50, (int)($_GET['radius'] ?? 10)); // Max 50km radius
        
        if (!$lat || !$lng) {
            $this->json(['stores' => []]);
            return;
        }
        
        // Using Haversine formula to calculate distance
        $stmt = $this->db->prepare("
            SELECT *, 
                (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * 
                cos(radians(longitude) - radians(?)) + sin(radians(?)) * 
                sin(radians(latitude)))) AS distance
            FROM stores 
            HAVING distance <= ? 
            ORDER BY distance 
            LIMIT 20
        ");
        $stmt->execute([$lat, $lng, $lat, $radius]);
        $stores = $stmt->fetchAll();
        
        $this->json(['stores' => $stores]);
    }
    
    public function launchNotify() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['success' => false, 'message' => 'Invalid request method']);
            return;
        }
        
        if (!$this->isAuthenticated()) {
            $this->json(['success' => false, 'message' => 'Authentication required']);
            return;
        }
        
        $input = json_decode(file_get_contents('php://input'), true);
        $launchId = (int)($input['launch_id'] ?? 0);
        
        if (!$launchId) {
            $this->json(['success' => false, 'message' => 'Launch ID required']);
            return;
        }
        
        // Check if launch exists
        $stmt = $this->db->prepare("SELECT id FROM launches WHERE id = ?");
        $stmt->execute([$launchId]);
        if (!$stmt->fetch()) {
            $this->json(['success' => false, 'message' => 'Launch not found']);
            return;
        }
        
        // Check if already notified
        $stmt = $this->db->prepare("
            SELECT id FROM launch_notifications 
            WHERE launch_id = ? AND user_id = ?
        ");
        $stmt->execute([$launchId, $_SESSION['user_id']]);
        if ($stmt->fetch()) {
            $this->json(['success' => false, 'message' => 'Already signed up for notifications']);
            return;
        }
        
        // Add notification
        $stmt = $this->db->prepare("
            INSERT INTO launch_notifications (launch_id, user_id, created_at) 
            VALUES (?, ?, NOW())
        ");
        $stmt->execute([$launchId, $_SESSION['user_id']]);
        
        $this->json(['success' => true, 'message' => 'Notification added successfully']);
    }
}