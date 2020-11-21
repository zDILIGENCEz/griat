<?php
   if($_FILES["filename"]["size"] > 1024*3*1024)
   {
     echo ("Размер файла превышает три мегабайта");
     exit;
   }
   // Проверяем загружен ли файл
   if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
   {
     // Если файл загружен успешно, перемещаем его
     // из временной директории в конечную
	  echo "File ". $_FILES['filename']['name'] ." uploaded successfully.\n";
     move_uploaded_file($_FILES["filename"]["tmp_name"], "/var/www/html/download/".$_FILES["filename"]["name"]);
	 echo("File loaded!");
   } else {
      echo("Error!");
   }
?>
