<h3><?=$title?></h3>
<table class='tablefrontcategories'>
    <?php foreach($categories as $category) : ?>
        <tr>
            <td>
                <a class='commentcategories' href="<?=$this->url->create('comment/allcategories/' . $category->id)?>"><?=$category->category?></a>&times; <?=$category->timesused?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
