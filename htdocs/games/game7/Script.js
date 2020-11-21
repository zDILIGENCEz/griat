function calculateAnswer() {
var num1=document.calculator.number1.value;
var num2=document.calculator.number2.value;
var operator=document.calculator.operator.value;
var result=0;

 switch(operator) {
 
  case '+': { var result=Number(num1)+Number(num2); break;} 
  case '-': { var result=Number(num1)-Number(num2); break;}
  case '*': { var result=Number(num1)*Number(num2); break;}
  case '/': { var result=Number(num1)/Number(num2); break;}   
  if()
  defaut: alert ("Вы умственно-отсталый");
  };
  
  document.getElementById('res').innerHTML='результат='+result;
  
 
 
 
 
 
 
 }