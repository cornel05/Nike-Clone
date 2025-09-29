<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Nike Clone - Just Do It' ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link href="/assets/css/style.css" rel="stylesheet">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="<?= $description ?? 'Nike Clone - Premium athletic shoes, clothing and gear. Just Do It.' ?>">
    <meta name="keywords" content="Nike, shoes, sneakers, athletic wear, basketball, running, lifestyle">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?= $title ?? 'Nike Clone - Just Do It' ?>">
    <meta property="og:description" content="<?= $description ?? 'Premium athletic shoes, clothing and gear.' ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= BASE_URL . $_SERVER['REQUEST_URI'] ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.ico">
</head>
<body>
    <?php include __DIR__ . '/../partials/header.php'; ?>
    
    <main role="main">
        <?= $content ?>
    </main>
    
    <?php include __DIR__ . '/../partials/footer.php'; ?>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="/assets/js/main.js"></script>
    
    <?php if (isset($_ENV['GOOGLE_MAPS_API_KEY']) && $_ENV['GOOGLE_MAPS_API_KEY'] !== 'your_google_maps_api_key_here'): ?>
    <!-- Google Maps API -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?= $_ENV['GOOGLE_MAPS_API_KEY'] ?>&callback=initMap"></script>
    <?php endif; ?>
</body>
</html>