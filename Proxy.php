<?php

/**
 * 抽象主题角色
 */
abstract class Subject {
	abstract public function action();
}

/**
 * 真实角色A
 */
class RealSubjectA extends Subject {
	public function __construct() {
	}

	public function action() {
		echo "RealSubjectA action. \n";
	}
}

/**
 * 代理主题角色
 */
class ProxySubject extends Subject {
	private $_real_subject = null;

	public function __construct(Subject $subject) {
		$this->_real_subject = $subject;
	}

	/**
	 * 实现定义的方法
	 */
	public function action() {
		$this->_beforeAction();
		$this->_real_subject->action();
		$this->_afterAction();
	}

	//预处理操作
	private function _beforeAction() {
		echo "Before action in ProxySubject... \n";
	}

	//善后处理
	private function _afterAction() {
		echo "After action in ProxySubject... \n";
	}
}

class Client {
	public static function main() {
		$proxy = new ProxySubject(new RealSubjectA());
		$proxy->action();
	}
}

Client::main();