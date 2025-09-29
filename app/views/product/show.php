<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="/products" class="text-decoration-none">Products</a></li>
            <li class="breadcrumb-item">
                <a href="/products?category=<?= $product['category_slug'] ?>" class="text-decoration-none">
                    <?= htmlspecialchars($product['category_name']) ?>
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($product['name']) ?></li>
        </ol>
    </div>
</nav>

<div class="container py-4">
    <div class="row">
        <!-- Product Images -->
        <div class="col-lg-6 mb-4">
            <div class="product-images">
                <!-- Main Image -->
                <div class="main-image mb-3">
                    <img id="mainProductImage" 
                         src="<?= htmlspecialchars($product['image_url']) ?>" 
                         alt="<?= htmlspecialchars($product['name']) ?>" 
                         class="img-fluid rounded shadow">
                </div>
                
                <!-- Thumbnail Images -->
                <?php if (!empty($images)): ?>
                <div class="d-flex gap-2 flex-wrap">
                    <img src="<?= htmlspecialchars($product['image_url']) ?>" 
                         alt="<?= htmlspecialchars($product['name']) ?> - Main" 
                         class="img-thumbnail product-thumb active" 
                         style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;">
                    
                    <?php foreach ($images as $image): ?>
                        <img src="<?= htmlspecialchars($image['image_url']) ?>" 
                             alt="<?= htmlspecialchars($image['alt_text']) ?>" 
                             class="img-thumbnail product-thumb" 
                             style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;">
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Product Details -->
        <div class="col-lg-6">
            <div class="product-details">
                <h1 class="h2 mb-3"><?= htmlspecialchars($product['name']) ?></h1>
                
                <div class="mb-3">
                    <span class="badge bg-secondary"><?= htmlspecialchars($product['category_name']) ?></span>
                </div>
                
                <div class="mb-4">
                    <span class="h3 text-dark">$<?= number_format($product['price'], 2) ?></span>
                </div>
                
                <div class="mb-4">
                    <p class="lead"><?= htmlspecialchars($product['description']) ?></p>
                </div>
                
                <!-- Size Selection -->
                <?php if (!empty($sizes)): ?>
                <div class="mb-4">
                    <h5 class="mb-3">Select Size</h5>
                    <div class="size-selector">
                        <div class="row g-2">
                            <?php foreach ($sizes as $size): ?>
                                <div class="col-auto">
                                    <input type="radio" class="btn-check" name="size" id="size_<?= $size['size_id'] ?>" value="<?= $size['size_id'] ?>">
                                    <label class="btn btn-outline-dark" for="size_<?= $size['size_id'] ?>">
                                        <?= htmlspecialchars($size['size_name']) ?>
                                        <?php if ($size['stock'] <= 5 && $size['stock'] > 0): ?>
                                            <small class="text-warning">(<?= $size['stock'] ?> left)</small>
                                        <?php endif; ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <small class="text-muted">Size guide available</small>
                </div>
                <?php endif; ?>
                
                <!-- Action Buttons -->
                <div class="mb-4">
                    <div class="d-grid gap-2 d-md-block">
                        <button type="button" class="btn btn-dark btn-lg me-2" disabled>
                            <i class="bi bi-bag"></i> Add to Bag
                        </button>
                        <button type="button" class="btn btn-outline-dark btn-lg">
                            <i class="bi bi-heart"></i> Favorite
                        </button>
                    </div>
                    <small class="text-muted d-block mt-2">Free shipping on orders over $50</small>
                </div>
                
                <!-- Product Features -->
                <div class="mb-4">
                    <h5 class="mb-3">Product Features</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Premium materials</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Comfortable fit</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Durable construction</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Iconic design</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Store Availability -->
    <?php if (!empty($storeAvailability)): ?>
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="mb-4">Find in Store</h3>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="store-list">
                                <?php foreach ($storeAvailability as $store): ?>
                                    <div class="store-item d-flex justify-content-between align-items-center p-3 border-bottom">
                                        <div>
                                            <h6 class="mb-1"><?= htmlspecialchars($store['store_name']) ?></h6>
                                            <small class="text-muted"><?= htmlspecialchars($store['address']) ?></small>
                                            <?php if ($store['phone']): ?>
                                                <div class="mt-1">
                                                    <small class="text-muted">
                                                        <i class="bi bi-telephone"></i> <?= htmlspecialchars($store['phone']) ?>
                                                    </small>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="text-end">
                                            <span class="badge bg-success">In Stock (<?= $store['stock'] ?>)</span>
                                            <div class="mt-1">
                                                <a href="/store/<?= $store['store_id'] ?>" class="btn btn-sm btn-outline-dark">View Store</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div id="storeMap" style="height: 300px; background: #f8f9fa;" class="rounded">
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <div class="text-center text-muted">
                                        <i class="bi bi-geo-alt display-4"></i>
                                        <p class="mt-2">Map will load here<br><small>Google Maps API key required</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Related Products -->
    <?php if (!empty($relatedProducts)): ?>
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="mb-4">You Might Also Like</h3>
            <div class="row">
                <?php foreach ($relatedProducts as $relatedProduct): ?>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm product-card">
                            <div class="card-img-top position-relative overflow-hidden" style="height: 200px;">
                                <img src="<?= htmlspecialchars($relatedProduct['image_url']) ?>" 
                                     alt="<?= htmlspecialchars($relatedProduct['name']) ?>" 
                                     class="w-100 h-100" style="object-fit: cover;">
                                <div class="product-overlay">
                                    <a href="/product/<?= $relatedProduct['id'] ?>" class="btn btn-dark btn-sm">View Details</a>
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title"><?= htmlspecialchars($relatedProduct['name']) ?></h6>
                                <p class="card-text text-muted small mb-2"><?= htmlspecialchars($relatedProduct['category_name']) ?></p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <span class="h6 mb-0">$<?= number_format($relatedProduct['price'], 2) ?></span>
                                    <a href="/product/<?= $relatedProduct['id'] ?>" class="btn btn-outline-dark btn-sm">Shop</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<script>
// Product image gallery
document.addEventListener('DOMContentLoaded', function() {
    const mainImage = document.getElementById('mainProductImage');
    const thumbs = document.querySelectorAll('.product-thumb');
    
    thumbs.forEach(thumb => {
        thumb.addEventListener('click', function() {
            // Remove active class from all thumbs
            thumbs.forEach(t => t.classList.remove('active'));
            
            // Add active class to clicked thumb
            this.classList.add('active');
            
            // Update main image
            mainImage.src = this.src;
            mainImage.alt = this.alt;
        });
    });
});

// Store map initialization (placeholder)
function initStoreMap() {
    <?php if (!empty($storeAvailability) && isset($_ENV['GOOGLE_MAPS_API_KEY']) && $_ENV['GOOGLE_MAPS_API_KEY'] !== 'your_google_maps_api_key_here'): ?>
    const mapElement = document.getElementById('storeMap');
    if (mapElement && typeof google !== 'undefined') {
        const map = new google.maps.Map(mapElement, {
            zoom: 10,
            center: { lat: 40.7580, lng: -73.9855 } // Default to NYC
        });
        
        // Add markers for each store
        <?php foreach ($storeAvailability as $store): ?>
            <?php if ($store['latitude'] && $store['longitude']): ?>
            new google.maps.Marker({
                position: { lat: <?= $store['latitude'] ?>, lng: <?= $store['longitude'] ?> },
                map: map,
                title: '<?= htmlspecialchars($store['store_name']) ?>'
            });
            <?php endif; ?>
        <?php endforeach; ?>
    }
    <?php endif; ?>
}

// Initialize map when Google Maps API loads
if (typeof google !== 'undefined') {
    initStoreMap();
} else {
    window.initMap = initStoreMap;
}
</script>