<?php
function generateSalt()
{
    $salt = '';
    $saltLength = 8; //длина соли
    for($i=0; $i<$saltLength; $i++) {
        $salt .= chr(mt_rand(33,126)); //символ из ASCII-table
    }
    return $salt;   }
if ($_POST)
{
    if(isset($_POST['login_button']))
    {
        // Если форма отправлена
        // Получаем данные из формы
        $login = $_POST['rlogin'];
        $password = $_POST['rpass'];

        // Флаг ошибок
        $errors = false;

        // Валидация полей
        /*    if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }   */

        // Проверяем существует ли пользователь


        $dbcon = mysql_connect("localhost", "root", "12345");
        mysql_select_db("aleks", $dbcon);
        if (!$dbcon) {
            echo "<p>Произошла ошибка при подсоединении к MySQL!</p>"
                . mysql_error();
            exit ();
        } else {
            if (!mysql_select_db("aleks", $dbcon)) {
                echo("<p>Выбранной базы данных не существует!</p>"
                );
            }
        }

        echo "login:" . $login . "<br> pass:" . $password . "<br>";
// проверка на существование пользователя с таким же логином.
        $result = mysql_query("SELECT salt FROM registered_users WHERE login='$login'");

        $myrow = mysql_fetch_array($result);
        if (empty ($myrow ["salt"]))
        {
            echo "Error 1"; exit ();
        }

        $salt=$myrow ["salt"];
        $passwordSalt=$password.$salt;
    //    echo "Password 1: ".$passwordSalt."<br>"."Password 2: ".$myrow["paroli"]."!!!<br>";

        $phpmd5=md5($passwordSalt);

    //    echo "SELECT id FROM registered_users WHERE login=".$login." AND paroli=".$phpmd5."555!!!<br>";
        $result = mysql_query("SELECT id FROM registered_users WHERE login='$login' AND paroli='".md5($passwordSalt)."'", $dbcon);
        $myrow = mysql_fetch_array($result);
        if (!empty ($myrow ["id"])) {
            session_start();
            $_SESSION['user'] = $myrow ["id"];
        //    echo "SESSION: " . $_SESSION['user'] . "<br>";
        //    echo "OK <br>";
            if(isset($_POST['checkBox']))
            {
                echo "Cookie"."<br>";
                $key = generateSalt();
                setcookie('login', $login, time()+60*60*24*30);
                setcookie('key', $key, time()+60*60*24*30);

            //    echo "UPDATE registered_users SET cookie='$key' WHERE login='$login'";
                $result = mysql_query("UPDATE registered_users SET cookie='$key' WHERE login='$login'");
            }
            header("Location: /");
        } else {
            echo "Error 2";
        }
    }
    else if(isset($_POST['logout_button']))
    {
        echo "Logout";
        session_start();
        unset($_SESSION['user']);
        header("Location: /");
        setcookie('login', '', time()); //удаляем логин
        setcookie('key', '', time()); //удаляем ключ
    }
}

?>