<?php

namespace App\Cleaner;

use Hhxsv5\LaravelS\Illuminate\Cleaners\CleanerInterface;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;
use JeroenNoten\LaravelAdminLte\AdminLte;

class AdminLteCleaner implements CleanerInterface
{
    public function clean(Container $app, Container $snapshot)
    {
        $app->forgetInstance(AdminLte::class);
        Facade::clearResolvedInstance(AdminLte::class);
    }
}