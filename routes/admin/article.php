<?php

Route::resource('article', 'ArticleController', ['except' => [
    'show',
]]);
