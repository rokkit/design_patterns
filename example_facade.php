<?php
class Book {
	private $author;
	private $title;

	function __construct($title_in, $author_in) {
		$this->author = $author_in;
		$this->title  = $title_in;
	}

	function getAuthor() {return $this->author;}
	function getTitle() {return $this->title;}

	function getAuthorAndTitle() {
		return $this->getTitle() . ' by ' . $this->getAuthor();
	}
}

class CaseReverseFacade {
	public static function reverseStringCase($stringIn) {
		$arrayFromString = ArrayStringFunctions::stringToArray($stringIn);
		$reversedCaseArray = ArrayCaseReverse::reverseCase($arrayFromString);
		$reversedCaseString = ArrayStringFunctions::arrayToString($reversedCaseArray);
		return $reversedCaseString;
	}
}

class ArrayCaseReverse {
	private static $uppercase_array =
		array('A', 'B', 'C', 'D', 'E', 'F',
		      'G', 'H', 'I', 'J', 'K', 'L',
		      'M', 'N', 'O', 'P', 'Q', 'R',
		      'S', 'T', 'U', 'V', 'W', 'X',
		      'Y', 'Z');
	private static $lowercase_array =
		array('a', 'b', 'c', 'd', 'e', 'f',
		      'g', 'h', 'i', 'j', 'k', 'l',
		      'm', 'n', 'o', 'p', 'q', 'r',
		      's', 't', 'u', 'v', 'w', 'x',
		      'y', 'z');
	public static function reverseCase($arrayIn) {
		$array_out = array();
		for ($x = 0; $x < count($arrayIn); $x++) {
			if (in_array($arrayIn[$x], self::$uppercase_array)) {
				$key = array_search($arrayIn[$x], self::$uppercase_array);
				$array_out[$x] = self::$lowercase_array[$key];
			} elseif (in_array($arrayIn[$x], self::$lowercase_array)) {
				$key = array_search($arrayIn[$x], self::$lowercase_array);
				$array_out[$x] = self::$uppercase_array[$key];
			} else {
				$array_out[$x] = $arrayIn[$x];
			}
		}
		return $array_out;
	}
}

class ArrayStringFunctions {
	public static function arrayToString($arrayIn) {
		$string_out = NULL;
		foreach ($arrayIn as $oneChar) {
			$string_out .= $oneChar;
		}
		return $string_out;
	}
	public static function stringToArray($stringIn) {
		return str_split($stringIn);
	}
}


echo tagins("html");
echo tagins("head");
echo tagins("/head");
echo tagins("body");

echo "BEGIN TESTING FACADE PATTERN";
echo tagins("br").tagins("br");

$book = new Book("Design Patterns", "Gamma, Helm, Johnson, and Vlissides");

echo "Original book title: " . $book->getTitle() . tagins("br");
echo "Original book author: " . $book->getAuthor();
echo tagins("br").tagins("br");

$bookTitleReversed = CaseReverseFacade::reverseStringCase($book->getTitle());
$bookAuthorReversed = CaseReverseFacade::reverseStringCase($book->getAuthor());

echo "Reversed book title: " . $bookTitleReversed . tagins("br");
echo "Reversed book author: " . $bookAuthorReversed;
echo tagins("br").tagins("br");

echo "END TESTING FACADE PATTERN";
echo tagins("br");

echo tagins("/body");
echo tagins("/html");

//doing this so code can be displayed without breaks
function tagins($stuffing) {
	return "<".$stuffing.">";
}



