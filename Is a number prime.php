<?php
/**
 * Is Prime
 * Define a function isPrime/is_prime() that takes one integer argument and returns true/True or false/False depending on if the integer is a prime.
 *
 * Per Wikipedia, a prime number (or a prime) is a natural number greater than 1 that has no positive divisors other than 1 and itself.
 *
 * Example
 * is_prime(5); // => true
 * Assumptions
 * You can assume you will be given an integer input.
 * You can not assume that the integer will be only positive. You may be given negative numbers as well (or 0).
 */
function is_prime( int $n ): bool {
	if ( $n == 0 || $n < 0 ) {
		return false;
	} else {
		if ( $n == 1 ) {
			return false;
		} else {
			if ( $n == 2 ) {
				return true;
			}
		}
	}
	if ( $n % 2 == 0 ) {
		return false;
	}
	for ( $i = 3; $i <= ceil( sqrt( $n ) ); $i += 2 ) {
		if ( $n % $i == 0 ) {
			return false;
		}
	}

	return true;
}