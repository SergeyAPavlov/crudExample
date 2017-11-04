<h3>Список пользователей</h3>

<form name="form_id" method="post" action="">
    <table class="table">
        <tr>
            <td>id</td>
            <td>логин</td>
            <td></td>
            <td>ФИО</td>
            <td>email</td>
            <td>Роль</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="checkbox" name="clogin" <?= (!empty($form['clogin']) ? 'checked' : '') ?>></td>
            <td>&nbsp;</td>
            <td><input type="checkbox" name="cfio" <?= (!empty($form['cfio']) ? 'checked' : '') ?>></td>
            <td>&nbsp;</td>
            <td><input type="checkbox" name="crights" <?= (!empty($form['crights']) ? 'checked' : '') ?>></td>
            <td><b>&lt;=</b> Сортировать по полю</td>
            <td rowspan="2"><input type="submit" name="Submit" value="Submit"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input name="login" type="text" size="32"
                       value="<?= $form['login'] ?>"></td>
            <td>&nbsp;</td>
            <td><input name="fio" type="text" size="64"
                       value="<?= $form['fio'] ?>"></td>
            <td>&nbsp;</td>
            <td><input name="rights" type="text" size="4"
                       value="<?= $form['rights'] ?>"></td>
            <td><b>&lt;=</b> Фильтровать по полю</td>

        </tr>
        <tr>
            <?php

            foreach ($table as $user){
            foreach ($user as $name => $field) {
                ?>
                <td><? if ($name != 'password') echo $field ?></td>
                <?php

            }
            ?>
            <td>
            </td>
            <td>
                <?php
                if ($user['login'] == $applogin) echo '<a href = /update?id=' . $user['id'] . '>редактировать</a>';
                else echo '<a href = /read?id=' . $user['id'] . '>просмотреть</a>';
                ?>
            </td>
        </tr><?php
        }
        ?>
    </table>
</form>
