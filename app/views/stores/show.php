<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="/stores" class="text-decoration-none">Store Locator</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($store['name']) ?></li>
        </ol>
    </div>
</nav>

<div class="container py-4">
    <!-- Store Header -->
    <div class="row mb-5">
        <div class="col-lg-8">
            <h1 class="h2 mb-3"><?= htmlspecialchars($store['name']) ?></h1>
            
            <div class="row">
                <div class="col-md-6 mb-4">
                    <h5 class="mb-3"><i class="bi bi-geo-alt me-2"></i>Address</h5>
                    <p class="mb-0">
                        <?= htmlspecialchars($store['address']) ?><br>
                        <?= htmlspecialchars($store['city']) ?><?= $store['state'] ? ', ' . htmlspecialchars($store['state']) : '' ?> 
                        <?= htmlspecialchars($store['postal_code']) ?><br>
                        <?= htmlspecialchars($store['country']) ?>
                    </p>
                    
                    <div class="mt-3">
                        <a href="https://maps.google.com/maps?q=<?= urlencode($store['address'] . ', ' . $store['city']) ?>" 
                           target="_blank" class="btn btn-outline-dark btn-sm">
                            <i class="bi bi-map"></i> Get Directions
                        </a>
                    </div>
                </div>
                
                <div class="col-md-6 mb-4">
                    <h5 class="mb-3"><i class="bi bi-info-circle me-2"></i>Store Information</h5>
                    
                    <?php if ($store['phone']): ?>
                        <p class="mb-2">
                            <strong>Phone:</strong> 
                            <a href="tel:<?= htmlspecialchars($store['phone']) ?>" class="text-decoration-none">
                                <?= htmlspecialchars($store['phone']) ?>
                            </a>
                        </p>
                    <?php endif; ?>
                    
                    <?php if ($store['email']): ?>
                        <p class="mb-2">
                            <strong>Email:</strong> 
                            <a href="mailto:<?= htmlspecialchars($store['email']) ?>" class="text-decoration-none">
                                <?= htmlspecialchars($store['email']) ?>
                            </a>
                        </p>
                    <?php endif; ?>
                    
                    <?php if ($store['hours']): ?>
                        <p class="mb-0">
                            <strong>Hours:</strong><br>
                            <?= nl2br(htmlspecialchars($store['hours'])) ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Store Map -->
            <div id="singleStoreMap" style="height: 300px; background: #f8f9fa;" class="rounded shadow">
                <div class="d-flex align-items-center justify-content-center h-100">
                    <div class="text-center text-muted">
                        <i class="bi bi-geo-alt display-4"></i>
                        <p class="mt-2">Store location map<br><small>Google Maps API key required</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Store Inventory -->
    <div class="row">
        <div class="col-12">
            <h3 class="mb-4">Products Available at This Store</h3>
            
            <?php if (empty($inventory)): ?>
                <div class="text-center py-5">
                    <i class="bi bi-bag display-1 text-muted"></i>
                    <h4 class="mt-3">No inventory information available</h4>
                    <p class="text-muted">Please contact the store directly for product availability.</p>
                    <?php if ($store['phone']): ?>
                        <a href="tel:<?= htmlspecialchars($store['phone']) ?>" class="btn btn-dark">
                            <i class="bi bi-telephone"></i> Call Store
                        </a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($inventory as $item): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm product-card">
                                <div class="card-img-top position-relative overflow-hidden" style="height: 200px;">
                                    <img src="<?= htmlspecialchars($item['image_url']) ?>" 
                                         alt="<?= htmlspecialchars($item['product_name']) ?>" 
                                         class="w-100 h-100" style="object-fit: cover;">
                                    <div class="product-overlay">
                                        <a href="/product/<?= $item['product_id'] ?>" class="btn btn-dark btn-sm">View Details</a>
                                    </div>
                                    
                                    <!-- Stock Badge -->
                                    <div class="position-absolute top-0 end-0 m-2">
                                        <span class="badge bg-<?= $item['stock'] > 10 ? 'success' : ($item['stock'] > 0 ? 'warning' : 'danger') ?>">
                                            <?= $item['stock'] > 10 ? 'In Stock' : ($item['stock'] > 0 ? 'Low Stock (' . $item['stock'] . ')' : 'Out of Stock') ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title"><?= htmlspecialchars($item['product_name']) ?></h6>
                                    <p class="card-text text-muted small mb-2"><?= htmlspecialchars($item['category_name']) ?></p>
                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        <span class="h6 mb-0">$<?= number_format($item['price'], 2) ?></span>
                                        <a href="/product/<?= $item['product_id'] ?>" class="btn btn-outline-dark btn-sm">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Store Services -->
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="mb-4">Store Services</h3>
            <div class="row">
                <div class="col-md-3 text-center mb-4">
                    <div class="p-4 bg-light rounded">
                        <i class="bi bi-truck display-4 text-dark mb-3"></i>
                        <h5>Free Shipping</h5>
                        <p class="text-muted small">Free shipping on orders over $50</p>
                    </div>
                </div>
                <div class="col-md-3 text-center mb-4">
                    <div class="p-4 bg-light rounded">
                        <i class="bi bi-arrow-repeat display-4 text-dark mb-3"></i>
                        <h5>Easy Returns</h5>
                        <p class="text-muted small">60-day return policy</p>
                    </div>
                </div>
                <div class="col-md-3 text-center mb-4">
                    <div class="p-4 bg-light rounded">
                        <i class="bi bi-rulers display-4 text-dark mb-3"></i>
                        <h5>Size Fitting</h5>
                        <p class="text-muted small">Professional size fitting available</p>
                    </div>
                </div>
                <div class="col-md-3 text-center mb-4">
                    <div class="p-4 bg-light rounded">
                        <i class="bi bi-headset display-4 text-dark mb-3"></i>
                        <h5>Expert Advice</h5>
                        <p class="text-muted small">Knowledgeable staff to help you</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Initialize single store map
function initSingleStoreMap() {
    <?php if (isset($_ENV['GOOGLE_MAPS_API_KEY']) && $_ENV['GOOGLE_MAPS_API_KEY'] !== 'your_google_maps_api_key_here' && $store['latitude'] && $store['longitude']): ?>
    const mapElement = document.getElementById('singleStoreMap');
    if (mapElement && typeof google !== 'undefined') {
        const storeLocation = { lat: <?= $store['latitude'] ?>, lng: <?= $store['longitude'] ?> };
        
        const map = new google.maps.Map(mapElement, {
            zoom: 15,
            center: storeLocation,
            styles: [
                {
                    featureType: 'poi',
                    elementType: 'labels',
                    stylers: [{ visibility: 'off' }]
                }
            ]
        });
        
        const marker = new google.maps.Marker({
            position: storeLocation,
            map: map,
            title: '<?= htmlspecialchars($store['name'], ENT_QUOTES) ?>',
            icon: {
                url: 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEyIDJDOC4xMyAyIDUgNS4xMyA1IDlDNSAxNC4yNSAxMiAyMiAxMiAyMkMxMiAyMiAxOSAxNC4yNSAxOSA5QzE5IDUuMTMgMTUuODcgMiAxMiAyWk0xMiAxMS41QzEwLjYyIDExLjUgOS41IDEwLjM4IDkuNSA5QzkuNSA3LjYyIDEwLjYyIDYuNSAxMiA2LjVDMTMuMzggNi41IDE0LjUgNy42MiAxNC41IDlDMTQuNSAxMC4zOCAxMy4zOCAxMS41IDEyIDExLjVaIiBmaWxsPSIjRkZGRkZGIiBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMSIvPgo8L3N2Zz4K',
                scaledSize: new google.maps.Size(30, 30)
            }
        });
        
        const infoWindow = new google.maps.InfoWindow({
            content: `
                <div class="p-2">
                    <h6 class="mb-1"><?= htmlspecialchars($store['name'], ENT_QUOTES) ?></h6>
                    <p class="mb-0 small text-muted"><?= htmlspecialchars($store['address'], ENT_QUOTES) ?></p>
                </div>
            `
        });
        
        marker.addListener('click', () => {
            infoWindow.open(map, marker);
        });
        
        // Open info window by default
        infoWindow.open(map, marker);
    }
    <?php endif; ?>
}

// Initialize map when Google Maps API loads
if (typeof google !== 'undefined') {
    initSingleStoreMap();
} else {
    window.initMap = initSingleStoreMap;
}
</script>