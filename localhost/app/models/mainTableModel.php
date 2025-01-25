<?php
/*
*    Модель для работы с таблицами
*
*/

namespace test\app\models;

use test\app\modelsbaseModel;


class mainTableModel extends baseModel
{
	public function __construct($main_config, $model_config){
		
		parent::__construct($main_config, $model_config);
	}
	
	public function getMainTable1($parameters, $isAjax = false){ //получение данных для первой таблицы 
	
        $query_string = "select 
                         t1.brand, 
                         t.model, t.production_end
                         from AUTO_MODEL t
                         left join AUTO_BRAND t1 on (t1.id = t.brand_id)
                         where t.production_end < :p_borderDate 
			 group by t1.brand, t.model, t.production_end
			 order by case when :p_sort_switch_on then t.body_id else t.id end ";
		 
		 //замечание -- здесь не ставлю блок try т.к. проверка на ошибки идет в родительском классе
		 if($isAjax){
			 
			    return parent::extract_from_db_PDO($query_string, 'utf8', $parameters, true);	
		 }else{
			    return parent::extract_from_db_PDO($query_string, 'utf8', $parameters);
		 }
	}
	
	public function getMainTable2($parameters, $isAjax = false){ //получение данных для второй таблицы 
		
        $query_string = "select 
                         t1.brand, t.model, t2.service_name, t2.price
                         from AUTO_MODEL t
                         left join AUTO_BRAND t1 on (t1.id = t.brand_id)
                         cross join AUTO_SERVICE t2
                         where t.production_end is null
                         and price > :p_price 
			 group by t1.brand, t.model, t2.service_name, t2.price
			 order by case when :p_sort_switch_on then t.body_id else t.id end";
		 
		 //замечание -- здесь не ставлю блок try т.к. проверка на ошибки идет в родительском классе
		 if($isAjax){
			 
			    return parent::extract_from_db_PDO($query_string, 'utf8', $parameters, true);	
		 }else{
			    return parent::extract_from_db_PDO($query_string, 'utf8', $parameters);
		 }
	}
	

	
	
}
?>
