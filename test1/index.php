<?php
$string = "a (b c (d e (f) g) h) i (j k)";
$start_index = 2;

echo "<h1>Find Close Parentheses</h1>";
echo 'Test string = "' . $string . '".';
echo "<br/>";
echo "Start Parentheses Index : " . $start_index;
echo "<br/>";
echo "End Parentheses Index : " . parentheses($string, $start_index);

function parentheses($string, $index) 
{
	$array_of_char = str_split($string);

	// check open parentheses on index
	if($array_of_char[$index] != "(") {
		return "Error, your start index is '" . $array_of_char[$index] . "', not an open parentheses.";
	}

	// define level of parentheses
	$level = 0;

	for($i = $index; $i < count($array_of_char); $i++) {
		$char = $array_of_char[$i];

		// dig deeper for new open parentheses
		if($char == "(") {
			$level++;
		}
		// up one level if find close parentheses
		else if($char == ")") {
			$level--;

			// when find close parentheses and level back to zero, it means close parentheses has found.
			if($level == 0) {
				return $i;
			}
		}
	}
}
?>