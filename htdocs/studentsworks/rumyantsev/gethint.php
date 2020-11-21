<?php
// Array with names
/*$a[] = "Anna";
$a[] = "Brittany";
$a[] = "Cinderella";
$a[] = "Diana";
$a[] = "Eva";
$a[] = "Fiona";
$a[] = "Gunda";
$a[] = "Hege";
$a[] = "Inga";
$a[] = "Johanna";
$a[] = "Kitty";
$a[] = "Linda";
$a[] = "Nina";
$a[] = "Ophelia";
$a[] = "Petunia";
$a[] = "Amanda";
$a[] = "Raquel";
$a[] = "Cindy";
$a[] = "Doris";
$a[] = "Eve";
$a[] = "Evita";
$a[] = "Sunniva";
$a[] = "Tove";
$a[] = "Unni";
$a[] = "Violet";
$a[] = "Liza";
$a[] = "Elizabeth";
$a[] = "Ellen";
$a[] = "Wenche";
$a[] = "Vicky";	*/

// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";


$dbcon = mysql_connect ("localhost" , "root" , "12345" );

//mysql_set_charset('utf8', $dbcon);
mysql_select_db ("aleks" , $dbcon );
if (!$dbcon )
{
	echo "<p>Произошла ошибка при подсоединении к MySQL!</p>"
	.mysql_error (); exit ();
} 
else {
	if (!mysql_select_db ("aleks" , $dbcon ))
	{
		echo ("<p>Выбранной базы данных не существует!</p>");
	}
}
// проверка на существование пользователя с таким же логином.
$result = mysql_query ("SELECT login FROM registered_users WHERE login like '$q%'", $dbcon);

if(!$result)
{
	echo "no result"; exit;
}
if(mysql_num_rows($result)==0)
{
	echo "no rows"; exit;
}
	
while($row=mysql_fetch_assoc($result))
{
	$name=$row['login'];
	if ($hint === "") {
		$hint = $name;
	} else {
		$hint .= ", $name";
	}
}
mysql_free_result($result);



// lookup all hints from array if $q is different from ""
/*if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ", $name";
            }
        }
    }
}														*/

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "no suggestion" : $hint;
?> 
