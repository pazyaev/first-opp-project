<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd6e152586c4dea8e7b72cd7dc30df2f0
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MyProject\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MyProject\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/MyProject',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Parsedown' => 
            array (
                0 => __DIR__ . '/..' . '/erusev/parsedown',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd6e152586c4dea8e7b72cd7dc30df2f0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd6e152586c4dea8e7b72cd7dc30df2f0::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitd6e152586c4dea8e7b72cd7dc30df2f0::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitd6e152586c4dea8e7b72cd7dc30df2f0::$classMap;

        }, null, ClassLoader::class);
    }
}
