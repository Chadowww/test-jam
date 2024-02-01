<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitb08a7dbe7c96ff32a1b7e5d7d5b19f70
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitb08a7dbe7c96ff32a1b7e5d7d5b19f70', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitb08a7dbe7c96ff32a1b7e5d7d5b19f70', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitb08a7dbe7c96ff32a1b7e5d7d5b19f70::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
