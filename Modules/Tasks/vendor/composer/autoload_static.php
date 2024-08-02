<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitab0a6645a2c16b58490134786162a5c3
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Modules\\Tasks\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Modules\\Tasks\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Modules\\Tasks\\Database\\Seeders\\TasksDatabaseSeeder' => __DIR__ . '/../..' . '/Database/Seeders/TasksDatabaseSeeder.php',
        'Modules\\Tasks\\Entities\\Task' => __DIR__ . '/../..' . '/Entities/Task.php',
        'Modules\\Tasks\\Entities\\TaskComment' => __DIR__ . '/../..' . '/Entities/TaskComment.php',
        'Modules\\Tasks\\Http\\Controllers\\MyTasksController' => __DIR__ . '/../..' . '/Http/Controllers/MyTasksController.php',
        'Modules\\Tasks\\Http\\Controllers\\TasksController' => __DIR__ . '/../..' . '/Http/Controllers/TasksController.php',
        'Modules\\Tasks\\Providers\\RouteServiceProvider' => __DIR__ . '/../..' . '/Providers/RouteServiceProvider.php',
        'Modules\\Tasks\\Providers\\TasksServiceProvider' => __DIR__ . '/../..' . '/Providers/TasksServiceProvider.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitab0a6645a2c16b58490134786162a5c3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitab0a6645a2c16b58490134786162a5c3::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitab0a6645a2c16b58490134786162a5c3::$classMap;

        }, null, ClassLoader::class);
    }
}