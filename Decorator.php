<?php
/**
 * 装饰者模式
 * 动态的给一个对象添加一些额外的职责。
 * 就增加功能来说，Decorator模式比生成子类更为灵活。
 */

/**
 * 抽象构件
 */

interface Component {
	public function operation();
}

/**
 * 具体构件
 */
class ConcreteComponent implements Component {
	// @Override
	public function operation() {
		echo 'in Concrete Component operation', PHP_EOL;
	}
}

/**
 * 装饰角色
 */
abstract class Decorator implements Component {
	protected $_component;

	//通过构造函数传递被修饰者
	public function __construct (Component $component) {
		$this->_component = $component;
	}
	//委托给被修饰者执行
	// @Override
	public function operation () {
		$this->_component->operation();
	}
}

/**
 * 具体装饰类A
 */
class ConcreteDecoratorA extends Decorator {
	//定义被修饰者，此处可不写，默认继承父类
	public function __construct (Component $component) {
		parent::__construct($component);
	}
	// @Override
	public function operation() {
		parent::operation();  //调用装饰角色的操作
		$this->addOperationA(); //调用自己的修饰方法
	}
	//定义自己的修饰方法
	public function addOperationA() {
		echo 'Add Operation A', PHP_EOL;
	}
}

/**
 * 具体装饰类B
 */
class ConcreteDecoratorB extends Decorator{
	// @Override
	public function operation() {
		parent::operation();  //调用装饰角色的操作
		$this->addOperationB(); //调用自己的修饰方法
	}

	public function addOperationB() {
		echo 'Add Operation B', PHP_EOL;
	}
}

class Client {
	public static function main() {
		$component = new ConcreteComponent;
		//第一次修饰
		$decoratorA = new ConcreteDecoratorA($component);
		//第二次修饰
		$decoratorB = new ConcreteDecoratorB($decoratorA);

		//修饰后运行
		$decoratorA->operation();
		echo '---------------------------------------', PHP_EOL;
		$decoratorB->operation();
	}
}

Client::main();