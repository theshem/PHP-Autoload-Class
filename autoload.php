<?php
/**
 * A PHP AutoLoad Class for versions 5.1.2+
 *
 * @author      Hashem Qolami <hashem@qolami.com>
 * @link        https://github.com/HashemQolami/PHP-Autoload-Class
 * @license     http://opensource.org/licenses/MIT (MIT license)
 * @copyright   Copyright (c) 2013, Hashem Qolami.
 * @since       Version 1.0
 * @version     Version 1.0
 */

class AutoLoad
{
    /**
     * Stores the path of class files.
     * 
     * @var array
     */
    private $_paths = array();

    /**
     * Stores the file extensions of class files.
     * 
     * @var array
     */
    private $_extensions = array('.php');

    /**
     * Stores the loaded classes.
     * 
     * @var array
     */
    private $_loaded = array();

    /**
     * Stores the class instance.
     * 
     * @var object|null
     */
    private static $_instance = null;

    /**
     * Adds the file path if exists.
     * 
     * @param mixed $path The file path to be included.
     */
    private function __construct($path = null)
    {
        if (isset($path)) {
            $this->addPath($path);
        }
    }

    /**
     * Register AutoLoad::loadClass on the SPL autoload stack; Fire!
     * 
     * @return void
     */
    public function fire()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }

    /**
     * Unregister AutoLoad::loadClass from the SPL autoloader stack; Halt!
     * 
     * @return void
     */
    public function halt()
    {
        spl_autoload_unregister(array($this, 'loadClass'));
    }

    /**
     * Creates an instance of class and gets the instance on later calls.
     * 
     * @param  string|array $path Paths to be included by initializing the class at once.
     * @return object             Instance of class.
     */
    public static function getReady($path = null)
    {
        if (! isset(self::$_instance)) {
            self::$_instance = new self($path);
        }

        return self::$_instance;
    }

    /**
     * Adds the paths of class files in the path storage.
     * 
     * @param  string|array $path Paths of class files.
     * @return object             Instance of class.
     */
    public function addPath($path = array())
    {
        if (! is_array($path)) {
            $path = array($path);
        }

        foreach ($path as $item) {
            $_item = rtrim($item, '/') . '/';
            if (! in_array($_item, $this->_paths)) {
                $this->_paths[] = $_item;
            }
        }

        return $this;
    }

    /**
     * Gets the stored paths.
     * 
     * @return array
     */
    public function getPath()
    {
        return $this->_paths;
    }

    /**
     * Removes the paths of class files from the path storage.
     * 
     * @param  string|array $path Paths of class files.
     * @return object             Instance of class.
     */
    public function removePath($path = array())
    {
        if (! is_array($path)) {
            $path = array($path);
        }

        foreach ($path as $item) {
            $_item = rtrim($item, '/') . '/';
            if (($key = array_search($_item, $this->_paths)) !== false) {
                unset($this->_paths[$key]);
            }
        }

        return $this;
    }

    /**
     * Adds the file extensions of class files in the extension storage.
     * 
     * @param  string|array $extension File extensions of class files.
     * @return object                  Instance of class.
     */
    public function addExtension($extension = array())
    {
        if (! is_array($extension)) {
            $extension = array($extension);
        }

        foreach ($extension as $item) {
            $_item = '.' . ltrim($item, '.');
            if (! in_array($_item, $this->_extensions)) {
                $this->_extensions[] = $_item;
            }
        }

        return $this;
    }

    /**
     * Gets the stored file extensions.
     * 
     * @return array
     */
    public function getExtension()
    {
        return $this->_extensions;
    }

    /**
     * Removes the file extensions of class files from the extension storage.
     * 
     * @param  string|array $extension File extensions of class files.
     * @return object                  Instance of class
     */
    public function removeExtension($extension = array())
    {
        if (! is_array($extension)) {
            $extension = array($extension);
        }

        foreach ($extension as $item) {
            $_item = '.' . ltrim($item, '.');
            if (($key = array_search($_item, $this->_extensions)) !== false) {
                unset($this->_extensions[$key]);
            }
        }
        
        return $this;
    }

    /**
     * Sets the class in the class storage as a loaded class.
     * 
     * @param string $className The name of the class.
     * @param string $path      The path of the class.
     */
    private function _setLoaded($className, $path)
    {
        $this->_loaded[$className] = $path;
    }

    /**
     * Checks whether the specified class is loaded before.
     * 
     * @param  string  $className The name of the class.
     * @return boolean            Returns false if the class is not loaded.
     */
    public function isLoaded($className)
    {
        return isset($this->_loaded[$className]);
    }

    /**
     * Gets the name and path of the loaded class files.
     * 
     * @return array
     */
    public function getLoaded()
    {
        return $this->_loaded;
    }

    /**
     * Loads the given class.
     * 
     * @param  string $className The name of the class.
     * @return void
     */
    public function loadClass($className)
    {
        if ($this->isLoaded($className)) {
            return false;
        }

        foreach ($this->_paths as $path) {
            foreach ($this->_extensions as $ext) {
                // Check whether the file is accessible.
                if (@is_readable($file = $path.$className.$ext)) {
                    break 2;
                }
            }
        }

        // Store the detected class file.
        $this->_setLoaded($className, $file);
        require $file;
    }
}