<?php

namespace App\Cleaner;

use Hhxsv5\LaravelS\Illuminate\Cleaners\CleanerInterface;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;
use JeroenNoten\LaravelAdminLte\AdminLte;

class PackCleaner implements CleanerInterface
{
    protected $instances = [
        'datatables',
        'datatables.request',
        'datatables.config',
        'datatables.fractal',
        'datatables.transformer',
        'hashids.factory',
        'hashids',
        //

    ];
    public function clean(Container $app, Container $snapshot)
    {
        foreach ($this->instances as $instance) {
            $app->forgetInstance($instance);
            Facade::clearResolvedInstance($instance);
        }

    }
}
