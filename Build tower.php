<?php
/**
 * Build Tower by the following given argument:
 * number of floors (integer and always greater than 0).
 *
 * Tower block is represented as *
 *
 * Python: return a list;
 * JavaScript: returns an Array;
 * C#: returns a string[];
 * PHP: returns an array;
 * C++: returns a vector<string>;
 * Haskell: returns a [String];
 * Ruby: returns an Array;
 * Have fun!
 *
 * for example, a tower of 3 floors looks like below
 *
 * [
 * '  *  ',
 * ' *** ',
 * '*****'
 * ]
 * and a tower of 6 floors looks like below
 *
 * [
 * '     *     ',
 * '    ***    ',
 * '   *****   ',
 * '  *******  ',
 * ' ********* ',
 * '***********'
 * ]
 * Go challenge Build Tower Advanced once you have finished this :)
 */
function tower_builder( int $n ): array {
	$array = [];
	$num_stars = 1;
	$max_width = 1;
	if ( $n == 1 ) {
	} else {
		for ( $i = 1; $i < $n; $i ++ ) {
			$max_width += 2;
		}
	}
	for ( $i = 0; $i < $n; $i ++ ) {
		$array[] = str_pad( str_repeat( "*", $num_stars ), $max_width, " ", STR_PAD_BOTH );
		$num_stars += 2;
	}

	return $array;
}