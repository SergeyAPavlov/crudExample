<h3>Редактирование</h3>
<script src="/mailValid.js"></script>
<?php
$text = '<form name="form_id" method="post" action="" onsubmit="javascript:return validate(\'form_id\',\'email\')"><table>';
$text .= '<tr><td>id</td><td>Логин</td><td>Пароль</td><td>ФИО</td><td>email</td><td>права администратора</td></tr>';

$fields = array_fill_keys($fields, '');
$text .= "<tr>";
foreach ($fields as $name => $field) {
    if ($name == 'id') {
        $text .= '<td>' . $field . '</td>';
    } elseif ($name == 'rights') {
        $box = ($field ? 'checked' : '');
        $text .= '<td><input name="rights" type="checkbox" value="checkbox" ' . $box . '></td>';
    } else {
        $text .= '<td><input type="text" name="' . $name . '" value="' . $field . '"></td>';
    }
}

$text .= '<td><input type="submit" name="Submit" value="Submit"></td></tr>';

$text .= '</table></form>';
echo $text;




