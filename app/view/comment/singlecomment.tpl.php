<a class='backbutton' href="<?=$this->url->create('questions')?>"><i class="fa fa-hand-o-left"></i> Tillbaka till frågor</a>
<hr>
<?php if (isset($question->title)) : ?>
    <div class='comments'>
        <div class='commenttitle'><h3><?=$question->title?></h3></div>
        <table class='singletable'>
            <tr>
                <td class='commentpoints'>
                    <a class='<?=!$this->session->has('user') ? "notlogged" : ""?>' href="<?=$this->session->has('user') && $question->user != $this->session->get('user') ? $this->url->create('comment/vote/' . 'Comment' . '/' . $commentid . '/' . $commentid) : 'javascript:void(0)'?>"><i class="fa fa-caret-up fa-3x"></i></a>
                    <h4 class='greyfont'><?=$question->points?></h4>
                    <a class='<?=!$this->session->has('user') ? "notlogged" : ""?>' href="<?=$this->session->has('user') && $question->user != $this->session->get('user') ? $this->url->create('comment/vote/' . 'Comment' . '/' . $commentid . '/' . $commentid . '/down') : 'javascript:void(0)'?>"><i class="fa fa-caret-down fa-3x"></i></a>
                </td>
                <td class='singlecomment' id='q<?=$commentid?>'>
                    <?php $contentmark = $this->textFilter->doFilter($question->content, 'markdown');?>
                    <?=$contentmark?>
                    <?php if (is_array($categories)) : ?>
                            <?php foreach ($categories as $idcat => $category) : ?>
                                <a class='commentcategories' href="<?=$this->url->create('comment/allcategories/' . $category->id)?>"><?=$category->category?></a>
                            <?php endforeach; ?>
                    <?php endif; ?> 
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
                        <img src="<?=$question->gravatar?>" alt='gravatar'>
                        <p><a href="<?=$this->url->create('users/id/' . $question->userid)?>"><?=$question->user?></a></p>
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
                                    <a class='<?=!$this->session->has('user') ? "notlogged" : ""?>' href="<?=$this->session->has('user') && $reply->user != $this->session->get('user') ? $this->url->create('comment/vote/' . 'Reply' . '/' . $reply->id . '/' . $commentid) : 'javascript:void(0)'?>"><i class="fa fa-caret-up fa-2x"></i></a>
                                    <h5 class='greyfont'><?=$reply->points?></h5>
                                    <a class='<?=!$this->session->has('user') ? "notlogged" : ""?>' href="<?=$this->session->has('user') && $reply->user != $this->session->get('user') ? $this->url->create('comment/vote/' . 'Reply' . '/' . $reply->id . '/' . $commentid . '/down') : 'javascript:void(0)'?>"><i class="fa fa-caret-down fa-2x"></i></a>
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
            <tr>
                <td>
                </td>
                <td>
                <p class='commentaddcomment <?=!$this->session->has('user') ? "notlogged" : ""?>'><a href="<?=$this->session->has('user') ? $this->url->create('comment/reply/' . $commentid . '/question') : 'javascript:void(0)'?>">lämna kommentar</a></p>
                </td>
            </tr>
        </table>
    <?php if (is_array($answers) && !empty($answers)) : ?>
        <?php $answersnumber = count($answers); ?>
        <h3 class='greyfont'><?=$answersnumber?> Svar</h3>
        <select class="dropdownselect-answer" name="dropdownselect" onchange="location = this.options[this.selectedIndex].value;">
            <option value="">Sortera efter:</option>
            <option value="<?=$this->url->create('comment/view-single/' . $commentid . '/points/DESC') ?>">Mest uppröstade</option>
            <option value="<?=$this->url->create('comment/view-single/' . $commentid . '/timestamp/DESC') ?>">Senaste</option>
        </select>
        <table class='singlecomment-answer'>
            <?php foreach ($answers as $idansw => $comment) : ?>
                <tr>
                    <td class='commentpoints'>
                            <a class='<?=!$this->session->has('user') ? "notlogged" : ""?>' href="<?=$this->session->has('user') && $comment->user != $this->session->get('user') ? $this->url->create('comment/vote/' . 'Answer' . '/' . $comment->id . '/' . $commentid) : 'javascript:void(0)'?>"><i class="fa fa-caret-up fa-3x"></i></a>
                            <h4 class='greyfont'><?=$comment->points?></h4>
                            <a class='<?=!$this->session->has('user') ? "notlogged" : ""?>' href="<?=$this->session->has('user') && $comment->user != $this->session->get('user') ? $this->url->create('comment/vote/' . 'Answer' . '/' . $comment->id . '/' . $commentid . '/down') : 'javascript:void(0)'?>"><i class="fa fa-caret-down fa-3x"></i></a>
                            <?php if ($this->session->has('user') && $comment->user != $this->session->get('user') && $this->session->get('user') == $question->user) {
                                $linkaccept = $this->url->create('comment/accept/' . $comment->id . '/' . $commentid); 
                                $linkdeny = $this->url->create('comment/remove-accept/' . $comment->id . '/' . $commentid);
                            } else {
                                $linkaccept = 'javascript:void(0)';
                                $linkdeny = 'javascript:void(0)';
                            } ?>
                            <?php if (is_null($comment->accepted)) : ?>
                                <div class='commentaccept <?=!$this->session->has('user') ? "notlogged" : ""?>'><p><a href="<?=$linkaccept?>"><i class="fa fa-paw fa-2x"></i></a></p></div>
                            <?php else : ?>
                                <div class='commentaccept <?=!$this->session->has('user') ? "notlogged" : ""?>'><p><a href="<?=$linkdeny?>"><i class="fa fa-paw fa-2x up"></i></a></p></div>
                            <?php endif; ?>
                            
                    </td>
                    <td class='singleanswer' id='<?=$comment->id?>'>
                        <?php $contentmark = $this->textFilter->doFilter($comment->content, 'markdown');?>
                        <?=$contentmark?>
                        <div class='commentuserinfo'>
                            <?php date_default_timezone_set('Europe/Berlin');
                            $datetime1 = strtotime($comment->timestamp);
                            $datetime2 = strtotime(date('Y-m-d H:i:s'));
                            $difference = abs($datetime2 - $datetime1);
                            $res = round($difference / 60 / 60 / 24);
                            if ($res > 15) {
                                $timeAgo = $comment->timestamp;
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
                            <img src="<?=$comment->gravatar?>" alt='gravatar'>
                            <p><a href="<?=$this->url->create('users/id/' . $comment->userid)?>"><?=$comment->user?></a></p>
                        </div>
                        <?php if (is_array($repliesanswer)) : ?>
                        <tr>
                            <td>
                            </td>
                            <td>
                            <table>
                            <?php foreach ($repliesanswer as $id => $reply) : ?>
                                <?php if ($comment->id == $reply->answerto) : ?>
                                <tr class='commentreply' id='rep<?=$reply->id?>'>
                                    <td class='commentpointssmall'>
                                            <a class='<?=!$this->session->has('user') ? "notlogged" : ""?>' href="<?=$this->session->has('user') && $reply->user != $this->session->get('user') ? $this->url->create('comment/vote/' . 'Reply' . '/' . $reply->id . '/' . $commentid) : 'javascript:void(0)'?>"><i class="fa fa-caret-up fa-2x"></i></a>
                                            <h5 class='greyfont'><?=$reply->points?></h5>
                                            <a class='<?=!$this->session->has('user') ? "notlogged" : ""?>' href="<?=$this->session->has('user') && $reply->user != $this->session->get('user') ? $this->url->create('comment/vote/' . 'Reply' . '/' . $reply->id . '/' . $commentid . '/down') : 'javascript:void(0)'?>"><i class="fa fa-caret-down fa-2x"></i></a>
                                    </td>
                                    <td class='commentmainsmall'>
                                        <?php $contentmark = $this->textFilter->doFilter($reply->content, 'markdown');?>
                                        <?=$contentmark?> &ndash; <a href="<?=$this->url->create('users/id/' . $reply->userId)?>"><?=$reply->user?></a> <em><?=$reply->timestamp?></em>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </table>
                        <?php endif; ?>
                    <p class='commentaddcomment <?=!$this->session->has('user') ? "notlogged" : ""?>'><a href="<?=$this->session->has('user') ? $this->url->create('comment/reply/' . $comment->id . '/answer') : 'javascript:void(0)'?>">lämna kommentar</a></p>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
        <?php $answerform ?> 
<?php endif; ?>
</div>
