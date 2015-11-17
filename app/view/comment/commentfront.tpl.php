<?php if (is_array($comments)) : ?>
    <div class='comments'>
        <table class='fronttable'>
        <?php foreach ($comments as $id => $comment) : ?>
            <tr>
                <td class='firsttd'>
                    <div class='commentfrontstats'><?=$comment->points?><p>röster</p></div>
                    <div class='commentfrontstats'><?=$comment->answers?><p>svar</p></div>
                </td>
                <td class='commentmain'>
                    <?php
                    if (strlen($comment->title) > 120) {
                        $pos = strpos($comment->title, ' ', 120);
                        $titlefin = substr($comment->title, 0, $pos) . "...";  
                    } else {
                        $titlefin = $comment->title;    
                    }
                    ?>
                    <h4 class='commenttitle'><a href="<?=$this->url->create('comment/view-single/' . $comment->id)?>"><?=$titlefin?></a></h4>
                    <?php if (isset($comment->category) && isset($comment->categoryid)) : ?>
                        <?php $categories = explode(",", $comment->category); ?>
                        <?php $categoriesid = explode(",", $comment->categoryid); ?>
                    <?php endif; ?>  
                    <?php for ($i = 0; $i < count($categories); $i++) : ?>
                        <a class='commentcategories' href="<?=$this->url->create('comment/allcategories/' . $categoriesid[$i])?>"><?=$categories[$i]?></a>
                    <?php endfor; ?>
                    <div class='commentfrontuser'>
                        <?php date_default_timezone_set('Europe/Berlin');
                        $datetime1 = strtotime($comment->timestamp);
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
                        <p><em><?=$timeAgo?></em> &dash; <a href="<?=$this->url->create('users/id/' . $comment->userid)?>"><?=$comment->user?></a></p>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </table>
    </div>
<?php endif; ?>
