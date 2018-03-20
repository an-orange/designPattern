<?php
/**
 * 责任链模式
 */

//请求者接口
interface IRequest {
	public function getType();
	public function getRequest();
}

//请求者
class Request  implements IRequest {
	private  $_type;
	private $_request = '';

	public function __construct($type) {
		$this->_type = $type;
		$this->_request = Type::getName($type);
	}

	public function getType () {
		return $this->_type;
	}

	public function getRequest() {
		return $this->_request;
	}
}


//请求的类型类（不是必须的）
class Type  {
	const  TYPE_ONE = 1;
	const TYPE_TWO = 2;
	const TYPE_THREE = 3;

	static function getName($type) {
		switch ($type) {
			case self::TYPE_ONE:
				return 'Type One';
				break;
			case self::TYPE_TWO:
				return 'Type Two';
				break;
			case self::TYPE_THREE:
				return 'Type Three';
			default:
				return '';
				break;
		}
	} 
}

//抽象处理者
abstract class Handler {
	private $_nextHandler;

	public function handleMessage(Request $request) {
		if($this->getHandlerLevel() == $request->getType()) {
			$this->reponse($request);
		} else if ($this->_nextHandler != '') {
			$this->_nextHandler->handleMessage($request);
		}
	}

	//设置下一个处理者
	public function setNext(Handler $_handler) {
		$this->_nextHandler = $_handler;
	}

	//每个处理者都有自己的处理级别
	protected abstract function getHandlerLevel();

	//每个处理者都必须实现处理任务
	protected abstract function reponse(Request $request);
}


//具体处理者1
class ConcreteHandler1 extends Handler {

	protected function getHandlerLevel() {
		return Type::TYPE_ONE;
	}

	protected function reponse(Request $request) {
		echo  'In ConcreteHandler1', PHP_EOL;
		echo "request is " . $request->getRequest(), PHP_EOL;
	}
}

//具体处理者2
class ConcreteHandler2 extends Handler{
	protected function getHandlerLevel() {
		return Type::TYPE_TWO;
	}

	protected function reponse(Request $request) {
		echo  'In ConcreteHandler2', PHP_EOL;
		echo "request is " . $request->getRequest(), PHP_EOL;
	}	
}

//具体处理者3
class ConcreteHandler3 extends Handler{
	protected function getHandlerLevel() {
		return Type::TYPE_THREE;
	}

	protected function reponse(Request $request) {
		echo  'In ConcreteHandler3', PHP_EOL;
		echo "request is " . $request->getRequest(), PHP_EOL;
	}
}


class  Client {
	public static function main() {
		$request = new Request(Type::TYPE_THREE);
		$handler1 = new ConcreteHandler1;
		$handler2  = new ConcreteHandler2;
		$handler3 = new ConcreteHandler3;
		//设置责任链
		$handler1->setNext($handler2);
		$handler2->setNext($handler3);

		$handler1->handleMessage($request);
	}
}

Client::main();