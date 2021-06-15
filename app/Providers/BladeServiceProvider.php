<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Blade::directive('datetime', function ($expression) {
            return "<?php echo e((new DateTime($expression))->format('d.m.y G:i')); ?>";
        });        
    }
}
