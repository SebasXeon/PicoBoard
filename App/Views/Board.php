<?php 
    $layout = 'App/Views/Layouts/MainLayout.php';
    require_once('App/Core/Layout.php');
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
                    <span class="thread-id-text">#<?= $thread->id ?> </span>
                </div>
            </div>
            <div class="thread-content padded">
                <?php if ($thread->attachment_id != null) { ?>
                    <div class="thread-content-image">
                        <img src="https://via.placeholder.com/150" alt="Thread image">
                        <span class="thread-content-image-text">Image description</span>
                    </div>
                <?php } ?>
                <div class="thread-content-body">
                    <span class="thread-content-title">Anonymous#1232 - <?= $thread->created_at ?> - #<?= $thread->id ?> [<a href="thread/<?= $thread->id ?>">Reply</a>]</span>
                    <p class="thread-content-text"><?= $thread->body; ?></p>
                </div>
            </div>
            <div class="thread-replies padded">
                <?php foreach($thread->replies as $reply) { ?>
                    <div class="thread-content padded b-top">
                        <?php if ($reply->attachment_id != null) { ?>
                            <div class="thread-content-image">
                                <img src="https://via.placeholder.com/150" alt="Thread image">
                                <span class="thread-content-image-text">Image description</span>
                            </div>
                        <?php } ?>
                        <div class="thread-content-body">
                            <span class="thread-content-title">Anonymous#1232 - <?= $reply->created_at ?> - #<?= $reply->id ?> [<a href="thread/<?= $thread->id ?>">Reply</a>]</span>
                            <p class="thread-content-text"><?= $reply->body; ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>