<?php
/*
*    Контроллер главной страницы
*/


namespace test\app\controllers;


use test\app\controllers\baseController;
use test\app\models\mainTableModel;
use test\app\views\startPageView;

class startPageController 
{
	private $startPageView;
	private $data_model;
	
	public function __construct(){ 
	
		$configurator = baseController::getInstance(); 
		$this->data_model = new mainTableModel($configurator->getMainConfig(), $configurator->getModelConfig());
		$this->startPageView = new startPageView($configurator->getMainConfig(), $configurator->getViewConfig()); 
	}
	

	public function makeMainPage(){
		
		$dataMainTable['query1'] = $this->data_model->getMainTable1(['p_borderDate'=>'01.10.2018', 'p_sort_switch_on'=>false]); 
		$dataMainTable['query2'] = $this->data_model->getMainTable2(['p_price'=>1000, 'p_sort_switch_on'=>false]); 

		require_once('startPageTemplate.html');
	}
		
}














?>