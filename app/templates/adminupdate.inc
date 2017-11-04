<h3>Редактирование</h3>
<?php
$text = '<form name="form1" method="post" action=""><table>';
$text .= '<tr><td>id</td><td>Логин</td><td>Пароль</td><td>ФИО</td><td>email</td><td>права администратора</td></tr>';

$text .= "<tr>";
    foreach ($fields as $name => $field) {
        if ($name == 'id'){
            $text .= '<td>'.$field.'</td>';
        }
        elseif ($name == 'rights'){
            $box = ($field? 'checked':'');
            $text .='<td><input name="rights" type="checkbox" value="checkbox" '.$box.'></td>';
        }
        else{
            $text .= '<td><input type="text" name="'.$name.'" value="'.$field.'"></td>';
        }
    }

    $text .= '<td><input type="submit" name="Submit" value="Submit"></td></tr>';

$text .= '</table></form>';
echo $text;




