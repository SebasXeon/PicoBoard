<div class="thread-content padded b-top">
    <?php if ($post->attachment_id != null) { ?>
        <div class="thread-content-image">
            <img src="https://via.placeholder.com/150" alt="Thread image">
            <span class="thread-content-image-text">Image description</span>
        </div>
    <?php } ?>
    <div class="thread-content-body">
        <span class="thread-content-title">Anonymous#1232 - <?= $post->created_at ?> - #<?= $post->id ?> [<a href="/<?= $board->url ?>/thread/<?= $thread->id ?>">Reply</a>]</span>
        <p class="thread-content-text"><?= $post->body; ?></p>
    </div>
</div>