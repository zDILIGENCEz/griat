$(document).ready(function(){

/* Переменная-флаг для отслеживания того, происходит ли в данный момент ajax-запрос. В самом начале даем ей значение false, т.е. запрос не в процессе выполнения */
var inProgress = false;
/* С какой статьи надо делать выборку из базы при ajax-запросе */
var startFrom = 10;

    /* Используйте вариант $('#more').click(function() для того, чтобы дать пользователю возможность управлять процессом, кликая по кнопке "Дальше" под блоком статей (см. файл index.php) */
    $(window).scroll(function() {

        /* Если высота окна + высота прокрутки больше или равны высоте всего документа и ajax-запрос в настоящий момент не выполняется, то запускаем ajax-запрос */
        if($(window).scrollTop() + $(window).height() >= $(document).height() - 200 && !inProgress) {

        $.ajax({
            /* адрес файла-обработчика запроса */
            url: 'obrabotchik.php',
            /* метод отправки данных */
            method: 'POST',
            /* данные, которые мы передаем в файл-обработчик */
            data: {"startFrom" : startFrom},
            /* что нужно сделать до отправки запрса */
            beforeSend: function() {
            /* меняем значение флага на true, т.е. запрос сейчас в процессе выполнения */
            inProgress = true;}
            /* что нужно сделать по факту выполнения запроса */
            }).done(function(data){

            /* Преобразуем результат, пришедший от обработчика - преобразуем json-строку обратно в массив */
            data = jQuery.parseJSON(data);

            /* Если массив не пуст (т.е. статьи там есть) */
            if (data.length > 0) {

            /* Делаем проход по каждому результату, оказвашемуся в массиве,
            где в index попадает индекс текущего элемента массива, а в data - сама статья */
            $.each(data, function(index, data){

            /* Отбираем по идентификатору блок со статьями и дозаполняем его новыми данными */
			var row = "<tr><td>" + data.name + "</td><td>" + data.surname + "</td><td>";
			if(data.gender==1)
				row += "Ж";
			else
				row += "М";
			row += "</td><td>" + data.city_string + "</td></tr><tr><td><img src=" + data.image_path + "></td></tr>";
			$("#articles").append(row);
		
        //    $("#articles").append("<tr><td>" + data.name + "</td><td>" + data.surname + "</td><td>" + data.gender + "</td><td>" + data.city_string + "</td></tr><tr><td><img src=" + data.image_path + "></td></tr>");

			/*	$("#articles").append("<tr><td>" + data.name + "</td><td>" + data.surname + "</td><td>");
			if(data.gender==1)
				$("#articles").append("Ж");
			else
				$("#articles").append("М");
			$("#articles").append("</td><td>" + data.city_string + "</td></tr><tr><td><img src=" + data.image_path + "></td></tr>");	*/
            });

            /* По факту окончания запроса снова меняем значение флага на false */
            inProgress = false;
            // Увеличиваем на 10 порядковый номер статьи, с которой надо начинать выборку из базы
            startFrom += 10;
            }});
        }
    });
});
