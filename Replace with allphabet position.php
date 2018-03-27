<?php
/**
 *
 * Welcome.
 *
 * In this kata you are required to, given a string, replace every letter with its position in the alphabet.
 *
 * If anything in the text isn't a letter, ignore it and don't return it.
 *
 * a being 1, b being 2, etc.
 *
 * As an example:
 *
 * alphabet_position('The sunset sets at twelve o\' clock.');
 * Should return "20 8 5 19 21 14 19 5 20 19 5 20 19 1 20 20 23 5 12 22 5 15 3 12 15 3 11" as a string.
 *
 */


function alphabet_position( string $s ): string {
	$u = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$l = "abcdefghijklmnopqrstuvwxyz";
	$str_arr = str_split( $s );
	foreach ( $str_arr as $k => $v ) {
		if ( preg_match( '/[a-z]/', $v ) === 1 ) {
			$str_arr[$k] = strpos( $l, $v ) + 1;
		}
		if ( preg_match( '/[A-Z]/', $v ) === 1 ) {
			$str_arr[$k] = strpos( $u, $v ) + 1;
		}
		if ( preg_match( '/[^a-zA-Z]/', $v ) === 1 ) {
			unset( $str_arr[$k] );
		}
	}

	return implode( ' ', $str_arr );
}