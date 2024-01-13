<?php 
    $layout = 'app/views/layouts/MainLayout.php';
    require_once('app/core/layout.php');

    $boards = $page['boards'];
?>

<div class="h-container">
    <div class="h-banner">
        <img src="/images/logo.png" alt="PICO-BOARD" class="h-logo" />
    </div>
    <div class="h-content">
        <div class="h-section">
            <div class="h-section-header">
                <h2>Boards</h2>
            </div>
            <div class="h-section-content">
                <?php foreach ($boards as $board) { ?>
                    <div class="h-section-item">
                        <a href="/<?php echo $board->url; ?>/" class="h-section-i-link"><?php echo $board->title; ?></a>
                        <span class="h-section-i-desc"> <?php echo $board->description; ?> </span>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="h-footer">
        <div class="h-footer-content">
            <span class="h-footer-item">PicoBoard</span>
            <span class="h-footer-item">Created by <a href="https://github.com/SebasXeon" target="_blank">SebasXeon</a></span>
    </div>
</div>