PHP Autoload Class
==================

**This is a PHP autoload class to load classes dynamically.**

Currently, there's no support for `namespace` feature which has been added since PHP 5.3 version, but it would be added in the future.

### Table of Contents

- [Getting ready!](#getting-ready)
- [Example Usage](#example-usage)
- [Function Reference](#function-reference)
    - [File Paths](#file-paths)
        - [Adding Paths](#adding-paths)
        - [Removing Paths](#removing-paths)
        - [Getting All Paths](#getting-all-paths)
    - [File Extensions](#file-extensions)
        - [Adding Extensions](#adding-extensions)
        - [Removing Extensions](#removing-extensions)
        - [Getting All Extensions](#getting-all-extensions)
    - [Loaded Classes](#loaded-classes)
        - [Check Loaded Class](#check-loaded-class)
        - [Get Loaded Classes](#get-loaded-classes)
    - [Manage Autoloading](#manage-autoloading)
        - [Start Autoloading, Fire!](#start-autoloading-fire)
        - [Stop Autoloading, Halt!](#stop-autoloading-halt)

Getting Ready!
--------------------

```PHP
require 'autoload.php';

/**
 * AutoLoad::getReady()
 * 
 * Creates an instance of AutoLoad class once
 * and returns the instance for later calls
 *
 * @return object
 */
$loader = AutoLoad::getReady(); // Use $loader or AutoLoad::getReady() itself.

/**
 * AutoLoad::fire();
 *
 * Starts AutoLoading
 */
AutoLoad::getReady()->fire();
```

Example Usage
-------------

```PHP
require 'autoload.php';

// Get ready, Fire!
AutoLoad::getReady()->addPath('./lib')->addExtension('.class.php')->fire();

// Quick mode:
// Add path while the AutoLoad is getting ready
// This would happen once!
AutoLoad::getReady('./lib')->addExtension('.class.php')->fire();
```

### Function Reference

File Paths
----------
### Adding Paths
##### <i>`AutoLoad::`</i> `addPath($path)`

Parameter | Type | Description
--- | --- | ---
**$path** | `string` or `array` | Path of the class files

> **Return Values**   
> `(object)` Returns instance of AutoLoad class.

```PHP
AutoLoad::getReady()->addPath('/path/to/first/directory')
                    ->addPath('/path/to/second/one')
                    ->addPath('/path/to/third');
// OR
$paths = array(
    '/path/to/first/directory',
    '/path/to/second/one',
    '/path/to/third'
);
AutoLoad::getReady()->addPath($paths);
```

### Removing Paths
##### <i>`AutoLoad::`</i> `removePath($path)`

Parameter | Type | Description
--- | --- | ---
**$path** | `string` or `array` | Path of the class files

> **Return Values**   
> `(object)` Returns instance of AutoLoad class.

```PHP
AutoLoad::getReady()->removePath('/path/to/first/directory')
                    ->removePath('/path/to/second/one')
                    ->removePath('/path/to/third');
// OR
$paths = array(
    '/path/to/first/directory',
    '/path/to/second/one',
    '/path/to/third'
);
AutoLoad::getReady()->removePath($paths);
```

### Getting All Paths
##### <i>`AutoLoad::`</i> `getPath()`

> **Return Values**   
> `(array)` Returns all the stored paths.

```PHP
AutoLoad::getReady()->getPath();
```

File Extensions
---------------
### Adding Extensions
##### <i>`AutoLoad::`</i> `addExtension($extension)`

Parameter | Type | Description
--- | --- | ---
**$extension** | `string` or `array` | File extensions of class files.

> **Return Values**   
> `(object)` Returns instance of AutoLoad class.

```PHP
AutoLoad::getReady()->addExtension('.inc')
                    ->addExtension('.lib.php')
                    ->addExtension('.class.php');
// OR
$extensions = array('.inc', '.lib.php', '.class.php');
AutoLoad::getReady()->addExtension($extensions);
```

### Removing Extensions
##### <i>`AutoLoad::`</i> `removeExtension($extension)`

Parameter | Type | Description
--- | --- | ---
**$extension** | `string` or `array` | File extensions of class files.

> **Return Values**   
> `(object)` Returns instance of AutoLoad class.

```PHP
AutoLoad::getReady()->removeExtension('.inc')
                    ->removeExtension('.lib.php')
                    ->removeExtension('.class.php');
// OR
$extensions = array('.inc', '.lib.php', '.class.php');
AutoLoad::getReady()->removeExtension($extensions);
```

### Getting All Extensions
##### <i>`AutoLoad::`</i> `getExtension()`

> **Return Values**   
> `(array)` Returns all the stored file extensions.

```PHP
AutoLoad::getReady()->getExtension();
```

Loaded Classes
--------------
### Check Loaded Class
##### <i>`AutoLoad::`</i> `isLoaded($className)`

Parameter | Type | Description
--- | --- | ---
**$className** | `string` | The name of the class.

> **Return Values**   
> `(bool)` Returns `false` if the class is not loaded.

```PHP
AutoLoad::getReady()->isLoaded($className);
```

### Get Loaded Classes
##### <i>`AutoLoad::`</i> `getLoaded()`

> **Return Values**   
> `(array)` Returns an associative `array` contains all the loaded class files.

```PHP
AutoLoad::getReady()->getLoaded();
```

Manage Autoloading
------------------
### Start Autoloading, Fire!
##### <i>`AutoLoad::`</i> `fire()`

> **Return Values**   
> `(void)`

### Stop Autoloading, Halt!
##### <i>`AutoLoad::`</i> `halt()`

> **Return Values**   
> `(void)`

```PHP
// Stop autoloading, Halt!
AutoLoad::getReady()->halt();

$f = new Foo('Err :('); // **Fatal error:** Class 'Foo' not found in...

// Start it again, Fire!
AutoLoad::getReady()->fire();
```