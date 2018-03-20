<?php
/**
 * 抽象同事类
 */
abstract class Colleague {
	protected $_mediator;
	public function __construct(Mediator $mediator = null) {
		$this->_mediator = $mediator;
	}
}

/**
 * 具体同事类1
 */
class ConcreteColleague1 extends Colleague {
	public function __construct(Mediator $mediator) {
		$this->_mediator = $mediator;
	}

	//自有方法，处理自己的业务逻辑
	public function selfMethod1() {
		echo "ConcreteColleague1 selfMethod1 \n";
	}

	//依赖方法，自己不能处理的业务逻辑，委托给中介者处理
	public function depMethod1() {
		$this->_mediator->doSomething1();
	}
}

/**
 *具体同事类2
 */
class ConcreteColleague2 extends Colleague {
	public function __construct(Mediator $mediator) {
		$this->_mediator = $mediator;
	}

	public function selfMethod2() {
		echo "ConcreteColleague2 selfMethod2 \n";
	}

	public function depMethod2() {
		$this->_mediator->doSomething2();
	}

}

/**
 * 通用抽象中介者
 */
abstract class AbstractMediator {
	//定义同事类
	protected $_c1;
	protected $_c2;
	public function __construct() {
		$this->_c1 = new ConcreteColleague1($this);
		$this->_c2 = new ConcreteColleague2($this);
	}
	abstract public function execute();
}

/**
 * 具体中介者
 */
class Mediator extends AbstractMediator {

	public function doSomething1() {
		$this->_c1->selfMethod1();
		$this->_c2->selfMethod2();
	}

	public function doSomething2() {
		$this->_c2->selfMethod2();
		$this->_c1->selfMethod1();
	}
	public function execute() {

	}
}

class Client {
	public static function main() {
		$mediator = new Mediator;
		$c1 = new ConcreteColleague1($mediator);
		$c2 = new ConcreteColleague2($mediator);
		echo "c1->depMethod1:--------------------\n";
		$c1->depMethod1();
		echo "c2->depMethod2::--------------------\n";
		$c2->depMethod2();
	}
}
Client::main();