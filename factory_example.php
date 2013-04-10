<?php

abstract class AbstractPeopleFactory {
	/**
	 * @param $name
	 * @return AbstractBoy
	 */
	abstract function makeBoy($name);

	/**
	 * @param $name
	 * @return AbstractGirl
	 */
	abstract function makeGirl($name);

	/**
	 * @param AbstractBoy $boy
	 * @param AbstractGirl $girl
	 * @return AbstractChild
	 */
	function makeChild(AbstractBoy $boy, AbstractBoy $girl) {return new SomeChild($boy, $girl);}
}

class ItmoFactory extends AbstractPeopleFactory {
	private $context = "ITMO";
	function makeBoy($name) {return new ItmoBoy($name);}
	function makeGirl($name) {return new ItmoGirl($name);}
}

class MITFactory extends AbstractPeopleFactory {
	private $context = "MIT";
	function makeBoy($name) {return new MITBoy($name);}
	function makeGirl($name) {return new MITGirl($name);}
}

class MGUFactory extends AbstractPeopleFactory {
	private $context = "MGU";
	function makeBoy($name) {return new MGUBoy($name);}
	function makeGirl($name) {return new MGUGirl($name);}
}

abstract class AbstractPeople {
	protected $name;
	protected $email;
	protected $gender;
	abstract function getName();
	abstract function getEmail();
	abstract function getGender();
}

abstract class AbstractBoy extends AbstractPeople {
	protected $gender = "Boy";
	protected $vb;
	public function __construct() {
		$this->vb = rand(1, 10000);
	}
	function getName() {return $this->name;}
	function getEmail() {return $this->email;}
	function getGender() {return $this->gender;}
	function getVB() {return $this->vb;}
}

class ItmoBoy extends AbstractBoy {
	function __construct($name) {
		parent::__construct();
		$this->name = $name;
		$this->email  = $name . '@ifmo.ru';
	}
}

class MITBoy extends AbstractBoy {
	function __construct($name) {
		$this->vb = '';
		$this->name = $name;
		$this->email  = $name . '@mit.com';
	}
}

class MGUBoy extends AbstractBoy {
	function __construct($name) {
		parent::__construct();
		$this->name = $name .' Moscow Boy';
		$this->email  = $name . '@mgu.com';
	}
}

abstract class AbstractGirl extends  AbstractPeople {
	protected $gender = "Girl";
	function getGender() {return $this->gender;}
}

class ItmoGirl extends AbstractGirl {
	private static $oddOrEven = 'odd';
	function __construct($name) {
		if ('odd' == self::$oddOrEven) {
			$this->name = $name;
			$this->email  = 'Blonde' . $name . '@itmo.ru';
			self::$oddOrEven = 'even';
		} else {
			$this->name = $name;
			$this->email  = 'Black' . $name . '@itmo.ru';
			self::$oddOrEven = 'odd';
		}
	}
	function getName() {return $this->name;}
	function getEmail() {return $this->email;}
}

class MITGirl extends AbstractGirl {
	function __construct($name) {
		mt_srand((double)microtime()*10000000);
		$rand_num = mt_rand(1970, 1990);
		if ($rand_num > 1980) {
			$this->name = $name;
			$this->email  = $name . $rand_num . '@mit.com';
		} else {
			$this->name = $name;
			$this->email  = 'Old' . $name . '@mit.com';
		}
	}
	function getName() {return $this->name;}
	function getEmail() {return $this->email;}
}

class MGUGirl extends AbstractGirl {
	public function __construct($name) {
		$this->name = $name . 'Moscow Girl';
		$this->email  = 'Young' . $name . '@mgu.com';
	}
	function getName() {return $this->name;}
	function getEmail() {return $this->email;}
}

abstract class AbstractChild extends AbstractPeople {
	protected $gender;
	public function __construct() {
		$this->email = '';
		$this->gender = mt_rand(0, 1) == 1 ? 'boy' : 'girl';
	}
	function getGender() {return $this->gender;}
	function getName() {return $this->name;}
	function getEmail() {return $this->email;}
}

class SomeChild extends AbstractChild {
	 public function __construct(AbstractBoy $boy, AbstractGirl $girl) {
		 $this->name = $boy->getName() . ' ' . $girl->getName();
	 }
}

class RusChild extends AbstractChild {
	public function __construct(AbstractBoy $boy, AbstractGirl $girl) {
		$this->name = $boy->getName() . ' отчество ' . $girl->getName();
	}
}

class UsaChild extends AbstractChild {
	public function __construct(AbstractBoy $boy, AbstractGirl $girl) {
		$this->name = $girl->getName() . ' second name ' . $boy->getName();
	}
}

class InterChild extends AbstractChild {
	public function __construct(AbstractBoy $boy, AbstractGirl $girl) {
		$this->name = $girl->getName() . ' отчество second name ' . $boy->getName();
	}
}


echo tagins("html");
echo tagins("head");
echo tagins("/head");
echo tagins("body");


echo "BEGIN TESTING ABSTRACT FACTORY PATTERN";
echo tagins("br").tagins("br");

echo 'testing ItmoFactory'.tagins("br");
$peopleFactoryInstance = new ItmoFactory;
testConcreteFactory($peopleFactoryInstance);

echo tagins("br");

echo 'testing MITFactory'.tagins("br");
$peopleFactoryInstance = new MITFactory;
testConcreteFactory($peopleFactoryInstance);

echo tagins("br");

echo 'testing MGUFactory'.tagins("br");
$peopleFactoryInstance = new MGUFactory();
testConcreteFactory($peopleFactoryInstance);

echo tagins("br");
echo "END TESTING ABSTRACT FACTORY PATTERN";
echo tagins("br");

echo tagins("/body");
echo tagins("/html");

/**
 * @param AbstractPeopleFactory $peopleFactoryInstance
 */
function testConcreteFactory($peopleFactoryInstance) {
	$boyOne = $peopleFactoryInstance->makeBoy('Vladislav');
	echo 'first: ' . $boyOne->getGender()
		. ' ' . $boyOne->getName().' ' . $boyOne->getEmail() . ' ' . $boyOne->getVB() . tagins("br");

	$boyTwo = $peopleFactoryInstance->makeBoy('Vadim');
	echo 'two: ' . $boyTwo->getGender()
		. ' ' . $boyTwo->getName().' ' . $boyTwo->getEmail() . ' ' . $boyTwo->getVB() . tagins("br");

	$girlOne = $peopleFactoryInstance->makeGirl('Alice');
	echo 'first: ' . $girlOne->getGender()
		. ' ' . $girlOne->getName().' ' . $girlOne->getEmail() . tagins("br");

	$girlTwo = $peopleFactoryInstance->makeGirl('Kate');
	echo 'two: ' . $girlTwo->getGender()
		. ' ' . $girlTwo->getName().' ' . $girlTwo->getEmail() . tagins("br");
}

//doing this so code can be displayed without breaks
function tagins($stuffing) {
	return "<".$stuffing.">";
}