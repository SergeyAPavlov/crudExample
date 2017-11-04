<h3>Удаление пользователя</h3>
Вы хотите удалить пользователя с id = <?= $userid ?>?
<?php
$text = '<form name="form_id" method="get" action="">';
$text .= '<input type="submit" name="Submit" value="Submit">';
$text .= '<input name="id" type="hidden" value="' . $userid . '">';
$text .= '</form>';
echo $text;




