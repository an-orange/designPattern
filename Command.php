<?php

/**
 * 抽象命令
 */
interface Command {
	/**
	 * 执行方法
	 */
	public function execute();
}

/**
 * 具体命令角色
 */
class ConcreteCommand implements Command {
	private $_receiver;

	public function __construct(Receiver $receiver) {
		$this->_receiver = $receiver;
	}

	/**
	 * 执行方法
	 */
	public function execute() {
		$this->_receiver->action();
	}
}

/**
 * 接收者角色
 */

class Receiver {
	/* 接收者名称 */
	private $_name;
	public function __construct($name) {
		$this->_name = $name;
	}

	/**
	 * 执行方法
	 */
	public function action() {
		echo "{$this->_name} do action...", PHP_EOL;
	}
}

/**
 * 请求者角色
 */
class Invoker {
	private $_command;
	public function __construct(Command $command) {
		$this->_command = $command;
	}

	public function action() {
		$this->_command->execute();
	}
}

class Client {
	public static function main() {
		$receiver = new Receiver('waiter');
		$command = new ConcreteCommand($receiver);
		$invoker = new Invoker($command);
		$invoker->action();
	}
}

Client::main();