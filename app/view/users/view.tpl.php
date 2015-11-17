<table class='detailed'>
    <th>Acronym:</th>
    <th>Namn:</th>
    <th>Email:</th>
    <th>Status:</th>
    <tr>     
        <td>
            <p><?=$user->acronym?></p>
        </td>
        <td>
            <p><?=$user->name?></p>
        </td>
        <td>
            <p><?=$user->email?></p>
        </td>
        <td>
            <p><?=isset($user->active) ? "Aktiv" : "Inaktiv"?> <?=isset($user->deleted) ? " | Soft-raderad" : ""?></p>
        </td>
    </tr>
</table>
<a href='<?=$this->url->create('users/update/' . $user->getProperties()['id'])?>'><button>Uppdatera</button></a>
<a href='<?=$this->url->create('users/delete/' . $user->getProperties()['id'])?>'><button>Radera</button></a>
<p><a href='<?=$this->url->create('users/list')?>'>Tillbaka</a></p>
