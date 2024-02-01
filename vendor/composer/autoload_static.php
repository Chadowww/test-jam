<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb08a7dbe7c96ff32a1b7e5d7d5b19f70
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb08a7dbe7c96ff32a1b7e5d7d5b19f70::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb08a7dbe7c96ff32a1b7e5d7d5b19f70::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb08a7dbe7c96ff32a1b7e5d7d5b19f70::$classMap;

        }, null, ClassLoader::class);
    }
}