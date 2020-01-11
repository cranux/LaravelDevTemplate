<?php

Route::resource('image', 'ImagesController', ['except' => [
    'show',
]]);
