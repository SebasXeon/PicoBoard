<?php
    use App\Core\Render;

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
            <?php Render::component('Post', ['board' => $board, 'thread' => $thread, 'post' => $thread]); ?>
            <div class="thread-replies padded">
                <?php foreach($thread->replies as $reply) {
                    Render::component('Post', ['board' => $board, 'thread' => $thread, 'post' => $reply]);
                }?>
            </div>
        </div>
    <?php } ?>
</div>