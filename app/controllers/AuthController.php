<?php

class AuthController extends BaseController {
    
    public function loginForm() {
        if ($this->isAuthenticated()) {
            $this->redirect('/');
        }
        
        $this->render('auth/login', [
            'title' => 'Login - Nike Clone'
        ]);
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/login');
            return;
        }
        
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if (!$email || !$password) {
            $this->render('auth/login', [
                'error' => 'Please fill in all fields',
                'title' => 'Login - Nike Clone'
            ]);
            return;
        }
        
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if (!$user || !password_verify($password, $user['password'])) {
            $this->render('auth/login', [
                'error' => 'Invalid email or password',
                'title' => 'Login - Nike Clone'
            ]);
            return;
        }
        
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        
        $this->redirect('/');
    }
    
    public function registerForm() {
        if ($this->isAuthenticated()) {
            $this->redirect('/');
        }
        
        $this->render('auth/register', [
            'title' => 'Register - Nike Clone'
        ]);
    }
    
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/register');
            return;
        }
        
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        
        // Validation
        $errors = [];
        
        if (!$name) $errors[] = 'Name is required';
        if (!$email) $errors[] = 'Email is required';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email format';
        if (!$password) $errors[] = 'Password is required';
        if (strlen($password) < 6) $errors[] = 'Password must be at least 6 characters';
        if ($password !== $confirmPassword) $errors[] = 'Passwords do not match';
        
        // Check if email exists
        if (!$errors) {
            $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $errors[] = 'Email already exists';
            }
        }
        
        if ($errors) {
            $this->render('auth/register', [
                'errors' => $errors,
                'name' => $name,
                'email' => $email,
                'title' => 'Register - Nike Clone'
            ]);
            return;
        }
        
        // Create user
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("
            INSERT INTO users (name, email, password, created_at) 
            VALUES (?, ?, ?, NOW())
        ");
        $stmt->execute([$name, $email, $hashedPassword]);
        
        $userId = $this->db->lastInsertId();
        
        session_start();
        $_SESSION['user_id'] = $userId;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_email'] = $email;
        
        $this->redirect('/');
    }
    
    public function logout() {
        session_start();
        session_destroy();
        $this->redirect('/');
    }
}