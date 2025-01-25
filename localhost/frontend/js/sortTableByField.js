( function(set1, set2, pathToScriptPHPBoxId, targetResponceMessageBoxId) {
/*
*	Модуль для сортировки таблицы по выбранному полю 
*   (можно к одному блоку таблицы подключить несколько подобных модулей для соритровок по разным полям, подключив их слушатели на нужные кнопки
*    можно расширить этот модуль добавив в него еще таблицы для соритровки, просто дописав их функции-обертки типа sortTable1)
*
*   set1, set2 -- объекты, содержащие данные для привязки модуля к парам таблица - "кнопка сортировки"
*    
*	каждый объект set содержит свойства
*        tableId -- id таблицы
*        buttonId -- id кнопки 
*   
*   pathToScriptPHPBoxId -- задает id блока хранящего url скрипта ajax на бэкэнде
*   targetResponceMessageBoxId -- задает id блока для вывода сообщения
*/


//добавляем слушатель на событие нажатие кнопки 
document.querySelector("#"+set1.buttonId+"").onclick=sortTable1;
document.querySelector("#"+set2.buttonId+"").onclick=sortTable2;


//задаем переменные для замыкания
var pathToScriptPHP = document.querySelector("#" + pathToScriptPHPBoxId).innerText;
var targetResponceMessageBox = "#" + targetResponceMessageBoxId;

//подключаем модуль к таблицам через функции-обертки
function sortTable1(){ sortTable(set1.tableId); }
function sortTable2(){ sortTable(set2.tableId); }


//функция сортировки таблицы 
function sortTable(table){
	
	let action = 'sort_' + table;
	
	let form_object= new FormData();
	form_object.append('asck_for_action', action); 
	
	//отправляем запрос
	$.ajax({
			async:  true,
			contentType: false,		
			data: form_object,
			dataType: "text",		
			processData: false,		
			type: "POST",
			url: pathToScriptPHP,	
			success: callbackFunctionShowSortedTable,  	
			error: errorFunction
			});
	
	//функция обратного вызова для обработки данных с бэкэнда
	function callbackFunctionShowSortedTable(data_returned)	
			{
				let resultsMassiv = JSON.parse(data_returned);
				
				if(resultsMassiv.data != undefined){
						
					//инициализация итератоов
					let i = 0, j = -1;
					
					//параматеры массива объектов, полученного с бэка
					let rowNumber = resultsMassiv.data.length, 
					    rowLength = Object.keys(resultsMassiv.data[0]).length;
					
					//изменение данных в таблице
					$("#" + table + " td").each(function(){

						    if(j<rowLength-1) { j=j+1; }
							else j=-1;
							
							if(j==-1) {i=i+1; j=j+1;}
												
							$(this).text(resultsMassiv.data[i][""+$("#" + table + " th")[j].id]);
					});
					
					infoFunction('Данные упорядочены!', 'success');
					
				}else{ infoFunction('Не удалось упорядочить данные!'); }
				
			}
	
	
	
	
	
	
	
//вспомогательные функции для вывода сообщений	
    function displayMessageFunction(){ 
				
		$(targetResponceMessageBox).removeClass('hide').addClass('show');  
		setTimeout(function(){$(targetResponceMessageBox).removeClass('show').addClass('hide')},2000);		
		setTimeout(function(){$(targetResponceMessageBox+" p").css('color','grey'); $(targetResponceMessageBox+ " p").text("");},2010);	
    }
	
	
	function infoFunction(msg, type = 'error'){
		
		let color;
				
		if(type == 'error') color = 'red';
		else if(type == 'success') color = 'green';	
		else color = 'black';
				
		$(targetResponceMessageBox+" p").css('color',color);
		$(targetResponceMessageBox+' p').text(msg);
				
		displayMessageFunction();
	}
	
	
	function errorFunction(){
		
		$(targetResponceMessageBox+" p").css('color','red');
		$(targetResponceMessageBox+' p').text('Ошибка сервера!');
				
		displayMessageFunction();
	}
	
	
}


})({"tableId": "query1", "buttonId": "sortQuery1byBody"}, {"tableId": "query2", "buttonId": "sortQuery2byBody"}, "ajax", "messageBox");

console.log("sort table modul start");