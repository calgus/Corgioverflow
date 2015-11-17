<h1>Slå dina tärningar här!</h1>

<p>Välkommen till detta underhållande tärningsspel.</p>

<p>Hur många tärningar vill du slå?, <a href='<?=$this->url->create("dice/roll?roll=1")?>'>1 tärning</a>, <a href='<?=$this->url->create("dice/roll?roll=3")?>'>3 tärningar</a> or <a href='<?=$this->url->create("dice/roll?roll=6")?>'>6 tärningar</a>? </p>

<?php if(isset($roll)) : ?>
<p>Du slog <?=$roll?> tärningar och fick den här följden:</p>

<ul class='dice'>
<?php foreach($results as $val) : ?>
<li class='dice-<?=$val?>'></li>
<?php endforeach; ?>
</ul>

<p>Du fick totalsumman: <?=$total?></p>
<?php endif; ?>
