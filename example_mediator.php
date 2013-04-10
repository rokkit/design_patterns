<?php

class StarostaMediator {
	private $KostyaStudent;
	private $AnnaStudent;

	function __construct($stud1_in, $stud2_in) {
		$this->KostyaStudent = new Kostya($stud1_in, $this);
		$this->AnnaStudent  = new Anna($stud2_in, $this);
	}

	function getKostya() {return $this->KostyaStudent;}
	function getAnna() {return $this->AnnaStudent;}

	function change(Students $changingClassIn) {
		if ($changingClassIn instanceof Kostya) {
			if ('lost' == $changingClassIn->getState()) {
				if ('lost' != $this->getAnna()->getState()) {
					$this->getAnna()->setZa4otkaLost();
				}
			} elseif ('found' == $changingClassIn->getState()) {
				if ('found' != $this->getAnna()->getState()) {
					$this->getAnna()->setZa4otkaFound();
				}
			}
		} elseif ($changingClassIn instanceof Anna) {
			if ('lost' == $changingClassIn->getState()) {
				if ('lost' != $this->getKostya()->getState()) {
					$this->getKostya()->setStudcardLost();
				}
			} elseif ('found' == $changingClassIn->getState()) {
				if ('found' != $this->getKostya()->getState()) {
					$this->getKostya()->setStudcardFound();
				}
			}
		}
	}
}

abstract class Students {
	private $mediator;

	function __construct($mediator_in) {
		$this->mediator = $mediator_in;
	}

	function getMediator() {return $this->mediator;}
}


class Kostya extends Students {
	private $studcard;
	private $state;

	function __construct($studcard_in, $mediator_in) {
		$this->studcard = $studcard_in;
		parent::__construct($mediator_in);
	}

	function getStudcard() {return $this->studcard;}
	function setStudcard($studcard_in) {$this->studcard = $studcard_in;}

	function getState() {return $this->state;}
	function setState($state_in) {$this->state = $state_in;}

	function setStudcardLost() {
		$this->setStudcard(-abs($this->getStudcard()));
		$this->setState('lost');
		$this->getMediator()->change($this);
	}

	function setStudcardFound() {
		$this->setStudcard(abs($this->getStudcard()));
		$this->setState('found');
		$this->getMediator()->change($this);
	}
}

class Anna extends Students {
	private $za4otka;
	private $state;

	function __construct($za4otka_in, $mediator_in) {
		$this->za4otka = $za4otka_in;
		parent::__construct($mediator_in);
	}

	function getZa4otka() {return $this->za4otka;}
	function setZa4otka($za4otka_in) {$this->za4otka = $za4otka_in;}

	function getState() {return $this->state;}
	function setState($state_in) {$this->state = $state_in;}

	function setZa4otkaLost() {
		$this->setZa4otka(-abs($this->getZa4otka()));
		$this->setState('lost');
		$this->getMediator()->change($this);
	}

	function setZa4otkaFound() {
		$this->setZa4otka(abs($this->getZa4otka()));
		$this->setState('found');
		$this->getMediator()->change($this);
	}
}

writeln('BEGIN TESTING MEDIATOR PATTERN');
writeln('');

$mediator = new StarostaMediator(123, 111);

$K = $mediator->getKostya();
$A = $mediator->getAnna();

writeln('Original studcard and za4otka: ');
writeln('studcard: ' . $K->getStudcard() . ' state: ' . $K->getState());
writeln('za4otka: ' . $A->getZa4otka() . ' state: ' . $A->getState());
writeln('');

$K->setStudcardLost();

writeln('Original studcard and za4otka: ');
writeln('studcard: ' . $K->getStudcard() . ' state: ' . $K->getState());
writeln('za4otka: ' . $A->getZa4otka() . ' state: ' . $A->getState());
writeln('');

$A->setZa4otkaFound();

writeln('Original studcard and za4otka: ');
writeln('studcard: ' . $K->getStudcard() . ' state: ' . $K->getState());
writeln('za4otka: ' . $A->getZa4otka() . ' state: ' . $A->getState());
writeln('');

$K->setStudcardLost();

writeln('Original studcard and za4otka: ');
writeln('studcard: ' . $K->getStudcard() . ' state: ' . $K->getState());
writeln('za4otka: ' . $A->getZa4otka() . ' state: ' . $A->getState());
writeln('');

writeln('END TESTING MEDIATOR PATTERN');

function writeln($line_in) {
	echo $line_in.'<'.'BR'.'>';
}
