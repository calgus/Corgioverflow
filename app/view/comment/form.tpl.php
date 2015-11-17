<div class='comment-form'>
    <form method=post>
        <?php $current = isset($page) ? $page : '';?>
        <input type=hidden name="redirect" value="<?=$this->url->create($current)?>">
        <input type=hidden name="page" value="<?=$current?>">
        <fieldset>
        <legend>Lämna en kommentar</legend>
        <p><label>Namn:<br/><input type='text' name='name' class='formname' maxlength='29' required value='<?=$name?>'/></label></p>
        <div class='left'>
            <p><label>Kommentar:<br/><textarea name='content' class='formcontent' required><?=$content?></textarea></label></p>
        </div>
        <div class='right'>
            <p><label>Hemsida:<br/><input type='url' name='web' class='formweb' value='<?=$web?>'/></label></p>
            <p><label>Email:<br/><input type='email' name='mail' class='formmail' value='<?=$mail?>'/></label></p>        
        </div>        
        <p class='buttons'>
            <input type='submit' name='doCreate' value='Skicka' class='formsubmit' onClick="this.form.action = '<?=$this->url->create('comment/add')?>'"/>
            <input type='reset' value='Återställ'/>
            <input type='submit' name='doRemoveAll' value='Rensa alla' formnovalidate onClick="this.form.action = '<?=$this->url->create('comment/remove-all')?>'"/>
        </p>
        <output><?=$output?></output>
        </fieldset>
    </form>
</div>
