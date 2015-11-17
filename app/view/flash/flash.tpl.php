<form method='post'>
    <input type=hidden name="redirect" value="<?=$this->url->create('')?>">
    <input type='radio' name='messageRadio' value='Error' checked> Error
    <input type='radio' name='messageRadio' value='Success'> Success
    <input type='radio' name='messageRadio' value='Notice'> Notice
    <input type='radio' name='messageRadio' value='Warning'>  Warning
    <input type='text' name='message'>
    <input type='submit' value='Submit' onClick="this.form.action = '<?=$this->url->create('flash/post')?>'"/>
    <output><?=$output?></output>
</form>
