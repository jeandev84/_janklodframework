<div class="container">
    <?php foreach ($posts as $post) : ?>
        <?php include(__DIR__.'/partials/_post.php') ?>
        <p>
            <a href="/post/<?= $post['id'] ?>">Подробнее</a>
        </p>
    <?php endforeach; ?>
</div>
