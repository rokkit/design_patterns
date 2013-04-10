<?php

abstract class Visitee {
	abstract function accept(Visitor $visitorIn);
}

class MultimediaVisitee extends Visitee {
	private $lection;
	private $lab;

	function __construct($lection_in, $lab_in) {
		$this->lection = $lection_in;
		$this->lab  = $lab_in;
	}

	function getLection() {return $this->lection;}
	function getLab() {return $this->lab;}

	function accept(Visitor $visitorIn) {
		$visitorIn->visitMultimedia($this);
	}
}

class GosExamenVisitee extends Visitee {
	private $qlist;
	private $comitee;
	private $group;

	function __construct($qlist_in, $comitee_in, $group_in) {
		$this->qlist  = $qlist_in;
		$this->comitee = $comitee_in;
		$this->group = $group_in;
	}

	function getQlist() {return $this->qlist;}
	function getComitee() {return $this->comitee;}
	function getGroup() {return $this->group;}

	function accept(Visitor $visitorIn) {
		$visitorIn->visitGosExamen($this);
	}
}

abstract class Visitor {
	abstract function visitMultimedia(MultimediaVisitee $multimediaVisiteeIn);
	abstract function visitGosExamen(GosExamenVisitee $gosExamenVisiteeIn);
}


class SmartStudentVisitor extends Visitor {
	private $description = NULL;
	function getDescription() { return $this->description; }
	function setDescription($descriptionIn) {
		$this->description = $descriptionIn;
	}
	function visitMultimedia(MultimediaVisitee $multimediaVisiteeIn) {
		$this->setDescription('I\'ve got known many information about ' . $multimediaVisiteeIn->getLection() . ' and have got new lab ' .  $multimediaVisiteeIn->getLab() );
	}

	function visitGosExamen(GosExamenVisitee $gosExamenVisiteeIn) {
		$this->setDescription('I\'ve visited an exam of group ' . $gosExamenVisiteeIn->getGroup()
			. ' and helped them to answer questions ' . $gosExamenVisiteeIn->getQlist()
			. ' to some teachers such as ' . $gosExamenVisiteeIn->getComitee());
	}
}

class StudentVisitor extends Visitor {
	private $description = NULL;
	function getDescription() { return $this->description; }
	function setDescription($descriptionIn) {
		$this->description = $descriptionIn;
	}
	function visitMultimedia(MultimediaVisitee $multimediaVisiteeIn) {
		$this->setDescription('I\'m not sure, was it about ' . $multimediaVisiteeIn->getLection() . ' or not. And I suddenly have been punished by labwork ' .  $multimediaVisiteeIn->getLab());
	}
	function visitGosExamen(GosExamenVisitee $gosExamenVisiteeIn) {
		$this->setDescription('Accidentally, yesterday morning I woke up at exam of group ' . $gosExamenVisiteeIn->getGroup()
			. '  and had to pass it, knowing nothing about ' .
			$gosExamenVisiteeIn->getQlist()
			. ' and trying to recall it during my answer to ' .
			$gosExamenVisiteeIn->getComitee());
	}
}

echo tagins("html");
echo tagins("head");
echo tagins("/head");
echo tagins("body");

echo "BEGIN TESTING VISITOR PATTERN";
echo tagins("br").tagins("br");

$multimedia = new MultimediaVisitee("Digital Sound", "Sound Forge");
$multimedia2 = new MultimediaVisitee("Digital Video", "After Effects");

$gos = new GosExamenVisitee("OOP", "Lazdin, Lyamin", "4709");

$kostyaVisitor = new StudentVisitor();

acceptVisitor($multimedia, $kostyaVisitor);
echo "Kostya has visited multimedia: " . $kostyaVisitor->getDescription();
echo tagins("br");
acceptVisitor($multimedia2, $kostyaVisitor);
echo "Kostya has visited multimedia2: " . $kostyaVisitor->getDescription();
echo tagins("br");
acceptVisitor($gos, $kostyaVisitor);
echo "Kostya has visited Gos: " . $kostyaVisitor->getDescription();
echo tagins("br");

echo tagins("br");

$valentinVisitor = new SmartStudentVisitor();

acceptVisitor($multimedia, $valentinVisitor);
echo "Valentin has visited multimedia: " . $valentinVisitor->getDescription();
echo tagins("br");
acceptVisitor($multimedia2, $valentinVisitor);
echo "Valentin has visited multimedia2: " . $valentinVisitor->getDescription();
echo tagins("br");

acceptVisitor($gos, $valentinVisitor);
echo "Valentin has visited GOS: " . $valentinVisitor->getDescription();
echo tagins("br");

echo tagins("br");
echo "END TESTING VISITOR PATTERN";
echo tagins("br");

echo tagins("/body");
echo tagins("/html");

//double dispatch any visitor and visitee objects
function acceptVisitor(Visitee $visitee_in, Visitor $visitor_in) {
	$visitee_in->accept($visitor_in);
}


//doing this so code can be displayed without breaks
function tagins($stuffing) {
	return "<".$stuffing.">";
}


