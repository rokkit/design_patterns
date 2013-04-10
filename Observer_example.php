<?php
define('BR', '<'.'BR'.'>');

abstract class AbstractObserver {
	abstract function update(AbstractSubject $subject_in);
}

abstract class AbstractSubject {
	abstract function attach(AbstractObserver $observer_in);
	abstract function detach(AbstractObserver $observer_in);
	abstract function notify();
}

class PatternObserver extends AbstractObserver {
	private $name = '';
	public function __construct($name) {
		$this->name = $name;
	}
	public function update(AbstractSubject $subject) {
		echo BR.BR;
		echo $this->name . ' get known ' . $subject->getName() . '\'s new favorite: '. $subject->getFavorites() .BR;
	}
	public function getName() {
		return $this->name;
	}
}

class PatternSubject extends AbstractSubject {
	private $favorites = NULL;
	private $name = '';
	private $observers = array();

	function __construct($name) {
		$this->name = $name;
	}
	function attach(AbstractObserver $observer_in) {
		//could also use array_push($this->observers, $observer_in);
		$this->observers[] = $observer_in;
	}
	function detach(AbstractObserver $observer_in) {
		//$key = array_search($this->observers, $observer_in);
		foreach($this->observers as $okey => $oval) {
			if ($oval === $observer_in) {
				echo $observer_in->getName() . ' is detached' . BR;
				unset($this->observers[$okey]);
			}
		}
	}
	function notify() {
		foreach($this->observers as $obs) {
			$obs->update($this);
		}
	}
	function updateFavorites($newFavorites) {
		$this->favorites = $newFavorites;
		$this->notify();
	}
	function getFavorites() {
		return $this->favorites;
	}
	function getName() {
		return $this->name;
	}
}

echo 'BEGIN TESTING OBSERVER PATTERN'.BR;
echo BR;

$Mark = new PatternSubject('Mark');
$Masha = new PatternSubject('Masha');
$Konstantin = new PatternObserver('Kostya');
$Dilya = new PatternObserver('Dilya');

$Mark->updateFavorites('PHP, Java');
$Masha->updateFavorites('Interzet');

$Mark->attach($Konstantin);
$Masha->attach($Konstantin);
$Masha->attach($Dilya);
$Mark->updateFavorites('PHP, Java, JavaScript');
$Masha->updateFavorites('SkyNet');

$Mark->attach($Dilya);
$Mark->updateFavorites('Smarty, Zend View, Blitz');

$Mark->detach($Konstantin);
$Mark->updateFavorites('Pascal, Assembler (2 types), C++');

$Mark->detach($Dilya);
$Mark->updateFavorites('QT');
$Masha->updateFavorites('ITMO');
$Masha->detach($Dilya);
$Masha->detach($Konstantin);

/*$patternGossiper->updateFavorites(
	'abstract factory, decorator, visitor');

$patternGossiper->updateFavorites(
	'abstract factory, observer, decorator');
$patternGossiper->detach($patternGossipFan);

$patternGossiper->updateFavorites(
	'abstract factory, observer, paisley');*/

echo BR.BR;
echo 'END TESTING OBSERVER PATTERN'.BR;