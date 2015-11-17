<a class='backbutton' href="<?=$this->url->create('users')?>"/><i class="fa fa-hand-o-left"></i> Tillbaka till användare</a><br>
<hr>
<table class="fulluser">
    <tr>
        <?php if (!empty($loggeduser) && $loggeduser == $user->user) : ?>
            <td colspan='2'>
                <p><a class='profilebutton' href="<?=$this->url->create('users/logout/' . $user->id)?>">Logga ut</a> &dash; <a class='profilebutton' href="<?=$this->url->create('users/update/' . $user->id)?>">Redigera profil</a></p>
            </td>
        <?php endif; ?>
    </tr>
    <th>
    </th>
    <th>
        <h2><?=$user->user?></h2>
    </th>
    <tr>
        <td class='userinfo'>
                <img src="<?=$user->gravatar?>">
        </td>
        <td rowspan='2' class='myinformation'>
            <h3>Om mig:</h3>
            <p><?=$user->information == null ? '<em>' . $user->user . ' har inte skrivit något om sig själv.</em>' : $user->information?></p>
        </td>
    </tr>
    <tr>
        <td>
            <p>Rykte: <?=$user->fame + (($user->comments + $user->commentPoints) * 10) + (($user->answers + $user->answerPoints) * 7) + (($user->replies + $user->replyPoints) * 3)?></p>
            <p>Frågor: <?=$user->comments?></p>
            <p>Svar: <?=$user->answers?></p>
            <p>Kommentarer: <?=$user->replies?></p>
            <p>Röstningar: <?=$user->upvoted?></p>
        </td>
    </tr>
    
    <?php if (!empty($loggeduser) && $loggeduser == $user->user) : ?>
        <tr>
            <td colspan='2'>
                <hr>
                <p>Namn: <?=$user->name?></p>
                <p>Email: <?=$user->email?></p>
            </td>
        </tr>
    <?php endif; ?>
    
</table> 
<hr>
<table class='tableuserhidden' id='togglequestions'>
    <tr>
        <th class='firsttd'>
            <a href='javascript:void(0)' id='showhidequestions'>Visa svar <i class="fa fa-arrow-down"></i></a> 
        </th>
        <th>
            <h3>Frågor</h3>                
        </th>
    </tr>
    <?php if (is_array($comments)) : ?>
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
                        <a class='commentcategories' href="<?=$this->url->create('comment/allcategories/' . $categoriesid[$i])?>"/><?=$categories[$i]?></a>
                    <?php endfor; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif;?>
</table>

<table class='tableuserhidden' id='toggleanswers'>
    <tr>
        <th class='firsttd'>
            <a href='javascript:void(0)' id='showhideanswers'>Visa frågor <i class="fa fa-arrow-down"></i></a>
        </th>
        <th>
            <h3>Svar</h3>                 
        </th>
    </tr>
    <?php if (is_array($answers)) : ?>
        <?php foreach ($answers as $answer) : ?>
            <tr>
                <td class='firsttd'>
                    <div class='commentfrontstats'><?=$answer->points?><p>röster</p></div>
                    <div class='commentfrontstats'><?=$answer->answers?><p>svar</p></div>
                </td>
                <td class='commentmain'>
                    <?php
                    if (strlen($answer->title) > 120) {
                        $pos = strpos($answer->title, ' ', 120);
                        $titlefin = substr($answer->title, 0, $pos) . "...";  
                    } else {
                        $titlefin = $answer->title;    
                    }
                    ?>
                    <h4 class='commenttitle'><a href="<?=$this->url->create('comment/view-single/' . $answer->id)?>"><?=$titlefin?></a></h4>
                    <?php if (isset($answer->category) && isset($answer->categoryid)) : ?>
                        <?php $categories = explode(",", $answer->category); ?>
                        <?php $categoriesid = explode(",", $answer->categoryid); ?>
                    <?php endif; ?>  
                    <?php for ($i = 0; $i < count($categories); $i++) : ?>
                        <a class='commentcategories' href="<?=$this->url->create('comment/allcategories/' . $categoriesid[$i])?>"/><?=$categories[$i]?></a>
                    <?php endfor; ?>
                    <div class='commentfrontuser'>
                        <p><em>svar till</em> <a href="<?=$this->url->create('users/id/' . $answer->userid)?>"/><?=$answer->user?></a></p>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif;?>
</table>
