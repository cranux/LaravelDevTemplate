<?php
use Illuminate\Support\Facades\Route;

Route::as('wechat.')
    ->group(function () {
        include_route_files(__DIR__.'/wechat/');
    });

