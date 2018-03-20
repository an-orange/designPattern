<?php
/**
 * 多个工厂角色的 工厂方法模式
 */

/**
 * 抽象工厂角色
 */
interface Creator {
	public function factoryMethod();
}

/**
 * 具体工厂角色A
 */
class ConcreteCreatorA implements Creator {
	/**
	 * 工厂方法 返回具体产品A
	 */
	public function factoryMethod() {
		return new ConcreteProductA();
	}
}

/**
 * 具体工厂角色B
 */
class ConcreteCreatorB implements Creator {
	/**
	 * 工厂方法  返回具体产品B
	 */
	public function factoryMethod() {
		return new ConcreteProductB();
	}
}

/**
 * 抽象产品角色
 */
interface Product {
	public function operation();
}

/**
 * 具体产品角色A
 */
class ConcreteProductA implements Product {
	/**
	 *  接口方法实现
	 */
	public function operation() {
		echo "ConcreteProductA  operation\n";
	}
}

/**
 * 具体产品角色B
 */
class ConcreteProductB implements Product {
	/**
	 * 接口方法实现
	 */
	public function operation() {
		echo "ConcreteProductB operation. \n";
	}
}

class Client {
	/**
	 * main program
	 */
	public static function main() {
		$productA = (new ConcreteCreatorA())->factoryMethod();
		$productA->operation();

		$productB = (new ConcreteCreatorB())->factoryMethod();
		$productB->operation();
	}
}

Client::main();