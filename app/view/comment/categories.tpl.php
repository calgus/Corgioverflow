<?php if (isset($links)) : ?>
    <table class='linkcategories'>
        <?php foreach ($links as $id => $link) : ?>
            <?php if ($id == 0) : ?>
                <tr>
            <?php endif; ?>
            <td>
                <a class="commentcategories" href="<?=$link['href']?>"><?=$link['text']?></a>
                <p><?=$link['description']?></p>
            </td>
            <?php if (($id+1) % 3 == 0) : ?>
                </tr>
                <?php if (($id+1) != count($links)) : ?>
                    <tr>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
