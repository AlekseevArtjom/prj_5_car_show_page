<?php
/*
*    Класс запускающий приложение
*/

namespace test\app;

use test\app\controllers\startPageController;

class appClass
{
	
	public function __construct(){}
	
	public function run(){

		$controller = new startPageController();
		$controller->makeMainPage();
	}
	
		
	
		
}
?>