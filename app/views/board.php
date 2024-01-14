<?php 
    $layout = 'app/views/layouts/MainLayout.php';
    require_once('app/core/layout.php');
    $board = $page['board'];
?>

<div class="b-top">
    <div class="b-banner b-full padded inverse">
        <h1>PicoBoard</h1>
    </div>
    <div class="b-title">
        <h2>< /<?= $board->url ?>/ - <?= $board->title; ?> ></h2>
    </div>
    <div class="b-post">
        <button class="button">New Thread</button>
    </div>
</div>
<div class="b-threads">
    <div class="thread b-full">
        a
    </div>
</div>