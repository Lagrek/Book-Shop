function request() { // функция отправки и приема данных (ajax)
var formData = new FormData(document.forms.requestname);
console.dir(formData); // что там отправляем то?
var xhr = new XMLHttpRequest(); //создаем объект
xhr.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) { //проверяем ответ на ошибки
// если норм то выводим
document.getElementById("result_output").innerHTML = this.responseText;
console.log("Loaded");
}
else
{
// если нет сообщаем об ошибке
document.getElementById("result_output").innerHTML = "Error";
}
};
xhr.open("POST", "/index.php"); // post запрос на конкретный контроллер
xhr.send(formData); //отпраляем данные

}