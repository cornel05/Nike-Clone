<!-- Hero Section -->
<section class="hero-section bg-light py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Just Do It</h1>
                <p class="lead mb-4">Discover the latest in athletic footwear, apparel and gear. From basketball courts to running tracks, we've got you covered.</p>
                <div class="d-flex gap-3">
                    <a href="/products" class="btn btn-dark btn-lg">Shop Now</a>
                    <a href="/launches" class="btn btn-outline-dark btn-lg">SNKRS Launches</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="/assets/images/hero-banner.jpg" alt="Nike Hero" class="img-fluid rounded" style="max-height: 400px; width: 100%; object-fit: cover;">
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 mb-0">Featured Products</h2>
            <a href="/products" class="btn btn-outline-dark">View All</a>
        </div>
        
        <div class="row">
            <?php if (empty($featuredProducts)): ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted">No featured products available.</p>
                </div>
            <?php else: ?>
                <?php foreach ($featuredProducts as $product): ?>
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
                                <p class="card-text text-muted small mb-2"><?= htmlspecialchars($product['category_name']) ?></p>
                                <p class="card-text flex-grow-1"><?= htmlspecialchars(substr($product['description'], 0, 80)) ?>...</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="h5 mb-0 text-dark">$<?= number_format($product['price'], 2) ?></span>
                                    <a href="/product/<?= $product['id'] ?>" class="btn btn-outline-dark btn-sm">Shop</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Upcoming Launches -->
<?php if (!empty($upcomingLaunches)): ?>
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 mb-0">Upcoming SNKRS Launches</h2>
            <a href="/launches" class="btn btn-outline-dark">View All Launches</a>
        </div>
        
        <div class="row">
            <?php foreach ($upcomingLaunches as $launch): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm launch-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge bg-primary me-2"><?= strtoupper($launch['launch_type']) ?></span>
                                <small class="text-muted"><?= date('M j, Y g:i A', strtotime($launch['launch_date'])) ?></small>
                            </div>
                            <h5 class="card-title"><?= htmlspecialchars($launch['title']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars(substr($launch['description'], 0, 100)) ?>...</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h6 mb-0">$<?= number_format($launch['price'] ?? 0, 2) ?></span>
                                <a href="/launch/<?= $launch['id'] ?>" class="btn btn-dark btn-sm">Learn More</a>
                            </div>
                            
                            <!-- Countdown Timer -->
                            <div class="mt-3 p-2 bg-light rounded text-center">
                                <small class="text-muted d-block">Launches in:</small>
                                <div class="countdown fw-bold" data-launch-date="<?= date('c', strtotime($launch['launch_date'])) ?>">
                                    <span class="days">00</span>d 
                                    <span class="hours">00</span>h 
                                    <span class="minutes">00</span>m 
                                    <span class="seconds">00</span>s
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Categories Section -->
<section class="py-5">
    <div class="container">
        <h2 class="h3 mb-4 text-center">Shop by Category</h2>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 category-card">
                    <div class="card-img-top position-relative overflow-hidden" style="height: 300px;">
                        <img src="/assets/images/categories/mens-shoes.jpg" alt="Men's Shoes" class="w-100 h-100" style="object-fit: cover;">
                        <div class="category-overlay d-flex align-items-center justify-content-center">
                            <div class="text-center text-white">
                                <h3 class="h4 mb-3">Men's Shoes</h3>
                                <a href="/products?category=mens-shoes" class="btn btn-light">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 category-card">
                    <div class="card-img-top position-relative overflow-hidden" style="height: 300px;">
                        <img src="/assets/images/categories/womens-shoes.jpg" alt="Women's Shoes" class="w-100 h-100" style="object-fit: cover;">
                        <div class="category-overlay d-flex align-items-center justify-content-center">
                            <div class="text-center text-white">
                                <h3 class="h4 mb-3">Women's Shoes</h3>
                                <a href="/products?category=womens-shoes" class="btn btn-light">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 category-card">
                    <div class="card-img-top position-relative overflow-hidden" style="height: 300px;">
                        <img src="/assets/images/categories/basketball.jpg" alt="Basketball" class="w-100 h-100" style="object-fit: cover;">
                        <div class="category-overlay d-flex align-items-center justify-content-center">
                            <div class="text-center text-white">
                                <h3 class="h4 mb-3">Basketball</h3>
                                <a href="/products?category=basketball" class="btn btn-light">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>