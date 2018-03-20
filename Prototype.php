<?php
/**
 * 用原型实例指定创建对象的种类，并且通过拷贝这些原型创建新的对象
 * 不通过new关键字来产生一个对象，而是通过对象复制来实现的模式就叫做原型模式。
 * 使用场景：类初始化需要消化非常多的资源，这个资源包括数据、硬件资源等
 */

/**
 * 抽象原型角色
 */
interface Prototype {
	public function copy();
}

/**
 * 具体原型角色
 */
class ConcretePrototype implements Prototype {
	private $_name;

	public function __construct($name) {
		$this->_name = $name;
	}

	public function setName($name) {
		$this->_name = $name;
	}

	public function getName() {
		return $this->_name;
	}

	public function copy() {
		//深拷贝实现
		$serialize_obj = serialize($this); //序列化
		$clone_obj = unserialize($serialize_obj); //反序列化
		return $clone_obj;

		//return clone $this; //浅拷贝
	}
}

/**
 * 测试深拷贝用的引用类
 */
class Demo {
	public $array;
}

class Client {
	public static function main() {
		$demo = new Demo;
		$demo->array = array(1, 2);
		$object1 = new ConcretePrototype($demo);
		$object2 = $object1->copy();

		/**
		 * 深浅拷贝测试
		 */
		var_dump($object1->getName());
		var_dump($object2->getName());

		//$demo->array = array(3, 4);
		//var_dump($object1->getName());
		//var_dump($object2->getName());

	}
}

Client::main();