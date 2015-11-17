<a class='backbutton' href="<?=$this->url->create('categories')?>"><i class="fa fa-hand-o-left"></i> Tillbaka till taggar</a><br>
<hr>
<?php if (is_array($comments)) : ?>
    <div class='comments'>
        <select class="dropdownselect" onchange="location = this.options[this.selectedIndex].value;">
            <option value="">Sortera efter:</option>
            <option value="<?=$this->url->create('comment/allcategories/' . $categoryid . '/points') ?>">Mest uppröstade</option>
            <option value="<?=$this->url->create('comment/allcategories/' . $categoryid) ?>">Senaste</option>
        </select>
        <table class='tablefull'>
            <tr>
            <td>
            </td>
            <td>
                <h3><?=$title?></h3>
            </td>
            </tr>
            <?php foreach ($comments as $id => $comment) : ?>
                <tr>
                    <td class='commentstats'>
                        <h4><?=$comment->points?></h4><p>röster</p>
                        <h4><?=$comment->answers?></h4><p>svar</p>
                    </td>
                    <td>
                <div class='singlecomment'>
                    <div class='commentmain'>
                        <?php
                        if (strlen($comment->title) > 150) {
                            $pos = strpos($comment->title, ' ', 150);
                            $titlefin = substr($comment->title, 0, $pos) . "...";  
                        } else {
                            $titlefin = $comment->title;    
                        }
                        ?>
                        <h4 class='commenttitle'><a href="<?=$this->url->create('comment/view-single/' . $comment->id)?>"><?=$titlefin?></a></h4>
                        <?php
                        $markdownarray = array('-', '=', '*', '`');
                        $newcontent = str_replace($markdownarray, '', $comment->content);
                        if (strlen($newcontent) > 150) {
                            $pos = strpos($newcontent, ' ', 150);
                            if ($pos != '') {
                                $contentfin = substr($newcontent, 0, $pos) . " ...";  
                            } else {
                                $contentfin = substr($newcontent, 0, 150) . " ...";    
                            }
                        } else {
                            $contentfin = $newcontent;    
                        }
                        ?>
                        <div class='commentcontent'><?=$contentfin?></div>
                        <?php if (isset($comment->category) && isset($comment->categoryid)) : ?>
                            <?php $categories = explode(",", $comment->category); ?>
                            <?php $categoriesid = explode(",", $comment->categoryid); ?>
                        <?php endif; ?>  
                    </div>
                        <?php for ($i = 0; $i < count($categories); $i++) : ?>
                            <a class='commentcategories' href="<?=$this->url->create('comment/allcategories/' . $categoriesid[$i])?>"><?=$categories[$i]?></a>
                        <?php endfor; ?>
                    <div class='commentuserinfo'>
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
                        <div class='commenttimestamp'><em><?=$timeAgo?></em></div>
                        <img src="<?=$comment->gravatar?>" alt='gravatar'>
                        <p><a href="<?=$this->url->create('users/id/' . $comment->userid)?>"><?=$comment->user?></a></p>
                    </div>
                </div>
                </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
<?php endif; ?>
