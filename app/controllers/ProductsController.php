<?php

class ProductsController extends BaseController {
    
    public function index() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 12;
        $offset = ($page - 1) * $limit;
        
        $category = $_GET['category'] ?? '';
        $sort = $_GET['sort'] ?? 'name';
        $order = $_GET['order'] ?? 'ASC';
        
        // Build query
        $whereClause = '';
        $params = [];
        
        if ($category) {
            $whereClause = 'WHERE c.slug = ?';
            $params[] = $category;
        }
        
        // Get total count
        $countSql = "
            SELECT COUNT(*) as total 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            {$whereClause}
        ";
        $stmt = $this->db->prepare($countSql);
        $stmt->execute($params);
        $total = $stmt->fetch()['total'];
        
        // Get products
        $sql = "
            SELECT p.*, c.name as category_name, c.slug as category_slug
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            {$whereClause}
            ORDER BY p.{$sort} {$order}
            LIMIT {$limit} OFFSET {$offset}
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $products = $stmt->fetchAll();
        
        // Get categories for filter
        $stmt = $this->db->prepare("SELECT * FROM categories ORDER BY name");
        $stmt->execute();
        $categories = $stmt->fetchAll();
        
        $totalPages = ceil($total / $limit);
        
        $this->render('products/index', [
            'products' => $products,
            'categories' => $categories,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'total' => $total,
            'category' => $category,
            'sort' => $sort,
            'order' => $order,
            'title' => 'Products - Nike Clone'
        ]);
    }
    
    public function search() {
        $query = $_GET['q'] ?? '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 12;
        $offset = ($page - 1) * $limit;
        
        if (!$query) {
            $this->redirect('/products');
            return;
        }
        
        // Get total count
        $countSql = "
            SELECT COUNT(*) as total 
            FROM products p 
            WHERE p.name LIKE ? OR p.description LIKE ?
        ";
        $searchTerm = "%{$query}%";
        $stmt = $this->db->prepare($countSql);
        $stmt->execute([$searchTerm, $searchTerm]);
        $total = $stmt->fetch()['total'];
        
        // Get products
        $sql = "
            SELECT p.*, c.name as category_name, c.slug as category_slug
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            WHERE p.name LIKE ? OR p.description LIKE ?
            ORDER BY p.name ASC
            LIMIT {$limit} OFFSET {$offset}
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$searchTerm, $searchTerm]);
        $products = $stmt->fetchAll();
        
        $totalPages = ceil($total / $limit);
        
        $this->render('products/search', [
            'products' => $products,
            'query' => $query,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'total' => $total,
            'title' => "Search Results for '{$query}' - Nike Clone"
        ]);
    }
}