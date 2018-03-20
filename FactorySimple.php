<?php
/* PHP 手册
class SimpleFactory {
	public static function factory($type) {
		if (include_once 'Drivers/' . $type . '.php') {
			$classname = 'Driver_' . $type;
			return new $classname;
		} else {
			throw new Exception("Driver {$type} not found");
		}
	}
}

$mysql = SimpleFactory::factory('MySQL');
$sqlite = SimpleFacotry::facory('SQLite');
 */

/**
 * 产品
 */
interface Product {
	public function operation();
}

class ConcreteProductA implements Product {
	public function operation() {
		echo "ConcreteProductA operation \n";
	}
}

class ConcreteProductB implements Product {
	public function operation() {
		echo "ConcreteProductB operation \n";
	}
}

/**
 * 工厂
 */
interface Creator {
	public function createProduct($className);
}

class ConcreteCreator implements Creator {
	public function createProduct($className) {
		if (class_exists($className)) {
			return new $className;
		} else {
			throw new Exception("class not found");
		}

	}
}

class Client {
	public static function main() {
		$productA = (new ConcreteCreator())->createProduct('ConcreteProductA');
		$productA->operation();
	}
}

Client::main();