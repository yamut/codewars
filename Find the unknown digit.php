<?php
/**
 * To give credit where credit is due: This problem was taken from the ACMICPC-Northwest Regional Programming Contest. Thank you problem writers.
 *
 * You are helping an archaeologist decipher some runes. He knows that this ancient society used a Base 10 system, and that they never start a number with a leading zero. He's figured out most of the digits as well as a few operators, but he needs your help to figure out the rest.
 *
 * The professor will give you a simple math expression, of the form
 *
 * [number][op][number]=[number]
 * He has converted all of the runes he knows into digits. The only operators he knows are addition (+),subtraction(-), and multiplication (*), so those are the only ones that will appear. Each number will be in the range from -1000000 to 1000000, and will consist of only the digits 0-9, possibly a leading -, and maybe a few ?s. If there are ?s in an expression, they represent a digit rune that the professor doesn't know (never an operator, and never a leading -). All of the ?s in an expression will represent the same digit (0-9), and it won't be one of the other given digits in the expression. No number will begin with a 0 unless the number itself is 0, therefore 00 would not be a valid number.
 *
 * Given an expression, figure out the value of the rune represented by the question mark. If more than one digit works, give the lowest one. If no digit works, well, that's bad news for the professor - it means that he's got some of his runes wrong. output -1 in that case.
 *
 * Complete the method to solve the expression to find the value of the unknown rune. The method takes a string as a paramater repressenting the expression and will return an int value representing the unknown rune or -1 if no such rune exists.
 *
 * Most of the time, the professor will be able to figure out most of the runes himself, but sometimes, there may be exactly 1 rune present in the expression that the professor cannot figure out (resulting in all question marks where the digits are in the expression) so be careful ;)
 */

function solve_expression( string $expression ): int {
	$_ = explode( '=', $expression );
	$result = $_[1];
	$math = $_[0];
	$operator = null;
	if ( preg_match( '/\-\-/', $math ) === 1 ) {
		$math = str_replace( '--', '+', $math );
	}
	var_dump( $math );
	if ( strpos( $math, "+" ) !== false ) {
		$operator = "+";
		$parts = explode( '+', $math );
	} else {
		if ( strpos( $math, "*" ) !== false ) {
			$operator = "*";
			$parts = explode( '*', $math );
		} else {
			$operator = "-";
			if ( substr( $math, 0, 1 ) == '-' ) {
				$math = substr( $math, 1, strlen( $math ) - 1 );
				$parts = explode( '-', $math );
				$parts[0] = '-' . $parts[0];
			} else {
				$parts = explode( '-', $math );
			}
		}
	}
	$part1 = $parts[0];
	$part2 = $parts[1];
	for ( $i = 0; $i <= 9; $i ++ ) {
		if ( strpos( $expression, strval( $i ) ) !== false ) {
			continue;
		}
		if ( ( ( substr_count( $parts[0], '?' ) == strlen( $parts[0] ) &&
				 preg_match( '/^0{2,}$/', str_replace( '?', $i, $parts[0] ) ) === 1 ) ||
			   ( substr_count( $parts[1], '?' ) == strlen( $parts[1] ) &&
				 preg_match( '/^0{2,}$/', str_replace( '?', $i, $parts[1] ) ) === 1 ) ||
			   ( substr_count( $result, '?' ) == strlen( $result ) &&
				 preg_match( '/^0{2,}$/', str_replace( '?', $i, $result ) ) === 1 ) ) && $i == 0 ) {
			continue;
			// Cant have 00
		}
		if ( strlen( $parts[0] ) > 1 && substr( $parts[0], 0, 1 ) == '?' && $i == 0 ||
			 ( substr( $parts[0], 0, 1 ) == '-' && substr( $parts[0], 1, 1 ) == '?' && $i == 0 ) ) {
			continue;
		}
		if ( strlen( $parts[1] ) > 1 && substr( $parts[1], 0, 1 ) == '?' && $i == 0 ||
			 ( substr( $parts[1], 0, 1 ) == '-' && substr( $parts[1], 1, 1 ) == '?' && $i == 0 ) ) {
			continue;
		}
		if ( strlen( $result ) > 1 && substr( $result, 0, 1 ) == '?' && $i == 0 ||
			 ( substr( $result, 0, 1 ) == '-' && substr( $result, 1, 1 ) == '?' && $i == 0 ) ) {
			continue;
		}
		$part1 = str_replace( '?', $i, $parts[0] );
		$part2 = str_replace( '?', $i, $parts[1] );
		$part3 = intval( str_replace( '?', $i, $result ) );

		//omfg... fucking kill me

		try {
			$expr = (int)eval( "return " . $part1 . $operator . $part2 . ';' );
		}
		catch ( ParseError $e ) {
			continue;
		}
		if ( $expr == intval( $part3 ) ) {
			return $i;
		}
	}

	return - 1;
}
