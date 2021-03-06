--TEST--
Test json_encode() function : error conditions
--SKIPIF--
<?php
if (!extension_loaded("json")) {
 	die('skip JSON extension not available in this build');
}	 
?>
--FILE--
<?php
/* Prototype  : string json_encode  ( mixed $value  )
 * Description: Returns the JSON representation of a value
 * Source code: ext/json/php_json.c
 * Alias to functions: 
 */

echo "*** Testing json_encode() : error conditions ***\n";

echo "\n-- Testing json_encode() function with no arguments --\n";
var_dump( json_encode() );

echo "\n-- Testing json_encode() function with more than expected no. of arguments --\n";
$extra_arg = 10;
var_dump( json_encode("abc", $extra_arg) );

?>
===Done===
--EXPECTF--
*** Testing json_encode() : error conditions ***

-- Testing json_encode() function with no arguments --

Warning: json_encode() expects exactly 1 parameter, 0 given in %s on line %d
NULL

-- Testing json_encode() function with more than expected no. of arguments --

Warning: json_encode() expects exactly 1 parameter, 2 given in %s on line %d
NULL
===Done===
