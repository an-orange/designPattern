<?php
/**
 * 建造者模式
 */

/**
 * 抽象产品类
 * 通常是实现了模板方法模式
 */
abstract class Product {
	private $_sequence = array();

	protected abstract function methodA();
	protected abstract function methodB();
	protected abstract function methodC();

	final public function run() {
		foreach ($this->_sequence as $value) {
			$this->$value();
		}
	}

	final public function setSequence($sequence) {
		return array_push($this->_sequence, $sequence);
	}
}

/**
 * 具体产品类
 */
class ConcreteProduct1 extends Product {
	protected function methodA() {
		echo "ConcreteProduct1 methodA... \n";
	}

	protected function methodB() {
		echo "ConcreteProduct1 methodB... \n";
	}

	protected function methodC() {
		echo "ConcreteProduct1 methodC... \n";
	}
}

/**
 * 抽象建造者
 * 规范产品的组建，一般是由子类实现
 */
abstract class Builder {
	//设置构建顺序
	public abstract function setSequence($sequence);
	//产品构建
	public abstract function getResult();
}

/**
 * 具体建造者
 */
class ConcreteBuilder1 extends Builder {
	private $_product;

	public function __construct() {
		$this->_product = new ConcreteProduct1();
	}

	public function setSequence($sequence) {
		$this->_product->setSequence($sequence);
	}

	public function getResult() {
		return $this->_product;
	}
}

/**
 * 导演类
 * 负责安排已有模块的顺序，然后告诉Builder开始建造
 */
class Director {
	public function getConcreteProduct1() {
		$builder = new ConcreteBuilder1;
		$builder->setSequence('methodC');
		$builder->setSequence('methodA');
		$builder->setSequence('methodB');
		return $builder->getResult();
	}
}

class Client {
	public static function main() {
		$director = new Director();
		$director->getConcreteProduct1()->run();
	}
}

Client::main();