<h3>Редактирование</h3>
<script src="/mailValid.js"></script>
<?php
$text = '<form name="form_id" method="post" action="" onsubmit="javascript:return validate(\'form_id\',\'email\')"><table class="table table-striped">';
$text .= '<thead><tr><td>id</td><td>Логин</td><td>Пароль</td><td>ФИО</td><td>email</td><td>права администратора</td></tr></thead>';

$text .= " <tbody><tr>";
foreach ($fields as $name => $field) {
    if ($name == 'id' OR $name == 'rights' OR $name == 'login') {
        $text .= '<td>' . $field . '</td>';
    } else {
        $text .= '<td><input type="text" name="' . $name . '" value="' . $field . '"></td>';
    }
}

$text .= '<td><input type="submit" name="Submit" value="Submit"></td></tr>';

$text .= '</tbody></table></form>';
echo $text;




