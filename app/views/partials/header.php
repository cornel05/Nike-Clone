<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $_SESSION['user_name'] ?? '';
?>

<header class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">
            <i class="bi bi-check2"></i> NIKE CLONE
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/products">All Products</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Categories
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/products?category=mens-shoes">Men's Shoes</a></li>
                        <li><a class="dropdown-item" href="/products?category=womens-shoes">Women's Shoes</a></li>
                        <li><a class="dropdown-item" href="/products?category=kids-shoes">Kids' Shoes</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/products?category=basketball">Basketball</a></li>
                        <li><a class="dropdown-item" href="/products?category=running">Running</a></li>
                        <li><a class="dropdown-item" href="/products?category=lifestyle">Lifestyle</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/launches">
                        <i class="bi bi-calendar-event"></i> SNKRS
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/stores">
                        <i class="bi bi-geo-alt"></i> Store Locator
                    </a>
                </li>
            </ul>
            
            <!-- Search Form -->
            <form class="d-flex me-3" role="search" id="searchForm">
                <div class="position-relative">
                    <input class="form-control" type="search" placeholder="Search products..." id="searchInput" autocomplete="off">
                    <div id="searchResults" class="position-absolute bg-white border rounded-bottom shadow-sm w-100" style="top: 100%; z-index: 1000; display: none;"></div>
                </div>
            </form>
            
            <!-- User Menu -->
            <ul class="navbar-nav">
                <?php if ($isLoggedIn): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> <?= htmlspecialchars($userName) ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/logout">Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</header>