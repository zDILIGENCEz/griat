<html>
<head>
<title>Пользователи ВК</title>

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
$json1 = file_get_contents("download/groups.getMembers");
$json2 = file_get_contents("download/database.getCities");

//echo $json;

//var_dump(json_decode($json),true);


$obj1 = json_decode($json1);
$obj2 = json_decode($json2);

//echo $obj->response->users[0]->last_name;
$k=0;
$page_size=3;

$page=trim ($_GET['page' ]);
if($page==NULL) $page=0;
echo "<p>"."Страница ".$page."</p>";
?> <table> <?php

$count=$obj1->response->count;
for($i=$page_size*$page; $i < $page_size*($page+1); $i=$i+1){
//	echo $i." ";
	if($obj1->response->users[$i]->deactivated == "banned")
		continue;
	?> <tr> <?php
    $surname = $obj1->response->users[$i]->last_name;
    $name = $obj1->response->users[$i]->first_name;
	$gender = $obj1->response->users[$i]->sex;
	$city = $obj1->response->users[$i]->city;
	
    echo "<td>".$name."</td>";
	echo "<td>".$surname."</td>";
	if($gender==1)
		echo "<td>"."Ж"."</td>";
	else
		echo "<td>"."М"."</td>";
	
	foreach($obj2->response as $city2) {
		if($city2->cid == $city)
		{
			$city_string = $city2->title;
		}
	}
	
	echo "<td>".$city_string."</td>";
	
	?> </tr> <?php
	
	$image_path=$obj1->response->users[$i]->photo_50;

	
	?> <tr> <?php
	echo "<td><img src=".$image_path."></td>";
	
	?> </tr> <?php
}

?>
<tr><td><p>
<?php if($page>0) ?>
<a href="usersVK.php?page=<?php echo ($page-1); ?>">Предыдущая</a>



<?php if($page_size*$page<$count) ?>
<a href="usersVK.php?page=<?php echo ($page+1); ?>">Следующая</a>

</p></td></tr>
<?php
/*foreach($obj1->response->users as $user){
//      var_dump ($user);
	if($user->deactivated == "banned")
		continue;
	?> <tr> <?php
    $surname = $user->last_name;
    $name = $user->first_name;
	$gender = $user->sex;
	$city = $user->city;
	
    echo "<td>".$name."</td>";
	echo "<td>".$surname."</td>";
	if($gender==1)
		echo "<td>"."Ж"."</td>";
	else
		echo "<td>"."М"."</td>";
	
	foreach($obj2->response as $city2) {
		if($city2->cid == $city)
		{
		//	echo "<td>"."id1=".$city2->cid."id2=".$city."</td>";
			$city_string = $city2->title;
		}
	}
	
//	$city_string = array_filter($obj2['response'], function($response) {
//		return $response['cid'] == $city;
//	});
		
//	echo "<td>".$city."</td>";
	echo "<td>".$city_string."</td>";
	
	?> </tr> <?php
	
	$image_path=$user->photo_50;

	
	?> <tr> <?php
	echo "<td><img src=".$image_path."></td>";
	
	?> </tr> <?php
	
	
    $k++;
    if ($k==10) break;
}	*/
?> </table> <?php

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
