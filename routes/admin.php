<?php


Route::middleware(['auth','role:administrator'])
    ->as('admin.')
    ->group(function () {
        include_route_files(__DIR__.'/admin/');
    });

