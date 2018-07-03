<?php
require_once("Config.php");
class DB {
	private static $instance;

	public static function getInstance(){
		if (!isset(self::$instance)) {
			try{
				self::$instance = new PDO("mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASS);
				self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			} catch (PDOException $e) {
				if ($e->getCode() == 2002) {
				 	echo "ERRO: ".$e->getCode()." Connection Error<br>";
				 	//echo "ERRO: ".$e->getLine();
				}else{
					$e->getMessage();	
				} 
			}
		}
		return self::$instance;
	}
 	
	public static function prepare($sql){
		return self::getInstance()->prepare($sql);
	}
}