<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite24186ff43bad16774aea83b3c273d1c
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Modules\\Role\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Modules\\Role\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Modules\\Role\\Database\\Seeders\\RoleDatabaseSeeder' => __DIR__ . '/../..' . '/Database/Seeders/RoleDatabaseSeeder.php',
        'Modules\\Role\\Http\\Controllers\\RoleController' => __DIR__ . '/../..' . '/Http/Controllers/RoleController.php',
        'Modules\\Role\\Models\\Role' => __DIR__ . '/../..' . '/Models/Role.php',
        'Modules\\Role\\Providers\\RoleServiceProvider' => __DIR__ . '/../..' . '/Providers/RoleServiceProvider.php',
        'Modules\\Role\\Providers\\RouteServiceProvider' => __DIR__ . '/../..' . '/Providers/RouteServiceProvider.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite24186ff43bad16774aea83b3c273d1c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite24186ff43bad16774aea83b3c273d1c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite24186ff43bad16774aea83b3c273d1c::$classMap;

        }, null, ClassLoader::class);
    }
}
