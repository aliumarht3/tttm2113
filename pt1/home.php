<?php
ob_start();
?>

<div class="card shadow border-0 border-start border-5 border-primary mb-4">
    <div class="card-body">
        <h2 class="mb-1">Home</h2>
        <p class="text-muted mb-0">Welcome to your central management hub</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body text-center py-5">
        <i class="bi bi-hexagon-fill display-1 text-primary mb-4 d-inline-block"></i>
        
        <h1 class="display-5 fw-bold mb-3">Ali & Co.</h1>
    </div>
</div>

<?php
$content = ob_get_clean();
require 'layout.php';
?>