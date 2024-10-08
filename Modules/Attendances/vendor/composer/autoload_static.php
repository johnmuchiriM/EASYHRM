<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite001fa44e237abc33d2b7108a287fe68
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Modules\\Attendances\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Modules\\Attendances\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Modules\\Attendances\\Database\\Seeders\\AttendancesDatabaseSeeder' => __DIR__ . '/../..' . '/Database/Seeders/AttendancesDatabaseSeeder.php',
        'Modules\\Attendances\\Entities\\Attendance' => __DIR__ . '/../..' . '/Entities/Attendance.php',
        'Modules\\Attendances\\Http\\Controllers\\AttendancesController' => __DIR__ . '/../..' . '/Http/Controllers/AttendancesController.php',
        'Modules\\Attendances\\Providers\\AttendancesServiceProvider' => __DIR__ . '/../..' . '/Providers/AttendancesServiceProvider.php',
        'Modules\\Attendances\\Providers\\RouteServiceProvider' => __DIR__ . '/../..' . '/Providers/RouteServiceProvider.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite001fa44e237abc33d2b7108a287fe68::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite001fa44e237abc33d2b7108a287fe68::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite001fa44e237abc33d2b7108a287fe68::$classMap;

        }, null, ClassLoader::class);
    }
}
