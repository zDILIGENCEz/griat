<html>
<head>
<title>Пользователи ВК (JQuery)</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link href="style.css" rel="stylesheet" type="text/css">
<link href="calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>

</head>
<body>

<div id="page">

	<div id="header">
		<h1>Румянцев Алексей Александрович 4192</h1>
	</div>
	<div id="content">
		<?php
		include 'inc/db.php';

		// Получаем первые 10 статей, которые будут видны изначально
		$res = mysqli_query($conn, "SELECT * FROM usersMySQL ORDER BY id DESC LIMIT 10");

/*		if ($res->num_rows > 0) {
		// output data of each row
			while($row = $res->fetch_assoc()) {
				echo "id: " . $row["id"]. " - ФИО: " . $row["name"]. " " . $row["surname"]. "<br>"; }
		}
		else
		{
			echo "0 results";
		}																								*/
		
		// Формируем массив из 10 статей
		$articles = array();
		while($row = mysqli_fetch_assoc($res))
		{
			$articles[] = $row;
		}
		?>
		<div style="width: 200px;" id="articles">
			<table>
			<?php foreach ($articles as $article): ?>
				<tr>
				<?php echo "<td>".$article['name']."</td>"; ?>
				<?php echo "<td>".$article['surname']."</td>"; ?>
				<?php
					if($article['gender']==1)
						echo "<td>"."Ж"."</td>";
					else
						echo "<td>"."М"."</td>"; ?>
				<?php echo "<td>".$article['city_string']."</td>"; ?>
				</tr>
				<tr>
				<?php echo "<td><img src=".$article['image_path']."></td>"; ?>
				</tr>
			<?php endforeach; ?>
			</table>
		</div>
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

</body>

</html>


<?php
include 'inc/db.php';

// Получаем первые 10 статей, которые будут видны изначально
$res = mysqli_query($db, "SELECT * FROM usersMySQL ORDER BY id DESC LIMIT 10");

// Формируем массив из 10 статей
$articles = array();
while($row = mysqli_fetch_assoc($res))
{
    $articles[] = $row;
}
?>


<div style="width: 200px;" id="articles">

    <?php foreach ($articles as $article): ?>
        <p><b><?php echo $article['title']; ?></b><br />
        <?php echo $article['text']; ?></p>
    <?php endforeach; ?>

</div>
<button id="more">Дальше</button>

</body>
</html>
