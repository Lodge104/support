<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5d74160bf8092705d3cdccf8755809fe
{
    public static $prefixesPsr0 = array (
        'o' => 
        array (
            'ohmy' => 
            array (
                0 => __DIR__ . '/..' . '/ohmy/auth/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit5d74160bf8092705d3cdccf8755809fe::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
