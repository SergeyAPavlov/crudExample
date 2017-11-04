<h3>Просмотр</h3>
<?php
$text = '<table class="table table-striped">';
$text .= '<thead><tr><td>id</td><td>Логин</td><td>Пароль</td><td>ФИО</td><td>email</td><td>права администратора</td></tr></thead>';

$text .= "<tbody><tr>";
foreach ($fields as $name => $field) {
    if ($name == 'password') {
        $text .= '<td>* * *</td>';
    } else {
        $text .= '<td>' . $field . '</td>';;
    }
}

$text .= '</tr></tbody>';

$text .= '</table></form>';
echo $text;




