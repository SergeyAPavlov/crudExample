<h3>Удаление пользователя</h3>
Вы хотите удалить пользователя с id = <?= $userid ?>?
<?php
$text = '<form name="form_id" method="get" action="">';
$text .= '<input name="id" type="hidden" value="' . $userid . '">';
$text .= '<button type="submit" class="btn btn-primary" name="Submit" value="Submit">Удалить</button> ';
$text .= '</form>';
echo $text;




