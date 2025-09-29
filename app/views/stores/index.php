<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Store Locator</li>
        </ol>
    </div>
</nav>

<!-- Store Locator Header -->
<section class="py-4 bg-dark text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="h2 mb-2">
                    <i class="bi bi-geo-alt me-2"></i>Store Locator
                </h1>
                <p class="lead mb-0">Find Nike stores near you and check product availability</p>
            </div>
            <div class="col-md-4 text-md-end">
                <span class="badge bg-light text-dark fs-6"><?= count($stores) ?> stores</span>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <!-- Location Search -->
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">Find Stores Near You</h5>
                    <div class="row g-3">
                        <div class="col-md-8">
                            <input type="text" class="form-control form-control-lg" id="locationInput" 
                                   placeholder="Enter your address, city, or zip code">
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-dark btn-lg w-100" onclick="searchNearbyStores()">
                                <i class="bi bi-search"></i> Search
                            </button>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button type="button" class="btn btn-link" onclick="getCurrentLocation()">
                            <i class="bi bi-geo-alt"></i> Use my current location
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <!-- Store List -->
        <div class="col-lg-6 mb-4">
            <h3 class="mb-4">All Stores</h3>
            
            <?php if (empty($stores)): ?>
                <div class="text-center py-5">
                    <i class="bi bi-geo-alt display-1 text-muted"></i>
                    <h4 class="mt-3">No stores found</h4>
                    <p class="text-muted">We're constantly expanding our network of stores.</p>
                </div>
            <?php else: ?>
                <div class="store-list">
                    <?php foreach ($stores as $store): ?>
                        <div class="card mb-3 store-card" data-store-id="<?= $store['id'] ?>" 
                             <?php if ($store['latitude'] && $store['longitude']): ?>
                             data-lat="<?= $store['latitude'] ?>" data-lng="<?= $store['longitude'] ?>"
                             <?php endif; ?>>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-2"><?= htmlspecialchars($store['name']) ?></h5>
                                        <p class="card-text text-muted mb-2">
                                            <i class="bi bi-geo-alt me-1"></i>
                                            <?= htmlspecialchars($store['address']) ?><br>
                                            <?= htmlspecialchars($store['city']) ?><?= $store['state'] ? ', ' . htmlspecialchars($store['state']) : '' ?> 
                                            <?= htmlspecialchars($store['postal_code']) ?><br>
                                            <?= htmlspecialchars($store['country']) ?>
                                        </p>
                                        
                                        <?php if ($store['phone']): ?>
                                            <p class="card-text mb-2">
                                                <i class="bi bi-telephone me-1"></i>
                                                <a href="tel:<?= htmlspecialchars($store['phone']) ?>" class="text-decoration-none">
                                                    <?= htmlspecialchars($store['phone']) ?>
                                                </a>
                                            </p>
                                        <?php endif; ?>
                                        
                                        <?php if ($store['email']): ?>
                                            <p class="card-text mb-2">
                                                <i class="bi bi-envelope me-1"></i>
                                                <a href="mailto:<?= htmlspecialchars($store['email']) ?>" class="text-decoration-none">
                                                    <?= htmlspecialchars($store['email']) ?>
                                                </a>
                                            </p>
                                        <?php endif; ?>
                                        
                                        <?php if ($store['hours']): ?>
                                            <p class="card-text mb-0">
                                                <i class="bi bi-clock me-1"></i>
                                                <small class="text-muted"><?= htmlspecialchars($store['hours']) ?></small>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="text-end">
                                        <a href="/store/<?= $store['id'] ?>" class="btn btn-outline-dark btn-sm mb-2">
                                            View Details
                                        </a>
                                        <?php if ($store['latitude'] && $store['longitude']): ?>
                                            <br>
                                            <button type="button" class="btn btn-link btn-sm p-0" onclick="focusStoreOnMap(<?= $store['latitude'] ?>, <?= $store['longitude'] ?>)">
                                                <i class="bi bi-map"></i> Show on map
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Map -->
        <div class="col-lg-6">
            <div class="sticky-top" style="top: 100px;">
                <h3 class="mb-4">Store Locations</h3>
                <div id="storeMap" style="height: 500px; background: #f8f9fa;" class="rounded shadow">
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <div class="text-center text-muted">
                            <i class="bi bi-geo-alt display-4"></i>
                            <p class="mt-2">Interactive map will load here<br><small>Google Maps API key required</small></p>
                        </div>
                    </div>
                </div>
                
                <!-- Map Controls -->
                <div class="mt-3 d-flex gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm" onclick="showAllStores()">
                        <i class="bi bi-geo-alt"></i> Show All Stores
                    </button>
                    <button type="button" class="btn btn-outline-dark btn-sm" onclick="getCurrentLocationAndShow()">
                        <i class="bi bi-crosshair"></i> My Location
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let map;
let markers = [];
let userLocationMarker;

// Initialize map
function initStoreMap() {
    <?php if (isset($_ENV['GOOGLE_MAPS_API_KEY']) && $_ENV['GOOGLE_MAPS_API_KEY'] !== 'your_google_maps_api_key_here'): ?>
    const mapElement = document.getElementById('storeMap');
    if (mapElement && typeof google !== 'undefined') {
        // Default center (US)
        const defaultCenter = { lat: 39.8283, lng: -98.5795 };
        
        map = new google.maps.Map(mapElement, {
            zoom: 4,
            center: defaultCenter,
            styles: [
                {
                    featureType: 'poi',
                    elementType: 'labels',
                    stylers: [{ visibility: 'off' }]
                }
            ]
        });
        
        // Add store markers
        <?php foreach ($stores as $store): ?>
            <?php if ($store['latitude'] && $store['longitude']): ?>
            addStoreMarker(
                <?= $store['latitude'] ?>, 
                <?= $store['longitude'] ?>, 
                '<?= htmlspecialchars($store['name'], ENT_QUOTES) ?>',
                '<?= htmlspecialchars($store['address'], ENT_QUOTES) ?>',
                <?= $store['id'] ?>
            );
            <?php endif; ?>
        <?php endforeach; ?>
        
        // Fit map to show all markers
        if (markers.length > 0) {
            const bounds = new google.maps.LatLngBounds();
            markers.forEach(marker => bounds.extend(marker.getPosition()));
            map.fitBounds(bounds);
        }
    }
    <?php endif; ?>
}

function addStoreMarker(lat, lng, name, address, storeId) {
    const marker = new google.maps.Marker({
        position: { lat: lat, lng: lng },
        map: map,
        title: name,
        icon: {
            url: 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEyIDJDOC4xMyAyIDUgNS4xMyA1IDlDNSAxNC4yNSAxMiAyMiAxMiAyMkMxMiAyMiAxOSAxNC4yNSAxOSA5QzE5IDUuMTMgMTUuODcgMiAxMiAyWk0xMiAxMS41QzEwLjYyIDExLjUgOS41IDEwLjM4IDkuNSA5QzkuNSA3LjYyIDEwLjYyIDYuNSAxMiA2LjVDMTMuMzggNi41IDE0LjUgNy42MiAxNC41IDlDMTQuNSAxMC4zOCAxMy4zOCAxMS41IDEyIDExLjVaIiBmaWxsPSIjRkZGRkZGIiBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMSIvPgo8L3N2Zz4K',
            scaledSize: new google.maps.Size(30, 30)
        }
    });
    
    const infoWindow = new google.maps.InfoWindow({
        content: `
            <div class="p-2">
                <h6 class="mb-1">${name}</h6>
                <p class="mb-2 small text-muted">${address}</p>
                <a href="/store/${storeId}" class="btn btn-dark btn-sm">View Store</a>
            </div>
        `
    });
    
    marker.addListener('click', () => {
        // Close other info windows
        markers.forEach(m => {
            if (m.infoWindow) m.infoWindow.close();
        });
        infoWindow.open(map, marker);
    });
    
    marker.infoWindow = infoWindow;
    markers.push(marker);
}

function focusStoreOnMap(lat, lng) {
    if (map) {
        map.setCenter({ lat: lat, lng: lng });
        map.setZoom(15);
        
        // Find and trigger the marker click
        markers.forEach(marker => {
            const pos = marker.getPosition();
            if (Math.abs(pos.lat() - lat) < 0.001 && Math.abs(pos.lng() - lng) < 0.001) {
                google.maps.event.trigger(marker, 'click');
            }
        });
    }
}

function showAllStores() {
    if (map && markers.length > 0) {
        const bounds = new google.maps.LatLngBounds();
        markers.forEach(marker => bounds.extend(marker.getPosition()));
        map.fitBounds(bounds);
    }
}

function getCurrentLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                searchNearbyStores(lat, lng);
            },
            (error) => {
                alert('Unable to get your location. Please enter your address manually.');
            }
        );
    } else {
        alert('Geolocation is not supported by this browser.');
    }
}

function getCurrentLocationAndShow() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                
                if (map) {
                    map.setCenter({ lat: lat, lng: lng });
                    map.setZoom(12);
                    
                    // Add user location marker
                    if (userLocationMarker) {
                        userLocationMarker.setMap(null);
                    }
                    
                    userLocationMarker = new google.maps.Marker({
                        position: { lat: lat, lng: lng },
                        map: map,
                        title: 'Your Location',
                        icon: {
                            url: 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMTIiIGN5PSIxMiIgcj0iOCIgZmlsbD0iIzAwN0NGRiIgc3Ryb2tlPSIjRkZGIiBzdHJva2Utd2lkdGg9IjIiLz4KPGNpcmNsZSBjeD0iMTIiIGN5PSIxMiIgcj0iMyIgZmlsbD0iI0ZGRiIvPgo8L3N2Zz4K',
                            scaledSize: new google.maps.Size(24, 24)
                        }
                    });
                }
            },
            (error) => {
                alert('Unable to get your location.');
            }
        );
    }
}

function searchNearbyStores(lat, lng) {
    if (lat && lng) {
        // This would typically make an API call to get nearby stores
        // For now, we'll just center the map on the location
        if (map) {
            map.setCenter({ lat: lat, lng: lng });
            map.setZoom(12);
        }
    } else {
        const address = document.getElementById('locationInput').value;
        if (address) {
            // This would geocode the address and then search for nearby stores
            alert('Address geocoding would be implemented here. For demo, please use "Use my current location" button.');
        }
    }
}

// Initialize map when Google Maps API loads
if (typeof google !== 'undefined') {
    initStoreMap();
} else {
    window.initMap = initStoreMap;
}
</script>