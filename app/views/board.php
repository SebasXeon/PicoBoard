<?php 
    $layout = 'app/views/layouts/MainLayout.php';
    require_once('app/core/layout.php');
    $board = $page['board'];
    $threads = $page['threads'];
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
    <?php foreach ($threads as $thread) { ?>
        <div class="thread b-full">
            <div class="thread-top inverse padded">
                <div class="thread-title">
                    <h3>{&nbsp;&nbsp;&nbsp;<?= $thread->title; ?>&nbsp;&nbsp;&nbsp;}</h3>
                </div>
                <div class="thread-id">
                    <span class="thread-id-text">#<?= $thread->posts[0]->id ?> </span>
                </div>
            </div>
            <div class="thread-content padded">
                <?php if ($thread->posts[0]->attachment_id != null) { ?>
                    <div class="thread-content-image">
                        <img src="https://via.placeholder.com/150" alt="Thread image">
                        <span class="thread-content-image-text">Image description</span>
                    </div>
                <?php } ?>
                <div class="thread-content-body">
                    <span class="thread-content-title">Anonymous#1232 - 14/01/2024 10:23 - #<?= $thread->posts[0]->id ?> [<a href="#">Reply</a>]</span>
                    <p class="thread-content-text"><?= $thread->posts[0]->body; ?></p>
                </div>
            </div>
            <div class="thread-replies padded">
                <?php foreach(array_slice($thread->posts,1) as $post) { ?>
                    <div class="thread-content padded b-top">
                        <?php if ($post->attachment_id != null) { ?>
                            <div class="thread-content-image">
                                <img src="https://via.placeholder.com/150" alt="Thread image">
                                <span class="thread-content-image-text">Image description</span>
                            </div>
                        <?php } ?>
                        <div class="thread-content-body">
                            <span class="thread-content-title">Anonymous#1232 - 14/01/2024 10:23 - #<?= $post->id ?> [<a href="#">Reply</a>]</span>
                            <p class="thread-content-text"><?= $post->body; ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>