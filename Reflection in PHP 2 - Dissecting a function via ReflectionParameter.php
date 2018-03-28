<?php

/**
 * Task
 * Write a function filter_parameters() which accepts exactly 1 argument $fn (the name of the function or the closure itself) and returns a string representation of a list containing the names of the parameters of said function that satisfies all of the conditions mentioned below:
 *
 * It has declared a data type
 * Its declared data type is an integer
 * It has a default value
 * If not provided, it defaults to a value of 5
 * The returned string should be of the format "item1, item2, item3, ...", i.e. each parameter name in the list should be separated by the delimiter ", "
 *
 * For example, for the following function:
 *
 * function example($a, int $b, bool $c, int $d = 5, float $e = 5.00, int $f = 5, int $g = 15) {  ...  }
 * ... your function should return "d, f" . This test case has been included for you . You may assume
 * that any function (or name thereof) passed into your function will have at least one parameter that satisfies all the conditions given .
 */

function filter_parameters( $fn ) {
	$r = new ReflectionFunction( $fn );
	$params = $r->getParameters();
	$output = [];
	foreach ( $params as $param ) {
		if ( $param->hasType() && $param->isDefaultValueAvailable() &&
			 $param->getDefaultValue() == 5 && $param->getType() == 'int' ) {
			$output[] = $param->getName();
		}
	}

	return implode( ', ', $output );
}