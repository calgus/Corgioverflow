<h1><?=$title?></h1>

<select name="dropdownselect" onchange="location = this.options[this.selectedIndex].value;">
    <option value="">Välj kategori</option>
    <option value="<?=$this->url->create('users/list') ?>">Visa alla</option>
    <option value="<?=$this->url->create('users/active') ?>">Visa aktiva</option>
    <option value="<?=$this->url->create('users/inactive') ?>">Visa inaktiva</option>
    <option value="<?=$this->url->create('users/deleted') ?>">Visa raderade</option>
</select>
<table>
    <?php foreach ($users as $user) : ?>
    <tr>
        <td>
            <p><?=$user->getProperties()['acronym']?></p>
        </td>
        <td>
            <a href='<?=$this->url->create('users/id/' . $user->getProperties()['id'])?>'>Redigera användare</a>
        </td>
        <td>
            <?php if(isset($user->active)) { ?>
                <a href='<?=$this->url->create('users/inactivate/' . $user->getProperties()['id'])?>'>Gör inaktiv</a>
            <?php   } else {?>
                <a href='<?=$this->url->create('users/activate/' . $user->getProperties()['id'])?>'>Gör aktiv</a>
            <?php } ?>
        </td>
        <td>
            <?php if(!isset($user->deleted)) { ?>
                <a href='<?=$this->url->create('users/soft-delete/' . $user->getProperties()['id'])?>'>Soft radera</a>
            <?php   } else {?>
                <a href='<?=$this->url->create('users/soft-delete-undo/' . $user->getProperties()['id'])?>'>Återställ radera</a>
            <?php } ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<p><a href='<?=$this->url->create('showall')?>'>Tillbaka</a></p>
