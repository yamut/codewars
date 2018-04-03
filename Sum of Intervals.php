<?php
/**
 * Write a function called sumIntervals/sum_intervals() that accepts an array of intervals, and returns the sum of all the interval lengths. Overlapping intervals should only be counted once.
 *
 * Intervals
 * Intervals are represented by a pair of integers in the form of an array. The first value of the interval will always be less than the second value. Interval example: [1, 5] is an interval from 1 to 5. The length of this interval is 4.
 *
 * Overlapping Intervals
 * List containing overlapping intervals:
 *
 * [
 * [1,4],
 * [7, 10],
 * [3, 5]
 * ]
 * The sum of the lengths of these intervals is 7. Since [1, 4] and [3, 5] overlap, we can treat the interval as [1, 5], which has a length of 4.
 *
 * Examples
 * sumIntervals( [
 * [1,2],
 * [6, 10],
 * [11, 15]
 * ] ); // => 9
 *
 * sumIntervals( [
 * [1,4],
 * [7, 10],
 * [3, 5]
 * ] ); // => 7
 *
 * sumIntervals( [
 * [1,5],
 * [10, 20],
 * [1, 6],
 * [16, 19],
 * [5, 11]
 * ] ); // => 19
 */

/**
 * @param array $intervals
 * @return int
 */
function sum_intervals( array $intervals ): int {
	array_multisort( $intervals );
	$mins = [];
	$maxs = [];
	foreach ( $intervals as $k => $v ) {
		$mins[ $k ] = min( $v );
		$maxs[ $k ] = max( $v );
	}
	asort( $mins );
	asort( $maxs );
	$total = 0;
	$distinct_ranges = [];
	while ( true ) {
		if ( empty( $intervals ) ) break;
		$pop = array_shift( $intervals );
		$range = range( min( $pop ), max( $pop ) );
		$to_add = [];
		$keys = [];
		foreach ( $intervals as $k => $v ) {
			if ( in_array( min( $v ), $range ) ) {
				$to_add[] = min( $v );
				$to_add[] = max( $v );
				$keys[] = $k;
			}
			if ( in_array( max( $v ), $range ) ) {
				$to_add[] = max( $v );
				$to_add[] = min( $v );
				$keys[] = $k;
			}
		}
		sort( $keys );
		$keys = array_unique( $keys );
		if ( !empty( $keys ) ) {
			foreach ( $keys as $key ) {
				unset( $intervals[ $key ] );
			}
		}
		if ( count( $to_add ) == 1 ) {
			$range[] = min( $to_add );
		} else if ( count( $to_add ) > 1 ) {
			$range[] = min( $to_add );
			$range[] = max( $to_add );
		}
		//add to distinct ranges
		if ( empty( $distinct_ranges ) ) {
			$distinct_ranges[] = range( min( $range ), max( $range ) );
		} else {
			$distinct = true;
			foreach ( $distinct_ranges as $k => $v ) {
				if ( in_array( min( $range ), $v ) ) {
					//not distinct
					$distinct = false;
					$min = ( min( $range ) < min( $v ) ) ? min( $range ) : min( $v );
					$max = ( max( $range ) > max( $v ) ) ? max( $range ) : max( $v );
					$distinct_ranges[ $k ] = range( $min, $max );
				} else if ( in_array( max( $range ), $v ) ) {
					//not distinct
					$distinct = false;
					$min = ( min( $range ) < min( $v ) ) ? min( $range ) : min( $v );
					$max = ( max( $range ) > max( $v ) ) ? max( $range ) : max( $v );
					$distinct_ranges[ $k ] = range( $min, $max );
				}
			}
			if ( $distinct ) {
				$distinct_ranges[] = range( min( $range ), max( $range ) );
			}
		}
	}

	foreach ( $distinct_ranges as $r ) {
		$total += max( $r ) - min( $r );
	}

	return $total;
}
