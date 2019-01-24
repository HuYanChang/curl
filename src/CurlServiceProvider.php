<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2019/1/24
 * Time: 17:22
 */
namespace Cxp\Curl;

use Illuminate\Support\ServiceProvider;

class CurlServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('curl', function () {
            return new Curl();
        });
    }
}