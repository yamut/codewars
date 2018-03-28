<?php

/**
 * Assessment
 * The assessment is split into three sections, or rather, code challenges. You must pass all three of them in order to complete this Kata.
 *
 * Code Challenge #1 - Find the odd one out
 * Preloaded for you is a non-associative array $functions which contains the names of 30 named functions (each as a string). If you perform Reflection on each and every function named in $functions, you should discover that all of them have the same function signature (except for their names of course) with the exception of one of them. Find the odd one out and once you think you've figured out which is the unique one, assign the name of that function to the global $answer variable.
 *
 * Code Challenge #2 - The Curious Case of the Anonymous Twins
 * We all know that anonymous classes are the way to go when you want to instantiate one-off objects without polluting the global namespace, but is it possible to instantiate more than one object from a single anonymous class? Your goal is to create two separate, distinct objects, $twin1 and $twin2, which are both instances of the same anonymous class.
 *
 * Code Challenge #3 - Diffuse That Bomb
 * Your archnemesis hates you so much that he/she has planted a bomb (class Bomb) in your house/apartment! When you discover the bomb in your apartment, you realise that it is already too late to simply chuck it out of the house/apartment as it is set to explode within 60 seconds. Fortunately, one of your secret skills is the ability to diffuse any bomb quickly so there is still hope.
 *
 * Preloaded for you is a class Bomb with 30 distinct wires (class methods). Your job is to search for the correct wire and cut that wire only (call on the correct class method) which will diffuse the bomb and save your life (and the precious computer next to you). If you accidentally cut the wrong wire (call on an incorrect class method), you will cause the bomb to explode immediately so take care! The wire you're looking for has the following appearance (method signature):
 *
 * Is declared with the keywords final, public and static
 * Has exactly one parameter which is optional
 * The parameter has a declared type of float and defaults to M_PI
 * Has a return type of int
 * Only one of the wires will satisfy all of the conditions above. Hurry! Now that you've read this Description you've only got 15 seconds left! Tick ... tock ... tick ... tock ...
 */

// IDE setup
$functions = [];

$sigs = [];
foreach ($functions as $k => $v) {
	$sig = [];
	$params = (new ReflectionFunction($v))->getParameters();
	foreach ($params as $param) {
		if ($param->isDefaultValueAvailable()) {
			$sig[] = $param->getDefaultValue();
		}
	}
	if (empty($sigs)) {
		$sigs[$k] = sha1(implode('', $sig));
	} else {
		$hash = sha1(implode('', $sig));
		if (!in_array($hash, $sigs)) {
			$answer = $functions[$k];
		}
	}
}
if (!isset($answer) || empty($answer)) {
	$answer = $functions[0];
}
$twin1 = new class {
};
$twin2 = (new ReflectionClass($twin1))->newInstance();

$bomb = new ReflectionClass('Bomb');
$methods = $bomb->getMethods();
foreach ($methods as $method) {
	if ($method->isFinal() && $method->isPublic() && $method->isStatic() && $method->getNumberOfParameters() === 1 && $method->hasReturnType() && $method->getReturnType() == 'int') {
		$params = $method->getParameters();
		foreach ($params as $param) {
			if ($param->hasType() && $param->getType() == 'float' && $param->isDefaultValueConstant() && $param->getDefaultValueConstantName() == 'M_PI') {
				forward_static_call(['Bomb', $method->getName()]);
			}
		}
	}
}