<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0906fcdc01212247948204f4c1123952
{
    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'Epush\\Core\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Epush\\Core\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit0906fcdc01212247948204f4c1123952::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0906fcdc01212247948204f4c1123952::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0906fcdc01212247948204f4c1123952::$classMap;

        }, null, ClassLoader::class);
    }
}