<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb6d03e29ec675e4e495a5e546f9f5567
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Laminas\\Ldap\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Laminas\\Ldap\\' => 
        array (
            0 => __DIR__ . '/..' . '/laminas/laminas-ldap/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb6d03e29ec675e4e495a5e546f9f5567::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb6d03e29ec675e4e495a5e546f9f5567::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
