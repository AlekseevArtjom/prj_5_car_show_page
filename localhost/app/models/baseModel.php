<?php
/*
*   Родительский класс модели, реализующий общие функции
*
*/

namespace test\app\models;


class baseModel
{
	protected $connection_PDO;
	protected $path_to_error_page;


	public function __construct($main_config, $model_config){
		
		if(!empty($model_config) && !empty($main_config)){
			
			if(isset($main_config['PATH_TO_ERROR_PAGE'])) $this->path_to_error_page = $main_config['PATH_TO_ERROR_PAGE'];
			
			if($model_config['CONNECTION_TYPE'] == 'postgresql'){ 
					$connection_string = 'pgsql:host='.$model_config['HOST'].'; dbname='.$model_config['DB'].'; port='.$model_config['PORT'];
			}
			else if($model_config['CONNECTION_TYPE'] == 'mysql'){ 
					$connection_string = 'mysql:host='.$model_config['HOST'].'; dbname='.$model_config['DB'].'; charset=utf8';
			}
			else echo 'Connection type error: This connection type is not supported!';
		}
		

		try{
			$this->connection_PDO= new \PDO($connection_string, $model_config['USER'], $model_config['PASSWORD']);
	       }
			catch(\PDOException $e) {
									echo "Database connection error: can not set connection to database!";exit;
								   }	
	}
	
	
	//обработчик ошибок ответа БД  
	protected function handle_error($system_message="", $user_message="") {			
		
		$system_message_sequred=htmlspecialchars($system_message);
		$user_message_sequred=htmlspecialchars($user_message);
		
		
		if(isset($this->path_to_error_page)){	
			
			$path_error=$this->path_to_error_page."?system_message={$system_message_sequred}&user_message={$user_message_sequred}"; 
			header("location: $path_error"); exit;
		
		}else{
			
			echo '</br>System error: '.$system_message_sequred;
			echo '</br>User error: '.$user_message_sequred;
			exit;
		}
	}
	
	
	//выполнение запроса к БД 
	protected function extract_from_db_PDO($query_string=NULL, $coding='utf8', $query_params=[], $isAjax = false){
		
		if($this->connection_PDO==NULL){
			if($isAjax){
				
				echo "CONNECTION NOT CREATED";exit;
				
			}else{ $this->handle_error(NULL, "CONNECTION NOT CREATED"); }
		}
		else if($this->connetction_type == 'mysql'){ $this->connection_PDO ->exec('SET NAMES '.$coding); }		

		if($query_string!=='' && $query_string!==NULL){	
			$current_query=$this->connection_PDO ->prepare($query_string); 
				
			if(empty($query_params)){
				$result=$current_query ->execute();
			}	
			else{ $result=$current_query ->execute($query_params); }
					
			if($result==false){
				if($isAjax){
			
						echo "DATABASE OPERATION FAIL";exit;
				
				}else { $this->handle_error(NULL, "DATABASE OPERATION FAIL");  }
			}	
			else{ $result=$current_query ->fetchAll(\PDO::FETCH_ASSOC); }	

			$request_masiv=explode(' ', $query_string);  
			$request_first_word=strtoupper($request_masiv[0]); 
			
			if($request_first_word==="INSERT"){ 
				return $this->connection_PDO  ->lastInsertId();
			}
			else {
				if(!empty($result)){ 
						return $result;
				}
				else return null;
			}

		} 
		else return NULL;	
	}

	
}
?>