<?php 
    $layout = 'app/views/layouts/MainLayout.php';
    require_once('app/core/layout.php');
    $boards = $page['boards'];
?>

<div class="h-container b-full">
    <div class="h-top b-bottom">
        <div class="h-top-section  h-top-section-left">
            <div class="h-top-title b-bottom padded">
                <h1>PicoBoard</h1>
            </div>
            <div class="h-top-desc padded">
                <p>Simple, fast, and easy to use imageboard.</p>
            </div>
        </div>
        <div class="h-top-section b-left padded inverse">
            pico
        </div>
    </div>
    <div class="h-body">
        <div class="h-b-row">
            <div class="h-row-title padded b-bottom">
                <h2>Boards</h2>
            </div>
            <div class="h-row-content">
                <div class="h-row-list inverse">
                    <?php foreach($boards as $board): ?>
                        <div class="h-row-item padded normal">
                            <a href="<?= $board->url ?>/"><?= $board->title ?></a>
                            <span><?= $board->description ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>