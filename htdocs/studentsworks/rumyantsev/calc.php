
<html>
<head>
<title>Калькулятор</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link href="style.css" rel="stylesheet" type="text/css">
<link href="calendar.css" rel="stylesheet" type="text/css">

</head>
<body>

<script>
function randomInteger(obj, min, max) {
  var rand = min + Math.random() * (max - min)
  rand = Math.round(rand);
  if(obj.id == 'button1')
	document.calculator.number1.value = rand;
  else if(obj.id == 'button2')
	document.calculator.number2.value = rand;
}
</script>

<div id="page">

	<div id="header">
		<h1>Румянцев Алексей Александрович 4192</h1>
	</div>
	<div id="content">Калькулятор на PHP
    
    <?php	

	function clearData($data, $type='i'){

	    switch($type){
	        case 'i': return $data*1; break;

	        case 's': return trim(strip_tags($data)); break;

	    }
	}
	

	$output = '';

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

	    $number1 = clearData($_POST['number1']);

	    $number2 = clearData($_POST['number2']);
	    $operator = clearData($_POST['operator'], 's');

	    $output = "$number1 $operator $number2 = ";

	    switch($operator){

	        case '+': $output .= $number1 + $number2; break;

	        case '-': $output .= $number1 - $number2; break;

	        case '*': $output .= $number1 * $number2; break;
	        case '/':

	            if($number2 == 0)

	                $output = 'Неизвестная операция!';

	            else

	                $output .= $number1 / $number2;

	            break;

	        default: $output = "Неизвестное '$operator'";

	    }

	    $verify=true;

	    if ($verify == 'true')
 
		{
			echo "<p>Выражение посчитано";
		}

	}

	?>	

	

	<form name="calculator" action="<?=$_SERVER['PHP_SELF']?>" method="POST">

	число 1:<br />	<input type="text" name="number1" value=""> 
    <input type="button" id="button1" value="Сгенерировать" onClick="randomInteger(this, 1, 300);">
    <br />

	операция: <br />

	<input type="text" name="operator"><br />

	число 2:<br />	<input type="text" name="number2"  value="">
	<input type="button" id="button2" value="Сгенерировать" onClick="randomInteger(this, 1, 300);">
	<br />

	<input type="submit" value="Посчитать!">

	</form>

	<?php

	if($output){

	    echo $output;

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


</body>

</html>
