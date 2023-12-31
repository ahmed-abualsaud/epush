<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit09de065e2bfc05b8936aae00d8c215dd
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

        spl_autoload_register(array('ComposerAutoloaderInit09de065e2bfc05b8936aae00d8c215dd', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit09de065e2bfc05b8936aae00d8c215dd', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit09de065e2bfc05b8936aae00d8c215dd::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
