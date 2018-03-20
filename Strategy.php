<?php
/**
 * 策略模式
 * 定义一系列的算法，把它们一个个封装起来，并且使它们可相互替换。策略模式可以使算法可独立于使用它的客户而变化，策略模式变化的是算法
 */

/**
 * 抽象策略角色
 */
interface Strategy {
	// 算法接口
	public function algorithmInterface();
}

//具体策略角色A
class ConcreteStrategyA implements Strategy {
	public function algorithmInterface() {
		echo 'algorithmInterface A', PHP_EOL;
	}
}

class ConcreteStrategyB implements Strategy {
	public function algorithmInterface() {
		echo 'algorithmInterface B', PHP_EOL;
	}
}

class ConcreteStrategyC implements Strategy {
	public function algorithmInterface() {
		echo 'algorithmInterface C', PHP_EOL;
	}
}

/**
 * 封装角色
 */
class Context {
	private $_strategy;

	//构造函数设置具体策略
	public function __construct( Strategy $strategy) {
		$this->_strategy = $strategy;
	}

	public function contextInterface() {
		$this->_strategy->algorithmInterface();
	}
}


class Client {

	public static function main() {
		$strategyA = new ConcreteStrategyA;
		$context = new Context($strategyA);
		$context->contextInterface();

		$strategyB = new ConcreteStrategyB;
		$context = new Context($strategyB);
		$context->contextInterface();

		$strategyC = new ConcreteStrategyC;
		$context = new Context($strategyC);
		$context->contextInterface();
	}
}

Client::main();