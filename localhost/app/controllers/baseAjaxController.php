<?php
/*
*    Фронт контроллер для аякс
*    (если нужно расширить функционал, то в этом контроллере останутся только создание объектов дочерних контроллеров аякс, реализующих функционал)
*    сейчас для упрощения весь функционал размещен здесь
*/


namespace test\app\controllers;


use test\app\controllers\baseController;
use test\app\models\mainTableModel;


class baseAjaxController
{
	private $data_model;
	
	public function __construct(){ 
				
		$configurator = baseController::getInstance(); 
		$this->data_model = new mainTableModel($configurator->getMainConfig(), $configurator->getModelConfig());
	}
	
	
	public function serve(){
		
		//выбираем действие и выполняем его
		$controller_action = htmlspecialchars( $_POST['asck_for_action'] );
		
		switch($controller_action)
		{
			case "sort_query1": $result = $this->data_model -> getMainTable1(['p_borderDate'=>'01.10.2018', 'p_sort_switch_on'=>true], true); break;					
			case "sort_query2": $result = $this->data_model -> getMainTable2(['p_price'=>1000, 'p_sort_switch_on'=> true ], true); break;	
			default: echo json_encode(['response'=>'err']); exit; break;
		}
		
		echo json_encode(['response'=>'', 'data'=>$result]);	
	}
	
	
}

?>