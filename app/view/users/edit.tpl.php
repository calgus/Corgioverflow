<div class='comment-form'>
    <?=$content?>
</div>
<?php if (isset($links)) {?>
    <?php foreach ($links as $link) : ?>
        <?=$link['topic']?><br>
        <em><a href="<?=$link['href']?>"><?=$link['text']?></a></em>
    <?php endforeach; ?>
<?php } ?>

