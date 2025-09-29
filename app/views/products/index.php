<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Products</li>
        </ol>
    </div>
</nav>

<!-- Products Header -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h2 mb-0">
                    <?php if ($category): ?>
                        <?= ucwords(str_replace('-', ' ', $category)) ?> 
                    <?php else: ?>
                        All Products
                    <?php endif ?>
                    <small class="text-muted">(<?= $total ?> items)</small>
                </h1>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-end align-items-center gap-3">
                    <!-- Sort Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Sort by: <?= ucfirst($sort) ?> (<?= strtoupper($order) ?>)
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?<?= http_build_query(array_merge($_GET, ['sort' => 'name', 'order' => 'ASC'])) ?>">Name (A-Z)</a></li>
                            <li><a class="dropdown-item" href="?<?= http_build_query(array_merge($_GET, ['sort' => 'name', 'order' => 'DESC'])) ?>">Name (Z-A)</a></li>
                            <li><a class="dropdown-item" href="?<?= http_build_query(array_merge($_GET, ['sort' => 'price', 'order' => 'ASC'])) ?>">Price (Low-High)</a></li>
                            <li><a class="dropdown-item" href="?<?= http_build_query(array_merge($_GET, ['sort' => 'price', 'order' => 'DESC'])) ?>">Price (High-Low)</a></li>
                            <li><a class="dropdown-item" href="?<?= http_build_query(array_merge($_GET, ['sort' => 'created_at', 'order' => 'DESC'])) ?>">Newest First</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container py-4">
    <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-lg-3 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Categories</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="/products" class="text-decoration-none <?= !$category ? 'fw-bold' : '' ?>">
                                All Products
                            </a>
                        </li>
                        <?php foreach ($categories as $cat): ?>
                        <li class="mb-2">
                            <a href="/products?category=<?= $cat['slug'] ?>" 
                               class="text-decoration-none <?= $category === $cat['slug'] ? 'fw-bold' : '' ?>">
                                <?= htmlspecialchars($cat['name']) ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Products Grid -->
        <div class="col-lg-9">
            <?php if (empty($products)): ?>
                <div class="text-center py-5">
                    <i class="bi bi-search display-1 text-muted"></i>
                    <h3 class="mt-3">No products found</h3>
                    <p class="text-muted">Try adjusting your filters or search terms.</p>
                    <a href="/products" class="btn btn-dark">View All Products</a>
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($products as $product): ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm product-card">
                                <div class="card-img-top position-relative overflow-hidden" style="height: 250px;">
                                    <img src="<?= htmlspecialchars($product['image_url']) ?>" 
                                         alt="<?= htmlspecialchars($product['name']) ?>" 
                                         class="w-100 h-100" style="object-fit: cover;">
                                    <div class="product-overlay">
                                        <a href="/product/<?= $product['id'] ?>" class="btn btn-dark btn-sm">View Details</a>
                                    </div>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                                    <p class="card-text text-muted small mb-2">
                                        <a href="/products?category=<?= $product['category_slug'] ?>" class="text-decoration-none">
                                            <?= htmlspecialchars($product['category_name']) ?>
                                        </a>
                                    </p>
                                    <p class="card-text flex-grow-1"><?= htmlspecialchars(substr($product['description'], 0, 80)) ?>...</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="h5 mb-0 text-dark">$<?= number_format($product['price'], 2) ?></span>
                                        <a href="/product/<?= $product['id'] ?>" class="btn btn-outline-dark btn-sm">Shop</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Pagination -->
                <?php if ($totalPages > 1): ?>
                <nav aria-label="Products pagination" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <?php if ($currentPage > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $currentPage - 1])) ?>">Previous</a>
                            </li>
                        <?php endif; ?>
                        
                        <?php
                        $startPage = max(1, $currentPage - 2);
                        $endPage = min($totalPages, $currentPage + 2);
                        
                        if ($startPage > 1):
                        ?>
                            <li class="page-item">
                                <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => 1])) ?>">1</a>
                            </li>
                            <?php if ($startPage > 2): ?>
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            <?php endif; ?>
                        <?php endif; ?>
                        
                        <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                            <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                                <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        
                        <?php if ($endPage < $totalPages): ?>
                            <?php if ($endPage < $totalPages - 1): ?>
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            <?php endif; ?>
                            <li class="page-item">
                                <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $totalPages])) ?>"><?= $totalPages ?></a>
                            </li>
                        <?php endif; ?>
                        
                        <?php if ($currentPage < $totalPages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $currentPage + 1])) ?>">Next</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>