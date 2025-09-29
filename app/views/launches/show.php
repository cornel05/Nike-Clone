<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="/launches" class="text-decoration-none">SNKRS Launches</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($launch['title']) ?></li>
        </ol>
    </div>
</nav>

<div class="container py-4">
    <div class="row">
        <!-- Launch Images -->
        <div class="col-lg-6 mb-4">
            <div class="launch-images">
                <!-- Main Image -->
                <div class="main-image mb-3">
                    <img id="mainLaunchImage" 
                         src="<?= htmlspecialchars($launch['image_url']) ?>" 
                         alt="<?= htmlspecialchars($launch['product_name']) ?>" 
                         class="img-fluid rounded shadow">
                </div>
                
                <!-- Additional Images -->
                <?php if (!empty($images)): ?>
                <div class="d-flex gap-2 flex-wrap">
                    <img src="<?= htmlspecialchars($launch['image_url']) ?>" 
                         alt="<?= htmlspecialchars($launch['product_name']) ?> - Main" 
                         class="img-thumbnail launch-thumb active" 
                         style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;">
                    
                    <?php foreach ($images as $image): ?>
                        <img src="<?= htmlspecialchars($image['image_url']) ?>" 
                             alt="<?= htmlspecialchars($image['alt_text']) ?>" 
                             class="img-thumbnail launch-thumb" 
                             style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;">
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Launch Details -->
        <div class="col-lg-6">
            <div class="launch-details">
                <!-- Launch Type and Status Badges -->
                <div class="mb-3">
                    <span class="badge bg-<?= $launch['launch_type'] === 'draw' ? 'warning' : ($launch['launch_type'] === 'fcfs' ? 'success' : 'info') ?> text-dark me-2">
                        <?= strtoupper($launch['launch_type']) ?>
                    </span>
                    <span class="badge bg-<?= $launch['status'] === 'upcoming' ? 'primary' : ($launch['status'] === 'live' ? 'success' : 'secondary') ?>">
                        <?= ucfirst($launch['status']) ?>
                    </span>
                </div>
                
                <h1 class="h2 mb-3"><?= htmlspecialchars($launch['title']) ?></h1>
                
                <h3 class="h4 text-muted mb-3"><?= htmlspecialchars($launch['product_name']) ?></h3>
                
                <div class="mb-3">
                    <span class="badge bg-secondary"><?= htmlspecialchars($launch['category_name']) ?></span>
                </div>
                
                <div class="mb-4">
                    <span class="h3 text-dark">$<?= number_format($launch['price'], 2) ?></span>
                </div>
                
                <div class="mb-4">
                    <p class="lead"><?= htmlspecialchars($launch['description']) ?></p>
                </div>
                
                <!-- Launch Date -->
                <div class="mb-4">
                    <h5 class="mb-2">Launch Date</h5>
                    <p class="mb-0">
                        <i class="bi bi-calendar-event me-2"></i>
                        <strong><?= date('F j, Y \a\t g:i A T', strtotime($launch['launch_date'])) ?></strong>
                    </p>
                </div>
                
                <!-- Countdown Timer -->
                <?php if ($launch['status'] === 'upcoming'): ?>
                <div class="mb-4">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <h5 class="card-title">
                                <?= $launch['launch_type'] === 'draw' ? 'Draw closes in:' : 'Launches in:' ?>
                            </h5>
                            <div class="countdown fw-bold fs-4" data-launch-date="<?= date('c', strtotime($launch['launch_date'])) ?>">
                                <div class="row text-center">
                                    <div class="col">
                                        <div class="display-6 fw-bold text-dark days">00</div>
                                        <small class="text-muted">DAYS</small>
                                    </div>
                                    <div class="col">
                                        <div class="display-6 fw-bold text-dark hours">00</div>
                                        <small class="text-muted">HOURS</small>
                                    </div>
                                    <div class="col">
                                        <div class="display-6 fw-bold text-dark minutes">00</div>
                                        <small class="text-muted">MINS</small>
                                    </div>
                                    <div class="col">
                                        <div class="display-6 fw-bold text-dark seconds">00</div>
                                        <small class="text-muted">SECS</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Action Buttons -->
                <div class="mb-4">
                    <?php if ($launch['status'] === 'upcoming'): ?>
                        <?php if ($launch['launch_type'] === 'draw'): ?>
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-warning btn-lg text-dark" onclick="enterDraw()">
                                    <i class="bi bi-ticket"></i> Enter Draw
                                </button>
                                <button type="button" class="btn btn-outline-dark" onclick="toggleNotifications()">
                                    <i class="bi bi-bell"></i> 
                                    <?= $hasNotification ? 'Remove Notifications' : 'Get Notified' ?>
                                </button>
                            </div>
                        <?php else: ?>
                            <div class="d-grid">
                                <button type="button" class="btn btn-dark btn-lg" onclick="toggleNotifications()">
                                    <i class="bi bi-bell"></i> 
                                    <?= $hasNotification ? 'Remove Notifications' : 'Get Notified' ?>
                                </button>
                            </div>
                        <?php endif; ?>
                    <?php elseif ($launch['status'] === 'live'): ?>
                        <div class="d-grid">
                            <a href="/product/<?= $launch['product_id'] ?>" class="btn btn-success btn-lg">
                                <i class="bi bi-bag"></i> Shop Now
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="d-grid">
                            <a href="/product/<?= $launch['product_id'] ?>" class="btn btn-outline-dark btn-lg">
                                <i class="bi bi-eye"></i> View Product
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Launch Information -->
                <div class="mb-4">
                    <h5 class="mb-3">Launch Information</h5>
                    <ul class="list-unstyled">
                        <?php if ($launch['launch_type'] === 'draw'): ?>
                            <li class="mb-2"><i class="bi bi-info-circle text-primary me-2"></i>This is a draw/raffle entry</li>
                            <li class="mb-2"><i class="bi bi-clock text-primary me-2"></i>Winners will be notified via email</li>
                            <li class="mb-2"><i class="bi bi-shield-check text-primary me-2"></i>One entry per person</li>
                        <?php elseif ($launch['launch_type'] === 'fcfs'): ?>
                            <li class="mb-2"><i class="bi bi-info-circle text-success me-2"></i>First come, first served</li>
                            <li class="mb-2"><i class="bi bi-clock text-success me-2"></i>Available when launch goes live</li>
                            <li class="mb-2"><i class="bi bi-lightning text-success me-2"></i>No entry required</li>
                        <?php else: ?>
                            <li class="mb-2"><i class="bi bi-info-circle text-info me-2"></i>Open to everyone</li>
                            <li class="mb-2"><i class="bi bi-clock text-info me-2"></i>Available during launch window</li>
                            <li class="mb-2"><i class="bi bi-people text-info me-2"></i>No restrictions</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Launch image gallery
document.addEventListener('DOMContentLoaded', function() {
    const mainImage = document.getElementById('mainLaunchImage');
    const thumbs = document.querySelectorAll('.launch-thumb');
    
    thumbs.forEach(thumb => {
        thumb.addEventListener('click', function() {
            thumbs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            mainImage.src = this.src;
            mainImage.alt = this.alt;
        });
    });
});

// Notification toggle
function toggleNotifications() {
    <?php if (!isset($_SESSION['user_id'])): ?>
        window.location.href = '/login';
        return;
    <?php endif; ?>
    
    const button = event.target;
    const originalText = button.innerHTML;
    button.disabled = true;
    button.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';
    
    fetch('/api/launch/notify', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            launch_id: <?= $launch['id'] ?>
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message || 'An error occurred');
            button.disabled = false;
            button.innerHTML = originalText;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred');
        button.disabled = false;
        button.innerHTML = originalText;
    });
}

// Enter draw function
function enterDraw() {
    <?php if (!isset($_SESSION['user_id'])): ?>
        window.location.href = '/login';
        return;
    <?php endif; ?>
    
    alert('Draw entry functionality would be implemented here. This is a demo.');
}
</script>