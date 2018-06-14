<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit935424e0a965b729da927a9f780a2d26
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit935424e0a965b729da927a9f780a2d26::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit935424e0a965b729da927a9f780a2d26::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
