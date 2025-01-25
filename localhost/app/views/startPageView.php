<?php
/*
*    Дочерний класс, для отрисовки нашей страницы
*/

namespace test\app\views;

use test\app\views\baseView;


class startPageView extends baseView
{
	
	public function __construct($main_config, $view_config){
		
		parent::__construct($main_config, $view_config);
		
		
	}	
	

	//отображение служебных элементов
	public function getAjaxControllerPath(){
		return $this->main_config['PATH_TO_FRONT_AJAX_CONTROLLER'];
	}
	
	public function getJSPath(){
		return $this->main_config['PATH_TO_JS_SCRIPT'];
	}
	
	public function getMainStylePath(){
		return $this->main_config['PATH_TO_MAIN_STYLE'];
	}
		
	public function getAppName(){
		return $this->main_config['APP_NAME'];
	}


	//отображение UI
	public function renderWelcomeBlock(){
		printf('<div id="welcome"><h2>Тестовое задание AMS_Software</h2></div>');
	}
	
	public function renderMainTableSortButton($id, $mainstyle, $size, $value){
		printf('<div><input id="%s" type="button" class="btn %s %s" value="%s" /></div>', $id, $mainstyle, $size, $value);
	}
	
	
	
	//отображение таблиц
	private function addTableTranslatedHeaders($tableData){ //служебная функция для добавления заголовков на русском
		
		if(!empty($tableData)){
			
			$translationMatrix = [
			                 'brand' => 'Марка',
							 'model' => 'Модель',
							 'production_end' => 'Дата снятия с производства',
							 'service_name' => 'Наименование работ',
							 'price' => 'Цена'
			];
			
			foreach($tableData[0] as $key => $val){
				
				if(array_key_exists($key, $translationMatrix) ){
					
					$headers[$key] = $translationMatrix[$key];
				}
				
			}unset($key); unset($val);
			
			array_unshift($tableData, $headers);	
		}
		
		return $tableData;
	}
	
	
	public function renderTable($id, $tableHeader, $tableData){ //отрисовка таблиц
		
		if(empty($tableData)){
			
			printf('<div><h3>Даннных нет</h3></div>');
			
		}else{
			
			$tableData = $this->addTableTranslatedHeaders($tableData);
		
			printf('<div>
					<table id="%s" class="table table-success table-striped table-bordered border-light caption-top">
					<caption>%s</caption>
					', $id, $tableHeader);
			
							foreach($tableData as $key => $val){
							    
								if($key == 0 ) {
									
									printf('<thead class="table-light">'); 
									
								}else{
									
									if(!isset($tb)) printf('<tbody>'); $tb = 1;
								}
								
								printf('<tr>');
								
								foreach($val as $k => $v){
										
									if($key == 0) {
										
										printf('<th id="%s">%s</th>',$k, $v);
										
									}else{
										
										printf('<td>%s</td>',$v);
									}
									
										
								}unset($k); unset($v);
								
								printf('</tr>');
							
							    
								if(key($tableData) == 0 ) {
									
									printf('</thead>'); 
								}
								
							}unset($key); unset($val);			
										
			printf('</tbody></table></div>');
		}
	}
	
	
	//отображение сообщений
	public function renderMessageBox(){
		printf('<div id="messageBox" class="hide"><div><h3>Внимание!</h3><p></p></div></div>');
	}
	
}
?>