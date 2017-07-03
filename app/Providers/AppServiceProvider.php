<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth0\Lumen\LumenCacheWrapper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
        '\Auth0\Lumen\Contract\Auth0UserRepository',
        '\Auth0\Lumen\Repository\Auth0UserRepository');

        $this->app->bind(
        '\Auth0\SDK\Helpers\Cache\CacheHandler',
        function() {
            static $cacheWrapper = null;
            if ($cacheWrapper === null) {
                $cache = Cache::store();
                $cacheWrapper = new LumenCacheWrapper($cache);
            }
            return $cacheWrapper;
        });
    }
}
