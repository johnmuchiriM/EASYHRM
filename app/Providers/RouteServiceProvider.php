<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        // $this->configureRateLimiting();

        $this->appConfiguration();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

        });
    }

     /**
     *lang configuration for application
     *
     * @return string
     */
    private function appConfiguration()
    {
        $lang = '';
        $timestamp= '';
        if (\Schema::hasTable('configurations')) {
            $isEmptyConfig = \DB::table('configurations')->get()->toArray();

            if (!empty($isEmptyConfig)) {

                //configure application language
                $lang = getConfig('config_app_lang');

                //configure application timestamp
                $timestamp = getConfig('config_app_timestamp');
            }
        }

        //in case of locale is not confgured
        if ($lang == '') {
            $lang = 'en';
        }
        \App::setLocale($lang);


        //in case of timestamp is not configured
        if ($timestamp == '') {
            $timestamp = 'Asia/Kolkata';
        }
        config(['app.timezone' => $timestamp]);
        date_default_timezone_set($timestamp);

        \Artisan::call('config:clear');
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
