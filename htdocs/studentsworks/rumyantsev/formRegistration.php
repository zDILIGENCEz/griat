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
		<br>
	<form id="register_form" name="register_form" method="post" action="register.php">
	<table width="350" height="315" border="1" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFF">
	<tr>
	<td align="right">
	<b>ФИО:</b> <input type="text" name="rname" id="rname" />
	</td>
	</tr>
	
	<tr>
	<td align="center">
	<b>Укажите город:</b>
	<p><select name="select" size="1">
	<option selected value="s1">Ka3aHb</option>
	<option value="s2">MocKBa</option>
	<option value="s3">Пиmep</option>
	<option value="s4">AcTpaxaHb</option>
	</select>
	</p>
	</td>
	</tr>
	
	<tr>
	<td align="center">
	<input type="radio" name="answer" value="male">M<Br>
	<input type="radio" name="answer" value="female">Ж<Br>
	</td>
	</tr>
	
	<tr>
	<td align="right">
	<b>Логин:</b> <input type="text" name="rlogin" id="rlogin">
	</td>
	</tr>
	
	<tr>
	<td align="right"><b>naponb:</b> <input type="password" name="rpass" id="rpass">
	</td>
	</tr>
	<tr>
	<td align="right"><b>Повторите пароль:</b> <input type="password" name="rpass_r" id="rpass_r" />
	</td>
	</tr>
	<tr>
	
	</td>
	<td align="right"><b>E-Mail:</b> <input type="text" name="email" id="email" /> </td>
	</tr>
	
	<tr>
	<td colspan="2" align="center">
	<input type="reset" value="Очистить"/> <input type="submit" name="reg_button" id="reg_button" value="Гotobo"/>
	</td>
	</tr>
	</table>
	</form>
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
