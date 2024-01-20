<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitf068100dc2bcdce9128f07b0cabe9c85
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

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitf068100dc2bcdce9128f07b0cabe9c85', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitf068100dc2bcdce9128f07b0cabe9c85', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitf068100dc2bcdce9128f07b0cabe9c85::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}