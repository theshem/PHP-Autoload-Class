<?php

/**
* Example Class
*/
class Example
{
    public function __construct()
    {
        // Load the AutoLoad Class
        require '../autoload.php';

        // Create an instance for once
        // $loader = AutoLoad::getReady();
        // $loader->addPath('./lib/')->fire();
        // 
        // OR:
        AutoLoad::getReady()->addPath('./lib')->addExtension('.class.php')->fire();
    }
}

// Fire up!
new Example();

var_export(AutoLoad::getReady()->getPath());         // array ( 0 => './lib/' )

var_export(AutoLoad::getReady()->getExtension());    // array ( 0 => '.php', 1 => '.class.php' )

var_export(AutoLoad::getReady()->getLoadedFiles());  // array ( )

var_export(AutoLoad::getReady()->isLoaded('Foo'));   // false

$f = new Foo('Here it is!');

var_export(AutoLoad::getReady()->isLoaded('Foo'));   // true

var_export(AutoLoad::getReady()->getLoadedFiles());  // array ( 'Foo' => './lib/Foo.class.php' )

var_export($f->getProperty());                       // 'Here it is!'

/*
 | Cool, huh?
 | 
 | Now see the rest!
 */

// Get the AutoLoad instance
$loader = AutoLoad::getReady();

$loader->addPath('inc')->addExtension('.inc');

// Stop autoloading.
$loader->halt();

// $b = new Bar('Errrrrrrr :(');    // Fatal error: Class 'Bar' not found in...

// Fire!
$loader->fire();

$b = new Bar('It Works :)');

var_export($b->getProperty());      // 'It Works :)'

/*
 | Built by @HashemQolami with ♥
 |
 | Check the README file to see more details.
 */