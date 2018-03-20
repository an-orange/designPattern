<?php
interface IHanFeiZi{
public function haveBreakfast();
	public function haveFun();
}


class HanFeiZi implements IHanFeiZi { 
	private $_isHavingBreakfast; 
	private $_isHavingFun;

	public  function haveBreakfast() {
		echo "韩非子：开始吃饭了……", PHP_EOL;
		$this->_isHavingBreakfast = true;
	}

	public function haveFun() {
		echo "韩非子：开始娱乐了……", PHP_EOL;
		$this->_isHavingFun = true;
	}
}