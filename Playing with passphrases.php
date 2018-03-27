<?php
/**
 * Everyone knows passphrases. One can choose passphrases from poems, songs, movies names and so on but frequently they can be guessed due to common cultural references. You can get your passphrases stronger by different means. One is the following:
 *
 * choose a text in capital letters including or not digits and non alphabetic characters,
 *
 * shift each letter by a given number but the transformed letter must be a letter (circular shift),
 * replace each digit by its complement to 9,
 * keep such as non alphabetic and non digit characters,
 * downcase each letter in odd position, upcase each letter in even position (the first character is in position 0),
 * reverse the whole result.
 * #Example:
 *
 * your text: "BORN IN 2015!", shift 1
 *
 * 1 + 2 + 3 -> "CPSO JO 7984!"
 *
 * 4 "CpSo jO 7984!"
 *
 * 5 "!4897 Oj oSpC"
 *
 * With longer passphrases it's better to have a small and easy program. Would you write it?
 */
function playPass( $s, $n ) {
	$str_arr = str_split( $s );
	foreach ( $str_arr as $k => $v ) {
		if ( preg_match( '/[a-zA-Z]/', $v ) === 1 ) {
			$str_arr[$k] = rotate( $v, $n );
			if ( $k % 2 == 0 ) {
				$str_arr[$k] = strtoupper( $str_arr[$k] );
			} else {
				$str_arr[$k] = strtolower( $str_arr[$k] );
			}
		}
		if ( preg_match( '/[0-9]/', $v ) === 1 ) {
			$str_arr[$k] = 9 - $v;
		}
	}

	return strrev( implode( '', $str_arr ) );
}

function rotate( $char, $n = 13 ) {
	static $letters = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz';
	$n = (int)$n % 26;
	if ( !$n ) {
		return $char;
	}
	if ( $n < 0 ) {
		$n += 26;
	}
	if ( $n == 13 ) {
		return str_rot13( $char );
	}
	$rep = substr( $letters, $n * 2 ) . substr( $letters, 0, $n * 2 );

	return strtr( $char, $letters, $rep );
}