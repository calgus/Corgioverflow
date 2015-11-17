<h3><?=$title?></h3>
<table class='tablefrontusers'>
    <?php foreach ($users as $user) : ?>
        <tr>
            <td>
                <p><a href="<?=$this->url->create('users/id/' . $user->id) ?>"><?=$user->user?></a></p>
                <i class="fa fa-question-circle"></i><?=$user->comments?>&dash;<i class="fa fa-check-circle"></i><?=$user->answers?>&dash;<i class="fa fa-plus-circle"></i><?=$user->replies?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
