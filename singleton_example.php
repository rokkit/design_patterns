<?php
class Test {
	private $_value = null;

	public function __construct() {
		$this->_value = mt_rand(1, 10000);
	}

	public function getValue() {
		return $this->_value;
	}
}

class SingletonTest {
	private static $_instance = null;

	public static function getInstance() {
		if (empty(self::$_instance)) {
			self::$_instance = new Test();
		}
		return self::$_instance;
	}
}

echo "TEST<br/>";
$usual_test1 = new Test();
$test_object1 = SingletonTest::getInstance();
echo 'Value1='.$test_object1->getValue().'<br/>';
echo 'UsualValue1='.$usual_test1->getValue().'<br/>';

$usual_test2 = new Test();
$test_object2 = SingletonTest::getInstance();
echo 'Value2='.$test_object2->getValue().'<br/>';
echo 'UsualValue2='.$usual_test2->getValue().'<br/>';

$usual_test3 = new Test();
$test_object3 = SingletonTest::getInstance();
echo 'Value3='.$test_object3->getValue().'<br/>';
echo 'UsualValue3='.$usual_test3->getValue().'<br/>';









