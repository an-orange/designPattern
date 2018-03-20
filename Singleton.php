<?php
class Singleton {

	/**
	 * 静态成员变量 保存全局实例
	 */
	private static $_instance = null;

	/**
	 * 私有话构造方法，保证外界无法直接实例化
	 */
	private function __construct() {

	}

	/**
	 * 静态工厂方法，返还此类的唯一实例
	 */
	public static function getInstance() {
		if (is_null(self::$_instance)) {
			$c = __CLASS__;
			self::$_instance = new $c;
		}
		return self::$_instance;
	}

	/**
	 * 防止用户克隆实例
	 */
	public function __clone() {
		trigger_error('Clone is not allowed.', E_USER_ERROR);
	}

	public function test() {
		echo 'Singleton Test.';
	}

}

/**
 * client
 */
class Client {
	/**
	 * main program
	 */
	public static function main() {
		$instance = Singleton::getInstance();
		$instance->test();
	}
}
Client::main();