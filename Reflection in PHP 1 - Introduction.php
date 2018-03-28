<?php
/**
 * Task
 * While we get familiar with reading and understanding the official Reflection documentation on php.net, let's start with something simple by practicing how to call different methods of the ReflectionFunction class in order to learn a bit about our function(s). Write a function get_info() which accepts exactly 1 argument $fn which could either be the name of a named function (as a string) or the actual function itself (if it is a closure). Your function should then return a non-associative array with the following elements (in the given order):
 *
 * The total number of parameters of the function as an integer. You may assume that all functions (or their names) passed into your function has a fixed amount of parameters.
 * The total number of required parameters of the function (i.e. those without a default value) as an integer. Again, you may assume that this is always fixed and finite.
 * A boolean specifying whether the function has declared a return type.
 * A boolean specifying whether the function is a closure.
 * A boolean specifying whether the function is internal (i.e. not user-defined)
 * A boolean specifying whether the function is user-defined (i.e. not part of PHP itself).
 * For example, for the multiply function in our "Lesson", your function should produce the following output:
 *
 * [2, 2, false, false, false, true]
 * This test case has been included for you.
 */
function get_info( $fn ) {
	$reflection = new ReflectionFunction( $fn );

	return [
		$reflection->getNumberOfParameters(),
		$reflection->getNumberOfRequiredParameters(),
		$reflection->hasReturnType(),
		$reflection->isClosure(),
		$reflection->isInternal(),
		$reflection->isUserDefined(),
	];
}