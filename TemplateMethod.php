<?php
/**
 * 模板方法模式
 */

/**
 * 抽象模板角色
 * 定义抽象方法作为基本的组成部分，由子类实现
 * 定义模板方法作为组装基本方法
 * 注：抽象模板中的基本方法尽量设计为protected类型，符合迪米特法则
 */
abstract class AbstractClass {
	/**
	 * 模板方法
	 */
	public function templateMethod() {
		echo "templateMethod begin... \n";
		$this->operation1();
		$this->operation2();
		echo "templateMethod end...\n";

	}

	//基本方法1
	abstract protected function operation1();
	//基本方法2
	abstract protected function operation2();
}

/**
 * 具体类
 */
class ConcreteClass extends AbstractClass {
	protected function operation1() {
		echo "in operation1...\n";
	}
	protected function operation2() {
		echo "in operation2... \n";
	}
}

class Client {
	//main program
	public static function main() {
		$class = new ConcreteClass;
		$class->templateMethod();
	}
}

Client::main();