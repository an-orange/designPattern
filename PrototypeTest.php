<?php
abstract class BookPrototype {
	protected $title;
	protected $category;
	abstract public function __clone();

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
	}
}

class AbookPrototype extends BookPrototype {
	protected $category = 'a';
	public function __clone() {
	}
}

class BbookPrototype extends BookPrototype {
	protected $category = 'b';
	public function __clone() {
	}
}

class PrototypeTest extends PHPUnit_Framework_TestCase {
	public function getPrototype() {
		return [
			[new AbookPrototype],
			[new BbookPrototype]
		];
	}

	public function testCreate(BookPrototype $prototype) {
		$book = clone $prototype;
		$book->setTitle($book->getCategory() . ' Book');
		$this->assertInstanceOf('BookPrototype', $book);
	}
}