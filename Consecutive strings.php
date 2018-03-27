<?php
/**
 *
 * You are given an array strarr of strings and an integer k. Your task is to return the first longest string consisting of k consecutive strings taken in the array.
 *
 * #Example: longest_consec(["zone", "abigail", "theta", "form", "libe", "zas", "theta", "abigail"], 2) --> "abigailtheta"
 *
 * n being the length of the string array, if n = 0 or k > n or k <= 0 return "".
 */

function longestConsec( $strarr, $num ) {
	if ( count( $strarr ) == 0 || $num > count( $strarr ) || $num <= 0 ) {
		return "";
	}
	$lengths = [];
	foreach ( $strarr as $k => $v ) {
		if ( array_key_exists( $k + ( $num - 1 ), $strarr ) ) {
			$this_sum = 0;
			for ( $i = 0; $i < $num; $i ++ ) {
				$this_sum += strlen( $strarr[$k + $i] );
			}
			$lengths[] = $this_sum;
		} else {
			break;
		}
	}
	$max = 0;
	foreach ( $lengths as $k => $v ) {
		if ( $max < $v ) {
			$max = $v;
		}
	}
	foreach ( $lengths as $k => $v ) {
		if ( $v == $max ) {
			$max = $k;
			break;
		}
	}
	$output = "";
	for ( $i = 0; $i < $num; $i ++ ) {
		$output .= $strarr[$k + $i];
	}

	return $output;
}