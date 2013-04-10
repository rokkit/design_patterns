<?php
class Database {
	protected static $_instance = null;
	protected $_connection = null;
	
	public static function getSingletonInstance() {
		if (empty(static::$_instance)) {
			static::$_instance = new static('','','','');
		}
		return static::$_instance;
	}

	protected $_resource = null;	
	protected function __construct($host, $user, $pass, $db) {
		echo "коннект к БД " . __CLASS__ . "<br/><br/>";
		$this->_connection = rand(1, 10000);
	}
	
	public function select() {
		echo "select database: {$this->_connection}<br/>";
	}
	//
}

class MySQL extends Database {
	protected static $_instance;

	protected function __construct($host, $user, $pass, $db) {
		echo "коннект к БД " . __CLASS__ . "<br/><br/>";
		$this->_connection = rand(1, 10000);
	}

	public function select() {
		echo "select mysql: {$this->_connection}<br/>";
	}
}

$db = Database::getSingletonInstance()->select();
$my = MySQL::getSingletonInstance()->select();


$db = Database::getSingletonInstance()->select();
$my = MySQL::getSingletonInstance()->select();
$db = Database::getSingletonInstance()->select();
$my = MySQL::getSingletonInstance()->select();
$db = Database::getSingletonInstance()->select();
$my = MySQL::getSingletonInstance()->select();
$db = Database::getSingletonInstance()->select();
$my = MySQL::getSingletonInstance()->select();
$db = Database::getSingletonInstance()->select();
$my = MySQL::getSingletonInstance()->select();
$db = Database::getSingletonInstance()->select();
$my = MySQL::getSingletonInstance()->select();








