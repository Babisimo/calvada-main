<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit46c8ec4ac805894eed16c23189b2cd1c
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit46c8ec4ac805894eed16c23189b2cd1c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit46c8ec4ac805894eed16c23189b2cd1c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit46c8ec4ac805894eed16c23189b2cd1c::$classMap;

        }, null, ClassLoader::class);
    }
}
