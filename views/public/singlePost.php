<?php
$title = $singlePost['title'];
?>
<section class="singlepost-post">
    <h1 class="singlepost-title"><?= $singlePost['title']; ?></h1>
    <p class="singlepost-date">Publié le <?= $singlePost['date_fr']; ?></p>
    <div class="singlepost-content"><?= $singlePost['content']; ?></div>
</section>
<section class="singlepost-comments">
    <h2>Commentaires</h2>
    <p>Les commentaires sont classés du plus récent au plus ancien.</p>
    <div class="singlepost-comments__add">
        <div class="show-comment-form">+ Ajouter un commentaire</div>
        <form class="comment-form off">
            <input type="text" title="comment-author" id="comment-author" name="comment-author" placeholder="Votre pseudo..." required><br>
            <textarea title="comment-message" id="comment-message" name="comment-message" cols="60" rows="5" placeholder="Votre commentaire..."></textarea><br>
            <button type="submit">Commenter !</button>
        </form>
    </div>
    <div class="singlepost-comments__container">
        <?php foreach ($commentsByPost as $comment): ?>
            <div class="comment">
                <div>
                    <p><strong><?= htmlspecialchars($comment['author']); ?></strong>, <small>le <?= $comment['date_fr']; ?></small></p>
                    <p><small><a class="report-comment" href="#" title="Signaler le commentaire"><i class="fas fa-flag"></i> Signaler</a></small></p>
                </div>
                <p><?= htmlspecialchars($comment['content']); ?></p>
            </div>
        <?php endforeach ?>
    </div>
</section>

<script src="../../public/js/comment.js"></script>