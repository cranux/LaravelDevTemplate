<?php

Route::resource('setting', 'SettingController', ['only' => [
    'index', 'update',
]]);
