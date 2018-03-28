<?php

/**
 * Task
 * Write a function get_class_overview() which accepts exactly one argument $c, the name of the class as a string or an instance of that class and return an associative array with the following key-value pairs:
 *
 * "properties" - This should be set to an associative array with 3 key-value pairs: "public", "protected" and "private", each detailing the number of properties with the given visibility
 * "methods" - This should also be set to an associative array with 3 key-value pairs: "public", "protected" and "private", each detailing the number of methods with the given visibility
 * For example, given the following class:
 *
 * class Example {
 * public $a = 1;
 * public $b;
 * private $c = "Hello World";
 * public function d() {}
 * protected function e() {}
 * protected function f() {}
 * }
 * ... your function should return the following associative array:
 *
 * [
 * "properties" => [
 * "public" => 2,
 * "protected" => 0,
 * "private" => 1
 * ],
 * "methods" => [
 * "public" => 1,
 * "protected" => 2,
 * "private" => 0
 * ]
 * ]
 * This test case has been included for you.
 */

function get_class_overview($c) {
	$r = new ReflectionClass($c);
	$props = $r->getProperties();
	$methods = $r->getMethods();
	$output = [
		'properties' => [
			'public' => 0,
			'private' => 0,
			'protected' => 0
		],
		'methods' => [
			'public' => 0,
			'private' => 0,
			'protected' => 0
		]
	];
	foreach ($props as $prop) {
		$visibility = '';
		if ($prop->isPrivate()) {
			$visibility = 'private';
		} else if ($prop->isProtected()) {
			$visibility = 'protected';
		} else if ($prop->isPublic()) {
			$visibility = 'public';
		}
		$output['properties'][$visibility]++;
	}
	foreach ($methods as $method) {
		$visibility = '';
		if ($method->isPrivate()) {
			$visibility = 'private';
		} else if ($method->isProtected()) {
			$visibility = 'protected';
		} else if ($method->isPublic()) {
			$visibility = 'public';
		}
		$output['methods'][$visibility]++;
	}
	return $output;
}