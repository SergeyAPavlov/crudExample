<h3>Редактирование</h3>
<script src="/mailValid.js"></script>
<?php
$text = '<form name="form_id" method="post" action="" onsubmit="javascript:return validate(\'form_id\',\'email\')"><table>';
$text .= '<tr><td>id</td><td>Логин</td><td>Пароль</td><td>ФИО</td><td>email</td><td>права администратора</td></tr>';

$text .= "<tr>";
foreach ($fields as $name => $field) {
    if ($name == 'id' OR $name == 'rights') {
        $text .= '<td>' . $field . '</td>';
    } else {
        $text .= '<td><input type="text" name="' . $name . '" value="' . $field . '"></td>';
    }
}

$text .= '<td><input type="submit" name="Submit" value="Submit"></td></tr>';

$text .= '</table></form>';
echo $text;



