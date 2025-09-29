<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="/products" class="text-decoration-none">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">Search Results</li>
        </ol>
    </div>
</nav>

<!-- Search Results Header -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="h2 mb-0">
                    Search Results for "<?= htmlspecialchars($query) ?>"
                    <small class="text-muted">(<?= $total ?> results)</small>
                </h1>
            </div>
            <div class="col-md-4">
                <form class="d-flex" method="GET" action="/products/search">
                    <input type="search" name="q" value="<?= htmlspecialchars($query) ?>" 
                           class="form-control me-2" placeholder="Search products...">
                    <button type="submit" class="btn btn-dark">Search</button>
                </form>
            </div>
        </div>
    </div>
</section>

<div class="container py-4">
    <?php if (empty($products)): ?>
        <div class="text-center py-5">
            <i class="bi bi-search display-1 text-muted"></i>
            <h3 class="mt-3">No results found for "<?= htmlspecialchars($query) ?>"</h3>
            <p class="text-muted">Try different keywords or browse our categories.</p>
            <div class="d-flex gap-2 justify-content-center">
                <a href="/products" class="btn btn-dark">Browse All Products</a>
                <a href="/products?category=mens-shoes" class="btn btn-outline-dark">Men's Shoes</a>
                <a href="/products?category=womens-shoes" class="btn btn-outline-dark">Women's Shoes</a>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
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
        <nav aria-label="Search results pagination" class="mt-4">
            <ul class="pagination justify-content-center">
                <?php if ($currentPage > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?q=<?= urlencode($query) ?>&page=<?= $currentPage - 1 ?>">Previous</a>
                    </li>
                <?php endif; ?>
                
                <?php
                $startPage = max(1, $currentPage - 2);
                $endPage = min($totalPages, $currentPage + 2);
                
                for ($i = $startPage; $i <= $endPage; $i++):
                ?>
                    <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                        <a class="page-link" href="?q=<?= urlencode($query) ?>&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                
                <?php if ($currentPage < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?q=<?= urlencode($query) ?>&page=<?= $currentPage + 1 ?>">Next</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        <?php endif; ?>
    <?php endif; ?>
</div>