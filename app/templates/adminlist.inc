Список юзеров
<?php
    //print_r($table);
    $text = '<table>';
    foreach ($table as $user){
        $text .= "<tr>";
        foreach ($user as $name => $field) {
            $text .= '<td>'.$field.'</td>';

        }
        $text .= '<td><a href = /update?id='.$user['id'].'>редактировать</a></td>';
        $text .= "</tr>";
    }
    $text .= '</table>';
    echo $text;
