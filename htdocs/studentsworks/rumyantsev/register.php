<html>
<head>
<title>Регистрация</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link href="style.css" rel="stylesheet" type="text/css">
<link href="calendar.css" rel="stylesheet" type="text/css">

</head>
<body>

<div id="page">

	<div id="header">
		<h1>Румянцев Алексей Александрович 4192</h1>
	</div>

	<div id="content">
<?php
function generateSalt()
{
    $salt = '';
    $saltLength = 8; //длина соли
    for($i=0; $i<$saltLength; $i++) {
        $salt .= chr(mt_rand(33,126)); //символ из ASCII-table
    }
    return $salt;   }

if ($_POST) //Условие будет выполнено, если произведен POST-запрос к скрипту.
{
$name = trim ($_POST['rname' ]);
$login = trim ($_POST['rlogin' ]);
$password = trim ($_POST['rpass' ]);
$password_r = trim ($_POST['rpass_r' ]);
$email = trim ($_POST['email' ]);
$data = date ('y,n,d' );
echo " <br> данные: $name, $login, $email <br>"

;

$error = false ;//Создаем переменную, контролирующую ошибки регистрации.
$errortext = "<p><b><font color='red'><h3>При регистрации на сайте произошли следующие ошибки:</h3></font></p><ul>"
;
if (empty ($name ))
{
$error = true ;
$errortext .= "<li><font color='red'>Вы не заполнели поле Имя пользователя!</font></li>"
;
} else {
/*if (!preg_match("/^[a-z а-яё]{2,30}$/iu",$name))
{
$error = true;
$errortext .= "<li><font color='red'>Убедитесь что Имя содержит от 2 до 30 символов и не содержит цифр</font></li>";
}*/
}
if (empty ($login ))
{
$error = true ;
$errortext .= "<li><font color='red'>Вы не заполнели поле Логин пользователя!</font></li>"
;
} else {
if (!preg_match ("/^[a-z0-9]{2,20}$/i" ,$login ))
{
$error = true ;
$errortext .= "<li><font color='red'>Убедитесь что Логин содержит от 2 до 20 символов, и состоит из латинских символов и цифр
</font></li>" ;
}
}
if (empty ($password ))
{
$error = true ;
$errortext .= "<li><font color='red'>Вы не заполнили поле Пароль!</font></li>"
;
} else {
if (!preg_match ("/^[a-z0-9]{3,20}$/i" ,$password ))
{
$error = true ;
$errortext .= "<li><font color='red'>Убедитесь что Пароль содержит от 3 до 20 символов, и состоит из латинских символов и ци
фр</font></li>" ;
}
}
if (empty ($password_r ))
{
$error = true ;
$errortext .= "<li><font color='red'>Вы не заполнили поле Подтверждение пароля!</font></li>"
;
} else {
if ($password != $password_r )
{
$error = true ;
$errortext .= "<li><font color='red'>Поле Пароль и его Подтверждение не совпадают!</font></li>"
;
}
}
if (empty ($email ))
{
$error = true ;
$errortext .= "<li><font color='red'>Вы не заполнили поле E-Mail</font></li>"
;
} else {
if (!preg_match ("/^[-0-9a-z_\.]+@[-0-9a-z^\.]+\.[a-z]{2,4}$/i" ,$email ))
{
$error = true ;
$errortext .= "<li><font color='red'>Не правильно заполнено поле E-Mail. E-mail должен иметь вид user@somehost.com</font></li
>" ;
}
}
$errortext .= "</ul></b>" ;
if ($error )
{
echo ($errortext );//Выводим текст ошибок.
} else {
//Подключаемся к базе данных.
$dbcon = mysql_connect ("in-education.ru" , "aleksey" , "hevzywtd" );
//$dbcon = mysql_connect ("localhost" , "root" , "12345" );
if (!$dbcon )
{
echo "<p>Произошла ошибка при подсоединении к MySQL!</p>"
.mysql_error (); exit ();
} else {
if (!mysql_select_db ("aleksey" , $dbcon ))
{
echo ("<p>Выбранной базы данных не существует!</p>"
);
}
}
// проверка на существование пользователя с таким же логином.
$result = mysql_query ("SELECT id FROM registered_users WHERE login='$login'"
,$dbcon );
$myrow = mysql_fetch_array ($result );
if (!empty ($myrow ["id" ])) {
echo "Извините, введённый вами логин уже зарегистрирован.<a href='forma_reg.php'> Введите другой логин</a>.";
}
else {
    $salt = generateSalt();
//Выполняем SQL-запрос записывающий данные пользователя в таблицу.$salt = generateSalt();
    $passwordSalt = $password . $salt;
    echo $passwordSalt;
    $sql = mysql_query("INSERT INTO registered_users (imia,login,paroli,email,data,salt) 
Values ('$name','$login', '" . md5($passwordSalt) . "','$email','$data','$salt')", $dbcon);
    if (!$sql) {
        echo "Запрос не прошел. Попробуйте еще раз.";
        echo mysql_errno() . ": " . mysql_error() . "\n";
    }
    if ($sql) {
//Выводим сообщение об успешной регистрации.
//exit ('<div align="center"><br/><br/><br/>
        echo "<h3> Вы успешно зарегистрированы на сайте! Можете добавить еще 1 пользователя</h3>";
    }
    mysql_close($dbcon);//Закрываем соединение MySQL.
}
}
}
if (($_POST && $error ) || !$_POST)
{
}
?>
</div>

	<div id="menu">

		<h3>
            <p><a href="calc.php">Калькулятор</a></p>
            <p><a href="upload.html">Загрузка файлов</a></p>
            <p><a href="formRegistration.php">Регистрация</a></p>
            <p><a href="selectAllFromDB.php">Все пользователи</a></p>
            <p><a href="ajax.php">AJAX</a></p>
            <p><a href="usersVK.php">Пользователи ВК</a></p>
            <p><a href="usersMySQL.php">Пользователи ВК (MySQL)</a></p>
            <p><a href="usersJQuery.php">Пользователи ВК (JQuery)</a></p>
            <p><a href="mail.html">Обратная связь</a></p>
            <p><a href="game.html">Игра</a></p>
		</h3>

	</div>

	<div id="partners">
		<h1>Партнеры проекта</h1>
	</div>


    <div id="block1">
        <img src="download/1.jpg" alt="КНИТУ-КАИ">

    </div>
    <div id="block2">
        <img src="download/2.jpg" alt="google">

        </div>
			
	<div>
	<table id="calendar2">
	  <thead>
		<tr><td>‹<td colspan="5"><td>›
		<tr><td>Пн<td>Вт<td>Ср<td>Чт<td>Пт<td>Сб<td>Вс
	  <tbody>
	</table>
	<script>
function Calendar2(id, year, month) {
var Dlast = new Date(year,month+1,0).getDate(),
    D = new Date(year,month,Dlast),
    DNlast = new Date(D.getFullYear(),D.getMonth(),Dlast).getDay(),
    DNfirst = new Date(D.getFullYear(),D.getMonth(),1).getDay(),
    calendar = '<tr>',
    month=["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"];
if (DNfirst != 0) {
  for(var  i = 1; i < DNfirst; i++) calendar += '<td>';
}else{
  for(var  i = 0; i < 6; i++) calendar += '<td>';
}
for(var  i = 1; i <= Dlast; i++) {
  if (i == new Date().getDate() && D.getFullYear() == new Date().getFullYear() && D.getMonth() == new Date().getMonth()) {
    calendar += '<td class="today">' + i;
  }else{
    calendar += '<td>' + i;
  }
  if (new Date(D.getFullYear(),D.getMonth(),i).getDay() == 0) {
    calendar += '<tr>';
  }
}
for(var  i = DNlast; i < 7; i++) calendar += '<td>&nbsp;';
document.querySelector('#'+id+' tbody').innerHTML = calendar;
document.querySelector('#'+id+' thead td:nth-child(2)').innerHTML = month[D.getMonth()] +' '+ D.getFullYear();
document.querySelector('#'+id+' thead td:nth-child(2)').dataset.month = D.getMonth();
document.querySelector('#'+id+' thead td:nth-child(2)').dataset.year = D.getFullYear();
if (document.querySelectorAll('#'+id+' tbody tr').length < 6) {  // чтобы при перелистывании месяцев не "подпрыгивала" вся страница, добавляется ряд пустых клеток. Итог: всегда 6 строк для цифр
    document.querySelector('#'+id+' tbody').innerHTML += '<tr><td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;';
}
}
Calendar2("calendar2", new Date().getFullYear(), new Date().getMonth());
// переключатель минус месяц
document.querySelector('#calendar2 thead tr:nth-child(1) td:nth-child(1)').onclick = function() {
  Calendar2("calendar2", document.querySelector('#calendar2 thead td:nth-child(2)').dataset.year, parseFloat(document.querySelector('#calendar2 thead td:nth-child(2)').dataset.month)-1);
}
// переключатель плюс месяц
document.querySelector('#calendar2 thead tr:nth-child(1) td:nth-child(3)').onclick = function() {
  Calendar2("calendar2", document.querySelector('#calendar2 thead td:nth-child(2)').dataset.year, parseFloat(document.querySelector('#calendar2 thead td:nth-child(2)').dataset.month)+1);
}
</script>
	</div>
</div>

</body>

</html>
