<html>
<head>
<title>Разработка Web систем</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link href="style.css" rel="stylesheet" type="text/css">
<link href="calendar.css" rel="stylesheet" type="text/css">

</head>
<body>

<div id="page">

	<div id="header" style="background:#449B39; width:800px; height:100px; margin-bottom:15px;">
		<h1>Румянцев Алексей Александрович 4192</h1>
        <?php
            $dbcon = mysql_connect ("in-education.ru" , "aleksey" , "hevzywtd" );
            if (!$dbcon) {
                echo "<p>Произошла ошибка при подсоединении к MySQL!</p>"
                    . mysql_error();
                exit ();
            } else {
                if (!mysql_select_db("aleksey", $dbcon)) {
                    echo("<p>Выбранной базы данных не существует!</p>"
                    );
                }
            }
            session_start();
        //    unset($_SESSION['user']);
        //    echo "SESSION: ".$_SESSION['user']."<br>";
            if ( !empty($_COOKIE['login']) and !empty($_COOKIE['key']) )
            {
                $login = $_COOKIE['login'];
                $key = $_COOKIE['key']; //ключ из кук (аналог пароля, в базе поле cookie)
            //    echo "Cookie: ".$login." Key: ".$key."<br>";

            //    echo "SELECT * FROM registered_users WHERE login='$login' AND cookie='$key'"."<br>";
                $result = mysql_query("SELECT id FROM registered_users WHERE login='$login' AND cookie='$key'", $dbcon);
                $myrow = mysql_fetch_array($result);
                if (!empty ($myrow ["id"]))
                {
                    $_SESSION['user']=$myrow ["id"];
                }
                else
                {
                    echo "Cookie incorrect"."<br>";
                }
            }
            if(isset($_SESSION['user'])) {
                $userId=$_SESSION['user'];
                // проверка на существование пользователя с таким же логином.
                $result = mysql_query("SELECT login FROM registered_users WHERE id='$userId'", $dbcon);
                $myrow = mysql_fetch_array($result);
                if (!empty ($myrow ["login"])) { echo "Привет ".$myrow ["login"]."!"; }
            ?>
            <form action = "login.php" method = "post">
                <input type="submit" name="logout_button" id="logout_button" value="Выход"/>
            </form>
        <?php }
            else {
        ?>

        <form id="login" name="login" method="post" action="login.php">
            <b>Логин:</b> <input type="text" name="rlogin" id="rlogin">
            <b>Пароль:</b> <input type="password" name="rpass" id="rpass">
            <input type="submit" name="login_button" id="login_button" value="Вход"/>
            <input name="checkBox" type="checkbox"> Запомнить <br>
        </form>
        <?php } ?>
	</div>
	<div id="content">Только на нашем сайте вы найдете большой ассортимент различных товаров!	</div>

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

</body>

</html>
