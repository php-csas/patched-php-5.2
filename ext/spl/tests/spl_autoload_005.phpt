--TEST--
SPL: spl_autoload() with methods
--SKIPIF--
<?php if (!extension_loaded("spl")) print "skip"; ?>
--INI--
include_path=.
--FILE--
<?php

class MyAutoLoader {

        function autoLoad($className)
        {
        	echo __METHOD__ . "($className)\n";
        }
        
        function autoThrow($className)
        {
        	echo __METHOD__ . "($className)\n";
        	throw new Exception("Unavailable");
        }
}

try
{
	spl_autoload_register(array('MyAutoLoader', 'autoLoad'), true);
}
catch(Exception $e)
{
	echo 'Exception: ' . $e->getMessage() . "\n";
}

// and

$myAutoLoader = new MyAutoLoader();

spl_autoload_register(array($myAutoLoader, 'autoLoad'));
spl_autoload_register(array($myAutoLoader, 'autoThrow'));

try
{
	var_dump(class_exists("TestClass", true));
}
catch(Exception $e)
{
	echo 'Exception: ' . $e->getMessage() . "\n";
}

?>
===DONE===
<?php exit(0); ?>
--EXPECTF--
Exception: Passed array specifies a non static method but no object
MyAutoLoader::autoLoad(TestClass)
MyAutoLoader::autoThrow(TestClass)
Exception: Unavailable
===DONE===
