function calculateAnswer() {
	var m = document.calculator.m.value;
	var h = document.calculator.h.value;
	var sum = 0;
	sum = m / (h*0.01 * h *0.01);
	document.getElementById('res').innerHTML = 'Ваш ИМТ: ' + sum;
}