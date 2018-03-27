<?php

/**
 *Create a function named divisors/Divisors that takes an integer and returns an array with all of the integer's divisors(except for 1 and the number itself). If the number is prime return the string '(integer) is prime' (null in C#) (use Either String a in Haskell and Result<Vec<u32>, String> in Rust).
 *
 * Example:
 * divisors(12); // => [2, 3, 4, 6]
 * divisors(25); // => [5]
 * divisors(13); // => '13 is prime'
 * You can assume that you will only get positive integers as inputs.
 */

function divisors( $integer ) {
	$divisors = [];
	for ( $i = 2; $i <= $integer / 2; $i ++ ) {
		if ( $integer % $i == 0 ) {
			$divisors[] = $i;
		}
	}

	return !empty( $divisors ) ? $divisors : "$integer is prime";
}