<table class='usertable'>
    <?php foreach ($users as $id => $user) : ?>
        <?php if ($id == 0) : ?>
            <tr>
        <?php endif; ?>
        <td>
        <a href="<?=$this->url->create('users/id/' . $user->id)?>">
            <div class='userinfo'>
                <img src="<?=$user->gravatar?>" alt='gravatar'>
                <p><i class="fa fa-diamond"></i> <?=$user->fame + (($user->comments + $user->commentPoints) * 10) + (($user->answers + $user->answerPoints) * 7) + (($user->replies + $user->replyPoints) * 3)?></p>
                <p><i class="fa fa-question-circle"></i> <?=$user->comments?></p>
                <p><i class="fa fa-check-circle"></i> <?=$user->answers?></p>
                <h5><?=$user->user?></h5>
            </div>
            </a>
        </td>
        <?php if (($id+1) % 4 == 0) : ?>
            </tr>
            <?php if (($id+1) != count($users)) : ?>
                <tr>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
</table>
