<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">SNKRS Launches</li>
        </ol>
    </div>
</nav>

<!-- SNKRS Header -->
<section class="py-4 bg-dark text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="h2 mb-2">
                    <i class="bi bi-calendar-event me-2"></i>SNKRS Launches
                </h1>
                <p class="lead mb-0">Get access to exclusive launches, draws, and limited releases</p>
            </div>
            <div class="col-md-4 text-md-end">
                <span class="badge bg-light text-dark fs-6"><?= $total ?> launches</span>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <?php if (empty($launches)): ?>
        <div class="text-center py-5">
            <i class="bi bi-calendar-x display-1 text-muted"></i>
            <h3 class="mt-3">No launches available</h3>
            <p class="text-muted">Check back soon for upcoming releases!</p>
            <a href="/products" class="btn btn-dark">Browse Products</a>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($launches as $launch): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm launch-card">
                        <?php if ($launch['image_url']): ?>
                            <div class="card-img-top position-relative overflow-hidden" style="height: 250px;">
                                <img src="<?= htmlspecialchars($launch['image_url']) ?>" 
                                     alt="<?= htmlspecialchars($launch['product_name']) ?>" 
                                     class="w-100 h-100" style="object-fit: cover;">
                                
                                <!-- Launch Type Badge -->
                                <div class="position-absolute top-0 start-0 m-3">
                                    <span class="badge bg-<?= $launch['launch_type'] === 'draw' ? 'warning' : ($launch['launch_type'] === 'fcfs' ? 'success' : 'info') ?> text-dark">
                                        <?= strtoupper($launch['launch_type']) ?>
                                    </span>
                                </div>
                                
                                <!-- Status Badge -->
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-<?= $launch['status'] === 'upcoming' ? 'primary' : ($launch['status'] === 'live' ? 'success' : 'secondary') ?>">
                                        <?= ucfirst($launch['status']) ?>
                                    </span>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= htmlspecialchars($launch['title']) ?></h5>
                            
                            <h6 class="text-muted mb-2"><?= htmlspecialchars($launch['product_name']) ?></h6>
                            
                            <p class="card-text flex-grow-1"><?= htmlspecialchars(substr($launch['description'], 0, 100)) ?>...</p>
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="h5 mb-0 text-dark">$<?= number_format($launch['price'], 2) ?></span>
                                <small class="text-muted">
                                    <i class="bi bi-calendar"></i>
                                    <?= date('M j, Y g:i A', strtotime($launch['launch_date'])) ?>
                                </small>
                            </div>
                            
                            <!-- Countdown Timer -->
                            <?php if ($launch['status'] === 'upcoming'): ?>
                                <div class="mb-3 p-3 bg-light rounded text-center">
                                    <small class="text-muted d-block mb-2">
                                        <?= $launch['launch_type'] === 'draw' ? 'Draw closes in:' : 'Launches in:' ?>
                                    </small>
                                    <div class="countdown fw-bold" data-launch-date="<?= date('c', strtotime($launch['launch_date'])) ?>">
                                        <span class="days">00</span>d 
                                        <span class="hours">00</span>h 
                                        <span class="minutes">00</span>m 
                                        <span class="seconds">00</span>s
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <div class="d-grid">
                                <a href="/launch/<?= $launch['id'] ?>" class="btn btn-dark">
                                    <?php if ($launch['status'] === 'upcoming'): ?>
                                        <?= $launch['launch_type'] === 'draw' ? 'Enter Draw' : 'Get Notified' ?>
                                    <?php elseif ($launch['status'] === 'live'): ?>
                                        Shop Now
                                    <?php else: ?>
                                        View Details
                                    <?php endif; ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
        <nav aria-label="Launches pagination" class="mt-4">
            <ul class="pagination justify-content-center">
                <?php if ($currentPage > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $currentPage - 1 ?>">Previous</a>
                    </li>
                <?php endif; ?>
                
                <?php
                $startPage = max(1, $currentPage - 2);
                $endPage = min($totalPages, $currentPage + 2);
                
                for ($i = $startPage; $i <= $endPage; $i++):
                ?>
                    <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                
                <?php if ($currentPage < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $currentPage + 1 ?>">Next</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        <?php endif; ?>
    <?php endif; ?>
</div>

<!-- Launch Types Info -->
<section class="py-5 bg-light">
    <div class="container">
        <h3 class="text-center mb-4">Launch Types</h3>
        <div class="row">
            <div class="col-md-4 text-center mb-4">
                <div class="p-4">
                    <div class="badge bg-success text-dark mb-3 p-3 fs-6">FCFS</div>
                    <h5>First Come, First Served</h5>
                    <p class="text-muted">Products available on launch day. No entry required.</p>
                </div>
            </div>
            <div class="col-md-4 text-center mb-4">
                <div class="p-4">
                    <div class="badge bg-warning text-dark mb-3 p-3 fs-6">DRAW</div>
                    <h5>Draw/Raffle</h5>
                    <p class="text-muted">Enter for a chance to purchase. Winners selected randomly.</p>
                </div>
            </div>
            <div class="col-md-4 text-center mb-4">
                <div class="p-4">
                    <div class="badge bg-info text-dark mb-3 p-3 fs-6">LEO</div>
                    <h5>Let Everyone Order</h5>
                    <p class="text-muted">Open to all users during the launch window.</p>
                </div>
            </div>
        </div>
    </div>
</section>