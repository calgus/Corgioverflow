<?php if (isset($question)) : ?>
    <table>
        <tr>
            <td class='commentpoints'>
                <a href="javascript:void(0)"/><i class="fa fa-caret-up fa-3x"></i></a>
                <h4 class='greyfont'><?=$question->points?></h4>
                <a href="javascript:void(0)"/><i class="fa fa-caret-down fa-3x"></i></a>
            </td>
            <td class='singlecomment' id='q<?=$commentid?>'>
                <?php $contentmark = $this->textFilter->doFilter($question->content, 'markdown');?>
                <?=$contentmark?>
                <div class='commentuserinfo'>
                    <?php date_default_timezone_set('Europe/Berlin');
                    $datetime1 = strtotime($question->timestamp);
                    $datetime2 = strtotime(date('Y-m-d H:i:s'));
                    $difference = abs($datetime2 - $datetime1);
                    $res = round($difference / 60 / 60 / 24);
                    if ($res > 15) {
                        $timeAgo = $question->timestamp;
                    } elseif ($res < 1) {
                        $hours = round($difference / 60 / 60) . " timmar sedan";
                        $minutes = round($difference / 60) . " minuter sedan";
                        if ($hours > 0) {
                            $timeAgo = $hours;
                        } else {
                            $timeAgo = $minutes;
                        }
                    } else {
                        $timeAgo = $res . " dagar sedan";
                    }?>
                    <div class='commenttimestamp'><em><?=$timeAgo?></em></div>
                    <img src="<?=$question->gravatar?>">
                    <p><a href="<?=$this->url->create('users/id/' . $question->userid)?>"/><?=$question->user?></a></p>
                </div>
            </td>
        </tr>
        <?php if (is_array($repliesquestion)) : ?>
            <tr>
                <td>
                </td>
                <td>
                    <table>
                        <?php foreach ($repliesquestion as $id => $reply) : ?>
                            <tr class='commentreply' id='rep<?=$reply->id?>'>
                                <td class='commentpointssmall'>
                                    <h5 class='greyfont'><?=$reply->points?></h5>
                                </td>
                                <td class='commentmainsmall'>
                                    <?php $contentmark = $this->textFilter->doFilter($reply->getProperties()['content'], 'markdown'); ?>
                                    <?=$contentmark?> &ndash; <a href="<?=$this->url->create('users/id/' . $reply->userId)?>"><?=$reply->user?></a> <em><?=$reply->timestamp?></em>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </td>
            </tr>
        <?php endif; ?>
    </table>
    <hr>
<?php endif; ?>
<div class='comment-form'>
    <?=$content?>
</div>
