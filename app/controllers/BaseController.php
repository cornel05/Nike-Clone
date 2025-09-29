<?php

abstract class BaseController {
    protected $db;
    
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->db = Database::getInstance()->getConnection();
    }
    
    protected function render($view, $data = []) {
        extract($data);
        
        ob_start();
        include __DIR__ . "/../views/{$view}.php";
        $content = ob_get_clean();
        
        include __DIR__ . '/../views/layouts/main.php';
    }
    
    protected function renderPartial($view, $data = []) {
        extract($data);
        include __DIR__ . "/../views/{$view}.php";
    }
    
    protected function json($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    
    protected function redirect($url) {
        header("Location: {$url}");
        exit;
    }
    
    protected function isAuthenticated() {
        return isset($_SESSION['user_id']);
    }
    
    protected function requireAuth() {
        if (!$this->isAuthenticated()) {
            $this->redirect('/login');
        }
    }
}