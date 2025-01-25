<?php
/*
*    Синглетон для хранения главной конфигурации сайта
*
*/

namespace test\app\controllers;


class baseController 
{
	public static $instance;  //реализуем синглетон
	private $model_config;
	private $view_config;
	private $main_config;
	
	private function __construct(){ 
		
		//читаем файл конфигурации в массив
		$raw_config_string =file_get_contents('app_config.txt', true);
		$tmp_pair_config_arr = explode(';', preg_replace('/(\s+)/', '',$raw_config_string));
		array_pop($tmp_pair_config_arr);
		
		foreach($tmp_pair_config_arr as $tmp){
			if(isset($config_pair)) unset($config_pair);
			$config_pair = explode('=', $tmp);
			$tmp_config[$config_pair[0]] = $config_pair[1]; 
		}
		
		//настройки БД
		$this->model_config['CONNECTION_TYPE'] = $tmp_config['DB_TYPE'];
		$this->model_config['HOST'] = $tmp_config['DB_HOST'];
		$this->model_config['PORT'] = $tmp_config['DB_PORT'];
		$this->model_config['USER'] = $tmp_config['DB_USER'];
		$this->model_config['PASSWORD'] = $tmp_config['DB_PASSWORD'];
		$this->model_config['DB'] = $tmp_config['DB'];
		$this->model_config['SHEMA'] = $tmp_config['DB_SCHEMA'];
		
		//настройки вида
		$this->view_config['MAIN_PAGE_STYLE'] = $tmp_config['PAGE_STYLE'];
		
		//общие настройки
		$this->main_config['APP_NAME'] = $tmp_config['APP_NAME'];
		$this->main_config['PATH_TO_ERROR_PAGE'] = $tmp_config['PATH_TO_ERROR_PAGE'];
		$this->main_config['PATH_TO_FRONT_AJAX_CONTROLLER'] = $tmp_config['PATH_TO_FRONT_AJAX_CONTROLLER'];
		$this->main_config['PATH_TO_JS_SCRIPT'] = $tmp_config['PATH_TO_JS_SCRIPT'];
		$this->main_config['PATH_TO_MAIN_STYLE'] = $tmp_config['PATH_TO_MAIN_STYLE'];
				
		} 
	
	public function getInstance(){  //реализуем синглетон
		
		if(empty(self::$instance)){
		
			self::$instance = new baseController();
		}
		
			return self::$instance;
	}

    //методы для получения настроек
    public function getModelConfig(){
		
		return $this->model_config;
	}
	
	public function getViewConfig(){
		
		return $this->view_config;
	}
	
	public function getMainConfig(){
		
		return $this->main_config;
	}
		
		
}
?>