<?php
/**
 * Given a string made of digits [0-9], return a string where each digit is repeated a number of times equals to its value.
 *
 * Examples
 * digits_explode("312"); // => "333122"
 * digits_explode("102269"); // => "12222666666999999999"
 */

function digits_explode( string $s ): string {
	$a = str_split( $s );
	$output = "";
	foreach ( $a as $v ) {
		$counter = 0;
		while ( $counter < $v ) {
			$output .= $v;
			$counter ++;
		}
	}

	return $output;
}
